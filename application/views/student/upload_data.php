<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <!--            <div class=panel-heading>
                            <h4 class=panel-title><?php echo $title; ?></h4>
                            <div class="panel-controls panel-controls-right">
                                <a class="panel-refresh" href="#"><i class="fa fa-refresh s12"></i></a>
                                <a class="toggle panel-minimize" href="#"><i class="fa fa-plus s12"></i></a>
                                <a class="panel-close" href="#"><i class="fa fa-times s12"></i></a>
                            </div>
                        </div>-->
            <div class=panel-body>
                <?php echo form_open(base_url() . 'student/uploads/', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'frmproject', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                <div class="padded">											
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Upload <span style="color:red">* </span> </label>
                        <div class="col-sm-5">
                            <input type="file" name="fileupload" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-primary">Upload File</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <!-- End .panel -->
        </div>
        <!-- col-lg-12 end here -->
    </div>
    <!-- End .row -->
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
    $.validator.setDefaults({
        submitHandler: function (form) {
            form.submit();
        }
    });

    $(document).ready(function () {

        jQuery.validator.addMethod("character", function (value, element) {
            return this.optional(element) || /^[A-z]+$/.test(value);
        }, 'Please enter a valid character');

        $("#frmproject").validate({
            rules: {
               
                fileupload: { required:true,
                extension:"gif|jpg|png|jpeg|pdf|xlsx|xls|doc|docx|ppt|pptx|pdf|txt",  
                }
            },
            messages: {
               
                fileupload:{
                    required: "Please browse file.",
                    extension:"Please upload valid file"
                    
                }
            }
        });
    });
</script>