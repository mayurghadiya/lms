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
                <div class="col-md-12" id="syllabus-filter">
                    <div class="form-group col-sm-2">
                        <label><?php echo ucwords("department"); ?></label>
                        <select class="form-control filter-rows" id="filter2" data-filter="2" data-type="course">
                            <option value="">All</option>
                            <?php foreach ($degree as $row) { ?>
                                <option value="<?php echo $row->d_name; ?>"
                                        data-id="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-2">
                        <label><?php echo ucwords("Branch"); ?></label>
                        <select id="filter3" name="branch" data-filter="3" class="form-control filter-rows" data-type="branch">
                            <option value="">All</option>
                        </select>
                    </div>                                                             
                    <div class="form-group col-sm-2">
                        <label> <?php echo ucwords("Semester"); ?></label>
                        <select id="filter4" name="semester" data-filter="4" class="form-control filter-rows" data-type="semester">
                            <option value="">All</option>
                        </select>
                    </div>
                </div>
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