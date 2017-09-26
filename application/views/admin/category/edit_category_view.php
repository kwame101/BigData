<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top: 40px;">
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
      <h1>Edit Category</h1>
      <?php echo form_open('',array('class'=>'form-horizontal'));?>
        <div class="form-group">
          <?php echo form_label('Category name','category_name');?>
          <?php echo form_error('category_name');?>
          <?php echo form_input('category_name',set_value('category_name',$category->name),'class="form-control"');?>
        </div>
        <div class="form-group">
          <?php echo form_label('Category email','category_email');?>
          <?php echo form_error('category_email');?>
          <?php echo form_input('category_email',set_value('category_email',$category->email),'class="form-control"');?>
        </div>
        <?php echo form_hidden('category_id',set_value('category_id',$category->id));?>
        <?php echo form_submit('submit', 'Edit category', 'class="btn btn-primary btn-lg btn-block"');?>
      <?php echo form_close();?>
    </div>
  </div>
</div>
