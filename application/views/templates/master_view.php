<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/partial/master_header_view'); ?>
<div class="container">
    <div class="main-content">
        <?php echo $the_view_content; ?>
    </div>
</div>
<?php $this->load->view('templates/partial/master_footer_view');?>
