<div id=footer class="clearfix sidebar-page right-sidebar-page">
    <!-- Start #footer  -->

    <p class=pull-left>Copyrights &copy; <?php echo date('Y'); ?> <a href="http://searchnative.in/" class="color-blue strong" target=_blank>Learning Management System</a>. All rights reserved.</p>    

</div>
<!-- End #footer  -->
</div>
<!-- / #wrapper --><!-- Back to top -->
<div id=back-to-top><a href=#>Back to Top</a></div>
<style type="text/css">
    .panel.panel-default.toggle.panelMove.panelClose.panelRefresh {overflow: hidden;}
</style>
<!-- Javascripts -->

<script src=<?php echo base_url(); ?>assets/plugins/core/pace/pace.min.js></script>

<!-- Important javascript libs(put in all pages) -->
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<!--[if lt IE 9]>
    <script type="text/javascript" src="js/libs/excanvas.min.js"></script>
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script type="text/javascript" src="js/libs/respond.min.js"></script>
    <![endif]-->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/datepick/bootstrap-datepicker.min.js" charset="UTF-8"></script>

<script src="<?php echo base_url(); ?>assets/plugins/forms/bootstrap-timepicker/bootstrap-timepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/forms/select2/select2.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/forms/dual-list-box/jquery.bootstrap-duallistbox.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/forms/summernote/summernote.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/forms-validation.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/tables-data.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.toaster.js"></script>
<script src="<?php echo base_url();?>assets/js/multiselect.min.js"></script>
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
</head>
</body>
</html>

