<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
$(document).on('click', '.topic-delete-button', function(event){
  var uid = $(this).attr('value');
  var Urlink = '<?php echo site_url('admin/support/deleteTopic/');?>'+uid;
  swal({
          title: "Delete topic",
          text: "Are you sure you want to delete this topic?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#ec5310",
          confirmButtonText: "Delete topic",
          cancelButtonText: "Cancel"
      }).then(function() {
           location.href = Urlink;
      }, function(dismiss) {
         if (dismiss === 'cancel') {
           //do nothing if cancel
         }
         else {
           throw dismiss;
         }
      });
});
</script>
<div class="container" style="background-color: #f9f9f9; min-height: 100vh;">
    <div class="wrapper faq-header-title">
        <h1>Add Topic</h1>
    </div>
    <div class="addCategory-form">
        <div class="wrapper">
            <?php echo form_open('',array('class'=>'category form-horizontal'));?>
            <div class="form-top" style="margin-bottom: 60px;">
                <div class="addCat-formGroup">
                    <?php
                        echo form_error('category_name');
                        echo form_input('category_name','','class="form-control" placeholder="Category name"');
                        ?>
                </div>
                <div class="addCat-formGroup">
                    <?php
                        echo form_error('category_email');
                        echo form_input('category_email','','class="form-control" placeholder="Category email"');
                        ?>
                </div>
                <div class="addCat-formGroup addCatBtn">
                    <?php echo form_submit('submit', 'Create category', 'class="btn btn-primary btn-lg btn-block" style="font-size: 14px;"');?>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
    <div class="wrapper" id="topic_view" >
        <?php echo $this->session->flashdata('message');?>
        <div class="add-category">
            <?php
                if(!empty($category))
                  {
                    echo '<div class="cat-wrapper">';
                    foreach($category as $cat)
                    {
                      $email =str_replace(',', '</span><br /><span class="email-des">', $cat->email);
                      echo '<div class="cat-row">';
                      echo '<span class="cat-name">'.$cat->name.'</span><span class="cat-email"><span class="email-des">'
                      .$email.
                      '</span></span><span class="cat-edits">'?> <a href="<?php echo site_url('admin/support/editTopic/'.$cat->id)?>">Edit</a>
                        <span class="topic-delete-button"><a value="<?php echo $cat->id?>">X</a></span>
                      </span>
            <?php  echo '</div>';
                }
                echo '</div>';
                }
                ?>
        </div>
    </div>
</div>
