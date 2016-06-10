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
                            <th>No</th>											
                            <th>Participate</th>											
                            <th>Department</th>											
                            <th>Branch</th>
                            <th>Batch</th>											
                            <th>Semester</th>											                                              
                            <th>Date</th>	
                        </tr>
                    </thead>

                    <tbody>
                        <?php $count = 1; ?>
                        <?php foreach ($participate as $row): ?>
                            <tr>
                                <td></td>	
                                <td><?php echo $row->pp_title; ?></td>	
                                <td>
                                    <?php
                                    if ($row->pp_degree == "All") {
                                        echo "All";
                                    } else {
                                        foreach ($degree as $deg) {

                                            if ($deg->d_id == $row->pp_degree) {
                                                echo $deg->d_name;
                                            }
                                        }
                                    }
                                    ?>
                                </td>	
                                <td>
                                    <?php
                                    if ($row->pp_course == "All") {
                                        echo "All";
                                    } else {
                                        foreach ($course as $crs) {

                                            if ($crs->course_id == $row->pp_course) {
                                                echo $crs->c_name;
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($row->pp_batch == "All") {
                                        echo "All";
                                    } else {
                                        foreach ($batch as $bch) {

                                            if ($bch->b_id == $row->pp_batch) {
                                                echo $bch->b_name;
                                            }
                                        }
                                    }
                                    ?>
                                </td>	
                                <td>
                                    <?php
                                    if ($row->pp_semester == "All") {
                                        echo "All";
                                    } else {
                                        foreach ($semester as $sem) {

                                            if ($sem->s_id == $row->pp_semester) {
                                                echo $sem->s_name;
                                            }
                                        }
                                    }
                                    ?>

                                </td>	

                                <td><?php echo date('M d, Y', strtotime($row->pp_dos)); ?></td>	


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