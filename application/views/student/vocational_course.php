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

            <div class="panel-body table-responsive">
                <div class="tabs mb20">
                    <ul id="import-tab" class="nav nav-tabs">
                        <li class="active">
                            <a href="#list" data-toggle="tab" aria-expanded="true">Vocational Course</a>
                        </li>
                        <li class="">
                            <a href="#register" data-toggle="tab" aria-expanded="false">Registered Course</a>
                        </li>
                    </ul>
                    
                     <div id="import-tab-content" class="tab-content">
                         <div class="tab-pane fade active in" id="list">
                <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo ucwords("course name"); ?></th>
                            <th><?php echo ucwords("category"); ?></th>
                            <th><?php echo ucwords("course start date"); ?></th>
                            <th><?php echo ucwords("course end date"); ?></th>
                            <th><?php echo ucwords("course fee"); ?></th>
                            <th><?php echo ucwords("professor name"); ?></th>
                            <th><?php echo ucwords("action"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($vocationalcourse as $row):
                            ?><tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['course_name']; ?></td>   
                                <td><?php
                                    $categories = $this->db->get('course_category')->result();
                                    foreach ($categories as $category) {

                                        if ($category->category_id == $row['category_id']) {
                                            echo $category->category_name;
                                        }
                                    }
                                    ?></td>    
                                <td><?php echo date('F d, Y', strtotime($row['course_startdate'])); ?></td>    
                                <td><?php echo date('F d, Y', strtotime($row['course_enddate'])); ?></td>    
                                <td><?php echo $row['course_fee']; ?></td>   
                                <td><?php
                                    $professor = $this->db->get('professor')->result_array();
                                    foreach ($professor as $pro) {
                                        if ($pro['professor_id'] == $row['professor_id']) {
                                            echo $pro['name'];
                                        }
                                    }
                                    ?></td>   

                                <td class="menu-action">
                                    <a href="<?php echo base_url(); ?>student/vocationalcourse/register/<?php echo $row['vocational_course_id']; ?>"  data-original-title="" data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6">Register Now</span></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                             </div>
                         <div class="tab-pane fade out" id="register">
                             <table id="datatable-list-course" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo ucwords("course name"); ?></th>
                            <th><?php echo ucwords("category"); ?></th>
                            <th><?php echo ucwords("course start date"); ?></th>
                            <th><?php echo ucwords("course end date"); ?></th>
                            <th><?php echo ucwords("course fee"); ?></th>
                            <th><?php echo ucwords("professor name"); ?></th>                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counts = 1;
                        foreach ($register as $rows):
                            ?><tr>
                                <td><?php echo $counts++; ?></td>
                                <td><?php echo $rows['course_name']; ?></td>   
                                <td><?php
                                    $categories = $this->db->get('course_category')->result();
                                    foreach ($categories as $category) {

                                        if ($category->category_id == $row['category_id']) {
                                            echo $category->category_name;
                                        }
                                    }
                                    ?></td>    
                                <td><?php echo date('F d, Y', strtotime($rows['course_startdate'])); ?></td>    
                                <td><?php echo date('F d, Y', strtotime($rows['course_enddate'])); ?></td>    
                                <td><?php echo $row['course_fee']; ?></td>   
                                <td><?php
                                    $professor = $this->db->get('professor')->result_array();
                                    foreach ($professor as $pro) {
                                        if ($pro['professor_id'] == $rows['professor_id']) {
                                            echo $pro['name'];
                                        }
                                    }
                                    ?></td>   
                               
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                         </div>
                     </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {
        $('#datatable-list-course').dataTable();
    })

</script>