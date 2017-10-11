<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
$(document).ready(function () {
    $(".iframe").hide();
    $(".open_web").click(function (e) {
        e.preventDefault();
        $("iframe").attr("src", $(this).attr('href'));
        $(".link").fadeOut('slow');
        $(".iframe").fadeIn('slow');
    });
    $(document).on('click', '.fclose', function(event){
        $(this).parent().fadeOut("slow");
        $(".link").fadeIn("slow");
    });
});
</script>
<div class="wrapper" style="margin-top: 100px;">
    <div class="dashboard-title w-480">
        <h1><span class="orange-text">BigDataCorridor</span> Toolkit Select Below</h1>
        <p>The platform is suitable for knowledge-base projects, gathering and crunching data from Birmingham and the surrounding areas</p>
    </div>
</div>

<section class="grey-background" style="padding-bottom: 0px;">
    <div class="wrapper" style="top: -100px;">
        <div class="dashboard-content-container">
            <div class="dashboard-column">
                <div class="dashboard-image-container">
                    <img src="<?php echo base_url(); ?>/assets/img/data.png">
                </div>
                <div class="dashboard-text">
                    <h2>Data</h2>
                    <ul>
                        <li>Browse data by topics, organisations, formats or keywords search.</li>
                        <li>Preview data in grids, graphs, maps or document viewers.</li>
                        <li>Download data to combine with your private data for particular business needs.</li>
                    </ul>
                </div>
                  <a class="open_web dashboard-article-btn link" href="http://bigdatacorridor.com" style="color:#fff"> Go to Data </a>
            </div>

            <div class="dashboard-column">
                <div class="dashboard-image-container">
                    <img src="<?php echo base_url(); ?>/assets/img/visualisation.png" />
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
    <div class="iframe">
    <?php  //iframe style
          //style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%;
          //height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;" ?>
    <iframe src="" >
        <p>Your browser does not support iframes.</p>
    </iframe>
    <span class="fclose">Close</span>
  </div>
</section>
