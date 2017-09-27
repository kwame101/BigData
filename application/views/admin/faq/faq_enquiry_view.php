<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1> FAQ Enquires </h1>

<ul>
  <li><a href="<?php echo site_url('admin/support/enquiry/open')?>">Open </a>
  <li><a href="<?php echo site_url('admin/support/enquiry/pending')?>">Pending </a>
  <li><a href="<?php echo site_url('admin/support/enquiry/closed')?>">Closed </a>
</ul>
<div class="enquiry_table">
<table>
<tr>
  <td>User:</br> </td>
  <td>Summary:</br> </td>
  <td>Topics:</br> </td>
  <td>For:</br> </td>
  <td><?php
    if($this->uri->segment(4) != null){
      $url_name = $this->uri->segment(4);
      if($url_name == 'pending')
      {
        echo ucfirst($url_name).'</br> <div class"enq_orange"></div>';
      }
      else if($url_name == 'closed')
      {
        echo ucfirst($url_name).'</br> <div class"enq_green"></div>';
      }
      else if($url_name == 'open')
      {
        echo ucfirst($url_name).'</br> <div class"enq_red"></div>';
      }
    }
    else {
      echo 'Open </br> <div class"enq_red"></div>';
    }
   ?> </td>
  <td><a href="<?php echo site_url('admin/support/display') ?>">View </a> </td>
</tr>
</table>
</div>
