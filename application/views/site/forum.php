

<!-- 
   Template Name: Supr - Responsive Admin Template build with Twitter Bootstrap 3.3.4
   Version: 4.0.0
   Author: SuggeElson
   Website: http://www.suggeeelson.com/
   Contact: support@suggeelson.com
   Follow: www.twitter.com/suggeelson
   Like: https://www.facebook.com/pages/SuggeElson/264113463621030
   Purchase: http://themeforest.net/item/supr-responsive-bootstrap-3-admin-template/2834580?ref=SuggeElson
   License: You must have a valid license purchased only from themeforest (the above link) in order to legally use the theme for your project.
   --><!DOCTYPE html><!--[if lt IE 8]>
<html class="no-js lt-ie8">
   <![endif]--><!--[if gt IE 8]><!-->
   <html class=no-js>
      <!--<![endif]-->
      <html class=no-js>
         <head>
            <meta charset=utf-8>
            <title>FAQ | Supr Admin Template</title>
            <!-- Mobile specific metas -->
            <meta name=viewport content="width=device-width,initial-scale=1,maximum-scale=1">
            <!-- Force IE9 to render in normal mode --><!--[if IE]>
            <meta http-equiv="x-ua-compatible" content="IE=9" />
            <![endif]-->
            <meta name=author content="">
            <meta name=description content="">
            <meta name=keywords content="">
            <meta name=application-name content="">
            <!-- Import google fonts - Heading first/ text second -->
            <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel=stylesheet type=text/css>
            <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel=stylesheet type=text/css>
            <!-- Css files -->
            <link rel=stylesheet href="<?php echo base_url(); ?>css/main.min.css">
            <!-- Fav and touch icons -->
            <link rel=apple-touch-icon-precomposed sizes=144x144 href="http://themes.suggelab.com/supr/img/ico/apple-touch-icon-144-precomposed.png">
            <link rel=apple-touch-icon-precomposed sizes=114x114 href="http://themes.suggelab.com/supr/img/ico/apple-touch-icon-114-precomposed.png">
            <link rel=apple-touch-icon-precomposed sizes=72x72 href="http://themes.suggelab.com/supr/img/ico/apple-touch-icon-72-precomposed.png">
            <link rel=apple-touch-icon-precomposed href="http://themes.suggelab.com/supr/img/ico/apple-touch-icon-57-precomposed.png">
            <link rel=icon href="http://themes.suggelab.com/supr/img/ico/favicon.ico" type=image/png>
            <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
            <meta name=msapplication-TileColor content="#3399cc">
         <body>
            <!--[if lt IE 9]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]--><!-- .#header -->
            <div id=header>
               <nav class="navbar navbar-default" role=navigation>
                  <div class=navbar-header><a class=navbar-brand href=index.html>Supr.<span class=slogan>admin</span></a></div>
                  <div id=navbar-no-collapse class=navbar-no-collapse>
                     <ul class="nav navbar-nav">
                        <li>
                           <!--Sidebar collapse button--><a href=# class="collapseBtn leftbar"><i class="s16 minia-icon-list-3"></i></a>
                        </li>
                        <li><a href=# class="tipB reset-layout" title="Reset panel postions"><i class="s16 icomoon-icon-history"></i></a></li>
                        <li class=dropdown>
                           <a href=# class=dropdown-toggle data-toggle=dropdown><i class="s16 icomoon-icon-cog-2"></i><span class=txt>Settings</span> <b class=caret></b></a>
                           <ul class="dropdown-menu left dropdown-form template-settings">
                              <li class=menu>
                                 <ul role=menu>
                                    <li><strong>Template settings</strong></li>
                                    <li>
                                       <div class=toggle-custom><label class=toggle data-on=ON data-off=OFF><input type=checkbox id=fixed-header-toggle name=fixed-header-toggle checked> <span class=button-checkbox></span></label><label for=fixed-header-toggle>Fixed header</label></div>
                                    </li>
                                    <li>
                                       <div class=toggle-custom><label class=toggle data-on=ON data-off=OFF><input type=checkbox id=fixed-left-sidebar name=fixed-left-sidebar checked> <span class=button-checkbox></span></label><label for=fixed-left-sidebar>Fixed Left Sidebar</label></div>
                                    </li>
                                    <li>
                                       <div class=toggle-custom><label class=toggle data-on=ON data-off=OFF><input type=checkbox id=fixed-right-sidebar name=fixed-right-sidebar checked> <span class=button-checkbox></span></label><label for=fixed-right-sidebar>Fixed Right Sidebar</label></div>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </li>
                        <li class=dropdown>
                           <a href=# class=dropdown-toggle data-toggle=dropdown><i class="s16 minia-icon-envelope"></i><span class=txt>Messages</span><span class=notification>8</span></a>
                           <ul class="dropdown-menu left">
                              <li class=menu>
                                 <ul class=messages>
                                    <li class=header><strong>Messages</strong> (10) emails and (2) PM</li>
                                    <li><span class=icon><i class="s16 icomoon-icon-user-plus"></i></span> <span class=name><a data-toggle=modal href=#myModal1><strong>Sammy Morerira</strong></a><span class=time>35 min ago</span></span> <span class=msg>I have question about new function ...</span></li>
                                    <li><span class="icon avatar"><img src=img/avatar.jpg alt=""></span> <span class=name><a data-toggle=modal href=#myModal1><strong>George Michael</strong></a><span class=time>1 hour ago</span></span> <span class=msg>I need to meet you urgent please call me ...</span></li>
                                    <li><span class=icon><i class="s16 icomoon-icon-envelop"></i></span> <span class=name><a data-toggle=modal href=#myModal1><strong>Ivanovich</strong></a><span class=time>1 day ago</span></span> <span class=msg>I send you my suggestion, please look and ...</span></li>
                                    <li class=view-all><a href=#>View all messages <i class="s16 fa fa-angle-double-right"></i></a></li>
                                 </ul>
                              </li>
                           </ul>
                        </li>
                     </ul>
                     <ul class="nav navbar-right usernav">
                        <li class=dropdown>
                           <a href=# class=dropdown-toggle data-toggle=dropdown><i class="s16 icomoon-icon-earth"></i><span class=notification>3</span></a>
                           <ul class="dropdown-menu right">
                              <li class=menu>
                                 <ul class=notif>
                                    <li class=header><strong>Notifications</strong> (3) items</li>
                                    <li><a href=#><span class=icon><i class="s16 icomoon-icon-user-plus"></i></span> <span class=event>1 User is registred</span></a></li>
                                    <li><a href=#><span class=icon><i class="s16 icomoon-icon-bubble-3"></i></span> <span class=event>Jony add 1 comment</span></a></li>
                                    <li><a href=#><span class=icon><i class="s16 icomoon-icon-new"></i></span> <span class=event>admin Julia added post with a long description</span></a></li>
                                    <li class=view-all><a href=#>View all notifications <i class="s16 fa fa-angle-double-right"></i></a></li>
                                 </ul>
                              </li>
                           </ul>
                        </li>
                        <li class=dropdown>
                           <a href=# class="dropdown-toggle avatar" data-toggle=dropdown><img src=img/avatar.jpg alt="" class="image"> <span class=txt>admin@supr.com</span> <b class=caret></b></a>
                           <ul class="dropdown-menu right">
                              <li class=menu>
                                 <ul>
                                    <li><a href=#><i class="s16 icomoon-icon-user-plus"></i>Edit profile</a></li>
                                    <li><a href=#><i class="s16 icomoon-icon-bubble-2"></i>Comments</a></li>
                                    <li><a href=#><i class="s16 icomoon-icon-plus"></i>Add user</a></li>
                                 </ul>
                              </li>
                           </ul>
                        </li>
                        <li><a href=login.html><i class="s16 icomoon-icon-exit"></i><span class=txt>Logout</span></a></li>
                        <li><a id=toggle-right-sidebar href=#><i class="s16 icomoon-icon-indent-increase"></i></a></li>
                     </ul>
                  </div>
                  <!-- /.nav-collapse -->
               </nav>
               <!-- /navbar -->
            </div>
            <!-- / #header -->
            <div id=wrapper>
               <!-- #wrapper --><!--Sidebar background-->
               <div id=sidebarbg class="hidden-lg hidden-md hidden-sm hidden-xs"></div>
               <!--Sidebar content-->
               <div id=sidebar class="page-sidebar hidden-lg hidden-md hidden-sm hidden-xs">
                  <div class=shortcuts>
                     <ul>
                        <li><a href="http://themes.suggelab.com/supr/support.html" title="Support section" class=tip><i class="s24 icomoon-icon-support"></i></a></li>
                        <li><a href=# title="Database backup" class=tip><i class="s24 icomoon-icon-database"></i></a></li>
                        <li><a href="http://themes.suggelab.com/supr/charts.html" title="Sales statistics" class=tip><i class="s24 icomoon-icon-pie-2"></i></a></li>
                        <li><a href=# title="Write post" class=tip><i class="s24 icomoon-icon-pencil"></i></a></li>
                     </ul>
                  </div>
                  <!-- End search --><!-- Start .sidebar-inner -->
                  <div class=sidebar-inner>
                     <!-- Start .sidebar-scrollarea -->
                     <div class=sidebar-scrollarea>
                        <div class=sidenav>
                           <div class="sidebar-widget mb0">
                              <h6 class="title mb0">Navigation</h6>
                           </div>
                           <!-- End .sidenav-widget -->
                           <div class=mainnav>
                              <ul>
                                 <li><a href=index.html><i class="s16 icomoon-icon-screen-2"></i><span class=txt>Dashboard</span></a></li>
                                 <li>
                                    <a href=#><i class="s16 icomoon-icon-stats-up"></i><span class=txt>Charts</span></a>
                                    <ul class=sub>
                                       <li><a href=charts-flot.html><i class="s16 icomoon-icon-arrow-right-3"></i><span class=txt>Flot charts</span></a></li>
                                       <li><a href=charts-rickshaw.html><i class="s16 icomoon-icon-arrow-right-3"></i><span class=txt>Rickshaw charts</span></a></li>
                                       <li><a href=charts-morris.html><i class="s16 icomoon-icon-arrow-right-3"></i><span class=txt>Morris charts</span></a></li>
                                       <li><a href=charts-chartjs.html><i class="s16 icomoon-icon-arrow-right-3"></i><span class=txt>Chartjs</span></a></li>
                                       <li><a href=charts-other.html><i class="s16 icomoon-icon-arrow-right-3"></i><span class=txt>Other charts</span></a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href=#><i class="s16 icomoon-icon-list"></i><span class=txt>Forms</span><span class="notification red">6</span></a>
                                    <ul class=sub>
                                       <li><a href=forms-basic.html><i class="s16 icomoon-icon-file"></i><span class=txt>Basic forms</span></a></li>
                                       <li><a href=forms-advanced.html><i class="s16 icomoon-icon-file"></i><span class=txt>Advanced forms</span></a></li>
                                       <li><a href=forms-layouts.html><i class="s16 icomoon-icon-file"></i><span class=txt>Form layouts</span></a></li>
                                       <li><a href=forms-wizard.html><i class="s16 fa fa-magic"></i><span class=txt>Form wizard</span></a></li>
                                       <li><a href=forms-validation.html><i class="s16 fa fa-check"></i><span class=txt>From validation</span></a></li>
                                       <li><a href=code-editor.html><i class="s16 icomoon-icon-code"></i><span class=txt>Code editor</span></a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href=#><i class="s16 icomoon-icon-table-2"></i><span class=txt>Tables</span></a>
                                    <ul class=sub>
                                       <li><a href=tables-basic.html><i class="s16 icomoon-icon-arrow-right-3"></i><span class=txt>Basic tables</span></a></li>
                                       <li><a href=tables-data.html><i class="s16 icomoon-icon-arrow-right-3"></i><span class=txt>Data tables</span></a></li>
                                       <li><a href=tables-ajax.html><i class="s16 icomoon-icon-arrow-right-3"></i><span class=txt>Ajax tables</span></a></li>
                                       <li><a href=tables-pricing.html><i class="s16 icomoon-icon-arrow-right-3"></i><span class=txt>Pricing tables</span></a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href=#><i class="s16 icomoon-icon-equalizer-2"></i><span class=txt>UI Elements</span></a>
                                    <ul class=sub>
                                       <li><a href=icons.html><i class="s16 icomoon-icon-rocket"></i><span class=txt>Icons</span></a></li>
                                       <li><a href=buttons.html><i class="s16 icomoon-icon-point-up"></i><span class=txt>Buttons</span></a></li>
                                       <li><a href=tabs.html><i class="s16 icomoon-icon-tab"></i><span class=txt>Tabs</span></a></li>
                                       <li><a href=accordions.html><i class="s16 iconic-icon-new-window"></i><span class=txt>Accordions</span></a></li>
                                       <li><a href=modals.html><i class="s16 cut-icon-popout"></i><span class=txt>Modals</span></a></li>
                                       <li><a href=sliders.html><i class="s16 fa fa-sliders"></i><span class=txt>Sliders</span></a></li>
                                       <li><a href=progressbars.html><i class="s16 icomoon-icon-steps"></i><span class=txt>Progressbars</span></a></li>
                                       <li><a href=notifications.html><i class="s16 icomoon-icon-bubble-notification"></i><span class=txt>Notifications</span></a></li>
                                       <li><a href=typo.html><i class="s16 icomoon-icon-font"></i><span class=txt>Typography</span></a></li>
                                       <li><a href=lists.html><i class="s16 icomoon-icon-numbered-list"></i><span class=txt>Lists</span></a></li>
                                       <li><a href=grids.html><i class="s16 icomoon-icon-grid"></i><span class=txt>Grids</span></a></li>
                                       <li><a href=ui-other.html><i class="s16 icomoon-icon-arrow-right-3"></i><span class=txt>Other</span></a></li>
                                    </ul>
                                 </li>
                                 <li><a href=portlets.html><i class="s16 minia-icon-window-4"></i><span class=txt>Portlets</span></a></li>
                                 <li>
                                    <a href=#><i class="s16 icomoon-icon-envelop"></i><span class=txt>Email</span><span class="notification green">12</span></a>
                                    <ul class=sub>
                                       <li><a href=email-inbox.html><i class="s16 fa fa-inbox"></i><span class=txt>Inbox</span></a></li>
                                       <li><a href=email-read.html><i class="s16 fa fa-mail-forward"></i><span class=txt>Read email</span></a></li>
                                       <li><a href=email-write.html><i class="s16 fa fa-mail-reply"></i><span class=txt>Write email</span></a></li>
                                    </ul>
                                 </li>
                                 <li>
                                    <a href=#><i class="s16 icomoon-icon-map"></i><span class=txt>Maps</span></a>
                                    <ul class=sub>
                                       <li><a href=maps-google.html><i class="s16 icomoon-icon-arrow-right-3"></i><span class=txt>Google maps</span></a></li>
                                       <li><a href=maps-vector.html><i class="s16 icomoon-icon-arrow-right-3"></i><span class=txt>Vector maps</span></a></li>
                                    </ul>
                                 </li>
                                 <li><a href=file.html><i class="s16 icomoon-icon-upload"></i><span class=txt>File Manager</span></a></li>
                                 <li><a href=widgets.html><i class="s16 icomoon-icon-cube"></i><span class=txt>Widgets</span><span class="notification red">9</span></a></li>
                                 <li>
                                    <a href=#><i class="s16 icomoon-icon-folder"></i><span class=txt>Pages</span><span class="notification blue">11</span></a>
                                    <ul class=sub>
                                       <li><a href=blank.html><i class="s16 icomoon-icon-file-2"></i><span class=txt>Blank page</span></a></li>
                                       <li><a href=calendar.html><i class="s16 icomoon-icon-calendar"></i><span class=txt>Calendar</span></a></li>
                                       <li><a href=gallery.html><i class="s16 icomoon-icon-image-2"></i><span class=txt>Gallery</span></a></li>
                                       <li><a href=timeline.html><i class="s16 entypo-icon-clock"></i><span class=txt>Timeline</span></a></li>
                                       <li><a href=login.html><i class="s16 icomoon-icon-unlocked"></i><span class=txt>Login</span></a></li>
                                       <li><a href=lock-screen.html><i class="s16 icomoon-icon-lock"></i><span class=txt>Lock screen</span></a></li>
                                       <li><a href=register.html><i class="s16 icomoon-icon-user-plus-2"></i><span class=txt>Register</span></a></li>
                                       <li><a href=lost-password.html><i class="s16 icomoon-icon-file"></i><span class=txt>Lost password</span></a></li>
                                       <li><a href=profile.html><i class="s16 icomoon-icon-profile"></i><span class=txt>User profile</span></a></li>
                                       <li><a href=invoice.html><i class="s16 icomoon-icon-file"></i><span class=txt>Invoice</span></a></li>
                                       <li><a href=faq.html><i class="s16 icomoon-icon-attachment"></i><span class=txt>FAQ</span></a></li>
                                       <li>
                                          <a href=#><i class="s16 icomoon-icon-file"></i><span class=txt>Error pages</span><span class=notification>6</span></a>
                                          <ul class=sub>
                                             <li><a href=403.html><i class="s16 icomoon-icon-file"></i><span class=txt>Error 403</span></a></li>
                                             <li><a href=404.html><i class="s16 icomoon-icon-file"></i><span class=txt>Error 404</span></a></li>
                                             <li><a href=405.html><i class="s16 icomoon-icon-file"></i><span class=txt>Error 405</span></a></li>
                                             <li><a href=500.html><i class="s16 icomoon-icon-file"></i><span class=txt>Error 500</span></a></li>
                                             <li><a href=503.html><i class="s16 icomoon-icon-file"></i><span class=txt>Error 503</span></a></li>
                                             <li><a href=offline.html><i class="s16 icomoon-icon-file"></i><span class=txt>Offline page</span></a></li>
                                          </ul>
                                       </li>
                                    </ul>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <!-- End sidenav -->
                        <div class=sidebar-widget>
                           <h6 class=title>Monthly Bandwidth Transfer</h6>
                           <div class="content clearfix">
                              <i class="s16 icomoon-icon-loop pull-left mr10"></i>
                              <div class="progress progress-bar-xs pull-left mt5 tip" title=87%>
                                 <div class="progress-bar progress-bar-danger" style="width: 87%"></div>
                              </div>
                              <span class="percent pull-right">87%</span>
                              <div class=stat>19419.94 / 12000 MB</div>
                           </div>
                        </div>
                        <!-- End .sidenav-widget -->
                        <div class=sidebar-widget>
                           <h6 class=title>Disk Space Usage</h6>
                           <div class="content clearfix">
                              <i class="s16 icomoon-icon-storage-2 pull-left mr10"></i>
                              <div class="progress progress-bar-xs pull-left mt5 tip" title=16%>
                                 <div class="progress-bar progress-bar-success" style="width: 16%"></div>
                              </div>
                              <span class="percent pull-right">16%</span>
                              <div class=stat>304.44 / 8000 MB</div>
                           </div>
                        </div>
                        <!-- End .sidenav-widget -->
                        <div class=sidebar-widget>
                           <h6 class=title>Ad sense stats</h6>
                           <div class=content>
                              <div class=stats>
                                 <div class=item>
                                    <div class="head clearfix">
                                       <div class=txt>Advert View</div>
                                    </div>
                                    <i class="s16 icomoon-icon-eye pull-left"></i>
                                    <div class=number>21,501</div>
                                    <div class=change><i class="s24 icomoon-icon-arrow-up-2 color-green"></i> 5%</div>
                                    <span id=stat1 class=spark></span>
                                 </div>
                                 <div class=item>
                                    <div class="head clearfix">
                                       <div class=txt>Clicks</div>
                                    </div>
                                    <i class="s16 icomoon-icon-thumbs-up pull-left"></i>
                                    <div class=number>308</div>
                                    <div class=change><i class="s24 icomoon-icon-arrow-down-2 color-red"></i> 8%</div>
                                    <span id=stat2 class=spark></span>
                                 </div>
                                 <div class=item>
                                    <div class="head clearfix">
                                       <div class=txt>Page CTR</div>
                                    </div>
                                    <i class="s16 icomoon-icon-heart pull-left"></i>
                                    <div class=number>4%</div>
                                    <div class=change><i class="s24 icomoon-icon-arrow-down-2 color-red"></i> 1%</div>
                                    <span id=stat3 class=spark></span>
                                 </div>
                                 <div class=item>
                                    <div class="head clearfix">
                                       <div class=txt>Earn money</div>
                                    </div>
                                    <i class="s16 icomoon-icon-coin pull-left"></i>
                                    <div class=number>$376</div>
                                    <div class=change><i class="s24 icomoon-icon-arrow-up-2 color-green"></i> 26%</div>
                                    <span id=stat4 class=spark></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- End .sidenav-widget -->
                        <div class=sidebar-widget>
                           <h6 class=title>Right now</h6>
                           <div class=content>
                              <div class=rightnow>
                                 <ul class=list-unstyled>
                                    <li><span class=number>34</span><i class="s16 icomoon-icon-new"></i>Posts</li>
                                    <li><span class=number>7</span><i class="s16 icomoon-icon-file"></i>Pages</li>
                                    <li><span class=number>14</span><i class="s16 icomoon-icon-list-2"></i>Categories</li>
                                    <li><span class=number>201</span><i class="s16 icomoon-icon-tag"></i>Tags</li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <!-- End .sidenav-widget -->
                     </div>
                     <!-- End .sidebar-scrollarea -->
                  </div>
                  <!-- End .sidebar-inner -->
               </div>
               <!-- End #sidebar --><!--Sidebar background-->
               <div id=right-sidebarbg class="hidden-lg hidden-md hidden-sm hidden-xs"></div>
               <!-- Start #right-sidebar -->
               <aside id=right-sidebar class="right-sidebar hidden-lg hidden-md hidden-sm hidden-xs">
                  <!-- Start .sidebar-inner -->
                  <div class=sidebar-inner>
                     <!-- Start .sidebar-scrollarea -->
                     <div class=sidebar-scrollarea>
                        <div class="pl10 pt10 pr5">
                           <ul class="timeline timeline-icons">
                              <li>
                                 <p><a href=#>Jonh Doe</a> attached new <a href=#>file</a> <span class=timeline-icon><i class="fa fa-file-text-o"></i></span> <span class=timeline-date>Dec 10, 22:00</span></p>
                              </li>
                              <li>
                                 <p><a href=#>Admin</a> approved <a href=#>3 new comments</a> <span class=timeline-icon><i class="fa fa-comment"></i></span> <span class=timeline-date>Dec 8, 13:35</span></p>
                              </li>
                              <li>
                                 <p><a href=#>Jonh Smith</a> deposit 300$ <span class=timeline-icon><i class="fa fa-money color-green"></i></span> <span class=timeline-date>Dec 6, 10:17</span></p>
                              </li>
                              <li>
                                 <p><a href=#>Serena Williams</a> purchase <a href=#>3 items</a> <span class=timeline-icon><i class="fa fa-shopping-cart color-red"></i></span> <span class=timeline-date>Dec 5, 04:36</span></p>
                              </li>
                              <li>
                                 <p><a href=#>1 support</a> request is received from <a href=#>Klaudia Chambers</a> <span class=timeline-icon><i class="fa fa-life-ring color-gray-light"></i></span> <span class=timeline-date>Dec 4, 18:40</span></p>
                              </li>
                              <li>
                                 <p>You received 136 new likes for <a href=#>your page</a> <span class=timeline-icon><i class="glyphicon glyphicon-thumbs-up"></i></span> <span class=timeline-date>Dec 4, 12:00</span></p>
                              </li>
                              <li>
                                 <p><a href=#>12 settings</a> are changed from <a href=#>Master Admin</a> <span class=timeline-icon><i class="glyphicon glyphicon-cog"></i></span> <span class=timeline-date>Dec 3, 23:17</span></p>
                              </li>
                              <li>
                                 <p><a href=#>Klaudia Chambers</a> change your photo <span class=timeline-icon><i class=icomoon-icon-image-2></i></span> <span class=timeline-date>Dec 2, 05:17</span></p>
                              </li>
                              <li>
                                 <p><a href=#>Master server</a> is down for 10 min. <span class=timeline-icon><i class=icomoon-icon-database></i></span> <span class=timeline-date>Dec 2, 04:56</span></p>
                              </li>
                              <li>
                                 <p><a href=#>12 links</a> are broken <span class=timeline-icon><i class="fa fa-unlink"></i></span> <span class=timeline-date>Dec 1, 22:13</span></p>
                              </li>
                              <li>
                                 <p><a href=#>Last backup</a> is restored by <a href=#>Master admin</a> <span class=timeline-icon><i class="fa fa-undo color-red"></i></span> <span class=timeline-date>Dec 1, 17:42</span></p>
                              </li>
                           </ul>
                           <a href=# class="btn btn-default timeline-load-more-btn"><i class="fa fa-refresh"></i> Load more</a>
                        </div>
                     </div>
                     <!-- End .sidebar-scrollarea -->
                  </div>
                  <!-- End .sidebar-inner -->
               </aside>
               <!-- End #right-sidebar --><!--Body content-->
               <div id=content class="page-content clearfix">
                  <div class=contentwrapper>
                     <!--Content wrapper-->
                     <div class=heading>
                        <!--  .heading-->
                        <h3>FAQ</h3>
                        <div class=resBtnSearch><a href=#><span class="s16 icomoon-icon-search-3"></span></a></div>
                        <div class=search>
                           <!-- .search -->
                           <form id=searchform class=form-horizontal action="http://themes.suggelab.com/supr/search.html"><input class="top-search from-control" placeholder="Search here ..."> <input type=submit class=search-btn></form>
                        </div>
                        <!--  /search -->
                        <ul class=breadcrumb>
                           <li>You are here:</li>
                           <li><a href=# class=tip title="back to dashboard"><i class="s16 icomoon-icon-screen-2"></i></a> <span class=divider><i class="s16 icomoon-icon-arrow-right-3"></i></span></li>
                           <li class=active>Blank Page</li>
                        </ul>
                     </div>
                     <!-- End  / heading--><!-- Start .row -->
                     <div class=row>
                        <div class=col-md-12>
                           <!-- col-md-12 start here -->
                           <div class=page-header>
                              <h4>Search for specific question.</h4>
                           </div>
                           <div class=faq-search>
                              <form id=searchform action="http://themes.suggelab.com/supr/search.html" class=form-horizontal role=form>
                                 <div class=form-group>
                                    <div class=col-lg-12><input class="searchfield text form-control" placeholder="Find question ..."> <input type=submit class="search-btn nostyle"></div>
                                 </div>
                                 <!-- End .form-group  -->
                              </form>
                           </div>
                           <div class=page-header>
                              <h4>Categories</h4>
                           </div>
                           <div class="categories row">
                              <div class=col-lg-4>
                                 <ul>
                                    <li><i class="s16 icomoon-icon-folder"></i><a href=#>cPanel</a> <span class="label label-info">2</span></li>
                                    <li><i class="s16 icomoon-icon-folder"></i><a href=#>MySQL</a> <span class="label label-info">4</span></li>
                                    <li><i class="s16 icomoon-icon-folder"></i><a href=#>Security</a> <span class="label label-info">2</span></li>
                                    <li><i class="s16 icomoon-icon-folder"></i><a href=#>Software Version</a> <span class="label label-info">2</span></li>
                                    <li><i class="s16 icomoon-icon-folder"></i><a href=#>For new clients</a> <span class="label label-info">2</span></li>
                                 </ul>
                              </div>
                              <!-- End span4 -->
                              <div class=col-lg-4>
                                 <ul>
                                    <li><i class="s16 icomoon-icon-folder"></i><a href=#>DNS</a> <span class="label label-info">1</span></li>
                                    <li><i class="s16 icomoon-icon-folder"></i><a href=#>VPS servers</a> <span class="label label-info">2</span></li>
                                    <li><i class="s16 icomoon-icon-folder"></i><a href=#>Technology</a> <span class="label label-info">1</span></li>
                                    <li><i class="s16 icomoon-icon-folder"></i><a href=#>Domains</a> <span class="label label-info">3</span></li>
                                    <li><i class="s16 icomoon-icon-folder"></i><a href=#>Abuses</a> <span class="label label-info">2</span></li>
                                 </ul>
                              </div>
                              <!-- End span4 -->
                              <div class=col-lg-4>
                                 <ul>
                                    <li><i class="s16 icomoon-icon-folder"></i><a href=#>FTP</a> <span class="label label-info">3</span></li>
                                    <li><i class="s16 icomoon-icon-folder"></i><a href=#>Main questions</a> <span class="label label-info">5</span></li>
                                    <li><i class="s16 icomoon-icon-folder"></i><a href=#>File description</a> <span class="label label-info">1</span></li>
                                    <li><i class="s16 icomoon-icon-folder"></i><a href=#>Emails</a> <span class="label label-info">1</span></li>
                                 </ul>
                              </div>
                              <!-- End span4 -->
                           </div>
                           <div class=page-header>
                              <h4>Popular</h4>
                           </div>
                           <div class="popular-question row">
                              <div class=col-lg-6>
                                 <ul>
                                    <li>
                                       <i class="s16 icomoon-icon-file"></i> <a href=# class=title>What is cPanel?</a>
                                       <p class=txt>cPanel is the most popular web hosting control panel in the world. With it you can ...</p>
                                       <span class=info>Read <strong>1998</strong> times</span>
                                    </li>
                                    <li>
                                       <i class="s16 icomoon-icon-file"></i> <a href=# class=title>What should I do if my account is hacked?</a>
                                       <p class=txt>If your account is hacked you should do the following to ensure it in ...</p>
                                       <span class=info>Read <strong>860</strong> times</span>
                                    </li>
                                    <li>
                                       <i class="s16 icomoon-icon-file"></i> <a href=# class=title>What to do when my account using too much server resources?</a>
                                       <p class=txt>Why are there limits on server resources that can be used by one ...</p>
                                       <span class=info>Read <strong>1356</strong> times</span>
                                    </li>
                                 </ul>
                              </div>
                              <!-- End span6 -->
                              <div class=col-lg-6>
                                 <ul>
                                    <li>
                                       <i class="s16 icomoon-icon-file"></i> <a href=# class=title>What is cPanel?</a>
                                       <p class=txt>cPanel is the most popular web hosting control panel in the world. With it you can ...</p>
                                       <span class=info>Read <strong>1998</strong> times</span>
                                    </li>
                                    <li>
                                       <i class="s16 icomoon-icon-file"></i> <a href=# class=title>What should I do if my account is hacked?</a>
                                       <p class=txt>If your account is hacked you should do the following to ensure it in ...</p>
                                       <span class=info>Read <strong>860</strong> times</span>
                                    </li>
                                    <li>
                                       <i class="s16 icomoon-icon-file"></i> <a href=# class=title>What to do when my account using too much server resources?</a>
                                       <p class=txt>Why are there limits on server resources that can be used by one ...</p>
                                       <span class=info>Read <strong>1356</strong> times</span>
                                    </li>
                                 </ul>
                              </div>
                              <!-- End span6 -->
                           </div>
                           <!-- End .popular-question -->
                           <div class=page-header>
                              <h4>MySQL questions</h4>
                           </div>
                           <div class="popular-question row">
                              <div class=col-lg-6>
                                 <ul>
                                    <li>
                                       <i class="s16 icomoon-icon-file"></i> <a href=# class=title>How can I edit the information in MySQL databases online?</a>
                                       <p class=txt>Each hosting account has installed PhpMyAdmin, which is ..</p>
                                       <span class=info>Read <strong>1998</strong> times</span>
                                    </li>
                                    <li>
                                       <i class="s16 icomoon-icon-file"></i> <a href=# class=title>What is version of MySQL?</a>
                                       <p class=txt>On our servers installed MySQL 5.x version.</p>
                                       <span class=info>Read <strong>860</strong> times</span>
                                    </li>
                                    <li>
                                       <i class="s16 icomoon-icon-file"></i> <a href=# class=title>What is the address of my MySQL server?</a>
                                       <p class=txt>Ако се свързвате към сървъра от нашата машина можете...</p>
                                       <span class=info>Read <strong>1356</strong> times</span>
                                    </li>
                                 </ul>
                              </div>
                              <!-- End span6 -->
                              <div class=col-lg-6>
                                 <ul>
                                    <li>
                                       <i class="s16 icomoon-icon-file"></i> <a href=# class=title>How can I edit the information in MySQL databases online?</a>
                                       <p class=txt>Each hosting account has installed PhpMyAdmin, which is ..</p>
                                       <span class=info>Read <strong>1998</strong> times</span>
                                    </li>
                                    <li>
                                       <i class="s16 icomoon-icon-file"></i> <a href=# class=title>What is version of MySQL?</a>
                                       <p class=txt>On our servers installed MySQL 5.x version.</p>
                                       <span class=info>Read <strong>860</strong> times</span>
                                    </li>
                                    <li>
                                       <i class="s16 icomoon-icon-file"></i> <a href=# class=title>What is the address of my MySQL server?</a>
                                       <p class=txt>Ако се свързвате към сървъра от нашата машина можете...</p>
                                       <span class=info>Read <strong>1356</strong> times</span>
                                    </li>
                                 </ul>
                              </div>
                              <!-- End span6 -->
                           </div>
                           <div class=answer>
                              <div class=page-header>
                                 <h4>How can I edit the information in MySQL databases online?</h4>
                              </div>
                              <p>Each hosting account has installed PhpMyAdmin, which is available in cPanel, MySQL. With it, you can change the content databases you real-time data. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                              <div class=info>
                                 <div class="well row">
                                    <div class=col-lg-4>Was this answer helpful? <input type=radio name=optionsRadios id=optionsRadios1 value=option1 checked> Yes <input type=radio name=optionsRadios id=optionsRadios1 value="option1"> No</div>
                                    <!-- End span4 -->
                                    <div class=col-lg-4><a href=#><i class="s16 icomoon-icon-heart"></i> Add to favorites</a></div>
                                    <!-- End span4 -->
                                    <div class=col-lg-4><a href=#><i class="s16 icomoon-icon-print"></i> Print this answer</a></div>
                                    <!-- End span4 -->
                                 </div>
                              </div>
                           </div>
                           <!-- End answer -->
                        </div>
                        <!-- col-md-12 end here -->
                     </div>
                     <!-- End .row -->
                  </div>
                  <!-- End contentwrapper -->
               </div>
               <!-- End #content -->
               <div id=footer class="clearfix sidebar-page right-sidebar-page">
                  <!-- Start #footer  -->
                  <p class=pull-left>Copyrights &copy; 2014 <a href="http://suggeelson.com/" class="color-blue strong" target=_blank>SuggeElson</a>. All rights reserved.</p>
                  <p class=pull-right><a href=# class=mr5>Terms of use</a> | <a href=# class="ml5 mr25">Privacy police</a></p>
               </div>
               <!-- End #footer  -->
            </div>
            <!-- / #wrapper --><!-- Back to top -->
            <div id=back-to-top><a href=#>Back to Top</a></div>
            <!-- Javascripts --><!-- Load pace first --><script src=plugins/core/pace/pace.min.js></script><!-- Important javascript libs(put in all pages) --><script src=http://code.jquery.com/jquery-2.1.1.min.js></script><script>window.jQuery || document.write('<script src="js/libs/jquery-2.1.1.min.js">\x3C/script>')</script><script src=http://code.jquery.com/ui/1.10.4/jquery-ui.js></script><script>window.jQuery || document.write('<script src="js/libs/jquery-ui-1.10.4.min.js">\x3C/script>')</script><script src=http://code.jquery.com/jquery-migrate-1.2.1.min.js></script><script>window.jQuery || document.write('<script src="js/libs/jquery-migrate-1.2.1.min.js">\x3C/script>')</script>
            <!--[if lt IE 9]>
            <script type="text/javascript" src="js/libs/excanvas.min.js"></script>
            <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <script type="text/javascript" src="js/libs/respond.min.js"></script>
            <![endif]--><script src=js/pages/faq.js></script><!-- Google Analytics:  -->
            <script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
               (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
               m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
               })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
               
               ga('create', 'UA-3560057-23', 'auto');
               ga('send', 'pageview');
            </script>

