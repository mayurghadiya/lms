<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
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
                <form id="fee-structure-search" action="#" class="form-groups-bordered validate">
                    <div class="form-group col-sm-3">
                        <label><?php echo ucwords("department"); ?></label>
                        <select class="form-control" id="search-degree"name="degree">
                            <option value="">Select</option>
                            <?php foreach ($degree as $row) { ?>
                                <option value="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label><?php echo ucwords("Branch"); ?></label>
                        <select id="search-course" name="course" data-filter="4" class="form-control">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label><?php echo ucwords("Batch"); ?></label>
                        <select id="search-batch" name="batch" data-filter="5" class="form-control">
                            <option value="">Select</option>
                        </select>
                    </div>                                
                    <div class="form-group col-sm-2">
                        <label> <?php echo ucwords("Semester"); ?></label>
                        <select id="search-semester" name="semester" data-filter="6" class="form-control">
                            <option value="">Select</option>

                        </select>
                    </div>
                    <div class="form-group col-sm-1">
                        <label>&nbsp;</label><br/>
                        <input id="search-fee-structure-data" type="button" value="Go" class="btn btn-info vd_bg-green"/>
                    </div>
                </form>

                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Department</th>
                            <th>Branch</th>
                            <th>Batch</th>
                            <th>Semester</th>
                            <th>Fee</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($fees_structure as $row) { ?>
                            <tr>
                                <td></td>
                                <td><?php echo $row->title; ?></td>
                                <td><?php echo $row->d_name; ?></td>
                                <td><?php echo $row->c_name; ?></td>
                                <td><?php echo $row->b_name; ?></td>
                                <td><?php echo $row->s_name; ?></td>
                                <td><?php echo $row->total_fee; ?></td>
                                <td class="menu-action">
                                    <a><span class="label label-primary mr6 mb6">Edit</span></a>
                                    <a><span class="label label-danger mr6 mb6">Delete</span></a>
                                </td>
                            </tr>
                        <?php } ?>														
                    </tbody>
                </table>
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