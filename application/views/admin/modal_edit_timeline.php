<?php
$edit_data = $this->db->get_where('timeline', array('timeline_id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>
    <div class=row>                      
        <div class=col-lg-12>
            <!-- col-lg-12 start here -->
            <div class="panel panel-default toggle panelMove panelClose panelRefresh">
                <!-- Start .panel -->
<!--                <div class=panel-heading>
                    <h4 class=panel-title>  <?php echo ucwords("Update Timeline"); ?></h4>                
                </div>-->
                <div class="panel-body">
                    <div class="tab-pane box" id="add" style="padding: 5px">
                        <div class="box-content">  
                            <div class="">
                                <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?></span> 
                            </div>
                            <?php echo form_open(base_url() . 'admin/time_line/do_update/' . $row['timeline_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'id' => 'frmeditclass', 'target' => '_top')); ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo ucwords("Timeline Title"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="timeline_title" id="timeline_title" value="<?php echo $row['timeline_title']; ?>"   />
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ucwords("Timeline Year"); ?><span style="color:red">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="timeline_year" id="timeline_year"  value="<?php echo $row['timeline_year']; ?>"  />
                            </div>
                        </div>	
                            <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ucwords("Timeline Description"); ?><span style="color:red">*</span></label>
                            <div class="col-sm-5">
                                <textarea name="timeline_desc" class="form-control"><?php echo $row['timeline_desc']; ?></textarea>
                            </div>
                            <lable class="error" id="error_lable_exist" style="color:#f85d2c"></lable>
                        </div>
                            <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ucwords("timeline status"); ?></label>
                            <div class="col-sm-5">
                                <select name="timeline_status"  class="form-control">
                                    <option value="1" <?php if($row['timeline_status']=='1'){ echo "selected=selected"; } ?>>Active</option>
                                    <option value="0"  <?php if($row['timeline_status']=='0'){ echo "selected=selected"; } ?>>Inactive</option>		
                                </select>	
                            </div>	
                        </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" class="submit btn btn-info vd_bg-green"><?php echo ucwords("update"); ?></button>
                                </div>
                            </div>
                            
                            </form>
                        </div> </div> </div>
            </div>
        </div>
    </div>

    <?php
endforeach;
?>
<script type="text/javascript">
    $.validator.setDefaults({
        submitHandler: function (form) {
            form.submit();
        }
    });

    $().ready(function () {
        $("#frmeditclass").validate({
            rules: {
                timeline_title: "required",
                timeline_year: "required",
                timeline_desc: "required",
                timeline_status: "required",
            },
            messages: {
                
                timeline_title: "Enter Title",
                timeline_year: "Enter Year",
                timeline_desc: "Enter Description",
                timeline_status: "Select Status",
            }
        });
    });
</script>

