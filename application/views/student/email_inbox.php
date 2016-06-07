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
                <table id="inbox_email-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>From</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 0;
                        if (count($inbox)) {

                            foreach ($inbox as $row) {
                                $counter++;
                                ?>
                                <?php
                                $student_id = $this->session->userdata('std_id');
                                $query = "SELECT email_id FROM email ";
                                $query .= "WHERE FIND_IN_SET($student_id, student_read) ";
                                $query .= "AND email_id = $row->email_id ";
                                $result = $this->db->query($query)->num_rows();
                                ?>
                                <tr class="<?php if ($result == 0) echo 'info'; ?>">
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo $row->email_from; ?></td>
                                    <td>
                                        <?php echo $row->subject; ?>
                                    </td>
                                    <td><?php echo date('d-m-Y h:m A', strtotime($row->created_at)); ?></td>
                                    <td>
                                        <a href="<?php echo base_url('student/inbox_email/' . $row->email_id); ?>"><span class="label label-primary mr6 mb6">View</span></a>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#inbox_email-list').DataTable({});
    });
</script>