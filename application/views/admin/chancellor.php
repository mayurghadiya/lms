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
                            <th>#</th>
                            <th>Image</th>
                            <th>Chancellor Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Designation</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($chancellor as $row):
                            ?>
                            <tr>
                                <td></td>                                    
                                <td> <img src="<?= base_url() ?>/uploads/system_image/<?= $row['people_photo']; ?>" height="70" width="70" id="blah"  /></td>
                                <td><?php echo $row['people_name']; ?></td>
                                <td><?php echo $row['people_phone']; ?></td> 
                                <td><?php echo $row['people_email']; ?></td> 
                                <td><?php echo $row['people_designation']; ?></td> 
                                <td class="menu-action">
                                    <a><span class="label label-primary mr6 mb6">Edit</span></a>
                                    <a><span class="label label-danger mr6 mb6">Delete</span></a>
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