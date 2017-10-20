<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Dashboard | Big Data Corridor </title>
        <link id="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css" title="main" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/sweetalert2.min.css"  rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/lightbox.min.css" rel="stylesheet" type="text/css" />
        <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>assets/img/favcon.ico">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/styleswitcher.jquery.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/script.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/sweetalert2.all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
    </head>
    <body>
        <header id="header" class="primary-header">
            <div class="headerWrapper" style="overflow: visible;">
                <div class="row">
                    <div class="c-3 logowrap" style="text-align:left;"><img style="width: 60%;" src="<?php echo base_url(); ?>assets/img/logo.png" style="max-width: 170px;"></div>
                    <div class="c-9">
                        <nav class="navwrap">
                            <ul id="menu" class="main menu">
                              <?php
                              if($this->ion_auth->logged_in()) {
                              ?>
                                <li><a href="<?php echo site_url('admin/users')?>">Users</a></li>
                                <li><a href="<?php echo site_url('admin/users/members');?>">Members</a></li>
                                <li class="drop-down">
                                    <a class="admin-drop">Settings</a>
                                  <ul>
                                  <li><a href="<?php echo site_url('admin/user/settings');?>">Change Password</a></li>
                                  <li><a href="<?php echo site_url('admin/users/admins');?>">Add Admin</a></li>
                                </ul></li>
                                <li><a href="<?php echo site_url('admin/users/reports');?>">Report</a></li>
                                <li class="drop-down">
                                    <a class="admin-drop">FAQs</a>
                                  <ul>
                                  <li><a href="<?php echo site_url('admin/support/topic')?>">Add Topic</a></li>
                                  <li><a href="<?php echo site_url('admin/support/faq')?>">Add FAQs</a></li>
                                 </ul></li>
                                <li><a href="<?php echo site_url('admin/support/enquiry');?>">Enquires</a></li>
                                <li class="button orange"><a href="<?php echo site_url('/help');?>">Help Desk</a></li>
                                <li class="button white"><a href="<?php echo site_url('admin/user/logout');?>">Sign Out</a></li>
                              <?php } else { ?>
                                <li class="button orange"><a href="<?php echo site_url('/help');?>">Help Desk</a></li>
                                <li class="button "><a href="<?php echo site_url('admin/user/login')?>">Sign In</a></li>
                            <?php  }?>
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
    						    	<div class="c-12 column">
    						    		<div id="help-toolbar" class="accessibility-toolbar">
    										<div class="add-fontsize" id="font-resizr">
    											<a href="#decrease" class="decrease-me">A</a>
    											<a href="#normal" class="reset-me">A</a>
    											<a href="#increase" class="increase-me">A</a>
    										</div>
    									</div>
    						    	</div><!-- end accessibility tool-bar -->

    						    	<div class="c-12 column">
                                        <div class="navwrap mobile">
                                            <ul id="menu" class="main menu mobile">
                                                <li class="button orange"><a href="<?php echo site_url('/help');?>">Help Desk</a></li>
                                                <?php
                                                if($this->ion_auth->logged_in()) {
                                                ?>
                                                <li class="button white"><a href="<?php echo site_url('admin/user/logout');?>">Sign Out</a></li>
                                              <?php }
                                              else{ ?>
                                                <li class="button "><a href="<?php echo site_url('admin/user/login');?>">Sign in</a></li>
                                            <?php  } ?>
                                            </ul>
                                        </div>
    						    	</div>
    						    </div>
    						</div>

    						<div class="second-layer">
    							<div class="wrapper">
    								<div class="c-12 column text-right">
                                        <ul id="menu-mobile" class="mmenu no-bullets">
                                          <?php
                                          if($this->ion_auth->logged_in()) {
                                          ?>
                                            <li><a href="<?php echo site_url('admin/users')?>">Users</a></li>
                                            <li><a href="<?php echo site_url('admin/users/members');?>">Members</a></li>
                                              <li><a href="<?php echo site_url('admin/user/settings');?>">Change Password</a></li>
                                              <li><a href="<?php echo site_url('admin/users/admins');?>">Add Admin</a></li>
                                            <li><a href="<?php echo site_url('admin/users/reports');?>">Report</a></li>
                                              <li><a href="<?php echo site_url('admin/support/topic')?>">Add Topic</a></li>
                                              <li><a href="<?php echo site_url('admin/support/faq')?>">Add FAQs</a></li>
                                            <li><a href="<?php echo site_url('admin/support/enquiry');?>">Enquires</a></li>
                                          <?php } ?>
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
