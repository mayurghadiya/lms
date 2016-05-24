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
                <div class="col-md-12">
                    <div class="form-group col-sm-2">
                        <label><?php echo ucwords("Course"); ?></label>
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
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>#</th>												
                            <th>Title</th>
                            <th>Department</th>
                            <th>Branch</th>												                                                
                            <th>Semester</th>
                            <th>Description</th>
                            <th>File</th>                                            
                            <th>Action</th>		
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach (@$syllabus as $row): ?>
                            <tr>
                                <td></td>	

                                <td><?php echo $row->syllabus_title; ?></td>	
                                <td><?php
                                    foreach ($degree as $dgr):
                                        if ($dgr->d_id == $row->syllabus_degree):

                                            echo $dgr->d_name;
                                        endif;


                                    endforeach;
                                    ?></td>
                                <td>
                                    <?php
                                    foreach ($course as $crs) {
                                        if ($crs->course_id == $row->syllabus_course) {
                                            echo $crs->c_name;
                                        }
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    foreach ($semester as $sem) {
                                        if ($sem->s_id == $row->syllabus_sem) {
                                            echo $sem->s_name;
                                        }
                                    }
                                    ?>													
                                </td>	
                                <td><?php echo wordwrap($row->syllabus_desc, 30, "<br>\n"); ?></td>
                                <td id="downloadedfile"><a href="<?php echo base_url() . 'uploads/syllabus/' . $row->syllabus_filename; ?>" download="" title="<?php echo $row->syllabus_title; ?>"><i class="fa fa-download"></i></a></td>	                                                  
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