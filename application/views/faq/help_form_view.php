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
  var doneTypingInterval = 5000;  //time in ms (5 seconds)

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
        var info ='<h3>Do these help?</h3></br><hr class="padding-bottom:10px">',strdata;
        for(var i = 0;i<data.length;i++){
          strdata = data[i];
          info += '<ul class="admin-faq"><li class="faq-title"><a href="#" style="float:left" >'+
            strdata.title + '</a><a href="#" >'+ strdata.name + '</a></li><li class="faq-text">'+
            strdata.text+'<span class="faq-edits"><button>'+ "&#43;" +'</button></span></li></li></ul>'
        }
        $('#search_sum').removeClass('loading');
        $('#jax_req').html(info);
      }
      }
    });
  }
});
</script>
<h2> Get in touch with out BigDataCorridor team </h2>
<p> Fill in the form below to help us understand what you are looking for </p>

<div class="helper_form">

<?php echo form_open('',array('class'=>'form-horizontal'));?>
<div class="form-group">
  <h3> Select topic </h3>
<?php if(isset($category)) {
  foreach($category as $cat)
  {
    echo '<div class="checkbox">';
    echo '<label>';
    echo form_checkbox('topics[]', $cat->id, set_checkbox('topics[]', $cat->id));
    echo ' '.$cat->name;
    echo '</label>';
    echo '</div>';
  }
 }?>
</div>
<div class="form-group">
  <?php
          echo form_label('Question Summary','summary');
          echo form_error('summary');
          echo form_input('summary','','id="search_sum", class="form-control"');
    ?>
</div>
<div class="form-group">
  <?php
          echo form_label('Message','message');
          echo form_error('message');
          echo form_textarea('message','','class="form-control"');
    ?>
</div>

<div id="jax_req">
<!-- Ajax request here to display faqs -->
</div>

<?php echo form_submit('submit', 'Send', 'class="btn btn-primary btn-lg btn-block"');?>
<?php echo form_close();?>
<form enctype="multipart/form-data" method="post" id="form_upload">
  <div class="form_upload">
      <?php
        echo form_error('userfile');
        echo form_upload('userfile','','id="userfile" class="form-control"'); ?>
        <input type="submit" class="btn btn-primary btn-lg btn-block" value="upload" >
  </div>
</form>
  <div  id="uploaded_image"> <!-- <img src="<?php// echo base_url().'assets/upload/7606fdacd2847517fd0ffd40a01441d3.jpg';?>" /> --> </div>
<div class="faq_req"> <a href="<?php echo base_url('help'); ?>"> Go back to FAQs </a></div>
</div>
