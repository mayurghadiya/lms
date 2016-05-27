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
                            <h4 class=panel-title>  <?php echo ucwords("Add Admission Type"); ?></h4>                
                        </div>-->
            <div class="panel-body"> 
                <div class="box-content">  
                    <div class="">
                        <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?></span> 
                    </div>                                                                    
                    <?php echo form_open(base_url() . 'admin/admission_type/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'frmadmission_type', 'target' => '_top')); ?>
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Admission Type Name<span style="color:red">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="at_name" id="at_name" />
                            </div>
                        </div>												
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-5">
                                <select name="at_status" class="form-control" >
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>		
                                </select>	

                            </div>	
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info vd_bg-green">Add Admission Type</button>
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

    $().ready(function () {
        $("#frmadmission_type").validate({
            rules: {
                at_name: "required",
                at_name:
                        {
                            required: true,
                            remote: {
                                url: "<?php echo base_url() . 'admin/check_admission_type'; ?>",
                                type: "post",
                                data: {
                                    admission_type: function () {
                                        return $("#at_name").val();
                                    },
                                }
                            }
                        },
                at_status: "required",
            },
            messages: {
                at_name:
                        {
                            required: "Enter admission type name",
                            remote: "Record is already present in the system",
                        },
                at_status: "Please slect admission status",
            }
        });
    });
</script>
