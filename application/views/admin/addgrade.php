<div class="row">
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <!--            <div class=panel-heading>
                            <h4 class=panel-title>Add Exam Grade</h4>
                        </div>-->
            <div class=panel-body>
                <?php echo form_open(base_url() . 'admin/grade/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'gradeform', 'target' => '_top')); ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("Grade Name"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-5">
                        <input id="grade_name" class="form-control" type="text" name="grade_name"/>
                    </div>	
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("From Percentage"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" name="from_marks" id="from_marks" min="0"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("To Percentage"); ?><span style="color:red">*</span></label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" name="to_marks" id="to_marks"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucwords("Description"); ?></label>
                    <div class="col-sm-5">	
                        <div class="chat-message-box">
                            <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info vd_bg-green"><?php echo ucwords("Add"); ?></button>
                    </div>
                </div> 
                <?php echo form_close(); ?>
            </div>
        </div>
        <!-- End .panel -->
    </div>
    <!-- col-lg-12 end here -->
</div>