
<?php
$edit_data = $this->db->get_where('courseware', array('courseware_id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>

    <div class="row">

        <div class=col-lg-12>
            <!-- col-lg-12 start here -->
            <div class="panel-default toggle panelMove panelClose panelRefresh">
                <!-- Start .panel -->
                <!--                <div class=panel-heading>
                                            <h4 class=panel-title> <?php echo ucwords("Update Courseware"); ?></h4>
                                        </div>-->
                <div class="panel-body">
                    <div class="tab-pane box" id="add" style="padding: 5px">
                        <div class="box-content"> 
                            <div class="">
                                <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?> </span> 
                            </div>
                            <?php echo form_open(base_url() . 'professor/courseware/do_update/' . $row['courseware_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'id' => 'frmcoursewareedit', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>

                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("Branch"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <select name="branch" id="branch" class="form-control" >
                                        <option value="">Select Branch</option>                                    
                                        <?php
                                        foreach ($branch as $b) {
                                            if ($b['course_id'] == $row['branch_id']) {
                                                ?>
                                                <option selected value="<?php echo $b['course_id'] ?>"><?php echo $b['c_name'] ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $b['course_id'] ?>"><?php echo $b['c_name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("subject"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <select name="subject" id="subject" class="form-control" >
                                        <option value="">Select Subject</option>                                    
                                        <?php
                                        foreach ($subject as $sub) {
                                            if ($sub['sm_id'] == $row['subject_id']) {
                                                ?>
                                                <option selected value="<?php echo $sub['sm_id'] ?>"><?php echo $sub['subject_name'] ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $sub['sm_id'] ?>"><?php echo $sub['subject_name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("chapter name"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="chapter" id="chapter" value="<?php echo $row['chapter']?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("topic"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="topic" id="topic" value="<?php echo $row['topic'] ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("attachment"); ?><span style="color:red"></span></label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" name="attachment" id="attachment"/>
                                    <input type="hidden" class="form-control" name="oldfile" id="oldfile" value="<?php echo $row['attachment'] ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("Description"); ?></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="description" id="description"> <?php echo $row['description'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("status"); ?></label>
                                <div class="col-sm-8">
                                    <select name="status" class="form-control" >
                                        <option value="1" <?php
                                        if ($row['status'] == '1') {
                                            echo "selected";
                                        }
                                        ?>>Active</option>
                                        <option value="0" <?php
                                        if ($row['status'] == '0') {
                                            echo "selected";
                                        }
                                        ?>>Inactive</option>	
                                    </select>
                                </div>	
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button type="submit" class="btn btn-info vd_bg-green" ><?php echo ucwords("update"); ?></button>
                                </div>
                            </div>
                            </form>                            


                        </div>
                    </div>
                </div>
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

        $("#frmcoursewareedit").validate({
            rules: {
                branch:
                        {
                            required: true,
                        },
                subject:
                     {
                         required: true,
                     },
               chapter:
                   {
                       required: true,
                   },       
                topic:
                        {
                            required: true,
                        },
            },
            messages: {
                branch:
                        {
                            required: "Select branch",
                        },
                subject:
                        {
                            required: "Select subject",
                        },
                chapter:
                        {
                            required: "Enter chapter name",
                        },         
                topic:
                        {
                            required: "Enter topic ",
                        },
            }
        });
    });
</script>
