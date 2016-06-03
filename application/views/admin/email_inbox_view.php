<!-- Start .row -->
<div class=row>                      

    <div class="col-lg-12">
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle">
            <!-- Start .panel -->
            <div class="panel-body">
                <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/email_reply/<?php echo $email->email_id; ?>"> 
                    <span class="fa fa-reply"></span>Reply
                </a> 
                <form class="form-horizontal" role="form" action="" method="post">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">From</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="from" id="from" readonly=""
                                   value="<?php echo $email->email_from; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-7">
                            <textarea id="subject" class="form-control" readonly="" name="subject"><?php echo $email->subject ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cc</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="cc" id="cc" readonly=""
                                   value="<?php echo $email->cc; ?>"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-10">
                            <textarea id="summernote" readonly="" disabled="" name="message" class="width-100 form-control"  rows="15" placeholder="Write your message here">
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
                
            </div>
            <?php } ?>

        </div>
        <!-- End .panel -->
    </div>
    <!-- col-lg-12 end here -->
</div>
<!-- End .row -->
</div>
<!-- End contentwrapper -->
</div>