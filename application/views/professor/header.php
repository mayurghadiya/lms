
<!DOCTYPE html>
<!--[if lt IE 8]>
<html class="no-js lt-ie8">
   <![endif]--><!--[if gt IE 8]><!-->
<html class=no-js>
    <!--<![endif]-->
    <html class=no-js>
        <head>
            <meta charset=utf-8>
            <title><?php echo $title; ?> | Learning Management System</title>
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
            <link rel=stylesheet href=<?php echo base_url(); ?>assets/css/main.min.css>

            <!-- jQuery -->
            <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>

            <!-- Fav and touch icons -->
            <link rel=apple-touch-icon-precomposed sizes=144x144 href=<?php echo base_url(); ?>assets/img/ico/apple-touch-icon-144-precomposed.png>
            <link rel=apple-touch-icon-precomposed sizes=114x114 href=<?php echo base_url(); ?>assets/img/ico/apple-touch-icon-114-precomposed.png>
            <link rel=apple-touch-icon-precomposed sizes=72x72 href=<?php echo base_url(); ?>assets/img/ico/apple-touch-icon-72-precomposed.png>
            <link rel=apple-touch-icon-precomposed href=<?php echo base_url(); ?>assets/img/ico/apple-touch-icon-57-precomposed.png>
            <link rel=icon href=<?php echo base_url(); ?>assets/img/ico/favicon.ico type=image/png>
            <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
            <meta name=msapplication-TileColor content="#3399cc">
            <script>
                var base_url = '<?php echo base_url(); ?>';
            </script>

        <body>
            <!--[if lt IE 9]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]--><!-- .#header -->
            <div id="header">
                <nav class="navbar navbar-default" role=navigation>
                    <div class="navbar-header">
                        <a class="navbar-brand" href=index.html>
                            <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="logo">
                        </a>
                    </div>
                    <div id="navbar-no-collapse" class="navbar-no-collapse">
                        <ul class="nav navbar-nav">
                            <li>
                                <!--Sidebar collapse button-->
                                <a href=# class="collapseBtn leftbar"><i class="fa fa-bars" aria-hidden="true"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href=# class=dropdown-toggle data-toggle=dropdown>
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span class=txt>Messages</span><span class=notification>8</span></a>
                                <ul class="dropdown-menu left">
                                    <li class=menu>
                                        <ul class=messages>
                                            <li class=header><strong>Messages</strong> (10) emails and (2) PM</li>
                                            <li><span class=icon>
                                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                </span> <span class=name><a data-toggle=modal href=#myModal1><strong>Sammy Morerira</strong></a><span class=time>35 min ago</span></span> <span class=msg>I have question about new function ...</span>
                                            </li>
                                            <li><span class="icon avatar"><img src=<?php echo base_url(); ?>assets/img/avatar.jpg alt=""></span> <span class=name><a data-toggle=modal href=#myModal1><strong>George Michael</strong></a><span class=time>1 hour ago</span></span> <span class=msg>I need to meet you urgent please call me ...</span>
                                            </li>
                                            <li><span class=icon><i class="fa fa-envelope-o" aria-hidden="true"></i></span> <span class=name><a data-toggle=modal href=#myModal1><strong>Ivanovich</strong></a><span class=time>1 day ago</span></span> <span class=msg>I send you my suggestion, please look and ...</span>
                                            </li>
                                            <li class=view-all><a href=#>View all messages <i class="s16 fa fa-angle-double-right"></i></a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-right usernav">
                            <li class="dropdown">
                                <a href=# class="dropdown-toggle" data-toggle=dropdown>
                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                    <span class="notification">3</span>
                                </a>
                                <ul class="dropdown-menu right">
                                    <li class=menu>
                                        <ul class=notif>
                                            <li class=header><strong>Notifications</strong> (3) items</li>
                                            <li><a href=#><span class=icon>
                                                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                    </span> <span class=event>1 User is registred</span></a>
                                            </li>
                                            <li><a href=#><span class=icon><i class="s16 fa fa-commenting"></i></span> <span class=event>Jony add 1 comment</span></a>
                                            </li>
                                            <li><a href=#><span class=icon><i class="s16 fa fa-newspaper-o"></i></span> <span class=event>admin Julia added post with a long description</span></a>
                                            </li>
                                            <li class=view-all><a href=#>View all notifications <i class="s16 fa fa-angle-double-right"></i></a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class=dropdown>
                                <a href=# class="dropdown-toggle avatar" data-toggle=dropdown><img src=<?php echo base_url(); ?>assets/img/avatar.jpg alt="" class="image"> <span class=txt>student@lms.com</span> <b class=caret></b>
                                </a>
                                <ul class="dropdown-menu right">
                                    <li class=menu>
                                        <ul>
                                            <li><a href=#>
                                                    <i class="fa fa-user-plus" aria-hidden="true"></i>Edit profile</a>
                                            </li>
                                            <li><a href=#><i class="fa fa-comment-o" aria-hidden="true"></i></i>Comments</a>
                                            </li>
                                            <li><a href=#><i class="fa fa-plus" aria-hidden="true"></i>Add user</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url(); ?>site/logout">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i><span class=txt>Logout</span>
                                </a>
                            </li>
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
                <div id="sidebar" class="page-sidebar hidden-lg hidden-md hidden-sm hidden-xs">
                    <div class=shortcuts>
                        <ul>
                            <li><a href="support.html" title="Support section" class=tip>
                                    <i class="fa fa-life-ring" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li><a href="#" title="Database backup" class=tip>
                                    <i class="fa fa-database" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li><a href="#" title="Reports" class=tip>
                                    <i class="fa fa-pie-chart" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li><a href=# title="Write post" class=tip>
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End search -->
                    <!-- Start .sidebar-inner -->
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
                                        <li>
                                            <a href="<?php echo base_url(); ?>professor/dashboard">
                                                <i class="fa fa-desktop" aria-hidden="true"></i>
                                                <span class=txt>Dashboard</span>
                                            </a>
                                        </li>                             

                                        <li class="hasSub">
                                            <a href="#" class="notExpand"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 icomoon-icon-folder"></i>
                                                <span class="txt">Basic Management</span></a>
                                            <ul class="sub">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/student">
                                                        <i class="s16 icomoon-icon-file-2"></i>
                                                        <span class="txt">Student</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/subject">
                                                        <i class="s16 icomoon-icon-file"></i>
                                                        <span class="txt">Subject</span></a></li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/syllabus">
                                                        <i class="s16 icomoon-icon-image-2"></i>
                                                        <span class="txt">Syllabus</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/holiday">
                                                        <i class="s16 entypo-icon-clock"></i>
                                                        <span class="txt">Holiday</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/assessments">
                                                        <i class="s16 icomoon-icon-unlocked"></i>
                                                        <span class="txt">Assessments</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="hasSub">
                                            <a href="#" class="notExpand"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 icomoon-icon-folder"></i>
                                                <span class="txt">Assets Management</span></a>
                                            <ul class="sub">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/events">
                                                        <i class="s16 icomoon-icon-screen-2"></i>
                                                        <span class="txt">Events</span>
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/assignment">
                                                        <i class="s16 icomoon-icon-file-2"></i>
                                                        <span class="txt">Assignments</span>
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/study_resource">
                                                        <i class="s16 icomoon-icon-attachment"></i>
                                                        <span class="txt">Study Resources</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/project">
                                                        <i class="s16 icomoon-icon-unlocked"></i>
                                                        <span class="txt">Project/Synopsis</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/digital_library">
                                                        <i class="s16 icomoon-icon-file-2"></i>
                                                        <span class="txt">Digital Library</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/participate">
                                                        <i class="s16 icomoon-icon-user-plus-2"></i>
                                                        <span class="txt">Participate</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/courseware">
                                                        <i class="s16 icomoon-icon-attachment"></i>
                                                        <span class="txt">Courseware</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="hasSub">
                                            <a href="#" class="notExpand"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 icomoon-icon-lock"></i>
                                                <span class="txt">University</span></a>
                                            <ul class="sub">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/graduate">
                                                        <i class="s16 icomoon-icon-screen-2"></i>
                                                        <span class="txt">Toppers Graduate</span>
                                                    </a>
                                                </li>                                          
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url(); ?>professor/attendance">
                                                <i class="s16 fa fa-university"></i>
                                                <span class=txt>Attendance </span>
                                            </a>
                                        </li>
                                        <li class="hasSub">
                                            <a href="#" class="notExpand"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 icomoon-icon-lock"></i>
                                                <span class="txt">Examination</span></a>
                                            <ul class="sub">
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/exam">
                                                        <i class="s16 icomoon-icon-screen-2"></i>
                                                        <span class="txt">Exam</span>
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/exam_schedule">
                                                        <i class="s16 icomoon-icon-screen-2"></i>
                                                        <span class="txt">Exam Schedule</span>
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a href="<?php echo base_url(); ?>professor/exam_marks">
                                                        <i class="s16 icomoon-icon-screen-2"></i>
                                                        <span class="txt">Exam Marks</span>
                                                    </a>
                                                </li>  
                                            </ul>
                                        </li>
                                        <li class="hasSub">
                                            <a href="#" class="notExpand"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 icomoon-icon-lock"></i>
                                                <span class="txt">Email</span></a>
                                            <ul class="sub">
                                                <li>
                                                    <a href="">
                                                        <i class="s16 icomoon-icon-screen-2"></i>
                                                        <span class="txt">Compose</span>
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a href="">
                                                        <i class="s16 icomoon-icon-screen-2"></i>
                                                        <span class="txt">Inbox</span>
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a href="">
                                                        <i class="s16 icomoon-icon-screen-2"></i>
                                                        <span class="txt">Sent</span>
                                                    </a>
                                                </li>  
                                            </ul>
                                        </li>
                                </div>
                            </div>
                            <!-- End sidenav -->

                            <!-- End .sidenav-widget -->
                        </div>
                        <!-- End .sidebar-scrollarea -->
                    </div>
                    <!-- End .sidebar-inner -->
                </div>
                <!-- End #sidebar --><!--Sidebar background-->


                <!-- End #right-sidebar --><!--Body content-->
                <div id=content class="page-content clearfix">
                    <div class=contentwrapper>
                        <!--Content wrapper-->
                        <div class=heading>
                            <!--  .heading-->
                            <h3><?php echo $title; ?></h3>
                            <div class=resBtnSearch><a href=#><span class="s16 icomoon-icon-search-3"></span></a></div>
                            <div class=search>
                                <!-- .search -->
                                <form id=searchform class=form-horizontal action=search.html><input class="top-search from-control" placeholder="Search here ..."> <input type=submit class=search-btn></form>
                            </div>
                            <!--  /search -->
                            <ul class=breadcrumb>
                                <li>You are here:</li>
                                <li><a href=# class=tip title="back to dashboard"><i class="s16 icomoon-icon-screen-2"></i></a> <span class=divider><i class="s16 icomoon-icon-arrow-right-3"></i></span></li>
                                <li class=active>Blank Page</li>
                            </ul>
                        </div>
                        <!-- End  / heading-->