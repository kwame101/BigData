<div >
  <h1>Login</h1>
  <?php echo $this->session->flashdata('message');?>
  <?php echo form_open('user/login',array('class'=>'form-horizontal'));?>
    <div class="form-group">
      <?php echo form_label('Email','identity');?>
      <?php echo form_error('identity');?>
      <?php echo form_input('identity','','class="form-control"');?>
    </div>
    <div class="form-group">
      <?php echo form_label('Password','password');?>
      <?php echo form_error('password');?>
      <?php echo form_password('password','','class="form-control"');?>
    </div>
    <div class="form-group">
      <label>
        <?php echo form_checkbox('remember','1',FALSE);?> Remember me
      </label>
    </div>
    <?php echo form_submit('submit', 'Log in', 'class="btn"');?>
  <?php echo form_close();?>

  <div> <a href="<?php echo base_url('password/forgot_password'); ?>"> <?php echo lang('login_forgot_password');?> </a></div>

  <div> <a href="<?php echo base_url('user/register_user'); ?>"> Sign up </a></div>

</div>
