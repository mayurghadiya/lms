<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <!--            <div class=panel-heading>
                            <h4 class=panel-title><?php echo $title; ?></h4>
                            <div class="panel-controls panel-controls-right">
                                <a class="panel-refresh" href="#"><i class="fa fa-refresh s12"></i></a>
                                <a class="toggle panel-minimize" href="#"><i class="fa fa-plus s12"></i></a>
                                <a class="panel-close" href="#"><i class="fa fa-times s12"></i></a>
                            </div>
                        </div>-->
            <div class=panel-body>
                <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addpayment');" data-toggle="modal"><i class="fa fa-plus"></i> Make Payment</a>
                <table id="fee-datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Student Name</th>
                            <th>Department</th>
                            <th>Branch</th>
                            <th>Batch</th>
                            <th>Semester</th>
                            <th>Paid Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $counter = 1; ?>
                        <?php foreach ($student_fees as $row) { ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo $row->std_first_name . ' ' . $row->std_last_name; ?></td>
                                <td><?php echo $row->d_name; ?></td>
                                <td><?php echo $row->c_name; ?></td>
                                <td><?php echo $row->b_name; ?></td>
                                <td><?php echo $row->s_name; ?></td>
                                <td>$<?php echo $row->paid_amount; ?></td>
                                <td><?php echo date('M d, Y', strtotime($row->paid_created_at)); ?></td>
                                <td class="menu-action">
                                    <a href="<?php echo base_url('admin/invoice/' . $row->fees_structure_id); ?>" target="_blank"><span class="label label-primary mr6 mb6">View</span></a>
                                    <a target="_blank" href="<?php echo base_url('admin/invoice_print/' . $row->student_fees_id); ?>"><span class="label label-danger mr6 mb6">Download</span></a>
                                </td>
                            </tr>
                        <?php } ?>														
                    </tbody>
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
$(document).ready(function(){
    $('#fee-datatable-list').DataTable({});
});
</script>