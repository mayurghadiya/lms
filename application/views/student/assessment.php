<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
         
            <div class=panel-body>
                <table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="datatable-list">
                     <thead>
                        <tr>
                            <th>#</th>		
                             <th>Assignment</th>                                                
                            <th>Assign. File</th>
                            <th>Submitted File</th>                            
                            <th>Instruction</th>
                            <th>Feedback</th>                                                
                            <th>Grade</th>	
                        </tr>
                    </thead>

                    <tbody>
                        <?php                       
                        $count = 1;
                        foreach ($assessment->result_array() as $row):
                            
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>	
                                 <td><?php echo $row['assign_title']; ?></td>                                 
                                <td id="downloadedfile"><a href="<?php echo $row['assign_url']; ?>" download="" title="<?php echo $row['assign_title']; ?>"><i class="fa fa-download"></i></a></td>	
                                <td id="downloadedfile"><a href="<?php echo base_url().'uploads/project_file/'.$row['document_file']; ?>" download=""><i class="fa fa-download"></i></a></td>	                              
                                <td><?php echo $row['assignment_instruction']; ?></td>	
                                <td><?php echo wordwrap($row['feedback'], 30, "<br>\n"); ?></td>                                                   
                                <td><?php echo $row['grade']; ?></td>                                                   
                            </tr>
                        <?php endforeach; ?>																									
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery.validate.min.js"></script>

<script>
    $(document).ready(function () {
        $('#data-tables1').dataTable();
    })

</script>