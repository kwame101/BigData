<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1> Topics </h1>
<div class="container" style="margin-top:20px;">
  <div class="row">
    <div class="col-lg-12">
      <a href="<?php echo site_url('admin/support/addCategory');?>" class="btn btn-primary">Create category</a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
      <?php
    if(!empty($category))
      {
        echo '<table class="table table-hover table-bordered table-condensed">';
        echo '<tr><td>ID</td><td>Category name</td></td><td>Category email</td><td>Operations</td></tr>';
        foreach($category as $cat)
        {
          echo '<tr>';
          echo '<td>'.$cat->id.'</td><td>'.$cat->name.'</td><td>'.$cat->email.'</td><td>'.anchor('admin/support/editCategory/'.$cat->id,'<span class="glyphicon glyphicon-pencil"></span>');
          echo '</td>';
          echo '</tr>';
        }
        echo '</table>';
       }
      ?>
    </div>
  </div>
</div>
