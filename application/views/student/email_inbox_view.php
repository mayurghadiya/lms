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
                <a style="float: right" href="<?php echo base_url(); ?>student/email_reply/<?php echo $email->email_id; ?>" class="links">Reply</a>
                <form class="form-horizontal" role="form" action="#" method="post">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">From</label>
                        <div class="col-sm-7">
                            <input type="text" readonly="" class="form-control" name="from" id="from"
                                   value="<?php echo $email->email_from; ?>"/>
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
                        <div class="col-sm-9" style="margin-top: 7px;">
                            <?php echo $email->message; ?>                                    
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