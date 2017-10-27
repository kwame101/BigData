<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* User controller for admins - allows a particular user to perform simple
* tasks like logging into their account, logging out etc.
* This controller also extend the parent (core) controller since it deals
* with user authentication so it easy.
*/
class User extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('ion_auth');
  }

  /*
  * Load login page - redirect to login fucntion
  */
  public function index()
  {
    redirect('admin/user/login', 'refresh');
  }

  /*
  * User login - allows user to login with a valid email
  * and password.
  */
  public function login()
  {
  $this->data['page_title'] = 'Login';
  //if user logged in
  if($this->ion_auth->logged_in())
  {
    redirect('admin','refresh');
  }

  if($this->input->post())
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('identity', 'Identity', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('remember','Remember me','integer');
    if($this->form_validation->run()===TRUE)
    {
      $isAdmin = $this->ion_auth->isAdmin($this->input->post('identity'));
      if($isAdmin) {
      $remember = (bool) $this->input->post('remember');
      $user = $this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember);
      if ($user)
      {
        if($this->ion_auth->is_admin()){
          redirect('admin', 'refresh');
        }
        else {
            redirect('dashboard', 'refresh');
        }
      }
      else
      {
        $this->session->set_flashdata('message','<div class="error_mg">'.$this->ion_auth->errors().'</div>');
        redirect('admin/user/login', 'refresh');
      }
       }
       else {
         $this->session->set_flashdata('message','<div class="error_mg">Your account does not have permission to access this section.</div>');
         redirect('admin/user/login', 'refresh');
       }
    }
  }
  $this->load->helper('form');
  $this->render('admin/login_view','admin_master');
}

  /*
  * Logout user on admin section
  */
  public function logout()
  {
    $this->ion_auth->logout();
    redirect('admin/user/login', 'refresh');
  }

  /*
  * Allow admins to change their password
  * If user is not admin redirect to dashbaord
  */
  public function settings()
  {
      $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
  		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
  		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

      if(!$this->ion_auth->logged_in())
      {
        redirect('admin/user/login','refresh');
      }

      //if user is not admin
      if(!$this->ion_auth->in_group('admin'))
      {
        redirect('dashboard','refresh');
      }

  		$user = $this->ion_auth->user()->row();

  		if ($this->form_validation->run() == false)
  		{
  			// display the form
  			// set the flash data error message if there is one
  			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

  			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
  			$this->data['old_password'] = array(
  				'name' => 'old',
  				'id'   => 'old',
  				'type' => 'password',
  			);
  			$this->data['new_password'] = array(
  				'name'    => 'new',
  				'id'      => 'new',
  				'type'    => 'password',
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

  			// render
  			$this->render('admin/user/admin_settings_view','admin_master', $this->data);
  		}
  		else
  		{
  			$identity = $this->session->userdata('identity');

  			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

  			if ($change)
  			{
  				//if the password was successfully changed
  				$this->session->set_flashdata('message', '<div class="success_mg">'.$this->ion_auth->messages().'</div>');
  				redirect('admin/user/settings', 'refresh');
  			}
  			else
  			{
  				$this->session->set_flashdata('message', '<div class="error_mg">'.$this->ion_auth->errors().'</div>');
  				redirect('admin/user/settings', 'refresh');
  			}
  		}
  }

  public function guide()
  {
    if(!$this->ion_auth->logged_in())
    {
      redirect('admin/user/login','refresh');
    }

    //if user is not admin
    if(!$this->ion_auth->in_group('admin'))
    {
      redirect('dashboard','refresh');
    }

    $this->render('admin/user/admin_guide_upload_view','admin_master');
  }

}
