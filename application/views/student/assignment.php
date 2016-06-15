<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <div class=panel-body>
                <div class="tabs mb20">
                    <ul id="import-tab" class="nav nav-tabs">
                        <li class="active">
                            <a href="#assignment-list" data-toggle="tab" aria-expanded="true">Assignment List</a>
                        </li>
                        <li class="">
                            <a href="#submitted-assignment" data-toggle="tab" aria-expanded="false">Submitted Assignment</a>
                        </li>
                        <li class="">
                            <a href="#assessment" data-toggle="tab" aria-expanded="false">Assessment</a>
                        </li>
                    </ul>
                    <div id="import-tab-content" class="tab-content">
                        <div class="tab-pane fade active in" id="assignment-list">
                            <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Assignment Name</th>											
                                        <th>Date of submission</th>
                                        <th>File</th>      
                                        <th>Instruction</th>                                                                                      
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($assignment as $row):
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $row->assign_title; ?></td>	                                                    	                                                   
                                            <td><?php echo date("F d, Y", strtotime($row->assign_dos)); ?></td>		                                           
                                            <td> <a href="<?php echo base_url(); ?>uploads/project_file/<?php echo $row->assign_filename; ?>" download="" title="<?php echo $row->assign_filename; ?>"><i class="fa fa-download"></i></a></td>
                                            <td><?php echo wordwrap($row->assignment_instruction, 30, "<br>\n"); ?></td>
                                            <td> 
                                                <?php
                                                $current = date("Y-m-d H:i:s");
                                                $dos = date("Y-m-d H:i:s", strtotime($row->assign_dos));
                                                $student_id = $this->session->userdata("login_user_id");
                                                $assignment = $this->Student_model->getchecksubmitted($row->assign_id, $student_id);
                                                if ($dos >= $current && $assignment < 1) {
                                                    ?>
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_submit_assignment/<?php echo $row->assign_id; ?>');" data-original-title="submit assignment" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6"><i class="icomoon-icon-plus mr0"></i> Add</span></a>
                                                    <?php
                                                } else {
                                                    if ($assignment < 1) {
                                                        $res = $this->Student_model->get_student_reopen_assignment($row->assign_id, $student_id);
                                                        if ($res > 0) {
                                                            ?>
                                                            <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_submit_assignment/<?php echo $row->assign_id; ?>');" data-original-title="submit assignment" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6"><i class="icomoon-icon-plus mr0"></i> Add</span></a>
                                                            <?php
                                                        } else {
                                                            echo '<span class="label label-danger mr6 mb6">Not Submitted</span>';
                                                        }
                                                    } else {
                                                        echo '<span class="label label-primary mr6 mb6">Submitted</span>';
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>							
                                </tbody>
                            </table>
                        </div>

                        <!-- tab content -->
                        <div class="tab-pane fade" id="submitted-assignment">
                            <?php
                            $this->db->select('s.*,a.*');
                            $this->db->from('assignment_submission s');
                            $this->db->join('assignment_manager a', 'a.assign_id=s.assign_id');
                            $this->db->where('s.student_id', $this->session->userdata('std_id'));
                            $submitassignment = $this->db->get();
                            ?> 
                            <table id="submitted-assignment-datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Assignment Name</th>												
                                        <th>Submitted Date</th>												
                                        <th>Document Name</th>	
                                        <th>File</th>                                                               
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($submitassignment->result() as $srow):
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $srow->assign_title; ?></td>	
                                            <td><?php echo date("F d, Y", strtotime($srow->submited_date)); ?></td>	
                                            <td><?php echo $srow->document_file; ?></td>
                                            <td > 
                                                <a href="<?php echo base_url() ?>uploads/project_file/<?php echo $srow->assign_filename; ?>" download="" data-original-title="download" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6">Download</span></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>						
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade out" id="assessment">
                            <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="datatable-list2">
                                <thead>
                                    <tr>
                                        <th>No</th>		
                                        <th>Assignment Name</th>                                                                          
                                        <th>Submitted File</th>                                                       
                                        <th>Feedback</th>                                                
                                        <th>Grade</th>	
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($assessment->result_array() as $row):
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>	
                                            <td><?php echo $row['assign_title']; ?></td>                                                               
                                            <td id="downloadedfile"><a href="<?php echo base_url() . 'uploads/project_file/' . $row['document_file']; ?>" download=""><i class="fa fa-download"></i></a></td>	                                                              
                                            <td><?php echo wordwrap($row['feedback'], 30, "<br>\n"); ?></td>                                                   
                                            <td><?php echo $row['grade']; ?></td>                                                   
                                        </tr>
                                    <?php endforeach; ?>																									
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
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
        $('#submitted-assignment-datatable-list').DataTable();
        $('#data-tables1').dataTable({"language": { "emptyTable": "No data available" }});
        $("#datatable-list2").dataTable();
    });
</script>
