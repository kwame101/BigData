<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <div class="col-lg-4 col-lg-offset-4">
      <div class="wrapper">
        <div class="change-password-title" style="margin-top: 60px;">
            <h1>Change Password</h1>
        </div>
    </div>
        <section class="change-password-content grey-background" style="margin-top: 0px; padding: 40px 0px;">
            <div class="wrapper">
              <div id="infoMessage"><?php echo $message;?></div>
              <?php echo form_open('',array('class'=>'form-horizontal'));?>
              <div class="form-group">
                   <?php echo form_input($old_password,'','class="form-control" placeholder="Old password"');?>
              </div>
                <div class="form-group">
                      <?php echo form_input($new_password,'','class="form-control" placeholder="New password"');?>
                </div>
                <div class="form-group">
                    <?php echo form_input($new_password_confirm,'','class="form-control" placeholder="Confirm new password"');?>
                </div>
                <div class="form-group">
                    <?php echo form_input($user_id);?>
                    <?php echo form_submit('submit', 'Confirm', 'class="btn btn-primary btn-lg btn-block"');?>
                </div>
              <?php echo form_close();?>
          </div>
        </section>
    </div>
  </div>
</div>
