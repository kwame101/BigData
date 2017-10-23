<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="background-color: #f9f9f9; min-height: 100vh;">
  <script type="text/javascript">
  function hideShow() {
    var tog = document.getElementById('adduser');
    if (tog.style.display === 'none') {
        tog.style.display = 'block';
    } else {
        tog.style.display = 'none';
    }
  }

  $(document).on('click', '.user-delete-button', function(event){
    var uid = $(this).attr('value');
    var Urlink = '<?php echo site_url('admin/users/deleteAdmin/');?>'+uid;
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
    <h1>Admin profile</h1>
    </div>
    <section class="admin-view-title">
        <div class="wrapper">
            <span>Add a new admin </span> <button onclick="hideShow()">Create new account</button>
        </div>
    </section>
    <div class="add-admin-container">
        <div class="wrapper">
              <div id="adduser" style="display:none;">
              <?php echo form_open('',array('class'=>'form-horizontal addadmin'));?>
              <div class="form-group">
                <?php
                echo form_error('first_name');
                echo form_input('first_name',set_value('first_name'),'class="form-control" placeholder="First name"');
                ?>
              </div>
              <div class="form-group">
                <?php
                echo form_error('last_name');
                echo form_input('last_name',set_value('last_name'),'class="form-control" placeholder="Last name"');
                ?>
              </div>
                <div class="form-group">
                  <?php echo form_error('email');?>
                  <?php echo form_input('email','','class="form-control" placeholder="Email"');?>
                </div>
                <div class="form-group">
                  <?php
                  echo form_error('password');
                  echo form_password('password','','class="form-control" placeholder="Password"');
                  ?>
                </div>
                <div class="form-group">
                  <?php
                  echo form_error('password_confirm');
                  echo form_password('password_confirm','','class="form-control" placeholder="Password confirm"');
                  ?>
                </div>
                <div class="form-group">
                    <?php echo form_submit('submit', 'Add admin', 'class="btn"');?>
                </div>
              <?php echo form_close();?>
            </div>
        </div>
    </div>
    <section class="members-list" style="padding: 40px; padding-top:0px;">
        <div class="wrapper">
            <?php
            if(!empty($users))
            {
              echo '<div class="top_view" style="width: 680px; text-align: left;">';
              echo '<div class="flex" style="margin-bottom: 20px; font-family: Whitney;"><span style="font-weight: bold; margin-top: 50px;">Company</span><span style="font-weight: bold; margin-top: 50px;">Email</span><span style="font-weight: bold; margin-top: 50px; width: 140px;"></span> </div>';
              foreach($users as $user)
              {
                echo '<div class="user_view flex" style="padding: 30px 0px; padding-bottom: 20px; border-bottom: 2px solid #acacac; width: 680px; font-family: Whitney;">';
                echo '<span>'.$user->company.'</span><span>'.$user->email.'</span>'; ?>

                <a class="user-delete-button" value="<?php echo $user->id;?>"> Delete Admin </a>
                <?php
                echo '</div>';
              }
             echo '</div>';
            }
            ?>
        </div>
    </section>
</div>
