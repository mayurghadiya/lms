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
                            <label class="col-sm-4 control-label">Group Name</label>
                            <div class="col-sm-7 controls">
                                <select name="group_name" class="form-control" onchange="return get_module_ajax(this.value)">
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
                                <button class="btn vd_btn vd_bg-green " type="submit">Update Module</button>
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

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 

<script type="text/javascript">
   
    function get_module_ajax(group_id) {
           
       var type_array = group_id;
        var type=type_array.split(',');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_module_ajax',
            type:'post',
            dataType:'json',
            data:
            {
                'type': type[1],
                'id':type[0],
            }, 
            success: function (response)
           {
//                var json = $.parseJSON(response);
//                //alert(json.assigned_module_list);
                jQuery('#multiselect').html(response.full_module_list);
                jQuery('#multiselect_to').html(response.assigned_module_list);
            }
        });
    }
</script>