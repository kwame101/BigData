<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
$(document).ready(function(){
  /* on typing in textfield perform small action -- comment section */
  $(document).on('DOMSubtreeModified propertychange', '#comment-text', function() {
    if ($('#comment-text').is(':empty')){
        $('#comment-field').html('Write a comment...');
        document.getElementById("comment-post-id").style.display = "none";
    }
    else {
      $('#comment-field').html('');
      document.getElementById("comment-post-id").style.display = "block";
    }
  });

  //cancel comment buton
  $(document).on('click', '.post-cancel', function() {
    $('#comment-text').html('');
    $('#comment-field').html('Write a comment...');
    document.getElementById("comment-post-id").style.display = "none";
  });

  //post comment button
  $(document).on('click', '.post-button', function() {
    var string = $('#comment-text').text();
    alert(string);
  });

  /* on typing in textfield perform small action -- reply section */
  $(document).on('DOMSubtreeModified propertychange', '#reply-text', function() {
    if ($('#reply-text').is(':empty')){
        $('#reply-field').html('Reply...');
        document.getElementById("reply-post-id").style.display = "none";
    }
    else {
      $('#reply-field').html('');
      document.getElementById("reply-post-id").style.display = "block";
    }
  });

  //cancel comment buton
  $(document).on('click', '.post-cancel-reply', function() {
    $('#reply-text').html('');
    $('#reply-field').html('Reply...');
    document.getElementById("reply-post-id").style.display = "none";
  });

  //post comment button
  $(document).on('click', '.post-button-reply', function() {
    var string = $('#reply-text').text();
    alert(string);
  });
});

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

window.goBack = function (e){
    var defaultLocation = "<?php echo base_url();?>admin/support/enquiry";
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
<div class="enquiry-header-title">
    <div class="wrapper">
        <h1> FAQ Enquires </h1>
        <!-- this may cause problem if user land on this page without history -->
        <a href="#" onclick="goBack();">&lt; back </a>
    </div>
</div>
<div class="wrapper">
    <section class="enquiry-info-content">
        <?php
         if(!empty($enq_info)){ ?>
        <div class="enquiry-info-table">
            <div class="enquiry-info-row">
                <div class="enquiry-user" style="width: 33%;">
                    <div class="bold-text title14" style="display: block; margin-bottom: 10px;"> User: </div>
                    <div class="text12"> <?php echo $enq_info->user_full_name, '</div>
                    <div class="text12" style="font-style: italic;">',date("d/m/y - H:ia",$enq_info->created_on);?> </div>
                </div>
                <div style="width: 33%;">
                    <div class="bold-text title14" style="display: block; margin-bottom: 10px;"> Summary: </div>
                    <div class="text12"><?php echo $enq_info->summary;?></div>
                </div>
                <div style="width: 33%;">
                    <div class="bold-text title14" style="display: block; margin-bottom: 10px;"> For: </div>
                    <div class="text12 enquiry-for-container"><?php
                    $email =str_replace(',', '</span><br/><span>', $enq_info->category_email);
                    echo $email;?></div>
                </div>
            </div>
            <div class="enquiry-info-states">
              <div class="enquiry-info-state title14" style="display: inline-block; color: #0e1d34; font-weight: bold;">Open <input class="state-checkbox" style="background-color: #ff0000;" type="checkbox" name="open"  onclick="updateStatus(this)" value="open" <?php echo ($enq_info->status=='open' ? 'disabled checked' : '');?>/></div>
              <div class="enquiry-info-state title14" style="display: inline-block; color: #0e1d34; font-weight: bold;">Pending <input class="state-checkbox" style="background-color: #ffb900;" type="checkbox" name="pending"  onclick="updateStatus(this)" value="pending" <?php echo ($enq_info->status=='pending' ? 'disabled checked' : '');?>/></div>
              <div class="enquiry-info-state title14" style="display: inline-block; color: #0e1d34; font-weight: bold;">Resolved <input class="state-checkbox" style="background-color: #0fd800;" type="checkbox" name="closed"  onclick="updateStatus(this)" value="closed" <?php echo ($enq_info->status=='closed' ? 'disabled checked' : '');?>/></div>
            </div>
        </div>
        <div class="enquiry-info-table">
            <div class="enquiry-info-row">
                <div class="enquiry-topics">
                    <span class="bold-text title14" style="display: block; margin-bottom: 10px;"> Topics: </span>
                    <div class="enquiry-topics-content">
                        <?php echo $enq_info->category_name;?>
                    </div>
                    <!-- insert detail here later for comment design -->
                </div>
            </div>
            <div class="enquiry-info-states">
                <div><span class="bold-text title14" style="display: block; margin-bottom: 10px;"> Assigned to:</span>
                    <div class="enquiry-asigned text12">
                    <?php
                  if($enq_info->res_full_name == null && $enq_info->email == null){
                    echo 'None';
                  }
                  else {
                      echo $enq_info->res_full_name, '</br>', $enq_info->email;
                    }?> </div>
                   <!-- <div class="comment-list">
                      <div class="comment-display">
                      <div class="comment-field">
                        <div class="comment-box">
                          <div class="comment-text-container">
                            <div class="comment-text-input">
                              <div class="comment-text-input-wrapper">
                                <div class="text-placeholder"  id="comment-field" aria-hidden="true">Write a comment... </div>
                                <div class="text-input comment-placeholder" id="comment-text" aria-multiline="true"
                                contenteditable="plaintext-only" role="textbox"></div>
                              </div>
                            </div>
                          </div>

                           **post n cancel button**
                          <div class="post-comment" id="comment-post-id" style="display:none;">
                            <div class="post-comment-container">
                              <button class="post-button"> Post </button>
                              <span> |</span>
                              <button class="post-cancel"> Cancel </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                      **posted comments here **
                      <div class="posted-comments-list">
                          ** append new comment to this **
                          <div class="posted-commed-display">
                            <div class="comment-display-post">
                              <div>
                                <div class="posted-info">
                                  <div class="poster-section">
                                    <div class="poster-content">
                                      <div class="poster-details">
                                        <div class="poster-name">
                                          Test test
                                        </div>
                                        <div class="poster-date">
                                          1 min ago
                                        </div>
                                        <div class="poster-delete">
                                          Delete
                                        </div>
                                      </div>

                                      <div class="poster-comment">
                                        A liitle test info placeholder here
                                      </div>

                                    </div>
                                  </div>
                                </div>
                              </div> **poster info end second div **
                              <div class="posted-reply comment-field">
                                <div></div>
                                <div class="comment-box">
                                  <div class="comment-text-container">
                                    <div class="comment-text-input">
                                      <div class="comment-text-input-wrapper">
                                        <div class="text-placeholder" id="reply-field" aria-hidden="true"> Reply... </div>
                                        <div class="text-input" id="reply-text" aria-label="Reply..." aria-multiline="true"
                                        contenteditable="plaintext-only" role="textbox"> </div>
                                      </div>
                                    </div>
                                  </div>

                                  ** post n cancel button **
                                  <div class="post-comment" id="reply-post-id" style="display:none;">
                                    <div class="post-comment-container-reply">
                                      <button class="post-button-reply"> Post </button>
                                      <span> |</span>
                                      <button class="post-cancel-reply"> Cancel </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!--<div class="enquiry-details">  use later for comment design-->
        <div class="bold-text title14" style="display: block; margin-bottom: 10px;">Details:</div>
        <div class="text12"><?php echo $enq_info->content;?></div>
    <!-- </div> -->
    <div style="margin-top: 40px; display: flex; justify-content: space-between; flex-wrap: wrap;">
      <?php if(!empty($enq_info->images)){
            $imageList = array();
            $imageList = explode(', ',$enq_info->images);
            foreach($imageList as $img){
              echo  '<div style="width: calc(50% - 10px);"><a href="'.base_url().'assets/upload/attachments/'.$img.'" data-lightbox="screen-shot"><img src="'.base_url().'assets/upload/attachments/'.$img.'" width="600" height="480" class="img-thumbnail" /></a></div>';
            }
      } ?>
    </div>
    <?php } ?>
</div>
