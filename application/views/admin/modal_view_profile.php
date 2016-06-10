<?php
if (count($professor))
    $degree = $this->db->get_where("degree", array("d_id" => $professor[0]->department))->result();
$course = $this->db->get_where("course", array("course_id" => $professor[0]->branch))->result();
?>


<div class="row">

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->            
            <div class=panel-body>
                <table class="table table-striped table-bordered table-responsive" id="data-tables">

                    <tbody>
                        <tr>
                            <td><strong>Image</strong></td>
                            <td><?php if ($professor[0]->image_path != "") { ?> 
                                    <img src="<?php echo base_url() . 'uploads/professor/' . $professor[0]->image_path; ?>" height="100" width="100" />
                                <?php } else { ?>
                                    <img src="<?= base_url() ?>/uploads/no-image.jpg" height="100px" width="100px"/>
                                <?php } ?></td>
                        </tr>

                        <tr>		
                            <th>Professor Name</th> <td><?php echo $professor[0]->name; ?></td>						
                        </tr>
                        <tr>		
                            <th>Department </th><td><?php echo $degree[0]->d_name; ?></td>
                        </tr>
                        <tr>
                            <th>Branch </th>  <td><?php echo $course[0]->c_name; ?></td>
                        </tr>


                        <tr>
                            <th>Email </th>  <td><?php echo $professor[0]->email; ?></td>                  			
                        </tr>

                        <tr>
                            <th>Address </th>  <td><?php echo $professor[0]->address; ?></td>                  			
                        </tr>
                        <tr>
                            <th>Mobile No </th>  <td><?php echo $professor[0]->mobile; ?></td>                  			
                        </tr>
                        <tr>
                            <th>Birthdate </th>  <td><?php echo date_formats($professor[0]->dob); ?></td>                  			

                        </tr>
                        <tr>
                            <th>City </th>  <td><?php echo $professor[0]->city; ?></td>                  			
                        </tr>

                        <tr>
                            <th>Occupation </th>  <td><?php echo $professor[0]->occupation; ?></td>                  			
                        </tr>

                        <tr>
                            <th>Designation </th>  <td><?php echo $professor[0]->designation; ?></td>                  			
                        </tr>

                        <tr>
                            <th>About </th>  <td><?php echo $professor[0]->about; ?></td>                  			
                        </tr>





                    </tbody>
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