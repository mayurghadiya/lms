<?php if ($param == 'allassignment') { ?>

    <table class="table table-striped table-bordered table-responsive" id="data-tables">
        <thead>
            <tr>
                <th>No</th>												
                <th>Assignment</th>
                <th>Department</th>
                <th>Branch</th>												
                <th>Batch</th>												
                <th>Semester</th>	
                <th><?php echo ucwords("Description"); ?></th>
                <th>File</th>
                <th>Date of Submission</th>												
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
                    <td><?php
                        foreach ($degree as $dgr):
                            if ($dgr->d_id == $row->assign_degree):

                                echo $dgr->d_name;
                            endif;


                        endforeach;
                        ?></td>
                    <td>
                        <?php
                        foreach ($course as $crs) {
                            if ($crs->course_id == $row->course_id) {
                                echo $crs->c_name;
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        foreach ($batch as $bch) {
                            if ($bch->b_id == $row->assign_batch) {
                                echo $bch->b_name;
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        foreach ($semester as $sem) {
                            if ($sem->s_id == $row->assign_sem) {
                                echo $sem->s_name;
                            }
                        }
                        ?>													
                    </td>
                    <td  ><?php echo wordwrap($row->assign_desc, 30, "<br>\n"); ?></td>
                    <td><a href="<?php echo base_url().'uploads/project_file/'.$row->assign_filename; ?>" download="" title="<?php echo $row->assign_title; ?>"><i class="fa fa-download"></i></a></td>	
                    <td><?php echo date('F d, Y', strtotime($row->assign_dos)); ?></td>	
                    <td class="menu-action">
                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_assignment/<?php echo $row->assign_id; ?>');"  data-toggle="tooltip" data-placement="top"  ><span class="label label-primary mr6 mb6">
<i class="fa fa-pencil" aria-hidden="true"></i>
Edit
</span></a>

                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>professor/assignment/delete/<?php echo $row->assign_id; ?>');"    title="Remove" data-toggle="tooltip" data-placement="top" ><span class="label label-danger mr6 mb6">
<i class="fa fa-trash-o" aria-hidden="true"></i>
Delete
</span></a>
                         <?php
                         $current = date("Y-m-d H:i:s");
                         $dos = date("Y-m-d H:i:s", strtotime($row->assign_dos));
                         if ($dos < $current) {
                         ?>
                         <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_reopen_assignment/<?php echo $row->assign_id; ?>');" data-toggle="modal"><span class="label label-primary mr6 mb6">Reopen</span></a>
                         <?php } ?>
                    </td>	
                </tr>
            <?php endforeach; ?>						
        </tbody>
    </table>

    <?php
}
if ($param == 'submitted') {
    ?>
    
        <table class="table table-striped table-bordered table-responsive" id="data-tabless">
            <thead>
                <tr>
                    <th>No</th>												
                    <th>Assignment</th>
                    <th>Student</th>
                    <th>Department</th>
                    <th>Branch</th>												
                    <th>Batch</th>												
                    <th>Sem</th>	
                    <th>Submitted-date</th>	
                    <th>Comment</th>
                    <th>Action</th>												                                            
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($submitedassignment as $rowsub):
                    ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $rowsub->assign_title; ?></td>
                        <td><?php echo $rowsub->name; ?></td>
                        <td><?php
                            foreach ($degree as $dgr):
                                if ($dgr->d_id == $rowsub->assign_degree):

                                    echo $dgr->d_name;
                                endif;


                            endforeach;
                            ?></td>
                        <td>
                            <?php
                            foreach ($course as $crs) {
                                if ($crs->course_id == $rowsub->course_id) {
                                    echo $crs->c_name;
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            foreach ($batch as $bch) {
                                if ($bch->b_id == $rowsub->assign_batch) {
                                    echo $bch->b_name;
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            foreach ($semester as $sem) {
                                if ($sem->s_id == $rowsub->assign_sem) {
                                    echo $sem->s_name;
                                }
                            }
                            ?>													
                        </td>	
                        <td><?php echo date_formats($rowsub->submited_date); ?></td>	
                        <td><?php echo $rowsub->comment; ?></td>
                        <td><a href="<?php echo base_url(); ?>uploads/project_file/<?php echo $rowsub->document_file; ?>" download="" title="<?php echo $rowsub->document_file; ?>"><i class="fa fa-download"></i></a></td>                      	
                    </tr>
                <?php endforeach; ?>						
            </tbody>
        </table>
    
<?php }
if ($param == 'assessments') {
    ?>
    
        <table class="table table-striped table-bordered table-responsive" id="data-tabless">
            <thead>
                <tr>
                    <th>No</th>												
                    <th>Assignment</th>
                    <th>Student</th>
                    <th>Department</th>
                    <th>Branch</th>												
                    <th>Batch</th>												
                    <th>Sem</th>	
                    <th>Submitted-Date</th>	
                    <th>Comment</th>
                    <th><?php echo ucwords("File"); ?></th>	
                    <th>Action</th>												                                            
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($submitedassignment as $rowsub):
                    ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $rowsub->assign_title; ?></td>
                        <td><?php echo $rowsub->name; ?></td>
                        <td><?php
                            foreach ($degree as $dgr):
                                if ($dgr->d_id == $rowsub->assign_degree):

                                    echo $dgr->d_name;
                                endif;


                            endforeach;
                            ?></td>
                        <td>
                            <?php
                            foreach ($course as $crs) {
                                if ($crs->course_id == $rowsub->course_id) {
                                    echo $crs->c_name;
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            foreach ($batch as $bch) {
                                if ($bch->b_id == $rowsub->assign_batch) {
                                    echo $bch->b_name;
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            foreach ($semester as $sem) {
                                if ($sem->s_id == $rowsub->assign_sem) {
                                    echo $sem->s_name;
                                }
                            }
                            ?>													
                        </td>	
                        <td><?php echo date_formats($rowsub->submited_date); ?></td>	
                        <td><?php echo $rowsub->comment; ?></td>
                        <td><a href="<?php echo base_url(); ?>uploads/project_file/<?php echo $rowsub->document_file; ?>" download="" title="<?php echo $rowsub->document_file; ?>"><i class="fa fa-download"></i></a></td>                      	
                        <td class="menu-action">
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_assessment/<?php echo $rowsub->assignment_submit_id; ?>');" data-toggle="modal"><span class="label label-primary mr6 mb6">Assessment</span></a>
                                                 
                                                </td>	
                    </tr>
                <?php endforeach; ?>						
            </tbody>
        </table>
    
<?php } ?>
<script type="text/javascript">
    $(document).ready(function () {
        "use strict";
        $('#data-tables').dataTable({"language": { "emptyTable": "No data available" }});
    });
    $(document).ready(function () {
        "use strict";
        $('#data-tabless').dataTable({"language": { "emptyTable": "No data available" }});
    });
</script>
