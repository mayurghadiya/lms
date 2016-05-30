<?php foreach($todolist as $todo){ ?>  
<li class="todo-task-item <?php if($todo->todo_status=="0"){ echo "task-done"; } ?>" id="todo-task-item-id<?php echo $todo->todo_id; ?>">
            <div class=checkbox-custom><input type="checkbox"  <?php if($todo->todo_status=="0"){ echo "checked=''"; } ?> value="<?php echo $todo->todo_id ?>" id="checkbox<?php echo $todo->todo_id ?>" class="taskstatus"><label for=checkbox1></label></div>               
               <div class=todo-task-text><?php  echo $todo->todo_title; ?></div>
               <div class="todo-category"><i class="mar4top fa fa-calendar" aria-hidden="true"></i><?php  echo  $todo->todo_datetime; ?></div>
               <div class="updateclick_box">
                 <button type=button class="label label-primary updateclick" value="<?php echo $todo->todo_id; ?>"><i aria-hidden="true" class="fa fa-pencil-square-o"></i></button>
               </div>
               <div class="todo-close_box">
                   <button type=button class="close todo-close1" value="<?php echo $todo->todo_id; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
               </div>
            </li>
<?php } ?>

            <script type="text/javascript">
                $(".taskstatus").click(function(){
                if($(this).is(':checked'))
                {
                    
                    $(this).closest('li.todo-task-item').addClass('task-done'); 
                    var id = $(this).val(); // todo id
                    var dataString  = "id="+id+"&status=0";                            
                   $.ajax({
                      type:"POST",
                      url:"<?php echo base_url(); ?>professor/changestatus",
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
                      url:"<?php echo base_url(); ?>professor/changestatus",
                      data:dataString,
                      success:function(){
                         
                      }
                   });
                    
                }
                   
                });
                
                   
        $(".close").click(function(){
            var id = $(this).val();
                var dataString = "id=" + id;
            $.ajax({
                type:"POST",
                url:"<?php echo base_url(); ?>professor/removetodolist",
                data:dataString,
                success:function(){
                      $('li#todo-task-item-id'+id).hide();
                }
                
            });
            
            
        });
          $(".updateclick").click(function(){
                 
                    var id = $(this).val();
                    $.ajax({
                        type:"GET",
                       url:"<?php echo base_url(); ?>professor/todoupdateform/"+id,
                       success:function(response)
                       {
                           $("#todo-addform").hide();
                           $("#updateformhtml").html(response);                           
                           $('.todo-close_box').css('pointer-events', 'none');
                            //$(this).closest('.todo-close').css('pointer-events','none'); 
                       }
                    });
                 });
            </script>