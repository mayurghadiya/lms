
<style>

    .select2-container-multi .select2-choices .select2-search-field input{
        padding: 0px;
    }
</style><!-- Start .row -->
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
            <div class="panel-body">                              
                <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>admin/email_compose" method="post" 
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
                            <select class="form-control select2" multiple="" id="student" name="student[]">                                                
                                <option value="all">All Student</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo ucwords("Teacher Email"); ?></label>
                        <div class="col-sm-5">
                            <select id="teacheremail" class="form-control select3" name="teacheremail[]" multiple="">
                                <?php foreach ($teacher as $row) { ?> 
                                    <option value="<?php echo $row->email; ?>"><?php echo $row->name . ' (' . $row->email . ')'; ?></option>
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
                            <textarea id="summernote" name="message" class="width-100 form-control"  rows="15" placeholder="Write your message here"></textarea>                                              
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
            <!-- panel-body  --> 

        </div>
        <!-- panel --> 
    </div>
    
</div>
<!-- row --> 

</div>
<!-- .vd_content-section --> 

</div>
<!-- .vd_content --> 
</div>
<!-- .vd_container --> 
</div>
<!-- .vd_content-wrapper --> 

<!-- Middle Content End --> 


<script>
    $(document).ready(function () {

    });
    $("#checkbox").click(function () {
        if ($("#checkbox").is(':checked')) {
            $("#students > option").prop("selected", "selected");
            $("#students").trigger("change");
        } else {
            $("#students > option").removeAttr("selected");
            $("#students").trigger("change");
        }
    });
</script>

<script>
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
            url: '<?php echo base_url(); ?>admin/course_semester_student/' + course_id + '/' + semester_id,
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
                url: '<?php echo base_url(); ?>admin/course_list_from_degree/' + degree_id,
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
                    url: '<?php echo base_url(); ?>admin/batch_list_from_degree_and_course/' + degree_id + '/' + course_id,
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
                url: '<?php echo base_url(); ?>admin/semesters_list_from_branch/' + branch_id,
                type: 'get',
                success: function (content) {
                    console.log(content);
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
                // course_semester_student(course, semester);
            }
        })
    })
</script>