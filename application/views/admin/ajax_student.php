<table id="datatable-list2" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
    <thead>
        <tr>
            <th>#</th>	
            <th>Image</th>
            <th>Student Name</th>												
            <th>Email</th>												
            <th>Mobile</th>												
            <th>Action</th>	
        </tr>
    </thead>

    <tbody>
        <?php foreach ($datastudent as $row): ?>
            <tr>
                <td></td>
                <td>
                    <?php if ($row->profile_photo != '') { ?>
                        <img src="<?= base_url() ?>uploads/student_image/<?= $row->profile_photo; ?>" height="70px" width="70px"/>
                        <?php
                    } else {
                        if ($row->std_gender == 'Male') {
                            ?>
                            <img src="<?= base_url() ?>uploads/student_image/male.jpg" height="70px" width="70px"/>
                        <?php } else { ?>
                            <img src="<?= base_url() ?>uploads/student_image/female.jpg" height="70px" width="70px"/>
                            <?php
                        }
                    }
                    ?>
                </td>										
                <td><?php echo $row->std_first_name . " " . $row->std_last_name; ?></td>					
                <td><?php echo $row->email; ?></td>											
                <td><?php echo $row->std_mobile; ?></td>											
                <td class="menu-action">	
                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_student/<?php echo $row->std_id; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span></a>

                </td>											
            </tr>
        <?php endforeach; ?>																			
    </tbody>
</table>
<script>
    var t = $('#datatable-list2').DataTable({
        "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
        "order": [[2, 'asc']],
    });

    t.on('order.dt search.dt', function () {
        t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

</script>