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
                <a href="#" class="links"   onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/add_exam_schedule');" data-toggle="modal"><i class="fa fa-plus"></i> Exam Schedule</a>
                <div class="row filter-row">
                    <form id="exam-schedule-search" action="#" class="form-groups-bordered validate">
                        <div class="form-group col-sm-2">
                            <label><?php echo ucwords("department"); ?></label>
                            <select class="form-control" id="search-degree"name="degree">
                                <option value="">Select</option>
                                <?php foreach ($degree as $row) { ?>
                                    <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label><?php echo ucwords("Branch"); ?></label>
                            <select id="search-course" name="course" data-filter="4" class="form-control">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label><?php echo ucwords("Batch"); ?></label>
                            <select id="search-batch" name="batch" data-filter="5" class="form-control">
                                <option value="">Select</option>
                            </select>
                        </div>                                
                        <div class="form-group col-sm-2">
                            <label> <?php echo ucwords("Semester"); ?></label>
                            <select id="search-semester" name="semester" data-filter="6" class="form-control">
                                <option value="">Select</option>

                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label> <?php echo ucwords("Exam"); ?></label>
                            <select id="search-exam" name="exam" data-filter="6" class="form-control">
                                <option value="">Select</option>

                            </select>
                        </div>
                        <div class="form-group col-sm-1">
                            <label>&nbsp;</label><br/>
                            <input id="search-exam-data" type="button" value="Go" class="btn btn-info vd_bg-green"/>
                        </div>
                    </form>
                </div>
                <div id="exam-time-table-datatable-list">
                    <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Department</th>
                                <th>Branch</th>
                                <th>Batch</th>
                                <th>Semester</th>
                                <th>Exam</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th width="10%"><?php echo ucwords("Action"); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($time_table as $row) {
                                ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $row->d_name; ?></td>
                                    <td><?php echo $row->c_name; ?></td>
                                    <td><?php echo $row->b_name; ?></td>
                                    <td><?php echo $row->s_name; ?></td>
                                    <td><?php echo $row->em_name; ?></td>
                                    <td><?php echo $row->subject_name; ?></td>
                                    <td><?php echo date('F d, Y', strtotime($row->exam_date)); ?></td>
                                    <td><?php echo date('h:i A', strtotime(date('Y-m-d') . $row->exam_start_time)) . ' to ' . date('h:i A', strtotime(date('Y-m-d') . $row->exam_end_time)); ?></td>
                                    <td class="menu-action">
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_exam_time_table/<?php echo $row->exam_time_table_id; ?>');"  data-toggle="tooltip" data-placement="top"><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>professor/exam_time_table/delete/<?php echo $row->exam_time_table_id; ?>');"  data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>														
                        </tbody>
                    </table>
                </div>                

                <div id="search-result-exam-schedule"></div>
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
</div>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>

<style>
    .nav-fixedtabs {
        left: 86%;
        position: fixed;
        top: 25%;
    }
    #navfixed{
        cursor: pointer;
    }

</style>

<div class="md-fab-wrapper">

    <a class="md-fab md-fab-success nav-fixed-a-tabs vd_bg-red"  onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/add_exam_schedual/');" href="#" id="navfixed" data-toggle="tab">
        <i class="material-icons">&#xE145;</i>
    </a>
</div>

<script>
    $.validator.setDefaults({
        submitHandler: function (form) {
            form.submit();
        }
    });

    $().ready(function () {

        var form = $('#exam-schedule-search');

        $('#search-exam-data').on('click', function () {
            $("#exam-schedule-search").validate({
                rules: {
                    degree: "required",
                    course: "required",
                    batch: "required",
                    semester: "required",
                    exam: "required",
                },
                messages: {
                    degree: "Select course",
                    course: "Select branch",
                    batch: "Select batch",
                    semester: "Select semester",
                    exam: "Select exam"
                }
            });

            if (form.valid() == true)
            {
                $('#exam-schedule-result').hide();
                var degree = $("#search-degree").val();
                var course = $("#search-course").val();
                var batch = $("#search-batch").val();
                var semester = $("#search-semester").val();
                var exam = $('#search-exam').val();
                $.ajax({
                    url: '<?php echo base_url(); ?>professor/get_exam_schedule_filter/' + degree + '/'
                            + course + '/' + batch + '/' + semester + '/' + exam,
                    type: 'get',
                    success: function (content) {
                        $("#search-result-exam-schedule").html(content);
                        $("#exam-time-table-datatable-list").hide();
                        $('#search-data-tables').DataTable();
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        //course by degree
        $('#search-degree').on('change', function () {
            var course_id = $('#search-course').val();
            var degree_id = $(this).val();
            //remove all present element
            $('#search-course').find('option').remove().end();
            $('#search-course').append('<option value="">Select</option>');
            $('#search-exam').find('option').remove().end();
            $('#search-exam').append('<option value="">Select</option>');
            $('#search-semester').find('option').remove().end();
            $('#search-semester').append('<option value="">Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>professor/course_list_from_degree/' + degree_id,
                type: 'get',
                success: function (content) {
                    var course = jQuery.parseJSON(content);
                    $.each(course, function (key, value) {
                        $('#search-course').append('<option value=' + value.course_id + '>' + value.c_name + '</option>');
                    })
                }
            })
            batch_from_degree_and_course(degree_id, course_id);
        });
        //batch from course and degree
        $('#search-course').on('change', function () {
            var degree_id = $('#search-degree').val();
            var course_id = $(this).val();
            batch_from_degree_and_course(degree_id, course_id);
            get_semester_from_branch(course_id);
            $('#search-exam').find('option').remove().end();
            $('#search-exam').append('<option value="">Select</option>');
            $('#search-semester').find('option').remove().end();
            $('#search-semester').append('<option value="">Select</option>');
        })

        $('#search-semester').on('change', function () {
            var degree = $('#search-degree').val();
            var course = $('#search-course').val();
            var batch = $('#search-batch').val();
            var semester = $('#search-semester').val();
            get_exam_list(degree, course, batch, semester);
            $('#search-exam').find('option').remove().end();
            $('#search-exam').append('<option value="">Select</option>');
        });

        $('#search-batch').on('change', function () {
            $('#search-exam').find('option').remove().end();
            $('#search-exam').append('<option value="">Select</option>');
            var degree = $('#search-degree').val();
            var course = $('#search-course').val();
            var batch = $(this).val();
            var semester = $('#search-semester').val();
            get_exam_list(degree, course, batch, semester);
        });

        //find batch from degree and course
        function batch_from_degree_and_course(degree_id, course_id) {
            //remove all element from batch
            $('#search-batch').find('option').remove().end();
            $('#search-batch').append('<option value="">Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>professor/batch_list_from_degree_and_course/' + degree_id + '/' + course_id,
                type: 'get',
                success: function (content) {
                    var batch = jQuery.parseJSON(content);
                    console.log(batch);
                    $.each(batch, function (key, value) {
                        $('#search-batch').append('<option value=' + value.b_id + '>' + value.b_name + '</option>');
                    })
                }
            })
        }

        //get semester from brach
        function get_semester_from_branch(branch_id) {
            $('#search-semester').find('option').remove().end();
            $('#search-semester').append('<option value="">Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>professor/get_semesters_of_branch/' + branch_id,
                type: 'get',
                success: function (content) {
                    var semester = jQuery.parseJSON(content);
                    $.each(semester, function (key, value) {
                        $('#search-semester').append('<option value=' + value.s_id + '>' + value.s_name + '</option>');
                    })
                }
            })
        }

        function get_exam_list(degree_id, course_id, batch_id, semester_id) {
            $('#search-exam').find('option').remove().end();
            $('#search-exam').append('<option value="">Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>professor/get_exam_list/' + degree_id + '/' + course_id + '/' + batch_id + '/' + semester_id,
                type: 'get',
                success: function (content) {
                    $('#search-exam').html(content);
                }
            });
        }

    })
</script>
