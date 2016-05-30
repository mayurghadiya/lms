
<div class=row>  
        <div class="panel panel-default toggle panelMove panelClose panelRefresh">
            <div class="panel-body pt0 pb0" style="height:350px !important; max-height:350px !important;">
                <form id=validate class="form-horizontal group-border stripped" role=form>
                    <div class=form-group>
                        <label for=text class="col-lg-6 col-md-6 control-label">Required field</label>
                        <div class="col-lg-6 col-md-6"><input id=text class="form-control required"></div>
                    </div>
                    <div class=form-group>
                        <label for=email class="col-lg-6 col-md-6 control-label">Email field</label>
                        <div class="col-lg-6 col-md-6"><input id=email name=email type=email class=form-control placeholder="Type your email"></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=minval class="col-lg-6 col-md-6 control-label">Required with min value 13</label>
                        <div class="col-lg-6 col-md-6"><input id=minval class=form-control name=minval placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=maxval class="col-lg-6 col-md-6 control-label">Required with max value 13</label>
                        <div class="col-lg-6 col-md-6"><input id=maxval class=form-control name=maxval placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=password class="col-lg-6 col-md-6 control-label">Password field</label>
                        <div class="col-lg-6 col-md-6"><input type=password class=form-control id=password name=password placeholder="Enter your password"></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=maxLenght class="col-lg-6 col-md-6 control-label">Required with max lenght of 10</label>
                        <div class="col-lg-6 col-md-6"><input class=form-control id=maxLenght name=maxLenght placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=rangelenght class="col-lg-6 col-md-6 control-label">Required range between 10-20 chars</label>
                        <div class="col-lg-6 col-md-6"><input class=form-control id=rangelenght name=rangelenght placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=url class="col-lg-6 col-md-6 control-label">Required with url validaiton</label>
                        <div class="col-lg-6 col-md-6"><input class=form-control id=url name=url placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=date class="col-lg-6 col-md-6 control-label">Required date</label>
                        <div class="col-lg-6 col-md-6"><input class=form-control id=date name=date placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=number class="col-lg-6 col-md-6 control-label">Required number</label>
                        <div class="col-lg-6 col-md-6"><input class=form-control id=number name=number placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=textarea class="col-lg-6 col-md-6 control-label">Required textarea</label>
                        <div class="col-lg-6 col-md-6"><textarea class=form-control name=textarea id=textarea rows=4></textarea></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=ccard class="col-lg-6 col-md-6 control-label">Required and accept credit card number</label>
                        <div class="col-lg-6 col-md-6"><input class=form-control id=ccard name=ccard placeholder=""></div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=agree class="col-lg-6 col-md-6 control-label">Required checkbox</label>
                        <div class="col-lg-6 col-md-6">
                            <div class=checkbox-custom><input type=checkbox name=agree id=agree value=option><label for=agree>agree terms ?</label></div>
                        </div>
                    </div>
                    <!-- End .form-group  -->
                    <div class=form-group>
                        <label for=select2 class="col-lg-6 col-md-6 control-label">Required select with filter</label>
                        <div class="col-lg-6 col-md-6">
                            <select class="form-control select2" name=select2 id=select2>
                                <option value="">Choose
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value=AK>Alaska
                                    <option value=HI>Hawaii
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value=CA>California
                                    <option value=NV>Nevada
                                    <option value=OR>Oregon
                                    <option value=WA>Washington
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value=AZ>Arizona
                                    <option value=CO>Colorado
                                    <option value=ID>Idaho
                                    <option value=MT>Montana
                                    <option value=NE>Nebraska
                                    <option value=NM>New Mexico
                                    <option value=ND>North Dakota
                                    <option value=UT>Utah
                                    <option value=WY>Wyoming
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value=AL>Alabama
                                    <option value=AR>Arkansas
                                    <option value=IL>Illinois
                                    <option value=IA>Iowa
                                    <option value=KS>Kansas
                                    <option value=KY>Kentucky
                                    <option value=LA>Louisiana
                                    <option value=MN>Minnesota
                                    <option value=MS>Mississippi
                                    <option value=MO>Missouri
                                    <option value=OK>Oklahoma
                                    <option value=SD>South Dakota
                                    <option value=TX>Texas
                                    <option value=TN>Tennessee
                                    <option value=WI>Wisconsin
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                    <option value=CT>Connecticut
                                    <option value=DE>Delaware
                                    <option value=FL>Florida
                                    <option value=GA>Georgia
                                    <option value=IN>Indiana
                                    <option value=ME>Maine
                                    <option value=MD>Maryland
                                    <option value=MA>Massachusetts
                                    <option value=MI>Michigan
                                    <option value=NH>New Hampshire
                                    <option value=NJ>New Jersey
                                    <option value=NY>New York
                                    <option value=NC>North Carolina
                                    <option value=OH>Ohio
                                    <option value=PA>Pennsylvania
                                    <option value=RI>Rhode Island
                                    <option value=SC>South Carolina
                                    <option value=VT>Vermont
                                    <option value=VA>Virginia
                                    <option value=WV>West Virginia
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
<!-- End .row -->
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->
