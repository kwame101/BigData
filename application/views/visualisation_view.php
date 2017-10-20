<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link id="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" title="main" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/sweetalert2.min.css" title="main" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/styleswitcher.jquery.js"></script>
        <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>assets/img/favcon.ico">
        <script src="<?php echo base_url(); ?>assets/js/script.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/sweetalert2.all.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/idle.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
    </head>
    <body>

		<div class="top-bar">
			<div class="headerWrapper">
			</div>
		</div>
        <header id="header" class="primary-header">
            <div class="headerWrapper" style="padding: 6px 0px;">
            <div class="row">
                <div class="c-3 logowrap" style="text-align: left;"><a href="http://bigdatacorridor.com/"><img src="<?php echo base_url(); ?>assets/img/logo.png" style="max-width: 170px;"></a></div>
                <div class="c-9">
                    <nav class="navwrap">
                        <ul id="menu" class="main menu">
                    </nav>
                </div>

				<aside id="mobile-menu" class="mmscreen">
					<!-- Use any element to open/show the overlay navigation menu -->
					<div class="hamburger-menu open">
						<button class="hamburger hamburger--slider" type="button" aria-label="Menu" aria-controls="navigation">
						  <span class="hamburger-box">
						    <span class="hamburger-inner"></span>
						  </span>
						</button>
					</div>

					<!-- The overlay -->
					<div id="myNav" class="overlay">

					  <!-- Overlay content -->
					  <div class="overlay-content">
					  	<!-- Button to close the overlay navigation -->
				    	<div class="hamburger-menu close">
				    		<button class="hamburger hamburger--slider" type="button">
							  <span class="hamburger-box">
							    <span class="hamburger-inner"></span>
							  </span>
							</button>
						</div>

						<div class="first-layer">
						    <div class="wrapper">
						    </div>
						</div>

						<div class="second-layer">
							<div class="wrapper">
								<div class="c-12 column text-right">

								</div>
							</div>
						</div>

					  </div><!-- End Overlay content -->

					</div>
				</aside>
                <div class="clearFix"></div>
            </div>
        </div>
        </header>


<div class="visualBanner">
    <div class="bannerTextContainer">
        <div class="wrapper">
            <h1>Getting started with <span class="orange-text" style="font-weight: 400;">Power BI Desktop</span></h1>
        </div>
    </div>
    <div class="bannerImageContainer">
        <img src="<?php echo base_url(); ?>assets/img/visualisation-header.png" />
    </div>
</div>

<section class="visualColumns">
    <div class="wrapper">
        <div class="textcolumn">
            <div class="textcolumn-title">
                <img src="<?php echo base_url(); ?>assets/img/download-icon.png" />
                <h2>Download</h2>
                <div class="clearFix"></div>
            </div>
            <p>Power BI Desktop is a free download. You can get the latest version of Power BI Desktop using this <a href="https://powerbi.microsoft.com/en-us/desktop/" target="_blank" style="color: #EC5210">link</a>, or for more advanced download options click <a href="https://www.microsoft.com/en-us/download/details.aspx?id=45331" target="_blank" style="color: #EC5210">here</a>. <br /> <br /> To find out more details about installation process, you can follow this <a href="https://powerbi.microsoft.com/en-us/documentation/powerbi-desktop-get-the-desktop/" target="_blank" style="color: #EC5210;">link</a>.</p>
        </div>
        <div class="textcolumn">
            <div class="textcolumn-title">
                <img src="<?php echo base_url(); ?>assets/img/guide-icon.png" />
                <h2>Getting Started Guide</h2>
                <div class="clearFix"></div>
            </div>
            <p>This <a href="https://powerbi.microsoft.com/en-us/documentation/powerbi-desktop-getting-started/" target="_blank" style="color: #EC5210">short tour of Power BI Desktop</a> (by David Iseminger) familiarises you with how this tool works, demonstrates what it can do, and accelerates your ability to create robust data models, rich and interactive reports with visual analytics that amplify your business intelligence efforts. </p>
        </div>
        <div class="textcolumn">
            <div class="textcolumn-title">
                <img src="<?php echo base_url(); ?>assets/img/video-icon.png" />
                <h2>Getting Started Videos</h2>
                <div class="clearFix"></div>
            </div>
            <p>Prefer to watch instead of read? <a href="https://powerbi.microsoft.com/en-us/documentation/powerbi-desktop-videos/" target="_blank" style="color: #EC5210">Feel free to take a look at getting started videos </a> provided by David Iseminger.  And if you want to follow along with the video with matching sample data, you can <a href="https://go.microsoft.com/fwlink/?LinkID=521962" style="color: #EC5210">download this sample Excel workbook</a>. <br /> <br /> There is also a
              <a href="https://www.youtube.com/playlist?list=PL1N57mwBHtN2q1WbU5O29rrn_A0lkVv9p" style="color: #EC5210" target="_blank">YouTube channel for Power BI</a>.</p>
        </div>
        <div class="textcolumn">
            <div class="textcolumn-title">
                <img src="<?php echo base_url(); ?>assets/img/question-mark-icon.png" />
                <h2>Getting More Assist</h2>
                <div class="clearFix"></div>
            </div>
            <p>Need more assist of using Power BI? You can contact the Big Data Corridor support below.
              </p>
              <div class="get-in-touch">
                <a href="<?php echo site_url('help/contact'); ?>" target="_parent" style="margin-top:30px;" > Get in touch </a>
              </div>
        </div>
    </div>
  </section>
<?php $this->load->view('templates/partial/master_footer_view');?>
