<div class="wrapper w-480" style="margin-top: 100px;">
    <div class="text-center">
      <h1>Enter a new password to change your</br > <span class="orange-text">BigDataCorridor</span> account</h1>
    </div>
</div>

<section class="grey-background">
    <div class="wrapper w-480 text-center" style="top: -100px;">
        <div id="infoMessage"><?php echo $message;?></div>
        <section class="form-container">
						<?php echo form_open('password/reset_password/' . $code);?>
            <span class="form-group" id="extra_cus" style="display:none;">
              <div style="padding: 35px 60px;text-align: left;font-size: 11px;height: 100%;width: 100%;
                font-family: 'Montserrat', sans-serif;">
                Minimum of 8 lower and upper case characters <br> containing letters and numbers.</div>
              </span>
	<div class="form-group">
	<!--	<label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label> <br /> -->
		<?php echo form_input($new_password,'','class="form-control" placeholder="Password"');?>
	</div>

	<div class="form-group">
	<!--	<?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br /> -->
		<?php echo form_input($new_password_confirm, '','class="form-control" placeholder="Password Confirmation"');?>
	</div>

	<?php echo form_input($user_id);?>
	<?php echo form_hidden($csrf); ?>
	<div class="form-group"><?php echo form_submit('submit', 'Change','class="btn"');?></div>

<?php echo form_close();?>
</div>
</section>
