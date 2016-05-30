<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
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
                <a href="#" class="links"   onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addbatch');" data-toggle="modal"><i class="fa fa-plus"></i> Batch</a>
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Batch</th>
                            <th>Department</th>
                            <th>Branch</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($batches as $row):
                            ?>
                            <tr>
                                <td></td>
                                <td><?php echo $row['b_name']; ?></td>    
                                <td> <?php
                                    $explodedegree = explode(',', $row['degree_id']);
                                    foreach ($degree as $deg) {
                                        if (in_array($deg['d_id'], $explodedegree)) {
                                            echo $deg['d_name'] . "<br> ";
                                        }
                                    }
                                    ?></td>
                                <td>                                                    
                                    <?php
                                    $explodecourse = explode(',', $row['course_id']);
                                    foreach ($course as $crs) {
                                        if (in_array($crs->course_id, $explodecourse)) {
                                            echo $crs->c_name . "<br>";
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($row['b_status'] == '1') { ?>
                                        <span>Active</span>
                                    <?php } else { ?>	
                                        <span>InActive</span>
                                    <?php } ?>
                                </td>
                                <td class="menu-action">
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_batch/<?php echo $row['b_id'];?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/batch/delete/<?php echo $row['b_id']; ?>');" data-original-title="Remove" data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>
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