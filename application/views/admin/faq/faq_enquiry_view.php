<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="enquiry-header-title">
    <div class="wrapper">
        <h1> FAQ Enquires </h1>
    </div>
</div>
<section class="admin-enquiry">
    <ul>
        <div class="wrapper">
          <li><a href="<?php echo site_url('admin/support/enquiry/open')?>">Open </a>
          <li><a href="<?php echo site_url('admin/support/enquiry/pending')?>">Pending </a>
          <li><a href="<?php echo site_url('admin/support/enquiry/closed')?>">Resolved </a>
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
                          <div class="text13"><?php echo $enq['category_email'];?></div>
                      </span>
                      <span style="width: auto; text-align: center;font-weight:bold;">
                          <div class="bold-text title14"><?php echo ucfirst($enq['status']),'</div>';
                      $stat = $enq['status'];
                      if($stat == 'open'){
                        echo '<div class="open_tag"style="width:45px;height:30px;background:red;display:inline-block;"></div>';
                      }
                      else if($stat == 'pending'){
                        echo '<div class="pending_tag"style="width:45px;height:30px;background:#FDB82C;display:inline-block;"></div>';
                      }
                      else if($stat == 'closed'){
                        echo '<div class="closed_tag"style="width:45px;height:30px;background:green;display:inline-block;"></div>';
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
