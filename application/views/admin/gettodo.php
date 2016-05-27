<?php foreach($todolist as $todo){ ?>  
<li class="todo-task-item <?php if($todo->todo_status=="0"){ echo "task-done"; } ?>" id="todo-task-item-id<?php echo $todo->todo_id; ?>">
            <div class=checkbox-custom><input type="checkbox"  <?php if($todo->todo_status=="0"){ echo "checked=''"; } ?> value="<?php echo $todo->todo_id ?>" id="checkbox<?php echo $todo->todo_id ?>" class="taskstatus"><label for=checkbox1></label></div>               
               <span class="todo-category label label-primary"><?php  echo  $todo->todo_datetime; ?></span>
               <div class=todo-task-text><?php  echo $todo->todo_title; ?></div>
               <button type=button class="label label-primary updateclick" value="<?php echo $todo->todo_id; ?>">Edit</button>
               <button type=button class="close todo-close" value="<?php echo $todo->todo_id; ?>">&times;</button>
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
                
                   
        $(".todo-close").click(function(){
            var id = $(this).val();
                var dataString = "id=" + id;
            $.ajax({
                type:"POST",
                url:"<?php echo base_url(); ?>admin/removetodolist",
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
                       url:"<?php echo base_url(); ?>admin/todoupdateform/"+id,
                       success:function(response)
                       {
                           $("#updateformhtml").html(response);
                           $("#todo-addform").hide(500);
                            $(this).closest('.todo-close').css('pointer-events','none'); 
                       }
                    });
                 });
            </script>