<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="background-color: #f9f9f9; min-height: 100vh;">
    <div class="user-profile-title">
       <div class="wrapper">
           <h1>Users Report </h1>
       </div>
  </div>

  <div class="report_update">
      <div class="wrapper">
        <p>Generate members usage report</p>
        <a href="<?php echo site_url('admin/users/exportReportCSV');?>" style="margin-right: 10px;">Download as CSV</a>
        <a href="<?php echo site_url('admin/users/exportReportPDF');?>">Download as PDF</a>
      </div>
  </div>

  <section class="report_list">
      <div class="wrapper">
        <?php
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
          date_default_timezone_set("UTC");
          echo '<div class="top_view">';
          echo '<div class="flex"> <span style="font-weight: bold; margin-top: 50px; width: 250px;">Name</span> <span style="font-weight: bold; margin-top: 50px; width: 250px;">Email</span><span style="font-weight: bold; margin-top: 50px; width: 250px;">Company</span><span style="font-weight: bold; margin-top: 50px; width: 250px;">Total Time</span></div>';
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
         echo '</div>';
        }
        ?>
        </div>
    </section>
  </div>
</div>
