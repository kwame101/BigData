<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends Admin_Controller
{

  /*
  *
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
  *
  */
  public function index()
  {
    redirect('admin/support/faq','refresh');
  }


  /*
  *
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
      $config["next_tag_open"] = '<span class="next fa fa-arrow-right">';
      $config["next_tag_close"] = '</span>';
      $config["prev_tag_open"] = '<span class="prev fa fa-arrow-left">';
      $config["prev_tag_close"] = '</div>';
      $choice = $config["total_rows"] / $config["per_page"];
      $config["num_links"] = round($choice);

      $this->pagination->initialize($config);

      $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) * $config["per_page"]) - $config["per_page"] : 0;
      $this->data["faq_info"] = $this->Support_desk_model->retrieveFaq($config["per_page"], $page);
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
  *
  *
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
  *
  */
  public function topic()
  {
    $this->data['page_title'] = 'Create category';
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
   *
   */
   public function listCategories()
   {
     $this->data['page_title'] = 'Category';
     $this->data['category'] = $this->Support_desk_model->displayAllCategories();
     $this->render('admin/category/list_categories_view','master',$this->data);
   }

   /*
   *
   */
   public function editTopic($category_id = null)
   {
     $category_id = $this->input->post('category_id') ? $this->input->post('category_id') : $category_id;
     $this->data['page_title'] = 'Edit category';
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
   *
   */
   public function enquiry($status = null)
   {
     $this->render('admin/faq/faq_enquiry_view');

     //check if status is null load open as default

     //check if status value is valid i.e closed..

     //if status not valid load default - open

   }

   /*
   *
   */
   public function display($enq_id = null)
   {
      //display if enquiry id is valid

      //if invalid or null load back enquiry default
   }

}
