
<table class="table table-striped table-bordered table-responsive" cellspacing=0 width=100% id="data-tables">
    <thead>
        <tr>
            <th>No</th>											
            <th><?php echo ucwords("Subject Name"); ?></th>											
            <th><?php echo ucwords("Subject Code"); ?></th>								
            <th><?php echo ucwords("Action"); ?></th>										
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        foreach ($subject as $row):
            ?>
            <tr>
                <td><?php echo $count++; ?></td>	
                <td><?php echo $row->subject_name; ?></td>												
                <td><?php echo $row->subject_code; ?></td>						                                             
                <td class="menu-action">
                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_subject/<?php echo $row->sm_id; ?>');"  data-toggle="tooltip" data-placement="top" ><span class="label label-primary mr6 mb6"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span></a>
                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/subject/delete/<?php echo $row->sm_id; ?>');"  data-toggle="tooltip" data-placement="top" ><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>
                     <a href="<?php echo base_url(); ?>admin/subject_detail/<?php echo $row->sm_id; ?>" data-toggle="tooltip" data-placement="top" ><span class="label label-danger mr6 mb6">Subject Detail</span></a>
                </td>
            </tr>
        <?php endforeach; ?>						
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function () {
        $('#data-tables').dataTable({"language": { "emptyTable": "No data available" }});
    });
</script>
