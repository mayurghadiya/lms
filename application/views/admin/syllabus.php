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
                        <!------CONTROL TABS END------>

                        <div class="tab-content">
                            <!----TABLE LISTING STARTS-->
                            <div class="tab-pane box active" id="list">		
                                
                                 <div class="form-group col-sm-2">
                                    <label><?php echo ucwords("department");?></label>
                                    <select class="form-control filter-rows" id="filter2" data-filter="2" data-type="course">
                                        <option value="">All</option>
                                        <?php foreach ($degree as $row) { ?>
                                            <option value="<?php echo $row->d_name; ?>"
                                                    data-id="<?php echo $row->d_id; ?>"><?php echo $row->d_name; ?></option>
                                                <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label><?php echo ucwords("Branch");?></label>
                                    <select id="filter3" name="branch" data-filter="3" class="form-control filter-rows" data-type="branch">
                                        <option value="">All</option>
                                    </select>
                                </div>                                                             
                                <div class="form-group col-sm-2">
                                    <label> <?php echo ucwords("Semester");?></label>
                                    <select id="filter4" name="semester" data-filter="4" class="form-control filter-rows" data-type="semester">
                                        <option value="">All</option>

                                    </select>
                                </div>                        
                               <div class="panel-body table-responsive" id="getresponse">
                                   <a class="links"  onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addsyllabus/');" href="#" id="navfixed" data-toggle="tab">Add Syllabus</a>
                                    <table class="table table-striped" id="datatable-list">
                                        <thead>
                                            <tr>
                                                <th><div>#</div></th>												
                                                <th><div><?php echo ucwords("Syllabus Title");?></div></th>
                                                <th><div><?php echo ucwords("department");?></div></th>
                                                <th><div><?php echo ucwords("Branch");?></div></th>												                                                
                                                <th><div><?php echo ucwords("Semester");?></div></th>
                                                <th><div><?php echo ucwords("Description");?></div></th>
                                                <th><div><?php echo ucwords("File");?></div></th>                                            
                                                <th><div><?php echo ucwords("Action");?></div></th>											
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 1;
                                            foreach (@$syllabus as $row):
                                                ?>
                                                <tr>
                                                    <td><?php echo $count++; ?></td>	
                                                   	
                                                    <td><?php echo $row->syllabus_title; ?></td>	
                                                     <td><?php foreach($degree as $dgr): 
                                                        if($dgr->d_id==$row->syllabus_degree):
                                                            
                                                            echo $dgr->d_name;
                                                        endif;
                                                        
                                                    
                                                        endforeach;
                                                    ?></td>
                                                    <td>
                                                        <?php
                                                        foreach ($course as $crs) {
                                                            if ($crs->course_id == $row->syllabus_course) {
                                                                echo $crs->c_name;
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                   
                                                    <td>
                                                        <?php
                                                        foreach ($semester as $sem) {
                                                            if ($sem->s_id == $row->syllabus_sem) {
                                                                echo $sem->s_name;
                                                            }
                                                        }
                                                        ?>													
                                                    </td>	
                                                     <td><?php echo  wordwrap($row->syllabus_desc,30,"<br>\n");?></td>
                                                     <td id="downloadedfile"><a href="<?php echo base_url().'uploads/syllabus/'.$row->syllabus_filename; ?>" download="" title="<?php echo $row->syllabus_title; ?>"><i class="fa fa-download"></i></a></td>	                                                  
                                                    <td class="menu-action">
                                                        <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_syllabus/<?php echo $row->syllabus_id; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6">Edit</span></a>

                                                        <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/syllabus/delete/<?php echo $row->syllabus_id; ?>');" data-original-title="Remove" data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6">Delete</span></a>	
                                                    </td>	
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
            
    <script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.js"></script>
    <script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.validate.min.js"></script>
  

<script type="text/javascript">
	$(document).ready(function() {
		"use strict";				
		$('#data-tabless').DataTable( {
             aoColumnDefs: [
                {
                   bSortable: false,
                   aTargets: [ -1 ]
                }
              ]
        } );

	} );
</script>
 <script type="text/javascript">
        $(document).ready(function () {
            "use strict";
            $('#assignment-list').dataTable({
                "order": [[7, "desc"]],
                "dom": "<'row'<'col-sm-6'><'col-sm-6'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-4'l><'col-sm-4'i><'col-sm-4'p>>",
            });
            $('.filter-rows').on('change', function () {
                var filter_id = $(this).attr('data-filter');
                filter_column(filter_id);
            });

            function filter_column(filter_id) {
                $('#assignment-list').DataTable().column(filter_id).search(
                        $('#filter' + filter_id).val()
                        ).draw();
            }
        });
    </script>

    <style>
        #assignment-list_filter{
            margin-top: -50px;
        }
    </style>
    
 <script type="text/javascript">
        $(document).ready(function () {
            "use strict";
            $('#sub-tables').dataTable({
                "order": [[7, "desc"]],
                "dom": "<'row'<'col-sm-6'><'col-sm-6'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-4'l><'col-sm-4'i><'col-sm-4'p>>",
            });
            $('.sfilter-rows').on('change', function () {
                var filter_id = $(this).attr('data-filter');
                filter_column(filter_id);
            });

            function filter_column(filter_id) {
                $('#sub-tables').DataTable().column(filter_id).search(
                        $('#sfilter' + filter_id).val()
                        ).draw();
            }
        });
    </script>

    <style>
        #sub-tables_filter{
            margin-top: -50px;
        }
    </style>
   
      <style>
    .nav-fixedtabs {
    left: 86%;
    position: fixed;
    top: 25%;
    }
    #navfixed{
        cursor: pointer;
    }
    
    </style>
    