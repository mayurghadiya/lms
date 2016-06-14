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
                            <th>Image</th>
                            <th>Student Name</th>
                            <th>Department</th>
                            <th>Branch</th>
                            <th>Graduation Year</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($graduates as $row) { ?>
                            <tr>
                                <td></td>
                                <td><img class="img-circle img-responsive" src="<?php echo base_url('uploads/student_image/' . $row->std_thumb_img); ?>"/></td>
                                <td><?php echo $row->std_first_name . ' ' . $row->std_last_name; ?></td>
                                <td><?php echo $row->d_name; ?></td>
                                <td><?php echo $row->c_name; ?></td>
                                <td><?php echo $row->graduate_year; ?></td>
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
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->
</div>