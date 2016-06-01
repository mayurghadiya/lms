<?php
$std_id = $this->session->userdata('std_id');
$res = $this->db->query("SELECT * FROM participate_manager WHERE pp_id not in (select pp_id from participate_student where student_id=$std_id )")->result_array();
?>
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
                <?php
                if ($this->session->flashdata('flash_message')) {
                    echo $this->session->flashdata('flash_message');
                }
                ?>                                        
                <?php echo form_open(base_url() . 'student/volunteer/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'frmproject', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Participate Title <span style="color:red">*</span></label>
                    <div class="col-sm-5">
                        <select class="form-control" id="pp_id" name="pp_id">
                            <option value="<?php ?>" > Select  </option>
                            <?php foreach ($res as $rs): ?>
                                <option value="<?php echo $rs['pp_id']; ?>" ><?php echo $rs['pp_title']; ?>  </option>
                            <?php endforeach; ?>

                        </select>

                    </div>
                    <input type="hidden" name="std_id" value="<?php echo $this->session->userdata('std_id'); ?>" />                                              
                </div>
                <div class="form-group"  id="description">



                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Date Of Participate </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="dos" readonly="" value="<?php
                        if (!empty($res)) {
                            echo $res[0]['pp_dos'];
                        }
                        ?>" id="dos" />
                    </div>


                </div>


                <input type="hidden" name="p_status" value="1" checked=""  >

                <div class="form-group">
                    <label class="col-sm-3 control-label">Comment</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" name="comment" id="std_about" ></textarea>
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <?php echo form_close(); ?>

            </div>
            <!-- col-lg-12 end here -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End contentwrapper -->
</div>


 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<!-- End #content -->
    <script type="text/javascript">
        
        $("#pp_id").change(function(){
            var pp_id = $(this).val();
           $.ajax({
              type:"POST" ,
              url:"<?php echo base_url(); ?>student/get_desc",
              data:{'pp_id':pp_id},
              success:function(response)
              {
                 $("#description").html(response);
              }    
               
           }); 
        });
       

                                                    $.validator.setDefaults({
                                                        submitHandler: function (form) {

                                                            //  filecheck(img);
                                                            form.submit();

                                                        }
                                                    });

                                                    $().ready(function () {
                                                        

                                                       
                                                        $("#frmproject").validate({
                                                            rules: {
                                                                pp_id:"required",
                                                                p_status:"required",                                                               
                                                            },
                                                            messages: {
                                                                pp_id:"Please select participation",
                                                                p_status:"Please select your interest",                                                                        
                                                               
                                                            }
                                                        });
                                                    });
    </script>
