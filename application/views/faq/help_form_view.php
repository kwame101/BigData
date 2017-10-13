<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
    $(document).ready(function(){
        //ajax request to upload and add image into input tag
        $('#form_upload').on('submit', function(e){
          e.preventDefault();
          if($('#userfile').val() == '')
          {
            alert("Please select an image");
          }
          else {
              $.ajax({
                url:"<?php echo base_url();?>help/display_upload",
                method:"post",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success: function(data){
                  //$('#uploaded_image').html(data);
                  $(data).appendTo('#uploaded_image');
                }
              });
          }
      });
      //setup before functions
      var typingTimer;                //timer identifier
      var doneTypingInterval = 1000;  //time in ms (1 seconds)
      //on keyup, start the countdown
      $('#search_sum').keyup(function(){
          clearTimeout(typingTimer);
          if ($('#search_sum').val()) {
              typingTimer = setTimeout(doneTyping, doneTypingInterval);
              $('#search_sum').addClass('loading');
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
            var info ='<h3>Do these help?</h3>',strdata;
            for(var i = 0;i<data.length;i++){
              strdata = data[i];
              info += '<ul class="enquiry-faq"><li class="faq-topic"><a>'+
                strdata.name + '</a></li><div class="faq-row-container"><li margin-top: 20px;><a class="faq-title">'+ strdata.title + '</a><span class="faq-edits"><span class="front-faq-more fa fa-plus"></span></span></li><li class="faq-text">'+
                strdata.text+'<br /><br /><p>For any assistance please contact <a href="<?php echo site_url('help/contact')?>" class="orange-text">Customer Support.</a></p></div></ul>'
            }
            $('#search_sum').removeClass('loading');
            $('#jax_req').html(info);
          }
          }
        });
      }

        // disable submit button until you have selected a topic
       $('input:checkbox').on('change', function() {
           if($(this).is(':checked')) {
               $(this).closest('.form_post').find('input:submit').prop('disabled', false);
           }
           else {
               $(this).closest('.form_post').find('input:submit').prop('disabled', true);
           }
       })
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
        <div><?php echo $this->session->flashdata('message');?></div>
        <?php echo form_open('',array('class'=>'form_post form-horizontal'));?>
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
                    echo form_upload('userfile','','form="form_upload" id="userfile" class="choose-file" data-multiple-caption="{count} files selected" multiple');
                    echo form_label('Choose file','userfile','','for="userfile"'); ?>
                <input type="submit" class="upload-btn" form="form_upload" value="+ Upload Attachment" >
            </div>
        <div id="jax_req">
            <!-- Ajax request here to display faqs -->
        </div>
        <?php echo form_submit('submit', 'Send', 'disabled class="btn faq-send" style="width:350px;"');?>
        <?php echo form_close();?>
        <form enctype="multipart/form-data" method="post" id="form_upload"></form>
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
