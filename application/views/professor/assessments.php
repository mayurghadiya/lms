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
                  <div class="tabs mb20">
                    <ul id="import-tab" class="nav nav-tabs">
                        <li class="active">
                            <a href="#list" data-toggle="tab" aria-expanded="true"><?php echo ucwords("Assessment List"); ?></a>
                        </li>
                        <li class="">
                            <a href="#submittedlist" data-toggle="tab" aria-expanded="false"><?php echo ucwords("submitted assignment list"); ?></a>
                        </li>
                    </ul>
                    <div id="import-tab-content" class="tab-content">

                        <div class="tab-pane fade active in" id="list">                  
                         <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>#</th>		
                             <th>Assignment</th>
                            <th>Student</th>                           
                            <th>Assign. File</th>
                            <th>Submitted File</th>
                            <th>Department</th>
                            <th>Branch</th>												
                            <th>Batch</th>												
                            <th>Semester</th>
                            <th>Instruction</th>
                            <th>Feedback</th>                                                
                            <th>Grade</th>	
                        </tr>
                    </thead>

                    <tbody>
                        <?php                       
                        $count = 1;
                        foreach ($assessment->result_array() as $row):
                            
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>	
                                 <td><?php echo $row['assign_title']; ?></td>   
                                <td><?php echo $row['name']; ?></td>                               
                                <td id="downloadedfile"><a href="<?php echo $row['assign_url']; ?>" download="" title="<?php echo $row['assign_title']; ?>"><i class="fa fa-download"></i></a></td>	
                                <td id="downloadedfile"><a href="<?php echo base_url().'uploads/project_file/'.$row['document_file']; ?>" download=""><i class="fa fa-download"></i></a></td>	
                                <td><?php
                                    foreach ($degree as $dgr):
                                        if ($dgr->d_id == $row['std_degree']):

                                            echo $dgr->d_name;
                                        endif;


                                    endforeach;
                                    ?></td>
                                <td>
                                    <?php
                                    foreach ($course as $crs) {
                                        if ($crs->course_id == $row['course_id']) {
                                            echo $crs->c_name;
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach ($batch as $bch) {
                                        if ($bch->b_id == $row['std_batch']) {
                                            echo $bch->b_name;
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach ($semester as $sem) {
                                        if ($sem->s_id == $row['semester_id']) {
                                            echo $sem->s_name;
                                        }
                                    }
                                    ?>													
                                </td>
                                <td><?php echo $row['assignment_instruction']; ?></td>	
                                <td><?php echo wordwrap($row['feedback'], 30, "<br>\n"); ?></td>                                                   
                                <td><?php echo $row['grade']; ?></td>                                                   
                            </tr>
                        <?php endforeach; ?>																									
                    </tbody>
                </table>
                        </div>
                        <div class="tab-pane fade" id="submittedlist">
                            <div class="row filter-row">
                            <form id="assignment-search-submitted" action="#" class="form-groups-bordered validate">
                                <div class="form-group col-sm-2">
                                    <label><?php echo ucwords("department"); ?></label>
                                    <select class="form-control" id="scourses" name="degree_search">
                                        <option value="">Select</option>
                                        <?php foreach ($degree as $row) { ?>
                                            <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label><?php echo ucwords("Branch"); ?></label>
                                    <select id="sbranches" name="course_search" data-filter="4" class="form-control">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label><?php echo ucwords("Batch"); ?></label>
                                    <select id="sbatches" name="batch_search" data-filter="5" class="form-control">
                                        <option value="">Select</option>
                                    </select>
                                </div>                                
                                <div class="form-group col-sm-2">
                                    <label> <?php echo ucwords("Semester"); ?></label>
                                    <select id="ssemesters" name="semester_search" data-filter="6" class="form-control">
                                        <option value="">Select</option>

                                    </select>
                                </div>
                                <div class="form-group col-sm-2" style="display: none;">
                                    <label><?php echo ucwords("Class"); ?><span style="color:red"></span></label>
                                    <select class="form-control filter-rows" name="divclass" id="sfilterclass" >
                                        <option value="">Select</option>
                                        <?php
                                        $class = $this->db->get('class')->result_array();
                                        foreach ($class as $c) {
                                            ?>
                                            <option value="<?php echo $c['class_id'] ?>"><?php echo $c['class_name'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div> 
                                <div class="form-group col-sm-2">
                                    <label>&nbsp;</label><br/>
                                    <input id="submitted" type="button" value="Go" class="btn btn-info"/>
                                </div>
                            </form>
                            </div>
                            <div class="panel-body table-responsive" id="getsubmit">
                                <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="sub-tables">
                                    <thead>
                                        <tr>
                                            <th><div>#</div></th>												
                                            <th><div><?php echo ucwords("Assignment Name"); ?></div></th>
                                            <th><div><?php echo ucwords("Student Name"); ?></div></th>
                                            <th><div><?php echo ucwords("Department"); ?></div></th>
                                            <th><div><?php echo ucwords("Branch"); ?></div></th>												
                                            <th><div><?php echo ucwords("Batch"); ?></div></th>												
                                            <th><div><?php echo ucwords("Sem"); ?></div></th>	
                                            <th><div><?php echo ucwords("Submitted date"); ?></div></th>	
                                            <th><div><?php echo ucwords("Comment"); ?></div></th>
                                            <th><div><?php echo ucwords("File"); ?></div></th>	
                                            <th><div><?php echo ucwords("Action"); ?></div></th>	
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($submitedassignment->result() as $rowsub):
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $rowsub->assign_title; ?></td>
                                                <td><?php echo $rowsub->name; ?></td>
                                                <td><?php
                                                    foreach ($degree as $dgr):
                                                        if ($dgr->d_id == $rowsub->assign_degree):

                                                            echo $dgr->d_name;
                                                        endif;


                                                    endforeach;
                                                    ?></td>
                                                <td>
                                                    <?php
                                                    foreach ($course as $crs) {
                                                        if ($crs->course_id == $rowsub->course_id) {
                                                            echo $crs->c_name;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($batch as $bch) {
                                                        if ($bch->b_id == $rowsub->assign_batch) {
                                                            echo $bch->b_name;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                <?php
                                                foreach ($semester as $sem) {
                                                    if ($sem->s_id == $rowsub->assign_sem) {
                                                        echo $sem->s_name;
                                                    }
                                                }
                                                ?>													
                                                </td>	
                                                <td><?php echo date_formats($rowsub->submited_date); ?></td>	
                                                <td><?php echo $rowsub->comment; ?></td>
                                                <td id="downloadedfile"><a href="uploads/project_file/<?php echo $rowsub->document_file; ?>" download="" title="<?php echo $rowsub->document_file; ?>"><i class="fa fa-download"></i></a></td>                      	
                                                <td class="menu-action">
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_assessment/<?php echo $rowsub->assignment_submit_id; ?>');" data-toggle="modal"><span class="label label-primary mr6 mb6">Assessment</span></a>
                                                 
                                                </td>	
                                            </tr>
<?php endforeach; ?>						
                                    </tbody>
                                </table>
                            </div>
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

<!-- End #content -->
<script type="text/javascript">
     $(document).ready(function () {
          $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });
            $("#scourses").change(function () {
                var degree = $(this).val();

                var dataString = "degree=" + degree;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'professor/get_course/'; ?>",
                    data: dataString,
                    success: function (response) {
                        $("#sbranches").html(response);
                    }
                });
            });
            $("#sbranches").change(function () {
                //var course = $(this).val();
                // var degree = $("#degree").val();
                var degree = $("#scourses").val();
                var course = $("#sbranches").val();
                var dataString = "course=" + course + "&degree=" + degree;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'professor/get_batches/'; ?>",
                    data: dataString,
                    success: function (response) {
                        $("#sbatches").html(response);

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url() . 'professor/get_semester'; ?>",
                            data: dataString,
                            success: function (response1) {
                                $("#ssemesters").html(response1);
                            }
                        });
                    }
                });
            });
            
            
             var forms = $('#assignment-search-submitted');

            $('#submitted').on('click', function () {
                $("#assignment-search-submitted").validate({
                    rules: {
                        degree_search: "required",
                        course_search: "required",
                        batch_search: "required",
                        semester_search: "required"
                    },
                    messages: {
                        degree_search: "Select department",
                        course_search: "Select branch",
                        batch_search: "Select batch",
                        semester_search: "Select semester"
                    }
                });

                if (forms.valid() == true)
                {

                    var degree = $("#scourses").val();
                    var course = $("#sbranches").val();
                    var batch = $("#sbatches").val();
                    var semester = $("#ssemesters").val();
                    var divclass = $("#sfilterclass").val();
                    $.ajax({
                        url: '<?php echo base_url(); ?>professor/getassignment/submitted',
                        type: 'post',
                        data: {'degree': degree, "course": course, "batch": batch, "semester": semester, 'divclass': divclass},
                        success: function (content) {
                            $("#getsubmit").html(content);
                            // $("#dtbl").hide();

                        }
                    });
                }
            });
            });

</script>