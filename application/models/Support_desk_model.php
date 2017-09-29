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
  public function displayRecentFaq()
  {
    $this->db->select('*');
    $this->db->from('faq');
    $this->db->join('faq_category','faq.id=faq_category.faq_id','left');
    $this->db->join('category','faq_category.cat_id =category.id','left');
    $this->db->order_by('created_on', 'desc');
    $this->db->limit('5');
    $query=$this->db->get();

    if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

  }

  /**
  *
  */
  public function searchFaq($value)
  {
    $this->db->select('*');
    $this->db->from('faq');
    $this->db->join('faq_category','faq.id=faq_category.faq_id','left');
    $this->db->join('category','faq_category.cat_id =category.id','left');
    $this->db->like('text',$value);
    $this->db->or_like('name',$value);
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


}
