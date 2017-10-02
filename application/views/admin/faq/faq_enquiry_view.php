<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1> FAQ Enquires </h1>

<ul>
  <li><a href="<?php echo site_url('admin/support/enquiry/open')?>">Open </a>
  <li><a href="<?php echo site_url('admin/support/enquiry/pending')?>">Pending </a>
  <li><a href="<?php echo site_url('admin/support/enquiry/closed')?>">Closed </a>
</ul>
<div class="enquiry_table">
<table>
  <?php
  if(isset($enq_info)){
    foreach($enq_info as $enq){ ?>
  <tr>
  <td>User:</br><?php echo $enq['full_name'],'</br>',date("d/m/y - H:ia",$enq['created_on']);?> </td>
  <td>Summary:</br><?php echo $enq['summary'];?> </td>
  <td class="topic_name">Topics:</br><?php echo $enq['category_name'];?></td>
  <td class="topic_email">For:</br><?php echo $enq['category_email'];?> </td>
  <td><?php echo ucfirst($enq['status']),'</br>';
  $stat = $enq['status'];
  if($stat == 'open'){
    echo '<div class="open_tag"style="width:30px;height:30px;background:red;"></div>';
  }
  else if($stat == 'pending'){
    echo '<div class="pending_tag"style="width:30px;height:30px;background:#FDB82C;"></div>';
  }
  else if($stat == 'closed'){
    echo '<div class="closed_tag"style="width:30px;height:30px;background:green;"></div>';
  }
  ?></td>
  <td class="enq_view"><a href="<?php echo site_url('admin/support/display/'.$enq['id']) ?>">View </a> </td>
</tr>
 <?php } } ?>
</table>
</div>
