$(document).ready(function () {

    // datatable 
    var t = $('#datatable-list').DataTable({
        "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
        "order": [[1, 'asc']],
    });

    t.on('order.dt search.dt', function () {
        t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    //student search
    $("form#frmstudentlist #filterdegree").change(function () {
        var degree = $(this).val();
        var dataString = "degree=" + degree;
        $.ajax({
            type: "POST",
            url: base_url + "admin/get_cource/student",
            data: dataString,
            success: function (response) {
                $("form#frmstudentlist #filtercourse").html(response);
            }
        });
    });

    $("form#frmstudentlist #filtercourse").change(function () {
        var course = $(this).val();
        var degree = $("#filterdegree").val();
        var dataString = "course=" + course + "&degree=" + degree;
        $.ajax({
            type: "POST",
            url: base_url + "admin/get_batchs/student",
            data: dataString,
            success: function (response) {
                $("form#frmstudentlist #filterbatch").html(response);

                $.ajax({
                    type: "POST",
                    url: base_url + "admin/get_semester",
                    data: dataString,
                    success: function (response1) {
                        $("form#frmstudentlist #filtersemester").html(response1);
                    }
                });
            }
        });
    });

    $.validator.setDefaults({
        submitHandler: function (form) {
            form.submit();

        }
    });

    var form = $("#frmstudentlist");

    $("form#frmstudentlist #btnsubmit").click(function () {
        $("form#frmstudentlist").validate({
            rules: {
                filterdegree: "required",
                filtercourse: "required",
                filterbatch: "required",
                filtersemester: "required",
                filterclass: "required",
            },
            messages: {
                filterdegree: "Select department",
                filtercourse: "Select branch",
                filterbatch: "Select batch",
                filtersemester: "Select semester",
                filterclass: "Select class",
            }
        });

        if (form.valid() == true)
        {
            var degree = $("form#frmstudentlist #filterdegree").val();
            var course = $("form#frmstudentlist #filtercourse").val();
            var batch = $("form#frmstudentlist #filterbatch").val();
            var sem = $("form#frmstudentlist #filtersemester").val();
            var divclass = $("form#frmstudentlist #filterclass").val();
            $.ajax({
                url: base_url + 'admin/get_filter_student',
                type: 'POST',
                data: {'batch': batch, 'sem': sem, 'course': course, 'degree': degree, 'divclass': divclass},
                success: function (content) {
                    $("#filterdata").html(content);
                    // $("#dtbl").hide();
                    $('#datatable-list').DataTable({
                        aoColumnDefs: [
                            {
                                bSortable: false,
                                aTargets: [-1]
                            }
                        ]
                    });
                }
            });
        }
    });

});


   $(function () {
                        "use strict";
                        $('#checkbox-0').click(function () {
                            if ($(this).is(':checked'))
                                $('.checkbox-group').prop('checked', true).closest("tr").addClass('row-warning');
                            else
                                $('.checkbox-group').prop('checked', false).closest("tr").removeClass('row-warning');
                        });

                        $('.checkbox-group').click(function () {
                            if ($(this).is(':checked'))
                                $(this).closest("tr").addClass('row-warning');
                            else
                                $(this).closest("tr").removeClass('row-warning')
                        });
                    });
                    $('#summernote').summernote({
        height: 200
    });