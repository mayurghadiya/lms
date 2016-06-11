<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh"></div>
            <div class=panel-body>
                <form class="form-horizontal" role="form" action="#" method="post">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">To</label>
                        <div class="col-sm-7">
                            <?php
                            if (!empty($email->email_to)) {
                                $admin = $this->db->get_where('admin', array(
                                            'admin_id' => $email->email_to
                                        ))->row();

                                $send_email = $admin->email;
                            } else {
                                $professor = $this->db->get_where('professor', array(
                                            'professor_id' => $email->student_to_professor
                                        ))->row();
                                $send_email = $professor->email;
                            }
                            ?>
                            <div class="email_data"><?php echo $send_email; ?></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-7">
                            <div class="email_data"><?php echo $email->subject; ?></div>                                         
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cc</label>
                        <div class="col-sm-7">
                            <div class="email_data"><?php echo $email->cc; ?></div>                                     
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-7">
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

<style>
    .email_data {
        margin-top: 7px;
    }
    </style>