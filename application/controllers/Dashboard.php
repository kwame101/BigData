<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Public_Controller{

  /*
    * Initialise functions
    */
    function __construct()
    {
      parent::__construct();
    }


	/**
   * Load user dashboard page - display on dashboard_view
	 */
	public function index()
	{
		    $this->render('dashboard_view');
	}

  /*
  *
  */
  public function ping()
  {
        if($this->session->userdata('ses_key')==1){
        $session_key = $this->input->post('session_key');
        $this->ion_auth->update_user_activity($session_key);
      }
      else {
          redirect('user','refresh');
      }
  }

}
