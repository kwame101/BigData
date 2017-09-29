<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends My_Controller{

  /*
    * Initialise functions
    */
    function __construct()
    {
      parent::__construct();
      if($this->ion_auth->logged_in())
        {
          redirect('dashboard','refresh');
       }
    }

    /*
    * If user loggged in check
    * redirect or show 404 error
    */
    public function index()
    {
      if(!$this->ion_auth->logged_in())
        {
          show_404();
       }
       else{

         redirect('dashboard','refresh');
      }
    }

    /*
    * Forgot password - user can change their password
    * requires an existing email to proceed
    */
    public function forgot_password()
    {
      // setting validation rules by checking whether identity is username or email
  		if($this->config->item('identity', 'ion_auth') != 'email' )
  		{
  		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
  		}
  		else
  		{
  		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
  		}
  		if ($this->form_validation->run() == false)
  		{
  			$this->data['type'] = $this->config->item('identity','ion_auth');
  			// setup the input
  			$this->data['identity'] = array('name' => 'identity',
  				'id' => 'identity',
  			);
  			if ( $this->config->item('identity', 'ion_auth') != 'email' ){
  				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
  			}
  			else
  			{
  				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
  			}
  			// set any errors and display the form
  			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
  			$this->render('user/email/forgot_password','master', $this->data);
  		}
  		else
  		{
  			$identity_column = $this->config->item('identity','ion_auth');
  			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();
  			if(empty($identity)) {
  	            		if($this->config->item('identity', 'ion_auth') != 'email')
  		            	{
  		            		$this->ion_auth->set_error('forgot_password_identity_not_found');
  		            	}
  		            	else
  		            	{
  		            	   $this->ion_auth->set_error('forgot_password_email_not_found');
  		            	}
  		                $this->session->set_flashdata('message', $this->ion_auth->errors());
                  		redirect("user/email/forgot_password", 'refresh');
              		}
  			// run the forgotten password method to email an activation code to the user
  			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});
  			if ($forgotten)
  			{
  				// if there were no errors
  				$this->session->set_flashdata('message', $this->ion_auth->messages());
  				redirect("user", 'refresh'); //we should display a confirmation page here instead of the login page
  			}
  			else
  			{
  				$this->session->set_flashdata('message', $this->ion_auth->errors());
  				redirect("user/email/forgot_password", 'refresh');
  			}
  		}

    }

    /*
    * Reset password require code sent to email
    * - if no code added show 404 errors
    */
    public function reset_password($code = NULL)
    {
      if (!$code)
      {
        show_404();
      }
      $user = $this->ion_auth->forgotten_password_check($code);
      if ($user)
      {
        // if the code is valid then display the password reset form
        $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');
        if ($this->form_validation->run() == false)
        {
          // display the form
          // set the flash data error message if there is one
          $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
          $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
          $this->data['new_password'] = array(
            'name' => 'new',
            'id'   => 'new',
            'type' => 'password',
            'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
          );
          $this->data['new_password_confirm'] = array(
            'name'    => 'new_confirm',
            'id'      => 'new_confirm',
            'type'    => 'password',
            'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
          );
          $this->data['user_id'] = array(
            'name'  => 'user_id',
            'id'    => 'user_id',
            'type'  => 'hidden',
            'value' => $user->id,
          );
          $this->data['csrf'] = $this->_get_csrf_nonce();
          $this->data['code'] = $code;
          // render
          $this->render('password/reset_password', $this->data);
        }
        else
        {
          // do we have a valid request?
          if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
          {
            // something fishy might be up
            $this->ion_auth->clear_forgotten_password_code($code);
            show_error($this->lang->line('error_csrf'));
          }
          else
          {
            // finally change the password
            $identity = $user->{$this->config->item('identity', 'ion_auth')};
            $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
            if ($change)
            {
              // if the password was successfully changed
              $this->session->set_flashdata('message', $this->ion_auth->messages());
              redirect("user", 'refresh');
            }
            else
            {
              $this->session->set_flashdata('message', $this->ion_auth->errors());
              redirect('password/reset_password' . $code, 'refresh');
            }
          }
        }
      }
      else
      {
        // if the code is invalid then send them back to the forgot password page
        $this->session->set_flashdata('message', $this->ion_auth->errors());
        redirect("password/forgot_password", 'refresh');
      }
    }


}
