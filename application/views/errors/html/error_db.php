<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include VIEWPATH.'templates/partial'.DIRECTORY_SEPARATOR.'error_header.php'; ?>
			<div class="container" style="top:55px">
			    <div class="main-content" style="background: #0e1d33;padding: 80px 0 85px;">
						<div class="wrapper" style="margin-top: 70px;text-align:center;">
		<h1 class="head-error-text" ><?php echo $heading; ?></h1>
		<?php echo '<span class="orange-error-text">'.$message.'</span>';?>
	</div>
	</div>
	<section class="wrapper content-404-text">
			<div class="row inner-text-info">
				<div class="small-12 columns text-center">
					<h2> Please click <a href="#" onclick="goBack();">here</a> to go back </h2>
				</div>
			</div>
	 </section>
</div>
<?php include VIEWPATH.'templates/partial'.DIRECTORY_SEPARATOR.'error_footer.php'; ?>
