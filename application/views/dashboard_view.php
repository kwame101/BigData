<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
$(document).ready(function () {
    $(".iframe").hide();
    $(".open_web").click(function (e) {
        e.preventDefault();
        document.getElementById('close_bar').style.display = 'block';
        document.body.style.overflow = 'hidden';
        $("iframe").attr("src", $(this).attr('href'));
        $(".link").fadeOut(100);
        $(".iframe").fadeIn(100);
        //$(".iframe").show();
    });
    $(document).on('click', '.fclose', function(event){
        $(this).parent().fadeOut(100);
        $(".link").fadeIn(100);
        document.getElementById('close_bar').style.display = 'none';
        document.body.style.overflow = 'visible';

    });

});
</script>
<div class="wrapper" style="margin-top: 70px;">
    <div class="dashboard-title w-480">
        <h1><span class="orange-text">BigDataCorridor</span> Toolkit Select Below</h1>
        <p>Learn how to use data to your advantage. Search our datasets and visualise results for Birmingham and the surrounding areas</p>
    </div>
</div>

<section class="grey-background" style="padding-bottom: 0px;">
    <div class="wrapper" style="top: -130px;">
        <div class="dashboard-content-container">
            <div class="dashboard-column">
                <div class="dashboard-image-container">
                  <a class="open_web" href="http://www.birminghamdata.uk/"> <img src="<?php echo base_url(); ?>assets/img/data.jpg"> </a>
                </div>
                <div class="dashboard-text">
                    <h2>Data</h2>
                    <ul>
                      <li>Browse data by topics, organisations, formats or keywords search.</li>
                      <li>Preview data in grids, graphs, maps or document viewers.</li>
                      <li>Download data to combine with your private data for particular business needs.</li>
                    </ul>
                </div>
                  <a class="open_web dashboard-article-btn link" href="http://www.birminghamdata.uk/" style="color:#fff"> Go to Data </a>
            </div>

            <div class="dashboard-column">
                <div class="dashboard-image-container">
                  <a class="open_web" href="<?php echo site_url('dashboard/visualisation');?>"> <img src="<?php echo base_url(); ?>assets/img/visualisation.jpg" /></a>
                </div>
                <div class="dashboard-text">
                    <h2>Visualisation</h2>
                    <ul>
                      <li>Extract business insight through interactive visualisation.</li>
                        <li>Blend open data with your private data to generate new business values.</li>
                        <li>Produce robust data models, rich and interactive personalised dashboard reports.</li>
                    </ul>
                </div>
                <a class="open_web dashboard-article-btn orange-background link" href="<?php echo site_url('dashboard/visualisation');?>" style="color:#fff">Go to Visualisation</a>
            </div>
        </div>
    </div>
    <div class="iframe" style="background:#fff;">
    <?php  //iframe style
          //style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%;
          //height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;" ?>
          <span id="close_bar" style="display:none;" class="fclose">Back to Dashboard</span>
        <iframe src="" >
            <p>Your browser does not support iframes.</p>
        </iframe>
  </div>
</section>
