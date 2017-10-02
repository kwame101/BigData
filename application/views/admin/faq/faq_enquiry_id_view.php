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
<div>
<h1> FAQ Enquires </h1>

<a href="#">back </a>
</div>
<div>
<?php if(isset($enq_info)){ ?>
<div>User: <?php echo $enq_info->user_full_name,'</br>',date("d/m/y - H:ia",$enq_info->created_on);?> </div>
<div>Summary: <?php echo $enq_info->summary;?></div>
<div>For: <?php echo $enq_info->category_email;?> </div>
<div>
  <span>Open <input type="checkbox" name="open"  onclick="updateStatus(this)" value="open" <?php echo ($enq_info->status=='open' ? 'disabled checked' : '');?>/></span>
  <span>Pending <input type="checkbox" name="pending"  onclick="updateStatus(this)" value="pending" <?php echo ($enq_info->status=='pending' ? 'disabled checked' : '');?>/></span>
  <span>Resolved <input type="checkbox" name="closed"  onclick="updateStatus(this)" value="closed" <?php echo ($enq_info->status=='closed' ? 'disabled checked' : '');?>/></span>
</div>
<div>Assign to: <?php
  if($enq_info->res_full_name == null && $enq_info->email == null){
    echo 'None';
  }
  else {
      echo $enq_info->res_full_name, '</br>', $enq_info->email;
    }?> </div>
<div>Topics: <?php echo $enq_info->category_name;?> </div>
<div>Details: <?php echo $enq_info->content;?> </div>
<div>Images: </div>
<?php } ?>
</div>
