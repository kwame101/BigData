<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Default page user enters when they logged in
**/
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
  * Load user visualisation page
  */
  public function visualisation()
  {
      $this->load->view('visualisation_view');
  }

}
