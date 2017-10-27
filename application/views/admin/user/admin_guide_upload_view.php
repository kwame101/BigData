<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
    $(document).ready(function(){
      $('#user_pdf').on('submit', function(e){
        e.preventDefault();
        var formDa = new FormData($('#user_pdf')[0]);
        document.getElementById("user_load").style.visibility = "visible";
        if($('#userpdf').val() == '')
        {
          swal({
             title: "No file found!",
             text: "Please select a pdf file",
             type: "warning",
             confirmButtonText: 'Close',
             showCancelButton: false
           }).catch(swal.noop);
           $('.user-msg').html('');
           document.getElementById("user_load").style.visibility = "hidden";
        }
        else {
            $.ajax({
              url:"<?php echo base_url();?>admin/support/uploadUserGuide",
              method:"post",
              data: formDa,
              contentType:false,
              cache:false,
              processData:false,
              success: function(data){
                $('.user-msg').html(data);
                $('#user_pdf').wrap('<form>').closest('form').get(0).reset();
                document.getElementById("user_load").style.visibility = "hidden";
              },
            error: function (textStatus, errorThrown) {
                alert('There seem to be a problem uploading pdf');
            }
            });
        }
      });

      $('#admin_pdf').on('submit', function(e){
        e.preventDefault();
        var formDa = new FormData($('#admin_pdf')[0]);
        document.getElementById("admin_load").style.visibility = "visible";
        if($('#adminpdf').val() == '')
        {
          swal({
             title: "No file found!",
             text: "Please select a pdf file",
             type: "warning",
             confirmButtonText: 'Close',
             showCancelButton: false
           }).catch(swal.noop);
           $('.admin-msg').html('');
           document.getElementById("admin_load").style.visibility = "hidden";
        }
        else {
            $.ajax({
              url:"<?php echo base_url();?>admin/support/uploadAdminGuide",
              method:"post",
              data: formDa,
              contentType:false,
              cache:false,
              processData:false,
              success: function(data){
                $('.admin-msg').html(data);
                $('#admin_pdf').wrap('<form>').closest('form').get(0).reset();
                document.getElementById("admin_load").style.visibility = "hidden";
              },
            error: function (textStatus, errorThrown) {
                alert('There seem to be a problem uploading pdf');
            }
            });
        }
      });
    });
</script>
<div class="container">
    <div class="col-lg-4 col-lg-offset-4">
      <div class="wrapper">
        <div class="change-password-title" style="margin-top: 60px;">
            <h1>Guide Upload</h1>
        </div>
    </div>
        <section class="change-password-content grey-background" style="margin-top: 0px; padding: 40px 0px;">
            <div class="wrapper">
              <div class="guide-row">
              <div class="user-pdf">
              <div class="user-pdf-text">
                <h3> Upload a PDF for User Guide </h3>
              </div>
              <form method="post" enctype="multipart/form-data" id="user_pdf" class="form-horizontal" >
              <div class="form_upload">
                  <?php
                      echo form_error('userpdf');
                      echo form_upload('userpdf','','id="userpdf"  class="choose-file" accept="application/pdf" ');
                      ?>
                      <img id="user_load" style="width:20px;visibility:hidden;" src="<?php echo base_url();?>assets/img/loader.gif">
              </div>
                <div class="form-group">
                    <?php echo form_submit('submit', 'Upload', ' class="btn btn-primary btn-lg btn-block"');?>
                </div>
              <?php echo form_close();?>
              <div class="user-msg">
              </div>
            </div>

            <div class="admin-pdf">
            <div class="admin-pdf-text">
              <h3> Upload a PDF for Admin Guide </h3>
            </div>
            <form method="post" enctype="multipart/form-data" id="admin_pdf" class="form-horizontal" >
            <div class="form_upload">
                <?php
                    echo form_error('adminpdf');
                    echo form_upload('adminpdf','','id="adminpdf"  class="choose-file" accept="application/pdf" files selected" ');
                    ?>
                    <img id="admin_load" style="width:20px;visibility:hidden;" src="<?php echo base_url();?>assets/img/loader.gif">
            </div>
              <div class="form-group">
                  <?php echo form_submit('submit', 'Upload', 'class="btn btn-primary btn-lg btn-block"');?>
              </div>
            <?php echo form_close();?>
            <div class="admin-msg">
            </div>
          </div>
          </div>
        </div>
        </section>
    </div>
  </div>
</div>
