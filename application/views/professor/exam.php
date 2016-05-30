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
                <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addexam');" data-toggle="modal"><i class="fa fa-plus"></i> Exam</a>
                <form id="exam-search" action="#" class="form-groups-bordered validate">
                    <div class="form-group col-sm-3">
                        <label><?php echo ucwords("Department"); ?></label>
                        <select class="form-control" id="search-degree"name="degree">
                            <option value="">Select</option>
                            <?php foreach ($degree as $row) { ?>
                                <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label><?php echo ucwords("Branch"); ?></label>
                        <select id="search-course" name="course" data-filter="4" class="form-control">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
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
                    <div class="form-group col-sm-1">
                        <label>&nbsp;</label><br/>
                        <input id="search-exam-data-list" type="button" value="Go" class="btn btn-info"/>
                    </div>
                </form>
                <div id="all-exam-list">
                    <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Exam Name</th>
                                <th>Department</th>
                                <th width="14%">Branch</th>
                                <th>Batch</th>
                                <th width="10%">Semester</th>
                                <th width="10%">Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($exams as $row) {
                                $cenlist = array();
                                ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $row->em_name; ?></td>
                                    <td><?php echo $row->d_name; ?></td>
                                    <td><?php echo $row->c_name; ?></td>
                                    <td><?php echo $row->b_name; ?></td>
                                    <td><?php echo $row->s_name; ?></td>

                                    <td><?php echo date('F d, Y', strtotime($row->em_date)); ?></td>
                                    <td class="menu-action">
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_exam/<?php echo $row->em_id; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6">
<i class="fa fa-pencil" aria-hidden="true"></i>
Edit
</span></a>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>professor/exam/delete/<?php echo $row->em_id; ?>');" data-original-title="delete" data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6">
<i class="fa fa-trash-o" aria-hidden="true"></i>
Delete
</span></a>
                                    </td>
                                </tr>
                            <?php } ?>															
                        </tbody>
                    </table>
                </div>                
                <div id="exam-filter-result"></div>
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

<script>
    $(document).ready(function () {

        var form = $('#exam-search');

        $('#search-exam-data-list').on('click', function () {
            //alert(1);
            $("#exam-search").validate({
                rules: {
                    degree: "required",
                    course: "required",
                    batch: "required",
                    semester: "required"
                },
                messages: {
                    degree: "Select course",
                    course: "Select branch",
                    batch: "Select batch",
                    semester: "Select semester"
                }
            });

            if (form.valid() == true)
            {
                $('#all-exam-result').hide();
                var degree = $("#search-degree").val();
                var course = $("#search-course").val();
                var batch = $("#search-batch").val();
                var semester = $("#search-semester").val();
                $.ajax({
                    url: '<?php echo base_url(); ?>professor/get_exam_filter/' + degree + '/'
                            + course + '/' + batch + '/' + semester,
                    type: 'get',
                    success: function (content) {
                        $("#exam-filter-result").html(content);
                        $('#all-exam-list').hide();
                        $('#exam-data-tables').DataTable();
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
        })

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
            $.ajax({
                url: '<?php echo base_url(); ?>professor/get_semesters_of_branch/' + branch_id,
                type: 'get',
                success: function (content) {
                    $('#search-semester').append('<option value="">Select</option>');
                    var semester = jQuery.parseJSON(content);
                    $.each(semester, function (key, value) {
                        $('#search-semester').append('<option value=' + value.s_id + '>' + value.s_name + '</option>');
                    })
                }
            })
        }

    })
</script>
