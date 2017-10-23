<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="background-color: #f9f9f9; min-height: 100vh;">
  <script type="text/javascript">
  function hideShow() {
    var tog = document.getElementById('adduser-form');
    if (tog.style.display === 'none') {
        tog.style.display = 'block';
    } else {
        tog.style.display = 'none';
    }
  }

  $(document).ready(function(){
      $("#load_more").click(function(e){
  e.preventDefault();
      var page = $(this).data('val');
      getMembers(page);
      });

      $('#search_members').on('submit', function(e){
        e.preventDefault();
        $('#ajax_data').empty();
        $('#load_more').hide();
        $('.clear_res').show();
        var string = $('#search').val();
        if(string == '')
        {
          $('#ajax_data').html('<ul class="helpdeskSearchError"><li>Please search for company or email</li> </ul>');
        }
        else {
            $.ajax({
              url:"<?php echo base_url();?>admin/users/searchMembers",
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
  var getMembers = function(page){
  $("#loader").show();
  $.ajax({
      url:"<?php echo base_url() ?>admin/users/loadMembersReq",
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

  $(document).on('click', '.clear_res', function(event){
    location.href = '<?php echo site_url('/admin/users/members');?>';
  });

  $(document).on('click', '.user-delete-button', function(event){
    var uid = $(this).attr('value');
    var Urlink = '<?php echo site_url('admin/users/delete/');?>'+uid;
    //alert(uid);
    swal({
            title: "Delete user",
            text: "Are you sure you want to delete this user?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ec5310",
            confirmButtonText: "Delete user",
            cancelButtonText: "Cancel"
        }).then(function() {
             location.href = Urlink;
        }, function(dismiss) {
           if (dismiss === 'cancel') {
             //do nothing if cancel
           }
           else {
             throw dismiss;
           }
        });
  });
  </script>
    <div class="wrapper members-title">
        <h1>BDC Members</h1>
        <form method="post" id="search_members" class="admin-search">
            <input type="text" name="search" id="search" placeholder="Search for members"/>
            <input type="submit" value="Search" id="submit_search" class="btn admin-search-btn"/>
        </form>
    </div>
    <section class="members-form-wrapper">
        <div class="wrapper">
            <div class="col-lg-12">
                <span>Add a new member </span> <button onclick="hideShow()">Create new account</button>
            </div>
        </div>
    </section>
    <section class="members-list">
        <div class="wrapper">
            <div class="col-lg-12">
                <div id="adduser-form" style="display:none;">
                    <?php echo form_open('',array('class'=>'form-horizontal'));?>
                    <div class="form-group">
                      <?php echo form_error('company');?>
                      <?php echo form_input('company','','class="form-control" placeholder="Company Name"');?>
                    </div>
                    <div class="form-group">
                      <?php echo form_error('email');?>
                      <?php echo form_input('email','','class="form-control" placeholder="Email"');?>
                    </div>
                    <div class="form-group admin-member-submit">
                        <?php echo form_submit('submit', 'Add user', 'class="btn" style="font-size: 13px;"');?>
                    </div>
                    <?php echo form_close();?>
                </div>
                <div class="top_view" style="width: 680px; text-align: left;">
                <div class="flex" style="margin-bottom: 20px;"><span style="font-weight: bold; margin-top: 50px;">Company</span><span style="font-weight: bold; margin-top: 50px;">Email</span><span style="font-weight: bold; margin-top: 50px; width: 140px;"></span> </div>
                <div id="ajax_data">
                <?php
                if(!empty($users))
                {
                  foreach($users as $user)
                  {
                    echo '<div class="user_view flex" style="padding: 30px 0px; padding-bottom: 20px; border-bottom: 2px solid #acacac; width: 680px;font-family: Whitney;">';
                    echo '<span>'.$user->company.'</span><span>'.$user->email.'</span>'; ?>

                    <a value="<?php echo $user->id;?>" class="user-delete-button"> Delete User </a>
                    <?php
                    echo '</div>';
                  }

                }
                ?>
              </div>
                </div>
                <button class="load-more-btn" data-val="1" id="load_more" style="margin:0px; margin-top: 80px;padding-bottom:80px;"> Load more.. <img id="loader" style="display:none;" src="<?php echo base_url('assets/img/loader.gif');?>"/>
                </button>
            </div>
        </div>
    </section>
</div>
