<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <!--            <div class=panel-heading>
                            <h4 class=panel-title><?php echo $title; ?></h4>
                            <div class="panel-controls panel-controls-right">
                                <a class="panel-refresh" href="#"><i class="fa fa-refresh s12"></i></a>
                                <a class="toggle panel-minimize" href="#"><i class="fa fa-plus s12"></i></a>
                                <a class="panel-close" href="#"><i class="fa fa-times s12"></i></a>
                            </div>
                        </div>-->
            <div class=panel-body>
                <a href="#" class="links"   onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addcharity');" data-toggle="modal"><i class="fa fa-plus"></i> Charity Fund</a>
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Donation</th>
                            <th>Description</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($charity_rund as $row) { ?>
                            <tr>
                                <td></td>
                                <td><?php echo $row->donor_name; ?></td>
                                <td><?php echo $row->donor_mobile; ?></td>
                                <td><?php echo $row->email; ?></td>
                                <td><?php echo $row->amount; ?></td>
                                <td><?php echo $row->description; ?></td>
                                
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