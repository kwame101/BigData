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

  /*
  *
  */
  public function index($group_id = NULL)
  {
  $this->data['page_title'] = 'Users';
  //$this->data['users'] = $this->ion_auth->users($group_id)->result();
  if($group_id == null){$group_id = 2;}
  $this->data['users'] = $this->ion_auth->usersProfileReq($group_id, 0)->result();
  $this->data['logged_info'] = $this->ion_auth->activityDetails()->result();

  $this->render('admin/users/list_users_view');
 }

/*
*
*/
public function loadUserProfile()
{
  $page = $this->input->get('page');
  $users = $this->ion_auth->usersProfileReq(2, $page)->result();
  $logged_info = $this->ion_auth->activityDetails()->result();
  if(!empty($users))
  {
  foreach($users as $user)
  {
    $sumTotal = null;
    $new_date = array();
    echo '<div class="user_view_container">';
    echo '<div class="user_view">';
    echo '<div class="user_row flex" style="padding: 20px 0px; border-bottom: 2px solid #acacac;">';
    echo '<span style="width: 250px; line-height: 33px;">'.$user->user_full_name.'</span><span style="width: 250px; line-height: 33px;">'.$user->email.'</span><span style="width: 250px; line-height: 33px;">'.$user->company.'</span>'; ?>

    <span style="width: 250px;"><button class="view-user-profile"> View User </button></span>
    <?php
    echo '</div>';
    echo '</div>';
    echo '<div class="tryout" style="margin: 0 auto; border-bottom: 2px solid #acacac; background: #f9f9f9; display: none;">';
    echo '<div class="flex" style="padding: 20px 100px; font-family: Whitney;"> <span style="font-weight: bold; width: 150px;">Date</span> <span style="font-weight: bold; width: 150px;">Time in</span><span style="font-weight: bold; width: 150px;">Time out</span><span style="font-weight: bold; width: 150px;">Time spent</span></div>';
    echo '<div class="user-view-container">';
     foreach($logged_info as $logged)
      {
        $total = null;
        if($user->id == $logged->user_id) {
            $loggedout = DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',$logged->last_seen));
            $loggedin = DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',$logged->logged_in));
            $total =  $loggedout->diff($loggedin);
            $value = sprintf(
                '%d:%02d:%02d',
               ($total->d * 24) + $total->h,
                $total->i,
                $total->s
              );
              array_push($new_date, $value);
      echo '<div class="user-view" style="padding: 0px 100px; background: #fff;">';
      echo '<div class="user_row flex" style="padding: 7px 0px; font-family: Whitney;">';
      echo '<span style="width: 150px;">'.date('d/m/y',$logged->logged_in).'</span><span style="width: 150px;">'.date('H:i:s',$logged->logged_in).'</span><span style="width: 150px;">'.date('H:i:s',$logged->last_seen).'</span><span style="width: 150px; font-weight: bold;">'.$value.'</span>';
      echo '</div>';
      echo '</div>';
        } }
      echo '</div>';
    echo '<div style="padding: 20px 100px" text-align="right">';
    echo '<div style="float: right; font-family: Whitney;">';
    echo '<span style="text-align:right; font-weight: bold; margin-right: 30px;">Total:</span><span style="color: #EC5310; font-weight: bold;">'.$this->addTime($new_date).'</span>';
    echo '</div>';
    echo '<div class="clearFix"></div>';
    echo '</div>';
    echo '</div></div>';
    }
  }
}

  /*
  *
  */
  public function searchUserProfile()
  {
    $search = $this->input->post('search');
    $users = $this->ion_auth->usersProfileOnSearch(2,$search)->result();
    $logged_info = $this->ion_auth->activityDetails()->result();

    if(!empty($users))
    {
    foreach($users as $user)
    {
      $sumTotal = null;
      $new_date = array();
      echo '<div class="user_view_container">';
      echo '<div class="user_view">';
      echo '<div class="user_row flex" style="padding: 20px 0px; border-bottom: 2px solid #acacac;">';
      echo '<span style="width: 250px; line-height: 33px;">'.$user->user_full_name.'</span><span style="width: 250px; line-height: 33px;">'.$user->email.'</span><span style="width: 250px; line-height: 33px;">'.$user->company.'</span>'; ?>

      <span style="width: 250px;"><button class="view-user-profile"> View User </button></span>
      <?php
      echo '</div>';
      echo '</div>';
      echo '<div class="tryout" style="margin: 0 auto; border-bottom: 2px solid #acacac; background: #f9f9f9; display: none;">';
      echo '<div class="flex" style="padding: 20px 100px; font-family: Whitney;"> <span style="font-weight: bold; width: 150px;">Date</span> <span style="font-weight: bold; width: 150px;">Time in</span><span style="font-weight: bold; width: 150px;">Time out</span><span style="font-weight: bold; width: 150px;">Time spent</span></div>';
      echo '<div class="user-view-container">';
       foreach($logged_info as $logged)
        {
          $total = null;
          if($user->id == $logged->user_id) {
              $loggedout = DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',$logged->last_seen));
              $loggedin = DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',$logged->logged_in));
              $total =  $loggedout->diff($loggedin);
              $value = sprintf(
                  '%d:%02d:%02d',
                 ($total->d * 24) + $total->h,
                  $total->i,
                  $total->s
                );
                array_push($new_date, $value);
        echo '<div class="user-view" style="padding: 0px 100px; background: #fff;">';
        echo '<div class="user_row flex" style="padding: 7px 0px; font-family: Whitney;">';
        echo '<span style="width: 150px;">'.date('d/m/y',$logged->logged_in).'</span><span style="width: 150px;">'.date('H:i:s',$logged->logged_in).'</span><span style="width: 150px;">'.date('H:i:s',$logged->last_seen).'</span><span style="width: 150px; font-weight: bold;">'.$value.'</span>';
        echo '</div>';
        echo '</div>';
          } }
        echo '</div>';
      echo '<div style="padding: 20px 100px" text-align="right">';
      echo '<div style="float: right; font-family: Whitney;">';
      echo '<span style="text-align:right; font-weight: bold; margin-right: 30px;">Total:</span><span style="color: #EC5310; font-weight: bold;">'.$this->addTime($new_date).'</span>';
      echo '</div>';
      echo '<div class="clearFix"></div>';
      echo '</div>';
      echo '</div></div>';
      }
    }
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
      $this->data['users'] = $this->ion_auth->membersDetailsReq(2,0)->result();
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
  public function loadMembersReq()
  {
    $page = $this->input->get('page');
    $users = $this->ion_auth->membersDetailsReq(2,$page)->result();
    if(!empty($users)){
      foreach($users as $user)
      {
        echo '<div class="user_view flex" style="padding: 30px 0px; padding-bottom: 20px; border-bottom: 2px solid #acacac; width: 680px;">';
        echo '<span>'.$user->company.'</span><span>'.$user->email.'</span>'; ?>

        <a href="<?php echo site_url('admin/users/delete/'.$user->id);?>" class="user-delete-button"> Delete User </a><?php
        echo '</div>';
      }
    }
  }

  /*
  *
  */
  public function searchMembers()
  {
    $search = $this->input->post('search');
    $users = $this->ion_auth->membersDetailsOnSearch(2,$search)->result();
    if(!empty($users)){
      foreach($users as $user)
      {
        echo '<div class="user_view flex" style="padding: 30px 0px; padding-bottom: 20px; border-bottom: 2px solid #acacac; width: 680px;">';
        echo '<span>'.$user->company.'</span><span>'.$user->email.'</span>'; ?>

        <a href="<?php echo site_url('admin/users/delete/'.$user->id);?>" class="user-delete-button"> Delete User </a><?php
        echo '</div>';
      }
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


/*
*
*/
public function reports()
{
  $this->data['users'] = $this->ion_auth->usersProfileReq(2,0)->result();
  $this->data['logged_info'] = $this->ion_auth->activityDetails()->result();
  $this->render('admin/users/list_reports_view');
}

/*
*
*/
public function loadReports()
{
  $page = $this->input->get('page');
  $users = $this->ion_auth->usersProfileReq(2,$page)->result();
  $logged_info = $this->ion_auth->activityDetails()->result();
  if(isset($users))
  {
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
    date_default_timezone_set("Europe/London");
        foreach($users as $user)
    {
      $sumTotal = null;
      $new_date = array();
      foreach($logged_info as $logged)
       {
         $total = null;
         if($user->id == $logged->user_id) {
           if($logged->last_seen != $logged->logged_in && isset($logged->last_seen)){
             $loggedout = DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',$logged->last_seen));
             $loggedin = DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',$logged->logged_in));
             $total =  $loggedout->diff($loggedin);
             $sumTotal = sprintf(
               '%d:%02d:%02d',
              ($total->d * 24) + $total->h,
              $total->i,
              $total->s
             );
             array_push($new_date, $sumTotal);
           }
         }
       }
      echo '<div class="user_view_container">';
      echo '<div class="user_view">';
      echo '<div class="user_row flex" style="padding: 20px 0px; border-bottom: 2px solid #acacac;">';
      echo '<span style="width: 250px; line-height: 33px;">'.$user->user_full_name.'</span><span style="width: 250px; line-height: 33px;">'.$user->email.'</span><span style="width: 250px; line-height: 33px;">'.$user->company.'</span>';
      echo '<span style="width: 250px; line-height: 33px; color: #EC5310; font-weight: bold;">'.addTime($new_date).'</span>';
      echo '</div>';
      echo '</div></div>';
   }
  }
}


  /*
  *
  */
  public function exportReportCSV()
  {
    $this->load->library("Excel");
    date_default_timezone_set('Europe/London');
    $currentdate = date("d_m_Y");
    $getDate = date("l, jS F, Y");

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

    $objPHPExcel->getActiveSheet()->setCellValue('A1', "BigDataCorridor Report");
    $objPHPExcel->getActiveSheet()->setCellValue('A3', $getDate);
    $objPHPExcel->getActiveSheet()->setCellValue('A5', "Navigate through the worksheet to see each user activity");
    //set bold
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
    //set font size
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(28);
    $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(16);
    $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setSize(16);
  /* ->setCellValue('B1', "Email")
   ->setCellValue('C1', "Company")
   ->setCellValue('D1', "Total Time");

   $objPHPExcel->getActiveSheet()->setCellValue('A4', "Date")
  ->setCellValue('B4', "Time in")
  ->setCellValue('C4', "Time out")
  ->setCellValue('D4', "Time spent");
  */

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
         $i = 2;
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
           $datainfo['date'] = date('d/m/YY',$log['logged_in']);
           $datainfo['time in'] = date('H:i:s',$log['logged_in']);
           $datainfo['time out'] =date('H:i:s',$log['last_seen']);
           $datainfo['time spent'] = $sumTotal;

           array_push($dataSes,$datainfo);

           $objWorksheet->fromArray($dataSes, NULL, 'E'.$i);

           array_push($new_date, $sumTotal);
          //}
         }
          $row_array['id'] = $this->addTime($new_date);
          $i++;
         }
         array_push($dataArray,$row_array);

         $objWorksheet->setCellValue('A1', "Name")
        ->setCellValue('B1', "Email")
        ->setCellValue('C1', "Company")
        ->setCellValue('D1', "Total Time");

        $objWorksheet->setCellValue('E1', "Date")
       ->setCellValue('F1', "Time in")
       ->setCellValue('G1', "Time out")
       ->setCellValue('H1', "Time spent");

        $objWorksheet->getStyle('A1:H1')->getFont()->setBold(true);
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
   protected function addTime($times) {
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


  /*
  *
  */
  public function exportReportPDF()
  {
    $this->load->library("Pdf_report");
    date_default_timezone_set('Europe/London');
    $currentdate = date("d_m_Y");
    $getDate = date("l jS F Y");

    // create new PDF document
    $pdf = new Pdf_report(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator('Admin tester');
    $pdf->SetAuthor('Admin tester');
    $pdf->SetTitle('BigDataCorridor Report');
    $pdf->SetSubject('BigDataCorridor report');
    $pdf->SetKeywords('PDF, report, bigdata, form, html, data');

    $PDF_HEADER_LOGO = 'logo_example.jpg';
    $pdf->Image('@' . $PDF_HEADER_LOGO);
    $PDF_HEADER_LOGO_WIDTH = '20';
    $PDF_HEADER_TITLE = 'BigDataCorridor Report';
    // set default header data
    $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE,NULL);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    	require_once(dirname(__FILE__).'/lang/eng.php');
    	$pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('helvetica', '', 12);
    // remove default header
    $pdf->setPrintHeader(false);
    //remove default footer
    $pdf->setPrintFooter(false);
    // add a page
    $pdf->AddPage();
        // -- set new background ---
    // get the current page break margin
    $bMargin = $pdf->getBreakMargin();
    // get current auto-page-break mode
    $auto_page_break = $pdf->getAutoPageBreak();
    // disable auto-page-break
    $pdf->SetAutoPageBreak(false, 0);
    // set bacground image
    $img_file = K_PATH_IMAGES.'pdf_doc.jpg';
    $pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
    // restore auto-page-break status
    $pdf->SetAutoPageBreak($auto_page_break, $bMargin);
    // set the starting point for the page content
    $pdf->setPageMark();
    $pdf->Ln(128);

    //date info
    $date_info = '<span style="color:white;font-size:20px;">'.$getDate.'</span>';
    $pdf->writeHTML($date_info, true, false, true, false, '');

    $pdf->Ln(5);
    // Page title 1
    $page_info = '<div style="color:white;font-weight:bold;font-size:48px;">BigDataCorridor</div>';
    $pdf->writeHTML($page_info, true, false, true, false, '');
    //$pdf->Ln(1);
    // Page title 2
    $page_info = '<div style="color:white;font-weight:bold;font-size:48px;">User Report</div>';
    $pdf->writeHTML($page_info, true, false, true, false, '');



    $result = $this->ion_auth->usersProfile(2)->result_array();
    $logged =  $this->ion_auth->activityDetails()->result_array();
    foreach($result as $row){
      $new_date = array();
      //set default header to true
      $pdf->setPrintHeader(true);
      // add a page
      $pdf->AddPage();
      //set default footer to true
      $pdf->setPrintFooter(true);
      $pdf->Ln(10);

      $html_info = '<h1>'.$row['company'].'</h1><table><tr>
                    <th style="font-size:12px;font-weight:bold;color:#8ba5c3;">Name: <span style="color:black;">'.$row['user_full_name'].'</span></th>
                    <th style="font-size:12px;font-weight:bold;color:#8ba5c3;">Email: <span style="color:black;">'.$row['email'].'</span></th>';
      $table_info = '<h1></h1><table style="border:1px solid #000; padding:6px;">';
      $table_info .= '<tr> <th style="border:1px solid #000; padding:6px; font-weight: bold; width: 150px;">
                      Date</th> <th style="border:1px solid #000; padding:6px;font-weight: bold; width: 150px;">Time in</th><th
                      style="border:1px solid #000; padding:6px;font-weight: bold; width: 150px;">Time out</th><th style="font-weight: bold;
                       width: 150px;border:1px solid #000; padding:6px;">Time spent</th></tr>';

      foreach($logged as $log){
        if ($row['id'] == $log['user_id']) {
            $loggedout = DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',$log['last_seen']));
            $loggedin = DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',$log['logged_in']));
            $total =  $loggedout->diff($loggedin);
            $sumTotal = sprintf(
              '%d:%02d:%02d',
             ($total->d * 24) + $total->h,
             $total->i,
             $total->s
            );
            $table_info .= '<tr>
                          <td style="border:1px solid #000; padding:6px;">'
                          .date('d/m/y',$log['logged_in']).'</td><td style="border:1px solid #000; padding:6px;">'.date('H:i:s',$log['logged_in']).
                          '</td><td style="border:1px solid #000; padding:6px;">'.date('H:i:s',$log['last_seen']).'</td>
                            <td style="border:1px solid #000; padding:6px;">'.$sumTotal.'</td></tr>';
            array_push($new_date, $sumTotal);
          }

      }

      $table_info .= '</table>';

      $html_info .=  '<th style="font-size:12px;font-weight:bold;color:#8ba5c3;text-align:center;">Total time: <span style="color:black;">'.$this->addTime($new_date).'</span></th></tr></table>';

      // output the HTML content
      $pdf->writeHTML($html_info, true, false, true, false, '');
      // output the HTML content
      $pdf->writeHTMLCell(0 , 0,'','',$table_info, 0, 1, 0, true, 'C', true);

    }

    //force download pdf D - download I - view
    $pdf->Output('Report_'.$currentdate.'.pdf','D');
  }

}
