<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle"></div>
        <div class=panel-body>
            <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addevent');" data-toggle="modal"><i class="fa fa-plus"></i> Event</a>
            <table id="event-datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Event Name</th>
                        <th>Location</th>
                        <th>Event Date</th>
                        <th>Event Time</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $counter = 0;
                    foreach ($events as $row):
                        ?>
                        <tr>
                            <td><?php echo ++$counter; ?></td>
                            <td><?php echo $row['event_name']; ?></td>
                            <td><?php echo $row['event_location']; ?></td>                          
                            <td><?php echo date('F d, Y', strtotime($row['event_date'])); ?></td> 
                            <td><?php echo date('h:i A', strtotime($row['event_date'])); ?></td> 
                            <td class="menu-action">
                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_event/<?php echo $row['event_id']; ?>');" data-toggle="modal"><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>
                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/events/delete/<?php echo $row['event_id']; ?>');" data-toggle="modal" ><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>
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

<script>
    $(document).ready(function () {
        $('#event-datatable-list').DataTable({"language": { "emptyTable": "No data available" }});
    });
</script>