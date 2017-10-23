<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#load_more").click(function(e){
    e.preventDefault();
        var page = $(this).data('val');
        getUserProfile(page);
        });
        $('#search_userp').on('submit', function(e){
          e.preventDefault();
          $('#ajax_data').empty();
          $('#load_more').hide();
          $('.clear_data').show();
          var string = $('#search').val();
          if(string == '')
          {
            $('#ajax_data').html('<ul class="helpdeskSearchError"><li>Please search for name, email or company.</li> </ul>');
          }
          else {
              $.ajax({
                url:"<?php echo base_url();?>admin/users/searchUserProfile",
                method:"post",
                data: {'search': string},
                cache:false,
              }).done(function(data){
                  if(data == ''){
                    $('#ajax_data').html('<ul class="helpdeskSearchError" ><li>No results found for: '+ string +'.</li> </ul>');
                  }
                  else
                  {
                    $("#ajax_data").append(data);
                  }
              });
          }
      });
    });
    var getUserProfile = function(page){
    $("#loader").show();
    $.ajax({
        url:"<?php echo base_url() ?>admin/users/loadUserProfile",
        type:'GET',
        data: {page:page}
      }).done(function(response){
        $("#ajax_data").append(response);
        $("#loader").hide();
        $('#load_more').data('val', ($('#load_more').data('val')+1));
        scroll();
        });
    };
    var scroll  = function(){
        $('html, body').animate({
        scrollTop: $('#load_more').offset().top
        }, 1000);
    };
    $(document).on('click', '.clear_data', function(event){
      location.href = '<?php echo site_url('/admin/users');?>';
    });
</script>
<div class="container">
    <div class="user-profile-title">
        <div class="wrapper">
            <h1>Users Profile </h1>
            <form method="post" id="search_userp" class="admin-search">
                <input type="text" name="search" id="search" placeholder="Search for users"/>
                <input type="submit" value="Search" id="submit_search" class="btn admin-search-btn"/>
            </form>
            <!-- <button class="clear_data" style="display:none;">Clear results </button> -->
        </div>
    </div>
    <div class="wrapper">
        <div class="top_view">
            <div class="flex" style="margin-top: 50px; margin-bottom: 20px; font-family: Whitney;"> <span style="font-weight: bold; width: 250px;">Name</span> <span style="font-weight: bold; width: 250px;">Email</span><span style="font-weight: bold; width: 250px;">Company</span><span style="font-weight: bold; width: 250px;"></span> </div>
            <div id="ajax_data">
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
                    echo '<span style="text-align:right; font-weight: bold; margin-right: 30px;">Total:</span><span style="color: #EC5310; font-weight: bold;">'.addTime($new_date).'</span>';
                    echo '</div>';
                    echo '<div class="clearFix"></div>';
                    echo '</div>';
                    echo '</div></div>';
                    }
                    }
                    ?>
            </div>
        </div>
        <button class="load-more-btn" data-val="1" id="load_more"> Load more.. <img id="loader" style="display:none;" src="<?php echo base_url('assets/img/loader.gif');?>"/>
        </button>
    </div>
</div>
