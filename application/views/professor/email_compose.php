<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>
<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <div class=panel-body>
                <form class="form-horizontal" role="form" action="" method="post" 
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo ucwords("department"); ?></label>
                        <div class="col-sm-5">
                            <select class="form-control" id="degree" name="degree" required="">
                                <option value="">Select</option>
                                <?php foreach ($degree as $row) { ?>
                                    <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo ucwords("Branch"); ?></label>
                        <div class="col-sm-5">
                            <select class="form-control" id="course" name="course" required="">

                                <option value="all">All</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo ucwords("Batch"); ?></label>
                        <div class="col-sm-5">
                            <select class="form-control" id="batch" name="batch" required="">

                                <option value="all">All</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="main_semester" style="display: none;">
                        <label class="col-sm-2 control-label">Semester</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="semester" name="semester">
                                <option value="all">All</option>   
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="main_student" style="display: none;">
                        <label class="col-sm-2 control-label">Student</label>
                        <div class="col-sm-5">                                            
                            <select class="form-control form-select" multiple="" id="student" name="student[]">                                                
                                <option value="all">All Student</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">To Admin</label>
                        <div class="col-sm-5">
                            <select id="to" class="form-control" name="to[]" multiple="">
                                <?php foreach ($all_admin as $row) { ?>
                                    <option value="<?php echo $row->admin_id; ?>"><?php echo $row->email . ' (Admin)'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo ucwords("Subject"); ?></label>
                        <div class="col-sm-5">
                            <textarea class="form-control" name="subject" required=""></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo ucwords("Cc"); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="cc"/>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 control-label"><?php echo ucwords("Message"); ?></label>
                        <div class="col-sm-9">

                            <textarea id="summernote1" name="message" class="width-100 form-control"  rows="15" placeholder="Write your message here"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo ucwords("Attachment"); ?></label>
                        <div class="col-sm-5">
                            <input type="file" class="form-control" name="userfile[]" multiple/>
                        </div>
                    </div>

                    <div class="form-group form-actions">
                        <div class="col-sm-12 col-md-offset-2">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-envelope append-icon"></i> <?php echo ucwords("Send"); ?></button>

                        </div>
                    </div>
                </form>
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

<script>
    CKEDITOR.replace( 'message' );
    $(document).ready(function () {
        $('#semester').on('change', function () {
            var semester_id = $(this).val();
            var course_id = $('#course').val();
            if (semester_id != '') {
                if (semester_id == 'all') {
                    hide_student();
                } else {
                    show_student();
                    course_semester_student(course_id, semester_id);
                }
            }
        });

        $('#course').on('change', function () {
            var course_id = $(this).val();
            var semester_id = $('#semester').val();
            if (course_id != '') {
                if (course_id == 'all') {
                    hide_semester();
                    hide_student();
                } else {
                    show_semester();
                    course_semester_student(course_id, semester_id);
                }
            }
        })
    });

    function course_semester_student(course_id, semester_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>professor/course_semester_student/' + course_id + '/' + semester_id,
            type: 'get',
            success: function (content) {
                $('#student').html(content);
                $('#student').prepend('<option value="all">All Students</option>');
            }
        })
    }

    function hide_semester() {
        $('#main_semester').css('display', 'none');
    }

    function hide_student() {
        $('#main_student').css('display', 'none');
    }

    function show_semester() {
        $('#main_semester').css('display', 'block');
    }

    function show_student() {
        $('#main_student').css('display', 'block');
    }
</script>

<script>
    $(document).ready(function () {
        //course by degree
        $('#degree').on('change', function () {
            var course_id = $('#course').val();
            var degree_id = $(this).val();

            //remove all present element
            $('#course').find('option').remove().end();
            $('#course').append('<option value="">Select</option>');
            var degree_id = $(this).val();
            $.ajax({
                url: '<?php echo base_url(); ?>professor/course_list_from_degree/' + degree_id,
                type: 'get',
                success: function (content) {
                    var course = jQuery.parseJSON(content);
                    $.each(course, function (key, value) {
                        $('#course').append('<option value=' + value.course_id + '>' + value.c_name + '</option>');
                    });
                    $('#course').append('<option value="all">All Course</option>');
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
        })

        //find batch from degree and course
        function batch_from_degree_and_course(degree_id, course_id) {
            //remove all element from batch
            if (course_id == 'all')
            {
                $('#batch').html('<option value="all">All</option>');
            } else {
                $('#batch').find('option').remove().end();
                $.ajax({
                    url: '<?php echo base_url(); ?>professor/batch_list_from_degree_and_course/' + degree_id + '/' + course_id,
                    type: 'get',
                    success: function (content) {
                        $('#batch').append('<option value="">Select</option>');
                        var batch = jQuery.parseJSON(content);
                        console.log(batch);
                        $.each(batch, function (key, value) {
                            $('#batch').append('<option value=' + value.b_id + '>' + value.b_name + '</option>');
                        })
                    }
                })
            }
        }

        //get semester from brach
        function get_semester_from_branch(branch_id) {
            $('#semester').find('option').remove().end();
            $.ajax({
                url: '<?php echo base_url(); ?>professor/semesters_list_from_branch/' + branch_id,
                type: 'get',
                success: function (content) {
                    $('#semester').append('<option value="all">All</option>');
                    var semester = jQuery.parseJSON(content);
                    $.each(semester, function (key, value) {
                        $('#semester').append('<option value=' + value.s_id + '>' + value.s_name + '</option>');

                    })
                }
            })
        }

    })
</script>


<script>
    $(document).ready(function () {
        $('#student').on('change', function () {
            var student_id = $(this).val();
            if (student_id == 'all') {
                $(this).empty();
                $(this).append('<option value="all" selected>All Student</option>');
            } else {
                var degree_id = $('#degree').val();
                var course = $('#course').val();
                var batch = $('#batch').val();
                var semester = $('#semester').val();
                //  course_semester_student(course, semester);
            }
        })
    })
</script>