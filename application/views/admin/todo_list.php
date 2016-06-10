

<div class="panel-default toggle panelClose panelRefresh panelMove">
    <!-- Start .panel -->
    <div class=panel-heading>
        <h4 class=panel-title>To Do List</h4>
    </div>
    <div class=panel-body>
        <div class=todo-widget>
            <!-- .todo-widget -->
            <div class=todo-header>
               
                <div class="todo-addform col-sm-5" id="todo-addform"  >
                    <form id="frmtodo">
                        <div class=form-group>
                            <label class="col-lg-2 col-md-3 control-label">Task Title</label>
                            <input type="text" id="todo_title" class=form-control name="todo_title" >
                        </div>

                        <div class=form-group>
                            <label class="col-lg-2 col-md-3 control-label">Task Date</label>
                            <input id="basic-datepicker" type="text" name="tado_date" class="form-control">
                        </div>
                        <div class=form-group>
                            <label class="col-lg-10 col-md-5">Task Time</label>
                            <div class="col-lg-5 col-md-5">
                                <div class="input-group bootstrap-timepicker">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                    <input id="minute-step-timepicker" name="todo_time" type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class=form-group>

                            <input type="button" class="btn btn-primary" name="submit" value="Add New Task" id="addbutton" >
                                <input type="button" class="btn btn-primary" name="submit" value="Close" id="closeform" >
                        </div>
                    </form>
                </div>
                <div id="updateformhtml">
                    
                </div>
                
                <div class=todo-add><a href=# class="btn btn-primary tip" id="addnewtodo" title="Add new todo"><i class="icomoon-icon-plus mr0"></i></a></div>
             
    
            </div>
             <div class=todo-search>
                    <form><input class=form-control name=search placeholder="Search for todo ..."></form>
              </div>
            <h4 class=todo-period>To Do List</h4>
           
            <div id="wait" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;"><img src='<?php echo base_url().'assets/img/preloader.gif' ?>' width="64" height="64" /><br>Loading..</div>
            <ul class=todo-list id=today>
                <?php foreach ($todolist as $todo) { ?>  
                <li class="todo-task-item <?php if($todo->todo_status=="0"){ echo "task-done"; } ?>" id="todo-task-item-id<?php echo $todo->todo_id; ?>">
                       <div class=checkbox-custom><input type="checkbox" <?php if($todo->todo_status=="0"){ echo "checked=''"; } ?> value="<?php echo $todo->todo_id ?>" id="checkbox<?php echo $todo->todo_id ?>" class="taskstatus"><label for=checkbox1></label></div>               
                        <span class="todo-category label label-primary"><?php echo $todo->todo_datetime; ?></span>
                         
                        <div class=todo-task-text><?php echo $todo->todo_title; ?></div>
                        <button type=button class="label label-primary updateclick" value="<?php echo $todo->todo_id; ?>">Edit</button>
                        <button type=button class="close todo-close" value="<?php echo $todo->todo_id; ?>">&times;</button>
                        
                    </li>
                <?php } ?>
            </ul>

        </div>
    </div>   
    <!-- End .todo-widget -->
</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
         $("#todo-addform").hide();
        $("#basic-datepicker").datepicker({
            dateFormat: ' MM dd, yy',
            minDate: '0 days',
            autoclose:true,
        });
        
        //task-done
        
        $('#minute-step-timepicker').timepicker({
            upArrowStyle: 'fa fa-angle-up',
            downArrowStyle: 'fa fa-angle-down',
            minuteStep: 30
        });
        $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
        
        $(".todo-close").click(function(){
            var id = $(this).val();
                var dataString = "id=" + id;
            $.ajax({
                type:"POST",
                url:"<?php echo base_url(); ?>admin/removetodolist",
                data:dataString,
                success:function(){
                    
                }
                
            });
            
        });

       
        $("#addnewtodo").click(function () {
        $("#updateformhtml").html('');
            $("#todo-addform").show(500);
            
        });
        $("#frmtodo #addbutton").click(function ()
        {
            var title = $("#todo_title").val();
            var todo_date = $("#basic-datepicker").val();
            var todo_time = $("#minute-step-timepicker").val();
            if (title != "" && todo_date!="" && todo_time!="")
            {
                var dataString = "title=" + title+"&todo_date="+todo_date+"&todo_time="+todo_time;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>admin/add_to_do",
                    data: dataString,
                    success: function (response) {
                        $(".todo-list").html(response);
                        $('#frmtodo #todo_title').val('');
                        $('#frmtodo #basic-datepicker').val('');
                    }
                    
                });
            }
            else{
            if (title == "")
            {
                $("#todo_title").css('border-color', 'red');
            }
            else{
                $("#todo_title").css('border-color', '#ccc');
            }
            if (todo_date == "")
            {
                $("#basic-datepicker").css('border-color', 'red');
               
            }
            else{
                 $("#basic-datepicker").css('border-color', '#ccc');
            }
            if (todo_time == "")
            {
                $("#minute-step-timepicker").css('border-color', 'red');
                
            }
            else{
                $("#minute-step-timepicker").css('border-color', '#ccc');
            }
            }

        });
                        $(".taskstatus").click(function(){
                if($(this).is(':checked'))
                {
                    
                    $(this).closest('li.todo-task-item').addClass('task-done'); 
                    var id = $(this).val(); // todo id
                    var dataString  = "id="+id+"&status=0";
                            
                   $.ajax({
                      type:"POST",
                      url:"<?php echo base_url(); ?>admin/changestatus",
                      data:dataString,
                      success:function(){
                          
                      }
                   });
                
                }
                else{
                    $(this).closest('li.todo-task-item').removeClass('task-done'); 
                    
                    var id = $(this).val(); // todo id
                    var dataString  = "id="+id+"&status=1";
                            
                   $.ajax({
                      type:"POST",
                      url:"<?php echo base_url(); ?>admin/changestatus",
                      data:dataString,
                      success:function(){
                          
                      }
                   });
                    
                }
                   
                });
                
                /**
                * Update ajax request
                 */
                 $(".updateclick").click(function(){
                 
                    var id = $(this).val();
                    $.ajax({
                        type:"GET",
                       url:"<?php echo base_url(); ?>admin/todoupdateform/"+id,
                       success:function(response)
                       {
                           $("#updateformhtml").html(response);
                           $("#todo-addform").hide();                           
                           $('.todo-close').css('pointer-events','none'); 
                       }
                    });
                 });
                 
                 $("#closeform").click(function(){
            $("#todo-addform").hide(500);
           });
    });

            </script>