<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends Public_Controller{

  /*
    * Initialise functions
    */
    function __construct()
    {
      parent::__construct();
      $this->load->helper('url');
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

  /*
  *
  */
  public function contact()
  {
    $this->data['page_title'] = 'Help form';
    $this->render('faq/help_form_view');
  }

  /*
  *
  */
  public function display_upload()
  {
    if(isset($_FILES['imagefile']['name']))
    {
      $config['upload_path'] = './assets/upload/';
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $this->load->library('upload',$config);
      $this->upload->initialize($config);
      if($this->upload->do_upload('imagefile')){
         $data = $this->upload->data();
         echo '<img scr="'.base_url().'/assets/upload/'.$data["file_name"].'" width="300" height="225" class="img-thumbnail" />';
      }
      else{
          echo $this->upload->display_erros();
        }
    }
   echo 'notworking';
  }


}
