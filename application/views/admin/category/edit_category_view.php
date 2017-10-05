<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="background-color: #f9f9f9;">
   <div class="wrapper faq-header-title">
     <h1>Edit Category</h1>
   </div>
   <div class="addFaq-form">
      <div class="wrapper">
         <?php echo form_open('',array('class'=>'faq form-horizontal'));?>
         <div class="form-top">
            <div class="form-group">
               <?php
                    echo form_error('category_name');
                    echo form_input('category_name',set_value('category_name',$category->name),'class="form-control" placeholder="Category name"');
                  ?>
            </div>
            <div class="form-group">
               <?php
               echo form_error('category_email');
               echo form_input('category_email',set_value('category_email',$category->email),'class="form-control" placeholder="Category email"');
               ?>
            </div>
         </div>
         <div class="faq-submit-wrapper" style="width: calc(50% - 10px);">
           <?php echo form_hidden('category_id',set_value('category_id',$category->id));?>
           <?php echo form_submit('submit', 'Edit category', 'class="faq-submit btn btn-primary btn-lg btn-block" style="margin-top: 20px;"');?>
         </div>
         <?php echo form_close();?>
      </div>
   </div>
</div>
