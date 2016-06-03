

    <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="datatable-list">
                            <thead>
                                <tr>
                                    <th>#</th>												
                                    <th><?php echo ucwords("Syllabus Title"); ?></th>
                                    <th><?php echo ucwords("department"); ?></th>
                                    <th><?php echo ucwords("Branch"); ?></th>												                                                
                                    <th><?php echo ucwords("Semester"); ?></th>
                                    <th><?php echo ucwords("Description"); ?></th>
                                    <th><?php echo ucwords("File"); ?></th>                                            
                                    <th><?php echo ucwords("Action"); ?></th>											
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                foreach ($syllabus as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>	

                                        <td><?php echo $row->syllabus_title; ?></td>	
                                        <td><?php
                                            foreach ($degree as $dgr):
                                                if ($dgr->d_id == $row->syllabus_degree):

                                                    echo $dgr->d_name;
                                                endif;


                                            endforeach;
                                            ?></td>
                                        <td>
                                            <?php
                                            foreach ($course as $crs) {
                                                if ($crs->course_id == $row->syllabus_course) {
                                                    echo $crs->c_name;
                                                }
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            foreach ($semester as $sem) {
                                                if ($sem->s_id == $row->syllabus_sem) {
                                                    echo $sem->s_name;
                                                }
                                            }
                                            ?>													
                                        </td>	
                                        <td><?php echo wordwrap($row->syllabus_desc, 30, "<br>\n"); ?></td>
                                        <td id="downloadedfile"><a href="<?php echo base_url() . 'uploads/syllabus/' . $row->syllabus_filename; ?>" download="" title="<?php echo $row->syllabus_title; ?>"><i class="fa fa-download"></i></a></td>	                                                  
                                        <td class="menu-action">
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_syllabus/<?php echo $row->syllabus_id; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>

                                            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/syllabus/delete/<?php echo $row->syllabus_id; ?>');" data-original-title="Remove" data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>	
                                        </td>	
                                    </tr>
                                <?php endforeach; ?>						
                            </tbody>
                        </table>
<script type="text/javascript">
    $(document).ready(function () {
        "use strict";
        $('#datatable-list').dataTable();
    });
    $(document).ready(function () {
        "use strict";
        $('#data-tabless').dataTable();
    });
</script>
