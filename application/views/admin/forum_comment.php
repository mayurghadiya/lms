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

                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th>Forum Comments</th>
                            <th>User Roll</th>
                            <th>Comment By</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($forum_comment as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['forum_comments']; ?></td>                         
                                <td><?php echo $row['user_role']; ?></td> 
                                <td><?php echo roleuserdatatopic($row['user_role'], $row['user_role_id']); ?></td>                                                                             
                                <td >
                                    <?php if ($row['forum_comment_status'] == '1') { ?>
                                        <span>Active</span>
                                    <?php } else { ?>	
                                        <span>InActive</span>
                                    <?php } ?>

                                </td>
                                <td class="menu-action">                                                            
                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/commentdelete/<?php echo $row['forum_comment_id']; ?>/<?php echo $row['forum_topic_id']; ?>');" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-red vd_red"><i class="fa fa-times"></i> </a>

                                </td>
                                <td class="menu-action">
                                    <?php if ($row['forum_comment_status'] == '0') { ?>
                                        <a href="<?php echo base_url(); ?>admin/confirmcomment/<?php echo $row['forum_comment_id']; ?>/<?php echo $row['forum_topic_id']; ?>" class="btn btn-info vd_bg-green">Approve</a>
                                    <?php } ?>
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