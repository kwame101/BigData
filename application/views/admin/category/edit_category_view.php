<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="background-color: #f9f9f9;">
   <div class="wrapper faq-header-title">
     <h1>Edit Topic</h1>
   </div>
   <div class="editTopic-form">
      <div class="wrapper">
         <?php echo form_open('',array('class'=>'editTopic form-horizontal'));?>
         <div class="form-top" style="margin-bottom: 60px;">
             <div class="editTopic-formGroup">
                   <?php
                        echo form_error('category_name');
                        echo form_input('category_name',set_value('category_name',$category->name),'class="form-control" placeholder="Category name"');
                      ?>
              </div>
              <div class="editTopic-formGroup">
                   <?php
                   echo form_error('category_email');
                   echo form_input('category_email',set_value('category_email',$category->email),'class="form-control" placeholder="Category email"');
                   ?>
             </div>
             <div class="editTopic-formGroup editTopic-btn">
               <?php echo form_hidden('category_id',set_value('category_id',$category->id));?>
               <?php echo form_submit('submit', 'Save topic', 'class="btn btn-primary btn-lg btn-block"');?>
             </div>
        </div>
         <?php echo form_close();?>
      </div>
   </div>
</div>
