<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="post">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">To</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="to" id="to" readonly=""
                                   value="<?php echo $email->email_from; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-7">
                            <textarea id="subject" class="form-control" name="subject" required="" readonly=""><?php echo $email->subject; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cc</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="cc" id="cc" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-10">
                            <textarea id="summernote1" name="message" class="width-100 form-control"  rows="15" placeholder="Write your message here">
                                                
                            </textarea>
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
            <!-- panel-body  --> 

        </div>
        <!-- panel --> 
    </div>
    <!-- col-md-8 -->
        <!-- panel --> 
    </div>
    
</div>
<!-- row --> 
</div></div>
<script>
    CKEDITOR.replace('message');
</script>