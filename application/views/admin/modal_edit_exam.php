<?php
$edit_data = $this->db->select('exam_manager.*, exam_type.*, course.*, semester.*')
        ->from('exam_manager')
        ->join('exam_type', 'exam_type.exam_type_id = exam_manager.em_type')
        ->join('course', 'course.course_id = exam_manager.course_id')
        ->join('semester', 'semester.s_id = exam_manager.em_semester')
        ->where('exam_manager.em_id', $param2)
        ->get()
        ->row();

$exam_type = $this->db->get('exam_type')->result();
$degree = $this->db->get('degree')->result();
$query = "SELECT * FROM batch ";
$query .= "WHERE FIND_IN_SET($edit_data->degree_id, degree_id) ";
$query .= "AND FIND_IN_SET($edit_data->course_id, course_id)";
$batch = $this->db->query($query)->result();
$course = $this->db->get_where('course', array(
            'degree_id' => $edit_data->degree_id
        ))->result();
$semester = explode(',', $edit_data->semester_id);
$this->db->where_in('s_id', $semester);
$semester = $this->db->get('semester')->result();

$centerlist = $this->db->get('center_user')->result();
?>

<div class="row">
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <!--            <div class=panel-heading>
                            <h4 class=panel-title>Update Exam</h4>
                        </div>-->
            <div class=panel-body>
                <?php echo form_open(base_url() . 'admin/exam/do_update/' . $edit_data->em_id, array('class' => 'form-horizontal form-groups-bordered validate', 'id' => 'edit-exam-form', 'target' => '_top')); ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("Exam Name"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="exam_name" id="exam_name"
                               value="<?php echo $edit_data->em_name; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("Exam Type"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-7">
                        <select class="form-control" name="exam_type" id="exam_type" required="">
                            <option value="">Select</option>
                            <?php foreach ($exam_type as $row) { ?>
                                <option value="<?php echo $row->exam_type_id; ?>"
                                        <?php if ($edit_data->em_type == $row->exam_type_id) echo 'selected'; ?>><?php echo $row->exam_type_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("Total Marks"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" required="" name="total_marks" id="edit_total_marks" value="<?php echo $edit_data->total_marks; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("Passing Marks"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" required="" name="passing_marks" id="edit_passing_marks" value="<?php echo $edit_data->passing_mark; ?>"/>
                    </div>
                </div>
                <div class="form-group" style="display: none">
                    <label class="col-sm-3 control-label"><?php echo ucwords("Year"); ?></label>
                    <div class="col-sm-7">
                        <select class="form-control" required="" name="year" id="year">

                            <?php for ($i = 2016; $i >= 2010; $i--) { ?>
                                <option <?php echo $i; ?>
                                    <?php if ($edit_data->em_year == $i) echo 'selected'; ?>><?php echo $i; ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("department"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-7">
                        <select class="form-control" required="" name="degree" id="edit_degree">
                            <option>Select</option>
                            <?php foreach ($degree as $d) { ?>
                                <option value="<?php echo $d->d_id; ?>"
                                        <?php if ($d->d_id == $edit_data->degree_id) echo 'selected'; ?>><?php echo $d->d_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("Branch"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-7">
                        <select class="form-control" required="" name="course" id="edit_course">
                            <option value="">Select</option>
                            <?php foreach ($course as $row) { ?>
                                <option value="<?php echo $row->course_id; ?>"
                                        <?php if ($edit_data->course_id == $row->course_id) echo 'selected'; ?>><?php echo $row->c_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("Batch"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-7">
                        <select class="form-control" required="" name="batch" id="edit_batch">
                            <option value="">Select</option>
                            <?php foreach ($batch as $b) { ?>
                                <option value="<?php echo $b->b_id; ?>"
                                        <?php if ($b->b_id == $edit_data->batch_id) echo 'selected'; ?>><?php echo $b->b_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("Semester"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-7">
                        <select class="form-control" required="" name="semester" id="edit_semester">
                            <option value="">Select</option>
                            <?php foreach ($semester as $s) { ?>
                                <option value="<?php echo $s->s_id; ?>"
                                        <?php if ($s->s_id == $edit_data->em_semester) echo 'selected'; ?>><?php echo $s->s_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("Status"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-7">
                        <select class="form-control" required="" name="status" id="status">
                            <option value="">Select</option>
                            <option value="1"
                                    <?php if ($edit_data->em_status == 1) echo 'selected'; ?>>Active</option>
                            <option value="0"
                                    <?php if ($edit_data->em_status == 0) echo 'selected'; ?>>In-active</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("Start Date"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-7">
                        <input readonly="" type="text" required="" id="datepicker-date123" name="date" class="form-control datepicker-normal-edit"
                               value="<?php echo $edit_data->em_date; ?>"/>
                    </div>
                </div>
                <div class="form-group" style="display: none;">
                    <label class="col-sm-3 control-label"><?php echo ucwords("Start Date"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-7">
                        <input readonly="" type="text" name="start_date_time" id="edit_start_date_time" class="form-control"
                               value="<?php echo $edit_data->em_start_time; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("End Date"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-7">
                        <input readonly="" type="text" required="" name="end_date_time" id="edit_end_date_time" class="form-control"
                               value="<?php echo $edit_data->em_end_time; ?>"/>
                    </div>
                </div>	
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="submit btn btn-info vd_bg-green"><?php echo ucwords("Update"); ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div> 
        </div>
    </div>
    <!-- End .panel -->
</div>
<!-- col-lg-12 end here -->
</div>