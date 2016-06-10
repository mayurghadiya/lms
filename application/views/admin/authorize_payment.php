<div class="row">
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <div class=panel-heading>
                <h4 class=panel-title><?php echo $title; ?></h4>
                <div class="panel-controls panel-controls-right">
                    <a class="panel-refresh" href="#"><i class="fa fa-refresh s12"></i></a>
                    <a class="toggle panel-minimize" href="#"><i class="fa fa-plus s12"></i></a>
                    <a class="panel-close" href="#"><i class="fa fa-times s12"></i></a>
                </div>
            </div>
            <div class=panel-body>
                <?php echo form_open(base_url() . 'admin/authorize_net_make_payment', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'process_payment', 'target' => '_top')); ?>
                                              
                    <input type="hidden" name="amount" value="<?php echo $this->session->userdata('payment_data')['fees']; ?>" />
                    <div class="form-group">
                        <label class="col-md-3 control-label">Card Number<span style="color:red">*</span></label>
                        <div class="col-md-4">
                            <input type="text" id="card_number" class="form-control" name="card_number" required="">
                            <p id="card_status_details" class="hidden-md hidden-sm hidden-xs hidden-lg"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Card Holder Name<span style="color:red">*</span></label>
                        <div class="col-md-4">
                            <input type="text" id="card_holder_name" name="card_holder_name" class="form-control" parsley-trigger="change" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-email">Expiry Date<span style="color:red">*</span></label>
                        <div class="col-md-2">
                            <select id="month" name="month" class="form-control" parsley-trigger="change" required>
                                <option value="">Select month<span style="color:red">*</span></option>
                                <?php
                                for ($i = 1; $i < 13; $i++)
                                    print("<option value=" . date('m', strtotime('01.' . $i . '.2001')) . ">" . date('M', strtotime('01.' . $i . '.2001')) . "(" . date('m', strtotime('01.' . $i . '.2001')) . ")</option>");
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select id="year" name="year" class="form-control" parsley-trigger="change" required>
                                <option value="">Select Year<span style="color:red">*</span></option>
                                <?php
                                $cur_year = date('Y');
                                ?>
                                <?php
                                for ($i = $cur_year; $i <= 2050; $i++)
                                    print("<option val=" . $i . ">" . $i . "</option>");
                                ?>
                            </select>
                        </div>	                                                
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-email">CVV<span style="color:red">*</span></label>
                        <div class="col-md-4">
                            <input type="password" id="cvv" name="cvv" class="form-control" parsley-trigger="change" maxlength="3" required>
                        </div>
                    </div>
                    <div class="form-group">	 
                        <label class="col-md-3 control-label"></label>                                               
                        <div class="col-md-4">
                            <input class="btn btn-success" value="Submit" type="submit"></input>
                        </div>
                    </div>	                           
                </form>
            </div>
        </div>
        <!-- End .panel -->
    </div>
    <!-- col-lg-12 end here -->
</div>

<script type="text/javascript">
    $.validator.setDefaults({
        submitHandler: function (form) {
            form.submit();
        }
    });

    $(document).ready(function () {
        $("#process_payment").validate({
            rules: {
                card_number: "required",
                card_holder_name: "required",
                cvv: "required",
                month: "required",
                year: "required"
            },
            messages: {
                card_number: "Please enter card number",
                card_holder_name: "Please enter card holder name",
                cvv: "Please enter cvv",
                month: "Please select month",
                year: "Please select year"
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#card_number').on('blur', function () {
            var card_number = $(this).val();
            if (card_number == '') {
                $('#card_status_details').attr('class', 'hidden-xs hidden-sm hidden-md hidden-lg');
            }
            $.ajax({
                url: '<?php echo base_url(); ?>admin/verify_card_detail/' + card_number,
                type: 'post',
                success: function (content) {
                    var card_details = jQuery.parseJSON(content);
                    console.log(card_details.card_type);
                    if (card_details.status == 'false') {
                        $('#card_status_details').attr('class', 'visible-xs visible-sm	visible-md visible-lg error');
                        $('#card_status_details').html('Card: ' + card_details.card_type + '<br/>Invalid card number or details.');
                    } else if (card_details.status == 'true') {
                        $('#card_status_details').attr('class', 'visible-xs visible-sm	visible-md visible-lg warning');
                        $('#card_status_details').html('Card: ' + card_details.card_type);
                    }
                    //$('#card_status_details').attr('class', 'visible-xs visible-sm	visible-md visible-lg');
                    //$('#card_status_details').html('Card: ' + card_details.card_type);        				
                }
            })
        })
    })
</script>