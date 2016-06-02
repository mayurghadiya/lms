<?php
$data=$this->db->get_where('todo_list',array('date(todo_datetime)'=>$param2,'todo_role'=>'student','todo_role_id'=>$this->session->userdata('student_id')))->result_array();
   
?>
<div class=row>                      
        <div class=col-lg-12>
            <!-- col-lg-12 start here -->
            <div class="panel-default toggle panelMove panelClose panelRefresh">
                <!-- Start .panel -->
                <div class="panel-body"> 
                   <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
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
                        foreach ($data as $row):
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
        $('#datatable-list').DataTable();
    });
</script>