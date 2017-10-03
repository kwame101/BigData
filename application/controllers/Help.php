<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends Public_Controller{

  /*
    * Initialise functions
    */
    function __construct()
    {
      parent::__construct();
      $this->load->helper(array('url','form'));
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
  public function complexSearch()
  {

    $term = $this->input->post('search',TRUE);
    //if(strln($term>3))
    $rows = $this->Support_desk_model->searchFaqResult($term);
     echo json_encode($rows);
  }

  /*
  *
  */
  public function contact()
  {
    $this->data['page_title'] = 'Help form';
    $this->load->library('form_validation');
    $this->form_validation->set_rules('summary','Question Summary','trim|required');
    $this->form_validation->set_rules('message','Message','trim|required');
    $this->form_validation->set_rules('topics[]','Topics','required|integer');
    if($this->form_validation->run()===FALSE)
    {
      $this->load->helper('form');
      $this->data['category'] = $this->Support_desk_model->displayAllCategories();
      $this->render('faq/help_form_view');
    }
    else {
        $topics = $this->input->post('topics');
        $summary = $this->input->post('summary');
        $message = $this->input->post('message');
        $images = $this->input->post('images');
        $this->Support_desk_model->enquiryForm($topics,$summary,$message,$images);
        //needs to display a message
        redirect('help/contact','refresh');

    }
  }

  /*
  *
  */
  public function display_upload()
  {
    if(isset($_FILES['userfile']['name']))
    {
      $upload_file = 'userfile';
      $config['upload_path'] = './assets/upload/';
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $config['max_size'] = 1024 * 8;
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload',$config);
      $this->upload->do_upload($upload_file);
      $data = $this->upload->data();

        echo '<img scr="'.base_url().'assets/upload/'.$data["file_name"].'" width="300" height="225" class="img-thumbnail" />';

    }

      echo 'notworking';
  }

  public function test()
  {
    if($this->upload->do_upload('imagefile')){
       //$data = $this->upload->data();
       echo '<img scr="'.base_url().'/assets/upload/'.$data["file_name"].'" width="300" height="225" class="img-thumbnail" />';
    }
    else{
        echo $this->upload->display_erros();
      }
  }


}
