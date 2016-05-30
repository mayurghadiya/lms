<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
          
            <div class=panel-body>
                <a class="links"  onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addtimeline/');" href="#" id="navfixed" data-toggle="tab"><i class="fa fa-plus"></i> Timeline</a>
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Timeline Title</th>                       
                            <th>Year</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($timeline as $row):
                            ?>
                            <tr>
                                <td></td>
                                <td><?php echo $row['timeline_title']; ?></td>                      
                                <td><?php echo $row['timeline_year']; ?></td>   
                                <td>
                                    <?php if ($row['timeline_status'] == '1') { ?>
                                        <span>Active</span>
                                    <?php } else { ?>	
                                        <span>InActive</span>
                                    <?php } ?>
                                </td>
                                <td class="menu-action">
                                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_edit_timeline/<?php echo $row['timeline_id'];?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>

                                                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/time_line/delete/<?php echo $row['timeline_id']; ?>');" data-original-title="Remove" data-toggle="tooltip" data-placement="top" ><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>	
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