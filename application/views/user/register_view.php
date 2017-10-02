<div class="wrapper w-480" style="margin-top: 40px;">
    <div class="text-center">
      <h1>Sign up to create your <span class="orange-text">BigDataCorridor</span> account</h1>
    </div>
</div>

<section class="grey-background">
    <div class="wrapper w-480 text-center" style="top: -100px;">
        <div id="infoMessage"><?php echo $message;?></div>
        <section class="form-container">
            <?php echo form_open("user/register_user",array('class'=>'form-horizontal'));?>

                  <div class="form-group">
            <!--            <?php echo lang('create_user_fname_label', 'first_name');?> <br />-->
                        <?php echo form_input($first_name,'','class="form-control" placeholder="First Name"');?>
                  </div>

                  <div class="form-group">
            <!--            <?php echo lang('create_user_lname_label', 'last_name');?> <br />-->
                        <?php echo form_input($last_name,'','class="form-control" placeholder="Last Name"');?>
                  </div>

                  <?php
                  if($identity_column!=='email') {
                      echo '<p>';
            //          echo lang('create_user_identity_label', 'identity');
                      echo '<br />';
                      echo form_error('identity');
                      echo form_input($identity);
                      echo '</p>';
                  }
                  ?>

                  <div class="form-group">
            <!--            <?php echo lang('create_user_email_label', 'email');?> <br />-->
                        <?php echo form_input($email,'','class="form-control" placeholder="Email"');?>
                  </div>

                  <div class="form-group">
            <!--            <?php echo lang('create_user_password_label', 'password');?> <br />-->
                        <?php echo form_input($password,'','class="form-control" placeholder="Password"');?>
                  </div>

                  <div class="form-group">
            <!--            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />-->
                        <?php echo form_input($password_confirm,'','class="form-control" placeholder="Password Confirmation"');?>
                  </div>


                  <div class="form-group">
                        <?php echo form_submit('submit', 'Create Account', 'class="btn"');?>
            <!--            <?php echo form_submit('submit', lang('create_user_submit_btn'));?>-->
                  </div>

            <?php echo form_close();?>
        </div>
</section>
