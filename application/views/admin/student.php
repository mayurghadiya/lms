<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
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
                <a class="links"  onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/add_student/');" href="#" id="navfixed" data-toggle="tab"><i class="fa fa-plus"></i> Student </a>
                <div class="row filter-row">
                <form id="frmstudentlist" name="frmfilterlist" action="#" enctype="multipart/form-data" class="form-vertical form-groups-bordered validate">
                    <div class="form-group col-sm-2">
                        <label ><?php echo ucwords("department"); ?><span style="color:red">*</span></label>
                        <select class="form-control filter-rows" name="filterdegree" id="filterdegree" >
                            <option value="">Select department</option>
                            <?php
                            $datadegree = $this->db->get_where('degree', array('d_status' => 1))->result();
                            foreach ($datadegree as $rowdegree) {
                                ?>
                                <option value="<?= $rowdegree->d_id ?>"><?= $rowdegree->d_name ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>	
                    <div class="form-group col-sm-2">
                        <label ><?php echo ucwords("Branch"); ?><span style="color:red">*</span></label>
                        <select class="form-control filter-rows" name="filtercourse" id="filtercourse" >
                            <option value="">Select Branch</option>

                        </select>
                    </div>
                    <div class="form-group col-sm-2">
                        <label><?php echo ucwords("Batch"); ?><span style="color:red">*</span></label>
                        <select name="filterbatch" id="filterbatch" class="form-control">
                            <option value="">Select batch</option>

                        </select>
                    </div>	
                    <div class="form-group col-sm-2">
                        <label><?php echo ucwords("Semester"); ?><span style="color:red">*</span></label>
                        <select class="form-control filter-rows" name="filtersemester" id="filtersemester" >
                            <option value="">Select semester</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-2">
                        <label><?php echo ucwords("Class"); ?><span style="color:red">*</span></label>
                        <select class="form-control filter-rows" name="filterclass" id="filterclass" >
                            <option value="">Select class</option>
                            <?php
                            $class = $this->db->get('class')->result_array();
                            foreach ($class as $c) {
                                ?>
                                <option value="<?php echo $c['class_id'] ?>"><?php echo $c['class_name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>    
                    <div class="form-group col-sm-2">
                        <label>&nbsp;</label><br/>
                        <input id="btnsubmit" type="button" value="Go" class="btn btn-info"/>
                    </div>
                </form>
                </div>
                <div class="panel-body table-responsive" >
                    <div id="filterdata" >

                    </div>

                </div>
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