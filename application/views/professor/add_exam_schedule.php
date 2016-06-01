<?php
$this->load->model('professor/Professor_model');
$degree = $this->Professor_model->get_all_degree();
?>

<div class="row">
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <!--            <div class=panel-heading>
                            <h4 class=panel-title>Add Exam Schedule</h4>                
                        </div>-->
            <div class=panel-body>
                <?php echo form_open(base_url() . 'professor/exam_time_table/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'exam_time_table_form', 'target' => '_top')); ?>
                <br/>
                <div class="padded">
                    <?php
                    $validation_error = validation_errors();
                    if ($validation_error != '') {
                        ?>
                        <div class="alert alert-danger">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <p><?php echo $validation_error; ?></p>
                        </div>                                            
                    <?php } ?>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("department"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select name="degree" id="degree" class="form-control">
                                <option value="">Select</option>
                                <?php foreach ($degree as $row) { ?>
                                    <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Branch"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select name="course" id="course" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Batch"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control" name="batch" id="batch">

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Semester"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control" id="semester" name="semester">
                                <option value="">Select</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Exam"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control" id="exam" name="exam">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Subject"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control" id="subject" name="subject">

                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Date"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <input readonly="" type="text" id="exam_date" class="form-control datepicker-normal" name="exam_date"/>
                        </div>	
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Start Time"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <input type="time" id="start_time" class="form-control timepicker" name="start_time"/>
                        </div>	
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("End Time"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <input type="time" id="end_time" class="form-control timepicker" name="end_time"/>
                        </div>	
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-info vd_bg-green"><?php echo ucwords("Add "); ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>    
                </div>
            </div>
            <!-- End .panel -->
        </div>
        <!-- col-lg-12 end here -->
    </div>

    <script>
        $(document).ready(function () {
            //course by degree
            $('#degree').on('change', function () {
                var course_id = $('#course').val();
                var degree_id = $(this).val();
                //remove all present element
                $('#course').find('option').remove().end();
                $('#course').append('<option value="">Select</option>');
                $.ajax({
                    url: '<?php echo base_url(); ?>professor/course_list_from_degree/' + degree_id,
                    type: 'get',
                    success: function (content) {
                        var course = jQuery.parseJSON(content);
                        $.each(course, function (key, value) {
                            $('#course').append('<option value=' + value.course_id + '>' + value.c_name + '</option>');
                        })
                    }
                })
                batch_from_degree_and_course(degree_id, course_id);
            });
            //batch from course and degree
            $('#course').on('change', function () {
                var degree_id = $('#degree').val();
                var course_id = $(this).val();
                batch_from_degree_and_course(degree_id, course_id);
                get_semester_from_branch(course_id);
            });
            $('#semester').on('change', function () {
                var degree_id = $('#degree').val();
                var branch_id = $('#course').val();
                var semester_id = $(this).val();
                var batch_id = $('#batch').val();
                exam_list(degree_id, branch_id, batch_id, semester_id);
                subject_list(branch_id, semester_id);
            })

            //find batch from degree and course
            function batch_from_degree_and_course(degree_id, course_id) {
                //remove all element from batch
                $('#batch').find('option').remove().end();
                $('#batch').append('<option value="">Select</option>');
                $.ajax({
                    url: '<?php echo base_url(); ?>professor/batch_list_from_degree_and_course/' + degree_id + '/' + course_id,
                    type: 'get',
                    success: function (content) {
                        var batch = jQuery.parseJSON(content);
                        console.log(batch);
                        $.each(batch, function (key, value) {
                            $('#batch').append('<option value=' + value.b_id + '>' + value.b_name + '</option>');
                        })
                    }
                })
            }

            //get semester from brach
            function get_semester_from_branch(branch_id) {
                $('#semester').find('option').remove().end();
                $.ajax({
                    url: '<?php echo base_url(); ?>professor/get_semesters_of_branch/' + branch_id,
                    type: 'get',
                    success: function (content) {
                        $('#semester').append('<option value="">Select</option>');
                        var semester = jQuery.parseJSON(content);
                        $.each(semester, function (key, value) {
                            $('#semester').append('<option value=' + value.s_id + '>' + value.s_name + '</option>');
                        })
                    }
                })
            }

            function exam_list(degree_id, branch_id, batch_id, semester_id) {
                $('#exam').find('option').remove().end();
                $('#exam').append('<option value="">Select</option>');
                $.ajax({
                    url: '<?php echo base_url(); ?>professor/get_exam_list/' + degree_id + '/' + branch_id + '/' + batch_id + '/' + semester_id,
                    type: 'get',
                    success: function (content) {
                        $('#exam').html(content);
                    }
                });
            }

            // subject list from course and semester
            function subject_list(course, semester) {
                $('#subject').find('option').remove().end();
                $('#subject').append('<option value="">Select</option>');
                $.ajax({
                    url: '<?php echo base_url(); ?>professor/subject_list_from_course_and_semester/' + course + '/' + semester,
                    type: 'get',
                    success: function (content) {                        
                        var subject = jQuery.parseJSON(content);
                        $.each(subject, function (key, value) {
                            $('#subject').append('<option value=' + value.sm_id + '>' + value.subject_name + '</option>');
                        })
                    }
                })
            }

        })
    </script>
