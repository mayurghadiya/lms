<?php
$edit_data = $this->db->get_where('cms_manager', array('c_id' => $param2))->result_array();
foreach ($edit_data as $row) {
    
}
?>

<div class=col-lg-12>
    <!-- col-lg-12 start here -->
    <div class="panel panel-default toggle panelMove panelClose panelRefresh">
        <!-- Start .panel -->
        <!--        <div class=panel-heading>
                    <h4 class=panel-title>Update CMS</h4>
                    <div class="panel-controls panel-controls-right">
                        <a class="panel-refresh" href="#"><i class="fa fa-refresh s12"></i></a>
                        <a class="toggle panel-minimize" href="#"><i class="fa fa-plus s12"></i></a>
                        <a class="panel-close" href="#"><i class="fa fa-times s12"></i></a>
                    </div>
                </div>-->
        <div class=panel-body>
            <?php echo form_open(base_url() . 'admin/cms/do_update/' . $row['c_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'id' => 'editcmsform', 'target' => '_top')); ?>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo ucwords("Page Title"); ?><span style="color:red">*</span></label>
                <div class="col-sm-9 controls">
                    <input type="text" class="form-control" name="c_title" value="<?php echo $row['c_title']; ?>" id="c_title" required />
                </div>
            </div>                   
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo ucwords("Page Slug"); ?><span style="color:red">*</span></label>
                <div class="col-sm-9 controls">
                    <input type="text" class="form-control" required="" name="c_slug" value="<?php echo $row['c_slug']; ?>" id="c_slug"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo ucwords("Status"); ?></label>
                <div class="col-sm-9">
                    <select name="c_status" class="form-control">
                        <option value="1" <?php
                        if ($row['c_status'] == '1') {
                            echo "selected";
                        }
                        ?>>Active</option>
                        <option value="0" <?php
                        if ($row['c_status'] == '0') {
                            echo "selected";
                        }
                        ?>>Inactive</option>        
                    </select>	
                </div>
            </div>	
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo ucwords("Page Content"); ?><span style="color:red">*</span></label>
                <div class="col-sm-9 controls">
                    <textarea required="" name="edit_content_data"  class="form-control summernote" rows="3" ><?php echo $row['c_description']; ?></textarea>
                </div>
            </div>             
            <div class="form-group form-actions">
                <div class="col-sm-3"> </div>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Update</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <!-- End .panel -->
</div>
<!-- col-lg-12 end here -->

<script>
    $(document).ready(function () {
        $('.summernote').summernote({
            height: 200
        });
    });
</script>