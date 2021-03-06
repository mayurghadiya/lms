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
                <form class="form-horizontal" role="form" action="#" method="post">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">To</label>
                        <div class="col-sm-9">
                            <?php
                            if (!empty($email->email_to)) {
                                $query = "SELECT email FROM student ";
                                $query .= "WHERE std_id IN ($email->email_to)";
                            } else {
                                $query = "SELECT email FROM admin ";
                                $query .= "WHERE admin_id IN ($email->professor_to_admin)";
                            }
                            $result = $this->db->query($query)->result();
                            $sent_list = '';
                            foreach ($result as $re) {
                                $sent_list .= $re->email . ', ';
                            }
                            ?>
                            <div class="email_data"><?php echo rtrim($sent_list, ', '); ?></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-9">
                            <div class="email_data"><?php echo $email->subject; ?></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cc</label>
                        <div class="col-sm-9">
                            <div class="email_data"><?php echo $email->cc; ?></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-9">
                            <div class="email_data"><?php echo $email->message; ?></div>
                        </div>
                    </div>

                    <?php if ($email->file_name != '') { ?> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Attachments</label>

                            <?php
                            $file_names = explode(',', $email->file_name);
                            foreach ($file_names as $file) {
                                ?>
                                <a target="_blank" download href="<?php echo base_url('uploads/emails/' . $file); ?>" style="margin-left: 15px;"><?php echo $file; ?></a><br/>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </form>
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

<style>
    .email_data {
        margin-top: 7px;
    }
</style>