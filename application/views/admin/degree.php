<!-- Start .row -->
<div class=row> 
    <div class="col-lg-12">
        <div class=" panel-default toggle panelMove panelClose panelRefresh"></div>
        <div class=panel-body>
            <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/adddegree');" data-toggle="modal"><i class="fa fa-plus"></i> Department</a>
            <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                <thead>
                    <tr>
                        <th>No</th>
                        <th><?php echo ucwords("department name"); ?></th>
                        <th><?php echo ucwords("status"); ?></th>
                        <th><?php echo ucwords("action"); ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($degrees as $row):
                        ?>
                        <tr>
                            <td></td>
                            <td><?php echo $row['d_name']; ?></td>                         
                            <td>
                                <?php if ($row['d_status'] == '1') { ?>
                                    <span>Active</span>
                                <?php } else { ?>	
                                    <span>Inactive</span>
                                <?php } ?>
                            </td>
                            <td class="menu-action">
                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_degree/<?php echo $row['d_id']; ?>');" data-toggle="modal"><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>
                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/degree/delete/<?php echo $row['d_id']; ?>');" data-toggle="modal" ><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>						
                </tbody>
            </table>
        </div>
    </div>
    <!-- End .panel -->
</div>

</div>

</div>
<!-- End .row -->
</div>
<!-- End contentwrapper -->

