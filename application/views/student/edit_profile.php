<!-- Start .row -->
<div class=row>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <!-- col-lg-4 start here -->
        <div class="panel panel-default">
            <!-- Start .panel -->
            <div class=panel-heading>
                <h4 class=panel-title>Profile details</h4>
            </div>
            <div class=panel-body>
                <div class="row profile">
                    <!-- Start .row -->
                    <div class=col-md-4>
                        <div class=profile-avatar>
                            <?php if ($profile->profile_photo != "") { ?>    
                            <img alt="" src="<?php echo base_url('uploads/student_image/' . $profile->profile_photo); ?>" width="128" height="128" id="manage_profile">
                            <?php } else { ?>
                                <img alt="example image" style="width: 128px; height: 128px" src="<?php echo base_url('assets/img/avatar.jpg'); ?>" id="manage_profile">
                            <?php } ?>
                        </div>
                    </div>
                    <div class=col-md-8>
                        <div class=profile-name>
                            <h4><?php echo $profile->std_first_name . ' ' . $profile->std_last_name; ?></h4>
                            <p class="job-title mb0"><i class="fa fa-building"></i> <?php echo $profile->d_name; ?></p>
                            <br/><p><i class="fa fa-envelope"></i> <?php echo $profile->email; ?></p>
                            <br/><p><i class="fa fa-phone"></i><?php echo $profile->std_mobile; ?></p>
                        </div>
                    </div>
                </div>

                <div class=col-md-12>
                    <br/>
                    <div class="contact-info bt">
                        <div class=row>
                            <!-- Start .row -->
                            <div class=col-md-4>
                                <dl class=mt20>
                                    <dt class=text-muted>First Name
                                    <dd><?php echo $profile->std_first_name; ?>
                                    <dt class=text-muted>Roll No
                                    <dd><?php echo $profile->std_roll; ?>
                                    <dt class=text-muted>Mobile
                                    <dd><?php echo $profile->std_mobile; ?>
                                    <dt class=text-muted>Department
                                    <dd><?php echo $profile->d_name; ?>
                                    <dt class=text-muted>Batch
                                    <dd><?php echo $profile->b_name; ?>
                                </dl>
                            </div>
                            <div class=col-md-8>
                                <dl class=mt20>
                                    <dt class=text-muted>Last Name
                                    <dd><?php echo $profile->std_last_name; ?>
                                    <dt class=text-muted>Gender
                                    <dd><?php echo $profile->std_gender; ?>
                                    <dt class=text-muted>Email
                                    <dd><?php echo $profile->email; ?>
                                    <dt class=text-muted>Branch
                                    <dd><?php echo $profile->c_name; ?>
                                    <dt class=text-muted>Semester
                                    <dd><?php echo $profile->s_name; ?>
                                </dl>
                            </div>
                        </div>
                        <!-- End .row -->
                    </div>
                </div>
            </div>
            <!-- End .row -->
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <!-- col-lg-4 start here -->
        <div class="tabs mb20">
            <ul id=profileTab class="nav nav-tabs">
                <li><a href=#change-password data-toggle=tab>Change Password</a></li>
            </ul>
            <div id=myTabContent class=tab-content>
                <div class="tab-pane fade active in" id=change-password>
                    <?php
                    $message = $this->session->flashdata('message');
                    if ($message != '') {
                        ?>
                        <div class="alert alert-success">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <p><?php echo $message; ?></p>
                        </div>    
                    <?php } ?>

                    <?php if (isset($error) && $error != '') { ?>
                        <div class="alert alert-danger">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <p><?php echo $error; ?></p>
                        </div> 
                    <?php } ?>  
                    <form class="form-horizontal group-border stripped" role=form
                          method="post" enctype="multipart/form-data">
                        <div class=form-group>
                            <label class="col-lg-3 control-label" for="">Current Password</label>
                            <div class=col-lg-9>
                                <input class="form-control" required="" type="password" name="password" value="" placeholder="">
                            </div>
                        </div>
                        <!-- End .form-group  -->
                        <div class=form-group>
                            <label class="col-lg-3 control-label" for="">New Password</label>
                            <div class=col-lg-9>
                                <input class="form-control" required="" type="password" name="new_password" value="" placeholder="">
                            </div>
                        </div>
                        <!-- End .form-group  -->
                        <div class=form-group>
                            <label class="col-lg-3 control-label" for="">Confirm Password</label>
                            <div class=col-lg-9>
                                <input class="form-control" required="" type="password" name="confirm_password" value="" placeholder="">
                            </div>
                        </div>
                        <!-- End .form-group  -->

                        <div class=form-group>
                            <div class="col-lg-9 col-lg-offset-3">
                                <input type="submit" value="Change Password" class="btn btn-primary"/>
                            </div>
                        </div>
                        <!-- End .form-group  -->
                    </form>
                </div>
            </div>
        </div>
        <!-- End .tabs -->
    </div>
</div>

</div>
<!-- End .row -->
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->
</div>
