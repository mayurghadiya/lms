<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
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
                <div class="tabs mb20">
                    <?php if ($param == 'submission') { ?>
                        <ul id="import-tab" class="nav nav-tabs">
                            <li class="active">
                                <a href="#project-list" data-toggle="tab" aria-expanded="true">Project List</a>
                            </li>
                            <li class="">
                                <a href="#submitted-project" data-toggle="tab" aria-expanded="false">Submitted Project List</a>
                            </li>
                        </ul>
                        <div id="import-tab-content" class="tab-content">
                            <div class="tab-pane fade active in" id="project-list">
                                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                                    <thead>
                                        <tr>
                                            <th>No</th>											
                                            <th>Project Title</th>										
                                            <th>Date of submission</th>	
                                            <th>File</th>	
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($project as $row):
                                            ?>
                                            <tr>
                                                <td></td>	
                                                <td><?php echo $row->pm_title; ?></td>	                                               
                                                <td><?php echo date('F d, Y', strtotime($row->pm_dos)); ?></td>	
                                                <td>
                                                    <a href="<?php echo $row->pm_url; ?>" download=""><i class="fa fa-download"></i></a>
                                                </td>
                                                <td>
                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_submit_project/<?php echo $row->pm_id; ?>');" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6">Upload</span></a>
                                                </td>					

                                            </tr>
                                        <?php endforeach; ?>						
                                    </tbody>
                                </table>
                            </div>

                            <!-- tab content -->
                            <div class="tab-pane fade" id="submitted-project">
                                <?php
                                $this->db->select('s.dos,s.document_file,a.pm_title');
                                $this->db->from('project_document_submission s');
                                $this->db->join('project_manager a', 'a.pm_id=s.project_id');
                                $this->db->where('s.student_id', $this->session->userdata('std_id'));
                                $submitedproject = $this->db->get();
                                ?>
                                <table class="table table-striped table-bordered table-responsive" id="submitted-project-list">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Project Title</th>												
                                            <th>Submitted Date</th>												
                                            <th>Document Name</th>	                                                                
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($submitedproject->result() as $row):
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $row->pm_title; ?></td>	
                                                <td><?php echo date('F d, Y', strtotime($row->dos)); ?></td>	
                                                <td>
                                                    <a href="<?php echo base_url() . 'uploads/project_file/' . $row->document_file ?>" download="" title="download"  ><i class="fa fa-download"></i></a>
                                                </td>	
                                            </tr>
                                        <?php endforeach; ?>						
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    <?php } elseif ($param == 'video') { ?>
                        <?php
                        foreach ($project as $p) {
                            $filepath = 'uploads/project_file/' . $p->pm_filename;
                            $extension = pathinfo($filepath, PATHINFO_EXTENSION);
                            if ($extension == "mp4" || $extension == "wmv") {
                                echo pathinfo($filepath, PATHINFO_BASENAME) . "<br>";
                                ?>
                                <a id="play-video" href="#"> 
                                    <iframe id="video" width="420" height="315" src="//www.youtube.com/embed/9B7te184ZpQ?rel=0" frameborder="0" allowfullscreen></iframe>
                                </a><br />
                                <?php
                            }
                        }
                        ?>
                    <?php } ?>
                </div>
            </div>
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

<script>
    $(document).ready(function () {
        $('#submitted-project-list').DataTable({
            "language": {
                "emptyTable": "No data available"
            }
        });
    });
</script>

<script type="text/javascript">
    $.validator.setDefaults({
        submitHandler: function (form) {
            form.submit();
        }
    });


    $().ready(function () {
        $("#dateofsubmission").datepicker({
        });
        jQuery.validator.addMethod("character", function (value, element) {
            return this.optional(element) || /^[A-z]+$/.test(value);
        }, 'Please enter a valid character.');

        jQuery.validator.addMethod("url", function (value, element) {
            return this.optional(element) || /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/.test(value);
        }, 'Please enter a valid URL.');

        $("#frmproject").validate({
            rules: {
                degree: "required",
                batch: "required",
                semester: "required",
                student: "required",
                dateofsubmission: "required",
                pageurl: {
                    required: true,
                    url: true,
                },
                projectfile: "required",
                title: {
                    required: true,
                    character: true,
                },
            },
            messages: {
                degree: "Degree is required",
                batch: "Batch is required",
                semester: "Semester is required",
                student: "Student is required",
                dateofsubmission: "Submission date is required",
                pageurl: {
                    required: "Page url is required",
                },
                projectfile: "Project file is required",
                title: {
                    required: "Title is required",
                    character: "Valid title is required",
                },
            }
        });
    });
</script>	
