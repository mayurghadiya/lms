<?php
$edit_data = $this->db->get_where('assessments', array('assessment_id' => $param2))->result_array();
foreach ($edit_data as $row):
    $datastudent = $this->db->get_where('student', array('std_degree' => $row['degree'], 'course_id' => $row['course'],
                'std_batch' => $row['batch'],
                'semester_id' => $row['semester'])
            )->result();
    ?>

    <!-- Start .row -->
    <div class=row>                      

        <div class=col-lg-12>
            <!-- col-lg-12 start here -->
            <div class="panel-default toggle panelMove panelClose panelRefresh">
                <!-- Start .panel -->
                <!--                <div class=panel-heading>
                                        <h4 class=panel-title>Update Assessment</h4>
                                    </div>-->
                <div class=panel-body>
                    <?php echo form_open(base_url() . 'professor/assessments/update/' . $row['assessment_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'id' => 'frmeditassignment', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("department"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select name="degree" class="form-control" id="degree2">
                                <option value="">Select</option>
                                <?php
                                foreach ($degree as $dgr) {
                                    ?>
                                    <option value="<?= $dgr->d_id ?>" <?php
                                    if ($row['degree'] == $dgr->d_id) {
                                        echo "selected=selected";
                                    }
                                    ?>><?= $dgr->d_name ?></option>
                                            <?php
                                        }
                                        ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Branch"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select name="course" class="form-control" id="course2">
                                <option value="">Select</option>
                                <?php
                                $course = $this->db->get_where('course', array('course_status' => 1, 'degree_id' => $row['degree']))->result();
                                foreach ($course as $crs) {
                                    if ($crs->course_id == $row['course']) {
                                        ?>
                                        <option value="<?= $crs->course_id ?>" selected><?= $crs->c_name ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?= $crs->course_id ?>" ><?= $crs->c_name ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Batch"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">                                    
                            <select name="batch" class="form-control" id="batch2">
                                <option value="">Select</option>
                                <?php
                                $databatch = $this->db->query("SELECT * FROM batch WHERE b_status=1 AND FIND_IN_SET('" . $row['degree'] . "',degree_id) AND FIND_IN_SET('" . $row['course'] . "',course_id)")->result();


                                foreach ($databatch as $row1) {
                                    if ($row1->b_id == $row['batch']) {
                                        ?>
                                        <option value="<?= $row1->b_id ?>" selected><?= $row1->b_name ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?= $row1->b_id ?>" ><?= $row1->b_name ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Semester"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select name="semester" class="form-control" id="semester1">
                                <option value="">Select</option>
                                <?php
                                $datasem = $this->db->get_where('semester', array('s_status' => 1))->result();
                                foreach ($datasem as $rowsem) {
                                    if ($rowsem->s_id == $row['semester']) {
                                        ?>
                                        <option value="<?= $rowsem->s_id ?>" selected><?= $rowsem->s_name ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?= $rowsem->s_id ?>" ><?= $rowsem->s_name ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Student"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select name="student" class="form-control" id="student">
                                <option value="">Select</option>
                                <?php foreach ($datastudent as $std): ?>
                                    <option value="<?php echo $std->std_id; ?>" <?php
                                    if ($std->std_id == $row['student']) {
                                        echo "selected=selected";
                                    } else {
                                        
                                    }
                                    ?>><?php echo $std->name; ?></option>
                                        <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Instructions & Guidance"); ?> <span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="instruction" id="instruction"><?php echo $row['instruction']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Submissions"); ?> <span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="submissions" id="submissions"><?php echo $row['submissions']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Feedback by Tutors"); ?> <span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="feedback" id="feedback"><?php echo $row['feedback_tutor']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Marks"); ?> <span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="marks" id="marks"><?php echo $row['marks']; ?></textarea>
                        </div>
                    </div>




                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" id="btnupd" class="submit btn btn-info vd_bg-green"><?php echo ucwords("Update"); ?></button>
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

    <?php
endforeach;
?>

<script type="text/javascript">

    $("#semester1").change(function (event) {
        if ($("#degree2").val() != null & $("#batch2").val() != null & $("#semester1").val() != null & $("#course2").val() != null)
        {
            var course = $("#course2").val();
            var degree = $("#degree2").val();
            var batch = $("#batch2").val();
            var semester = $("#semester1").val();
            var dataString = "course=" + course + "&degree=" + degree + "&batch=" + batch + "&semester=" + semester;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'professor/checkassignment/' . $param2; ?>",
                data: dataString,
                success: function (response) {
                    $("#student").html(response);
                }
            });
        }
    });
    $("#degree2").change(function () {
        var degree = $(this).val();
        var dataString = "degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'professor/get_course/'; ?>",
            data: dataString,
            success: function (response) {
                $("#course2").html(response);
            }
        });
    });

    $("#course2").change(function () {
        var course = $(this).val();
        var degree = $("#degree2").val();
        var dataString = "course=" + course + "&degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'professor/get_batches/'; ?>",
            data: dataString,
            success: function (response) {
                $("#batch2").html(response);
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'professor/get_semester'; ?>",
                    data: dataString,
                    success: function (response1) {
                        $("#semester1").html(response1);
                    }
                });
            }
        });
    });
    $("#semester1").change(function () {
        if ($("#degree2").val() != null & $("#batch2").val() != null & $("#semester1").val() != null & $("#course2").val() != null)
        {
            var course = $("#course2").val();
            var degree = $("#degree2").val();
            var batch = $("#batch2").val();
            var semester = $("#semester1").val();
            var dataString = "course=" + course + "&degree=" + degree + "&batch=" + batch + "&semester=" + semester;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'professor/get_assessment_student'; ?>",
                data: dataString,
                success: function (responses) {
                    $("#student").html(responses);
                }
            });
        }

    });


    $.validator.setDefaults({
        submitHandler: function (form) {
            form.submit();
        }
    });

    $().ready(function () {
        $("#submissiondate1").datepicker({
            format: ' MM d, yyyy',
            startDate: new Date(),
            autoclose:true
        });

        $("#frmeditassignment").validate({
            rules: {
                degree: "required",
                course: "required",
                batch: "required",
                semester: "required",
                instruction: "required",
                submissions: "required",
                feedback: "required",
                marks: "required",
            },
            messages: {
                degree: "Select department",
                course: "Select Branch",
                batch: "Select Batch",
                semester: "Select semester",
                instruction: "Enter instruction",
                submissions: "Enter about submissions",
                marks: "Enter Marks",
            }
        });
    });
</script>
