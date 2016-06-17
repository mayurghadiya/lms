<table class="table table-striped table-bordered table-responsive" id="exam-data-tables">
    <thead>
        <tr>
            <th>No</th>
            <th>Exam Name</th>
            <th>Department</th>
            <th>Branch</th>
            <th>Batch</th>
            <th>Semester</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $counter = 0;
        foreach ($exams as $row) {
            $counter++;
            $cenlist = array();
            ?>
            <tr>
                <td><?php echo $counter; ?></td>
                <td><?php echo $row->em_name; ?></td>
                <td><?php echo $row->d_name; ?></td>
                <td><?php echo $row->c_name; ?></td>
                <td><?php echo $row->b_name; ?></td>
                <td><?php echo $row->s_name; ?></td>
                <td><?php echo date('F d, Y', strtotime($row->em_date)); ?></td>
                <td class="menu-action">
                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_exam/<?php echo $row->em_id; ?>');"  data-toggle="tooltip" data-placement="top"><span class="label label-primary mr6 mb6">
<i class="fa fa-pencil" aria-hidden="true"></i>
Edit
</span></a>
                    <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>professor/exam/delete/<?php echo $row->em_id; ?>');"  data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6">
<i class="fa fa-trash-o" aria-hidden="true"></i>
Delete
</span></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
