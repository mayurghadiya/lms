</div>
</div>
</div>
<div id=footer class="clearfix sidebar-page">
    <!-- Start #footer  Copyright © 2016 Lore Brain. All Rights Reserved  -->

    <p class=pull-left>Copyrights &copy; 2016 <a href="#" class="color-blue strong" target=_blank>Learning Management System</a>. All rights reserved.</p>

</p>
</div>
<!-- End #footer  -->
</div>
<!-- / #wrapper --><!-- Back to top -->
<div id=back-to-top><a href=#>Back to Top</a></div>
<style type="text/css">
    .panel.panel-default.toggle.panelMove.panelClose.panelRefresh {overflow: hidden;}
</style>
<!-- Javascripts -->
<?php
$js = [
    ['plugins/pace.js']
];
$this->carabiner->group('pace', [
    'js' => $js
]);
$this->carabiner->display('pace');
?>
<!-- Important javascript libs(put in all pages) -->
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
<!--[if lt IE 9]>
    <script type="text/javascript" src="js/libs/excanvas.min.js"></script>
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script type="text/javascript" src="js/libs/respond.min.js"></script>
    <![endif]-->

<?php
$js = [
    ['plugins/bootstrap-datepicker.js'],
    ['plugins/bootstrap-timepicker.js'],
    ['plugins/jquery.bootstrap-duallistbox.js'],
    ['plugins/summernote.js'],
    ['plugins/forms-validation.js'],
    ['plugins/tables-data.js'],
    ['custom.js'],
    ['plugins/select2.js'],
    ['jquery.toaster.js'],
    ['multiselect.js']
];
$this->carabiner->group('footer_js', [
    'js' => $js
]);
$this->carabiner->display('footer_js');
?>
<script>
<?php
$message = $this->session->flashdata('flash_message');
if ($message != '') {
    ?>
        $.toaster({
            priority: 'success',
            title: 'Success! ',
            message: '<?php echo $message; ?>',
            timeOut: 5000
        });
<?php } ?>
</script> 

<script>
    var method_name = '<?php echo $this->router->fetch_method(); ?>';
    if (method_name == 'dashboard' || method_name == 'index') {
        $('#body').addClass('dashboard');
    }
</script>
<?php include 'modal.php'; ?>
</body>
</html>