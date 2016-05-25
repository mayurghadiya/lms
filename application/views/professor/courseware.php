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
                <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addcourseware/');" data-original-title="" data-toggle="tooltip" data-placement="top">Add New Courseware</a>
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>#</th>			
                            <th>Topic</th>
                            <th>Branch</th>
                            <th>Attachment</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($courseware as $row) { ?>
                            <tr>
                                <td></td>
                                <td><?php echo $row['topic']; ?></td>
                                <td><?php echo $row['c_name']; ?></td>
                                <td id="downloadedfile"><a href="<?= base_url() ?>uploads/courseware/<?php echo $row['attachment']; ?>" download="" title="<?php echo $row['attachment']; ?>"><i class="fa fa-download"></i></a></td>	
                                <td><?php echo $row['description']; ?></td>
                                <td>
                                    <?php if ($row['status'] == '1') { ?>
                                        <span class="label label-success">Active</span>
                                    <?php } else { ?>	
                                        <span class="label label-default">InActive</span>
                                    <?php } ?>
                                </td>
                                <td class="menu-action">
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_courseware/<?php echo $row['courseware_id']; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6">Edit</span></a>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>professor/courseware/delete/<?php echo $row['courseware_id']; ?>');" data-original-title="Remove" data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6">Delete</span></a>
                                </td>
                            </tr>
                        <?php } ?>																
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