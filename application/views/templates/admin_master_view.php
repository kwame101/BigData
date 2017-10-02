<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/partial/admin_master_header_view'); ?>
<div class="container">
    <div class="main-content">
        <?php echo $the_view_content; ?>
    </div>
</div>

<script type="text/javascript">
    $('.add-contrast a').styleSwitcher(); // Calling the plugin...
</script>

</body>
</html>
