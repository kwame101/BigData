<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header>
  <h1> Header goes here </h1>
</header>
<nav>
  <li><a href="#"> Nav 1</a></li>
  <li><a href="#"> Nav 2</a></li>
 <li><a href="#"> Nav 3</a></li>
 <?php
if($this->ion_auth->logged_in()) {
?>
   <li><a href="<?php echo site_url('user/logout');?>">Logout</a></li>
 <?php } ?>
</nav>
