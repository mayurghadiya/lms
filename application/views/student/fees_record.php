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
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><div>Title</div></th>
                            <th><div>Paid</div></th>
                            <th><div>Status</div></th>
                            <th><div>Date</div></th>
                            <th><div>Options</div></th>
                        </tr>
                    </thead>
                    <tbody>                   
                        <?php
                        foreach ($fees_record as $row) {
                            ?>
                            <tr>
                                <td></td>
                                <td><?php echo $row->title; ?></td>
                                <td>
                                    <?php echo $row->paid_amount; ?>
                                </td>
                                <td>Paid</td>
                                <td><?php echo date('F d, Y h:m A', strtotime($row->paid_created_at)); ?></td>
                                <td>
                                    <a href="<?php echo base_url('student/invoice/' . $row->student_fees_id); ?>"><span class="label label-primary mr6 mb6">View</span></a>
                                    <a href="<?php echo base_url('student/invoice_print/' . $row->student_fees_id); ?>"><span class="label label-danger mr6 mb6">Download</span></a>                                    
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