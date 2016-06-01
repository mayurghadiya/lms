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
                <form class="form-horizontal" role="form" action="#" method="post"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">To</label>
                        <div class="col-sm-7">
                            <input type="text" readonly="" class="form-control" name="to" id="to"
                                   value="<?php echo $email->email_from; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-7">
                            <textarea required="" class="form-control" id="subject" name="subject"></textarea>                                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cc</label>
                        <div class="col-sm-7">
                            <input id="cc" class="form-control" name="cc"/>                                           
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-7">
                            <textarea id="message" name="message" class="width-100 form-control"  rows="15" placeholder="Write your message here"></textarea>                                          
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Attachment</label>
                        <div class="col-sm-5">
                            <input type="file" class="form-control" name="userfile[]" multiple/>
                        </div>
                    </div>


                    <div class="form-group form-actions">
                        <div class="col-sm-12 col-md-offset-2">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-envelope append-icon"></i> SEND</button>
                        </div>
                    </div>

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