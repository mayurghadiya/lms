
    <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="data-tables">
        <thead>
            <tr>
                <th><div>#</div></th>												
                <th><div>Library Name</div></th>
                <th><div>Course</div></th>
                <th><div>Branch</div></th>												
                <th><div>Batch</div></th>												
                <th><div>Semester</div></th>												
                <th><div>File</div></th>              
                <th><div>Action</div></th>											
            </tr>
        </thead>
        <tbody>
            <?php $count = 1;
            foreach ($library as $row):
                ?>
                <tr>
                    <td><?php echo $count++; ?></td>	
                    <td><?php echo $row->lm_title; ?></td>	
                      <td><?php
                      if($row->lm_degree!='All')
                      {
                      foreach($degree as $dgr): 
                        if($dgr->d_id==$row->lm_degree):
                            echo $dgr->d_name;
                        endif;
                        endforeach;
                      }else{
                          echo 'All';
                      }
                    ?></td>
                    <td>
                        <?php
                        if($row->lm_course!='All')
                        {
                        foreach ($course as $crs) {
                            if ($crs->course_id == $row->lm_course) {
                                echo $crs->c_name;
                            }
                        }
                        }else{
                            echo 'All';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($row->lm_batch!='All')
                        {
                        foreach ($batch as $bch) {
                            if ($bch->b_id == $row->lm_batch) {
                                echo $bch->b_name;
                            }
                        }
                        }else{
                            echo "All";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($row->lm_semester!='All')
                        {
                        foreach ($semester as $sem) {
                            if ($sem->s_id == $row->lm_semester) {
                                echo $sem->s_name;
                            }
                        }
                        }else{
                            echo "All";
                        }
                        ?>													
                    </td>	
                    <td><a href="<?php echo $row->lm_url; ?>" download="" target="_blank" title="<?php echo $row->lm_filename; ?>"><i class="fa fa-download"></i></a></td>	
                    <td><?php echo date('F d, Y', strtotime($row->lm_dos)); ?></td>	

                    <td class="menu-action">
                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_library/<?php echo $row->lm_id; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6">Edit</span></a>

                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/library/delete/<?php echo $row->lm_id; ?>');" title="Remove" data-toggle="tooltip" data-placement="top" ><span class="label label-danger mr6 mb6">Delete</span></a>	
                    </td>	
                </tr>
    <?php endforeach; ?>						
        </tbody>
    </table>
<script type="text/javascript">
	$(document).ready(function() {
		"use strict";				
		$('#data-tables').dataTable();
	} );
        $(document).ready(function() {
		"use strict";				
		$('#data-tabless').dataTable();
	} );
</script>