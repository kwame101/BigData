<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* User controller allows user to login and logut - Also performs
* a simple function which update users activity every few seconds
**/
class User extends My_Controller {

  /*
    * Initialise functions
    */
    function __construct()
    {
      parent::__construct();
    }

	/**
   * Load user login page - display on login_view
	 */
	public function index()
	{
    redirect('user/login','refresh');
	}


  /*
  * User will login - take post information
  */
  public function login()
  {
    if($this->ion_auth->logged_in())
      {
        redirect('dashboard','refresh');
     }
    $this->data['title'] = $this->lang->line('login_heading');
		//validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');
		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');
			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
        if(!$this->ion_auth->in_group('admin')){
				//if the login is successful
        $session_key = $this->ion_auth->generateRandomString();
        $new_data = array (
          'auth_key' => $session_key,
          'ses_key' => true
        );
        $this->session->set_userdata($new_data);
        $user_id = $this->ion_auth->get_user_id();
        $this->ion_auth->set_user_activity($user_id,$session_key);
        }
				//redirect them back to the home page
				$this->session->set_flashdata('message', '<div class="success_mg">'.$this->ion_auth->messages().'</div>');
				redirect('dashboard', 'refresh');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', '<div class="error_mg">'.$this->ion_auth->errors().'</div>');
				redirect('user/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
      $this->data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
			);
			$this->render('user/login_view','master',$this->data);
		}
  }

  /*
  * Allow user to logout and destroy session
  */
  public function logout()
  {
    $this->data['title'] = "Logout";
    $this->session->unset_userdata('auth_key');
    $this->session->unset_userdata('ses_key');
    // log the user out
    $logout = $this->ion_auth->logout();
    // redirect them to the login page
    $this->session->set_flashdata('message','<div class="success_mg">'.$this->ion_auth->messages().'</div>');
    redirect('user/login', 'refresh');
  }


    /*
    * Update user last activity if they are still on the page
    */
    public function ping()
    {
          date_default_timezone_set('Europe/London');
          if($this->session->userdata('ses_key')==1){
              $session_key = $this->input->post('session_key');
              //get user last seen - current time
              $lastseen = $this->ion_auth->getLastSeen($session_key);
              $time_n = time();
              $diff = $time_n - $lastseen;
              //if diff btwn that > 5 mins log user out.
              if($diff > 300){
                echo 'timeout';
                $this->logout();
              }
              else {
                  $this->ion_auth->update_user_activity($session_key);
            }
          }
          else {
              redirect('user','refresh');
        }
    }

  /*
  * User register form - allows user to register their account
  * If user account is already created by admin allow
  * them to register
  */
  public function register_user()
  {
    if($this->ion_auth->logged_in())
      {
        redirect('dashboard','refresh');
     }
    $this->data['title'] = $this->lang->line('create_user_heading');
    $tables = $this->config->item('tables','ion_auth');
    $identity_column = $this->config->item('identity','ion_auth');
    $this->data['identity_column'] = $identity_column;
    // validate form input
    $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
    $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
    if($identity_column!=='email')
    {
        $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
    }
    else
    {
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
    }
    $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]|callback_valid_password');
    $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');
    if ($this->form_validation->run() == true)
    {
        $email    = strtolower($this->input->post('email'));
        $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
        $password = $this->input->post('password');
        $additional_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name'  => $this->input->post('last_name'),
        );
    }

    if ($this->form_validation->run() == true)
    {
        //assume email already in database
        $check_email = $this->ion_auth->email_exists($email);
        $is_registered = $this->ion_auth->registered_email($email);
        if($check_email == 0 && $is_registered){
        $this->ion_auth->create_account($identity, $password, $email, $additional_data);
        // check to see if we are creating the user
        // redirect them back to the dashboard page
        $this->session->set_flashdata('message', '<div class="success_mg">Account successfully created, please sign in below</div>');
        redirect("user/login", 'refresh');
        }
       else{
         $error = '<div class="error_mg">You are not allowed to create an account.</div>';
         $this->form_creation($error);
      }
    }
    else
    {
        // display the create user form
        // set the flash data error message if there is one
      $error = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
      $this->form_creation($error);
  }
}

  /*
  * User form creation - allows user to enter their details
  */
  protected function form_creation($message)
  {
    $this->data['message'] = $message;
    $this->data['first_name'] = array(
        'name'  => 'first_name',
        'id'    => 'first_name',
        'type'  => 'text',
        'value' => $this->form_validation->set_value('first_name'),
    );
    $this->data['last_name'] = array(
        'name'  => 'last_name',
        'id'    => 'last_name',
        'type'  => 'text',
        'value' => $this->form_validation->set_value('last_name'),
    );
    $this->data['identity'] = array(
        'name'  => 'identity',
        'id'    => 'identity',
        'type'  => 'text',
        'value' => $this->form_validation->set_value('identity'),
    );
    $this->data['email'] = array(
        'name'  => 'email',
        'id'    => 'email',
        'type'  => 'text',
        'value' => $this->form_validation->set_value('email'),
    );
    $this->data['company'] = array(
        'name'  => 'company',
        'id'    => 'company',
        'type'  => 'text',
        'value' => $this->form_validation->set_value('company'),
    );
    $this->data['password'] = array(
        'name'  => 'password',
        'id'    => 'password',
        'type'  => 'password',
        'value' => $this->form_validation->set_value('password'),
    );
    $this->data['password_confirm'] = array(
        'name'  => 'password_confirm',
        'id'    => 'password_confirm',
        'type'  => 'password',
        'value' => $this->form_validation->set_value('password_confirm'),
    );

    $this->render('user/register_view','master', $this->data);
  }

  /**
	 * Validate the password
	 *
	 * @param string $password
	 *
	 * @return bool
	 */
	public function valid_password($password = '')
	{
		$password = trim($password);
		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
    $test = array();
		if (empty($password))
		{
			$this->form_validation->set_message('valid_password', 'The {field} field is required.');
			return FALSE;
		}
		if (preg_match_all($regex_lowercase, $password,$test) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');
			return FALSE;
		}
		if (preg_match_all($regex_uppercase, $password,$test) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
			return FALSE;
		}
		if (preg_match_all($regex_number, $password,$test) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
			return FALSE;
		}
		return TRUE;
	}

}
