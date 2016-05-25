<div class="row">
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <div class=panel-heading>
                <h4 class=panel-title>Add New Exam</h4>
            </div>
            <div class=panel-body>
                <?php echo form_open(base_url() . 'admin/exam/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'examform', 'target' => '_top')); ?>
                <div class="padded">
                    <?php
                    $validation_error = validation_errors();
                    if ($validation_error != '') {
                        ?>
                        <div class="alert alert-danger">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <?php echo $validation_error; ?>
                        </div>
                        <script>
                            $(document).ready(function () {
                                $('#add_exam').click();
                            });
                        </script>
                    <?php } ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("Exam Name"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="exam_name" id="exam_name"
                                   value="<?php echo set_value('exam_name'); ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("Exam Type"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="exam_type" id="exam_type">
                                <?php
                                $exam_type_id = set_value('exam_type');
                                ?>
                                <option value="">Select</option>
                                <?php foreach ($exam_type as $row) { ?>
                                    <option value="<?php echo $row->exam_type_id; ?>"
                                            <?php if ($row->exam_type_id == $exam_type_id) echo 'selected'; ?>><?php echo $row->exam_type_name; ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("Total Marks"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="total_marks" id="total_marks"
                                   value="<?php echo set_value('total_marks'); ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("Passing Marks"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="passing_marks" id="passing_marks"
                                   value="<?php echo set_value('total_marks'); ?>"/>
                        </div>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label class="col-sm-3 control-label"><?php echo ucwords("Year"); ?></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="year" id="year">
                                <?php
                                $year = set_value('year');
                                ?>
                                <?php for ($i = 2016; $i >= 2010; $i--) { ?>
                                    <option value="<?php echo $i; ?>"
                                            <?php if ($year == $i) echo 'selected'; ?>><?php echo $i; ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("department"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="degree" id="degree">
                                <option value="">Select</option>
                                <?php foreach ($degree as $row) { ?>
                                    <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("Branch"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="course" id="course">

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("Batch"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="batch" id="batch">

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("Semester"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="semester" id="semester">

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("Status"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-control" name="status" id="status">
                                <?php
                                $status_select_id = set_value('status');
                                ?>
                                <option value="">Select</option>
                                <option value="1" <?php if ($status_select_id == '1') echo 'selected'; ?>>Active</option>
                                <option value="0" <?php if ($status_select_id == '0') echo 'selected'; ?>>In-active</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("Start Date"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-6">
                            <input readonly="" type="text" name="date" id="date" class="form-control datepicker-normal"
                                   value="<?php echo set_value('date'); ?>"/>
                        </div>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label class="col-sm-3 control-label"><?php echo ucwords("Start Date/Time"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-6">
                            <input readonly="" type="text" name="start_date_time" id="start_date_time" class="form-control"
                                   value="<?php echo set_value('start_date_time'); ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("End Date"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-6">
                            <input readonly="" type="text" name="end_date_time" id="end_date_time" class="form-control"
                                   value="<?php echo set_value('end_date_time'); ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-info vd_bg-green"><?php echo ucwords("Add"); ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>  
                </div>
            </div>
            <!-- End .panel -->
        </div>
        <!-- col-lg-12 end here -->
    </div>
