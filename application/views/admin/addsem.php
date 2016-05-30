<?php
$degree = $this->db->get('degree')->result_array();
$courses = $this->db->get('course')->result_array();
$semesters = $this->db->get('semester')->result_array();
?>

<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <!--            <div class=panel-heading>
                            <h4 class=panel-title>  <?php echo ucwords("Add Semester"); ?></h4>                
                        </div>-->
            <div class="panel-body"> 
                <div class="box-content">
                    <div class="">
                        <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?></span> 
                    </div>                                    
                    <?php echo form_open(base_url() . 'admin/semester/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'frmsemester', 'target' => '_top')); ?>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ucwords("Semester Name"); ?><span style="color:red">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="s_name" id="s_name" />
                            </div>
                        </div>												
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ucwords("Status"); ?></label>
                            <div class="col-sm-5">
                                <select name="semester_status" class="form-control">
                                    <option value="1" >Active</option>
                                    <option value="0" >Inactive</option>		
                                </select>

                            </div>	
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info vd_bg-green"><?php echo ucwords("Add"); ?></button>
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
        $("#frmsemester").validate({
            rules: {
                s_name:
                        {
                            required: true,
                            remote: {
                                url: "<?php echo base_url() . 'admin/check_semester'; ?>",
                                type: "post",
                                data: {
                                    semester: function () {
                                        return $("#s_name").val();
                                    },
                                }
                            }
                        },
                semester_status: "required",
            },
            messages: {
                s_name:
                        {
                            required: "Enter semester name",
                            remote: "Record is already present in the system",
                        },
                semester_status: "Slect semester status",
            }
        });
    });
</script>