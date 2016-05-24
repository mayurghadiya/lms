<div class="vd_content-wrapper">
    <div class="vd_container">
        <div class="vd_content clearfix">
            <div class="vd_title-section clearfix">
                <div class="vd_panel-header no-subtitle">
                    <h1>Assign User</h1>
                </div>
            </div>
            <div class="vd_content-section clearfix">
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo form_open(base_url() . 'index.php?admin/assign_module/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'id' => 'assign_module')); ?>						
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Group Name</label>
                            <div class="col-sm-7 controls">
                                <select name="group_name" id="group_name" class="form-control" style="width:100%;" >
                                    <option value="">Select Group Name</option>
                                    <?php
                                    $group_query = $this->db->get('group')->result_array();
                                    foreach ($group_query as $group_row):
                                        ?>
                                        <option value="<?php echo $group_row['g_id']; ?>,<?php echo $group_row['user_type']; ?>"><?php echo $group_row['group_name']; ?></option>
                                        <?php
                                    endforeach;
                                    ?>	
                                </select>
                            </div>
                        </div>	
                        <div class="row">
                            <div class="col-sm-5">
                                <select class="form-control" style="width:100%;" size="8" multiple="multiple" id="multiselect">
                                    <option value="">Existing Modules</option>
<!--                                        <?php
                                        $modules_query = $this->db->get('modules')->result_array();
                                        foreach ($modules_query as $modules_row):
                                            ?>
                                            <option value="<?php echo $modules_row['module_id']; ?>"><?php echo $modules_row['module_name']; ?></option>
                                            <?php
                                        endforeach;
                                        ?>	-->
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
                                <select name="module_name[]" id="multiselect_to" class="form-control" size="8" multiple="multiple"></select>
                            </div>
                        </div>	
                        <!-- col-sm-9-->
                        <div class="col-sm-3">                
                            <div class="mgbt-xs-5">
                                <button class="btn vd_btn vd_bg-green " type="submit">Assign Module</button>
                            </div>
                        </div>
                    </div>	
                    </form>
                </div>
            </div></div>


    </div>

    <!-- row --> 

</div>

<!-- End .row -->
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 

<script type="text/javascript">
    $("#group_name").change(function(){
        
       var type_array=$(this).val();
        var type=type_array.split(',');
       
       $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_module',
            type:'post',
            dataType:'json',
            data:
            {
                'type': type[1],
            },    
            success: function (response)
            {
                var option;
                for(var i=0;i<response.length;i++)
                {
                    option +="<option value="+response[i].module_id+">"+response[i].module_name+"</option>";
                }
                $("#multiselect").html(option);
            }
        });
    });
//    $(function () {
//        // bind change event to select
//        $('#dropclass').on('change', function () {
//            // var url = $(this).val(); // get selected value
//            var classId = $(this).val();
//            if (classId) { // require a URL
//                window.location = "<?php echo base_url('/index.php?admin/group/'); ?>/" + classId;
//            }
//            return false;
//        });
//    });
//    function get_user(user_id) {
//        $("#test").append('<input type="hidden" name="user_type" value="' + user_id + '">');
//        $.ajax({
//            url: '<?php echo base_url(); ?>index.php?admin/get_user/' + user_id,
//            success: function (response)
//            {
//                //jQuery('#multiselect').html(response);
//            }
//        });
//    }
//    function get_group_ajax(group_id) {
//
//        $.ajax({
//            url: '<?php echo base_url(); ?>index.php?admin/get_group_ajax/' + group_id,
//            success: function (response)
//            {
//                var json = jQuery.parseJSON(response);
//                jQuery('.group_listing').html(json.group);
//                jQuery('#user_type').html(json.user_type);
//                jQuery('#multiselect').html(json.full_user_list);
//            }
//        });
//    }
</script>