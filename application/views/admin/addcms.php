<div class="row">

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <div class=panel-heading>
                <h4 class=panel-title>Add CMS Page</h4>
            </div>
            <div class=panel-body>
                <?php echo form_open(base_url() . 'index.php?admin/cms/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'cmsform', 'target' => '_top')); ?>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("Page Name"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="c_title" id="c_title" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("Page Slug"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" required="" name="c_slug" id="c_slug"/>
                        </div>
                    </div>
                    <div class="form-group" id="ck-editor">					
                        <label class="col-sm-3 control-label"><?php echo ucwords("Page Content"); ?><span style="color:red">*</span></label>
                        <div class="col-sm-7">		
                            <textarea name="c_description" required="" class="ckeditor form-control" data-rel="ckeditor" rows="3" required></textarea>
                        </div>														
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo ucwords("Status"); ?></label>
                        <div class="col-sm-3">
                            <select name="c_status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>		
                            </select>
                        </div>	
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info vd_bg-green"><?php echo ucwords("Add"); ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>   
                </div>
            </div>
            <!-- End .panel -->
        </div>
        <!-- col-lg-12 end here -->
    </div>

    <script type="text/javascript">
        $.validator.setDefaults({
            submitHandler: function (form) {
                form.submit();
            }
        });
        $().ready(function () {
            $("#cmsform").validate({
                ignore: [],
                rules: {
                    content_data: {
                        required: function () {
                            CKEDITOR.instances.content_data.updateElement();
                        }
                    },
                    c_title: "required",
                    c_slug: "required",
                    c_description: "required",
                },
                messages: {
                    c_title: "Please enter title",
                    c_slug: "Please select slug",
                    c_description: "Please enter page content",
                }
            });
        });
    </script>