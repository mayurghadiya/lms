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
                <div class="tabs mb20">
                    <ul id="import-tab" class="nav nav-tabs">
                        <li class="active">
                            <a href="#list" data-toggle="tab" aria-expanded="true">Project List</a>
                        </li>
                        <li class="">
                            <a href="#submittedlist" data-toggle="tab" aria-expanded="false">Submitted Project List</a>
                        </li>
                    </ul>
                    <div id="import-tab-content" class="tab-content">
                        <div class="tab-pane fade active in" id="list">
                            <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addproject/');" data-original-title="" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i> New Project</a>
                            <div class="row filter-row">
                            <form action="#" method="post" id="searchform">
                                <div class="form-group col-sm-3 validating">
                                    <label>Department</label>
                                    <select id="courses" name="degree" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach ($degree as $row) { ?>
                                            <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2 validating">
                                    <label>Branch</label>
                                    <select id="branches" name="course" class="form-control">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <div class="form-group col-sm-2 validating">
                                    <label>Batch</label>
                                    <select id="batches" name="batch" class="form-control">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <div class="form-group col-sm-2 validating">
                                    <label> Semester</label>
                                    <select id="semesters" name="semester" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach ($semester as $row) { ?>
                                            <option value="<?php echo $row->s_id; ?>"
                                                    ><?php echo $row->s_name; ?></option>
                                                <?php } ?>
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
                                    <button type="submit" id="btnsubmit" class="submit btn btn-info vd_bg-green">Go</button>
                                </div>
                            </form>
                            </div>
                            <div id="getresponse">
                                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                                    <thead>
                                        <tr>
                                            <th>#</th>											
                                            <th>Project</th>
                                            <th>Student</th>											
                                            <th>Department</th>	
                                            <th>Branch</th>
                                            <th>Batch</th>											
                                            <th>Semester</th>
                                            <th>Class</th>
                                            <th>File</th>
                                            <th>Submission Date</th>						
                                            <th>Action</th>		
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($project as $row): ?>
                                            <tr>
                                                <td></td>	
                                                <td><?php echo $row->pm_title; ?></td>	
                                                <td>
                                                    <?php
                                                    $stu = explode(',', $row->pm_student_id);

                                                    foreach ($student as $std) {
                                                        if (in_array($std->std_id, $stu)) {
                                                            echo $std->std_first_name . '&nbsp' . $std->std_last_name . ', ';
                                                        }
                                                    }
                                                    ?>
                                                </td>   
                                                <td>
                                                    <?php
                                                    foreach ($degree as $deg) {
                                                        if ($deg->d_id == $row->pm_degree) {
                                                            echo $deg->d_name;
                                                        }
                                                    }
                                                    ?>
                                                </td>	
                                                <td>
                                                    <?php
                                                    foreach ($course as $crs) {
                                                        if ($crs->course_id == $row->pm_course) {
                                                            echo $crs->c_name;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($batch as $bch) {
                                                        if ($bch->b_id == $row->pm_batch) {
                                                            echo $bch->b_name;
                                                        }
                                                    }
                                                    ?>
                                                </td>	
                                                <td>
                                                    <?php
                                                    foreach ($semester as $sem) {
                                                        if ($sem->s_id == $row->pm_semester) {
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
                                                <td id="downloadedfile"> <a href="<?php echo base_url().'uploads/project_file/'.$row->pm_filename; ?>" download=""><i class="fa fa-download"></i></a></td>
                                                <td><?php echo date('M d, Y', strtotime($row->pm_dos)); ?></td>	
                                                <td class="menu-action">
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_project/<?php echo $row->pm_id; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6">
<i class="fa fa-pencil" aria-hidden="true"></i>
Edit
</span></a>
                                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>professor/project/delete/<?php echo $row->pm_id; ?>');" title="Remove" data-toggle="tooltip" data-placement="top" ><span class="label label-danger mr6 mb6">
<i class="fa fa-trash-o" aria-hidden="true"></i>
Delete
</span></a>	
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>						
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- tab content -->
                        <div class="tab-pane fade" id="submittedlist">
                            <form action="#" method="post" id="searchform-submitted">
                                <div class="form-group col-sm-3 validating">
                                    <label>Department</label>
                                    <select id="scourses" name="degree" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach ($degree as $row) { ?>
                                            <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-3 validating">
                                    <label>Branch</label>
                                    <select id="sbranches" name="course" class="form-control">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <div class="form-group col-sm-3 validating">
                                    <label>Batch</label>
                                    <select id="sbatches" name="batch" class="form-control">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <div class="form-group col-sm-2 validating">
                                    <label> Semester</label>
                                    <select id="ssemesters" name="semester" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach ($semester as $row) { ?>
                                            <option value="<?php echo $row->s_id; ?>"
                                                    ><?php echo $row->s_name; ?></option>
                                                <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2" style="display: none;">
                                    <label><?php echo ucwords("Class"); ?><span style="color:red"></span></label>
                                    <select class="form-control filter-rows" name="filterclass" id="sfilterclass" >
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
                                    <button type="submit" id="btnsubmitted" class="submit btn btn-info vd_bg-green">Go</button>
                                </div>
                            </form>
                            <div id="getsubmit">
                                <table class="table table-striped table-bordered table-responsive" id="sub-tables">
                                    <thead>
                                        <tr>
                                            <th><div>#</div></th>												
                                            <th><div><?php echo ucwords("Project Name"); ?></div></th>
                                            <th><div><?php echo ucwords("Student Name"); ?></div></th>                                                											
                                            <th><div><?php echo ucwords("department"); ?></div></th>	
                                            <th><div><?php echo ucwords("Branch"); ?></div></th>
                                            <th><div><?php echo ucwords("Batch"); ?></div></th>											
                                            <th><div><?php echo ucwords("Semester"); ?></div></th>
                                            <th><div><?php echo ucwords("Submitted date"); ?></div></th>
                                            <th><div><?php echo ucwords("Comment"); ?></div></th>
                                            <th><div><?php echo ucwords("File"); ?></div></th>												                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($submitedproject->result() as $rowsub):
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $rowsub->pm_title; ?></td>
                                                <td><?php echo $rowsub->std_first_name . '&nbsp' . $rowsub->std_last_name . ', '; ?></td>	
                                                <td>
                                                    <?php
                                                    foreach ($degree as $deg) {
                                                        if ($deg->d_id == $rowsub->pm_degree) {
                                                            echo $deg->d_name;
                                                        }
                                                    }
                                                    ?>
                                                </td>	
                                                <td>
                                                    <?php
                                                    foreach ($course as $crs) {
                                                        if ($crs->course_id == $rowsub->pm_course) {
                                                            echo $crs->c_name;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($batch as $bch) {
                                                        if ($bch->b_id == $rowsub->pm_batch) {
                                                            echo $bch->b_name;
                                                        }
                                                    }
                                                    ?>
                                                </td>	
                                                <td>
                                                    <?php
                                                    foreach ($semester as $sem) {
                                                        if ($sem->s_id == $rowsub->pm_semester) {
                                                            echo $sem->s_name;
                                                        }
                                                    }
                                                    ?>

                                                </td>

                                                <td><?php echo date_formats($rowsub->dos); ?></td>	
                                                <td><?php echo $rowsub->description; ?></td>
                                                <td id="downloadedfile"><a href="<?php echo base_url(); ?>uploads/project_file/<?php echo $rowsub->document_file; ?>" download="" title="<?php echo $rowsub->document_file; ?>"><i class="fa fa-download"></i></a></td>                                                    	
                                            </tr>
                                        <?php endforeach; ?>			 			
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- End .panel -->
    </div>
    <!-- col-lg-12 end here -->
</div>



<script type="text/javascript">
    $(document).ready(function () {
        "use strict";
        $('#data-tabless').DataTable();

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#project-data-tables').dataTable();
    });
</script>


<script type="text/javascript">
    $("#searchform #btnsubmit").click(function () {
        var degree = $("#courses").val();
        var course = $("#branches").val();
        var batch = $("#batches").val();
        var semester = $("#semesters").val();
        var divclass = $("#filterclass").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>professor/getprojects/allproject",
            data: {'degree': degree, 'course': course, 'batch': batch, "semester": semester, "divclass": divclass},
            success: function (response)
            {
                $("#getresponse").html(response);
            }


        });
        return false;
    });
    $("#courses").change(function () {
        var degree = $(this).val();

        var dataString = "degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'professor/get_course/'; ?>",
            data: dataString,
            success: function (response) {
                $("#branches").html(response);
            }
        });
    });
    $("#branches").change(function () {
        //var course = $(this).val();
        // var degree = $("#degree").val();
        var degree = $("#courses").val();
        var course = $("#branches").val();
        var dataString = "course=" + course + "&degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'professor/get_batches/'; ?>",
            data: dataString,
            success: function (response) {
                $("#batches").html(response);
            }
        });
    });

    $("#searchform-submitted #btnsubmitted").click(function () {
        var degree = $("#scourses").val();
        var course = $("#sbranches").val();
        var batch = $("#sbatches").val();
        var semester = $("#ssemesters").val();
        var divclass = $("#sfilterclass").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>professor/getprojects/submitted",
            data: {'degree': degree, 'course': course, 'batch': batch, "semester": semester, "divclass": divclass},
            success: function (response)
            {
                $("#getsubmit").html(response);
            }


        });
        return false;
    });
    $("#scourses").change(function () {
        var degree = $(this).val();

        var dataString = "degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'professor/get_course/'; ?>",
            data: dataString,
            success: function (response) {
                $("#sbranches").html(response);
            }
        });
    });
    $("#sbranches").change(function () {
        //var course = $(this).val();
        // var degree = $("#degree").val();
        var degree = $("#scourses").val();
        var course = $("#sbranches").val();
        var dataString = "course=" + course + "&degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'professor/get_batches/'; ?>",
            data: dataString,
            success: function (response) {
                $("#sbatches").html(response);
            }
        });
    });


    $(document).ready(function () {

        $('#sub-tables').dataTable();

    });
</script>

