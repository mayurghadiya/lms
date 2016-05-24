<!-- Start .row -->
<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            <div class=panel-heading>
                <h4 class=panel-title><?php echo $title; ?></h4>
                <div class="panel-controls panel-controls-right">
                    <a class="panel-refresh" href="#"><i class="fa fa-refresh s12"></i></a>
                    <a class="toggle panel-minimize" href="#"><i class="fa fa-plus s12"></i></a>
                    <a class="panel-close" href="#"><i class="fa fa-times s12"></i></a>
                </div>
            </div>
            <div class=panel-body>
                <div class="tabs mb20">
                    <ul id="import-tab" class="nav nav-tabs">
                        <li class="active">
                            <a href="#import-data" data-toggle="tab" aria-expanded="true">Banner Slider List</a>
                        </li>
                        <li class="">
                            <a href="#download-sample-sheet" data-toggle="tab" aria-expanded="false">Slider General Setting</a>
                        </li>
                    </ul>
                    <div id="import-tab-content" class="tab-content">
                        <div class="tab-pane fade active in" id="import-data">
                            <a href="#" class="links" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/addbanner/');" >Add New Banner</a>
                    <table id="datatable-list" class="table table-striped table-bordered table-responsive" cellspacing=0 width=100%>
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div>Title</div></th>  
                            <th><div>Description</div></th>                                                                                  
                            <th><div>Action</div></th>
                        </tr>
                    </thead>

                    <tbody>
                         <?php $count = 1;
                               foreach ($banners as $row): ?>
                            <tr>
                                <td><?php echo $count++; ?></td>    
                                <td><?php if($row->banner_title!=""){ echo $row->banner_title; }else{ echo "No-Title"; } ?></td>    
                                <td><?php echo $row->banner_desc; ?></td>  
                                <td class="menu-action">
                                    <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_banner/<?php echo $row->banner_id; ?>');" data-original-title="edit" data-toggle="tooltip" data-placement="top"><span class="label label-primary mr6 mb6">Edit</span></a>
                                   <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>admin/bannerslider/delete/<?php echo $row->banner_id; ?>');" data-original-title="Remove" data-toggle="tooltip" data-placement="top"><span class="label label-danger mr6 mb6">Delete</span></a>
                                </td>
                            </tr>
                            <?php endforeach;  ?>                                    
                    </tbody>
                </table>
                        </div>
                        
                        <!-- tab content -->
                        <div class="tab-pane fade" id="download-sample-sheet">
                            
                                <div class="box-content">  
                                <div class="">
                                    <span style="color:red">* is mandatory field</span> 
                                </div>                                      
<?php echo form_open(base_url() . 'admin/bannerslider/general', array('class' => 'form-horizontal form-groups-bordered validate', 'role' => 'form', 'id' => 'frmgeneral', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
                                    <div class="padded">											
                                        
                                      
                              
                                       
                                        
                                          <div class="form-group">
                                                    <label class="col-sm-3 control-label">Pause Time <span style="color:red">*</span></label>
                                                    <div class="col-sm-5">
                                                        
                                                        <input type="text" class="form-control" name="pause_time" placeholder="Ex 4000" id="pause_time" value="<?php if(!empty($general)) { echo $general[0]->pause_time; } ?>" />
                                                        
                                                    </div>
                                                </div>
                                        <div class="form-group">
                                                    <label class="col-sm-3 control-label">Animation Speed <span style="color:red">*</span></label>
                                                    <div class="col-sm-5">                                                        
                                                        <input type="text" placeholder="Ex 340" class="form-control" name="anim_speed" id="anim_speed" value="<?php if(!empty($general)) {  echo $general[0]->anim_speed; } ?>" />
                                                    </div>
                                         </div>
                                        
                                        
                                        <div class="form-group">
                                                    <label class="col-sm-3 control-label">Pause On Hover  <span style="color:red">*</span></label>
                                                    <div class="col-sm-5">
                                                        <select name="pause_on_hover" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="true" <?php  if(!empty($general)) {  if($general[0]->pause_on_hover=="true"){ echo "selected=selected";} } ?>>True</option>
                                                            <option value="false"  <?php  if(!empty($general)) {  if($general[0]->pause_on_hover=="false"){ echo "selected=selected";} } ?>>False</option>
                                                        </select>
                                                    </div>
                                                </div>
                                         <div class="form-group">
                                                    <label class="col-sm-3 control-label">Caption Opacity  <span style="color:red">*</span></label>
                                                    <div class="col-sm-5">                                                        
                                                        <input type="text" placeholder="Ex 0.8" class="form-control" name="caption_opacity" id="caption_opacity" value="<?php  if(!empty($general)) {  echo $general[0]->caption_opacity; } ?>" />
                                                    </div>
                                         </div>                                                                             
                                        
                                        

                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-5">
                                                <button type="submit" class="btn btn-info vd_bg-green">Update</button>
                                            </div>
                                        </div>
                                        </form>               
                                    </div> 
                                    <div id="dvPreview">
                                  </div>
                                </div>
                            
                        </div> <!-- End Tab   -->

                    </div>

                </div>
                
            </div>
        </div>
        <!-- End .panel -->
    </div>
    <!-- col-lg-12 end here -->
</div>
<!-- End .row -->
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->