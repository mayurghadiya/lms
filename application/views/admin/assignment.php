<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
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
                            <a href="#list" data-toggle="tab" aria-expanded="true"><?php echo ucwords("Assignment List"); ?></a>
                        </li>
                        <li class="">
                            <a href="#submittedlist" data-toggle="tab" aria-expanded="false"><?php echo ucwords("submitted assignment list"); ?></a>
                        </li>
                    </ul>
                    <div id="import-tab-content" class="tab-content">

                        <div class="tab-pane fade active in" id="list">
                            <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addassignment');" data-toggle="modal"><i class="fa fa-plus"></i> assignment</a>
                            <div class="row filter-row">
                            <form id="assignment-search" action="#" class="form-groups-bordered validate">
                                <div class="form-group col-sm-2">
                                    <label><?php echo ucwords("department"); ?></label>
                                    <select class="form-control" id="courses" name="degree_search">
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
                                    <select class="form-control filter-rows" name="divclass" id="filterclass" >
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
                                <div class="form-group col-sm-2">
                                    <label>&nbsp;</label><br/>
                                    <input id="search-assignment-structure-data" type="button" value="Go" class="btn btn-info"/>
                                </div>
                            </form>
                            </div>
                            <div class="panel-body table-responsive" id="getresponse">          
                                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                                    <thead>
                                        <tr>
                                            <th>#</th>												
                                            <th>Assignment Name</th>
                                            <th>Department</th>
                                            <th>Branch</th>												
                                            <th>Batch</th>												
                                            <th>Semester</th>
                                            <th>Class</th>
                                            <th>Description</th>
                                            <th>File</th>
                                            <th>Submission Date</th>												
                                            <th>Action</th>											
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($assignment as $row):
                                            ?>
                                            <tr>
                                                <td></td>	
                                                <td ><?php echo $row->assign_title; ?></td>	
                                                <td>
                                                    <?php
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
                                                <td id="downloadedfile"><a href="<?php echo $row->assign_url; ?>" download="" title="<?php echo $row->assign_title; ?>"><i class="fa fa-download"></i></a></td>	
                                                <td ><?php echo date('F d, Y', strtotime($row->assign_dos)); ?></td>	
                                                <td class="menu-action">
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_assignment/<?php echo $row->assign_id; ?>');" data-toggle="modal"><span class="label label-primary mr6 mb6">Edit</span></a>
                                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/assignment/delete/<?php echo $row->assign_id; ?>');" data-toggle="modal" ><span class="label label-danger mr6 mb6">Delete</span></a>
                                                </td>	
                                            </tr>
                                        <?php endforeach; ?>						
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- tab content -->
                        <div class="tab-pane fade" id="submittedlist">
                            <div class="row filter-row">
                            <form id="assignment-search-submitted" action="#" class="form-groups-bordered validate">
                                <div class="form-group col-sm-2">
                                    <label><?php echo ucwords("department"); ?></label>
                                    <select class="form-control" id="scourses" name="degree_search">
                                        <option value="">Select</option>
                                        <?php foreach ($degree as $row) { ?>
                                            <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
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
                                        $class = $this->db->get('class')->result_array();
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
                            <div class="panel-body table-responsive" id="getsubmit">
                                <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="sub-tables">
                                    <thead>
                                        <tr>
                                            <th><div>#</div></th>												
                                            <th><div><?php echo ucwords("Assignment Name"); ?></div></th>
                                            <th><div><?php echo ucwords("Student Name"); ?></div></th>
                                            <th><div><?php echo ucwords("Department"); ?></div></th>
                                            <th><div><?php echo ucwords("Branch"); ?></div></th>												
                                            <th><div><?php echo ucwords("Batch"); ?></div></th>												
                                            <th><div><?php echo ucwords("Sem"); ?></div></th>	
                                            <th><div><?php echo ucwords("Submitted date"); ?></div></th>	
                                            <th><div><?php echo ucwords("Comment"); ?></div></th>
                                            <th><div><?php echo ucwords("File"); ?></div></th>												                                            
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
                                                <td id="downloadedfile"><a href="uploads/project_file/<?php echo $rowsub->document_file; ?>" download="" title="<?php echo $rowsub->document_file; ?>"><i class="fa fa-download"></i></a></td>                      	
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
<!-- End .row -->
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->

<script type="text/javascript">
    $(document).ready(function () {

        $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });

        $().ready(function () {

            $("#courses").change(function () {
                var degree = $(this).val();

                var dataString = "degree=" + degree;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'admin/get_course/'; ?>",
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
                    url: "<?php echo base_url() . 'admin/get_batches/'; ?>",
                    data: dataString,
                    success: function (response) {
                        $("#batches").html(response);

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url() . 'admin/get_semester'; ?>",
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
                    url: "<?php echo base_url() . 'admin/get_course/'; ?>",
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
                    url: "<?php echo base_url() . 'admin/get_batches/'; ?>",
                    data: dataString,
                    success: function (response) {
                        $("#sbatches").html(response);

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url() . 'admin/get_semester'; ?>",
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
                $("#assignment-search-submitted").validate({
                    rules: {
                        degree_search: "required",
                        course_search: "required",
                        batch_search: "required",
                        semester_search: "required"
                    },
                    messages: {
                        degree_search: "Select department",
                        course_search: "Select branch",
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
                        url: '<?php echo base_url(); ?>admin/getassignment/submitted',
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
                        course_search: "required",
                        batch_search: "required",
                        semester_search: "required",
                        divclass: "required"
                    },
                    messages: {
                        degree_search: "Select department",
                        course_search: "Select branch",
                        batch_search: "Select batch",
                        semester_search: "Select semester",
                        divclass: "Select class"
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
                        url: '<?php echo base_url(); ?>admin/getassignment/allassignment',
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#sub-tables').dataTable();

    });
</script>

