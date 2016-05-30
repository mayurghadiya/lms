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
            <div class="vd_content-section clearfix">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="">
                            <span style="color:red">* <?php echo "is " . ucwords("mandatory field"); ?></span> 
                        </div> 
                        <?php echo form_open(base_url() . 'admin/list_module/do_update', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'id' => 'list_module')); ?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Group Name</label>
                            <div class="col-sm-7 controls">
                                <select name="group_name" class="form-control" onchange="return get_module_ajax(this.value)">
                                    <option value="">Select Group Name</option>
                                    <?php
                                    $group_query = $this->db->get('group')->result_array();
                                    foreach ($group_query as $group_row):
                                        ?>
                                        <option value="<?php echo $group_row['g_id']; ?>,<?php echo $group_row['user_type']; ?>"><?php echo $group_row['group_name']; ?></option>
                                        <?php
                                    endforeach;
                                    ?>	
                                </select>
                            </div>
                        </div>	
                       
                        <div class="row">
                            <div class="col-sm-5">
                                <select class="form-control" style="width:100%;" size="8" multiple="multiple" id="multiselect">
                                </select>
                            </div>

                            <div class="col-sm-2">
                                    <!--<button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>-->
                                <div>&nbsp;</div>
                                <div>&nbsp;</div>
                                <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="fa fa-arrow-right"></i></button>
                                <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="fa fa-arrow-left"></i></button>
                                <!--<button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>-->
                            </div>

                            <div class="col-sm-5">
                                <select name="module_name[]" id="multiselect_to" class="form-control" size="8" multiple="multiple"></select>
                            </div>
                        </div>	
                        <!-- col-sm-9-->
                        <div class="col-sm-3">                
                            <div class="mgbt-xs-5"><br/>
                                <button class="submit btn btn-info" type="submit">Update Module</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <!-- row -->

</div>

<!-- End .row -->
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->

<script type="text/javascript">
   
   $(document).ready(function() {
    $("#list_module").validate({
            rules: {
                    group_name: "required",				
                    'module_name[]': "required",
            },
            messages: {
                    group_name: "Select group name",				
                    'module_name[]': "Module name required ",			
            }
    });
    });
   
    function get_module_ajax(group_id) {
           
       var type_array = group_id;
        var type=type_array.split(',');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_module_ajax',
            type:'post',
            dataType:'json',
            data:
            {
                'type': type[1],
                'id':type[0],
            }, 
            success: function (response)
           {
//                var json = $.parseJSON(response);
//                //alert(json.assigned_module_list);
                jQuery('#multiselect').html(response.full_module_list);
                jQuery('#multiselect_to').html(response.assigned_module_list);
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        // make code pretty
        window.prettyPrint && prettyPrint();

        if (window.location.hash) {
            scrollTo(window.location.hash);
        }

        $('.nav').on('click', 'a', function (e) {
            scrollTo($(this).attr('href'));
        });

        $('#multiselect').multiselect();

        $('[name="q"]').on('keyup', function (e) {
            var search = this.value;
            var $options = $(this).next('select').find('option');

            $options.each(function (i, option) {
                if (option.text.indexOf(search) > -1) {
                    $(option).show();
                } else {
                    $(option).hide();
                }
            });
        });

        $('#search').multiselect({
            search: {
                left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                right: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            }
        });

        $('.multiselect').multiselect();
        $('.js-multiselect').multiselect({
            right: '#js_multiselect_to_1',
            rightAll: '#js_right_All_1',
            rightSelected: '#js_right_Selected_1',
            leftSelected: '#js_left_Selected_1',
            leftAll: '#js_left_All_1'
        });

        $('#keepRenderingSort').multiselect({
            keepRenderingSort: true
        });

        $('#undo_redo').multiselect();

        $('#multi_d').multiselect({
            right: '#multi_d_to, #multi_d_to_2',
            rightSelected: '#multi_d_rightSelected, #multi_d_rightSelected_2',
            leftSelected: '#multi_d_leftSelected, #multi_d_leftSelected_2',
            rightAll: '#multi_d_rightAll, #multi_d_rightAll_2',
            leftAll: '#multi_d_leftAll, #multi_d_leftAll_2',
            moveToRight: function (Multiselect, options, event, silent, skipStack) {
                var button = $(event.currentTarget).attr('id');

                if (button == 'multi_d_rightSelected') {
                    var left_options = Multiselect.left.find('option:selected');
                    Multiselect.right.eq(0).append(left_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.right.eq(0).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(0));
                    }
                } else if (button == 'multi_d_rightAll') {
                    var left_options = Multiselect.left.find('option');
                    Multiselect.right.eq(0).append(left_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.right.eq(0).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(0));
                    }
                } else if (button == 'multi_d_rightSelected_2') {
                    var left_options = Multiselect.left.find('option:selected');
                    Multiselect.right.eq(1).append(left_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.right.eq(1).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(1));
                    }
                } else if (button == 'multi_d_rightAll_2') {
                    var left_options = Multiselect.left.find('option');
                    Multiselect.right.eq(1).append(left_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.right.eq(1).eq(1).find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.right.eq(1));
                    }
                }
            },
            moveToLeft: function (Multiselect, options, event, silent, skipStack) {
                var button = $(event.currentTarget).attr('id');

                if (button == 'multi_d_leftSelected') {
                    var right_options = Multiselect.right.eq(0).find('option:selected');
                    Multiselect.left.append(right_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
                    }
                } else if (button == 'multi_d_leftAll') {
                    var right_options = Multiselect.right.eq(0).find('option');
                    Multiselect.left.append(right_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
                    }
                } else if (button == 'multi_d_leftSelected_2') {
                    var right_options = Multiselect.right.eq(1).find('option:selected');
                    Multiselect.left.append(right_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
                    }
                } else if (button == 'multi_d_leftAll_2') {
                    var right_options = Multiselect.right.eq(1).find('option');
                    Multiselect.left.append(right_options);

                    if (typeof Multiselect.callbacks.sort == 'function' && !silent) {
                        Multiselect.left.find('option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.left);
                    }
                }
            }
        });
    });

    function scrollTo(id) {
        if ($(id).length) {
            $('html,body').animate({scrollTop: $(id).offset().top - 40}, 'slow');
        }
    }
</script>
