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
                        <?php echo form_open(base_url() . 'admin/list_group/do_update', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'id' => 'list_group')); ?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><?php echo ucwords("Group"); ?><span style="color:red">*</span></label>
                            <div class="col-sm-6 controls">
                                
                              <select class="form-control select2"  onchange="return get_group_ajax(this.value)" name="group_name" id="group_name" >
                                    <option value="">Select Group Name</option>
                                    <?php
                                    $group = $this->db->get('group')->result_array();
                                    foreach ($group as $row):
                                        ?>
                                        <option value="<?php echo $row['g_id']; ?>"><?php echo $row['group_name']; ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><?php echo ucwords("Type of Users"); ?><span style="color:red">*</span></label>
                            <div class="col-sm-6 controls">
                                <select id="user_type" name="user_type" class="form-control select2" >
                                    <option value="">Select User Type</option>
                                </select>
                                <div id="test"></div>
                                <label for="user_type" class="error"></label>
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
                                <select name="user_role[]" id="multiselect_to" class="form-control group_listing" size="8" multiple="multiple" ></select>
                            </div>
                        </div>
                            
                        
                        <!-- col-sm-9-->
                        <div class="col-sm-3">
                            <div class="mgbt-xs-5">
                                <button class="btn vd_btn vd_bg-green " type="submit"><?php echo ucwords("Update"); ?></button>

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
		$("#list_group").validate({
			rules: {
				group_name: "required",				
				user_type: "required",	
				'user_role[]':"required", 
			},
			messages: {
				group_name: "Please enter group name",				
				user_type: "Please select user type",
				'user_role[]': "Please select user",			
			}
		});
		});
    
    $(function () {
        // bind change event to select
        $('#dropclass').on('change', function () {
            // var url = $(this).val(); // get selected value
            var classId = $(this).val();
            if (classId) { // require a URL
                window.location = "<?php echo base_url('/index.php?admin/group/'); ?>/" + classId;
            }
            return false;
        });
    });
    function get_user(user_id) {
        $("#test").append('<input type="hidden" name="user_type" value="' + user_id + '">');
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_user/' + user_id,
            success: function (response)
            {
                //jQuery('#multiselect').html(response);
            }
        });
    }
    function get_group_ajax(group_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_group_ajax/' + group_id,
            success: function (response)
            {
                var json = jQuery.parseJSON(response);
                jQuery('.group_listing').html(json.group);
                jQuery('#user_type').html(json.user_type);
                jQuery('#multiselect').html(json.full_user_list);
            }
        });
    }
</script>