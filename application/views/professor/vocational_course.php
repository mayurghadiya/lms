<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <div class=panel-body>               
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Course</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Fee</th>                         
                            <th>Status</th>                         
                            <th>Action</th>                         
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($vocationalcourse as $row):
                            ?><tr>
                                <td></td>
                                <td><?php echo $row['course_name']; ?></td>    
                                <td><?php echo date('F d, Y', strtotime($row['course_startdate'])); ?></td>    
                                <td><?php echo date('F d, Y', strtotime($row['course_enddate'])); ?></td>    
                                <td><?php echo system_info('currency') . $row['course_fee']; ?></td>                                  
                                <td>
                                    <?php if ($row['status'] == '1') { ?>
                                        <span>Active</span>
                                    <?php } else { ?>	
                                        <span>InActive</span>
                                    <?php } ?>
                                </td>  
                                <td>
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>professor/vocational_student/<?php echo $row['vocational_course_id'];?>');" data-original-title="registered student" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6">
                                            <i class="fa fa-desktop" aria-hidden="true"></i>View</span></a>
                                </td>
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