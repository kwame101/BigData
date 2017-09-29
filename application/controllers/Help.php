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
      $this->load->model('Support_desk_model');
      if (!$this->ion_auth->logged_in())
      {
        //redirect them to the login page
        redirect('user/login','refresh');
      }
    }


	/**
   * Load user back onto support desk
   * Show all the most faqs added
	 */
	public function index()
	{
       $this->data['page_title'] = 'Help desk';
       $this->data["faq_info"] = $this->Support_desk_model->displayRecentFaq();
		   $this->render('faq/help_view');
	}

  /*
  *
  */
  public function doSearch()
  {
      $value = $this->input->post('search');
      $data = $this->Support_desk_model->searchFaq($value);
      if($data){
        echo json_encode($data);
      }
      else{
        echo json_encode(
          ['error' => 1,
          'data'=> '<ul><li>We couldn\'t find any results for: '.$value.'</li></ul>']);
      }
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
