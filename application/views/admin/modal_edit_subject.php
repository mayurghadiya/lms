<?php
$edit_data = $this->db->get_where('subject_manager', array('sm_id' => $param2))->result_array();
$course = $this->db->get_where('course', array('course_status' => 1))->result();
$datacourse=$this->db->get_where('course',array('course_id'=>$edit_data[0]['sm_course_id']))->result_array();
$datadegree = $this->db->get_where('degree', array('d_status' => 1))->result();
foreach ($edit_data as $row):
    ?>
<div class=row>                      
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <!--            <div class=panel-heading>
                                <h4 class=panel-title>  <?php echo ucwords("Update Subject Association"); ?></h4>                
                            </div>    -->
                <div class="panel-body">
                    <div class="tab-pane box" id="add" style="padding: 5px">
                        <div class="box-content">  
                             <div class="">
                                    <span style="color:red">* <?php echo "is ".ucwords("mandatory field");?></span> 
                                </div>
                            <?php echo form_open(base_url() . 'admin/subject/do_update/' . $row['sm_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'id' => 'frmeditsubject', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("Subject Name");?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="subname" id="subname" value="<?php echo $row['subject_name']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("Subject Code");?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="subcode" id="subcode" value="<?php echo $row['subject_code']; ?>" />
                                </div>
                            </div>
                             <div class="form-group ">
                                <label class="col-sm-4 control-label"><?php echo ucwords("department"); ?><span style="color:red">*</span></label>
                                 <div class="col-sm-8">
                                    <select class="form-control" name="degree" id="degree" >
                                        <option value="">Select department</option>
                                        <?php
                                        $datadegree = $this->db->get_where('degree', array('d_status' => 1))->result();
                                        foreach ($datadegree as $rowdegree) {
                                            if($datacourse[0]['degree_id']==$rowdegree->d_id)
                                            {
                                            ?>
                                            <option value="<?= $rowdegree->d_id ?>" selected><?= $rowdegree->d_name ?></option>
                                            <?php
                                            }
                                            else
                                            {
                                                ?>
                                            <option value="<?= $rowdegree->d_id ?>"><?= $rowdegree->d_name ?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                 </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("Branch");?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <select name="course" class="form-control" id="course1">
                                        <option value="">Select branch</option>
                                        <?php
                                       
                                        foreach ($course as $crs) {
                                           if($datacourse[0]['degree_id']==$crs->degree_id)
                                           {
                                            if ($crs->course_id == $row['sm_course_id']) {
                                                ?>
                                                <option value="<?= $crs->course_id ?>" selected><?= $crs->c_name ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?= $crs->course_id ?>" ><?= $crs->c_name ?></option>
                                                <?php
                                            }
                                           }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("Semester");?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <select name="semester" class="form-control" id="semester1">
                                        <option value="">Select semester</option>
                                            <?php
                                            $datasem = $this->db->get_where('semester', array('s_status' => 1))->result();
                                            foreach ($datasem as $rowsem) {
                                                if ($rowsem->s_id == $row['sm_sem_id']) {
                                                    ?>
                                                <option value="<?= $rowsem->s_id ?>" selected><?= $rowsem->s_name ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?= $rowsem->s_id ?>" ><?= $rowsem->s_name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                              <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("Professor");?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                      <select name="professor[]" class="form-control" id="professor1" multiple="">                                      
                                            <?php
                                               $professor_id=explode(',',$row['professor_id']);
                                            $professor = $this->db->get_where('professor')->result();
                                            foreach ($professor as $prof) {
                                                if (in_array($prof->professor_id,$professor_id)) {
                                                    ?>
                                                <option value="<?= $prof->professor_id; ?>" selected><?= $prof->name ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?= $prof->professor_id ?>" ><?= $prof->name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button type="submit" class="submit btn btn-info vd_bg-green"><?php echo ucwords("Update");?></button>
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
            var form = document.getElementsByTagName("form");
            form.submit();
        }
    });
      $("#degree").change(function () {
        var degree = $(this).val();

        var dataString = "degree=" + degree;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/get_course/'; ?>",
            data: dataString,
            success: function (response) {
                $("#course1").html(response);
            }
        });
    });
$("#course1").change(function () {
        var course = $(this).val();
        var degree = $("#degree").val();
        var dataString = "course=" + course;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'admin/get_semester'; ?>",
            data: dataString,
            success: function (response) {
                $("#semester1").html(response);
            }
        });
    });
    $().ready(function () {
        $("#frmeditsubject").validate({
            rules: {
                subname: "required",
                subcode: "required",
                course: "required",
                 semester: {
                        required:true,
                        remote: {
                                        url: "<?=base_url()?>admin/checksubject",
                                        type: "post",
                                        data: {
                                            subname: function() {

                                                return $( "#subname" ).val();
                                            },
                                            subcode: function() {

                                                return $( "#subcode" ).val();
                                            },
                                            course: function() {

                                                return $( "#course" ).val();
                                            },
                                            semester: function() {

                                                return $( "#semester" ).val();
                                            },
                                        }
                                    }

                    },
                 'professor[]': 
                            {
                    
                                 required:true,
                            },
            },
            messages: {
                subname: "Enter subject name",
                subcode: "Enter subject code",
                course: "Select branch",
                semester: {
                        required:"Select semester",
                        remote:"subject already exists in this course and semester",
                    },
                    'professor[]': 
                            {
                    
                                 required:"Select Professor",
                            },
            }
        });
    });
</script>
