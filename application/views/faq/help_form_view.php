<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
    $(document).ready(function(){
        //uncheck all ticked boxes
        $('#submit_form input[type=checkbox]').attr('checked',false);

      //setup before functions
      var typingTimer;                //timer identifier
      var doneTypingInterval = 1000;  //time in ms (1 seconds)
      //on keyup, start the countdown
      $('#search_sum').keyup(function(){
          clearTimeout(typingTimer);
          if ($('#search_sum').val()) {
              typingTimer = setTimeout(doneTyping, doneTypingInterval);
              $('#search_sum').addClass('loading');
              $('#jax_req').empty();
          }
      });
      //search through faq form for an summary related to this input
      function doneTyping () {
        var summary = $('#search_sum').val();
        $.ajax({
          //more complex algorithm to search for user summary
          url:"<?php echo base_url();?>help/complexSearch",
          method:"post",
          dataType:'json',
          data: {'search': summary},
          cache:false,
          success: function(data){
            if(data == false){
              $('#jax_req').empty();
              $('#search_sum').removeClass('loading');
            }
          else {
            $('#jax_req').append('<h3>Do these help?</h3>');
            $.each(data, function (key, value) {
              var list = $('<ul class="front-faq"></ul>');
              $('#jax_req').append(list);
              if(key != ''){
                list.append('<li class="faq-topic"><a>' + key + '</a></li>');
              }
              $.each(value, function (index, Obj) {
                list.append('<div class="faq-row-container"><li style="margin-top: 20px;"><a class="faq-title">'
                  + Obj.title + '</a><span class="faq-edits"><span class="front-faq-more fa fa-plus"></span></span></li><li class="faq-text">' + Obj.text +
                '</li></div>');
              });
            });
            $('#search_sum').removeClass('loading');
          }
          }
        });
      }

        // disable submit button until you have selected a topic
    $(document).on('change', 'input:checkbox', function(event){
           if($(this).is(':checked')) {
               $(this).closest('.form_post').find('input:submit').prop('disabled', false);
           }
           else {
               $(this).closest('.form_post').find('input:submit').prop('disabled', true);
           }
       })

       //check if user choose an image
       var imageFile = document.getElementById('userfiles');
       imageFile.onchange = function () {
         var input = this.files[0];
         if (input) {
            document.getElementById("upload_btn").style.visibility = "visible";
          } else {
            document.getElementById("upload_btn").style.visibility = "hidden";
        }
      };
    });
    //remove image after uploading it
    $(document).on('click', '.del_img', function(event){
        var removed = $(this).parent(".up_image").children('.img_thumb').val();
        //alert(removed);
        $(this).parent(".up_image").remove();
        $.ajax({
          //delete selected file
          url:"<?php echo base_url();?>help/delete_upload",
          method:"post",
          data: {'filename': removed},
          success: function(data){
            //message info later
          }
        });
    });

    //ajax request to upload and add image into input tag
    function uploadForm(){
      var formDa = new FormData($('#submit_form')[0]);
      document.getElementById("up_load").style.visibility = "visible";
      if($('#userfiles').val() == '')
      {
        swal({
           title: "No Image found!",
           text: "Please select an image",
           type: "warning",
           confirmButtonText: 'Close',
           showCancelButton: false
         })
         document.getElementById("up_load").style.visibility = "hidden";
      }
      else {
          $.ajax({
            url:"<?php echo base_url();?>help/display_upload",
            method:"post",
            data: formDa,
            contentType:false,
            cache:false,
            processData:false,
            success: function(data){
              //$('#uploaded_image').html(data);
              $(data).appendTo('#uploaded_image');
              document.getElementById("upload_btn").style.visibility = "hidden";
              document.getElementById("up_load").style.visibility = "hidden";
            }
          });
      }
    }
</script>
<div class="container">
<section class="faq-form-title">
    <div class="wrapper w-380 text-center">
        <h1 style="margin-bottom: 20px;"> Get in touch with our </br> <span class="orange-text">BigDataCorridor</span> team </h1>
        <p> Fill in the form below to help us understand </br> what you are looking for </p>
    </div>
</section>
<section class="faq-form">
    <div class="wrapper">
        <div class="contact-msg"><?php echo $this->session->flashdata('message');?></div>
        <?php echo form_open('',array('enctype'=>'multipart/form-data','id'=>'submit_form','class'=>'form_post form-horizontal'));?>
        <h3> Select topic </h3>
        <?php if(isset($category)) {
            foreach($category as $cat)
            {
              echo '<div class="checkbox">';
              echo '<label>';
              echo form_checkbox('topics[]', $cat->id, set_checkbox('topics[]', $cat->id));
              echo '<span>'.$cat->name.'</span>';
              echo '</label>';
              echo '</div>';
            }
            }?>
        <div class="question-summary" style="margin-top: 50px; margin-bottom: 40px;">
            <?php
                echo form_label('Question Summary','summary');
                echo form_error('summary');
                echo form_input('summary','','id="search_sum", class="form-control" placeholder="Please enter a short summary of the problem"');
                ?>
        </div>
        <div class="faq-message" style="margin-bottom: 20px;">
            <?php
                echo form_label('Details','message');
                echo form_error('message');
                echo form_textarea('message','','class="form-control" placeholder="Please give a full description"');
                ?>
        </div>
        <div  id="uploaded_image">
        </div>
            <div class="form_upload">
                <?php
                    echo form_error('userfile');
                    echo form_upload('userfiles[]','','id="userfiles"  class="choose-file" accept="image/x-png,image/gif,image/jpeg" data-multiple-caption="{count} files selected" multiple');
                    echo form_label('Choose Image','userfiles','','for="userfiles"'); ?>
                <button type="button"  style="visibility:hidden;" class="upload-btn" id="upload_btn" onclick="uploadForm()"  value="+ Upload Attachment" >+ Upload Attachment </button>
                <img id="up_load" style="width:20px;visibility:hidden;" src="<?php echo base_url();?>assets/img/loader.gif">
            </div>
        <div id="jax_req">
            <!-- Ajax request here to display faqs -->
        </div>
        <?php echo form_submit('submit', 'Send', 'disabled class="btn faq-send" style="width:350px;"');?>
        <?php echo form_close();?>
        <!-- <form enctype="multipart/form-data" method="post" id="form_upload"></form> -->
        <div class="faq_req"> <a href="<?php echo base_url('help'); ?>"> Go back to FAQs </a></div>
    </div>
</section>

<script type="text/javascript">
function testFunction() {
    if ($(this).closest('.admin-faq').find('.faq-text').is(':hidden')){
        $(this).closest('.admin-faq').find('.faq-text').css({'display': 'block'});
    } else {
        $(this).closest('.admin-faq').find('.faq-text').css({'display': 'none'});
    }
}
</script>
