<<<<<<< HEAD
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo ucwords("Add Study Resources"); ?>
                </div>
            </div>
=======
<div class=row>                      
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <!--            <div class=panel-heading>
                            <h4 class=panel-title>  <?php echo ucwords("Add Study Resources"); ?></h4>                
                        </div>    -->
>>>>>>> 3c39f026f9259af4cd544c26eb8c4819ce08ec85
            <div class="panel-body"> 

                <div class="box-content">  

                    <div class="">
                        <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?></span> 
                    </div>                                       
<<<<<<< HEAD
                    <?php echo form_open(base_url() . 'index.php?admin/studyresource/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'frmstudyresource', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
=======
                    <?php echo form_open(base_url() . 'admin/studyresource/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'frmstudyresource', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
>>>>>>> 3c39f026f9259af4cd544c26eb8c4819ce08ec85
                    <div class="padded">											
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ucwords("department"); ?> <span style="color:red">*</span></label>
                            <div class="col-sm-5">
<<<<<<< HEAD
                                <select name="degree" id="degree">
=======
                                <select name="degree" id="degree" class="form-control">
>>>>>>> 3c39f026f9259af4cd544c26eb8c4819ce08ec85
                                    <option value="">Select department</option>
                                    <option value="All">All</option>
                                    <?php
                                    $datadegree = $this->db->get_where('degree', array('d_status' => 1))->result();
                                    foreach ($datadegree as $rowdegree) {
                                        ?>
                                        <option value="<?= $rowdegree->d_id ?>"><?= $rowdegree->d_name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>	
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ucwords("Branch "); ?><span style="color:red">*</span></label>
                            <div class="col-sm-5">
<<<<<<< HEAD
                                <select name="course" id="course">
=======
                                <select name="course" id="course" class="form-control">
>>>>>>> 3c39f026f9259af4cd544c26eb8c4819ce08ec85
                                    <option value="">Select Branch</option>
                                    <option value="All">All</option>
                                    <?php
                                    /*
                                     * $course = $this->db->get_where('course', array('course_status' => 1))->result();
                                      foreach ($course as $crs) {
                                      ?>
                                      <!--  <option value="<?= $crs->course_id ?>"><?= $crs->c_name ?></option>-->
                                      <?php
                                      } */
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ucwords("Batch "); ?><span style="color:red">*</span></label>
                            <div class="col-sm-5">
<<<<<<< HEAD
                                <select name="batch" id="batch" onchange="get_student2(this.value);" >
=======
                                <select name="batch" id="batch" onchange="get_student2(this.value);" class="form-control" >
>>>>>>> 3c39f026f9259af4cd544c26eb8c4819ce08ec85
                                    <option value="">Select batch</option>
                                    <option value="All">All</option>
                                    <?php
                                    /* $databatch = $this->db->get_where('batch', array('b_status' => 1))->result();
                                      foreach ($databatch as $row) {
                                      ?>
                                      <option value="<?= $row->b_id ?>"><?= $row->b_name ?></option>
                                      <?php
                                      } */
                                    ?>
                                </select>
                            </div>
                        </div>	
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ucwords("Semester "); ?><span style="color:red">*</span></label>
                            <div class="col-sm-5">
<<<<<<< HEAD
                                <select name="semester" id="semester" onchange="get_students2(this.value);">
=======
                                <select name="semester" id="semester" onchange="get_students2(this.value);" class="form-control">
>>>>>>> 3c39f026f9259af4cd544c26eb8c4819ce08ec85
                                    <option value="">Select Semester</option>
                                    <option value="All">All</option>
                                    <?php
                                    $datasem = $this->db->get_where('semester', array('s_status' => 1))->result();
                                    foreach ($datasem as $rowsem) {
                                        ?>
                                        <option value="<?= $rowsem->s_id ?>"><?= $rowsem->s_name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ucwords("Title "); ?><span style="color:red">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="title" id="title" />
                            </div>
                        </div>   
                        <!--  <div class="form-group">
                              <label class="col-sm-3 control-label">Page URL</label>
                              <div class="col-sm-5">
                                  <input type="text" class="form-control" name="pageurl" id="pageurl" />
                              </div>
                          </div>-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo ucwords("File Upload "); ?><span style="color:red">*</span></label>
                            <div class="col-sm-5">
                                <input type="file" class="form-control" name="resourcefile" id="resourcefile" />
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info vd_bg-green"><?php echo ucwords("Add"); ?></button>
                            </div>
                        </div>

                    </div>         
                    </form>               
                </div>
            </div>
        </div></div></div>
<script type="text/javascript">






    $("#degree").change(function () {
        var degree = $(this).val();

        var dataString = "degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/get_cource/'; ?>",
            data: dataString,
            success: function (response) {
                if (degree == "All")
                {
                    $("#batch").val($("#batch option:eq(1)").val());
                    $("#course").val($("#course option:eq(1)").val());
                    $("#semester").val($("#semester option:eq(1)").val());
                    //  $("#course")..val($("#semester option:second").val());
                    // $("#semester").prepend(response);
                    // $('#semester option:selected').text();


                } else {


                    $("#course").html(response);
                }
            }

        });

    });

    $("#course").change(function () {
        var course = $(this).val();
        var degree = $("#degree").val();
        var dataString = "course=" + course + "&degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/get_batchs/'; ?>",
            data: dataString,
            success: function (response) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'admin/get_semesterall/'; ?>",
                    data: {'course': course},
                    success: function (response1) {
                        $("#semester").html(response1);

                        $("#semester").val($("#semester option:eq(1)").val());

                    }
                });



                $("#batch").html(response);
            }
        });
    });


    $.validator.setDefaults({
        submitHandler: function (form) {
            form.submit();
        }
    });

    $().ready(function () {
        $("#dateofsubmission").datepicker({
            dateFormat: ' MM dd, yy',
            minDate: 0
        });

        jQuery.validator.addMethod("character", function (value, element) {
            return this.optional(element) || /^[A-z]+$/.test(value);
        }, 'Please enter a valid character.');

        jQuery.validator.addMethod("url", function (value, element) {
            return this.optional(element) || /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/.test(value);
        }, 'Please enter a valid URL.');


        $("#frmstudyresource").validate({
            rules: {
                degree: "required",
                course: "required",
                batch: "required",
                semester: "required",
                dateofsubmission: "required",
                pageurl:
                        {
                            required: true,
                            url: true,
                        },
                title:
                        {
                            required: true,
                        },
                resourcefile: {
                    required: true,
<<<<<<< HEAD
                  extension: 'gif|jpg|png|jpeg|pdf|xlsx|xls|doc|docx|ppt|pptx|pdf|txt',
=======
                    extension: 'gif|jpg|png|jpeg|pdf|xlsx|xls|doc|docx|ppt|pptx|pdf|txt',
>>>>>>> 3c39f026f9259af4cd544c26eb8c4819ce08ec85
                },
            },
            messages: {
                degree: "Please select Course",
                course: "Please select Branch",
                batch: "Please select batch",
                semester: "Please select semester",
                pageurl:
                        {
                            required: "Please enter page url",
                        },
                title:
                        {
                            required: "Please enter title",
                        },
                resourcefile: {
                    required: 'please upload file',
                    extension: 'Please upload valid file',
                },
            }
        });
    });
</script>