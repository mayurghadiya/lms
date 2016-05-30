<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->          
            <div class="panel-body">
                <a class="links"  onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addsyllabus/');" href="#" id="navfixed" data-toggle="tab"><i class="fa fa-plus"></i> Syllabus</a>
                <form action="#" method="post" id="searchform">
                    <div class="form-group col-sm-3 validating">
                        <label>Department</label>
                        <select id="courses" name="degree" class="form-control">
                            <option value="">Select</option>
                            <?php foreach ($degree as $row) { ?>
                                <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-3 validating">
                        <label>Branch</label>
                        <select id="branches" name="course" class="form-control">
                            <option value="">Select</option>

                        </select>
                    </div>                   
                    <div class="form-group col-sm-3 validating">
                        <label> Semester</label>
                        <select id="semesters" name="semester" class="form-control">
                            <option value="">Select</option>
                            <?php foreach ($semester as $row) { ?>
                                <option value="<?php echo $row->s_id; ?>"
                                        ><?php echo $row->s_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-2">
                        <label>&nbsp;</label><br/>
                        <button type="submit" id="btnsubmit" class="submit btn btn-info vd_bg-green">Go</button>
                    </div>
                </form>
                <div id="getresponse">
                    <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="datatable-list">
                        <thead>
                            <tr>
                                <th><div>#</div></th>												
                                <th><div><?php echo ucwords("Syllabus Title"); ?></div></th>
                                <th><div><?php echo ucwords("department"); ?></div></th>
                                <th><div><?php echo ucwords("Branch"); ?></div></th>												                                                
                                <th><div><?php echo ucwords("Semester"); ?></div></th>
                                <th><div><?php echo ucwords("Description"); ?></div></th>
                                <th><div><?php echo ucwords("File"); ?></div></th>                                            
                                <th><div><?php echo ucwords("Action"); ?></div></th>											
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach (@$syllabus as $row):
                                ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>	

                                    <td><?php echo $row->syllabus_title; ?></td>	
                                    <td><?php
                                        foreach ($degree as $dgr):
                                            if ($dgr->d_id == $row->syllabus_degree):

                                                echo $dgr->d_name;
                                            endif;


                                        endforeach;
                                        ?></td>
                                    <td>
                                        <?php
                                        foreach ($course as $crs) {
                                            if ($crs->course_id == $row->syllabus_course) {
                                                echo $crs->c_name;
                                            }
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        foreach ($semester as $sem) {
                                            if ($sem->s_id == $row->syllabus_sem) {
                                                echo $sem->s_name;
                                            }
                                        }
                                        ?>													
                                    </td>	
                                    <td><?php echo wordwrap($row->syllabus_desc, 30, "<br>\n"); ?></td>
                                    <td id="downloadedfile"><a href="<?php echo base_url() . 'uploads/syllabus/' . $row->syllabus_filename; ?>" download="" title="<?php echo $row->syllabus_title; ?>"><i class="fa fa-download"></i></a></td>	                                                  
                                    <td class="menu-action">
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_syllabus/<?php echo $row->syllabus_id; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>

                                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/syllabus/delete/<?php echo $row->syllabus_id; ?>');" data-original-title="Remove" data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>	
                                    </td>	
                                </tr>
                            <?php endforeach; ?>						
                        </tbody>
                    </table>
                </div>
            </div>    
        </div>
        <!----TABLE LISTING ENDS--->
    </div>
</div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        "use strict";
        $('#data-tabless').DataTable({
            aoColumnDefs: [
                {
                    bSortable: false,
                    aTargets: [-1]
                }
            ]
        });


        $("#searchform #btnsubmit").click(function () {
            var degree = $("#courses").val();
            var course = $("#branches").val();
            var semester = $("#semesters").val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>admin/getsyllabus/",
                data: {'degree': degree, 'course': course, "semester": semester},
                success: function (response)
                {
                    $("#getresponse").html(response);
                }


            });
            return false;
        });

        $("#courses").change(function () {
            var degree = $(this).val();

            var dataString = "degree=" + degree;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'admin/get_course/'; ?>",
                data: dataString,
                success: function (response) {
                    $("#branches").html(response);
                }
            });
        });


    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        "use strict";
        $('#assignment-list').dataTable({
            "order": [[7, "desc"]],
            "dom": "<'row'<'col-sm-6'><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-4'l><'col-sm-4'i><'col-sm-4'p>>",
        });
        $('.filter-rows').on('change', function () {
            var filter_id = $(this).attr('data-filter');
            filter_column(filter_id);
        });

        function filter_column(filter_id) {
            $('#assignment-list').DataTable().column(filter_id).search(
                    $('#filter' + filter_id).val()
                    ).draw();
        }
    });
</script>

<style>
    #assignment-list_filter{
        margin-top: -50px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        "use strict";
        $('#sub-tables').dataTable({
            "order": [[7, "desc"]],
            "dom": "<'row'<'col-sm-6'><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-4'l><'col-sm-4'i><'col-sm-4'p>>",
        });
        $('.sfilter-rows').on('change', function () {
            var filter_id = $(this).attr('data-filter');
            filter_column(filter_id);
        });

        function filter_column(filter_id) {
            $('#sub-tables').DataTable().column(filter_id).search(
                    $('#sfilter' + filter_id).val()
                    ).draw();
        }
    });
</script>
