<!-- Start .row -->
<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle">
            <div class=panel-body>
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Admin Email</label>
                        <div class="col-sm-7">
                            <select id="to" class="form-control form-select" name="to[]" multiple="" required="">
                                <?php foreach ($all_admin as $row) { ?>
                                    <option value="<?php echo $row->admin_id; ?>"><?php echo $row->email . ' (Admin)'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Professor</label>
                        <div class="col-sm-7">
                            <select id="teacher" class="form-control select3" name="teacheremail[]" multiple="">
                                <?php foreach ($teacher as $row) { ?> 
                                    <option value="<?php echo $row->email; ?>"><?php echo $row->name . ' (' . $row->email . ')'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>       

                    <div class="form-group">
                        <label class="col-sm-2 control-label">External Email ID</label>
                        <div class="col-sm-7">
                            <input type="text" id="cc" name="cc" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-7">
                            <textarea id="subject" class="form-control" name="subject" required=""></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-7">
                            <textarea id="summernote1" name="message" class="width-100 form-control"  rows="15" placeholder="Write your message here"></textarea>
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
<script>
    CKEDITOR.replace('message');
</script>