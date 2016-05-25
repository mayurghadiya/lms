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
                 <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addevent');" data-toggle="modal">Add New Event</a>
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Event Name</th>
                            <th>Location</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($events as $row):
                            ?>
                            <tr>
                                <td></td>
                                <td><?php echo $row['event_name']; ?></td>
                                <td><?php echo $row['event_location']; ?></td>                          
                                <td><?php echo date('F d, Y', strtotime($row['event_date'])); ?></td> 
                                <td><?php echo date('h:i A', strtotime($row['event_date'])); ?></td> 
                                <td class="menu-action">
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_event/<?php echo $row['event_id']; ?>');" data-toggle="modal"><span class="label label-primary mr6 mb6">Edit</span></a>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/events/delete/<?php echo $row['event_id']; ?>');" data-toggle="modal" ><span class="label label-danger mr6 mb6">Delete</span></a>
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