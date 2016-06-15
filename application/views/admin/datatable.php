<!-- Start .row -->
<div class=row> 
    <div class="col-lg-12">
        <div class=" panel-default toggle panelMove panelClose panelRefresh"></div>
        <div class=panel-body>
            <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/adddegree');" data-toggle="modal"><i class="fa fa-plus"></i> Department</a>
            <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                <thead>
                    <tr>
                        <th>No</th>
                        <th><?php echo ucwords("department name"); ?></th>
                        <th><?php echo ucwords("status"); ?></th>
                        <th><?php echo ucwords("action"); ?></th>
                    </tr>
                </thead>

                
            </table>
        </div>
    </div>
    <!-- End .panel -->
</div>

</div>

</div>
<!-- End .row -->
</div>
<!-- End contentwrapper -->
<script>
    $(document).ready(function() {
        $('#dataTables').dataTable({
            "ajax": "<?php echo base_url('admin/get_json'); ?>",
            "pageLength": <?php echo $this->config->item('results_per_page'); ?>,
            "order": [[ 0, "desc" ]],
            "aoColumnDefs": [
                { "bVisible": false, "aTargets": [0] },
                {
                    "bSortable": false,
                    "aTargets": ["no-sort"]  
                }],
            "dom": 'T<"clear">lfrtip',
            tableTools: {
                "sSwfPath": "<?php echo base_url("plugins/data_tables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"); ?>"
            }
        });
});
</script>

