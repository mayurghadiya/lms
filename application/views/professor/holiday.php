<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh"></div>
        <div class=panel-body>
            <table id="holiday-datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Holiday Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Year</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $count = 1; ?>
                    <?php foreach ($holiday as $row): ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $row['holiday_name']; ?></td>    
                            <td><?php echo date('F d, Y', strtotime($row['holiday_startdate'])); ?></td>    
                            <td><?php echo date('F d, Y', strtotime($row['holiday_enddate'])); ?></td>    
                            <td><?php echo $row['holiday_year']; ?></td>  
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
        $('#holiday-datatable-list').DataTable();
    });
</script>