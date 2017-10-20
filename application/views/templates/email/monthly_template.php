<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
      <title>Message from enquiry form</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div style="background: #ec5210;width:700px;height:20px;margin: 0 auto;">
</div>
<header style="width: 700px;background: #0e1d33;padding: 1.3rem 0;margin: 0 auto;">
  <div style="width: 35%;text-align: center;margin-left: 35%;">
    <img style="width: 60%;" src="<?php echo base_url(); ?>/assets/img/logo.png">
  </div>
</header>
<!-- section of sign in -->
<section style="width:700px;margin: 0 auto;padding: 60px 0px 50px 0px;color: #0e1d34;background: #f6f6f6;">
  <!-- wrapper for text -->
  <div style="text-align:center;width: 380px;margin: 0 auto;">
    <!-- enquiry header -->
    <h1 style="line-height: 1em;color: #0e1d34;font-weight: bold;font-size: 48px;
      margin-bottom: 20px;">
      <span style="font-weight: 700;color: #ec5210;">BigDataCorridor</span><br>Monthly Report
    </h1>
    <!-- sign in small info -->
    <p style="line-height: 1.2em;color: #0e1d34;font-weight: bold;font-size:24px;">
      Find the attached file below </p>
  </div>
<!-- </section> -->
<!-- section pdf report -->
<!-- <section style="padding: 10px 0px 50px 0px;color: #0e1d34;background: #fff;"> -->
  <!-- wrapper for pdf report -->
  <div style="max-width: 960px;width: calc(100% - 30px);margin: 0 auto;overflow: hidden;">
<div style="margin-top: 50px;margin-bottom: 40px; text-align:center;">
  <!-- pdf section -->
  <label style="color: #0e1d33;font-weight: bold;margin-bottom: 20px;display: block;">PDF Report</label>
  <div style="0px 20px 15px 0px;width: 100%;height: auto;font-family: 'Montserrat', sans-serif;
  font-size: 14px;"> <?php echo $attachment; ?></div>
</div>
</div>
</section>
</body>
</html>
