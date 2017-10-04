<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
//ajax req to update status
function updateStatus(chr)
{
  var enqid = <?php echo $enq_info->id; ?>;
  var status = chr.name;
  $.ajax({
    type: "POST",
    url: "<?php echo base_url();?>admin/support/doUpdateStatus",
    data: {'enquiryid':enqid,'status':status},
    success: function() {
        location.reload();
    }
});
}

</script>
<div class="enquiry-header-title">
    <div class="wrapper">
        <h1> FAQ Enquires </h1>
        <a href="#">&lt; back </a>
    </div>
</div>

<div class="wrapper">
    <section class="enquiry-info-content">
        <?php if(isset($enq_info)){ ?>
        <div class="enquiry-info-table">
            <div class="enquiry-info-row">
                <div><span class="bold-text" style="display: block; margin-bottom: 10px;"> User: </span> <?php echo $enq_info->user_full_name,'</br>',date("d/m/y - H:ia",$enq_info->created_on);?> </div>
                <div><span class="bold-text" style="display: block; margin-bottom: 10px;"> Summary: </span> <?php echo $enq_info->summary;?></div>
                <div><span class="bold-text" style="display: block; margin-bottom: 10px;"> For: </span> <?php echo $enq_info->category_email;?> </div>
            </div>
            <div class="enquiry-info-states">
              <div class="enquiry-info-state" style="display: inline-block; color: #0e1d34; font-weight: bold;">Open <input class="state-checkbox" style="background-color: #ff0000;" type="checkbox" name="open"  onclick="updateStatus(this)" value="open" <?php echo ($enq_info->status=='open' ? 'disabled checked' : '');?>/></div>
              <div class="enquiry-info-state" style="display: inline-block; color: #0e1d34; font-weight: bold;">Pending <input class="state-checkbox" style="background-color: #ffb900;" type="checkbox" name="pending"  onclick="updateStatus(this)" value="pending" <?php echo ($enq_info->status=='pending' ? 'disabled checked' : '');?>/></div>
              <div class="enquiry-info-state" style="display: inline-block; color: #0e1d34; font-weight: bold;">Resolved <input class="state-checkbox" style="background-color: #0fd800;" type="checkbox" name="closed"  onclick="updateStatus(this)" value="closed" <?php echo ($enq_info->status=='closed' ? 'disabled checked' : '');?>/></div>
            </div>
        </div>
        <div class="enquiry-info-table">
            <div class="enquiry-info-row">
                <div class="enquiry-topics"><span class="bold-text" style="display: block; margin-bottom: 10px;"> Topics: </span><div class="enquiry-topics-content"> <?php echo $enq_info->category_name;?> </div></div>
            </div>
            <div class="enquiry-info-states">
                <div><span class="bold-text" style="display: block; margin-bottom: 10px;"> Assigned to:</span>
                    <div class="enquiry-asigned">
                    <?php
                  if($enq_info->res_full_name == null && $enq_info->email == null){
                    echo 'None';
                  }
                  else {
                      echo $enq_info->res_full_name, '</br>', $enq_info->email;
                    }?> </div>
                </div>
            </div>
        </div>
    </section>
    <div><span class="bold-text" style="display: block; margin-bottom: 10px;">Details:</span> <?php echo $enq_info->content;?> </div>
    <div style="margin-top: 40px;">Images: </div>
    <?php } ?>
</div>
