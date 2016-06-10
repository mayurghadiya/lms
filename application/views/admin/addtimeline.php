<?php
$degree = $this->db->get('degree')->result_array();
$courses = $this->db->get('course')->result_array();
$semesters = $this->db->get('semester')->result_array();
?>
<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">          
            <div class="panel-body"> 
                <div class="box-content">     
                    <div class="">
                        <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?></span> 
                    </div>                                    
                    <?php echo form_open(base_url() . 'admin/time_line/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'timelinefrm', 'target' => '_top')); ?>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><?php echo ucwords("Timeline Title"); ?><span style="color:red">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="timeline_title" id="timeline_title"/>
                            </div>
                        </div>	
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><?php echo ucwords("Timeline Year"); ?><span style="color:red">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="timeline_year" id="timeline_year"/>
                            </div>
                        </div>	
                         <div class="form-group">
                            <label class="col-sm-4 control-label"><?php echo ucwords("Timeline Description"); ?><span style="color:red">*</span></label>
                            <div class="col-sm-8">
                                <textarea name="timeline_desc" class="form-control"></textarea>
                            </div>
                            <lable class="error" id="error_lable_exist" style="color:#f85d2c"></lable>
                        </div>	
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><?php echo ucwords("timeline status"); ?></label>
                            <div class="col-sm-8">
                                <select name="timeline_status"  class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>		
                                </select>	
                            </div>	
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-info vd_bg-green" ><?php echo ucwords("add timeline"); ?></button>
                            </div>
                        </div>
                        </form>               
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $.validator.setDefaults({
        submitHandler: function (form) {
            form.submit();
        }
    });


    $().ready(function () {

        $("#timelinefrm").validate({
            rules: {
                timeline_title:"required",                        
                timeline_desc: "required",
                timeline_year:{
                    required:true,
                    number:true,
                },
                timeline_status: "required",
            },
            messages: {
                  timeline_title:"Enter Title",                        
                timeline_desc: "Enter Description",
                timeline_year: {
                     required:"Enter Year",
                    number:"Enter Only Numeric value",
                },
                timeline_status: "Select Status",
            }
        });
    });
</script>