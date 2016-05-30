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
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Select Exam</label>
                            <div class="col-sm-3">
                                <select class="form-control" id="exam" name="exam">
                                    <option value="">Select</option>
                                    <?php foreach ($exam_listing as $row) { ?>
                                        <option value="<?php echo $row->em_id; ?>"
                                                <?php if ($exam_id == $row->em_id) echo 'selected'; ?>><?php echo $row->s_name . ' -- ' . $row->em_name . ' -- ' . $row->exam_ref_name; ?></option>
                                            <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div><!--/row-->
                <br/>
                <div class="well well-sm">
                    <h4 class="page-header edusec-border-bottom-warning">
                        <i class="fa fa-info-circle"></i> Student Current Details 
                    </h4>
                    <div class="table-responsive">
                        <table>
                            <colgroup><col style="width:500px">
                                <col style="width:80%">
                            </colgroup><tbody><tr>
                                    <td>
                                        <h3 class="text-primary">
                                            <b><span class="glyphicon glyphicon-user"></span> 
                                                <?php echo $student_detail->std_first_name . ' ' . $student_detail->std_last_name; ?>
                                            </b>
                                        </h3>
                                        <p>
                                            <strong>Student Roll Number : </strong> 
                                            <?php echo $student_detail->std_roll; ?>
                                        </p>
                                        <p>
                                            <strong>Batch :   </strong> 
                                            <?php echo $batch_detail->b_name; ?>
                                        </p>
<!--                                            <p>
                                            <strong>Active/InActive : </strong>
                                            <span class="label label-success">Active</span>
                                        </p>-->
                                    </td>
                                </tr>
                            </tbody></table>
                    </div><!--/table-responsive-->
                </div><!--/well-->

                <?php if (count($student_marks)) { ?>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Academic Year : <?php echo date('Y'); ?></h3>
                        </div><!--/box-header-->
                        <div class="box-body">
                            <div class="box box-warning box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Branch : <?php echo $batch_detail->b_name; ?> (<?php echo $batch_detail->c_name; ?>)</h3>
                                </div><!--/box-header-->
                                <div class="box-body">
                                    <div class="box box-info box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Exam Name : <?php echo $exam_details->em_name; ?></h3>
                                            <!--<div class="pull-right">
                                                    <strong>Exam Type : </strong>Marks and Grade
                                            </div>-->
                                        </div><!--/box-header-->
                                        <div class="box-body no-padding table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>SI NO.</th>
                                                        <th>Subject Code</th>
                                                        <th>Subject Name</th>
                                                        <th>Total Marks</th>
                                                        <th>Passing Marks</th>
                                                        <th>Obtained Marks</th>
                                                        <th>Grade</th>
                                                        <th>Results</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                    <?php
                                                    $counter = 1;
                                                    $total_marks = 0;
                                                    $obtained_marks = 0;
                                                    $is_failed = FALSE;
                                                    foreach ($student_marks as $row) {
                                                        $is_number = is_numeric($row->mark_obtained);
                                                        if (!$is_number)
                                                            continue;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $counter++; ?></td>
                                                            <td><?php echo $row->subject_code; ?></td>
                                                            <td><?php echo $row->subject_name; ?></td>
                                                            <td><?php echo $exam_details->total_marks; ?></td>
                                                            <?php $total_marks += $exam_details->total_marks; ?>
                                                            <td><?php echo $exam_details->passing_mark; ?></td>
                                                            <td><?php echo $row->mark_obtained; ?></td>
                                                            <?php if ($row->mark_obtained < $exam_details->passing_mark) $is_failed = TRUE; ?>
                                                            <?php $obtained_marks += $row->mark_obtained; ?>
                                                            <?php
                                                            $percentage = ($row->mark_obtained * 100) / $exam_details->total_marks;
                                                            ?>
                                                            <td>
                                                                <?php
                                                                $grade = $percentage;
                                                                $grade = (int) (100 * $row->mark_obtained) / $exam_details->total_marks;
                                                                $grade_data = $this->db->select()
                                                                        ->from('grade')
                                                                        ->where('from_marks >= ', $grade)
                                                                        ->order_by('from_marks', 'ASC')
                                                                        ->limit(1)
                                                                        ->get()
                                                                        ->row();
                                                                $is_pass = TRUE;

                                                                if ($row->mark_obtained < $exam_details->passing_mark) {
                                                                    echo 'F';
                                                                    $is_pass = FALSE;
                                                                } else {
                                                                    echo $grade_data->grade_name;
                                                                    $is_pass = TRUE;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php
                                                                if ($is_pass)
                                                                    echo 'Pass';
                                                                else
                                                                    echo 'Fail';
                                                                ?></td>
                                                            <td><?php echo ''; ?></td>

                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div><!--/box-body-->
                                        <div class="box-footer">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <strong>Total Marks : </strong><?php echo $total_marks; ?>	
                                                </div>
                                                <div class="col-sm-3">
                                                    <strong>Total Obtained Marks : </strong><?php echo $obtained_marks; ?>	
                                                </div>
                                                <div class="col-sm-3">
                                                    <strong>Total Percentages Marks : </strong><?php echo number_format((($obtained_marks * 100) / $total_marks), 2, '.', ''); ?>%</div>
                                                <div class="col-sm-3">
                                                    <strong>Results : </strong>
                                                    <?php if (!$is_failed) { ?>
                                                        <span class="label label-success">Pass</span>    
                                                    <?php } else { ?>
                                                        <span class="label label-danger">Failed</span>
                                                    <?php }
                                                    ?>

                                                </div>
                                            </div>
                                        </div><!--/box-footer-->
                                    </div><!--/box-->

                                </div><!--/box-body-->
                            </div><!--/box-->
                        </div><!--/box-body-->
                    </div><!--/box-->
                <?php } ?>

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
        $('#exam').on('change', function () {
            var exam_id = $(this).val();
            if (exam_id != '')
                location.href = "<?php echo base_url(); ?>student/exam_marks/" + exam_id;
        })
    })
</script>