<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Suppot Desk Controller - deals with all admin work from creating faq
* to creating topic and also responsing to enquiries
**/
class Support extends Admin_Controller
{

  /*
  * Initialise support controller - loading support desk mdoel
  * and pagination library. Also check if check user is an admin
  * else return user to admin page with an error message
  */
  function __construct()
  {
    parent::__construct();
    $this->load->model('Support_desk_model');
    $this->load->library("pagination");
    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','You are not allowed to visit the faqs page');
      redirect('admin','refresh');
    }
  }


  /*
  * Load faq page on default request
  */
  public function index()
  {
    redirect('admin/support/faq','refresh');
  }


  /*
  * Create faq post which takes title, topic type, content
  * Onload onto page display created faqs with option to
  * navigate through each faq - using pagination
  */
  public function faq()
  {
    $this->data['page_title'] = 'Create faqs';
    $this->load->library('form_validation');
    $this->form_validation->set_rules('title','Title','trim|required');
    $this->form_validation->set_rules('content','Content','trim|required');
    $this->form_validation->set_rules('category_id','Category','required|integer');

   if($this->form_validation->run()===FALSE)
  {
      $this->data['category'] = $this->Support_desk_model->displayAllCategories();
      //faq section
      $config["base_url"] = base_url() . "admin/support/faq";
      $config["total_rows"] = $this->Support_desk_model->record_count_faqs();
      $config["per_page"] = 5;
      $config["uri_segment"] = 4;
      $config["use_page_numbers"] = TRUE;
      $config["next_tag_open"] = '';
      $config["next_tag_close"] = '';
      $config["prev_tag_open"] = '';
      $config["prev_tag_close"] = '';
      $choice = $config["total_rows"] / $config["per_page"];
      $config["num_links"] = round($choice);

      $this->pagination->initialize($config);
      if($this->uri->segment(4) == '' || is_numeric($this->uri->segment(4))){
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) * $config["per_page"]) - $config["per_page"] : 0;
       } else {
        redirect('admin/support/faq','refresh');
      }
      $this->data["faq_info"] = $this->Support_desk_model->retrieveFaq($config["per_page"], $page);
      if(!$this->data["faq_info"]){
        redirect('admin/support/faq','refresh');
      }
      $this->data["paginate"] = $this->pagination->create_links();
      $this->load->helper('form');
      $this->render('admin/faq/add_faq_view');
  }
  else
  {
   $title = $this->input->post('title');
   $content = $this->input->post('content');
   $cat_id = $this->input->post('category_id');
   $this->Support_desk_model->createFaq($title,$content,$cat_id);
   $this->session->set_flashdata('message',$this->ion_auth->messages());
   redirect('admin/support/faq','refresh');
  }
}

  /*
  * Edit faq post - option to change title,
  * topic and content.
  * @param faq_id is the particular faq post you want to edit
  */
  public function editFaq($faq_id = null)
  {
    $faq_id = $this->input->post('faq_id') ? $this->input->post('faq_id') : $faq_id;
    $this->data['page_title'] = 'Edit faq';
    $this->load->library('form_validation');

    $this->form_validation->set_rules('title','Title','trim|required');
    $this->form_validation->set_rules('content','Content','trim|required');
    $this->form_validation->set_rules('category_id','Category','trim|integer|required');

    if($this->form_validation->run() === FALSE)
    {
      if($faq = $this->Support_desk_model->checkFaq($faq_id))
      {
        $this->data['faq_info'] = $faq;
        $this->data['category'] = $this->Support_desk_model->displayAllCategories();
      }
      else
      {
        $this->session->set_flashdata('message', 'The faq doesn\'t exist.');
        redirect('admin/support', 'refresh');
      }
      $this->load->helper('form');
      $this->render('admin/faq/edit_faq_view','admin_master',$this->data);
    }
    else
    {
      $title = $this->input->post('title');
      $content = $this->input->post('content');
      $category_id = $this->input->post('category_id');
      $this->Support_desk_model->update_faq($faq_id, $title, $content, $category_id);
      //need to add a message
      redirect('admin/support','refresh');
    }
  }

  /*
  * Search for an faq
  * Ajax call to search and return faq details in json form
  */
  public function searchFaqs()
  {
    $values = $this->input->post('search');
    $rows = $this->Support_desk_model->searchAdminFaqResult($values);
    echo json_encode($rows);
  }

  /*
  * Create a topic
  * On sucessful create load user back onto
  * the same page displaying all created topics
  */
  public function topic()
  {
    $this->data['page_title'] = 'Create topic';
    $this->load->library('form_validation');
    $this->form_validation->set_rules('category_name','category name','trim|required');
    $this->form_validation->set_rules('category_email','category email','trim|required');

    if($this->form_validation->run()===FALSE)
    {
      $this->load->helper('form');
      $this->data['category'] = $this->Support_desk_model->displayAllCategories();
      $this->render('admin/category/create_category_view');
    }
    else
    {
      $group_name = $this->input->post('category_name');
      $group_description = $this->input->post('category_email');
      $this->Support_desk_model->create_category($group_name, $group_description);
      redirect('admin/support/topic','refresh');
    }
  }

  /*
  * Delete a topic by passing its id
  */
  public function deleteTopic()
  {
      $topic_id = $this->input->post('topic_id');
      if(is_null($topic_id))
    {
      $this->session->set_flashdata('message','<div class="error_mg" style="padding-top: 20px;">There\'s no topic to delete</div>');
    }
      else
    {
      $this->Support_desk_model->removeTopic($topic_id);
      $this->session->set_flashdata('message','<div class="success_mg" style="padding-top: 20px;">Topic was successfully deleted</div>');
     }
     redirect('admin/support/topic','refresh');
  }

  /*
   * Display all topics
   */
   public function listCategories()
   {
     $this->data['page_title'] = 'Category';
     $this->data['category'] = $this->Support_desk_model->displayAllCategories();
     $this->render('admin/category/list_categories_view','master',$this->data);
   }

   /*
   * Edit topic - required a valid id
   * If id is not valid it returns user to default topic page
   * @param category_id is topic id for each topic
   */
   public function editTopic($category_id = null)
   {
     $category_id = $this->input->post('category_id') ? $this->input->post('category_id') : $category_id;
     $this->data['page_title'] = 'Edit topic';
     $this->load->library('form_validation');

     $this->form_validation->set_rules('category_name','Category name','trim|required');
     $this->form_validation->set_rules('category_email','Category email','trim|required');
     $this->form_validation->set_rules('category_id','Category id','trim|integer|required');

     if($this->form_validation->run() === FALSE)
     {
       if($category = $this->Support_desk_model->checkCategory($category_id))
       {
         $this->data['category'] = $category;
       }
       else
       {
         $this->session->set_flashdata('message', 'The category doesn\'t exist.');
         redirect('admin/support/topic', 'refresh');
       }
       $this->load->helper('form');
       $this->render('admin/category/edit_category_view','admin_master',$this->data);
     }
     else
     {
       $category_name = $this->input->post('category_name');
       $category_email = $this->input->post('category_email');
       $category_id = $this->input->post('category_id');
       $this->Support_desk_model->update_category($category_id, $category_name, $category_email);
       //need to add a message
       redirect('admin/support/topic','refresh');
     }
   }


   /*
   * Enquiry page displays all enquiry requested by users
   * By default it loads 'open' status if status is null
   * @param status is enquiry state i.e closed
   */
   public function enquiry($status = null)
   {
     //check if status is null load open as default
     if($status == null)
     {
       $this->data['enq_info'] = $this->Support_desk_model->retrieveEnquiry('open');
       $this->render('admin/faq/faq_enquiry_view');
     }
     else{
       if($status=='open'||$status=='pending'||$status=='closed'){
          //check if status value is valid i.e closed..
          $this->data['enq_info'] = $this->Support_desk_model->retrieveEnquiry($status);
          $this->render('admin/faq/faq_enquiry_view');
        }
        else {
          //if status not valid load default
          redirect('admin/support/enquiry','refresh');
      }
     }
   }

   /*
   * Display each enquiry with an id
   * @param enq_id is the enquiry id that is sent to be displayed
   */
   public function display($enq_id = NULL)
   {
     if(is_null($enq_id)){
          redirect('admin/support/enquiry','refresh');
      }
      else{
        $this->data['enq_info'] = $this->Support_desk_model->retrieveEnquiryById($enq_id);
        $this->render('admin/faq/faq_enquiry_id_view');
      }
   }

   /*
   * Update enquiry status by passing a post ajax request
   * enquiryid and status to update its current state.
   */
   public function doUpdateStatus()
   {
     $enq_id = $this->input->post('enquiryid');
     $value = $this->input->post('status');
     $this->Support_desk_model->updateStatus($enq_id,$value);
   }

}
