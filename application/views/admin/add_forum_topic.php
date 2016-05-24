  <?php 
  
  ?>
<div class=row>                      
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <div class=panel-heading>
                <h4 class=panel-title>  <?php echo ucwords("Add Forum topic");?></h4>                
            </div>
                <div class="panel-body"> 

<div class="box-content">  
                                    <div class="">
                                        <span style="color:red">* <?php echo "is ".ucwords("mandatory field");?></span> 
                                    </div>                                                                    
                                        <?php echo form_open(base_url() . 'admin/topicscrud/create', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'frmadmission_type', 'target' => '_top')); ?>
                                    <div class="padded">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Forum <span style="color:red">*</span></label>
                                            <div class="col-sm-5">
                                                <select name="forum_id"  class="form-control">
                                                    <option value="">Select Forum</option>
                                                    <?php foreach($forum  as $form): ?>
                                                    <option value="<?php  echo $form['forum_id']; ?>"><?php  echo $form['forum_title']; ?></option>
                                                    <?php endforeach; ?>                                                    
                                                </select>	

                                            </div>	
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Topic Title<span style="color:red">*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="topic_title" id="topic_title" />
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo ucwords("Description");?></label>
                                            <div class="col-sm-5">
                                                <textarea class="form-control" name="description" id="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Status <span style="color:red">*</span></label>
                                            <div class="col-sm-5">
                                                <select name="topic_status" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>		
                                                </select>	

                                            </div>	
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-5">
                                                <button type="submit" class="btn btn-info vd_bg-green">Add forum Topic</button>
                                            </div>
                                        </div>
                                        </form>               
                                    </div>                
                                </div>
                      </div>
            </div>
        </div>
</div>
    <script type="text/javascript">

    $().ready(function () {
        $("#frmadmission_type").validate({
            rules: {
                forum_id:"required",
                topic_title: "required",               
                topic_status: "required",
            },
            messages: {
                forum_id:"Select Forum",
                topic_title:
                        {
                            required: "Enter topic title",
                           
                        },
                topic_status: "Please select status",
            }
        });
    });
    </script>