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
            <div class="panel-body">
                <form class="form-horizontal form-groups-bordered validate" 
                      action="<?php echo base_url('student/pay_online_vocational_course'); ?>" id="frmvoc_fee" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default panel-shadow" data-collapsed="0">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Invoice Information</h4>
                                </div>

                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?php echo $this->session->userdata('name'); ?>" name="title" disabled/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Note</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="description"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Date</label>
                                        <div class="col-sm-9">
                                            <div class="input-group date ebro_datepicker" data-date-format="yyyy-M-dd">
                                                <input type="text" id="datepicker-normal"  class="form-control" name="date" />
                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default panel-shadow" data-collapsed="0">
                                <div class="panel-heading">
                                    <h4  class="panel-title">Payment Information</h4>
                                </div>
                                <div class="panel-body">

                                    <div class="form-group">
                                        <div class="col-sm-9">
                                            <input type="hidden" name="voc_course" id="voc_course" value="<?php echo $vocationalcourse[0]['vocational_course_id'] ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Vocational course name</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" id="coursename" name="coursename" class="form-control" value="<?php echo $vocationalcourse[0]['course_name'] ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Total Fees</label>
                                        <div class="col-sm-9">
                                            <input type="text" readonly="" id="total_fees" name="total_fees" class="form-control" value="<?php echo $vocationalcourse[0]['course_fee'] ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Amount</label>
                                        <div class="col-sm-9">
                                            <input type="text"  pattern="(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)" id="amount" class="form-control" name="amount"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Method</label>
                                        <div class="col-sm-9">
                                            <select name="method" class="form-control">
                                                <option value="">Select</option>
                                                <option value="paypal">Paypal</option>
                                                <option value="authorize.net">Authorize.net</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <button type="submit" class="btn btn-info">Pay Online</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- row --> 
        </div>
    </div>
        <script>
            $(document).ready(function () {
                //       $('#course').on('change', function () {
                //           
                //           var id=$(this).val();
                //            $.ajax({
                //                url: '<?php echo base_url(); ?>index.php?student/get_vocational_fee' ,
                //                type: 'post',
                //                dataType:'json',
                //                data:
                //                {
                //                 'id':id,   
                //                },    
                //                success: function (result) {
                //                    
                //                    $("#total_fees").val(result[0].course_fee);
                //                }
                //            })
                //         });
                //         

            })
        </script>

        <!-- Start validation -->
       <script type="text/javascript">
            
            $().ready(function () {
                $("#frmvoc_fee").validate({
                    rules: {
                        date: "required",
                        amount: {
                            required: true,
                             equalTo: "#total_fees"
                        },
                        method: "required",
                    },
                    messages: {
                        date: "Select date",
                        amount:{
                              required:"Enter amount",
                              equalTo:"Enter amount equal to total fee",
                            },
                        method: "Select payment method",
                    }
                });
            });
        </script>

        <!-- End validation -->
        <script type="text/javascript">
            $(window).load(function ()
            {
                "use strict";
                $("#datepicker-normal").datepicker({
                    format: 'M d, yyyy',
                    changeMonth: true,
                    changeYear: true,
                    autoclose: true,
                });
            });
        </script>