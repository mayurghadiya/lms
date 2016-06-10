<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default">
            <div class=panel-body><table id="server-datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <!-- End .panel -->
    </div>
    <!-- col-lg-12 end here -->
</div>
<!-- End .row -->
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->

<script>
    $(document).ready(function () {
        $('#server-datatable-list').DataTable({
            "ajax": "<?php echo base_url('admin/server_data'); ?>",
            "pageLength": 10,
            "order": [[0, "desc"]],
            "aoColumnDefs": [
                {"bVisible": false, "aTargets": [0]},
                {
                    "bSortable": false,
                    "aTargets": ["no-sort"]
                }],
            "dom": 'T<"clear">lfrtip'
        });
    });
</script>
