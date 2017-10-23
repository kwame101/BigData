<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#search_faqp').on('submit', function(e){
      e.preventDefault();
      $('#faq_view').empty();
      $('.faq-paginate').empty();
      var string = $('#search').val();
      if(string == '')
      {
        $('#faq_view').html('<ul class="helpdeskSearchError"><li>Please search for faqs</li> </ul>');
      }
      else {
          $.ajax({
            url:"<?php echo base_url();?>admin/support/searchFaqs",
            method:"post",
            dataType:'json',
            data: {'search': string},
            cache:false,
          }).done(function(data){
              if(data == ''){
                $('#faq_view').html('<ul class="helpdeskSearchError" ><li>No results found for: '+ string +'.</li> </ul>');
              }
              else
              {
                //$("#ajax_data").append(data);
                $.each(data, function (key, value) {
                  var list = $('<ul class="front-faq"></ul>');
                  $('#faq_view').append(list);
                  if(key != ''){
                    list.append('<li class="faq-topic"><a>' + key + '</a></li>');
                   }
                    $.each(value, function (index, Obj) {
                      list.append('<div class="faq-row-container"><li style="margin-top: 20px;"><a class="faq-title">'
                        + Obj.title + '</a><span class="faq-edits"><span class="front-faq-more fa fa-plus"></span><a style="margin-left:20px;" href="<?php echo base_url();?>admin/support/editFaq/'+Obj.id+'">Edit</a></span></li><li class="faq-text">'
                        + Obj.text +'</li></div>');
                    });
                });
              }
          });
      }
  });
  });
  $(document).on('click', '.clear_data', function(event){
    location.href = '<?php echo site_url('/admin/support/faq');?>';
  });
</script>
<div class="container" style="background-color: #f9f9f9;">
    <div class="faq-header-title">
        <div class="wrapper">
      <h1>Add Faqs</h1>
      <form method="post" id="search_faqp" class="admin-search">
          <input type="text" name="search" id="search" placeholder="Search for faqs"/>
          <input type="submit" value="Search" id="submit_search" class="btn admin-search-btn"/>
      </form>
    </div>
    </div>
    <div class="addFaq-form">
        <div class="wrapper">
        <div class="col-lg-4 col-lg-offset-4">
          <?php echo form_open('',array('class'=>'faq form-horizontal'));?>
          <div class="form-top">
              <div class="gvd">
                <?php
                echo form_error('title');
                echo form_input('title',set_value('title'),'class="form-control" placeholder="Title"');
                ?>
              </div>
              <div class="gvd">
                <?php
                if(!empty($category))
                { ?>
                  <select name="category_id" class="form-control">
                      <option value="null">Select Category </option>
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
                echo form_textarea('content',set_value('content'),'class="form-control" placeholder="Message"');
                ?>
              </div>
              <div class="faq-submit-wrapper">
                  <?php echo form_submit('submit', 'Add Post', 'class="faq-submit btn btn-primary btn-lg btn-block" style="font-size: 14px;"');?>
            </div>
              <?php echo form_close();?>
            </div>
        </div>
    </div>
        <div class="wrapper" id="topic_view">
            <div class="faqs" id="faq_view">
              <?php
                 if(!empty($faq_info))
                 {
                     foreach ($faq_info as $cat=>$faq){ ?>
              <ul class="front-faq">
                <?php if(!empty($cat)){ ?>
                 <li class="faq-topic">
                    <a> <?php echo $cat; ?> </a>
                 </li>
                <?php }
                   foreach ($faq as $info) { ?>
                 <div class="faq-row-container">
                     <li style="margin-top: 20px;">
                        <span class="faq-title"> <?php echo $info['title']; ?> </span>
                        <span class="faq-edits">
                            <span class="front-faq-more fa fa-plus"></span>
                            <a style="margin-left:20px;" href="<?php echo site_url('admin/support/editFaq/'.$info['id']) ?>">Edit</a>
                       </span>
                     </li>
                     <li class="faq-text">
                         <?php echo $info['text']; ?>
                      </li>
                  </div>
            <?php  }  } ?>
              </ul>
              <?php } ?>
            </div>
              <div class="faq-paginate">
                <?php echo $paginate; ?>
              </div>
        </div>
    </div>
