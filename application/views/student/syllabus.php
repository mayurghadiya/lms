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
            <!------CONTROL TABS END------>

            <div class="tab-content">
                <!----TABLE LISTING STARTS-->
                <div class="tab-pane box active" id="list">		


                    <div class="panel-body table-responsive" id="getresponse">                                                                     
                        <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                            <thead>
                                <tr>
                                    <th>#</th>												
                                    <th><?php echo ucwords("Syllabus Title"); ?></th>
                                    <th><?php echo ucwords("Description"); ?></th>
                                    <th><?php echo ucwords("File"); ?></th>                                            

                                </tr>
                            </thead>
                            <tbody>                                           
                                <?php
                                $count = 1;
                                foreach (@$syllabus as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>	

                                        <td><?php echo $row->syllabus_title; ?></td>	

                                        <td><?php echo wordwrap($row->syllabus_desc, 30, "<br>\n"); ?></td>
                                        <td id="downloadedfile"><a href="<?php echo base_url() . 'uploads/syllabus/' . $row->syllabus_filename; ?>" download="" title="<?php echo $row->syllabus_title; ?>"><i class="fa fa-download"></i></a></td>	                                                  

                                    </tr>
<?php endforeach; ?>						
                            </tbody>
                        </table>
                    </div>    
                </div>


                <!----TABLE LISTING ENDS--->

            </div>
        </div>
    </div>
</div>
