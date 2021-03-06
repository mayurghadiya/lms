<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh"></div>
        <div class=panel-body>
            <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                <thead>
                    <tr>
                        <th>No</th>												
                        <th>Image</th>												
                        <th>Student Name</th>													
                        <th>Email</th>												
                        <th>Mobile</th>	
                        <th>Gender</th>
                        <th>Action</th>	
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($student as $row): ?>
                        <tr>
                            <td></td>											
                            <td>
                                <?php if ($row->profile_photo != "") { ?>   
                                    <img src="<?= base_url() ?>/uploads/student_image/<?= $row->profile_photo; ?>" height="100px" width="100px
                                         "/>
                                     <?php } else { ?>
                                    <img src="<?= base_url() ?>/uploads/no-image.jpg" height="100px" width="100px"/>
                                <?php } ?>
                            </td>	
                            <td><?php echo $row->std_first_name . " " . $row->std_last_name; ?></td>					
                            <td><?php echo $row->email; ?></td>											
                            <td><?php echo $row->std_mobile; ?></td>	
                            <td><?php echo $row->std_gender; ?></td>
                            <td class="menu-action">
                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_student_detail/<?php echo $row->std_id; ?>');" data-original-title="view" data-toggle="tooltip" data-placement="top"><span class="label label-primary mr6 mb6">View</span></a>
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