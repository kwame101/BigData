


<div class="wrapper w-480">
    <div class="forgot-password text-center">

        <h1><?php echo lang('forgot_password_heading');?></h1>
        <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

        <div id="infoMessage"><?php if (isset($message)){ echo $message; }?></div>

        <?php echo form_open("password/forgot_password",array("class"=>"form-horizontal"));?>
            <div class="form-group">
                <?php echo form_input($identity,'', 'class="form-control" placeholder="Email"');?>
            </div>

            <div class="form-group">
                <?php echo form_submit('submit', lang('forgot_password_submit_btn'), 'class="btn"');?>
            </div>

        <?php echo form_close();?>

    </div>
</div>
