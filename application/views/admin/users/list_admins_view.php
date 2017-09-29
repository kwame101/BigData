<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top: 60px;">
  <script type="text/javascript">
  function hideShow() {
    var tog = document.getElementById('adduser');
    if (tog.style.display === 'none') {
        tog.style.display = 'block';
    } else {
        tog.style.display = 'none';
    }
  }
  </script>
  <div class="row">
    <div class="col-lg-12">
      <p>Add a new admin </p> <button onclick="hideShow()">Create new account</button>
      <div id="adduser" style="display:none;">
      <?php echo form_open('',array('class'=>'form-horizontal'));?>
        <div class="form-group">
          <?php echo form_error('company');?>
          <?php echo form_input('company','','class="form-control" placeholder="Company Name"');?>
        </div>
        <div class="form-group">
          <?php echo form_error('email');?>
          <?php echo form_input('email','','class="form-control" placeholder="Email"');?>
        </div>
        <div class="form-group">
            <?php echo form_submit('submit', 'Add user', 'class="btn"');?>
        </div>
      <?php echo form_close();?>
    </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
    <?php
    if(!empty($users))
    {
      echo '<table class="top_view">';
      echo '<tr><th>Email</th><th>Company</th><th></th> </tr>';
      foreach($users as $user)
      {
        echo '<tr class="user_view">';
        echo '<td>'.$user->email.'</td><td>'.$user->company.'</td>'; ?>

        <td><a href="<?php echo site_url('admin/users/delete/'.$user->id);?>"> Delete User </a></td>
        <?php
        echo '</tr>';
      }
     echo '</table>';
    }
    ?>
    </div>
  </div>
</div>
