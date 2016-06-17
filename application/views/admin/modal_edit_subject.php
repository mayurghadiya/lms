<?php
$degree = $this->db->order_by('d_name', 'ASC')->get('degree')->result_array();
$edit_data = $this->db->get_where('subject_manager', array('sm_id' => $param2))->result_array();
$branch = $this->db->order_by('course_id', 'ASC')->get_where('course', [
    'course_id' => $edit_data[0]['sm_course_id']
])->row();
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
                                <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?></span> 
                            </div>
                            <?php echo form_open(base_url() . 'admin/subject/do_update/' . $row['sm_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'id' => 'frmeditsubject', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("Subject Name"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="subname" id="subname" value="<?php echo $row['subject_name']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("Subject Code"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="subcode" id="subcode" value="<?php echo $row['subject_code']; ?>" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("department"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <select id="edit_degree" class="form-control" name="degree">
                                        <option value="">Select</option>
                                        <?php foreach ($degree as $department) { ?>
                                            <option value="<?php echo $department['d_id']; ?>"
                                                    <?php if($branch->degree_id == $department['d_id']) echo 'selected'; ?>><?php echo $department['d_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("Branch"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <select name="course" class="form-control" id="course1">
                                        <option value="">Select</option>
                                        <?php
                                        $course = $this->db->get_where('course', array('course_status' => 1))->result();
                                        foreach ($course as $crs) {
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
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo ucwords("Semester"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <select name="semester" class="form-control" id="semester1">
                                        <option value="">Select</option>
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
                                <label class="col-sm-4 control-label"><?php echo ucwords("Professor"); ?><span style="color:red">*</span></label>
                                <div class="col-sm-8">
                                    <select name="professor[]" class="form-control" id="professor1" multiple="">                                      
                                        <?php
                                        $professor_id = explode(',', $row['professor_id']);
                                        $professor = $this->db->get_where('professor')->result();
                                        foreach ($professor as $prof) {
                                            if (in_array($prof->professor_id, $professor_id)) {
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
                                    <button type="submit" class="submit btn btn-info vd_bg-green"><?php echo ucwords("Update"); ?></button>
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
                    required: true,
                    remote: {
                        url: "<?= base_url() ?>admin/checksubject",
                        type: "post",
                        data: {
                            subname: function () {

                                return $("#subname").val();
                            },
                            subcode: function () {

                                return $("#subcode").val();
                            },
                            course: function () {

                                return $("#course").val();
                            },
                            semester: function () {

                                return $("#semester").val();
                            },
                        }
                    }

                },
                'professor[]':
                        {
                            required: true,
                        },
            },
            messages: {
                subname: "Enter subject name",
                subcode: "Enter subject code",
                course: "Select branch",
                semester: {
                    required: "Select semester",
                    remote: "subject already exists in this course and semester",
                },
                'professor[]':
                        {
                            required: "Select Professor",
                        },
            }
        });
        
        $('#edit_degree').on('change', function(){
            var degree_id = $(this).val();
            branch_from_department(degree_id);
        });

        function branch_from_department(department_id) {
            $('#course1').find('option').remove().end();
            $('#course1').append('<option value>Select</option>');
            $.ajax({
                url: '<?php echo base_url(); ?>admin/course_list_from_degree/' + department_id,
                type: 'get',
                success: function (content) {
                    var course = jQuery.parseJSON(content);
                    $.each(course, function (key, value) {
                        $('#course1').append('<option value=' + value.course_id + '>' + value.c_name + '</option>');
                    })
                }
            })
        }
    });
</script>
