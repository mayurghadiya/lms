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

                <form id="assignment-search" action="#" class="form-groups-bordered validate">
                    <div class="form-group col-sm-2">
                        <label><?php echo ucwords("department"); ?></label>
                        <select class="form-control" id="courses"name="degree_search">
                            <option value="">Select</option>
                            <?php foreach ($degree as $row) { ?>
                                <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-2">
                        <label><?php echo ucwords("Branch"); ?></label>
                        <select id="branches" name="course_search" data-filter="4" class="form-control">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-2">
                        <label><?php echo ucwords("Batch"); ?></label>
                        <select id="batches" name="batch_search" data-filter="5" class="form-control">
                            <option value="">Select</option>
                        </select>
                    </div>                                
                    <div class="form-group col-sm-2">
                        <label> <?php echo ucwords("Semester"); ?></label>
                        <select id="semesters" name="semester_search" data-filter="6" class="form-control">
                            <option value="">Select</option>

                        </select>
                    </div>
                    <div class="form-group col-sm-2">
                        <label><?php echo ucwords("Class"); ?><span style="color:red"></span></label>
                        <select class="form-control filter-rows" name="filterclass" id="filterclass" >
                            <option value="">Select</option>
                            <?php
                            $class = $this->db->get('class')->result_array();
                            foreach ($class as $c) {
                                ?>
                                <option value="<?php echo $c['class_id'] ?>"><?php echo $c['class_name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div> 
                    <div class="form-group col-sm-1">
                        <label>&nbsp;</label><br/>
                        <input id="search-assignment-structure-data" type="button" value="Go" class="btn btn-info vd_bg-green"/>
                    </div>
                </form>
                <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addassignment/');" data-original-title="" data-toggle="tooltip" data-placement="top">Add New Assignment</a>

                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>#</th>												
                            <th>Assignment</th>
                            <th>Department</th>
                            <th>Branch</th>												
                            <th>Batch</th>												
                            <th>Semester</th>
                            <th>Class</th>
                            <th>Description</th>                            
                            <th>Submission Date</th>
                            <th>File</th>
                            <th>Action</th>		
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($assignment as $row): ?>
                            <tr>
                                <td></td>	

                                <td ><?php echo $row->assign_title; ?></td>	
                                <td><?php
                                    foreach ($degree as $dgr):
                                        if ($dgr->d_id == $row->assign_degree):

                                            echo $dgr->d_name;
                                        endif;


                                    endforeach;
                                    ?></td>
                                <td>
                                    <?php
                                    foreach ($course as $crs) {
                                        if ($crs->course_id == $row->course_id) {
                                            echo $crs->c_name;
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach ($batch as $bch) {
                                        if ($bch->b_id == $row->assign_batch) {
                                            echo $bch->b_name;
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach ($semester as $sem) {
                                        if ($sem->s_id == $row->assign_sem) {
                                            echo $sem->s_name;
                                        }
                                    }
                                    ?>													
                                </td>
                                <td>
                                    <?php
                                    foreach ($class as $c) {
                                        if ($c['class_id'] == $row->class_id) {
                                            echo $c['class_name'];
                                        }
                                    }
                                    ?>
                                </td>
                                <!-- id="inlinedate" contenteditable="true" onBlur="saveToDatabase(this,'assign_dos','<?php echo $row->assign_id; ?>')" onClick="showEdit(this);"-->
                                <td  ><?php echo wordwrap($row->assign_desc, 30, "<br>\n"); ?></td>                                	
                                <td ><?php echo date('M d, Y', strtotime($row->assign_dos)); ?></td>	
                                <td id="downloadedfile"><a href="<?php echo $row->assign_url; ?>" download="" title="<?php echo $row->assign_title; ?>"><i class="fa fa-download"></i></a></td>
                                <td class="menu-action">
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_assignment/<?php echo $row->assign_id; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6">Edit</span></a>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>professor/assignment/delete/<?php echo $row->assign_id; ?>');" data-original-title="Remove" data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6">Delete</span></a>
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