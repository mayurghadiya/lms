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

                <form action="#" method="post" id="searchform">
                    <div class="form-group col-sm-3 validating">
                        <label><?php echo ucwords("department"); ?></label>
                        <select id="courses" name="degree" class="form-control">
                            <option value="">Select department</option>
                            <option value="All">All</option>

                            <?php foreach ($degree as $row) { ?>
                                <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-3 validating">
                        <label>Branch</label>
                        <select id="branches" name="course" class="form-control">
                            <option value="">Select Branch</option>
                            <option value="All">All</option>

                        </select>
                    </div>
                    <div class="form-group col-sm-3 validating">
                        <label>Batch</label>
                        <select id="batches" name="batch" class="form-control">
                            <option value="">Select Batch</option>
                            <option value="All">All</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-2 validating">
                        <label>Select Semester</label>
                        <select id="semesters" name="semester" class="form-control">
                            <option value="">Select Semester</option>
                            <option value="All">All</option>

                            <?php foreach ($semester as $row) { ?>
                                <option value="<?php echo $row->s_id; ?>"
                                        ><?php echo $row->s_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-1">                                    
                        <label>&nbsp;</label><br/>                                    
                        <button type="submit" class="submit btn btn-info vd_bg-green">Go</button>                                    
                    </div>
                </form>

                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>#</th>											
                            <th>Library</th>											
                            <th>Department</th>											
                            <th>Branch</th>											
                            <th>Batch</th>											
                            <th>Semester</th>											
                            <th>File</th>
                            <th>Action</th>			
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($library as $row): ?>
                            <tr>
                                <td></td>	
                                <td><?php echo $row->lm_title; ?></td>	
                                <td>
                                    <?php
                                    if ($row->lm_degree == "All") {
                                        echo "All";
                                    } else {
                                        foreach ($degree as $deg) {

                                            if ($deg->d_id == $row->lm_degree) {
                                                echo $deg->d_name;
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($row->lm_course == "All") {
                                        echo "All";
                                    } else {
                                        foreach ($course as $crs) {

                                            if ($crs->course_id == $row->lm_course) {
                                                echo $crs->c_name;
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($row->lm_batch == "All") {
                                        echo "All";
                                    } else {
                                        foreach ($batch as $bch) {
                                            if ($bch->b_id == $row->lm_batch) {
                                                echo $bch->b_name;
                                            }
                                        }
                                    }
                                    ?>
                                </td>	
                                <td>
                                    <?php
                                    if ($row->lm_semester == "All") {
                                        echo "All";
                                    } else {
                                        foreach ($semester as $sem) {
                                            if ($sem->s_id == $row->lm_semester) {
                                                echo $sem->s_name;
                                            }
                                        }
                                    }
                                    ?>

                                </td>	
                                <td id="downloadedfile"><a href="<?php echo $row->lm_url; ?>" download="" target="_blank" title="<?php echo $row->lm_filename; ?>"><i class="fa fa-download"></i></a></td>	
                                
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