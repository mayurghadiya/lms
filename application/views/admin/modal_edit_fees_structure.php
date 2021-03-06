<?php
$edit_data = $this->db->get_where('fees_structure', array('fees_structure_id' => $param2))->row();
$degree = $this->db->get('degree')->result();
$course = $this->db->get_where('course', array(
            'degree_id' => $edit_data->degree_id
        ))->result();
$semester_detail = $this->db->get_where('course', array(
            'course_id' => $edit_data->course_id
        ))->row();
$semester = explode(',', $semester_detail->semester_id);
$this->db->where_in('s_id', $semester);
$semester = $this->db->get('semester')->result();

$query = "SELECT * FROM batch ";
$query .= "WHERE FIND_IN_SET($edit_data->degree_id, degree_id) ";
$query .= "AND FIND_IN_SET($edit_data->course_id, course_id)";
$batch = $this->db->query($query)->result();
?>
<div class="row">
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <!--            <div class=panel-heading>
                            <h4 class=panel-title>Update Fee Structure</h4>
                        </div>-->
            <div class=panel-body>
                <?php echo form_open(base_url() . 'admin/fees_structure/update/' . $edit_data->fees_structure_id, array('class' => 'form-horizontal form-groups-bordered validate', 'id' => 'editfeesstructure', 'target' => '_top')); ?>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("Title"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="edit_title" name="title" class="form-control"
                               value="<?php echo $edit_data->title; ?>" required=""/>
                    </div>
                </div>                  
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("department"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edit_degree" name="degree" required="">
                            <option value="">Select</option>
                            <?php foreach ($degree as $d) { ?>
                                <option value="<?php echo $d->d_id; ?>"
                                        <?php if ($d->d_id == $edit_data->degree_id) echo 'selected'; ?>><?php echo $d->d_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("Branch"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edit_course" name="course" required="">
                            <option value="">Select</option>
                            <?php foreach ($course as $row) { ?>
                                <option value="<?php echo $row->course_id; ?>"
                                        <?php if ($edit_data->course_id == $row->course_id) echo 'selected'; ?>><?php echo $row->c_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("Batch"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control" required="" name="edit_batch" id="edit_batch">
                            <option value="">Select</option>
                            <?php foreach ($batch as $b) { ?>
                                <option value="<?php echo $b->b_id; ?>"
                                        <?php if ($b->b_id == $edit_data->batch_id) echo 'selected'; ?>><?php echo $b->b_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("Semester"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edit_semester" name="semester" required="">
                            <option value="">Select</option>
                            <?php foreach ($semester as $row) { ?>
                                <option value="<?php echo $row->s_id; ?>"
                                        <?php if ($edit_data->sem_id == $row->s_id) echo 'selected'; ?>><?php echo $row->s_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("Fee"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-8">                                        
                        <input type="text" id="edit_fees" class="form-control" name="fees" required=""
                               value="<?php echo $edit_data->total_fee; ?>"/>                                               
                    </div>
                </div>	
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("Start Date"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="edit_start_date" class="form-control datepicker" name="start_date"
                               value="<?php echo date('F d, Y', strtotime($edit_data->fee_start_date)); ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("End Date"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="edit_end_date" class="form-control datepicker" name="end_date"
                               value="<?php echo date('F d, Y', strtotime($edit_data->fee_end_date)); ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("Expiry Date"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="edit_expiry_date" class="form-control datepicker" name="expiry_date"
                               value="<?php echo date('F d, Y', strtotime($edit_data->fee_expiry_date)); ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("Penalty"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="edit_penalty" class="form-control" name="penalty"
                               value="<?php echo $edit_data->penalty; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo ucwords("Description"); ?></label>
                    <div class="col-sm-8">
                        <textarea id="description" name="description" class="form-control"><?php echo $edit_data->description; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="submit btn btn-info vd_bg-green"><?php echo ucwords("update"); ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <!-- End .panel -->
    </div>
    <!-- col-lg-12 end here -->
</div>


<script>
    $.validator.setDefaults({
        submitHandler: function (form) {
            form.submit();
        }
    });

    $(document).ready(function () {
        $("#editfeesstructure").validate({
            rules: {
                edit_title: "required",
                edit_degree: "required",
                edit_course: "required",
                edit_batch: "required",
                edit_semester: "required",
                edit_fees: "required",
                start_date: "required",
                end_date: "required",
                expiry_date: "required",
                penalty: "required"
            },
            messages: {
                edit_title: "Please enter title",
                edit_degree: "Please select department",
                edit_course: "Please select branch",
                edit_batch: "Please select batch",
                edit_semester: "Please select semester",
                edit_fees: "Please enter fee",
                start_date: "Please enter start date",
                end_date: "Please enter end date",
                expiry_date: "Please enter expiry date",
                penalty: "Please enter penalty"
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        //course by degree
        $('#edit_degree').on('change', function () {
            var course_id = $('#edit_course').val();
            var degree_id = $(this).val();

            //remove all present element
            $('#edit_course').find('option').remove().end();
            $('#edit_course').append('<option value="">Select</option>');
            var degree_id = $(this).val();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/course_list_from_degree/' + degree_id,
                type: 'get',
                success: function (content) {
                    var course = jQuery.parseJSON(content);
                    $.each(course, function (key, value) {
                        $('#edit_course').append('<option value=' + value.course_id + '>' + value.c_name + '</option>');
                    })
                }
            })
            batch_from_degree_and_course(degree_id, course_id);
        });

        //batch from course and degree
        $('#edit_course').on('change', function () {
            var degree_id = $('#edit_degree').val();
            var course_id = $(this).val();
            batch_from_degree_and_course(degree_id, course_id);
            get_semester_from_branch(course_id);
        })

        //find batch from degree and course
        function batch_from_degree_and_course(degree_id, course_id) {
            //remove all element from batch
            $('#edit_batch').find('option').remove().end();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/batch_list_from_degree_and_course/' + degree_id + '/' + course_id,
                type: 'get',
                success: function (content) {
                    $('#edit_batch').append('<option value="">Select</option>');
                    var batch = jQuery.parseJSON(content);
                    console.log(batch);
                    $.each(batch, function (key, value) {
                        $('#edit_batch').append('<option value=' + value.b_id + '>' + value.b_name + '</option>');
                    })
                }
            })
        }

        //get semester from brach
        function get_semester_from_branch(branch_id) {
            $('#edit_semester').find('option').remove().end();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/get_semesters_of_branch/' + branch_id,
                type: 'get',
                success: function (content) {
                    $('#edit_semester').append('<option value="">Select</option>');
                    var semester = jQuery.parseJSON(content);
                    $.each(semester, function (key, value) {
                        $('#edit_semester').append('<option value=' + value.s_id + '>' + value.s_name + '</option>');
                    })
                }
            })
        }


    })
</script>

<script>
    $(document).ready(function () {       
         $("#edit_start_date").datepicker({
            format: 'MM dd, yyyy',
            todayHighlight: true,
            autoclose: true,
            startDate: new Date()
        });
        $('#edit_start_date').on('change', function () {
            
            date = new Date($(this).val());
            start_date = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear();
            console.log(start_date);
            
            setTimeout(function () {
                $("#edit_end_date").datepicker({
                    format: ' MM d, yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    startDate: start_date
                }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#edit_expiry_date').datepicker('setStartDate', minDate);
        });
            }, 200);
        });
          
           $("#edit_expiry_date").datepicker({
                    format: ' MM d, yyyy',
                    autoclose: true,
                    todayHighlight: true
                });

    })
    //minDate: new Date(),

</script>