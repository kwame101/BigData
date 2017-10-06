<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link id="stylesheet" href="<?php echo base_url(); ?>/assets/css/main.css" title="main" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/styleswitcher.jquery.js"></script>

        <script src="<?php echo base_url(); ?>/assets/js/script.js"></script>
        <script src="<?php echo base_url(); ?>/assets/js/idle.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
        <script type="text/javascript">
      <?php if($this->ion_auth->logged_in()) {
      ?>
      var awayCallback = function(){
      console.log(new Date().toTimeString() + ": away");
      document.body.style.opacity = 0.5;
       $.ajax({
         url:"<?php echo base_url();?>admin/user/logout",
         method:"post",
         success: function(data){
         alert('You have been logged out due to inactivity');
         }
     });
    };

    var awayBackCallback = function(){
      console.log(new Date().toTimeString() + ": back");
       document.body.style.opacity = 1;
    };
    var onVisibleCallback = function(){
      console.log(new Date().toTimeString() + ": now looking at page");
    };

    var onHiddenCallback = function(){
      console.log(new Date().toTimeString() + ": not looking at page");
    };
    //this is one way of using it.
    /*
    var idle = new Idle();
    idle.onAway = awayCallback;
    idle.onAwayBack = awayBackCallback;
    idle.setAwayTimeout(2000);
    idle.start();
    */
    //this is another way of using it
    var idle = new Idle({
      onHidden: onHiddenCallback,
      onVisible: onVisibleCallback,
      onAway: awayCallback,
      onAwayBack: awayBackCallback,
      awayTimeout: 600000 //away with 10 seconds of inactivity
    }).start();
    <?php } ?>
   </script>
    </head>
    <body>
        <header id="header" class="primary-header">
            <div class="row">
                <div class="c-3 logowrap">Logo here</div>
                <div class="c-9">
                    <nav class="navwrap">
                        <ul id="menu" class="main menu">
                          <?php
                          if($this->ion_auth->logged_in()) {
                          ?>
                            <li><a href="<?php echo site_url('admin/users')?>">Users</a></li>
                            <li><a href="<?php echo site_url('admin/users/members');?>">Member</a></li>
                            <li class="drop-down">
                                <a class="admin-drop">Settings</a>
                              <ul>
                              <li><a href="<?php echo site_url('admin/user/settings');?>">Change Password</a></li>
                              <li><a href="<?php echo site_url('admin/users/admins');?>">Add Admin</a></li>
                            </ul></li>
                            <li><a href="<?php echo site_url('admin/users/reports');?>">Report</a></li>
                            <li class="drop-down">
                                <a class="admin-drop">FAQ's</a>
                              <ul>
                              <li><a href="<?php echo site_url('admin/support/faq')?>">Add FAQ's</a></li>
                              <li><a href="<?php echo site_url('admin/support/topic')?>">Add Topic</a></li>
                             </ul></li>
                            <li><a href="<?php echo site_url('admin/support/enquiry');?>">Enquires</a></li>
                            <li class="button orange"><a href="<?php echo site_url('/help');?>">Help Desk</a></li>
                            <li class="button "><a href="<?php echo site_url('admin/user/logout');?>">Sign Out</a></li>
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
										<div class="add-contrast">
											<a href="#" class="contrast default" onclick="setActiveStyleSheet('bigdatacorridor'); return false;" title="Standard Theme">C</a>
											<a href="#" class="contrast high" onclick="setActiveStyleSheet('high-contrast'); return false;" title="High Contrast">C</a>
										</div>
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
                                            <li class="button orange"><a href="#">Help Desk</a></li>
                                            <li class="button"><a href="#">Log In</a></li>
                                            <li class="button border-left"><a href="#">Sign Up</a></li>
                                            <?php
                                            if($this->ion_auth->logged_in()) {
                                            ?>
                                            <li><a href="<?php echo site_url('user/logout');?>">Logout</a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
						    	</div>
						    </div>
						</div>

						<div class="second-layer">
							<div class="wrapper">
								<div class="c-12 column text-right">
                                    <ul id="menu-mobile" class="mmenu no-bullets">
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Events</a></li>
                                        <li><a href="#">Showcase</a></li>
                                        <li><a href="#">Blog</a></li>
                                        <li><a href="#">Contact Us</a></li>
                                        <?php
                                        if($this->ion_auth->logged_in()) {
                                        ?>
                                        <li><a href="<?php echo site_url('user/logout');?>">Logout</a></li>
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
        </header>
