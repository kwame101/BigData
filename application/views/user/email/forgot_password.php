<div class="wrapper w-480">
    <div class="forgot-password text-center">

          <h1 style="font-size:32px;" >Sign in to your </br> <span class="orange-text">BigDataCorridor</span> account</h1>
        <p>Please enter your email adress. </br> You will receive a link to craete a new </br> password via email.</p>

        <div id="infoMessage"><?php if (isset($message)){ echo $message; }?></div>

        <?php echo form_open("password/forgot_password",array("class"=>"form-horizontal"));?>
            <div class="form-group">
                <?php echo form_input($identity,'', 'class="form-control" placeholder="Email"');?>
            </div>

            <div class="form-group">
                <?php echo form_submit('Submit', lang('forgot_password_submit_btn'), 'class="btn"');?>
            </div>

        <?php echo form_close();?>

    </div>
</div>
