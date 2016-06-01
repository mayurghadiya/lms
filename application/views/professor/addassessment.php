<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <!--            <div class=panel-heading>
                            <h4 class=panel-title>Add Assessment</h4>
                        </div>-->
            <div class=panel-body>
                <?php echo form_open(base_url() . 'professor/assessments/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'frmassignment', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                <div class="padded">

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("department"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select name="degree" class="form-control" id="degree">
                                <option value="">Department</option>
                                <?php
                                foreach ($degree as $dgr) {
                                    ?>
                                    <option value="<?= $dgr->d_id ?>"><?= $dgr->d_name ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Branch"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select name="course" class="form-control" id="course">
                                <option value="">Branch</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Batch"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select name="batch" class="form-control" id="batch">
                                <option value="">Batch</option>

                            </select>
                        </div>
                    </div>	
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Semester"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select name="semester" class="form-control" id="semester">
                                <option value="">Semester</option>
                                <?php
                                $datasem = $this->db->get_where('semester', array('s_status' => 1))->result();
                                foreach ($datasem as $rowsem) {
                                    ?>
                                    <option value="<?= $rowsem->s_id ?>"><?= $rowsem->s_name ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Student"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select name="student" class="form-control" id="student">
                                <option value="">Student</option>               
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Instructions & Guidance"); ?> <span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="instruction" id="instruction"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Submissions"); ?> <span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="submissions" id="submissions"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Feedback by Tutors"); ?> <span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="feedback" id="feedback"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo ucwords("Marks"); ?> <span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="marks" id="marks"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" id="btnadd" class="btn btn-info vd_bg-green"><?php echo ucwords("Add "); ?></button>
                        </div>
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

<script type="text/javascript">
    $("#degree").change(function () {
        var degree = $(this).val();
        var dataString = "degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'professor/get_course/'; ?>",
            data: dataString,
            success: function (response) {
                $("#course").html(response);
            }
        });
    });

    $("#course").change(function () {
        var course = $(this).val();
        var degree = $("#degree").val();
        var dataString = "course=" + course + "&degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'professor/get_batches/'; ?>",
            data: dataString,
            success: function (response) {
                $("#batch").html(response);

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'professor/get_semester'; ?>",
                    data: dataString,
                    success: function (response1) {
                        $("#semester").html(response1);
                    }
                });
            }
        });
    });
    $("#semester").change(function () {
        if ($("#degree").val() != null & $("#batch").val() != null & $("#semester").val() != null & $("#course").val() != null)
        {
            var course = $("#course").val();
            var degree = $("#degree").val();
            var batch = $("#batch").val();
            var semester = $("#semester").val();
            var dataString = "course=" + course + "&degree=" + degree + "&batch=" + batch + "&semester=" + semester;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'professor/assessment_student'; ?>",
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

        $("#frmassignment").validate({
            rules: {
                degree: "required",
                course: "required",
                batch: "required",
                semester: "required",
                instruction: "required",
                submissions: "required",
                feedback: "required",
                marks:"required",
            },
            messages: {
                degree: "Select department",
                course: "Select Branch",
                batch: "Select Batch",
                semester: "Select semester",
                instruction: "Enter instruction",
                submissions: "Enter about submissions",
                feedback: "Enter feedback",
                marks:"Enter Marks",
            }
        });


    });
</script>