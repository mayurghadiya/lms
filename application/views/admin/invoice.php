<!-- Start .row -->
<div class="row printable">
    <div class=col-md-12>
        <!-- col-md-12 start here -->
        <div class="panel-default invoice">
            <!--            <div class="panel-heading clearfix">
                            <h4 class="panel-title pull-left"><span><?php echo $title; ?></span></h4>
                            <div class=print><a href=# class=tip title="Print invoice"><i class="s24 icomoon-icon-print"></i></a></div>
                            <div class=invoice-info>
                                <span class=number>Invoice <strong class=color-red>#<?php echo 'INV-' . date('dmYhis', strtotime($invoice->paid_created_at)); ?></strong></span> <span class="data color-gray"><?php echo date('M d, Y'); ?></span>
                                <div class=clearfix></div>
                            </div>
                        </div>-->
            <div class=panel-body>
                <div class=you>
                    <ul class=list-unstyled>
                        <li>
                            <h4>Lore Brain</h4>
                        </li>
                        <li><i class="s16 icomoon-icon-arrow-right-3"></i><strong>Address:</strong> 207, campus corner 2 , Opp. Prahladnagar Garden, <br/><span style="margin-left: 25px;"></span>Anandnagar road, Prahladnagar, Ahmedabad 380015</li>
                        <li><i class="s16 icomoon-icon-arrow-right-3"></i><strong>City: </strong>Ahmedabad</li>
                        <li><i class="s16 icomoon-icon-arrow-right-3"></i><strong>Region/State: </strong>Gujarat</li>
                        <li><i class="s16 icomoon-icon-arrow-right-3"></i><strong>Zip/Postal Code: </strong>380015</li>
                        <li><i class="s16 icomoon-icon-arrow-right-3"></i><strong>Phone:</strong> <strong class=color-red>+919909978808</strong></li>
                        <li><i class="s16 icomoon-icon-arrow-right-3"></i><strong>Email: </strong> <strong class=color-red>sales@searchnative.in</strong></li>
                    </ul>
                </div>
                <div class=client>
                    <ul class=list-unstyled>
                        <li>
                            <h4>Student Details</h4>
                        </li>
                        <li><i class="s16 icomoon-icon-arrow-right-3"></i><strong>Student Name:</strong> <?php echo $invoice->std_first_name . ' ' . $invoice->std_last_name; ?></li>
                        <li><i class="s16 icomoon-icon-arrow-right-3"></i><strong>Email: </strong><?php echo $invoice->email; ?><br></li>
                        <li><i class="s16 icomoon-icon-arrow-right-3"></i><strong>Mobile: </strong><?php echo $invoice->std_mobile; ?></li>
                        <li><i class="s16 icomoon-icon-arrow-right-3"></i><strong>Due Amount: </strong>$<?php echo $due_amount; ?></li>
                    </ul>
                </div>
                <div class=clearfix></div>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:20px;">SR</th>
                            <th>TITLE</th>
                            <th>TOTAL PRICE</th>
                            <th>PREVIOUS TOTAL PAID</th>
                            <th class="text-right" style="width:120px;">CURRENT PAY</th>
                            <th class="text-right" style="width:120px;">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>                                               
                        <tr>
                            <td class="text-center">1</td>
                            <td><?php echo $invoice->title; ?></td>
                            <td>$<?php echo $invoice->total_fee; ?></td>
                            <td class="text-left">$<?php echo $total_paid - $invoice->paid_amount; ?></td>
                            <td class="text-left">$<?php echo $invoice->paid_amount; ?></td>
                            <td class="text-right">$<?php echo $invoice->paid_amount; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class=payment>
                    
                </div>
                <div class=total>
                    <h4>Total amount:<span class=color-red> $<?php echo $invoice->paid_amount; ?></span></h4>
                </div>
                <div class=clearfix></div>
                <div class=invoice-footer style="visibility: hidden">
                    <p>Thank you for your order, you will receive <strong class=color-green>5%</strong> discount in next order.</p>
                </div>
            </div>
        </div>
		
        <!-- End .panel -->
    </div>
    <!-- col-md-12 end here -->
</div>
<!-- End .row -->

