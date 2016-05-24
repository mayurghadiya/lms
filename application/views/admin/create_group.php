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
            <div class="vd_content-section clearfix">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="">
                            <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?></span> 
                        </div>  
                        <?php echo form_open(base_url() . 'admin/create_group/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'id' => 'create_group')); ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ucwords("Group Name"); ?><span style="color:red">*</span></label>
                            <div class="col-sm-5 controls">
                                <input type="text" placeholder="Group Name" name="group_name" >
                                <span class="help-inline"></span> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Type of Users<span style="color:red">*</span></label>
                            <div class="col-sm-5 controls">
                                <select id="user_type" onchange="return get_user(this.value)" name="user_type"  >
                                    <option value="">Select User Type</option>
                                    <option value="admin">Admin</option>
                                    <option value="student">Student</option>
                                    <option value="professor">Professor</option>
                                </select>
                                <div id="test"></div>
                            </div>
                        </div>	
                        <div id="divfilter" hidden>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo ucwords("department"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-5">
                                    <select name="degree" id="degree" >
                                        <option value="">Select department</option>
                                        <?php
                                        $datadegree = $this->db->get_where('degree', array('d_status' => 1))->result();
                                        foreach ($datadegree as $rowdegree) {
                                            ?>
                                            <option value="<?= $rowdegree->d_id ?>"><?= $rowdegree->d_name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>	
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo ucwords("Branch"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-5">
                                    <select name="course" id="course" >
                                        <option value="">Select Branch</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo ucwords("Batch"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-5">
                                    <select name="batch" id="batch" onchange="get_student2(this.value);" >
                                        <option value="">Select batch</option>

                                    </select>
                                </div>
                            </div>	
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo ucwords("Semester"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-5">
                                    <select name="semester" id="semester"  onchange="get_students2(this.value);" >
                                        <option value="">Select semester</option>
                                        <?php
                                        $datasem = $this->db->get_where('semester', array('s_status' => 1))->result();
                                        foreach ($datasem as $rowsem) {
                                            ?>
                                            <option value="<?= $rowsem->s_id ?>"><?= $rowsem->s_name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <select name="from[]" id="multiselect" class="form-control" size="8" multiple="multiple">
                                </select>
                            </div>

                            <div class="col-sm-2">
                                    <!--<button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>-->
                                <div>&nbsp;</div>
                                <div>&nbsp;</div>
                                <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                <!--<button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>-->
                            </div>

                            <div class="col-sm-5">
                                <select name="user_role[]" id="multiselect_to" class="form-control" size="8" multiple="multiple" ></select>
                            </div>
                        </div>
                        <!-- col-sm-9-->
                        <div class="col-sm-3">                
                            <div class="mgbt-xs-5">
                                <button class="btn vd_btn vd_bg-green " type="submit"><?php echo ucwords("Create"); ?></button>
                            </div>
                        </div>
                    </div>		
                    </form>
                </div>
            </div>
        </div>


    </div>

    <!-- row --> 

</div>

<!-- End .row -->
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->

<script type="text/javascript">
    
    $().ready(function() {
		
		// validate create_group form on keyup and submit
		$("#create_group").validate({
			rules: {
				group_name: "required",				
				user_type: "required",				
                                'user_role[]': "required",
                                degree: "required",
                                course: "required",
                                batch: "required",
                                semester: "required",
			},
			messages: {
				group_name: "Enter group name",				
				user_type: "Select user type",
				'user_role[]': "Select user",	
                                degree: "Select department",
                                course: "Select branch",
                                batch: "Select batch",
                                semester: "Select semester",
			}
		});
		});
                
    $(document).ready(function () {
        $("#degree").change(function () {
            var degree = $(this).val();
            var dataString = "degree=" + degree;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'admin/get_cource/project'; ?>",
                data: dataString,
                success: function (response) {
                    $("#course").html(response);
                }
            });
        });

        $("#course").change(function () {
            var course = $(this).val();
            var degree = $("#degree").val();
            var dataString = "course=" + course + "&degree=" + degree;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'admin/get_batchs/project'; ?>",
                data: dataString,
                success: function (response) {
                    $("#batch").html(response);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() . 'admin/get_semester'; ?>",
                        data: dataString,
                        success: function (response1) {
                            $("#semester").html(response1);
                        }
                    });
                }
            });
        });

    });

    function get_students2(sem)
    {
        var batch = $("#batch").val();
        var course = $("#course").val();
        var degree = $("#degree").val();
        var semester = $("#semester").val();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_group_student/',
            type: 'POST',
            data: {'batch': batch, 'sem': sem, 'course': course, 'degree': degree},
            success: function (content) {
                $("#multiselect").html(content);
            }
        });
    }
    function get_user(type)
    {
        if (type == 'student')
        {
            $("#divfilter").show();
            $("#multiselect").html("");
        } else if(type=='professor')
        {
            $("#divfilter").hide();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/get_group_professor/',
                type: 'POST',
                //data: {'batch': batch, 'sem': sem, 'course': course, 'degree': degree},
                success: function (content) {
                    $("#multiselect").html(content);
                }
            });
        }
        else if(type=='admin')
        {
            $("#divfilter").hide();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/get_group_admin/',
                type: 'POST',
                //data: {'batch': batch, 'sem': sem, 'course': course, 'degree': degree},
                success: function (content) {
                    $("#multiselect").html(content);
                }
            });
        }
    }

</script>



