<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <div class=panel-body>
                <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/add_forum_topic');" data-toggle="modal"><i class="fa fa-plus"></i> Forum Topic</a>
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Forum Topics Title</th>
                            <th>User Role</th>
                            <th>Started By</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>View Comments</th>                            
                            <th>Add Comment</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($forum_topic as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['forum_topic_title']; ?></td>
                                <td><?php echo $row['user_role']; ?></td> 
                                <td><?php echo roleuserdatatopic($row['user_role'], $row['user_role_id']); ?></td>                         
                                <td>
                                    <?php if ($row['forum_topic_status'] == '1') { ?>
                                        <span>Active</span>
                                    <?php } else { ?>	
                                        <span>InActive</span>
                                    <?php } ?>

                                </td>
                                <td><?php echo date('M d, Y', strtotime($row['created_date'])); ?></td>
                                <td><a href="<?php echo base_url() . 'admin/forumcomment/' . $row['forum_topic_id']; ?>"  data-toggle="tooltip" data-placement="top" class="icon_link"><i class="fa fa-file-o"></i></a>                                   
                                    <span class="notification2"><?php echo countcommenttopic($row['forum_topic_id']); ?></span>
                                </td>
                                <td>     <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addcomments/<?php echo $row['forum_topic_id']; ?>');" data-toggle="modal">
                                <span class="label label-primary mr6 mb6"><i aria-hidden="true" class="fa fa-plus"></i>Add</span></a></td>
                                
                                <td>
                                
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_forumtopic/<?php echo $row['forum_topic_id']; ?>');"  data-toggle="tooltip" data-placement="middle"><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/topicscrud/delete/<?php echo $row['forum_topic_id']; ?>');"  data-toggle="tooltip" data-placement="middle"><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>
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
