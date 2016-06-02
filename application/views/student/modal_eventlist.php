<?php
$dataevent=$this->db->get_where('event_manager',array('date(event_date)'=>$param2))->result_array();
$datatodo=$this->db->get_where('todo_list',array('date(todo_datetime)'=>$param2,'todo_role'=>'student','todo_role_id'=>$this->session->userdata('student_id')))->result_array();
   
?>
<div class=row>                      
        <div class=col-lg-12>
            <!-- col-lg-12 start here -->
            <div class="panel-default toggle panelMove panelClose panelRefresh">
                 <h4 class=panel-title><?php echo ucwords("event list"); ?></h4>
                <!-- Start .panel -->
                <div class="panel-body"> 
                   <table id="datatable-list_event" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><?php echo ucwords("event name"); ?></th>
                            <th><?php echo ucwords("start date"); ?></th>
                            <th><?php echo ucwords("end date"); ?></th>
                            <th><?php echo ucwords("location"); ?></th>
                            <th><?php echo ucwords("description"); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i=1;
                        foreach ($dataevent as $row):
                            ?>
                            <tr>
                                <td><?php echo $i++;?></td>
                                <td><?php echo $row['event_name']; ?></td>                         
                                <td><?php echo date('d-m-Y', strtotime($row['event_date'])); ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['event_end_date'])); ?></td>
                                <td><?php echo $row['event_location']; ?></td> 
                                <td><?php echo $row['event_desc']; ?></td> 
                            </tr>
                        <?php endforeach; ?>						
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>


<div class=row>                      
        <div class=col-lg-12>
            <!-- col-lg-12 start here -->
            <div class="panel-default toggle panelMove panelClose panelRefresh">
                <h4 class=panel-title><?php echo ucwords("todo list"); ?></h4>
                <!-- Start .panel -->
                <div class="panel-body"> 
                   <table id="datatable-list_todo" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><?php echo ucwords("todo list title"); ?></th>
                            <th><?php echo ucwords("date"); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $i=1;
                        foreach ($datatodo as $row):
                            ?>
                            <tr>
                                <td><?php echo $i++;?></td>
                                <td><?php echo $row['todo_title']; ?></td>                         
                                <td><?php echo date('d-m-Y', strtotime($row['todo_datetime'])); ?></td>
                            </tr>
                        <?php endforeach; ?>						
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

<script>
 $(document).ready(function () {
        $('#datatable-list_event').DataTable();
    });
</script>

<script>
 $(document).ready(function () {
        $('#datatable-list_todo').DataTable();
    });
</script>