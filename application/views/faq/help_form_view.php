<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<h2> Get in touch with out BigDataCorridor team </h2>
<p> Fill in the form below to help us understand what you are looking for </p>

<div class="helper_form">

<?php echo form_open('',array('class'=>'form-horizontal'));?>
<div class="form-group">
  <h3> Select topic </h3>
<?php if(isset($category)) { ?>


<?php }?>
</div>
<div class="form-group">
  <?php
          echo form_label('Question Summary','summary');
          echo form_error('summary');
          echo form_input('summary','','class="form-control"');
    ?>
</div>
<div class="form-group">
  <?php
          echo form_label('Message','message');
          echo form_error('message');
          echo form_textarea('message','','class="form-control"');
    ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#form_upload').on('submit', function(e){
      e.preventDefault();
      if($('#imagefile').val() == '')
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
});
</script>

<div class="jax_req">
<h2> Do these help? </h2>
<!-- Ajax request here to display faqs -->
</div>

<?php echo form_submit('submit', 'Send', 'class="btn btn-primary btn-lg btn-block"');?>
<?php echo form_close();?>
<form enctype="multipart/form-data" method="post" id="form_upload">
  <div class="form_upload">
      <?php
        echo form_error('imagefile');
        echo form_upload('imagefile','','id="imagefile" class="form-control"'); ?>
        <input type="submit" class="btn btn-primary btn-lg btn-block" value="upload" >
  </div>
</form>
  <div  id="uploaded_image"> </div>
<div class="faq_req"> <a href="<?php echo base_url('help'); ?>"> Go back to FAQs </a></div>


</div>
