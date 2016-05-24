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
                <form id="attendance-routine" action="#" method="post" class="form-groups-bordered validate">
                    <div class="col-md-12">
                        <div class="form-group col-sm-3">
                            <label><?php echo ucwords("department"); ?></label>
                            <select class="form-control" id="department" name="department" required="">
                                <option value="">Select</option>
                                <?php foreach ($degree as $row) { ?>
                                    <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label><?php echo ucwords("Branch"); ?></label>
                            <select id="branch" name="branch" class="form-control" required="">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label><?php echo ucwords("Batch"); ?></label>
                            <select id="batch" name="batch" class="form-control" required="">
                                <option value="">Select</option>
                            </select>
                        </div>    
                        <div class="form-group col-sm-3">
                            <label> <?php echo ucwords("Semester"); ?></label>
                            <select id="semester" name="semester" data-filter="6" class="form-control" required="">
                                <option value="">Select</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group col-sm-3">
                            <label> <?php echo ucwords("class"); ?></label>
                            <select id="class" name="class" class="form-control" required="">
                                <option value="">Select</option>
                                <?php foreach ($class as $row) { ?>
                                    <option value="<?php echo $row->class_id; ?>"><?php echo $row->class_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label> <?php echo ucwords("date"); ?></label>
                            <input id="date" required="" type="text" class="form-control datepicker-normal" name="date" placeholder="Select"/>
                        </div>
                        <div class="form-group col-sm-5">
                            <label> <?php echo ucwords("class routine"); ?></label>
                            <select id="class_routine" name="class_routine" class="form-control" required="">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-1">
                            <label>&nbsp;</label><br/>
                            <input id="search-exam-data" type="submit" value="Go" class="btn btn-info vd_bg-green"/>
                        </div>
                    </div>
                </form>

                <div id="student-attendance-list">
                    <div class="col-md-12">
                        <?php if (count($student)) { ?>
                            <?php
                            $this->load->model('admin/Crud_model');
                            ?>
                            <br/>
                            <form method="post" action="<?php echo base_url(); ?>professor/take_class_routine_attendance"
                                  class="form-groups-bordered">
                                <input type="hidden" name="department" value="<?php echo $department; ?>"/>
                                <input type="hidden" name="branch" value="<?php echo $branch; ?>"/>
                                <input type="hidden" name="batch" value="<?php echo $batch; ?>"/>
                                <input type="hidden" name="semester" value="<?php echo $semester; ?>"/>
                                <input type="hidden" name="class" value="<?php echo $class_name; ?>"/>
                                <input type="hidden" name="professor" value="<?php echo $professor; ?>"/>
                                <input type="hidden" name="class_routine" value="<?php echo $class_routine; ?>"/>
                                <input type="hidden" name="date" value="<?php echo $date; ?>"/>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            Student List
                                            <br/>
                                            Total Students: <?php echo count($student); ?>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-responsive" id="attendance-data-table-2">
                                            <thead>
                                            <th>SR</th>
                                            <th>Roll No</th>
                                            <th>Student Name</th>
                                            <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $counter = 1;
                                                $date = date('Y-m-d', strtotime($date));
                                                foreach ($student as $row) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $counter++; ?></td>
                                                        <td><?php echo $row->std_roll; ?></td>
                                                        <td><?php echo $row->std_first_name . ' ' . $row->std_last_name; ?></td>
                                                        <?php
                                                        $status = $this->Crud_model->check_attendance_status($department, $branch, $batch, $semester, $class_name, $class_routine, $date, $row->std_id);
                                                        ?>
                                                        <td>
                                                            <?php if (isset($status)) { ?>
                                                                <input type="checkbox" name="student_<?php echo $row->std_id; ?>" 
                                                                       <?php if ($status->is_present == 1) echo 'checked=""'; ?>/>
                                                                   <?php } else { ?>
                                                                <input type="checkbox" name="student_<?php echo $row->std_id; ?>" checked=""/>
                                                            <?php }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group col-sm-1">
                                    <label>&nbsp;</label>
                                    <input type="submit" value="Submit" class="btn btn-info vd_bg-green"/>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>

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