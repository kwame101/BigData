<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Support Desk Model - performs search and retrieves information from db tables
* by performing simple query selects and returns
**/
class Support_desk_model extends CI_Model
{

  /*
  * Initialise the databse
  */
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }


  /*
  * Retreive all faq created from table faq
  * @return the query of an array result
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
  * Retrieve faq from table faq by setting a limit
  * @return array of each row if found else return false
  *
  * @Param string limit
  * @Param string offset
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
  * Search for most recent faq based of each topic
  * Set a limit on most recent faq by 10
  * @return array of each row if found else return false
  *
  * @param string cat_id
  */
  public function displayRecentFaq()
  {
    $this->db->select('category.name,faq.title,faq.text');
    $this->db->from('faq');
    $this->db->join('faq_category','faq.id=faq_category.faq_id','left');
    $this->db->join('category','faq_category.cat_id =category.id','left');
    $this->db->order_by('faq.created_on', 'desc');
    //$this->db->group_by('category.name');
    $this->db->limit('10');
    $query=$this->db->get();

    if($query->num_rows() > 0) {
          $category = array();
          $result = $query->result_array();
          foreach($result as $row){
          if(!array_key_exists($row['name'], $category)){
              $category[$row['name']] = array();
          }
              $category[$row['name']][] = $row;
          }
            return $category;
        }
        return false;
  }

  /*
  * Search for categories and set a limit by 3
  * @return an array of each row if found else false
  */
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
  * Search for faq based on search term
  * @return string  data array if found else return false
  *
  * @param string value
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
            $category = array();
            $result = $query->result_array();
              foreach($result as $row){
              if(!array_key_exists($row['name'], $category)){
                $category[$row['name']] = array();
              }
              $category[$row['name']][] = $row;
            }
            return $category;
        }
        return false;

  }

  /*
  * Search for a particular faq by passing a unique id
  * @return string query row if found else return false
  *
  * @param string faq_id
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
  * Search for faq results based on value
  * @return string data value if found else false
  *
  * @param string values
  */
  public function searchFaqResult($values)
  {
    $this->db->select('category.name,faq.title,faq.text');
    $this->db->from('faq');
    $this->db->join('faq_category','faq.id=faq_category.faq_id','left');
    $this->db->join('category','faq_category.cat_id =category.id','left');
    $this->db->where('MATCH (category.name) AGAINST ("'.$values.'" IN BOOLEAN MODE)', NULL, false);
    $this->db->or_where('MATCH (faq.title) AGAINST ("'.$values.'" IN BOOLEAN MODE)', NULL, false);
    $this->db->or_where('MATCH (faq.text) AGAINST ("'.$values.'" IN BOOLEAN MODE)', NULL, false);
    $this->db->order_by('faq.created_on', 'desc');
    $query=$this->db->get();

    if($query->num_rows() > 0) {
          $category = array();
          $result = $query->result_array();
          foreach($result as $row){
          if(!array_key_exists($row['name'], $category)){
            $category[$row['name']] = array();
          }
            $category[$row['name']][] = $row;
          }
            return $category;
        }
        return false;

  }

  /*
  * Update a colum in faq table
  *
  * @param string faq_id
  * @param string title
  * @param string content
  * @param string cat_id
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
  * @Return all query records in the faq table
  */
  public function record_count_faqs()
  {
     return $this->db->count_all('faq');
  }


  /*
  * Create an faq post
  * @insert into faq table
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
  * Search for all categories created
  * @return result of this query
  */
  public function displayAllCategories()
  {
    $this->db->select('*');
    $this->db->from('category');
    $query = $this->db->get();
    return $query->result();
  }

  /*
  * Create a topic
  * @insert into data category table
  *
  * @param string name
  * @param string email
  */
  public function create_category($name, $email)
  {
    $data = array('name'=>$name,'email'=>$email);
    $this->db->insert('category', $data);
  }

  /*
  * Search for a particular topic
  * @return query row if true else false
  *
  * @param string cat_id
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
  * Search for a particular topic and modify it
  *
  * @param string cat_id
  * @param string cat_name
  * @param string cat_email
  */
  public function update_category($cat_id, $cat_name, $cat_email)
  {
    $data = array('name'=>$cat_name, 'email'=>$cat_email);
    $this->db->where('id',$cat_id);
    $this->db->update('category',$data);
  }

  /**
  * Search for multiple topics with an array of values
  * @return string query
  *
  * @param string topics
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
  * Create an enquriy form - insert into enquriy table
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
  * Retrieve enquiry by its status
  * @return array of result if found else return false
  *
  * @param stirng status
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
    * Retrieve an enquiry by its unique id
    * @return array of each row if found else return false
    *
    * @param string enqid
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
    * Update status of a particular enquiry
    *
    * @param string enq_id
    * @param string value
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

    /*
    * Get lastest report send date
    * @return string query row if found else false
    */
    public function getReportDetails()
    {
      $this->db->select('sent_on');
      $this->db->from('monthly_report');
      $this->db->order_by('sent_on','DESC');
      $this->db->limit(1);
      $query = $this->db->get();
      if($query->num_rows() > 0) {
            return $query->row();
        }
          return false;
    }

    /*
    * Add a successfully sent report into report table
    */
    public function saveReport($filename)
    {
      $data = array(
        'filename' => $filename,
        'sent_on' => time()
      );
      $this->db->insert('monthly_report',$data);
    }

}
