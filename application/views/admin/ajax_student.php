<table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
    <thead>
        <tr>
            <th>#</th>	
            <th></th>
            <th>Student Name</th>												
            <th>Email</th>												
            <th>Mobile</th>												
            <th>Action</th>	
        </tr>
    </thead>

    <tbody>
        <?php
        foreach ($datastudent as $row):
            ?>
            <tr>
                <td></td>
                <td>
               <td>
                <?php if ($row->profile_photo != '') { ?>
                                <img src="<?= base_url() ?>uploads/student_image/<?= $row->profile_photo; ?>" height="70px" width="70px"/>
                <?php
                } else {
                    if ($row->std_gender == 'Male') {
                        ?>
                                            <img src="<?= base_url() ?>uploads/student_image/male.jpg" height="70px" width="70px"/>
                    <?php } else { ?>
                                            <img src="<?= base_url() ?>uploads/student_image/female.jpg" height="70px" width="70px"/>
                        <?php
                    }
                }
                ?>
                 </td>										
                <td><?php echo $row->std_first_name . " " . $row->std_last_name; ?></td>					
                <td><?php echo $row->email; ?></td>											
                <td><?php echo $row->std_mobile; ?></td>											
                <td class="menu-action">	
                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_student/<?php echo $row->std_id; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow"><i class="fa fa-pencil"></i></a>

                </td>											
            </tr>
<?php endforeach; ?>																			
    </tbody>
</table>