                           <div class="panel-body table-responsive" id="getresponse">
                                        <table class="table table-striped" id="data-tabless">
                                            <thead>
                                                <tr>
                                                    <th>No</th>                                           
                                                    <th>Student Name</th>       
                                                    <th>Department</th>
                                                    <th>Branch</th>
                                                    <th>Batch</th>											
                                                    <th>Semester</th>	
                                                    <th>Question</th>  
                                                    <th>Status</th>                               
                                                    <th>Action</th>

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

                                                        <td>
                                                            <?php $question = explode(",", $row->sq_id); ?><?php
                                                            //echo $row->survey_status;
                                                            $queid = $question[0];
                                                            //echo 'dss'.$queid;
                                                            $question1 = $this->crud_model->getquestion('survey_question', $queid);
                                                            echo $question1;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php $status = explode(",", $row->survey_status); ?><?php
                                                            $s1 = $status[0];
                                                            if ($s1 == "1") {
                                                                echo "Yes";
                                                            } elseif ($s1 == "0") {
                                                                echo "No";
                                                            } elseif ($s1 == "2") {
                                                                echo "No Opinion";
                                                            }

                                                            //echo $row->survey_status;
                                                            //$queid = $question[0];
                                                            //echo 'dss'.$queid;
                                                            ?></td>

                                                        <td class="menu-action">
                                                            <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_survey_detal/<?php echo $row->survey_id; ?>');" data-original-title="View Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-yellow vd_yellow"><i class="fa fa-file-o"></i></a>
                                                        </td>  
                                                    </tr>
                                                <?php endforeach; ?>                        
                                            </tbody>
                                        </table>
                                    </div>
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
            