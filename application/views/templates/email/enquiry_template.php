<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
      <title>Message from enquiry form</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div style="background: #ec5210;width:70%;height:20px;margin: 0 auto;">
</div>
<header style="width: 70%;margin: 0 auto;background: #0e1d33;padding: 1.3rem 0;">
  <div style="width: 35%;text-align: center;margin-left: 35%;">
    <img style="width: 60%;" src="<?php echo base_url(); ?>/assets/img/logo.png">
  </div>
</header>
<!-- section of sign in -->
<section style="width:70%;margin: 0 auto;padding: 60px 0px 50px 0px;color: #0e1d34;background: #f6f6f6;">
  <!-- wrapper for text -->
  <div style="text-align:center;width: 380px;margin: 0 auto;">
    <!-- enquiry header -->
    <h1 style="line-height: 1em;color: #0e1d34;font-weight: bold;font-size: 48px;
      margin-bottom: 20px;">
      YOU HAVE A <br><span style="font-weight: 700;color: #ec5210;">NEW ENQUIRY!</span>
    </h1>
    <!-- sign in small info -->
    <p style="line-height: 1.2em;color: #0e1d34;font-weight: bold;font-size:24px;">
      Sign in to view the enquiry </p>
  </div>
  <!-- sign in button -->
  <a href="#" style="padding: 20px 60px;height: 100%;font-family: 'Montserrat', sans-serif;
    font-size: 16px;color: white;background: #ec5210;border-radius: 30px;display: block;text-align: center;
    margin: 0 auto;font-weight: bold;width: 12%;margin-bottom: 40px;text-decoration: none;"> Sign In </a>
<!-- </section> -->
<!-- section for enquiry form details -->
<!-- <section style="padding: 10px 0px 50px 0px;color: #0e1d34;background: #fff;"> -->
  <!-- wrapper for enquiry info -->
  <div style="max-width: 960px;width: 50%;margin: 0 auto;overflow: hidden;">
<div style="margin-top: 50px;margin-bottom: 40px;">
  <!-- question summary section -->
  <label style="color: #0e1d33;font-weight: bold;margin-bottom: 20px;display: block;">Question Summary</label>
  <div style="0px 20px 15px 0px;width: 100%;height: auto;font-family: 'Montserrat', sans-serif;
  font-size: 14px;"> <?php echo $summary; ?> </div>
</div>
<div style="margin-bottom: 20px;">
  <!-- content section -->
  <label style="color: #0e1d33;font-weight: bold;margin-bottom: 20px;display: block;">Details</label>
  <div style="padding: 0px 20px 15px 0px;width: 100%;height: auto;font-family: Montserrat, sans-serif;
    font-size: 14px;"><?php echo $message; ?> </div>
</div>
</div>
</section>
</body>
</html>
