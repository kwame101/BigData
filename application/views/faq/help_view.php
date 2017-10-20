<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
   $(document).ready(function(){
       $('#search_faq').on('submit', function(e){
         e.preventDefault();
         $('#topic_view').empty();
         var string = $('#search').val();
         if(string == '')
         {
           $('#topic_view').html('<ul class="helpdeskSearchError" ><li>Please type some words in the search box.</li> </ul>');
         }
         else {
             $.ajax({
               url:"<?php echo base_url();?>help/doSearch",
               method:"post",
               dataType:'json',
               data: {'search': string},
               cache:false,
               success: function(data){
                 if(data.error == 1){
                     $('#topic_view').append(data.data);
                 }
                 else
                 {
                  $.each(data, function (key, value) {
                    var list = $('<ul class="front-faq"></ul>');
                    $('#topic_view').append(list);
                    list.append('<li class="faq-topic"><a>' + key + '</a></li>');
                    $.each(value, function (index, Obj) {
                      list.append('<div class="faq-row-container"><li style="margin-top: 20px;"><a class="faq-title">'
                        + Obj.title + '</a><span class="faq-edits"><span class="front-faq-more fa fa-plus"></span></span></li><li class="faq-text">' + Obj.text +
                      '<br/><br/><p>For any assistance please contact <a href="<?php echo site_url('help/contact')?>" class="orange-text">Customer Support.</a></p></li></div>');
                    });
                  });
                 }
               }
             });
         }
     });
   });
   $(document).on('click', '.clear_data', function(event){
     location.href = '<?php echo site_url('/help');?>';
   });
</script>
<!-- css can be changes -->
<div class="container">
   <section class="front-faq-title">
      <div class="wrapper">
         <h2 style="margin-bottom: 25px;"> Advice and answers from the <span class="orange-text">BigDataCorridor</span> team</h2>
         <form method="post" id="search_faq">
            <input type="text" name="search" id="search" placeholder="Have a Question? Ask or enter a search term here"/>
            <input type="submit" value="Search" id="submit_search" class="admin-search-btn"/>
         </form>
      </div>
   </section>
</div>
<section class="front-faq-main">
   <div class="wrapper">
       <div class="front-mainfaq-title">
         <h1>Browse FAQ's</h1>
         <div class="extra-buttons">
             <a href="<?php echo base_url();?>assets/docs/user_guide.pdf" target="_blank" class="blue-button">User guide </a>
             <a href="<?php echo site_url('help/contact')?>">Contact Us </a>
        </div>
     </div>
   </div>
  <div class="wrapper"  >
    <div class="faqs" id="topic_view">
         <?php

            if(!empty($cat_info))
            {
                foreach ($cat_info as $cat => $faq_info){ ?>
         <ul class="front-faq">
            <li class="faq-topic">
               <a> <?php echo $cat; ?> </a>
            </li>
            <?php
            foreach ($faq_info as $faq) { ?>
            <div class="faq-row-container">
                <li style="margin-top: 20px;">
                   <a class="faq-title"> <?php echo $faq['title']; ?> </a>
                   <span class="faq-edits">
                      <span class="front-faq-more fa fa-plus"></span>
                  </span>
                </li>
                <li class="faq-text">
                    <?php echo $faq['text']; ?>
                    <br/>
                    <br/>
                    <p>For any assistance please contact <a href="<?php echo site_url('help/contact')?>" class="orange-text">Customer Support.</a></p>
                </li>
            </div>
          <?php } } ?>
         </ul>
       <?php  } ?>
      </div>
      <div class="front-faq-bottom">
          <p>Can’t find the answer to your question?<br/>
             You can contact our customer support below.
          </p>
          <a href="<?php echo site_url('help/contact'); ?>" class="btn faq-touch" style="width:350px; margin-bottom: 100px;" > Get in touch </a>
      </div>
  </div>
</section>
