<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="background-color: #f9f9f9;">
   <div class="wrapper faq-header-title">
      <h1>Edit Faq</h1>
   </div>
   <div class="addFaq-form">
       <div class="wrapper">
       <div class="col-lg-4 col-lg-offset-4">
         <?php echo form_open('',array('class'=>'faq form-horizontal'));?>
         <div class="form-top">
             <div class="gvd">
               <?php
                  echo form_error('title');
                  echo form_input('title',set_value('title',$faq_info->title),'class="form-control" placeholder="Title"');
               ?>
             </div>
             <div class="gvd">
                 <?php
                    if(!empty($category))
                    { ?>
                 <select name="category_id" class="form-control">
                    <option value="<?php echo $faq_info->cat_id ?>"><?php echo $faq_info->name ?></option>
                    <?php foreach ($category as $cat) { ?>
                    <option value="<?php echo $cat->id ?>"><?php echo $cat->name?> </option>
                    <?php } ?>
                 </select>
                 <?php } ?>
               </div>
           </div>
             <div class="gvd text-area">
               <?php
                  echo form_error('content');
                  echo form_textarea('content',set_value('content',$faq_info->text),'class="form-control" placeholder="Message"');
               ?>
             </div>
             <div class="faq-submit-wrapper">
                <?php echo form_hidden('faq_id',set_value('faq_id',$faq_info->faq_id));?>
                <?php echo form_submit('submit', 'Save faq', 'class="faq-submit btn btn-primary btn-lg btn-block" style="font-size: 14px;"');?>
           </div>
             <?php echo form_close();?>
           </div>
       </div>
   </div>
</div>
