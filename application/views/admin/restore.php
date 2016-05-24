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
                <form id="restoreform" class="form-horizontal form-groups-bordered validate" role="form" action="" method="post" 
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("File"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-5">
                            <input type="file" class="form-control" name="userfile" id="userfile"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info vd_bg-green"><?php echo ucwords("restore"); ?></button>
                        </div>
                    </div>
                    <b>Note: Please take backup before system restore</b>
                    <br/><a href="<?php echo base_url('admin/backup'); ?>">Click here to backup</a>
                </form>
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