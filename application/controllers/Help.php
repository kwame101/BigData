<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Helper class is the user controller which allows users to contact
* the support team for any problem they encounted while using the
* dashbaord platforms.
**/
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
       $this->data["cat_info"] = $this->Support_desk_model->displayRecentFaq();
		   $this->render('faq/help_view');
	}

  /*
  * Search for a word or phrase in the faq tbl
  * based on what user entered
  */
  public function doSearch()
  {
      $value = $this->input->post('search');
      $data = $this->Support_desk_model->searchFaqResult($value);
      if($data){
        echo json_encode($data);
      }
      else{
        $json_data["error"] = 1;
        $json_data["data"] = '<ul class="helpdeskSearchError"><li>We couldn\'t find any results for: '.$value.'</li></ul>';
        echo json_encode($json_data);
      }
  }

  /*
  * Search through the db based on user input
  * Perform a complex search on user summary input
  */
  public function complexSearch()
  {

    $term = $this->input->post('search',TRUE);
    $rows = $this->Support_desk_model->searchFaqResult($term);
     echo json_encode($rows);
  }

  /*
  * Enquiry form page allows user to contact the support team
  * By submitting a form which is stored in the admin section
  * and also sending an email to each selected topic
  */
  public function contact()
  {
    $this->data['page_title'] = 'Help form';
    $this->load->library('form_validation');
    $this->form_validation->set_rules('summary','Question Summary','trim|required');
    $this->form_validation->set_rules('message','Message','trim|required');
    $this->form_validation->set_rules('topics[]','Topics','required|integer');
    if($this->form_validation->run($this)===FALSE)
    {
      //class imagesClean() here to delete unwanted images
      $this->load->helper('directory');
      $this->load->helper("file");
      $dir_fiels = directory_map('assets/upload/tmp/');
      $len = sizeOf($dir_fiels);
      for($i=0; $i<$len;$i++){
        unlink('assets/upload/tmp/'.$dir_fiels[$i]);
      }

      $this->load->helper('form');
      $this->data['category'] = $this->Support_desk_model->displayAllCategories();
      $this->render('faq/help_form_view');
    }
    else {
        $topics = $this->input->post('topics');
        $summary = $this->input->post('summary');
        $message = $this->input->post('message');
        $images = $this->input->post('images');

        //move each image into attachment dir
        if(!empty($images)){
          foreach($images as $img){
            $tmp_path = FCPATH.'assets/upload/tmp/'.$img;
            $perm_path = FCPATH.'assets/upload/attachments/'.$img;
            rename($tmp_path, $perm_path);
          }
        }
        $this->Support_desk_model->enquiryForm($topics,$summary,$message,$images);

        //submit an email to each selected topic
        $topic_email = $this->Support_desk_model->getTopicEmail($topics)->result_array();

        $this->load->library('email');
        $this->load->helper('path');
        foreach($topic_email as $u_email){
        //clear any previous email content
        $this->email->clear(TRUE);

        $this->email->from('test@gmail.com');
        $this->email->to(implode(', ',$u_email));
        if(!empty($images)){
          foreach($images as $img){
            $image_path = set_realpath('assets/upload/attachments/');
            $this->email->attach($image_path.$img);
          }
        }
        $msg_info = array(
          'summary' => $summary,
          'message' => $message,
        );
        $this->email->subject('New Enquiry');
        $content = $this->load->view('templates/email/enquiry_template.php',$msg_info,TRUE);
        $this->email->message($content);
        $this->email->send();
      }
          $this->session->set_flashdata('message', 'Thank you for sending us an enquiry, we\'ll be in touch with you soon!');
        //needs to display a message
        redirect('help/contact','refresh');
    }
  }

  /*
  * On upload request, store it in a local server and display result
  */
  public function display_upload()
  {
    if(!empty($_FILES['userfiles']['name']))
    {
      $files_c = count($_FILES['userfiles']['name']);
      for($i=0;$i < $files_c;$i++){
        $_FILES['userfile']['name'] = $_FILES['userfiles']['name'][$i];
        $_FILES['userfile']['type'] = $_FILES['userfiles']['type'][$i];
        $_FILES['userfile']['tmp_name'] = $_FILES['userfiles']['tmp_name'][$i];
        $_FILES['userfile']['error'] = $_FILES['userfiles']['error'][$i];
        $_FILES['userfile']['size'] = $_FILES['userfiles']['size'][$i];

      $config['upload_path'] = './assets/upload/tmp';
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $config['max_size'] = 1024 * 8;
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload',$config);

      if($this->upload->do_upload('userfile')){
         $data = $this->upload->data();
        echo '<span class="up_image"><input type="hidden" class="img_thumb" name="images[]" value="'.$data["file_name"].'" />
         <input type="image" disabled class="img_thumb" height="95" src="'.base_url().'assets/upload/tmp/'.$data["file_name"].'"  />
         <span class="del_img fa fa-times"></span></span>';
      }
      else{
          echo $this->upload->display_erros();
        }
      }
    }
    //  echo 'notworking';
  }

  /*
  * On delete request, remove the deleted file from the local server
  */
  public function delete_upload()
  {
    $this->load->helper("file");
    $file_name = $this->input->post('filename');
    $path = FCPATH.'assets/upload/tmp/'.$file_name;
    if(file_exists($path))
    {
      unlink($path);
    }
    else {
      show_404();
    }
  }

}
