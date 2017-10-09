
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="background-color: #f9f9f9; min-height: 100vh;">
    <div class="wrapper faq-header-title">
        <h1>Create category</h1>
    </div>
    <div class="addFaq-form">
        <div class="wrapper">
            <?php echo form_open('',array('class'=>'faq form-horizontal'));?>
            <div class="form-top">
                <div class="form-group">
                    <?php
                        echo form_error('category_name');
                        echo form_input('category_name','','class="form-control" placeholder="Category name"');
                        ?>
                </div>
                <div class="form-group">
                    <?php
                        echo form_error('category_email');
                        echo form_input('category_email','','class="form-control" placeholder="Category email"');
                        ?>
                </div>
            </div>
            <div class="faq-submit-wrapper" style="margin-top: 20px; width: calc(50% - 10px)">
                <?php echo form_submit('submit', 'Create category', 'class="faq-submit btn btn-primary btn-lg btn-block" style="font-size: 14px;"');?>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
    <div class="wrapper" id="topic_view" >
        <div class="add-category">
            <?php
                if(!empty($category))
                  {
                    echo '<div class="cat-wrapper">';
                    foreach($category as $cat)
                    {
                      echo '<div class="cat-row">';
                      echo '<span class="cat-name">'.$cat->name.'</span><span class="cat-email">&minus; '.$cat->email.'</span><span class="cat-edits">'?> <a href="<?php echo site_url('admin/support/editTopic/'.$cat->id)?>">Edit</a></span>
            <?php  echo '</div>';
                }
                echo '</div>';
                }
                ?>
        </div>
    </div>
</div>
