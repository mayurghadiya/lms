<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <div class=panel-body>
                <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addstudyresource');" data-toggle="modal"><i class="fa fa-plus"></i> Study Resource</a>
                <div class="row filter-row">
                <form action="#" method="post" id="searchform">
                    <div class="form-group col-sm-3 validating">
                        <label>Department</label>
                        <select id="courses" name="degree" class="form-control">
                            <option value="">Select department</option>
                            <option value="All">All</option>

                            <?php foreach ($degree as $row) { ?>
                                <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-3 validating">
                        <label>Branch</label>
                        <select id="branches" name="course" class="form-control">
                            <option value="">Select Branch</option>
                            <option value="All">All</option>

                        </select>
                    </div>
                    <div class="form-group col-sm-3 validating">
                        <label>Batch</label>
                        <select id="batches" name="batch" class="form-control">
                            <option value="">Select Batch</option>
                            <option value="All">All</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-2 validating">
                        <label>Select Semester</label>
                        <select id="semesters" name="semester" class="form-control">
                            <option value="">Select Semester</option>
                            <option value="All">All</option>

                            <?php foreach ($semester as $row) { ?>
                                <option value="<?php echo $row->s_id; ?>"
                                        ><?php echo $row->s_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-1">
                        <label>&nbsp;</label><br/>
                        <button type="submit" id="btnsubmit" class="submit btn btn-info vd_bg-green">Go</button>
                    </div>

                </form>
                </div>
                <div id="getresponse">
                        
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>											
                            <th>Title</th>											
                            <th>Department</th>
                            <th>Branch</th>
                            <th>Batch</th>											
                            <th>Semester</th>											                                                                                               
                            <th>File</th>											
                            <th>Action</th>											
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($studyresource as $row):
                            ?>
                            <tr>
                                <td></td>	
                                <td><?php echo $row->study_title; ?></td>	
                                <td>
                                    <?php
                                    if ($row->study_degree != "All") {
                                        foreach ($degree as $deg) {
                                            if ($deg->d_id == $row->study_degree) {
                                                echo $deg->d_name;
                                            }
                                        }
                                    } else {
                                        echo "All";
                                    }
                                    ?>
                                </td>	
                                <td>
                                    <?php
                                    if ($row->study_course != "All") {
                                        foreach ($course as $crs) {
                                            if ($crs->course_id == $row->study_course) {
                                                echo $crs->c_name;
                                            }
                                        }
                                    } else {
                                        echo "All";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($row->study_batch != "All") {
                                        foreach ($batch as $bch) {
                                            if ($bch->b_id == $row->study_batch) {
                                                echo $bch->b_name;
                                            }
                                        }
                                    } else {
                                        echo "All";
                                    }
                                    ?>
                                </td>	
                                <td>
                                    <?php
                                    if ($row->study_sem != "All") {
                                        foreach ($semester as $sem) {
                                            if ($sem->s_id == $row->study_sem) {
                                                echo $sem->s_name;
                                            }
                                        }
                                    } else {
                                        echo "All";
                                    }
                                    ?>

                                </td>	
                                <td id="downloadedfile"><a href="<?php echo base_url().'uploads/project_file/'.$row->study_filename; ?>" download=""  title="<?php echo $row->study_filename; ?>"><i class="fa fa-download"></i></a></td>	
                                <td class="menu-action">
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_studyresource/<?php echo $row->study_id; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>
                                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/studyresource/delete/<?php echo $row->study_id; ?>');" data-original-title="delete" data-toggle="tooltip" data-placement="top" ><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>																			
                    </tbody>
                </table>
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

 <script type="text/javascript">
         $(document).ready(function () {
    
        $("#searchform #btnsubmit").click(function(){           
           var degree =  $("#courses").val();
           var course =  $("#branches").val();
           var batch =  $("#batches").val();
            var semester = $("#semesters").val();
            $.ajax({
                type:"POST",
                url:"<?php echo base_url(); ?>admin/getstudyresource/",
                data:{'degree':degree,'course':course,'batch':batch,"semester":semester},
                success:function(response)
                {
                    $("#getresponse").html(response);
                }
                
                
            });
             return false;
         });
         $("#courses").change(function(){
                var degree = $(this).val();
                
                var dataString = "degree="+degree;
                $.ajax({
                    type:"POST",
                    url:"<?php echo base_url().'admin/course_filter/'; ?>",
                    data:dataString,                   
                    success:function(response){
                        if(degree=='All')
                        {
                            $("#branches").html(response);
                             $("#batches").val($("#batches option:eq(1)").val());
                             $("#branches").val($("#branches option:eq(1)").val());
                             $("#semesters").val($("#semesters option:eq(1)").val());
                            
                        }
                        else{
                              $('#branches').html('');
                            var opt="<option value=''>Select branch</option>";
                             opt +="<option value='All'>All</option>";
                            $("#branches").append(opt);
                            $("#branches").append(response);
                        }
                    }
                });
        });
        $("#batches").change(function(){
            var batches = $("#batches").val();
            if(batches=='All')
            {
                $("#semesters").val($("#semesters option:eq(1)").val());
            }
        });
         $("#branches").change(function(){
                //var course = $(this).val();
                // var degree = $("#degree").val();
                var degree = $("#courses").val();
                var course = $("#branches").val();
                var dataString = "course="+course+"&degree="+degree;
                $.ajax({
                    type:"POST",
                    url:"<?php echo base_url().'admin/batch_filter/'; ?>",
                    data:dataString,                   
                    success:function(response){
                         if(course=='All')
                        {
                             $("#batches").html(response);
                             $("#batches").val($("#batches option:eq(1)").val());                            
                             $("#semesters").val($("#semesters option:eq(1)").val());
                           
                        }
                        else{
                           $('#batches').html('');
                            var opt="<option value=''>Select batch</option>";
                             opt +="<option value='All'>All</option>";
                            $("#batches").append(opt);
                            $("#batches").append(response);
                        }
                        
                    }
                });
        });
        });
        $(document).ready(function () {
            $('#studyresource-tables').dataTable();

        });
    </script>