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
  </script>
    <div class="wrapper members-title">
    <h1>BDC Members</h1>
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
                <?php
                if(!empty($users))
                {
                  echo '<div class="top_view" style="width: 680px; text-align: left;">';
                  echo '<div class="flex" style="margin-bottom: 20px;"><span style="font-weight: bold; margin-top: 50px;">Company</span><span style="font-weight: bold; margin-top: 50px;">Email</span><span style="font-weight: bold; margin-top: 50px; width: 140px;"></span> </div>';
                  foreach($users as $user)
                  {
                    echo '<div class="user_view flex" style="padding: 30px 0px; padding-bottom: 20px; border-bottom: 2px solid #acacac; width: 680px;">';
                    echo '<span>'.$user->company.'</span><span>'.$user->email.'</span>'; ?>

                    <div class="user-delete-button"><a href="<?php echo site_url('admin/users/delete/'.$user->id);?>"> Delete User </a></div>
                    <?php
                    echo '</div>';
                  }
                 echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>
</div>
