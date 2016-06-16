<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <div class=panel-body>
                <table id="event-datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>												
                            <th>Event Name</th>												
                            <th width="15%">Location</th>	
                            <th width="20%">Description</th>
                            <th>Date</th>												
                            <th>Start Time</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $count = 1; ?>
                        <?php foreach ($events as $row) { ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['event_name']; ?></td>
                                <td><?php echo $row['event_location']; ?></td>
                                <td><?php echo $row['event_desc']; ?></td>
                                <td><?php echo date('F d, Y', strtotime($row['event_date'])); ?></td>
                                <td><?php echo date('h:i A', strtotime($row['event_date'])); ?></td>
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

<!-- End contentwrapper -->
</div>
<!-- End #content -->
</div>
</div>

<script>
    $(document).ready(function () {
        $('#event-datatable-list').DataTable({"language": { "emptyTable": "No data available" }});
    })
</script>