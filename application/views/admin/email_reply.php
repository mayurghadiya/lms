<div class=row>                      

    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh">
            <!-- Start .panel -->
            
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="post">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">To</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="to" id="to" readonly=""
                                   value="<?php echo $email->email_from; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-7">
                            <textarea id="subject" class="form-control" name="subject" required=""></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cc</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="cc" id="cc" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-10">
                            <textarea id="summernote" name="message" class="width-100 form-control"  rows="15" placeholder="Write your message here">
                                                
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Attachment</label>
                        <div class="col-sm-5">
                            <input type="file" class="form-control" name="userfile[]" multiple/>
                        </div>
                    </div>

                    <div class="form-group form-actions">
                        <div class="col-sm-12 col-md-offset-2">
                            <button type="submit" class="btn vd_btn vd_bg-green vd_white"><i class="fa fa-envelope append-icon"></i> SEND</button>                            
                        </div>
                    </div>
                </form>
            </div>
            <!-- panel-body  --> 

        </div>
        <!-- panel --> 
    </div>
    <!-- col-md-8 -->

    <div class="col-md-3" style="display: none;">
        <div class="panel widget">
            <div class="panel-heading vd_bg-yellow">
                <h3 class="panel-title"> <span class="menu-icon"> <i class="glyphicon glyphicon-book"></i> </span> Address Book </h3>
            </div>
            <!-- vd_panel-heading -->

            <div class="panel-body">
                <div class="form-group clearfix mgtp-10">
                    <div class="vd_input-wrapper light-theme"> <span class="menu-icon"> <i class="fa fa-filter"></i> </span>
                        <input type="text" id="filter-text" placeholder="Name Filter">
                    </div>
                </div>
                <br/>
                <form class="form-horizontal" role="form" action="#">



                    <a href="#" id="check-all">Check All</a> <span class="mgl-10 mgr-10">/</span> <a href="#" id="uncheck-all">Uncheck All</a>  

                    <hr class="mgtp-5"/>                   
                    <div class="form-group clearfix" style="height: 250px; overflow-y:scroll;">
                        <div class="col-md-12">
                            <div class="content-list content-menu" id="email-list">
                                <div class="list-wrapper wrap-25 isotope">
                                    <div class="email-item">
                                        <div class="vd_checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox-1" value="brad@pitt.com">
                                            <label class="filter-name" for="checkbox-1"> Brad Pitt - <em class="font-normal">brad@pitt.com</em> </label>
                                        </div>
                                    </div>
                                    <div  class="email-item">
                                        <div class="vd_checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox-2" value="angelina@jolie.com">
                                            <label class="filter-name" for="checkbox-2"> Angelina Jolie - <em class="font-normal">angelina@jolie.com</em> </label>
                                        </div>
                                    </div>
                                    <div class="email-item">
                                        <div class="vd_checkbox checkbox-success"> <input type="checkbox" id="checkbox-3" value="adam@sandler.com">

                                            <label class="filter-name" for="checkbox-3"> Adam Sandler - <em class="font-normal">adam@sandler.com</em> </label>
                                        </div>
                                    </div>
                                    <div  class="email-item">
                                        <div class="vd_checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox-4" value="christina@aguilera.com">
                                            <label class="filter-name" for="checkbox-4"> Chirstina Aguilera - <em class="font-normal">christina@aguilera.com</em> </label>
                                        </div>
                                    </div>
                                    <div class="email-item">
                                        <div class="vd_checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox-5" value="tom@cruise.com">
                                            <label class="filter-name" for="checkbox-5"> Tom Cruise - <em class="font-normal">tom@cruise.com</em> </label>
                                        </div>
                                    </div>
                                    <div  class="email-item">
                                        <div class="vd_checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox-6" value="dominicus@soddley.com">
                                            <label class="filter-name" for="checkbox-6"> Dominicus Soddley - <em class="font-normal">dominicus@soddley.com</em> </label>
                                        </div>
                                    </div>
                                    <div class="email-item">
                                        <div class="vd_checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox-7" value="web@designer.com">
                                            <label class="filter-name" for="checkbox-7"> Web Designer - <em class="font-normal">web@designer.com</em> </label>
                                        </div>
                                    </div>
                                    <div  class="email-item">
                                        <div class="vd_checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox-8" value="web@templatecompany.com">
                                            <label class="filter-name" for="checkbox-8"> Web Template Company - <em class="font-normal">web@templatecompany.com</em> </label>
                                        </div>
                                    </div>
                                    <div class="email-item">
                                        <div class="vd_checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox-9" value="round@live.com">
                                            <label class="filter-name" for="checkbox-9"> Round Live - <em class="font-normal">round@live.com</em> </label>
                                        </div>
                                    </div>
                                    <div  class="email-item">
                                        <div class="vd_checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox-10" value="chrisitan@bautista.com">
                                            <label class="filter-name" for="checkbox-10"> Chrisitan Bautista - <em class="font-normal">chrisitan@bautista.com</em> </label>
                                        </div>
                                    </div>
                                    <div  class="email-item">
                                        <div class="vd_checkbox checkbox-success">
                                            <input type="checkbox" id="checkbox-11" value="admin@template.com">
                                            <label class="filter-name" for="checkbox-11"> Admin Template - <em class="font-normal">admin@template.com</em> </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- list-wrapper --> 
                            </div>
                            <!-- content-list --> 
                        </div>
                        <!-- col-md-12 --> 
                    </div>
                    <!-- form-group -->


                    <hr/>
                    <div class="form-group form-actions">
                        <div class="col-sm-12">
                            <button type="button" id="insert-email-btn" class="btn vd_btn vd_bg-blue vd_white"><i class="fa fa-angle-double-left append-icon"></i> INSERT ADDRESS</button>
                            <button type="button" class="btn vd_btn vd_bg-grey vd_white"><i class="fa fa-plus append-icon"></i> ADD NEW</button>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope append-icon"></i> SEND</button>
                         </div>

                    </div>
                </form>
            </div>
            <!-- panel-body  --> 

        </div>
        <!-- panel --> 
    </div>
    
</div>
<!-- row --> 
</div></div>