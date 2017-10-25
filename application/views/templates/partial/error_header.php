<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Dashboard | Big Data Corridor </title>
        <?php
            // Checks for, and assigns cookie to local variable:
            if(!empty($_COOKIE['style'])) $style = $_COOKIE['style'];
            // If no cookie is present then set style as "day" (default):
            else $style = 'main';
        ?>
        <link id="stylesheet" href="<?php echo config_item('base_url'); ?>/assets/css/main.css" title="main" rel="stylesheet" type="text/css" />
        <link href="<?php echo config_item('base_url');?>/assets/css/sweetalert2.min.css"  rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo config_item('base_url'); ?>/assets/js/styleswitcher.jquery.js"></script>
        <link rel="icon" type="image/x-icon" href="<?php echo config_item('base_url');?>/assets/img/favcon.ico">
        <script src="<?php echo config_item('base_url'); ?>/assets/js/script.js"></script>
        <script src="<?php echo config_item('base_url'); ?>/assets/js/sweetalert2.all.min.js"></script>
        <script src="<?php echo config_item('base_url'); ?>/assets/js/idle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
				<script type="text/javascript">
				window.goBack = function (e){
				    var defaultLocation = "<?php echo config_item('base_url');?>/dashboard";
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
    </head>
    <body>
    <div id="top_bar" class="navbar_fixed">
		<div class="top-bar">
			<div class="headerWrapper">
				<div class="text-right">
					<div id="help-toolbar" class="accessibility-toolbar">
                        <li class="menu-header-search">
                            <form action="http://bigdatacorridor.com/" target="_blank" id="searchform" method="get">
                                <input type="hidden" name="s" id="s" placeholder="Search">
                                <input type="hidden" name="site_section" value="site-search">
                                <button type="submit" name="search" class="fa fa-search button transparent search"></button>
                            </form>
                        </li>
						<div class="add-fontsize" id="font-resizr">
							<a href="#decrease" class="decrease-me">A</a>
							<a href="#normal" class="reset-me">A</a>
							<a href="#increase" class="increase-me">A</a>
						</div>
					</div>
				</div>
			</div>
		</div>
        <header id="header" class="primary-header">
            <div class="headerWrapper" style="padding: 6px 0px;">
            <div class="row">
                <div class="c-3 logowrap" style="text-align: left;"><a href="http://bigdatacorridor.com/"><img src="<?php echo config_item('base_url'); ?>/assets/img/logo.png" style="max-width: 170px;"></a></div>
                <div class="c-9">
                    <nav class="navwrap">
                        <ul id="menu" class="main menu">
													<li><a href="http://bigdatacorridor.com/">Home</a></li>
													<li><a href="http://bigdatacorridor.com/about-us/">About Us</a></li>
													<li><a href="http://bigdatacorridor.com/events/">Events</a></li>
													<li><a href="http://bigdatacorridor.com/showcase/">Showcase</a></li>
													<li><a href="http://bigdatacorridor.com/blog/">Blog</a></li>
													<li><a href="http://bigdatacorridor.com/contact-us/">Contact Us</a></li>
                        </ul>
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
                                <div id="help-toolbar" class="accessibility-toolbar">
                                    <div class="add-fontsize" id="font-resizr">
                                        <a href="#decrease" class="decrease-me">A</a>
                                        <a href="#normal" class="reset-me">A</a>
                                        <a href="#increase" class="increase-me">A</a>
                                    </div>
                                </div>

                                <div class="navwrap mobile">
                                    <ul id="menu" class="main menu mobile">

                                </div>
						    </div>
						</div>

						<div class="second-layer">
							<div class="wrapper">
								<div class="c-12 column text-right">
                                    <ul id="menu-mobile" class="mmenu no-bullets">
                                        <li><a href="http://bigdatacorridor.com/">Home</a></li>
                                        <li><a href="http://bigdatacorridor.com/about-us/">About Us</a></li>
                                        <li><a href="http://bigdatacorridor.com/events/">Events</a></li>
                                        <li><a href="http://bigdatacorridor.com/showcase/">Showcase</a></li>
                                        <li><a href="http://bigdatacorridor.com/blog/">Blog</a></li>
                                        <li><a href="http://bigdatacorridor.com/contact-us/">Contact Us</a></li>
                                    </ul>
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
      </div>
