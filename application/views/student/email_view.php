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
                            <input type="text" readonly="" class="form-control" name="from" id="from"
                                   value="<?php echo $send_email; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="subject" name="subject" readonly=""><?php echo $email->subject; ?></textarea>                                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cc</label>
                        <div class="col-sm-7">
                            <input id="cc" class="form-control" name="cc" value="<?php echo $email->cc; ?>" readonly=""/>                                           
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-7">
                            <textarea id="message" name="message" readonly="" class="width-100 form-control"  rows="15" placeholder="Write your message here">
                                <?php echo $email->message; ?>
                            </textarea>                                          
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