<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <div class=panel-body>                  
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>			
                            <th>Topic Name</th>
                            <th>Branch</th>
                            <th>Attachment</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($courseware as $row) {
                            ?>
                            <tr>
                                <td></td>
                                <td><?php echo $row['topic']; ?></td>
                                <td><?php echo $row['c_name']; ?></td>
                                <td id="downloadedfile"><a href="<?= base_url() ?>uploads/courseware/<?php echo $row['attachment']; ?>" download="" title="<?php echo $row['attachment']; ?>"><i class="fa fa-download"></i></a></td>	
                                <td><?php echo $row['description']; ?></td>
                                <td>
                                    <?php if ($row['status'] == '1') { ?>
                                        <span>Active</span>
                                    <?php } else { ?>	
                                        <span>InActive</span>
                                    <?php } ?>
                                </td>
                                <td class="menu-action">
                                     
                                   <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/courseware/delete/<?php echo $row['courseware_id']; ?>');" data-original-title="Remove" data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>														
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