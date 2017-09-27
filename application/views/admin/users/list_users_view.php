<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top: 60px;">
  <div class="row">
    <div class="col-lg-12">
      <a href="<?php echo site_url('admin/users/create');?>" class="btn btn-primary">Create user</a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
      <script type="text/javascript">
      $(document).ready(function () {
        $(".top_view tr.tryout").hide();
        $(".top_view td.view_times").on('click',function () {
        if($(this).html() == '<button> View User </button>'){
              $(this).html('<button> Close User </button>');
              $(this).parent('tr').next('tr.tryout').fadeIn();
        }
        else{
              $(this).html('<button> View User </button>');
              $(this).parent('tr').next('tr.tryout').fadeOut();
            }
         });
      });

      </script>
    <?php
    if(!empty($users))
    {
      echo '<table class="top_view">';
      echo '<tr> <th>Name</th> <th>Email</th><th>Company</th><th></th> </tr>';
      foreach($users as $user)
      {
        echo '<tr class="user_view">';
        echo '<td>'.$user->first_name.' '.$user->last_name.'</td><td>'.$user->email.'</td><td>'.$user->company.'</td><td class="view_times"><button> View User </button></td>';
        echo '</tr>';

        echo '<tr class="tryout"><td colspan=4><table>';
        echo '<tr> <th>Date</th> <th>Time in</th><th>Time out</th><th>Time spent</th></tr>';
        foreach($users as $user)
        {
          echo '<tr class="user_ses">';
          echo '<td>'.$user->first_name.' '.$user->last_name.'</td><td>'.$user->email.'</td><td>'.$user->company.'</td><td>test</td>';
          echo '</tr>';
        }
        echo '<td style="visibility:hidden;"></td><td style="visibility:hidden;"></td><td style="text-align:right"><strong>Total:</strong></td><td>000000</td>';
        echo '</table></td></tr>';
      }
     echo '</table>';
    }
    ?>
    </div>
  </div>
</div>
