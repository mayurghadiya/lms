<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
          
            <div class=panel-body>
                <table id="email-datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>No</th>
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
                                    <td><?php echo $counter; ?></td>
                                    <td style="width: 20%">
                                        <?php
                                        if (!empty($row->email_to)) {
                                            $query = "SELECT email, name FROM student WHERE std_id IN ($row->email_to)";
                                        } else {
                                            $query = "SELECT email, name FROM admin WHERE admin_id IN ($row->professor_to_admin)";
                                        }
                                        $result = $this->db->query($query)->result();
                                        if (count($result) > 1) {
                                            echo "{$result[0]->name}...";
                                        } else {
                                            echo "{$result[0]->name}";
                                        }
                                        ?>
                                        <?php //echo $row->email_to; ?>
                                    </td>
                                    <td><?php echo $row->subject; ?></td>
                                    <td style="width:20%;text-align: left">
                                        <strong><?php echo date('F d, Y h:i A', strtotime($row->created_at)); ?></strong>
                                    </td>
                                    <td class="menu-action">
                                        <a href="<?php echo base_url('professor/email_view/' . $row->email_id); ?>"><span class="label label-primary mr6 mb6"><i class="fa fa-desktop" ></i>View
                                            </span></a>                       
                                        <a href="<?php echo base_url('professor/delete_email/' . $row->email_id) ?>"
                                           onclick="return confirm('Are you sure to delete this email?');"><span class="label label-danger mr6 mb6">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                Delete
                                            </span></a>
                                    </td>
                                </tr>

                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php } ?>                                
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
</div>

<script>
    $(document).ready(function () {
        $('#email-datatable-list').DataTable({"language": { "emptyTable": "No data available" }});
    });
</script>