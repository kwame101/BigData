<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

class Support_desk_model extends CI_Model
{

  /*
  *
  */
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }


  /*
  *
  */
  public function retrieveAllFaqs()
  {
    $this->db->select('*');
    $this->db->from('faq f');
    $this->db->join('faq_category fc','f.id=fc.faq_id','left');
    $this->db->join('category c','fc.cat_id =c.id','left');
    $query=$this->db->get();
    return $query->result_array();
  }

  /*
  *
  */
  public function retrieveFaq($limit, $offset)
  {
    $this->db->limit($limit, $offset);
    $this->db->select('*');
    $this->db->from('faq');
    $this->db->join('faq_category','faq.id=faq_category.faq_id','left');
    $this->db->join('category','faq_category.cat_id =category.id','left');
    $this->db->order_by('created_on', 'desc');
    $query=$this->db->get();

    if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
  }

  /*
  *
  */
  public function displayRecentFaq($cat_id)
  {
    $this->db->select('*');
    $this->db->from('faq');
    $this->db->join('faq_category','faq.id=faq_category.faq_id','left');
    $this->db->join('category','faq_category.cat_id =category.id','left');
    if ($cat_id !== false)
       $this->db->where('faq_category.cat_id', $cat_id);
    $this->db->order_by('created_on', 'desc');
    //$this->db->group_by('category.name');
    $this->db->limit('3');
    $query=$this->db->get();

    if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

  }

  function getSelCategories()
{
  $this->db->select('id, name');
  $this->db->order_by('name', 'ASC');
  $this->db->limit('3');
  $query = $this->db->get('category');

  if($query->result() == TRUE)
  {
    foreach($query->result_array() as $row)
    {
      $result[] = $row;
    }
    return $result;
  }
}

  /**
  *
  */
  public function searchFaq($value)
  {
    $this->db->select('category.name,faq.title,faq.text');
    $this->db->from('faq');
    $this->db->join('faq_category','faq.id=faq_category.faq_id','left');
    $this->db->join('category','faq_category.cat_id =category.id','left');
    $this->db->group_start();
    $this->db->or_like('faq.text',$value);
    $this->db->or_like('category.name',$value);
    $this->db->or_like('faq.title',$value);
    $this->db->group_end();
    $this->db->order_by('created_on', 'desc');
    $query=$this->db->get();

    if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

  }

  /*
  *
  */
  public function checkFaq($faq_id)
  {
    $this->db->select('*');
    $this->db->from('faq');
    $this->db->join('faq_category','faq.id=faq_category.faq_id','left');
    $this->db->join('category','faq_category.cat_id =category.id','left');
    $this->db->where('faq.id',$faq_id);
    $query = $this->db->get();
    if ($query->num_rows() != 1)
    {
      return false;
    }
		return $query->row();
  }

  /**
  *
  */
  public function searchFaqResult($values)
  {
    $this->db->select('*');
    $this->db->from('faq');
    $this->db->join('faq_category','faq.id=faq_category.faq_id','left');
    $this->db->join('category','faq_category.cat_id =category.id','left');
    $this->db->group_start();
    $search_query_values = explode(' ', $values);
    $counter = 0;
    foreach ($search_query_values as $key => $value) {
        if ($counter == 0) {
            $this->db->like('faq.title', $value);
        }
        else {
            $this->db->or_like('faq.title', $value);
            $this->db->or_like('faq.text', $value);
            $this->db->or_like('category.name', $value);
        }
        $counter++;
    }
    $this->db->group_end();
    //$this->db->like('text',$value,'both');
    //$this->db->or_like('name',$value,'both');
    $this->db->order_by('created_on', 'desc');
    $query=$this->db->get();

    if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

  }

  /*
  *
  */
  public function update_faq($faq_id,$title,$content,$cat_id)
  {
    $this->db->set('title',$title);
    $this->db->set('text',$content);
    $this->db->where('id',$faq_id);
    $this->db->update('faq');

    $this->db->set('cat_id',$cat_id);
    $this->db->where('faq_id',$faq_id);
    $this->db->update('faq_category');
  }

  /*
  *
  */
  public function record_count_faqs()
  {
     return $this->db->count_all('faq');
  }


  /*
  *
  */
  public function createFaq($title,$content,$cat_id)
  {
    $data = array('title'=>$title,'text'=>$content, 'created_on'=>time());
    $this->db->insert('faq', $data);
    $id = $this->db->insert_id('faq' . '_id_seq');
    $cat_faq = array('faq_id'=>$id,'cat_id'=>$cat_id);
    $this->db->insert('faq_category', $cat_faq);
  }

  /*
  *
  */
  public function displayAllCategories()
  {
    $this->db->select('*');
    $this->db->from('category');
    $query = $this->db->get();
    return $query->result();
  }

  /*
  *
  */
  public function create_category($name, $email)
  {
    $data = array('name'=>$name,'email'=>$email);
    $this->db->insert('category', $data);
  }

  /*
  *
  */
  public function checkCategory($cat_id)
  {
    $this->db->select('*');
    $this->db->from('category');
    $this->db->where('id',$cat_id);
    $query = $this->db->get();
    if ($query->num_rows() != 1)
    {
      return false;
    }
		return $query->row();
  }

  /*
  *
  */
  public function update_category($cat_id, $cat_name, $cat_email)
  {
    $data = array('name'=>$cat_name, 'email'=>$cat_email);
    $this->db->where('id',$cat_id);
    $this->db->update('category',$data);
  }

  /**
  *
  */
  public function getTopicEmail($topics = array())
  {
    $this->db->select('email');
    $this->db->from('category');
    $this->db->where_in('id', $topics);
    $query = $this->db->get();

    return $query;
  }

  /**
  *
  */
  public function enquiryForm($topics = array(), $summary, $message, $images = array())
  {
    $user_id = $this->ion_auth->get_user_id();
    $data = array(
      'summary'=>$summary,
      'content'=>$message,
      'created_on'=>time(),
      'user_id'=>$user_id,
      'status'=> 'open'
    );
    $this->db->insert('enquiry',$data);
    $id = $this->db->insert_id('enquiry' . '_id_seq');
    //loop n insert into enquiry topic
    foreach($topics as $topic)
    {
      $this->db->insert('enquiry_topic',array('enq_id'=>$id,'cat_id'=>$topic));
    }
    //loop and insert images seperately
    if(!empty($images)){
      foreach($images as $image)
      {
        $this->db->insert('image_attachment',array('enq_id'=>$id,'image'=>$image));
      }
    }
  }

  /*
  *
  */
  public function retrieveEnquiry($status)
  {
    $this->db->select('CONCAT_WS(" ",users.first_name,users.last_name) as full_name,
    GROUP_CONCAT(DISTINCT CONCAT("<div>",category.name,"</div>") SEPARATOR " ") as category_name,
    GROUP_CONCAT(DISTINCT CONCAT("<div>",category.email,"</div>") SEPARATOR " ") as category_email,
    enquiry.id,enquiry.summary,enquiry.created_on,enquiry.status');
    $this->db->from('enquiry');
    $this->db->join('enquiry_topic','enquiry.id=enquiry_topic.enq_id','left');
    $this->db->join('category','enquiry_topic.cat_id=category.id','left');
    $this->db->join('users','enquiry.user_id=users.id','left');
    $this->db->where('enquiry.status',$status);
    $this->db->order_by('created_on', 'desc');
    $this->db->group_by('enquiry.id');
    $query=$this->db->get();
    if($query->num_rows() > 0) {
          return $query->result_array();
        }
        return false;
  }


    /*
    *
    */
    public function retrieveEnquiryById($enqid)
    {
      $this->db->select('CONCAT_WS(" ",uid.first_name,uid.last_name) as user_full_name,
      GROUP_CONCAT(DISTINCT CONCAT("<div>",category.name,"</div>") SEPARATOR " ") as category_name,
      GROUP_CONCAT(DISTINCT CONCAT("<div>",category.email,"</div>") SEPARATOR " ") as category_email,
      CONCAT_WS(" ",rid.first_name,rid.last_name) as res_full_name,rid.email,
      GROUP_CONCAT(DISTINCT image_attachment.image SEPARATOR ",") as images,enquiry.*');
      $this->db->from('enquiry');
      $this->db->join('enquiry_topic','enquiry.id=enquiry_topic.enq_id','left');
      $this->db->join('category','enquiry_topic.cat_id=category.id','left');
      $this->db->join('users uid','enquiry.user_id=uid.id','left');
      $this->db->join('users rid','enquiry.res_id=rid.id','left');
      $this->db->join('image_attachment','enquiry.id=image_attachment.enq_id','left');
      $this->db->where('enquiry.id',$enqid);
      $this->db->order_by('created_on', 'desc');
      //$this->db->group_by('enquiry.id');
      $query=$this->db->get();
      if($query->num_rows() != 1) {
            return false;
        }
        return $query->row();
    }

    /*
    *
    */
    public function updateStatus($enq_id,$value)
    {
      if($value == 'open'){
        $data = array('res_id'=>NULL, 'status'=>$value);
      }
      else{
        $cur_id = $this->ion_auth->get_user_id();
        $data = array('res_id'=>$cur_id, 'status'=>$value);
      }
      $this->db->where('id',$enq_id);
      $this->db->update('enquiry',$data);
    }

}
