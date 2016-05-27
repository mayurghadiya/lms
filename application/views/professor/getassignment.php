<?php if ($param == 'allassignment') { ?>

    <table class="table table-striped table-bordered table-responsive" id="data-tables">
        <thead>
            <tr>
                <th><div>#</div></th>												
                <th><div>Assignment Name</div></th>
                <th><div>Department</div></th>
                <th><div>Branch</div></th>												
                <th><div>Batch</div></th>												
                <th><div>Semester</div></th>	
                <th><div><?php echo ucwords("Description"); ?></div></th>
                <th><div>File</div></th>
                <th><div>Date of Submission</div></th>												
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
                    <td><a href="<?php echo $row->assign_url; ?>" download="" title="<?php echo $row->assign_title; ?>"><i class="fa fa-download"></i></a></td>	
                    <td><?php echo date('F d, Y', strtotime($row->assign_dos)); ?></td>	
                    <td class="menu-action">
                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_assignment/<?php echo $row->assign_id; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top"  ><span class="label label-primary mr6 mb6">
<i class="fa fa-pencil" aria-hidden="true"></i>
Edit
</span></a>

                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>professor/assignment/delete/<?php echo $row->assign_id; ?>');"    title="Remove" data-toggle="tooltip" data-placement="top" ><span class="label label-danger mr6 mb6">
<i class="fa fa-trash-o" aria-hidden="true"></i>
Delete
</span></a>
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
                    <th><div>#</div></th>												
                    <th><div>Assignment Name</div></th>
                    <th><div>Student Name</div></th>
                    <th><div>Department</div></th>
                    <th><div>Branch</div></th>												
                    <th><div>Batch</div></th>												
                    <th><div>Sem</div></th>	
                    <th><div>Submitted date</div></th>	
                    <th><div>Comment</div></th>
                    <th><div>Action</div></th>												                                            
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
    
<?php } ?>
<script type="text/javascript">
    $(document).ready(function () {
        "use strict";
        $('#data-tables').dataTable();
    });
    $(document).ready(function () {
        "use strict";
        $('#data-tabless').dataTable();
    });
</script>
