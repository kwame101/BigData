<div class="wrapper w-480" style="margin-top: 40px;">
    <div class="text-center">
      <h1>Sign in to your <span class="orange-text">BigDataCorridor</span> account</h1>
  </div>
</div>
<section class="grey-background">
    <div class="wrapper w-480 text-center" style="top: -100px;">
      <?php echo $this->session->flashdata('message');?>
      <?php echo form_open('user/login',array('class'=>'form-horizontal'));?>
        <div class="form-group">
          <?php echo form_error('identity');?>
          <?php echo form_input('identity','','class="form-control" placeholder="Email"');?>
        </div>
        <div class="form-group">
          <?php echo form_error('password');?>
          <?php echo form_password('password','','class="form-control" placeholder="Password"');?>
        </div>
<!--
        <div class="form-group">
          <label>
            <?php echo form_checkbox('remember','1',FALSE);?> Remember me
          </label>
        </div>
-->
        <div class="form-group">
            <?php echo form_submit('submit', 'Log in', 'class="btn"');?>
        </div>

<!--        <div> <a href="<?php echo base_url('user/register_user'); ?>"> Sign up </a></div>-->
      <?php echo form_close();?>

      <div class="forgot-pass"> <a href="<?php echo base_url('password/forgot_password'); ?>"> <?php echo lang('login_forgot_password');?> </a></div>

    </div>
</section>
