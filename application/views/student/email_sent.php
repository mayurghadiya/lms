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
                <table id="email-datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 0; // row counter
                        if (count($sent_mail)) {
                            foreach ($sent_mail as $row) {
                                $counter++;
                                ?> 

                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td style="width: 20%">
                                        <?php
                                        if (!empty($row->email_to)) {
                                            $admin = $this->db->get_where('admin', array(
                                                        'admin_id' => $row->email_to
                                                    ))->row();

                                            echo $admin->email;
                                        } else {
                                            $professor = $this->db->get_where('professor', array(
                                                        'professor_id' => $row->student_to_professor
                                                    ))->row();
                                            echo $professor->email;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row->subject; ?></td>
                                    <td style="width:20%;text-align: left"><?php echo date('F d, Y h:i A', strtotime($row->created_at)); ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('student/email_view/' . $row->email_id); ?>"><span class="label label-primary mr6 mb6">
                                                <i class="fa fa-desktop" ></i>View</span></a>                                        
                                    </td>
                                </tr>

                                <?php
                            }
                        }  ?>                                
                    </tbody>
                </table>
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
$(document).ready(function(){
    $('#email-datatable-list').DataTable({"language": { "emptyTable": "No data available" }});
})
</script>
