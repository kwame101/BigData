<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <div class="user-profile-title">
       <div class="wrapper">
           <h1>Users Profile </h1>
       </div>
  </div>
  <div class="wrapper">
      <script type="text/javascript">
      $(document).ready(function () {
        $(".top_view tr.tryout").hide();
        $(".top_view td.view_times").on('click',function () {
        if($(this).html() == '<button> View User </button>'){
              $(this).html('<button> Close User </button>');
              $(this).parent('tr').next('tr.tryout').fadeIn();
        }
        else{
              $(this).html('<button> View User </button>');
              $(this).parent('tr').next('tr.tryout').fadeOut();
            }
         });
      });
      </script>
    <?php
    if(!empty($users))
    {
      echo '<div class="top_view">';
      echo '<div class="flex"> <span style="font-weight: bold; margin-top: 50px; width: 250px;">Name</span> <span style="font-weight: bold; margin-top: 50px; width: 250px;">Email</span><span style="font-weight: bold; margin-top: 50px; width: 250px;">Company</span><span style="font-weight: bold; margin-top: 50px; width: 250px;"></span> </div>';
      foreach($users as $user)
      {
        echo '<div class="user_view_container">';
        echo '<div class="user_view">';
        echo '<div class="user_row flex" style="padding: 20px 0px; border-bottom: 2px solid #acacac;">';
        echo '<span style="width: 250px; line-height: 33px;">'.$user->first_name.' '.$user->last_name.'</span><span style="width: 250px; line-height: 33px;">'.$user->email.'</span><span style="width: 250px; line-height: 33px;">'.$user->company.'</span>'; ?>

        <span style="width: 250px;"><button class="view-user-profile" style="float: right; padding: 10px 40px; border-radius: 2px; background: #ec5310; color: white;"> View User </button></span>
        <?php
        echo '</div>';
        echo '</div>';
        echo '<div class="tryout" style="margin: 0 auto; border-bottom: 2px solid #acacac; background: #f9f9f9; display: none;">';
        echo '<div class="flex" style="padding: 20px 100px;"> <span style="font-weight: bold; width: 150px;">Date</span> <span style="font-weight: bold; width: 150px;">Time in</span><span style="font-weight: bold; width: 150px;">Time out</span><span style="font-weight: bold; width: 150px;">Time spent</span></div>';
        foreach($users as $user)
        {
          echo '<div class="user-view" style="padding: 0px 100px; background: #fff;">';
          echo '<div class="user_row flex" style="padding: 5px 0px;">';
          echo '<span style="width: 150px;">'.$user->first_name.' '.$user->last_name.'</span><span style="width: 150px;">'.$user->email.'</span><span style="width: 150px;">'.$user->company.'</span><span style="width: 150px;">test</span>';
          echo '</div>';
          echo '</div>';
        }
        echo '<div style="padding: 20px 100px" text-align="right">';
        echo '<div style="float: right;">';
        echo '<span style="text-align:right; font-weight: bold; margin-right: 30px;">Total:</span><span style="color: #EC5310;">000000</span>';
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
