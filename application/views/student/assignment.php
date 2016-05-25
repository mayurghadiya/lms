<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <div class=panel-heading>
                <h4 class=panel-title><?php echo $title; ?></h4>
                <div class="panel-controls panel-controls-right">
                    <a class="panel-refresh" href="#"><i class="fa fa-refresh s12"></i></a>
                    <a class="toggle panel-minimize" href="#"><i class="fa fa-plus s12"></i></a>
                    <a class="panel-close" href="#"><i class="fa fa-times s12"></i></a>
                </div>
            </div>
            <div class=panel-body>
                <div class="tabs mb20">
                    <ul id="import-tab" class="nav nav-tabs">
                        <li class="active">
                            <a href="#assignment-list" data-toggle="tab" aria-expanded="true">Assignment List</a>
                        </li>
                        <li class="">
                            <a href="#submitted-assignment" data-toggle="tab" aria-expanded="false">Submitted Assignment</a>
                        </li>
                    </ul>
                    <div id="import-tab-content" class="tab-content">
                        <div class="tab-pane fade active in" id="assignment-list">
                            <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                                <thead>
                                    <tr>
                                        <th><div>#</div></th>
                                        <th><div>Assignment Name</div></th>											
                                        <th><div>Date of submission</div></th>
                                        <th><div>Description</div></th>
                                        <th><div>File</div></th>                                                    
                                        <th><div>Action</div></th>
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

                                            <td><?php echo wordwrap($row->assign_desc, 30, "<br>\n"); ?></td>
                                            <td> <a href="uploads/project_file/<?php echo $row->assign_filename; ?>" download="" title="<?php echo $row->assign_filename; ?>"><i class="fa fa-download"></i></a></td>
                                            <td> 
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_submit_assignment/<?php echo $row->assign_id; ?>');" data-original-title="submit assignment" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6">Details</span></a>
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
                                        <th><div>#</div></th>
                                        <th><div>Assignment Name</div></th>												
                                        <th><div>Submitted Date</div></th>												
                                        <th><div>Document Name</div></th>	
                                        <th><div>File</div></th>                                                               
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
$(document).ready(function(){
    $('#submitted-assignment-datatable-list').DataTable();
});
</script>