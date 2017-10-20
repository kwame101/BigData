<html>
<head>
    <meta charset="utf-8" />
      <title>BigDataCorridor Help Desk</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div style="background: #ec5210;width:700px;height:20px;margin: 0 auto;">
</div>
<header style="width: 700px;margin: 0 auto;background: #0e1d33;padding: 1.3rem 0;">
  <div style="width: 35%;text-align: center;margin-left: 35%;">
    <img style="width: 60%;" src="<?php echo base_url(); ?>/assets/img/logo.png">
  </div>
</header>
<!-- section of sign in -->
<section style="width:700px;margin: 0 auto;padding: 60px 0px 50px 0px;color: #0e1d34;background: #f6f6f6;">
  <!-- wrapper for text -->
  <div style="text-align:center;width: 380px;margin: 0 auto;">
    <!-- enquiry header -->
    <h1 style="line-height: 1em;color: #0e1d34;font-weight: bold;font-size: 32px;
      margin-bottom: 20px;">
      YOU'VE REQUESTED A NEW PASSWORD ON<br><span style="font-weight: 700;color: #ec5210;">BigDataCorridor</span>
    </h1>
    <!-- sign in small info -->
    <p style="line-height: 1.2em;color: #0e1d34;font-weight: bold;font-size:16px;">
      Click the link below to reset your password </p>
  </div>
<!-- </section> -->
<!-- section for enquiry form details -->
<!-- <section style="padding: 10px 0px 50px 0px;color: #0e1d34;background: #fff;"> -->
  <!-- wrapper for enquiry info -->
  <div style="max-width: 960px;width: 50%;margin: 0 auto;overflow: hidden;">
<div style="margin-top: 50px;margin-bottom: 40px;">
  <!-- question summary section -->
  <label style="color: #0e1d33;font-weight: bold;margin-bottom: 20px;display: block;">Email</label>
  <div style="0px 20px 15px 0px;width: 100%;height: auto;font-family: 'Montserrat', sans-serif;
  font-size: 14px;"> <?php echo sprintf(lang('email_forgot_password_heading'), $identity);?></div>
</div>
<div style="margin-bottom: 20px;">
  <!-- content section -->
  <label style="color: #0e1d33;font-weight: bold;margin-bottom: 20px;display: block;">Reset Link</label>
  <div style="padding: 0px 20px 15px 0px;width: 100%;height: auto;font-family: Montserrat, sans-serif;
    font-size: 14px;"><?php echo sprintf(lang('email_forgot_password_subheading'), anchor('password/reset_password/'. $forgotten_password_code, lang('email_forgot_password_link')));?></div>
</div>
</div>
</section>
</body>
</html>
