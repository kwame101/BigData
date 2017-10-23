<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
window.goBack = function (e){
    var defaultLocation = "<?php echo base_url();?>admin/support/faq";
    var oldHash = window.location.hash;
    history.back(); // Try to go back
    var newHash = window.location.hash;
    if(
        newHash === oldHash &&
        (typeof(document.referrer) !== "string" || document.referrer  === "")
    ){
        window.setTimeout(function(){
            // redirect to default location
            window.location.href = defaultLocation;
        },1000); // set timeout in ms
    }
    if(e){
        if(e.preventDefault)
            e.preventDefault();
        if(e.preventPropagation)
            e.preventPropagation();
    }
    return false; // stop event propagation and browser default event
}

</script>
<div class="container" style="background-color: #f9f9f9;">
   <div class="wrapper faq-header-title">
      <h1>Edit Faq</h1>

      <a href="#" onclick="goBack();">&lt; back </a>
   </div>
   <div class="addFaq-form">
       <div class="wrapper">
       <div class="col-lg-4 col-lg-offset-4">
         <?php echo form_open('',array('class'=>'faq form-horizontal'));?>
         <div class="form-top">
             <div class="gvd">
               <?php
                  echo form_error('title');
                  echo form_input('title',set_value('title',$faq_info->title),'class="form-control" placeholder="Title"');
               ?>
             </div>
             <div class="gvd">
                 <?php
                    if(!empty($category))
                    { ?>
                 <select name="category_id" class="form-control">
                    <option value="<?php echo $faq_info->cat_id ?>"><?php echo $faq_info->name ?></option>
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
                  echo form_textarea('content',set_value('content',$faq_info->text),'class="form-control" placeholder="Message"');
               ?>
             </div>
             <div class="faq-submit-wrapper">
                <?php echo form_hidden('faq_id',set_value('faq_id',$faq_info->faq_id));?>
                <?php echo form_submit('submit', 'Save faq', 'class="faq-submit btn btn-primary btn-lg btn-block" style="font-size: 14px;"');?>
           </div>
             <?php echo form_close();?>
           </div>
       </div>
   </div>
</div>
