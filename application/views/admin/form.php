<!-- Start .row -->
<div class=row>
    <div class=col-lg-12>
        <!-- col-lg-12 start here -->
        <div class="panel-default toggle panelMove panelClose panelRefresh" id="supr0">
            <!-- Start .panel -->
            <div class=panel-heading>
                <h4 class=panel-title>Form validation</h4>
                <div class="panel-controls panel-controls-right"><a href="#" class="panel-refresh"><i class="fa fa-refresh s12"></i></a><a href="#" class="toggle panel-minimize"><i class="fa fa-plus s12"></i></a><a href="#" class="panel-close"><i class="fa fa-times s12"></i></a></div>
            </div>
            <div class="panel-body pt0 pb0">
                <form id=validate class="form-horizontal group-border stripped" role=form>
                    <div class=form-group>
                        <label for=text class="col-lg-2 col-md-3 control-label">Required field</label>
                        <div class="col-lg-10 col-md-9"><input id=text class="form-control required"></div>
                    </div>
                    <div class=form-group>
                        <label for=email class="col-lg-2 col-md-3 control-label">Email field</label>
                        <div class="col-lg-10 col-md-9"><input id=email name=email type=email class=form-control placeholder="Type your email"></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=minval class="col-lg-2 col-md-3 control-label">Required with min value 13</label>
                        <div class="col-lg-10 col-md-9"><input id=minval class=form-control name=minval placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=maxval class="col-lg-2 col-md-3 control-label">Required with max value 13</label>
                        <div class="col-lg-10 col-md-9"><input id=maxval class=form-control name=maxval placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=password class="col-lg-2 col-md-3 control-label">Password field</label>
                        <div class="col-lg-10 col-md-9"><input type=password class=form-control id=password name=password placeholder="Enter your password"></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=maxLenght class="col-lg-2 col-md-3 control-label">Required with max lenght of 10</label>
                        <div class="col-lg-10 col-md-9"><input class=form-control id=maxLenght name=maxLenght placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=rangelenght class="col-lg-2 col-md-3 control-label">Required range between 10-20 chars</label>
                        <div class="col-lg-10 col-md-9"><input class=form-control id=rangelenght name=rangelenght placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=url class="col-lg-2 col-md-3 control-label">Required with url validaiton</label>
                        <div class="col-lg-10 col-md-9"><input class=form-control id=url name=url placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=date class="col-lg-2 col-md-3 control-label">Required date</label>
                        <div class="col-lg-10 col-md-9"><input class=form-control id=date name=date placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=number class="col-lg-2 col-md-3 control-label">Required number</label>
                        <div class="col-lg-10 col-md-9"><input class=form-control id=number name=number placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=textarea class="col-lg-2 col-md-3 control-label">Required textarea</label>
                        <div class="col-lg-10 col-md-9"><textarea class=form-control name=textarea id=textarea rows=4></textarea></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=ccard class="col-lg-2 col-md-3 control-label">Required and accept credit card number</label>
                        <div class="col-lg-10 col-md-9"><input class=form-control id=ccard name=ccard placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=agree class="col-lg-2 col-md-3 control-label">Required checkbox</label>
                        <div class="col-lg-10 col-md-9">
                            <div class=checkbox-custom><input type=checkbox name=agree id=agree value=option><label for=agree>agree terms ?</label></div>
                        </div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=select2 class="col-lg-2 col-md-3 control-label">Required select with filter</label>
                        <div class="col-lg-10 col-md-9">
                            <select class="form-control select2" name=select2 id=select2>
                                <option value="">Choose</option>
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value=AK>Alaska</option>
                                    <option value=HI>Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value=CA>California</option>
                                    <option value=NV>Nevada</option>
                                    <option value=OR>Oregon</option>
                                    <option value=WA>Washington</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value=AZ>Arizona</option>
                                    <option value=CO>Colorado</option>
                                    <option value=ID>Idaho</option>
                                    <option value=MT>Montana</option>
                                    <option value=NE>Nebraska</option>
                                    <option value=NM>New Mexico</option>
                                    <option value=ND>North Dakota</option>
                                    <option value=UT>Utah</option>
                                    <option value=WY>Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value=AL>Alabama</option>
                                    <option value=AR>Arkansas</option>
                                    <option value=IL>Illinois</option>
                                    <option value=IA>Iowa</option>
                                    <option value=KS>Kansas</option>
                                    <option value=KY>Kentucky</option>
                                    <option value=LA>Louisiana</option>
                                    <option value=MN>Minnesota</option>
                                    <option value=MS>Mississippi</option>
                                    <option value=MO>Missouri</option>
                                    <option value=OK>Oklahoma</option>
                                    <option value=SD>South Dakota</option>
                                    <option value=TX>Texas</option>
                                    <option value=TN>Tennessee</option>
                                    <option value=WI>Wisconsin</option>
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                    <option value=CT>Connecticut</option>
                                    <option value=DE>Delaware</option>
                                    <option value=FL>Florida</option>
                                    <option value=GA>Georgia</option>
                                    <option value=IN>Indiana</option>
                                    <option value=ME>Maine</option>
                                    <option value=MD>Maryland</option>
                                    <option value=MA>Massachusetts</option>
                                    <option value=MI>Michigan</option>
                                    <option value=NH>New Hampshire</option>
                                    <option value=NJ>New Jersey</option>
                                    <option value=NY>New York</option>
                                    <option value=NC>North Carolina</option>
                                    <option value=OH>Ohio</option>
                                    <option value=PA>Pennsylvania</option>
                                    <option value=RI>Rhode Island</option>
                                    <option value=SC>South Carolina</option>
                                    <option value=VT>Vermont</option>
                                    <option value=VA>Virginia</option>
                                    <option value=WV>West Virginia</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <div class=col-lg-offset-2><button class="btn btn-default ml15" type=submit>Test validation</button></div>
                    </div>
                    <!-- End .form-group  -->
                </form>
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
