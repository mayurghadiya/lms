<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh"></div>
            <div class=panel-body>
                <form class="form-horizontal" action="" id="student_profile" role="form" method="post"
                      enctype="multipart/form-data">
                    <div  class="panel-body">
                        <h3 class="mgbt-xs-20"> Profile: <span class="font-semibold"><?php echo ucwords($profile->std_first_name . ' ' . $profile->std_last_name); ?></span> </h3>
                        <br/>
                        <div class="row">
                            <div class="col-sm-3 mgbt-xs-20">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-img text-center mgbt-xs-15"> 
                                            <?php if ($profile->profile_photo != "") { ?>    
                                            <img alt="" src="<?php echo $profile_pic; ?>" id="manage_profile"> </div>
                                        <?php } else { ?>
                                        <img alt="example image" src="<?php echo base_url('uploads/user.jpg'); ?>" id="manage_profile"> </div>
                                    <?php } ?>
                                    <br/>
                                    <div>
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                              <!--<tr>
                                                <td style="width:60%;">Status</td>
                                                <td><span class="label label-success">Active</span></td>
                                              </tr>-->
                                                <tr>
                                                    <td>Register Since</td>
                                                    <td><?php echo date('F d, Y', strtotime($profile->Joining_date)); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9" style="margin-left: -80px;">                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label">&nbsp;</label>
                                <div class="col-sm-8 controls">
                                    <?php
                                    $message = $this->session->flashdata('message');
                                    if ($message != '') {
                                        ?>
                                        <div class="col-md-9 alert alert-success">
                                            <button class="close" data-dismiss="alert">&times;</button>
                                            <p><?php echo $message; ?></p>
                                        </div>    
                                    <?php } ?>

                                    <?php if (isset($error) && $error != '') { ?>
                                        <div class="col-md-9 alert alert-danger">
                                            <button class="close" data-dismiss="alert">&times;</button>
                                            <p><?php echo $error; ?></p>
                                        </div> 
                                    <?php } ?>
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                        </div>


                        <div class="col-sm-9">                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="email" value="<?php echo $profile->email; ?>" placeholder="email@yourcompany.com">
                                        </div>
                                        <!-- col-xs-12 -->
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text" value="<?php echo $profile->email; ?>" readonly="" placeholder="username">
                                        </div>

                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="password" name="password" value="" placeholder="password">
                                        </div>
                                        <!-- col-xs-12 --> 
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">New Password</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="password" name="new_password" value="" placeholder="password">
                                        </div>
                                        <!-- col-xs-12 --> 
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Confirm Password</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="password" name="confirm_password" value="" placeholder="password">
                                        </div>
                                        <!-- col-xs-12 --> 
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <!-- form-group -->

                            <hr />
                            <h3 class="mgbt-xs-15">Profile Setting</h3>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Profile Pic</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="file" name="userfile" class="form-control">
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">First Name</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text" value="<?php echo $profile->std_first_name; ?>" placeholder="first name">
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Last Name</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text" value="<?php echo $profile->std_last_name; ?>" placeholder="last name">
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Gender</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <select class="form-control" name="gender">
                                                <option value="Male"
                                                        <?php if ($profile->std_gender == 'Male') echo 'selected'; ?>>Male</option>
                                                <option value="Female"
                                                        <?php if ($profile->std_gender == 'Female') echo 'selected'; ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Parents Name</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text" value="<?php echo $profile->parent_name; ?>" placeholder="">
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Parents Phone</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text" value="<?php echo $profile->parent_contact; ?>" placeholder="">
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Parents Email</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text" value="<?php echo $profile->parent_email; ?>" placeholder="">
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Birthday</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text" id="datepicker-normal" value="<?php echo date('F d, Y', strtotime($profile->std_birthdate)); ?>"  />
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Marital Status</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text" value="<?php echo $profile->std_marital; ?>" class="form-control"/>
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Department</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text" name="degree" value="<?php echo $profile->d_name; ?>" class="form-control"/>
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>                            

                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Branch</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text" name="course" value="<?php echo $profile->c_name; ?>" class="form-control"/>
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Batch</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text" name="batch" value="<?php echo $profile->b_name; ?>" class="form-control"/>
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Semester</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text" name="batch" value="<?php echo $profile->s_name; ?>" class="form-control"/>
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>

                            <div class="form-group hidden">
                                <label class="col-sm-3 control-label">About</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <textarea class="form-control" class="form-control" name="about"><?php echo $profile->std_about; ?></textarea>
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>

                            <hr/>
                            <h3 class="mgbt-xs-15">Contact Setting</h3>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Mobile Phone</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text"  value="<?php echo $profile->std_mobile; ?>" placeholder="mobile phone">
                                        </div>
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <!-- form-group -->


                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Facebook</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text"  value="<?php echo $profile->std_fb; ?>" placeholder="facebook">
                                        </div>
                                        <!-- col-xs-9 -->
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <!-- form-group -->

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Twitter</label>
                                <div class="col-sm-9 controls">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-xs-9">
                                            <input class="form-control" type="text" value="<?php echo $profile->std_twitter; ?>" placeholder="twitter">
                                        </div>
                                        <!-- col-xs-9 -->
                                    </div>
                                    <!-- row --> 
                                </div>
                                <!-- col-sm-10 --> 
                            </div>
                            <!-- form-group --> 

                        </div>
                        <!-- col-sm-12 --> 
                    </div>	
                    <!-- row --> 

            </div>
            <div class="form-group">

                <div class="col-xs-9 col-md-offset-5">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Submit" class="btn btn-primary"/>
                </div>

            </div>
            <!-- form-group --> 
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
    $('form#student_profile input[type="text"]').attr('disabled', 'disabled');
    $('form#student_profile input[type="email"]').attr('disabled', 'disabled');
    $('form#student_profile textarea').attr('disabled', 'disabled');
    $('form#student_profile select').attr('disabled', 'disabled');
//$('form input[type="radio"]').attr('readonly', 'readonly');
</script>

<style>
    input[type="text"]:disabled, input[type="email"]:disabled, textarea:disabled {
        background: #dddddd;
    }    
</style>
