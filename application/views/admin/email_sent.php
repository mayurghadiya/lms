
<!-- Middle Content Start -->

<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <div class=panel-heading>
                <h4 class=panel-title><?php echo $title; ?></h4>
                <div class="panel-controls panel-controls-right">
                    <a class="panel-refresh" href="#"><i class="fa fa-refresh s12"></i></a>
                    <a class="toggle panel-minimize" href="#"><i class="fa fa-plus s12"></i></a>
                    <a class="panel-close" href="#"><i class="fa fa-times s12"></i></a>
                </div>
            </div>
            <div class="panel-body">

                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><?php echo ucwords("Email"); ?></th>
                            <th><?php echo ucwords("Subject"); ?></th>
                            <th><?php echo ucwords("Date"); ?></th>
                            <th><?php echo ucwords("Action"); ?></th>
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
                                    <td></td>

                                    <td style="width: 20%">
                                        <?php
                                        if (!empty($row->email_to)) {
                                            $query = "SELECT email FROM student WHERE std_id IN ($row->email_to)";

                                            $result = $this->db->query($query)->result();
                                            if (count($result) > 1) {
                                                echo "{$result[0]->email}...";
                                            } else {
                                                echo "{$result[0]->email}";
                                            }
                                        } else if (!empty($row->admin_to_professor)) {
                                            $professor = $this->db->get_where('professor', array(
                                                        'professor_id' => $row->admin_to_professor
                                                    ))->row();
                                            echo $professor->email;
                                        }
                                        ?>
                                        <?php //echo $row->email_to;  ?>
                                    </td>
                                    <td>
                                        <?php echo $row->subject; ?>
                                    </td>
                                    <td style="width:20%;text-align: left">
                                        <strong><?php echo date('d-m-Y h:m A', strtotime($row->created_at)); ?></strong>
                                    </td>
                                    <td class="menu-action">
                                        <a href="<?php echo base_url('admin/email_view/' . $row->email_id); ?>"><span class="label label-primary mr6 mb6">View</span></a>
                                        <a href="<?php echo base_url('admin/delete_email/' . $row->email_id) ?>" onclick="return confirm('Are you sure to delete this email?');"><span class="label label-danger mr6 mb6">Delete</span></a>
                                    </td>
                                </tr>

                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="3">No sent mail found</td>
                            </tr>
                        <?php } ?>                                
                    </tbody>
                </table>
                <!--                        Pagination-->
            </div>
            <!-- panel-body  -->

        </div>
        <!-- panel --> 

    </div>
    <!-- .vd_content-section --> 

</div>
<!-- Middle Content End --> 