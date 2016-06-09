<div class=row>
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <div class="panel-body"> 
                <div class="">
                    <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?></span> 
                </div>  
                <table class="table table-striped" id="data-tables" style="border:1px solid #ccc;">

                    <thead>
                        <tr>
                            <th><?php echo ucwords("Student Name"); ?></th>
                            <th><?php echo ucwords("Department "); ?></th>
                            <th><?php echo ucwords("Branch "); ?></th>
                            <th><?php echo ucwords("Batch "); ?></th>
                            <th><?php echo ucwords("Semester "); ?></th>
                        </tr>
                    </thead>
                    <?php
                    $degree = $this->db->get_where("degree", array("d_id" => $assessment[0]->std_degree))->result();
                    $course = $this->db->get_where("course", array("course_id" => $assessment[0]->course_id))->result();
                    $batch = $this->db->get_where("batch", array("b_id" => $assessment[0]->std_batch))->result();
                    $semester = $this->db->get_where("semester", array("s_id" => $assessment[0]->semester_id))->result();
                    ?>
                    <tbody>
                    <td><?php echo $assessment[0]->std_first_name . ' ' . $assessment[0]->std_last_name; ?></td>
                    <td><?php
                        if (!empty($degree)) {
                            echo $degree[0]->d_name;
                        }
                        ?></td>
                    <td><?php echo $course[0]->c_name; ?></td>
                    <td><?php echo $batch[0]->b_name; ?></td>
                    <td><?php echo $semester[0]->s_name; ?></td>

                    </tbody>
                </table>               

                <div class="box-content">                    


                    <?php echo form_open(base_url() . 'professor/assessments/submitted/' . $assessment[0]->assignment_submit_id, array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'frmassignment', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <div class="padded">    
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><b><?php echo ucwords("Assignment Title"); ?></b> </label>
                            <div class="col-sm-8">
                                <b><?php echo $assessment[0]->assign_title; ?></b>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><b><?php echo ucwords("Instructions & guidance"); ?></b> </label>
                            <div class="col-sm-8">
                                <b><?php echo $assessment[0]->assignment_instruction; ?></b>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><b><?php echo ucwords("submitted File"); ?></b> </label>
                            <div class="col-sm-8">
                                <a href="<?php echo base_url() . 'uploads/project_file/' . $assessment[0]->document_file; ?>" download=""><?php echo $assessment[0]->document_file; ?></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><b><?php echo ucwords("Feedback by Tutors"); ?></b> <span style="color:red">*</span></label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="feedback" id="feedback"><?php echo $assessment[0]->feedback; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><b><?php echo ucwords("Grade"); ?></b> </label>
                            <div class="col-sm-8">
                                <select class="form-control" name="grade">
                                    <option value="">Select Grade</option>
                                    <option value="A" <?php if ($assessment[0]->grade == "A") {
                                    echo "selected=selected"; } ?>>A</option>
                                    <option value="B"<?php if ($assessment[0]->grade == "B") { 
                                        echo "selected=selected"; }  ?>>B</option>
                                    <option value="C"  <?php if ($assessment[0]->grade == "C") {
                                        echo "selected=selected"; } ?>>C</option>
                                    <option value="D"  <?php if ($assessment[0]->grade == "D") {
                                        echo "selected=selected"; } ?>>D</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" id="btnadd" class="btn btn-info vd_bg-green"><?php echo ucwords("Submit"); ?></button>
                            </div>
                        </div>

                    </div>             
                    </form>               
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">


    $("#degree").change(function () {
        var degree = $(this).val();
        var dataString = "degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/get_course/'; ?>",
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
            url: "<?php echo base_url() . 'admin/get_batches/'; ?>",
            data: dataString,
            success: function (response) {
                $("#batch").html(response);

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'admin/get_semester'; ?>",
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
                url: "<?php echo base_url() . 'admin/assessment_student'; ?>",
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
                feedback: "required",
            },
            messages: {
                feedback: "Enter feedback",
            }
        });


    });
</script>