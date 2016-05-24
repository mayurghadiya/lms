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
                            <th><div>#</div></th>
                            <th><div>Title</div></th>  
                            <th><div>Description</div></th>                               
                            <th><div>Image</div></th>
                            <th><div>Action</div></th>
                        </tr>
                    </thead>

                    <tbody>
                          <?php
                                                $count = 1;
                                                foreach ($gallery as $row):
                                                    ?>
                                                    <tr>
                                                       <td><?php echo $count++; ?></td>    
                                                    <td><?php echo $row->gallery_title; ?></td>    
                                                    <td><?php echo $row->gallery_desc; ?></td>  
                                                    <td><a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_view_photogallery/<?php echo $row->gallery_id; ?>');" data-original-title="View Gallery" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-red vd_red"><i class="fa fa-file-o"></i></a>	</td></td>
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