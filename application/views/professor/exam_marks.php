<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <div class=panel-heading>
                <h4 class=panel-title><?php echo $title; ?></h4>
                <div class="panel-controls panel-controls-right">
                    <a class="panel-refresh" href="#"><i class="fa fa-refresh s12"></i></a>
                    <a class="toggle panel-minimize" href="#"><i class="fa fa-plus s12"></i></a>
                    <a class="panel-close" href="#"><i class="fa fa-times s12"></i></a>
                </div>
            </div>
            <div class=panel-body>
                <div class="col-md-12">
                    <div class="form-group col-sm-4 validating">
                        <label><?php echo ucwords("Course"); ?></label>
                        <select id="degree" name="degree" class="form-control">
                            <option value="">Select</option>
                            <?php foreach ($degree as $row) { ?>
                                <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-4 validating">
                        <label><?php echo ucwords("Branch"); ?></label>
                        <select id="course" name="course" class="form-control">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4 validating">
                        <label><?php echo ucwords("Batch"); ?></label>
                        <select id="batch" name="batch" class="form-control">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4 validating">
                        <label><?php echo ucwords("Semester"); ?></label>
                        <select id="semester" name="semester" class="form-control">
                            <option value="">Select</option>                                                    
                        </select>
                    </div>
                    <div class="form-group col-sm-4 validating">
                        <label><?php echo ucwords("Exam"); ?></label>
                        <select id="exam" name="exam" class="form-control">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4 validating">
                        <label><?php echo ucwords("Students"); ?></label>
                        <select id="student" name="student" class="form-control">
                            <option value="">All</option>
                            <?php foreach ($student_list as $exam_student) { ?>
                                <option value="<?php echo $exam_student->std_id; ?>"
                                        <?php if ($student_id == $exam_student->std_id) echo 'selected'; ?>><?php echo $exam_student->std_first_name . ' ' . $exam_student->std_last_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>

                <?php
                $show_exam_details = $this->db->select('exam_manager.*, exam_type.*, course.*, batch.*, semester.*, degree.*')
                        ->from('exam_manager')
                        ->join('exam_type', 'exam_type.exam_type_id = exam_manager.em_type')
                        ->join('course', 'course.course_id = exam_manager.course_id')
                        ->join('semester', 'semester.s_id = exam_manager.em_semester')
                        ->join('degree', 'degree.d_id = exam_manager.degree_id')
                        ->join('batch', 'batch.b_id = exam_manager.batch_id')
                        ->where('exam_manager.em_id', $exam_id)
                        ->get()
                        ->row();
                ?>
            </div>
        </div>
        <!-- End .panel -->
    </div>

    <?php if (count($show_exam_details)) { ?> 
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Exam Details</div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th><?php echo ucwords("Exam Name"); ?></th>
                                <th><?php echo ucwords("Course"); ?></th>
                                <th><?php echo ucwords("Branch"); ?></th>
                                <th><?php echo ucwords("Batch"); ?></th>
                                <th><?php echo ucwords("Semester"); ?></th>
                            </tr>
                            <tr>
                                <td><?php echo $show_exam_details->em_name; ?></td>
                                <td><?php echo $show_exam_details->d_name; ?></td>
                                <td><?php echo $show_exam_details->c_name; ?></td>
                                <td><?php echo $show_exam_details->b_name; ?></td>
                                <td><?php echo $show_exam_details->s_name; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="row">
        <div id="gridview" class="col-sm-12">
            <div style="" id="entermarks" class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title" style="color:#000;"><?php echo ucwords("Enter Marks"); ?></h4>
                </div>
                <form class="form-horizontal" action="" method="post">
                    <div class="table-responsive">
                        <table data-filter="#filter" id="marklist" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%"><?php echo ucwords("Student ID"); ?></th>
                                    <th width="20%"><?php echo ucwords("Student Name"); ?></th>
                                    <?php foreach ($subject_details as $subject) { ?>
                                        <th>Sub: <?php echo $subject->subject_name; ?></th>
                                    <?php } ?>
                                    <th width="15%"><?php echo ucwords("Remarks"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <input type="hidden" name="total_student" value="<?php echo count($student_list); ?>"/>
                            <?php
                            if (count($subject_details)) {
                                $counter = 1;
                                ?>
                                <?php if (count($student_list)) { ?>
                                    <?php
                                    foreach ($student_list as $student) {
                                        if ($student_id != '') {
                                            if ($student_id != $student->std_id) {
                                                continue;
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $student->std_id; ?></td>
                                            <td data-id="63"><?php echo $student->std_first_name . ' ' . $student->std_last_name; ?></td>

                                            <?php foreach ($subject_details as $subject) { ?>
                                                <?php
                                                $where = array(
                                                    'mm_std_id' => $student->std_id,
                                                    'mm_subject_id' => $subject->sm_id,
                                                    'mm_exam_id' => $exam_detail[0]->em_id,
                                                );
                                                $marks = $this->Professor_model->student_exam_mark($where);
                                                ?>
                                                <td><input type="number" class="form-control" placeholder="Obtained Marks / <?php echo $exam_detail[0]->total_marks; ?>"
                                                           min="0" max="<?php echo $exam_detail[0]->total_marks; ?>"
                                                           name="mark_<?php echo $counter; ?>_<?php echo $student->std_id; ?>_<?php echo $exam_detail[0]->em_id; ?>_<?php echo $subject->sm_id; ?>"
                                                           value="<?php if (count($marks)) echo $marks->mark_obtained; ?>"/></td>
                                                <?php } ?>

                                            <td><input type="text" class="form-control" 
                                                       value="<?php if (count($marks)) echo $marks->mm_remarks; ?>"
                                                       name="remark_<?php echo $counter; ?>_<?php echo $student->std_id; ?>_<?php echo $exam_detail[0]->em_id; ?>"/></td>
                                        </tr>
                                        <?php
                                        $counter++;
                                    }
                                    ?>

                                    <?php
                                } else {
                                    ?>

                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4">Exam schedule not found</td>
                                </tr>

                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <br/>
                    <?php if (count($student_list)) { ?>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form_sep">
                                    &nbsp;<input type="submit" class="btn btn-success" value="Submit"/> 
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </form>


            </div>
        </div>
    </div>
    <!-- col-lg-12 end here -->
</div>
<!-- End .row -->
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->