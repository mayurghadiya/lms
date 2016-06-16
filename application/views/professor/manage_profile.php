<!-- Middle Content Start -->
<style>
   #upload{
   display:none
   }
   .bootstrap-filestyle.input-group {
   display: none;
   }
</style>
<div class="row">
   <div class="col-lg-12">
      <!-- col-lg-12 start here -->
      <div class="panel-default">
         <div class="vd_content-section clearfix">
            <?php foreach ($edit_data as $professor): ?>
            <div class="panel widget light-widget">
               <?php echo form_open(base_url() . 'professor/manage_profile/update_profile_info', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'role' => 'form', 'id' => 'edit_profile', 'enctype' => 'multipart/form-data')); ?>
               <div class="col-sm-4" style="text-align:center;">
                  <h3 class="mgbt-xs-20"> Profile: <span class="font-semibold"><?php echo $professor['name']; ?></span> </h3>
                  <div class="form-group">
                     <div class="col-xs-12">
                        <div class="form-img text-center mgbt-xs-15">
                           <?php if ($professor['image_path']) { ?>
                           <img src="<?php echo base_url() . 'uploads/professor/' . $professor['image_path']; ?>" id="manage_profile"  alt="...">
                           <?php } 
                           else { ?>
                           <img alt="example image" style="width: 128px; height: 128px" src="<?php echo base_url('assets/img/avatar.jpg'); ?>" id="manage_profile">
                           <?php } ?>                                            
                        </div>

                        <div class="form-img-action text-center mgbt-xs-20">
                           <input id="upload" class="form-control coverimage2" type="file" name="userfile" accept="image/*"/>
                           <br/>
                           <a href="" id="upload_link" class="btn btn-primary"><i class="fa fa-cloud-upload append-icon"></i>Profile Pic</a>
                        </div>

                     </div>
                  </div>

               </div>

           
         <div class="col-sm-8">
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
         <div class="col-sm-8">
            <div class="dropdown1">
               <h3 class="mgbt-xs-15 dropdown-toggle trigger dropbtn1">Profile Setting</h3>
               <div class="clearfix dropdown-content1 toggle" style="display: none;">
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("professor name"); ?></label>
                     <div class="col-sm-5">
                        <input id="professor-name" readonly="" class="form-control" type="text" name="professor_name" required=""
                           value="<?php echo $professor['name']; ?>"/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("email"); ?></label>
                     <div class="col-sm-5">
                        <input id="email" class="form-control" readonly=""  type="email" name="email" required=""
                           value="<?php echo $professor['email']; ?>"/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("mobile"); ?></label>
                     <div class="col-sm-5">
                        <input id="mobile" class="form-control" type="text" name="mobile" 
                           value="<?php echo $professor['mobile']; ?>"/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("address"); ?></label>
                     <div class="col-sm-5">
                        <textarea id="address" class="form-control" name="address" ><?php echo $professor['address']; ?></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("city"); ?></label>
                     <div class="col-sm-5">
                        <input id="city" class="form-control" type="text" name="city" 
                           value="<?php echo $professor['city']; ?>"/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("zip code"); ?></label>
                     <div class="col-sm-5">
                        <input id="zip-code" class="form-control" type="text" name="zip_code"  value="<?php echo $professor['zip']; ?>"/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("date of birth"); ?></label>
                     <div class="col-sm-5">
                        <input id="date-of-birth" class="form-control datepicker-normal" type="text" name="dob"    value="<?php echo $professor['dob']; ?>"/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("occupation"); ?></label>
                     <div class="col-sm-5">
                        <input id="occupation" class="form-control" readonly=""  type="text" name="occupation" required=""
                           value="<?php echo $professor['occupation']; ?>"/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("designation"); ?></label>
                     <div class="col-sm-5">
                        <input id="designation" class="form-control" readonly=""  type="text" name="designation" required=""
                           value="<?php echo $professor['designation']; ?>"/>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("department"); ?></label>
                     <div class="col-sm-5">
                        <select id="degree" name="degree" readonly="" disabled=""   class="form-control" required="">
                           <option value="">Select</option>
                           <?php foreach ($degree_list as $degree) { ?>
                           <option value="<?php echo $degree->d_id; ?>"
                              <?php if ($professor['department'] == $degree->d_id) echo 'selected'; ?>><?php echo $degree->d_name; ?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("branch"); ?></label>
                     <div class="col-sm-5">
                        <select id="branch" name="branch" readonly=""  disabled="" class="form-control" required="">
                           <option value="">Select</option>
                           <?php
                              $course = $this->db->get_where('course', array('course_status' => 1, 'degree_id' => $professor['department']))->result();
                              foreach ($course as $crs) {
                                  if ($crs->course_id == $professor['branch']) {
                                      ?>
                           <option value="<?= $crs->course_id ?>" selected><?= $crs->c_name ?></option>
                           <?php
                              } else {
                                  ?>
                           <option value="<?= $crs->course_id ?>" ><?= $crs->c_name ?></option>
                           <?php
                              }
                              }
                              ?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("about"); ?></label>
                     <div class="col-sm-5">
                        <textarea id="about" class="form-control" name="about"><?php echo $professor['about']; ?></textarea>
                     </div>
                  </div>
               </div>
            </div>
            <div class="dropdown2">
               <h3 class="mgbt-xs-15 dropbtn2 trigger">Change Password</h3>
               <div class="clearfix dropdown-content2 toggle" style="display: none;">
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("password"); ?></label>
                     <div class="col-sm-5">
                        <input class="form-control" type="password" name="password" value="" placeholder="password">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("new password"); ?></label>
                     <div class="col-sm-5">
                        <input class="form-control" type="password" name="new_password" value="" placeholder="password">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label"><?php echo ucwords("confirm password"); ?></label>
                     <div class="col-sm-5">
                        <input class="form-control" type="password" name="confirm_password" value="" placeholder="password">
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group" style="margin-left: 0px; margin-top:15px;">
               <button class="btn vd_btn vd_bg-green btn btn-info"><span class="menu-icon"><i class="fa fa-fw fa-check"></i></span> Update</button>                              
            </div>
            <!-- col-sm-12 --> 
         </div>
         <!-- row --> 
      </div>
   </div>
</div>
</form>
<!-- Panel Widget --> 
<?php endforeach; ?>
</div>
<!-- .vd_content-section --> 
</div>
<!-- .vd_content --> 
</div>
<!-- .vd_container --> 
</div>
<!-- .vd_content-wrapper -->
<script type="text/javascript">
   $().ready(function () {
       $.validator.setDefaults({
           submitHandler: function (form) {
               form.submit();
           }
       });
       $("#edit_profile").validate({
           rules: {
               mobile: "required",
               address: "required",
               city: "required",
               zip_code: "required",
               dob: "required",
               userfile: {
                   extension: 'gif|jpg|png|jpeg',
               }
           },
           messages: {
               mobile: "Enter mobile no",
               address: "Enter address",
               city: "Enter city",
               zip_code: "Enter zipcode",
               dob: "Select date of birth",
               userfile: {
                   extension: 'upload valid image',
               }
           }
       });
   });
</script>
<script type="text/javascript">
   $(function () {
       $("#upload_link").on('click', function (e) {
           e.preventDefault();
           $("#upload:hidden").trigger('click');
       });
   });
   function readURL(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();
   
           reader.onload = function (e) {
               $('#manage_profile').attr('src', e.target.result);
           }
           reader.readAsDataURL(input.files[0]);
       }
   }
   
   $("#upload").change(function () {
       readURL(this);
   });
</script>
<script type="text/javascript">
   $(document).ready(function () {
       $(".datepicker-normal").datepicker({
           format: ' MM d, yyyy', autoclose: true,
           startDate: new Date(),
           changeMonth: true,
           changeYear: true
   
       });
   });
   
</script>