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
                <a href="#" class="links"   onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addassessment');" data-toggle="modal"><i class="fa fa-plus"></i> Assessment</a>
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>#</th>												
                            <th>Student</th>
                            <th>Department</th>
                            <th>Branch</th>												
                            <th>batch</th>												
                            <th>Semester</th>
                            <th>Instruction</th>
                            <th>Feedback</th>                                                
                            <th>Action</th>		
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach (@$assessments as $row):
                            $datastudent = $this->db->get_where('student', array("std_id" => $row['student']))->result();
                            ?>
                            <tr>
                                <td></td>	
                                <td><?php echo $datastudent[0]->name; ?></td>
                                <td><?php
                                    foreach ($degree as $dgr):
                                        if ($dgr->d_id == $row['degree']):

                                            echo $dgr->d_name;
                                        endif;


                                    endforeach;
                                    ?></td>
                                <td>
                                    <?php
                                    foreach ($course as $crs) {
                                        if ($crs->course_id == $row['course']) {
                                            echo $crs->c_name;
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach ($batch as $bch) {
                                        if ($bch->b_id == $row['batch']) {
                                            echo $bch->b_name;
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach ($semester as $sem) {
                                        if ($sem->s_id == $row['semester']) {
                                            echo $sem->s_name;
                                        }
                                    }
                                    ?>													
                                </td>
                                <td><?php echo $row['instruction']; ?></td>	

                                <td><?php echo wordwrap($row['feedback_tutor'], 30, "<br>\n"); ?></td>                                                   
                                <td class="menu-action">
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_assessment/<?php echo $row['assessment_id']; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top"><span class="label label-primary mr6 mb6">
<i class="fa fa-pencil" aria-hidden="true"></i>
Edit
</span></a>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>professor/assessments/delete/<?php echo $row['assessment_id']; ?>');" data-original-title="delete" data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6">
<i class="fa fa-trash-o" aria-hidden="true"></i>
Delete
</span></a>
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