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
                        <?php echo form_open(base_url() . 'index.php?admin/list_group/do_update', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'id' => 'list_group')); ?>
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
                                <select id="user_type" name="user_type" class="select2" style="width:100%;" >
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
                            
                        
                        
                        <div class="col-lg-12">
                            <div class="bootstrap-duallistbox-container row"> <div class="box1 col-md-6">   <label for="bootstrap-duallistbox-nonselected-list_duallistbox">Non-selected</label>   <span class="info-container">     <span class="info">Showing all 48</span>     <button type="button" class="btn clear1 pull-right btn-default btn-xs">show all</button>   </span>   <input placeholder="Filter" class="filter form-control" type="text">   <div class="btn-group buttons">     <button title="Move all" type="button" class="btn moveall btn-default">       <i class="glyphicon glyphicon-arrow-right"></i>       <i class="glyphicon glyphicon-arrow-right"></i>     </button>     <button title="Move selected" type="button" class="btn move btn-default">       <i class="glyphicon glyphicon-arrow-right"></i>     </button>   </div>   <select style="height: 172px;" name="duallistbox_helper1" class="form-control" id="bootstrap-duallistbox-nonselected-list_duallistbox" multiple="multiple"><option value="AK">Alaska</option><option value="HI">Hawaii</option><option value="CA">California</option><option value="NV">Nevada</option><option value="OR">Oregon</option><option value="WA">Washington</option><option value="AZ">Arizona</option><option value="CO">Colorado</option><option value="ID">Idaho</option><option value="NE">Nebraska</option><option value="NM">New Mexico</option><option value="ND">North Dakota</option><option value="UT">Utah</option><option value="WY">Wyoming</option><option value="AL">Alabama</option><option value="AR">Arkansas</option><option value="IL">Illinois</option><option value="IA">Iowa</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="OK">Oklahoma</option><option value="SD">South Dakota</option><option value="TX">Texas</option><option value="TN">Tennessee</option><option value="WI">Wisconsin</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="IN">Indiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="OH">Ohio</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WV">West Virginia</option></select> </div> <div class="box2 col-md-6">   <label for="bootstrap-duallistbox-selected-list_duallistbox">Selected</label>   <span class="info-container">     <span class="info">Showing all 2</span>     <button type="button" class="btn clear2 pull-right btn-default btn-xs">show all</button>   </span>   <input placeholder="Filter" class="filter form-control" type="text">   <div class="btn-group buttons">     <button title="Remove selected" type="button" class="btn remove btn-default">       <i class="glyphicon glyphicon-arrow-left"></i>     </button>     <button title="Remove all" type="button" class="btn removeall btn-default">       <i class="glyphicon glyphicon-arrow-left"></i>       <i class="glyphicon glyphicon-arrow-left"></i>     </button>   </div>   <select style="height: 172px;" name="duallistbox_helper2" class="form-control" id="bootstrap-duallistbox-selected-list_duallistbox" multiple="multiple"><option value="MT" selected="">Montana</option><option value="KS" selected="">Kansas</option></select> </div></div><select style="display: none" multiple="multiple" size="10" name="duallistbox" class="duallistbox">
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV">Nevada</option>
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                    <option value="ID">Idaho</option>
                                    <option value="MT" selected="">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="UT">Utah</option>
                                    <option value="WY">Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value="AL">Alabama</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS" selected="">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TX">Texas</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="WI">Wisconsin</option>
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="IN">Indiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="OH">Ohio</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WV">West Virginia</option>
                                </optgroup>
                            </select>
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
            url: '<?php echo base_url(); ?>index.php?admin/get_group_ajax/' + group_id,
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