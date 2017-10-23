<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="enquiry-header-title">
    <div class="wrapper">
        <h1> FAQ Enquires </h1>
    </div>
</div>
<section class="admin-enquiry">
    <ul>
        <div class="wrapper">
          <li class="<?php if($this->uri->segment(4) == 'open'){ echo 'admin-enquiry-li-active';} elseif($this->uri->segment(4) == null){echo 'admin-enquiry-li-active';}?>">
            <a class="<?php if($this->uri->segment(4) == 'open'){ echo 'admin-enquiry-li-active';} elseif($this->uri->segment(4) == null){echo 'admin-enquiry-li-active';}?>"
               href="<?php echo site_url('admin/support/enquiry/open')?>">Open </a>
          <li class="<?php if($this->uri->segment(4) == 'pending'){ echo 'admin-enquiry-li-active';} ?>">
            <a  class="<?php if($this->uri->segment(4) == 'pending'){ echo 'admin-enquiry-li-active';}?>"
               href="<?php echo site_url('admin/support/enquiry/pending')?>">Pending </a>
          <li class="<?php if($this->uri->segment(4) == 'closed'){ echo 'admin-enquiry-li-active';}?>">
            <a class="<?php if($this->uri->segment(4) == 'closed'){ echo 'admin-enquiry-li-active';}?>"
              href="<?php echo site_url('admin/support/enquiry/closed')?>">Resolved </a>
        </div>
    </ul>
    <div class="wrapper">
        <div class="enquiry-table">
          <?php
          if(!empty($enq_info)){
            foreach($enq_info as $enq){ ?>
                <div class="enquiry-table-row">
                    <div class="enquiry-table-row-info">
                      <span style="padding: 0px 25px;" class="enquiry-user">
                          <div class="bold-text title14">User:</div>
                          <div class="text13"><?php echo $enq['full_name'],'</div>
                          <div style="font-style: italic; font-size: 12px;">',
                            date("d/m/y - H:ia",$enq['created_on']);
                            ?>
                        </div>
                      </span>
                      <span>
                          <div class="bold-text title14">Summary:</div>
                          <div class="text13" style="padding-right: 20px; overflow: hidden;"><?php echo $enq['summary'];?></div>
                      </span>
                      <span class="topic_name" style="padding: 0px 25px;">
                          <!-- <div class="topics"> -->
                              <div class="bold-text title14">Topics:</div><div class="topic-cat"><?php echo $enq['category_name'];?></div>
                          <!-- </div> -->
                      </span>
                      <span class="topic_email">
                          <div class="bold-text title14">For:</div>
                          <div class="text13 enquiry-for-container"><?php
                          $email =str_replace(',', '</span><br/><span >', $enq['category_email']);
                          echo $email;?></div>
                      </span>
                      <span style="width: auto; text-align: center;font-weight:bold;">
                          <div class="bold-text title14"><?php echo ucfirst($enq['status']),'</div>';
                      $stat = $enq['status'];
                      if($stat == 'open'){
                        echo '<div class="open_tag"style="width:45px;height:30px;background:#ff0000;display:inline-block;"></div>';
                      }
                      else if($stat == 'pending'){
                        echo '<div class="pending_tag"style="width:45px;height:30px;background:#FDB82C;display:inline-block;"></div>';
                      }
                      else if($stat == 'closed'){
                        echo '<div class="closed_tag"style="width:45px;height:30px;background:#0fd800;display:inline-block;"></div>';
                      }
                      ?></span>
                     </div>
                      <span class="enq_view">
                          <a href="<?php echo site_url('admin/support/display/'.$enq['id']) ?>">View </a>
                      </span>
                </div>
         <?php } } ?>
         </div>
        </div>
    </div>
</section>
