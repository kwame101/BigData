<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top: 60px;">
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
      <h1>Create faqs</h1>
      <?php echo form_open('',array('class'=>'form-horizontal'));?>
      <div class="form-group">
        <?php
        echo form_label('Title','title');
        echo form_error('title');
        echo form_input('title',set_value('title'),'class="form-control"');
        ?>
      </div>
      <div class="form-group">
        <?php
        if(isset($category))
        {
          echo form_label('Category','category_id'); ?>
          <select name="category_id">
              <option value="null">Select Category </option>
          <?php foreach ($category as $cat) { ?>
        <option value="<?php echo $cat->id ?>"><?php echo $cat->name?> </option>
        <?php } ?>
        </select>
        <?php } ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Content','content');
        echo form_error('content');
        echo form_textarea('content',set_value('content'),'class="form-control"');
        ?>
      </div>
      <?php echo form_submit('submit', 'Add Post', 'class="btn btn-primary btn-lg btn-block"');?>
      <?php echo form_close();?>
    </div>
  </div>
</div>
<div class="faqs">
  <?php
  if(isset($faq_info))
  {
      foreach ($faq_info as $faq){ ?>
        <ul>
          <li><a href="#" style="float:left" > <?php echo $faq->title; ?> </a>
            <a href="#" style="margin-left:40px;" > <?php echo $faq->name; ?> </a>
            <button> + </button> <a href="<?php echo site_url('admin/support/editFaq/'.$faq->faq_id) ?>">Edit</a>
            <li> <?php echo $faq->text; ?> </li>
          </li>
        </ul>

    <?php  }
      echo $paginate;
  } ?>
</div>
