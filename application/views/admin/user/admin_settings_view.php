<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top:60px;">
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
      <h1>Change Password</h1>
      <div id="infoMessage"><?php echo $message;?></div>
      <?php echo form_open('',array('class'=>'form-horizontal'));?>
      <div class="form-group">
        <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
           <?php echo form_input($old_password);?>
      </div>
        <div class="form-group">
          <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
              <?php echo form_input($new_password);?>
        </div>
        <div class="form-group">
          <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
            <?php echo form_input($new_password_confirm);?>
        </div>
        <?php echo form_input($user_id);?>
        <?php echo form_submit('submit', 'Confirm', 'class="btn btn-primary btn-lg btn-block"');?>
      <?php echo form_close();?>
    </div>
  </div>
</div>
