<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <div class="user-profile-title">
       <div class="wrapper">
           <h1>Users Profile </h1>
       </div>
  </div>
  <div class="wrapper">
    <?php
    if(!empty($users))
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
      echo '<div class="top_view">';
      echo '<div class="flex" style="margin-top: 50px; margin-bottom: 20px; font-family: Whitney;"> <span style="font-weight: bold; width: 250px;">Name</span> <span style="font-weight: bold; width: 250px;">Email</span><span style="font-weight: bold; width: 250px;">Company</span><span style="font-weight: bold; width: 250px;"></span> </div>';
      foreach($users as $user)
      {
        $sumTotal = null;
        $new_date = array();
        echo '<div class="user_view_container">';
        echo '<div class="user_view">';
        echo '<div class="user_row flex" style="padding: 20px 0px; border-bottom: 2px solid #acacac;">';
        echo '<span style="width: 250px; line-height: 33px;">'.$user->user_full_name.'</span><span style="width: 250px; line-height: 33px;">'.$user->email.'</span><span style="width: 250px; line-height: 33px;">'.$user->company.'</span>'; ?>

        <span style="width: 250px;"><button class="view-user-profile" style="float: right; padding: 10px 40px; border-radius: 2px; background: #ec5310; color: white; font-size: 13px;"> View User </button></span>
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
        echo '<span style="text-align:right; font-weight: bold; margin-right: 30px;">Total:</span><span style="color: #EC5310; font-weight: bold;">'.addTime($new_date).'</span>';
        echo '</div>';
        echo '<div class="clearFix"></div>';
        echo '</div>';
        echo '</div></div>';
      }
     echo '</div>';
    }
    ?>
    </div>
  </div>
</div>
