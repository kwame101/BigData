<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="col-lg-4 col-lg-offset-4">
  <h1>Create category</h1>
  <?php echo $this->session->flashdata('message');?>
  <?php echo form_open('',array('class'=>'form-horizontal'));?>
    <div class="form-group">
      <?php echo form_label('Category name','category_name');?>
      <?php echo form_error('category_name');?>
      <?php echo form_input('category_name','','class="form-control"');?>
    </div>
    <div class="form-group">
      <?php echo form_label('Category email','category_email');?>
      <?php echo form_error('category_email');?>
      <?php echo form_input('category_email','','class="form-control"');?>
    </div>
    <?php echo form_submit('submit', 'Create category', 'class="btn btn-primary btn-lg btn-block"');?>
  <?php echo form_close();?>
</div>
