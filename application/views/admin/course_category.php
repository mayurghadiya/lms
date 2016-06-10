<!-- Start .row -->
<div class=row>                      

    <div class="col-lg-12">
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle">
            <div class="panel-body">
                <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/add_course_category');" data-toggle="modal"><i class="fa fa-plus"></i> Category</a>
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th><?php echo ucwords("category name"); ?></th>
                            <th><?php echo ucwords("Status"); ?></th>
                            <th><?php echo ucwords("Action"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($category as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['category_name']; ?></td>                                               

                                <td>
                                    <?php if ($row['category_status'] == '1') { ?>
                                        <span class="label label-success">Active</span>
                                    <?php } else { ?>	
                                        <span class="label label-default">InActive</span>
                                    <?php } ?>
                                </td>
                                <td class="menu-action">
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_course_category/<?php echo $row['category_id']; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>

                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/category/delete/<?php echo $row['category_id']; ?>');" data-original-title="Remove" data-toggle="tooltip" data-placement="top" ><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>						
                    </tbody>
                </table>
            </div>           
        </div>
        <!-- row --> 
    </div>
</div></div></div>
