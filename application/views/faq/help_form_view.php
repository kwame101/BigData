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
                  $('#uploaded_image').html(data);
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
              info += '<ul class="enquiry-faq"><li class="faq-topic"><a href="#">'+
                strdata.name + '</a></li><li><a href="#" class="faq-title">'+ strdata.title + '</a><span class="faq-edits"><span class="enquiry-more">'+ "&#43;" +'</span></li><li class="faq-text">'+
                strdata.text+'</span></li></li></ul>'
            }
            $('#search_sum').removeClass('loading');
            $('#jax_req').html(info);
          }
          }
        });
      }
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
        <?php echo form_open('',array('class'=>'form-horizontal'));?>
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
        <form enctype="multipart/form-data" method="post" id="form_upload">
            <div class="form_upload">
                <?php
                    echo form_error('userfile');
                    echo form_upload('userfile','','id="userfile" class="choose-file" data-multiple-caption="{count} files selected" multiple');
                    echo form_label('Choose file','userfile','','for="userfile"'); ?>
                <input type="submit" class="upload-btn" value="+ Upload Attachment" >
            </div>
        </form>
        <div  id="uploaded_image">
            <!-- <img src="<?php// echo base_url().'assets/upload/7606fdacd2847517fd0ffd40a01441d3.jpg';?>" /> -->
        </div>
        <div id="jax_req">
            <!-- Ajax request here to display faqs -->
        </div>
        <?php echo form_close();?>
        <?php echo form_submit('submit', 'Send', 'class="btn faq-send" style="width:350px;"');?>
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
