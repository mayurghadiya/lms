<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker3.min.css">

<style>
    .table-striped .highlight, .table-striped .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
    .table-striped ul{margin:0;padding:0;}
   .table-striped li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
</style>

<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->

        <div class="panel-default toggle panelMove panelClose panelRefresh"></div> 
           <div class=panel-body>            

                <div class="panel-default toggle">

                    <div class="tabs mb20">
                        <ul id="import-tab" class="nav nav-tabs">
                            <li  class="active">
                                <a href="#add" data-toggle="tab" aria-expanded="false"> <?php echo ucwords("Add Activity"); ?></a>
                            </li>
                            <li class="">
                                <a href="#list" data-toggle="tab" aria-expanded="true"><?php echo ucwords("Activity List"); ?></a>                            
                            </li>  
                            <li class="">
                                <a href="#listing" data-toggle="tab" aria-expanded="false"> <?php echo ucwords("Volunteer List"); ?></a>
                            </li>

                            <li class="">
                                <a href="#addsurvey" data-toggle="tab" aria-expanded="false">  <?php echo ucwords("Add Question"); ?></a>
                            </li>
                            <li class="">
                                <a href="#newlist" data-toggle="tab" aria-expanded="false">  <?php echo ucwords("Question List"); ?></a>
                            </li>
                            <li class="">
                                <a href="#survey" data-toggle="tab" aria-expanded="false">  <?php echo ucwords("Survey List"); ?></a>
                            </li>
                            <li class="">
                                <a href="#uploads" data-toggle="tab" aria-expanded="false"> <?php echo ucwords("Upload List"); ?></a>
                            </li>                        
                        </ul> 
                        <div id="import-tab-content" class="tab-content">
                            <div class="tab-pane fade out" id="list">
                                <div class="panel-body table-responsive">
                                    <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="datatable-list">
                                        <thead>
                                            <tr>
                                                <th width="12.5%">No</th>											
                                                <th width="12.5%"><?php echo ucwords("activity Title"); ?> </th>											
                                                <th width="12.5%"><?php echo ucwords("department"); ?></th>											
                                                <th width="12.5%"><?php echo ucwords("Branch"); ?></th>
                                                <th width="12.5%"><?php echo ucwords("Batch"); ?></th>											
                                                <th width="12.5%"><?php echo ucwords("Semester"); ?></th>											                                              
                                                <th width="12.5%"><?php echo ucwords("Date of submission"); ?></th>									
                                                <th width="12.5%"><?php echo ucwords("Action"); ?></th>	
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            foreach ($participate as $row):
                                                ?>
                                                <tr>
                                                    <td width="12.5%"><?php echo $count++; ?></td>	
                                                    <td width="12.5%"><?php echo $row->pp_title; ?></td>	
                                                    <td width="12.5%">
                                                        <?php
                                                        if ($row->pp_degree == "All") {
                                                            echo "All";
                                                        } else {
                                                            foreach ($degree as $deg) {

                                                                if ($deg->d_id == $row->pp_degree) {
                                                                    echo $deg->d_name;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>	
                                                    <td width="12.5%">
                                                        <?php
                                                        if ($row->pp_course == "All") {
                                                            echo "All";
                                                        } else {
                                                            foreach ($course as $crs) {

                                                                if ($crs->course_id == $row->pp_course) {
                                                                    echo $crs->c_name;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td width="12.5%">
                                                        <?php
                                                        if ($row->pp_batch == "All") {
                                                            echo "All";
                                                        } else {
                                                            foreach ($batch as $bch) {

                                                                if ($bch->b_id == $row->pp_batch) {
                                                                    echo $bch->b_name;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>	
                                                    <td width="12.5%">
                                                        <?php
                                                        if ($row->pp_semester == "All") {
                                                            echo "All";
                                                        } else {
                                                            foreach ($semester as $sem) {
                                                                if ($sem->s_id == $row->pp_semester) {
                                                                    echo $sem->s_name;
                                                                }
                                                            }
                                                        }
                                                        ?>                                            
                                                    <td width="12.5%"><?php echo date_formats($row->pp_dos); ?></td>	
                                                    <td width="12.5%" class="menu-action">
                                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_participate/<?php echo $row->pp_id; ?>');"  data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>

                                                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/participate/delete/<?php echo $row->pp_id; ?>');"  data-toggle="tooltip" data-placement="top" ><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>	
                                                    </td>	
                                                </tr>
                                            <?php endforeach; ?>						
                                        </tbody>
                                    </table>


                                </div>

                            </div> <!-- Participate list end -->

                            <div class="tab-pane fade active in" id="add">
                                <div class="box-content">       
                                    <div class="">
                                        <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?></span> 
                                    </div>                                      
                                    <?php echo form_open(base_url() . 'admin/participate/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'frmparticipate', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                                    <div class="padded">											
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"><?php echo ucwords("department "); ?><span style="color:red">*</span></label>
                                            <div class="col-sm-5">
                                                <select name="degree" id="degree"  class="form-control">
                                                    <option value="">Select department</option>
                                                    <option value="All">All</option>
                                                    <?php
                                                    //$datadegree = $this->db->get_where('degree', array('d_status' => 1))->result();
                                                    foreach ($degree as $rowdegree) {
                                                        ?>
                                                        <option value="<?= $rowdegree->d_id ?>"><?= $rowdegree->d_name ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>	
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"><?php echo ucwords("Branch "); ?><span style="color:red">*</span></label>
                                            <div class="col-sm-5">
                                                <select name="course" id="course"  class="form-control">
                                                    <option value="">Select Branch</option>
                                                    <option value="All">All</option>
                                                    <?php
                                                    /*
                                                     * $course = $this->db->get_where('course', array('course_status' => 1))->result();
                                                      foreach ($course as $crs) {
                                                      ?>
                                                      <!--  <option value="<?= $crs->course_id ?>"><?= $crs->c_name ?></option>-->
                                                      <?php
                                                      } */
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"><?php echo ucwords("Batch "); ?><span style="color:red">*</span></label>
                                            <div class="col-sm-5">
                                                <select name="batch" id="batch" onchange="get_student2(this.value);"  class="form-control" >
                                                    <option value="">Select batch</option>
                                                    <option value="All">All</option>
                                                    <?php
                                                    /* $databatch = $this->db->get_where('batch', array('b_status' => 1))->result();
                                                      foreach ($databatch as $row) {
                                                      ?>
                                                      <option value="<?= $row->b_id ?>"><?= $row->b_name ?></option>
                                                      <?php
                                                      } */
                                                    ?>
                                                </select>
                                            </div>
                                        </div>	
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"><?php echo ucwords("Semester "); ?><span style="color:red">*</span></label>
                                            <div class="col-sm-5">
                                                <select name="semester" id="semester" onchange="get_students2(this.value);"  class="form-control">
                                                    <option value="">Select Semester</option>
                                                    <option value="All">All</option>
                                                    <?php
                                                    //$datasem = $this->db->get_where('semester', array('s_status' => 1))->result();
                                                    foreach ($semester as $rowsem) {
                                                        ?>
                                                        <option value="<?= $rowsem->s_id ?>"><?= $rowsem->s_name ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"><?php echo ucwords("Participate Title "); ?><span style="color:red">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="title" id="title" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"><?php echo ucwords("Date "); ?><span style="color:red">*</span></label>
                                            <div class="col-sm-5">     
                                                <input type="text" class="form-control" name="dateofsubmission" id="dateofsubmission" />                              
                                            </div>               
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"><?php echo ucwords("Description"); ?></label>
                                            <div class="col-sm-5">
                                                <textarea class="form-control" name="description" id="description"></textarea>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-5">
                                                <button type="submit" class="btn btn-info vd_bg-green"><?php echo ucwords("Add"); ?></button>
                                            </div>
                                        </div>
                                        </form>               
                                    </div>                
                                </div>
                                <!----CREATION FORM ENDS-->
                            </div>
                            <div class="tab-pane fade out" id="survey">
                                <div class="panel-body table-responsive" id="getresponse">
                                    <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="survey-table">
                                        <thead>
                                            <tr>                                           
                                                <th>No</th>                                           
                                                <th><?php echo ucwords("Student Name"); ?></th>       
                                                <th><?php echo ucwords("department"); ?></th>
                                                <th><?php echo ucwords("Branch"); ?></th>
                                                <th><?php echo ucwords("Batch"); ?></th>											
                                                <th><?php echo ucwords("Semester"); ?></th>	
                                                <th><?php echo ucwords("Action"); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            foreach ($survey as $row):
                                                ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>    
                                                    <td><?php
                                                        foreach ($student as $stu) {
                                                            if ($stu->std_id == $row->student_id) {
                                                                echo $stu->name;
                                                            }
                                                        }
                                                        ?></td>
                                                    <td>
                                                        <?php
                                                        foreach ($degree as $deg) {
                                                            if ($deg->d_id == $row->std_degree) {
                                                                echo $deg->d_name;
                                                            }
                                                        }
                                                        ?>
                                                    </td>	
                                                    <td>
                                                        <?php
                                                        foreach ($course as $crs) {
                                                            if ($crs->course_id == $row->course_id) {
                                                                echo $crs->c_name;
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        foreach ($batch as $bch) {
                                                            if ($bch->b_id == $row->std_batch) {
                                                                echo $bch->b_name;
                                                            }
                                                        }
                                                        ?>
                                                    </td>	
                                                    <td>
                                                        <?php
                                                        foreach ($semester as $sem) {
                                                            if ($sem->s_id == $row->semester_id) {
                                                                echo $sem->s_name;
                                                            }
                                                        }
                                                        ?>

                                                    </td>
                                                    <td class="menu-action">
                                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_survey_detal/<?php echo $row->student_id; ?>');" data-original-title="View Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow"><i class="fa fa-file-o"></i></a>
                                                    </td>  
                                                </tr>
                                            <?php endforeach; ?>                        
                                        </tbody>
                                    </table>
                                </div>


                            </div> <!-- end  -->
                            <div class="tab-pane fade out" id="addsurvey">
                                <div class="box-content">                   
                                    <div class="">
                                        <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?></span> 
                                    </div>  
                                    <?php echo form_open(base_url() . 'admin/survey/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'frmsurvey', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                                    <div class="padded">                                            

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"><?php echo ucwords("Question "); ?><span style="color:red">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="question" id="question" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"><?php echo ucwords("Short Description "); ?><span style="color:red">*</span></label>
                                            <div class="col-sm-5">
                                                <textarea class="form-control" name="description" id="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label"><?php echo ucwords("Status "); ?><span style="color:red">*</span></label>
                                            <div class="col-sm-5">
                                                <label class="radio-inline">
                                                    <input type="radio" id="status" name="status" value="1" >Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" id="status" name="status" value="0" > Inactive
                                                </label>
                                                <label for="status" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-5">
                                                <button type="submit" class="btn btn-info vd_bg-green"><?php echo ucwords("Add "); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>           


                                </div>
                            </div>
                            <div class="tab-pane fade out" id="newlist">
                                <div class="panel-body table-responsive">
                                    <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="data-tabless">
                                        <thead>
                                            <tr>
                                                <th>No</th>                                           
                                                <th><?php echo ucwords("Question"); ?></th>       
                                                <th><?php echo ucwords("Description"); ?></th>       
                                                <th><?php echo ucwords("Rating"); ?></th>       
                                                <th><?php echo ucwords("Status"); ?></th>
                                                <th><?php echo ucwords("Action"); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $countq = 1;

                                            foreach ($questions as $rowq):
                                                ?>
                                                <tr>
                                                    <td><?php echo $countq++; ?></td>    
                                                    <td><?php echo $rowq->question; ?></td>    
                                                    <td><?php echo $rowq->question_description; ?></td>  
                                                    <td width="20%"><?php
                                                   $ret =  $this->Crud_model->get_ratings($rowq->sq_id);
                                                   // echo $ret->avg_r; ?>
                                                    <ul><?php  
                                                    $rating = round($ret->avg_r);
                                                    $selected=" ";
                                                                    for ($i = 1; $i <= 5; $i++) {
                                                                        if(!empty($rating) && $i<=$rating) {
                                                                               $selected = "selected";
                                                                       }   ?>
                                                        <li class='<?php echo $selected; ?>' >&#9733;</li>
                                                        <?php
                                                        $selected = '';
                                                        } ?>
                                                    <ul>
                                                    </td>                                                    
                                                    <td>
                                                        <?php if ($rowq->question_status == '1') { ?>
                                                            <span class="label label-success">Active</span>
                                                        <?php } else { ?>	
                                                            <span class="label label-danger">InActive</span>
                                                        <?php } ?>

                                                        <?php //echo ($rowq->question_status == "1") ? 'Active' : 'Deactive'; ?></td>    

                                                    <td>  <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_question/<?php echo $rowq->sq_id; ?>');"  data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>

                                                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/survey/delete/<?php echo $rowq->sq_id; ?>');"  data-toggle="tooltip" data-placement="top" ><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>	</td>
                                                </tr>
                                            <?php endforeach; ?>                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade out" id="listing">
                                <div  id="getsubmit">
                                    <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="data-tables-activity">
                                        <thead>
                                            <tr>                                                
                                                <th>No</th>				
                                                <th>Roll No</th>
                                                <th><?php echo ucwords("Student Name"); ?></th>	
                                                <th><?php echo ucwords("Parti. Title"); ?></th>
                                                <th><?php echo ucwords("Comment"); ?></th>
                                                <th><?php echo ucwords("department"); ?></th>											
                                                <th><?php echo ucwords("Branch"); ?></th>
                                                <th><?php echo ucwords("Batch"); ?></th>
                                                <th><?php echo ucwords("Semester"); ?></th>											
                                                <th><?php echo ucwords("Parti. Status"); ?></th>											                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $counts = 1;

                                            foreach ($volunteer as $rows):
                                                $std_id = $rows['student_id'];
                                                $pp_id = $rows['pp_id'];
                                                $this->db->join('degree', 'degree.d_id=student.std_degree');
                                                $this->db->join('semester', 'semester.s_id=student.semester_id');
                                                $this->db->join('batch', 'batch.b_id=student.std_batch');
                                                $this->db->join('course', 'course.course_id=student.course_id');

                                                $user = $this->db->get_where('student', array('std_id' => $std_id))->result_array();
                                                $part = $this->db->get_where('participate_manager', array('pp_id' => $pp_id))->result_array();
                                                ?>
                                                <tr>
                                                    <td><?php echo $counts++; ?></td>	
                                                    <td><?php echo $user[0]['std_roll']; ?></td>
                                                    <td><?php echo $user[0]['name']; ?></td>	
                                                    <td><?php echo $part[0]['pp_title']; ?></td>
                                                    <td><?php echo wordwrap($rows['comment'], 40, "<br>\n", true); ?></td>
                                                    <td><?php
                                                        if (isset($user[0]['d_name'])) {
                                                            echo $user[0]['d_name'];
                                                        }
                                                        ?></td>

                                                    <td><?php
                                                        if (isset($user[0]['c_name'])) {
                                                            echo $user[0]['c_name'];
                                                        }
                                                        ?></td>	
                                                    <td><?php
                                                        if (isset($user[0]['b_name'])) {
                                                            echo $user[0]['b_name'];
                                                        }
                                                        ?></td>
                                                    <td><?php
                                                        if (isset($user[0]['s_name'])) {
                                                            echo $user[0]['s_name'];
                                                        }
                                                        ?></td>	
                                                    <td><a href="<?php echo base_url(); ?>admin/confirmparticipate/<?php echo $rows['participate_student_id']; ?>" class="btn btn-info vd_bg-green">Disapprove</a></td>	                                                    

                                                </tr>
                                            <?php endforeach; ?>						
                                        </tbody>
                                    </table>
                                </div>
                            </div>                        
                            <!-- tab content -->
                            <div class="tab-pane fade" id="uploads">
                                <div class="panel-body table-responsive" id="upd_getsubmit">                               
                                    <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%  id="uploaded-table">
                                        <thead>
                                            <tr>                                                
                                                <th>No</th>				
                                                <th>Roll No</th>                                                 
                                                <th><?php echo ucwords("Student Name"); ?></th>	                                               
                                                <th><?php echo ucwords("department"); ?></th>											
                                                <th><?php echo ucwords("Branch"); ?></th>
                                                <th><?php echo ucwords("Batch"); ?></th>
                                                <th><?php echo ucwords("Semester"); ?></th>											
                                                <th><?php echo ucwords("Title"); ?></th>
                                                <th><?php echo ucwords("Description"); ?></th>
                                                <th><?php echo ucwords("File"); ?></th>											                                                                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $countsu = 1;



                                            foreach ($uploads as $rowsupl):
                                                $std_id = $rowsupl['std_id'];
                                                //   $pp_id =  $rowsupl['pp_id'];
                                                // if()                                                
                                                $this->db->join('degree', 'degree.d_id=student.std_degree');
                                                $this->db->join('semester', 'semester.s_id=student.semester_id');
                                                $this->db->join('batch', 'batch.b_id=student.std_batch');
                                                $this->db->join('course', 'course.course_id=student.course_id');
                                                $this->db->select('student.std_id, student.std_roll, student.name, degree.d_name, course.c_name, batch.b_name, semester.s_name');
                                                $this->db->from('student');
                                                $this->db->where('std_id', $std_id);
                                                $user1 = $this->db->get()->result_array();
                                                //$user1 = $this->db->get_where('student', array('std_id' => $std_id))->result_array();
                                                ?>
                                                <tr>
                                                    <td><?php echo $countsu++; ?></td>	
                                                    <td><?php echo $user1[0]['std_roll']; ?></td>
                                                    <td><?php echo $user1[0]['name']; ?></td>	
                                                    <td><?php
                                                        if (isset($user1[0]['d_name'])) {
                                                            echo $user1[0]['d_name'];
                                                        }
                                                        ?></td>

                                                    <td><?php
                                                        if (isset($user1[0]['c_name'])) {
                                                            echo $user1[0]['c_name'];
                                                        }
                                                        ?></td>	
                                                    <td><?php
                                                        if (isset($user1[0]['b_name'])) {
                                                            echo $user1[0]['b_name'];
                                                        }
                                                        ?></td>
                                                    <td><?php
                                                        if (isset($user1[0]['s_name'])) {
                                                            echo $user1[0]['s_name'];
                                                        }
                                                        ?></td>	
                                                    <td ><?php echo $rowsupl['upload_title']; ?></td>	
                                                    <td ><?php echo $rowsupl['upload_desc']; ?></td>	
                                                    <td id="downloadedfile"><a href="<?php echo base_url() . 'uploads/project_file/' . $rowsupl['upload_file_name']; ?>" download=""><i class="fa fa-download" title="<?php echo $rowsupl['upload_file_name']; ?>"></i></a></td>	

                                                </tr>
                                            <?php endforeach; ?>						
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>

                    </div>                 
                </div>                 
            </div>
            <!-- row --> 
        </div>
    </div>
</div></div></div>

<script type="text/javascript">
     $( "#dateofsubmission" ).focusin(function() {
         $(this).prop('readonly', true);
      });
      $( "#dateofsubmission" ).focusout(function() {
         $(this).prop('readonly', false);
      });
    $(document).ready(function () {
        $("#upd_searchform").validate({
            rules: {
                degree: "required",
                course: "required",
                batch: "required",
                semester: "required",
            },
            messages: {
                degree: "select course",
                course: "select branch",
                batch: "select batch",
                semester: "select semester",
            }
        });
        $("#sub_searchform").validate({
            rules: {
                degree: "required",
                course: "required",
                batch: "required",
                semester: "required",
            },
            messages: {
                degree: "select course",
                course: "select branch",
                batch: "select batch",
                semester: "select semester",
            }
        });
        $("#searchform").validate({
            rules: {
                degree: "required",
                course: "required",
                batch: "required",
                semester: "required",
            },
            messages: {
                degree: "select course",
                course: "select branch",
                batch: "select batch",
                semester: "select semester",
            }
        });
    });
    $("#upd_courses").change(function () {
        var degree = $(this).val();

        var dataString = "degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/get_course/'; ?>",
            data: dataString,
            success: function (response) {
                $("#upd_branches").html(response);
            }
        });
    });
    $("#upd_branches").change(function () {
        //var course = $(this).val();
        // var degree = $("#degree").val();
        var degree = $("#upd_courses").val();
        var course = $("#upd_branches").val();
        var dataString = "course=" + course + "&degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/get_batches/'; ?>",
            data: dataString,
            success: function (response) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'admin/get_semester'; ?>",
                    data: {'course': course},
                    success: function (response1) {
                        $("#upd_semesters").html(response1);
                    }
                });
                $("#upd_batches").html(response);
            }
        });
    });
    $("#upd_searchform").submit(function () {
        var degree = $("#upd_courses").val();
        var course = $("#upd_branches").val();
        var batch = $("#upd_batches").val();
        var semester = $("#upd_semesters").val();
        if ($("#upd_courses").val() != "" & $("#upd_branches").val() != "" & $("#upd_batches").val() != "" & $("#upd_semesters").val() != "")
        {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>admin/getuploads/",
                data: {'degree': degree, 'course': course, 'batch': batch, "semester": semester},
                success: function (response)
                {
                    $("#upd_getsubmit").html(response);
                }


            });
        } else {
            $("#upd_searchform").validate({
                rules: {
                    degree: "required",
                    course: "required",
                    batch: "required",
                    semester: "required",
                },
                messages: {
                    degree: "Select course",
                    course: "Select branch",
                    batch: "Select batch",
                    semester: "Select semester",
                }
            });

        }
        return false;


    });
    $("#sub_courses").change(function () {
        var degree = $(this).val();

        var dataString = "degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/get_course/'; ?>",
            data: dataString,
            success: function (response) {
                $("#sub_branches").html(response);
            }
        });
    });
    $("#sub_branches").change(function () {
        //var course = $(this).val();
        // var degree = $("#degree").val();
        var degree = $("#sub_courses").val();
        var course = $("#sub_branches").val();
        var dataString = "course=" + course + "&degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/get_batches/'; ?>",
            data: dataString,
            success: function (response) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'admin/get_semester'; ?>",
                    data: {'course': course},
                    success: function (response1) {
                        $("#sub_semesters").html(response1);
                    }
                });
                $("#sub_batches").html(response);
            }
        });
    });
    $("#sub_searchform").submit(function () {
        var degree = $("#sub_courses").val();
        var course = $("#sub_branches").val();
        var batch = $("#sub_batches").val();
        var semester = $("#sub_semesters").val();
        if ($("#sub_courses").val() != "" & $("#sub_branches").val() != "" & $("#sub_batches").val() != "" & $("#sub_semesters").val() != "")
        {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>admin/getactivity/",
                data: {'degree': degree, 'course': course, 'batch': batch, "semester": semester},
                success: function (response)
                {
                    $("#getsubmit").html(response);
                }


            });
        } else {
            $("#sub_searchform").validate({
                rules: {
                    degree: "required",
                    course: "required",
                    batch: "required",
                    semester: "required",
                },
                messages: {
                    degree: "Select department",
                    course: "Select branch",
                    batch: "Select batch",
                    semester: "Select semester",
                }
            });
        }
        return false;


    });

    $("#searchform").submit(function () {
        var degree = $("#courses").val();
        var course = $("#branches").val();
        var batch = $("#batches").val();
        var semester = $("#semesters").val();
        if ($("#courses").val() != "" & $("#branches").val() != "" & $("#batches").val() != "" & $("#semesters").val() != "")
        {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>admin/getsurvey/",
                data: {'degree': degree, 'course': course, 'batch': batch, "semester": semester},
                success: function (response)
                {
                    $("#getresponse").html(response);
                }


            });
        } else {
            $("#searchform").validate({
                rules: {
                    degree: "required",
                    course: "required",
                    batch: "required",
                    semester: "required",
                },
                messages: {
                    degree: "Select department",
                    course: "Select branch",
                    batch: "Select batch",
                    semester: "Select semester",
                }
            });
        }
        return false;
    });
    $("#courses").change(function () {
        var degree = $(this).val();

        var dataString = "degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/get_course/'; ?>",
            data: dataString,
            success: function (response) {
                $("#branches").html(response);
            }
        });
    });
    $("#branches").change(function () {
        //var course = $(this).val();
        // var degree = $("#degree").val();
        var degree = $("#courses").val();
        var course = $("#branches").val();
        var dataString = "course=" + course + "&degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/get_batches/'; ?>",
            data: dataString,
            success: function (response) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'admin/get_semester'; ?>",
                    data: {'course': course},
                    success: function (response1) {
                        $("#semesters").html(response1);
                    }
                });
                $("#batches").html(response);
            }
        });
    });
    $("#degree").change(function () {
        var degree = $(this).val();

        var dataString = "degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/get_cource/'; ?>",
            data: dataString,
            success: function (response) {
                if (degree == "All")
                {
                    $("#batch").val($("#batch option:eq(1)").val());
                    $("#course").val($("#course option:eq(1)").val());
                    $("#semester").val($("#semester option:eq(1)").val());
                    //  $("#course")..val($("#semester option:second").val());
                    // $("#semester").prepend(response);
                    // $('#semester option:selected').text();


                } else {


                    $("#course").html(response);
                }
            }

        });

    });

    $("#course").change(function () {
        var course = $(this).val();
        var degree = $("#degree").val();
        var dataString = "course=" + course + "&degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/get_batchs/'; ?>",
            data: dataString,
            success: function (response) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'admin/get_semesterall/'; ?>",
                    data: {'course': course},
                    success: function (response1) {
                        $("#semester").html(response1);
                        $("#semester").val($("#semester option:eq(1)").val());
                    }
                });
                $("#semester").val($("#semester option:eq(1)").val());
                $("#batch").html(response);
            }
        });
    });



    function get_student2(batch, semester = '') {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/batchwisestudent/',
            type: 'POST',
            data: {'batch': batch},
            success: function (content) {
                $("#student").html(content);
            }
        });
    }

    function get_students2(sem)
    {
        var batch = $("#batch").val();
        var course = $("#course").val();
        var degree = $("#degree").val();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/semwisestudent/',
            type: 'POST',
            data: {'batch': batch, 'sem': sem, 'course': course, 'degree': degree},
            success: function (content) {
                //alert(content);
                $("#student").html(content);
            }
        });


    }
    
    $().ready(function () {
        $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });


        $("#frmsurvey").validate({
            rules: {
                question: "required",
                description: "required",
                status: "required"
            },
            messages: {
                question: "Enter question",
                description: "Enter description",
                status: "Select status"
            },
        });

        $("#dateofsubmission").datepicker({
            format: 'MM d, yyyy',
            
            startDate: new Date(),
            autoclose: true,
        });
        jQuery.validator.addMethod("character", function (value, element) {
            return this.optional(element) || /^[A-z]+$/.test(value);
        }, 'Please enter a valid character.');

        jQuery.validator.addMethod("url", function (value, element) {
            return this.optional(element) || /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/.test(value);
        }, 'Please enter a valid URL.');

        $("#frmparticipate").validate({
            rules: {
                degree: "required",
                course: "required",
                batch: "required",
                semester: "required",
                dateofsubmission: "required",
                title:
                        {
                            required: true,
                        },
            },
            messages: {
                degree: "Select department",
                course: "Select branch",
                batch: "Select batch",
                semester: "Select semester",
                dateofsubmission: "Select date of submission",
                title:
                        {
                            required: "Enter title",
                        },
            },
        });
    });

    $(document).ready(function () {
        $('#data-tabless').DataTable({"language": { "emptyTable": "No data available" }});
        $('#survey-table').DataTable({"language": { "emptyTable": "No data available" }});

        $('#data-tables-activity').DataTable({"language": { "emptyTable": "No data available" }});
        $('#uploaded-table').DataTable({"language": { "emptyTable": "No data available" }});
    });


</script>
