<?php
$degree = $this->db->get('degree')->result_array();
$courses = $this->db->get('course')->result_array();
$semesters = $this->db->get('semester')->result_array();
?>
<script language="javascript" type="text/javascript">
    $(function () {
        $("#fileupload").change(function () {
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#dvPreview");
                dvPreview.html("");
                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                $($(this)[0].files).each(function () {
                    var file = $(this);
                    if (regex.test(file[0].name.toLowerCase())) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var img = $("<img />");
                            img.attr("style", "height:100px;width: 100px");
                            img.attr("src", e.target.result);
                            img.attr("class",'img-photogallery');
                            dvPreview.append(img);
                        }
                        reader.readAsDataURL(file[0]);
                    } else {
                        alert(file[0].name + " is not a valid image file.");
                        dvPreview.html("");
                        return false;
                    }
                });
            } else {
                alert("This browser does not support HTML5 FileReader.");
            }
        });
    });
    $(document).ready(function ($) {
        images = new Array();
        $(document).on('change', '.coverimage', function () {
            files = this.files;
            $.each(files, function () {
                file = $(this)[0];
                if (!!file.type.match(/image.*/)) {
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onloadend = function (e) {
                        img_src = e.target.result;
                        html = "<img class='img-thumbnail' style='width:300px;margin:20px;' src='" + img_src + "'>";
                        $('#image_container').html(html);
                    };
                }
            });
        });
    });
</script>
<div class=row>
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <!--            <div class=panel-heading>
                            <h4 class=panel-title>  <?php echo ucwords("Add Photo Gallery"); ?></h4>                
                        </div> -->
            <div class="panel-body"> 
                <div class="box-content">  
                    <div class="">
                        <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?></span> 
                    </div>                                      
                    <?php echo form_open(base_url() . 'admin/photogallery/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'frmgallery', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                    <div class="padded">											

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Title <span style="color:red">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="title" id="title" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-4 control-label">Description <span style="color:red">*</span></label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Main Image <span style="color:red">*</span></label>
                            <div class="col-sm-8">
                                <input id="main_img" class="form-control coverimage" type="file" name="main_img"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"></label>
                            <div class="col-sm-8">
                                <div id="image_container"></div>                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">File Upload <span style="color:red">*</span></label>
                            <div class="col-sm-8">
                                <input id="fileupload" class="form-control " type="file" name="galleryimg[]" multiple="multiple" />
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Status <span style="color:red"> *</span></label>
                            <div class="col-sm-8">
                                <select name="status" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-info vd_bg-green">Add Gallery Images</button>
                            </div>
                        </div>
                        </form>               
                    </div> 
                    <div id="dvPreview">
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

        $("#frmgallery").validate({
            rules: {
                title: "required",
                description: "required",
                main_img: {
                    required: true,
                    extension: "gif|jpg|png|jpeg"
                },
                status: "required",
                'galleryimg[]': {
                    required: true,
                    extension: "gif|jpg|png|jpeg"
                }
            },
            messages: {
                title: "Enter title",
                description: "Enter description",
                main_img: {
                    required: "Upload main image",
                    extension: "Only gif,jpg,png file is allowed!"
                },
                status: "Select Status",
                'galleryimg[]': {
                    required: "Upload atleast 1 photo",
                    extension: "Only gif,jpg,png file is allowed!"
                }

            },
        });
    });
</script>
