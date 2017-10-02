<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
$(document).ready(function(){
    $('#search_faq').on('submit', function(e){
      e.preventDefault();
      $('#topic_view').empty();
      var string = $('#search').val();
      if(string == '')
      {
        $('#topic_view').html('<ul><li>Please type some words in the search box.</li> </ul>');
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
                var raw ='',strdata;
                for(var i = 0;i<data.length;i++){
                  strdata = data[i];
                  raw += '<ul class="admin-faq"><li class="faq-title"><a href="#" style="float:left" >'+
                    strdata.title + '</a><a href="#" >'+ strdata.name + '</a></li><li class="faq-text">'+
                    strdata.text+'<span class="faq-edits"><button>'+ "&#43;" +'</button></span></li></li></ul>'
                }
                $('#topic_view').html(raw);
                //  $('#topic_view').append(JSON.stringify(data));
              }
            }
          });
      }
  });
});
</script>
<!-- css can be changes -->
<div class="container">
<section class="front-faq-title">
    <div class="wrapper">
        <h2 style="margin-bottom: 25px;"> Advice and answers from the <span class="orange-text">BigDataCorridor</span> team</h2>
        <form method="post" id="search_faq">
            <input type="text" name="search" id="search" placeholder="Have a Question? Ask or enter a search term here"/>
            <input type="submit" value="Search" id="submit_search"/>
        </form>
    </div>
</section>
</div>
<div class="faqs">
  <div class="main_info wrapper">
  <ul>
    <h1>Browse by Topic</h1>
    <li><a href="<?php echo site_url('help/contact')?>">Contact Us </a></li>
  </ul>
</div>
  <div class="wrapper" id="topic_view" >
      <?php
      if(isset($faq_info))
      {
          foreach ($faq_info as $faq){ ?>
            <ul class="admin-faq">
              <li class="faq-title">
                <!-- <a href="#" style="float:left" > <?php echo $faq->title; ?> </a> -->
                <a href="#" > <?php echo $faq->name; ?> </a>
              </li>
              <li class="faq-text">
                  <?php echo $faq->text; ?>
                  <span class="faq-edits"><button> + </button></span>
              </li>
              </li>
            </ul>
        <?php  } } ?>
  </div>

<p>Can't find the answer to your question? </br>
You can contact our customer support below.</p>
<a href="<?php echo site_url('help/contact'); ?>" > Get in touch </a>
</div>
