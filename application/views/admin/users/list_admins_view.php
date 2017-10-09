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

                <div class="user-delete-button"><a href="<?php echo site_url('admin/users/delete/'.$user->id);?>"> Delete Admin </a></div>
                <?php
                echo '</div>';
              }
             echo '</div>';
            }
            ?>
        </div>
    </section>
</div>
