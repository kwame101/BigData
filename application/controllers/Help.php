<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends Public_Controller{

  /*
    * Initialise functions
    */
    function __construct()
    {
      parent::__construct();
      if (!$this->ion_auth->logged_in())
      {
        //redirect them to the login page
        redirect('user/login','refresh');
      }
    }


	/**
   * Load user back onto support desk
	 */
	public function index()
	{
       $this->data['page_title'] = 'Help desk';
		   $this->render('faq/help_view');
	}

}
