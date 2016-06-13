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
                <a class="links"  onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addvocationalcourse');" href="#" id="navfixed" data-toggle="tab"><i class="fa fa-plus"></i> Vocational Course</a>
                <table id="vocational-course-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Course</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Fee</th>
                            <th>Professor</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $counter = 0;
                        foreach ($vocationalcourse as $row):
                            ?><tr>
                                <td><?php echo ++$counter; ?></td>
                                <td><?php echo $row['course_name']; ?></td>    
                                <td><?php echo date('F d, Y', strtotime($row['course_startdate'])); ?></td>    
                                <td><?php echo date('F d, Y', strtotime($row['course_enddate'])); ?></td>    
                                <td><?php echo system_info('currency') . $row['course_fee']; ?></td>   
                                <td><?php
                                    $professor = $this->db->get('professor')->result_array();
                                    foreach ($professor as $pro) {
                                        if ($pro['professor_id'] == $row['professor_id']) {
                                            echo $pro['name'];
                                        }
                                    }
                                    ?></td>   
                                <td>
                                    <?php if ($row['status'] == '1') { ?>
                                        <span>Active</span>
                                    <?php } else { ?>	
                                        <span>InActive</span>
                                    <?php } ?>
                                </td>
                                <td class="menu-action">
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_vocational/<?php echo $row['vocational_course_id'];?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/vocationalcourse/delete/<?php echo $row['vocational_course_id']; ?>');" data-original-title="Remove" data-toggle="tooltip" data-placement="top" ><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/vocational_student/<?php echo $row['vocational_course_id'];?>');" data-original-title="registered student" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6"><i class="fa fa-desktop" aria-hidden="true"></i>View</span></a>
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

<script>
$(document).ready(function(){
    $('#vocational-course-list').DataTable({});
});
</script>