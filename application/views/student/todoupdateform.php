<div class="todo-addform col-sm-5" id="todo-updateform"  >

    <form id="frmtodoedit">
        <div class=form-group>
            <label class="col-lg-2 col-md-3 control-label">Task Title</label>
            <input type="text" id="todo_titleedit" class=form-control name="todo_title" value="<?php echo $todolist->todo_title; ?>" >
            <input type="hidden" value="<?php echo $todolist->todo_id; ?>" id="todo_id">
        </div>

        <div class=form-group>
            <label class="col-lg-2 col-md-3 control-label">Task Date</label>
            <input id="basic-datepickeredit" type="text" name="tado_date" class="form-control"  value="<?php echo date("m/d/Y", strtotime($todolist->todo_datetime)); ?>" readonly="" >
        </div>
        <div class=form-group>
            <label class="col-lg-2 col-md-3 control-label">Task Time</label>
            <div class="col-lg-5 col-md-5">
                <div class="input-group bootstrap-timepicker">
                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                    <input id="minute-step-timepickeredit" name="todo_time" type="text" class="form-control" value="<?php echo date("h:i A", strtotime($todolist->todo_datetime)); ?>" readonly="" >
                </div>
            </div>
        </div>

        <div class=form-group>

            <input type="button" class="btn btn-primary" name="submit" value="Update Task" id="updatebutton" >
        </div>
    </form>
</div>

<script type="text/javascript">      
  
        
        $(document).ajaxStart(function () {
            $("#wait").css("display", "block");
        });
        $(document).ajaxComplete(function () {
            $("#wait").css("display", "none");
        });
        $("#basic-datepickeredit").datepicker({
            dateFormat: ' MM dd, yy',
            minDate: '0 days',
            autoclose: true,
        });

        $('#minute-step-timepickeredit').timepicker({
            upArrowStyle: 'fa fa-angle-up',
            downArrowStyle: 'fa fa-angle-down',
            minuteStep: 30,
            autoclose: true,
        });

        $("#frmtodoedit #updatebutton").click(function ()
        {
          
            var title = $("#todo_titleedit").val();
            var todo_date = $("#basic-datepickeredit").val();
            var todo_time = $("#minute-step-timepickeredit").val();
            if (title != "" && todo_date != "" && todo_time != "")
            {
                var todo_id = $("#todo_id").val();
                var dataString = "title=" + title + "&todo_date=" + todo_date + "&todo_time=" + todo_time + "&todo_id=" + todo_id;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>student/updatetodolist",
                    data: dataString,
                    success: function (response) {
                        $(".todo-list").html(response);
                        $("#updateformhtml").html('');
                    }

                });
            } else {
                if (title == "")
                {
                    $("#todo_titleedit").css('border-color', 'red');
                } else {
                    $("#todo_titleedit").css('border-color', '#ccc');
                }
                if (todo_date == "")
                {
                    $("#basic-datepickeredit").css('border-color', 'red');

                } else {
                    $("#basic-datepickeredit").css('border-color', '#ccc');
                }
                if (todo_time == "")
                {
                    $("#minute-step-timepickeredit").css('border-color', 'red');

                } else {
                    $("#minute-step-timepickeredit").css('border-color', '#ccc');
                }
            }

        });


</script>