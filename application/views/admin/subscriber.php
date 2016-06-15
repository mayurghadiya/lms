<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <div class=panel-body>               
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Registered Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($subscriber as $row):
                            ?>
                            <tr>
                                <td></td>
                                <td><?php echo $row->email; ?></td>
                                <td><?php echo date('M d, Y', strtotime($row->created_at)); ?></td>
                                <td class="menu-action">
                                   <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/subscriber/delete/<?php echo $row->id; ?>');"  data-toggle="tooltip" data-placement="top" ><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>
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