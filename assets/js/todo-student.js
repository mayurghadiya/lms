
$(document).ready(function () {
    $(".todo-list").css({'overflow':'auto'});
     $("#minute-step-timepicker").val("");
    $("#todo-addform").hide();
    $("#basic-datepicker").datepicker({
        format: ' MM dd, yyyy',
        minDate: '0 days',
        autoclose: true,
    });

    //task-done

    $('#minute-step-timepicker').timepicker({
        upArrowStyle: 'fa fa-angle-up',
        downArrowStyle: 'fa fa-angle-down',
        minuteStep: 1
    });
    $(document).ajaxStart(function () {
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function () {
        $("#wait").css("display", "none");
    });

    $(".close").click(function () {
        var id = $(this).val();
        var dataString = "id=" + id;
        $.ajax({
            type: "POST",
            url: base_url+"student/removetodolist",
            data: dataString,
            success: function () {

            }

        });

    });

jQuery('#addnewtodo').on('click', function (event) {
        $("#updateformhtml").html('');
        $("#todo-addform").toggle('show');
        $("i", this).toggleClass("icomoon-icon-plus icomoon-icon-minus");
        $('#addbutton').val('Add New to do');
        $('#closeform').val('Close');
        $("#minute-step-timepicker").val("");
        $('#frmtodo #todo_title').val('');
        $('#frmtodo #basic-datepicker').val('');
    });

//    $("#addnewtodo").click(function () {
//        $("#updateformhtml").html('');
//        $("#todo-addform").show(500);
//
//    });
    $("#frmtodo").validate({
            rules: {
                todo_title: "required",
                tado_date: "required",
                todo_time:"required",                
            },
            messages: {
                todo_title: "Enter title",
                tado_date: "Select date",
                todo_time:"Select time",
            },
            
            submitHandler: function() {              
                var title = $("#todo_title").val();
                var todo_date = $("#basic-datepicker").val();   
                var todo_time = $("#minute-step-timepicker").val();
                if(todo_date=="")
                {
                     $("#basic-datepicker").css({'border-color':'red'});
                     return false;
                }
                        var dataString = "title=" + encodeURIComponent(title) + "&todo_date=" + todo_date + "&todo_time=" + todo_time;
                        $.post(base_url+"student/add_to_do", dataString
                         ,                        
                        function(data){                            
                          $(".todo-list").html(data);
                          $('#frmtodo #todo_title').val('');
                          $('#frmtodo #basic-datepicker').val('');
                        });
                    }
        });
    $(".taskstatus").click(function () {
        if ($(this).is(':checked'))
        {

            $(this).closest('li.todo-task-item').addClass('task-done');
            var id = $(this).val(); // todo id
            var dataString = "id=" + id + "&status=0";

            $.ajax({
                type: "POST",
                url: base_url+"student/changestatus",
                data: dataString,
                success: function () {

                }
            });

        } else {
            $(this).closest('li.todo-task-item').removeClass('task-done');

            var id = $(this).val(); // todo id
            var dataString = "id=" + id + "&status=1";

            $.ajax({
                type: "POST",
                url: base_url+"student/changestatus",
                data: dataString,
                success: function () {

                }
            });

        }

    });

    /**
     * Update ajax request
     */
    $(".updateclick").click(function () {

        var id = $(this).val();
        $.ajax({
            type: "GET",
            url: base_url+"student/todoupdateform/" + id,
            success: function (response)
            {
                $("#updateformhtml").html(response);
                $("#todo-addform").hide();
                $('.todo-close_box').css('pointer-events', 'none');
            }
        });
    });

    $("#closeform").click(function () {
        $("#todo-addform").hide(500);
    });
});
