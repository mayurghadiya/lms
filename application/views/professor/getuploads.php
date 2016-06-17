<div class="panel-body table-responsive" id="upd_getsubmit">
                                    <table class="table table-striped" id="data-tablesupd">
                                        <thead>
                                            <tr>
                                                <th>No</th>											
                                                <th>Student Name</th>	                                               
                                                <th>Department</th>											
                                                <th>Branch</th>
                                                <th>Batch</th>

                                                <th>Semester</th>											
                                                <th>Download</th>											                                                

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

                                                $user1 = $this->db->get_where('student', array('std_id' => $std_id))->result_array();
                                                ?>
                                                <tr>
                                                    <td><?php echo $countsu++; ?></td>	
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
                                                    <td><a href="<?php echo $rowsupl['upload_url']; ?>" download=""><i class="fa fa-download" title="<?php echo $rowsupl['upload_file_name']; ?>"></i></a></td>	

                                                </tr>
<?php endforeach; ?>						
                                        </tbody>
                                    </table>
                                </div>

<script type="text/javascript">	
        $(document).ready(function() {
		"use strict";				
		$('#data-tablesupd').dataTable({"language": { "emptyTable": "No data available" }});
	} );
</script>
            