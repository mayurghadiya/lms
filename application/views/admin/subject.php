<!-- Middle Content Start -->    
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
                        </div>						-->
            <div class="panel-body table-responsive">
                <a class="links"  onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addsubject/');" href="#" id="navfixed" data-toggle="tab"><i class="fa fa-plus"></i> Subject</a>
                <table class="table table-striped table-responsive table-bordered" id="datatable-list">
                    <thead>
                        <tr>
                            <th><div>#</div></th>											
                            <th><div><?php echo ucwords("Subject Name"); ?></div></th>											
                            <th><div><?php echo ucwords("Subject Code"); ?></div></th>											
                            <th><div><?php echo ucwords("Branch"); ?></div></th>											
                            <th><div><?php echo ucwords("Semester"); ?></div></th>									
                            <th><div><?php echo ucwords("Action"); ?></div></th>											
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;
                        foreach ($subject as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>	
                                <td><?php echo $row->subject_name; ?></td>												
                                <td><?php echo $row->subject_code; ?></td>
                                <td>
                                    <?php
                                    foreach ($course as $crs) {
                                        if ($crs->course_id == $row->sm_course_id) {
                                            echo $crs->c_name;
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach ($semester as $sem) {
                                        if ($sem->s_id == $row->sm_sem_id) {
                                            echo $sem->s_name;
                                        }
                                    }
                                    ?>

                                </td>												                                             
                                <td class="menu-action">
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_subject/<?php echo $row->sm_id; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/subject/delete/<?php echo $row->sm_id; ?>');" data-original-title="Remove" data-toggle="tooltip" data-placement="top" ><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>
                                </td>
                            </tr>
<?php endforeach; ?>						
                    </tbody>
                </table>
            </div>
        </div>
        <!----TABLE LISTING ENDS--->


    </div>
</div>

<script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.validate.min.js"></script>
