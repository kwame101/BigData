<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top: 40px;">
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
      <h1>Edit Faq</h1>
      <?php echo form_open('',array('class'=>'form-horizontal'));?>
        <div class="form-group">
          <?php echo form_label('Title','title');?>
          <?php echo form_error('title');?>
          <?php echo form_input('title',set_value('title',$faq_info->title),'class="form-control"');?>
        </div>
        <div class="form-group">
          <?php
          if(isset($category))
          {
            echo form_label('Category','category_id'); ?>
            <select name="category_id">
            <option value="<?php echo $faq_info->cat_id ?>"><?php echo $faq_info->name ?></option>
            <?php foreach ($category as $cat) { ?>
          <option value="<?php echo $cat->id ?>"><?php echo $cat->name?> </option>
          <?php } ?>
          </select>
          <?php } ?>
        </div>
        <div class="form-group">
          <?php echo form_label('Content','content');?>
          <?php echo form_error('content');?>
          <?php echo form_textarea('content',set_value('content',$faq_info->text),'class="form-control"');?>
        </div>
        <?php echo form_hidden('faq_id',set_value('faq_id',$faq_info->faq_id));?>
        <?php echo form_submit('submit', 'Save faq', 'class="btn btn-primary btn-lg btn-block"');?>
      <?php echo form_close();?>
    </div>
  </div>
</div>
