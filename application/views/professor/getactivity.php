
                                    <table class="table table-striped table-bordered table-responsive" id="data-tables">
                                        <thead>
                                            <tr>
                                                <th>No</th>											
                                                <th>Student Name</th>	
                                                <th>Participate Title</th>
                                                <th>Comment</th>
                                                <th>Course</th>											
                                                <th>Branch</th>
                                                <th>Batch</th>

                                                <th>Semester</th>											
                                                <th>Participate Status</th>											
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
                                                <td><a href="<?php echo base_url(); ?>index.php?admin/confirmparticipate/<?php echo $rows['participate_student_id']; ?>" class="btn btn-info">Disapprove</a></td>	                                                    

                                                </tr>
<?php endforeach; ?>						
                                        </tbody>
                                    </table>
                                

<script type="text/javascript">
	$(document).ready(function() {
		"use strict";				
		$('#data-tables').dataTable({"language": { "emptyTable": "No data available" }});
	} );
        $(document).ready(function() {
		"use strict";				
		$('#data-tabless').dataTable({"language": { "emptyTable": "No data available" }});
	} );
</script>
            