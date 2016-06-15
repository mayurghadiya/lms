<!-- Start .row -->
<div class=row>
    <div class="col-lg-12 col-md-12 col-xs-12">
        <!-- col-lg-12 start here -->
        <div class="panel-default">
            <div class=panel-body>
                <div class="tabs mb20">
                    <ul id="import-tab" class="nav nav-tabs">
                        <li class="active">
                            <a href="#assignment-list" data-toggle="tab" aria-expanded="true">Assignment List</a>
                        </li>
                        <li class="">
                            <a href="#submitted-assignment-list" data-toggle="tab" aria-expanded="false">Submitted Assignment List</a>
                        </li>
                    </ul>
                    <div id="import-tab-content" class="tab-content">
                        <div class="tab-pane fade active in" id="assignment-list">
                            <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addassignment/');" data-original-title="" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i> Assignment</a>
                            <div class="row filter-row">
                                <form id="assignment-search" action="#" class="form-groups-bordered validate">
                                    <div class="form-group col-sm-3">
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
                                        <input id="search-assignment-structure-data"  type="button" value="Go" class="btn btn-info vd_bg-green"/>
                                    </div>
                                </form>
                            </div>
                            <div id="getresponse">
                                <table id="assignmenttable" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                                    <thead>
                                        <tr>
                                            <th>No</th>
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
                                        <?php $counter = 1; ?>
                                        <?php foreach ($assignment as $row): ?>
                                            <tr>
                                                <td><?php echo $counter++; ?></td>
                                                <td><?php echo $row->assign_title; ?></td>
                                                <td><?php
                                                    foreach ($degree as $dgr):
                                                        if ($dgr->d_id == $row->assign_degree):

                                                            echo $dgr->d_name;
                                                        endif;


                                                    endforeach;
                                                    ?>
                                                </td>
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
                                                <td><?php echo wordwrap($row->assign_desc, 30, "<br>\n"); ?></td>
                                                <td><?php echo date('M d, Y', strtotime($row->assign_dos)); ?></td>
                                                <td><a href="<?php echo base_url() . 'uploads/project_file/' . $row->assign_filename; ?>" download="" title="<?php echo $row->assign_title; ?>"><i class="fa fa-download"></i></a></td>
                                                <td class="menu-action">
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_assignment/<?php echo $row->assign_id; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            Edit
                                                        </span></a>
                                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>professor/assignment/delete/<?php echo $row->assign_id; ?>');" data-original-title="Remove" data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6">
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
                        <div class="tab-pane fade" id="submitted-assignment-list">
                            <div class="row filter-row">
                                <form id="assignment-search-submitted" action="#" class="form-groups-bordered validate">
                                    <div class="form-group col-sm-3">
                                        <label><?php echo ucwords("department"); ?></label>
                                        <select class="form-control" id="scourses" name="degree_search">
                                            <option value="">Select</option>
                                            <?php foreach ($degree as $row) { ?>
                                                <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label><?php echo ucwords("Branch"); ?></label>
                                        <select id="sbranches" name="course_search" data-filter="4" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label><?php echo ucwords("Batch"); ?></label>
                                        <select id="sbatches" name="batch_search" data-filter="5" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label> <?php echo ucwords("Semester"); ?></label>
                                        <select id="ssemesters" name="semester_search" data-filter="6" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2" style="display: none;">
                                        <label><?php echo ucwords("Class"); ?><span style="color:red"></span></label>
                                        <select class="form-control filter-rows" name="divclass" id="sfilterclass" >
                                            <option value="">Select</option>
                                            <?php
                                            //$class = $this->db->get('class')->result_array();
                                            foreach ($class as $c) {
                                                ?>
                                                <option value="<?php echo $c['class_id'] ?>"><?php echo $c['class_name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label>&nbsp;</label><br/>
                                        <input id="submitted" type="button" value="Go" class="btn btn-info"/>
                                    </div>
                                </form>
                            </div>
                            <div id="getsubmit">
                                <table class="table table-striped table-bordered table-responsive" id="sub-tables">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo ucwords("Assignment Name"); ?></th>
                                            <th><?php echo ucwords("Student Name"); ?></th>
                                            <th><?php echo ucwords("Course"); ?></th>
                                            <th><?php echo ucwords("Branch"); ?></th>
                                            <th><?php echo ucwords("Batch"); ?></th>
                                            <th><?php echo ucwords("Sem"); ?></th>
                                            <th><?php echo ucwords("Submitted date"); ?></th>
                                            <th><?php echo ucwords("Comment"); ?></th>
                                            <th><?php echo ucwords("File"); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($submitedassignment->result() as $rowsub):
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $rowsub->assign_title; ?></td>
                                                <td><?php echo $rowsub->name; ?></td>
                                                <td><?php
                                                    foreach ($degree as $dgr):
                                                        if ($dgr->d_id == $rowsub->assign_degree):

                                                            echo $dgr->d_name;
                                                        endif;


                                                    endforeach;
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    foreach ($course as $crs) {
                                                        if ($crs->course_id == $rowsub->course_id) {
                                                            echo $crs->c_name;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($batch as $bch) {
                                                        if ($bch->b_id == $rowsub->assign_batch) {
                                                            echo $bch->b_name;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($semester as $sem) {
                                                        if ($sem->s_id == $rowsub->assign_sem) {
                                                            echo $sem->s_name;
                                                        }
                                                    }
                                                    ?>                                                   
                                                </td>
                                                <td><?php echo date_formats($rowsub->submited_date); ?></td>
                                                <td><?php echo $rowsub->comment; ?></td>
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
            <!-- col-lg-12 end here -->
        </div>
        <div class="clearfix"></div>
        <!-- End .row -->
    </div>
    <!-- End contentwrapper -->
</div>
<!-- End #content -->
</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#assignmenttable').dataTable();
        $('#sub-tables').dataTable();

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });

        $().ready(function () {
            $("#assignment-search").submit(function () {
                var degree = $("#courses").val();
                var course = $("#branches").val();
                var batch = $("#batches").val();
                var semester = $("#semesters").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>professor/getassignment/allassignment",
                    data: {'degree': degree, 'course': course, 'batch': batch, "semester": semester},
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

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url() . 'professor/get_semester'; ?>",
                            data: dataString,
                            success: function (response1) {
                                $("#semesters").html(response1);
                            }
                        });
                    }
                });
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

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url() . 'professor/get_semester'; ?>",
                            data: dataString,
                            success: function (response1) {
                                $("#ssemesters").html(response1);
                            }
                        });
                    }
                });
            });


            var form = $('#assignment-search');
            var forms = $('#assignment-search-submitted');

            $('#submitted').on('click', function () {
                $("#assignment-search").validate({
                    rules: {
                        degree_search: "required",
                        branch_search: "required",
                        batch_search: "required",
                        semester_search: "required"
                    },
                    messages: {
                        degree_search: "Select department",
                        branch_search: "Select branch",
                        batch_search: "Select batch",
                        semester_search: "Select semester"
                    }
                });

                if (forms.valid() == true)
                {

                    var degree = $("#scourses").val();
                    var course = $("#sbranches").val();
                    var batch = $("#sbatches").val();
                    var semester = $("#ssemesters").val();
                    var divclass = $("#sfilterclass").val();
                    $.ajax({
                        url: '<?php echo base_url(); ?>professor/getassignment/submitted',
                        type: 'post',
                        data: {'degree': degree, "course": course, "batch": batch, "semester": semester, 'divclass': divclass},
                        success: function (content) {
                            $("#getsubmit").html(content);
                            // $("#dtbl").hide();

                        }
                    });
                }
            });
            $('#search-assignment-structure-data').on('click', function () {
                $("#assignment-search").validate({
                    rules: {
                        degree_search: "required",
                        branch_search: "required",
                        batch_search: "required",
                        semester_search: "required"
                    },
                    messages: {
                        degree_search: "Select department",
                        branch_search: "Select branch",
                        batch_search: "Select batch",
                        semester_search: "Select semester"
                    }
                });

                if (form.valid() == true)
                {

                    var degree = $("#courses").val();
                    var course = $("#branches").val();
                    var batch = $("#batches").val();
                    var semester = $("#semesters").val();
                    var divclass = $("#filterclass").val();
                    $.ajax({
                        url: '<?php echo base_url(); ?>professor/getassignment/allassignment',
                        type: 'post',
                        data: {'degree': degree, "course": course, "batch": batch, "semester": semester, 'divclass': divclass},
                        success: function (content) {
                            $("#getresponse").html(content);
                            // $("#dtbl").hide();

                        }
                    });
                }
            });
        });

    });
</script>
<script>
    $().ready(function () {
        $("#inlinedate").datepicker({
            format: ' MM d, yyyy',
            startDate: new Date(),
            autoclose: true

        });
    });
    function showEdit(editableObj) {
        $(editableObj).css("background", "#FFF");
    }

    function saveToDatabase(editableObj, column, id) {
        $(editableObj).css("background", "#FFF url(loaderIcon.gif) no-repeat right");
        $.ajax({
            url: "<?php echo base_url() . 'professor/savedata/assignment_manager/assign_id' ?>",
            type: "POST",
            data: 'column=' + column + '&editval=' + editableObj.innerHTML + '&id=' + id,
            success: function (data) {
                $(editableObj).css("background", "#FDFDFD");
            }
        });
    }
</script>