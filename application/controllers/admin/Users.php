<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','You are not allowed to visit the Groups page');
      redirect('admin','refresh');
    }
  }

  public function index($group_id = NULL)
{
  $this->data['page_title'] = 'Users';
  //$this->data['users'] = $this->ion_auth->users($group_id)->result();
  if($group_id == null){$group_id = 2;}
  $this->data['users'] = $this->ion_auth->usersProfile($group_id)->result();
  $this->data['logged_info'] = $this->ion_auth->activityDetails()->result();
  $this->render('admin/users/list_users_view');
}


  public function create()
  {
    $this->data['page_title'] = 'Create user';
 $this->load->library('form_validation');
 $this->form_validation->set_rules('first_name','First name','trim');
 $this->form_validation->set_rules('last_name','Last name','trim');
 $this->form_validation->set_rules('company','Company','trim');
 $this->form_validation->set_rules('username','Username','trim|required|is_unique[users.username]');
 $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]');
 $this->form_validation->set_rules('password','Password','required');
 $this->form_validation->set_rules('password_confirm','Password confirmation','required|matches[password]');
 $this->form_validation->set_rules('groups[]','Groups','required|integer');

 if($this->form_validation->run()===FALSE)
 {
   $this->data['groups'] = $this->ion_auth->groups()->result();
   $this->load->helper('form');
   $this->render('admin/users/create_user_view');
 }
 else
 {
   $username = $this->input->post('username');
   $email = $this->input->post('email');
   $password = $this->input->post('password');
   $group_ids = $this->input->post('groups');

   $additional_data = array(
     'first_name' => $this->input->post('first_name'),
     'last_name' => $this->input->post('last_name'),
     'company' => $this->input->post('company')
   );
   if(in_array('1',$group_ids,true)){
    $this->ion_auth->register_admin($username, $password, $email, $additional_data, $group_ids);
   }
   else{
     $this->ion_auth->register_others($username, $password, $email, $additional_data, $group_ids);
   }
   $this->session->set_flashdata('message',$this->ion_auth->messages());
   redirect('admin/users','refresh');
 }
  }

  /*
  *
  */
  public function members()
  {
    $this->data['page_title'] = 'BDC Members';
    $this->load->library('form_validation');
    $this->form_validation->set_rules('company','Company','trim|required');
    $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]');

    if($this->form_validation->run()===FALSE)
    {
      $this->data['users'] = $this->ion_auth->users(2)->result();
      $this->load->helper('form');
      $this->render('admin/users/list_members_view');
    }
    else
    {
      $username = $this->input->post('email');
      $email = $this->input->post('email');
      $password = 'default_user';
      $group_ids = array(2);
      $additional_data = array(
        'first_name' => null,
        'last_name' => null,
        'company' => $this->input->post('company')
      );

      $this->ion_auth->register_others($username, $password, $email, $additional_data,$group_ids);
      $this->session->set_flashdata('message',$this->ion_auth->messages());
      redirect('admin/users/members','refresh');
    }
  }

  /*
  *
  */
  public function admins()
  {
    $this->data['page_title'] = 'BDC Admin';
    $this->load->library('form_validation');
    $this->form_validation->set_rules('first_name','First name','trim');
    $this->form_validation->set_rules('last_name','Last name','trim');
    $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password','Password','required');
    $this->form_validation->set_rules('password_confirm','Password confirmation','required|matches[password]');

    if($this->form_validation->run()===FALSE)
    {
      $this->data['users'] = $this->ion_auth->users(1)->result();
      $this->load->helper('form');
      $this->render('admin/users/list_admins_view');
    }
    else
    {
      $username = $this->input->post('email');
      $email = $this->input->post('email');
      $password = $this->input->post('password');;
      $group_ids = array(1);

      $additional_data = array(
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'company' => null
      );

      $this->ion_auth->register_admin($username, $password, $email, $additional_data, $group_ids);
      $this->session->set_flashdata('message',$this->ion_auth->messages());
      redirect('admin/users/admins','refresh');
    }
  }

  public function edit($user_id = NULL)
{
  $user_id = $this->input->post('user_id') ? $this->input->post('user_id') : $user_id;
  $this->data['page_title'] = 'Edit user';
  $this->load->library('form_validation');

  $this->form_validation->set_rules('first_name','First name','trim');
  $this->form_validation->set_rules('last_name','Last name','trim');
  $this->form_validation->set_rules('company','Company','trim');
  $this->form_validation->set_rules('username','Username','trim|required');
  $this->form_validation->set_rules('email','Email','trim|required|valid_email');
  $this->form_validation->set_rules('password','Password','min_length[6]');
  $this->form_validation->set_rules('password_confirm','Password confirmation','matches[password]');
  $this->form_validation->set_rules('groups[]','Groups','required|integer');
  $this->form_validation->set_rules('user_id','User ID','trim|integer|required');

  if($this->form_validation->run() === FALSE)
  {
    if($user = $this->ion_auth->user((int) $user_id)->row())
    {
      $this->data['user'] = $user;
    }
    else
    {
      $this->session->set_flashdata('message', 'The user doesn\'t exist.');
      redirect('admin/users', 'refresh');
    }
    $this->data['groups'] = $this->ion_auth->groups()->result();
    $this->data['usergroups'] = array();
    if($usergroups = $this->ion_auth->get_users_groups($user->id)->result())
    {
      foreach($usergroups as $group)
      {
        $this->data['usergroups'][] = $group->id;
      }
    }
    $this->load->helper('form');
    $this->render('admin/users/edit_user_view');
  }
  else
  {
    $user_id = $this->input->post('user_id');
    $new_data = array(
      'username' => $this->input->post('username'),
      'email' => $this->input->post('email'),
      'first_name' => $this->input->post('first_name'),
      'last_name' => $this->input->post('last_name'),
      'company' => $this->input->post('company')
    );
    if(strlen($this->input->post('password'))>=6) $new_data['password'] = $this->input->post('password');

    $this->ion_auth->update($user_id, $new_data);

    //Update the groups user belongs to
    $groups = $this->input->post('groups');
    if (isset($groups) && !empty($groups))
    {
      $this->ion_auth->remove_from_group('', $user_id);
      foreach ($groups as $group)
      {
        $this->ion_auth->add_to_group($group, $user_id);
      }
    }

    $this->session->set_flashdata('message',$this->ion_auth->messages());
    redirect('admin/users','refresh');
  }
}

/*
*
*/
public function reports()
{
  $this->data['users'] = $this->ion_auth->usersProfile(2)->result();
  $this->data['logged_info'] = $this->ion_auth->activityDetails()->result();
  $this->render('admin/users/list_reports_view');
}


  /*
  *
  */
  public function exportReportCSV()
  {
    $this->load->library("Excel");
    date_default_timezone_set('Europe/London');
    $currentdate = date("d_m_Y");

    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();

    // Set document properties
    $objPHPExcel->getProperties()->setCreator("Test test")
    ->setLastModifiedBy("System")
    ->setTitle("System")
    ->setSubject("Test System")
    ->setDescription("Test Report")
    ->setKeywords("office 2007")
    ->setCategory("Test");

    // Create the worksheet
    $objPHPExcel->setActiveSheetIndex(0);

    $objPHPExcel->getActiveSheet()->setCellValue('A1', "Dummy message for later");
  /* ->setCellValue('B1', "Email")
   ->setCellValue('C1', "Company")
   ->setCellValue('D1', "Total Time");

   $objPHPExcel->getActiveSheet()->setCellValue('A4', "Date")
  ->setCellValue('B4', "Time in")
  ->setCellValue('C4', "Time out")
  ->setCellValue('D4', "Time spent");
  */

   function addTime($times) {
    $seconds = 0;
      foreach ($times as $time)
      {
        list($hour,$minute,$second) = explode(':', $time);
          $seconds += $hour*3600;
          $seconds += $minute*60;
          $seconds += $second;
        }
        $hours = floor($seconds/3600);
        $seconds -= $hours*3600;
        $minutes  = floor($seconds/60);
        $seconds -= $minutes*60;
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }


    $result = $this->ion_auth->usersProfile(2)->result_array();
    $logged =  $this->ion_auth->activityDetails()->result_array();
    $dataArray= array();
    $countRes = sizeof($result);
    //for($i=0;$i <=$countRes;$i++)
  //  {
      foreach($result as $row) {
        $sumTotal = null;
        $new_date = array();
      //$uid = $row['id'];


      //{
      	$tn = $row['user_full_name'];
        $dataArray= array();
      	$objWorksheet = new PHPExcel_Worksheet($objPHPExcel);
      	$objPHPExcel->addSheet($objWorksheet);
      	$objWorksheet->setTitle(''. $tn);
      	//$uid = $row['id'];
    //  }
         $row_array['user_full_name'] = $row['user_full_name'];
         $row_array['email'] = $row['email'];
         $row_array['company'] = $row['company'];
         //iterate over times
         $i = 5;
         foreach($logged as $log ){
           $dataSes = array();
           $total = null;
       if ($row['id'] == $log['user_id']) {
        // if($log['last_seen'] != $log['logged_in'] && isset($log['last_seen'])){
           $loggedout = DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',$log['last_seen']));
           $loggedin = DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',$log['logged_in']));
           $total =  $loggedout->diff($loggedin);
           $sumTotal = sprintf(
             '%d:%02d:%02d',
            ($total->d * 24) + $total->h,
            $total->i,
            $total->s
           );
           $datainfo['date'] = date('d/m/y',$log['logged_in']).'  -  '.date('d/m/y',$log['last_seen']);
           $datainfo['time in'] = date('H:i:s',$log['logged_in']);
           $datainfo['time out'] =date('H:i:s',$log['last_seen']);
           $datainfo['time spent'] = $sumTotal;

           array_push($dataSes,$datainfo);

           $objWorksheet->fromArray($dataSes, NULL, 'A'.$i);

           array_push($new_date, $sumTotal);
          //}
         }
          $row_array['id'] = addTime($new_date);
          $i++;
         }
         array_push($dataArray,$row_array);

         $objWorksheet->setCellValue('A1', "Name")
        ->setCellValue('B1', "Email")
        ->setCellValue('C1', "Company")
        ->setCellValue('D1', "Total Time");

        $objWorksheet->setCellValue('A4', "Date")
       ->setCellValue('B4', "Time in")
       ->setCellValue('C4', "Time out")
       ->setCellValue('D4', "Time spent");

         $objWorksheet->fromArray($dataArray, NULL, 'A2');

     }
    //}

    //$objPHPExcel->getActiveSheet()->fromArray($dataArray, NULL, 'A2');

    // Save Excel 2007 file
    #echo date('H:i:s') . " Write to Excel2007 format\n";
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    ob_end_clean();
    // We'll be outputting an excel file
    header('Content-type: application/vnd.ms-excel');
    // It will be called file.xls
    header('Content-Disposition: attachment; filename="test_'.$currentdate.'.xls"');
    $objWriter->save('php://output');
    //SaveViaTempFile($objWriter);
    Exit;
  }

  /*
  *
  */
  public function exportReportPDF()
  {

  }

  public function delete($user_id = NULL)
  {
    if(is_null($user_id))
  {
    $this->session->set_flashdata('message','There\'s no user to delete');
  }
    else
  {
    $this->ion_auth->delete_user($user_id);
    $this->session->set_flashdata('message',$this->ion_auth->messages());
   }
   redirect('admin/users/members','refresh');
  }

}
