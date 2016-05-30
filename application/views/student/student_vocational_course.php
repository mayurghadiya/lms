<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
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
                            <th>Student Name</th>
                            <th>Course Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Course Fee</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($vocational_course as $row):
                            ?>
                            <tr>
                                <td></td>
                                <td><?php echo $row->std_first_name . ' ' . $row->std_last_name; ?></td>    
                                <td><?php echo $row->course_name; ?><td>                                                    
                                <td><?php echo date('M d, Y', strtotime($row->course_startdate)); ?></td>
                                <td><?php echo date('M d, Y', strtotime($row->course_enddate)); ?></td>
                                <td><?php echo $row->course_fee; ?></td>
                            </tr>
                        <?php endforeach; ?>															
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