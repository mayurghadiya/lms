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
                                    <th> <div class="vd_checkbox">
                                            <input type="checkbox" id="checkbox-0">
                                            <label for="checkbox-0" ></label>
                                        </div>
                                    </th>
                                    <th><?php echo ucwords("From");?></th>
                                    <th><?php echo ucwords("Subject");?></th>
                                    <th><?php echo ucwords("Date");?></th>
                                    <th><?php echo ucwords("Action");?></th>
                                </tr>
                    </thead>

                    <tbody>
                          <?php
                                $counter = 0;
                                if (count($inbox)) {

                                    foreach ($inbox as $row) {
                                        $counter++;
                                        ?>
                                        <tr class="<?php if($row->read == 0) echo 'info'; ?>">
                                            <td style="width:20px"><div class="vd_checkbox">
                                                    <input type="checkbox" id="checkbox-<?php echo $counter; ?>" class="checkbox-group">
                                                    <label for="checkbox-<?php echo $counter; ?>" ></label>
                                                </div>
                                            </td>
                                            <td><?php echo $row->email_from; ?></td>
                                            <td>
                                               <?php echo $row->subject; ?>
                                            </td>
                                            <td><?php echo date('d-m-Y h:m A', strtotime($row->created_at)); ?></td>
                                            <td>
                                                <a href="<?php echo base_url('admin/inbox_email/' . $row->email_id); ?>" title="view"><span class="fa fa-desktop"></span></a>&nbsp;
                                                <a href="<?php echo base_url('admin/delete_email/' . $row->email_id); ?>" title="delete" 
                                                   onclick="return confirm('Are you sure to delete this email?');"><span class="fa fa-times"></span></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="3">No email found in your inbox</td>
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