<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh"></div>
        <a href="<?php echo base_url(); ?>professor/email_reply/<?php echo $email->email_id; ?>" class="btn btn-primary">Reply</a>
        <div class=panel-body>

            <form class="form-horizontal" role="form" action="" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label">From</label>
                    <div class="col-sm-10">
                        <div class="email_data"><?php echo $email->email_from; ?></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Subject</label>
                    <div class="col-sm-10">
                        <div class="email_data"><?php echo $email->subject; ?></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Cc</label>
                    <div class="col-sm-10">
                        <div class="email_data"><?php echo $email->cc; ?></div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Message</label>
                    <div class="col-sm-10">
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
                            <a target="_blank" download href="<?php echo base_url('uploads/emails/' . $file); ?>" style="margin-left: 15px; margin-top:"><?php echo $file; ?></a><br/>
                        <?php } ?>
                    </div>
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

<style>
    .email_data {
        margin-top: 7px;
    }
</style>