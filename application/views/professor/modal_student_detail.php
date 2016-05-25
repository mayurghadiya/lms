<?php
if (count($student))
    $degree = $this->db->get_where("degree", array("d_id" => $student[0]->std_degree))->result();
$course = $this->db->get_where("course", array("course_id" => $student[0]->course_id))->result();
$batch = $this->db->get_where("batch", array("b_id" => $student[0]->std_batch))->result();
$semester = $this->db->get_where("semester", array("s_id" => $student[0]->semester_id))->result();
?>
<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <div class=panel-heading>
                <h4 class=panel-title>Student Details</h4>
            </div>
            <div class=panel-body>
                <table class="table table-striped" id="data-tables">
                    
                    <tbody>
                        <tr>
                            <td><strong>Image</strong></td>
                            <td><?php if ($student[0]->profile_photo != "") { ?> 
                    <img src="<?php echo base_url() . 'uploads/student_image/' . $student[0]->profile_photo; ?>" height="100" width="100" />
                <?php } else { ?>
                    <img src="<?= base_url() ?>/uploads/no-image.jpg" height="100px" width="100px"/>
                <?php } ?></td>
                        </tr>

                        <tr>		
                            <th>Student Name</th> <td><?php echo $student[0]->std_first_name . ' ' . $student[0]->std_last_name; ?></td>						
                        </tr>
                        <tr>		
                            <th>Degree </th><td><?php echo $degree[0]->d_name; ?></td>
                        </tr>
                        <tr>
                            <th>Course </th>  <td><?php echo $course[0]->c_name; ?></td>
                        </tr>
                        <tr>
                            <th>Batch </th> <td><?php echo $batch[0]->b_name; ?></td>
                        </tr>
                        <tr>
                            <th>Semester </th>  <td><?php echo $semester[0]->s_name; ?></td>                  			
                        </tr>
                        <tr>
                            <th>Roll No </th>  <td><?php echo $student[0]->std_roll; ?></td>                  			
                        </tr>
                        <tr>
                            <th>Email </th>  <td><?php echo $student[0]->email; ?></td>                  			
                        </tr>

                        <tr>
                            <th>Gender </th>  <td><?php echo $student[0]->std_gender; ?></td>                  			
                        </tr>
                        <tr>
                            <th>Mobile No </th>  <td><?php echo $student[0]->std_mobile; ?></td>                  			
                        </tr>
                        <tr>
                            <th>Student Birthdate </th>  <td><?php echo date_formats($student[0]->std_birthdate); ?></td>                  			
                        </tr>



                    </tbody>
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