<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="background-color: #f9f9f9;">
    <div class="wrapper faq-header-title">
      <h1>Add Faqs</h1>
    </div>
    <div class="addFaq-form">
        <div class="wrapper">
        <div class="col-lg-4 col-lg-offset-4">
          <?php echo form_open('',array('class'=>'faq form-horizontal'));?>
          <div class="form-top">
              <div class="gvd">
                <?php
                echo form_error('title');
                echo form_input('title',set_value('title'),'class="form-control" placeholder="Title"');
                ?>
              </div>
              <div class="gvd">
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
              <div class="gvd text-area">
                <?php
                echo form_error('content');
                echo form_textarea('content',set_value('content'),'class="form-control" placeholder="Message"');
                ?>
              </div>
              <div class="faq-submit-wrapper">
                  <?php echo form_submit('submit', 'Add Post', 'class="faq-submit btn btn-primary btn-lg btn-block" style="font-size: 14px;"');?>
            </div>
              <?php echo form_close();?>
            </div>
        </div>
    </div>
        <div class="wrapper" id="topic_view">
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
                    <span class="faq-title"> <?php echo $faq->title; ?> </span>
                    <span class="faq-edits">
                        <span class="front-faq-more fa fa-plus"></span>
                        <a style="margin-left:20px;" href="<?php echo site_url('admin/support/editFaq/'.$faq->faq_id) ?>">Edit</a>
                   </span>
                 </li>
                 <li class="faq-text">
                     <?php echo $faq->text; ?>
                    <br />
                    <br />
                    <p>For any assistance please contact <a href="<?php echo site_url('help/contact')?>" class="orange-text">Customer Support.</a></p>
                  </li>
              </ul>
              <?php  }  ?>

              <div class="faq-paginate">
                <?php echo $paginate; ?>
              </div>
            <?php } ?>
        </div>
    </div>
