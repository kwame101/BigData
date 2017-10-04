<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="background-color: #f9f9f9;">
    <div class="wrapper faq-header-title">
      <h1>Create faqs</h1>
    </div>
    <div class="addFaq-form">
        <div class="wrapper">
        <div class="col-lg-4 col-lg-offset-4">
          <?php echo form_open('',array('class'=>'faq form-horizontal'));?>
          <div class="form-top">
              <div class="form-group">
                <?php
                echo form_error('title');
                echo form_input('title',set_value('title'),'class="form-control" placeholder="Title"');
                ?>
              </div>
              <div class="form-group">
                <?php
                if(isset($category))
                { ?>
                  <select name="category_id" class="form-control">
                      <option value="null">Select Category </option>
                  <?php foreach ($category as $cat) { ?>
                <option value="<?php echo $cat->id ?>"><?php echo $cat->name?> </option>
                <?php } ?>
                </select>
                <?php } ?>
                </div>
            </div>
              <div class="form-group text-area">
                <?php
                echo form_error('content');
                echo form_textarea('content',set_value('content'),'class="form-control"');
                ?>
              </div>
              <div class="faq-submit-wrapper">
                  <?php echo form_submit('submit', 'Add Post', 'class="faq-submit btn btn-primary btn-lg btn-block"');?>
            </div>
              <?php echo form_close();?>
            </div>
        </div>
    </div>
   <div class="wrapper" id="topic_view" >
     <div class="faqs">
          <?php
             if(isset($faq_info))
             {
                 foreach ($faq_info as $faq){ ?>
          <ul class="front-faq">
             <li class="faq-topic">
                <a href="#" > <?php echo $faq->name; ?> </a>
             </li>
             <li>
                <a href="#" class="faq-title"> <?php echo $faq->title; ?> </a>
                <span class="faq-edits">
                    <span class="front-faq-more"> &#43; </span>
                    <a href="<?php echo site_url('admin/support/editFaq/'.$faq->faq_id) ?>">Edit</a>
               </span>
             </li>
             <li class="faq-text"> <?php echo $faq->text; ?> </li>
          </ul>
          <?php  } } ?>
       </div>
       <div class="front-faq-bottom">
           <p>Can't find the answer to your question? </br>
              You can contact our customer support below.
           </p>
           <a href="<?php echo site_url('help/contact'); ?>" class="btn faq-touch" style="width:350px;" > Get in touch </a>
       </div>
   </div>
