
<!DOCTYPE html>
<!--[if lt IE 8]>
<html class="no-js lt-ie8">
   <![endif]--><!--[if gt IE 8]><!-->
<html class=no-js>
    <!--<![endif]-->
    <html class=no-js>
        <head>
            <meta charset=utf-8>
            <title><?php echo $title; ?> | <?php echo system_name(); ?></title>
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
            <?php
            $this->carabiner->css('jquery.mCustomScrollbar.min.css');
            $this->carabiner->css('plugins.css');
            $this->carabiner->css('main.min.css');
            $this->carabiner->css('custom.css');
            $this->carabiner->display('css');
            ?>

            <!-- jQuery -->
            <?php
            $this->carabiner->js('jquery-2.1.1.min.js');
            $this->carabiner->display('js');
            ?>

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
        </head>

        <body class="<?php echo $this->router->fetch_method(); ?> professor_dashboard">
            <!--[if lt IE 9]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]--><!-- .#header -->
            <div id="header">
                <nav class="navbar navbar-default" role=navigation>
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo base_url(); ?>professor">
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
                                <a href="<?php echo base_url(); ?>professor/email_inbox">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span class=txt>Messages</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-right usernav">
                            <li class="dropdown">
                                <a href=# class="dropdown-toggle" data-toggle=dropdown>
                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                    <span class="notification"></span>
                                </a>
                                <ul class="dropdown-menu right">
                                    <li class=menu>
                                        <ul class=notif>
                                            <li class=header><strong>Notifications</strong></li>

                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class=dropdown>
                                <a href=# class="dropdown-toggle avatar" data-toggle=dropdown><img src=<?php echo base_url() . 'uploads/professor/' . $this->session->userdata('image_path'); ?> alt="" class="image"> 
                                    <span class=txt><?php echo $this->session->userdata('email'); ?></span> <b class=caret></b>
                                </a>
                                <ul class="dropdown-menu right">
                                    <li class=menu>
                                        <ul>
                                            <li>
                                                <a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i>Home</a>
                                            <li>
                                                <a href="<?php echo base_url() . 'professor/manage_profile' ?>">
                                                    <i class="fa fa-user" aria-hidden="true"></i>Edit profile</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url(); ?>site/logout"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
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
                            <li><a href="<?php echo base_url(); ?>professor/attendance" title="Daily Attendance" class=tip>
                                    <i class="fa fa-life-ring" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>professor/assignment" title="Assignments" class=tip>
                                    <i class="fa fa-database" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>professor/project" title="Projects" class=tip>
                                    <i class="fa fa-university" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>professor/subject" title="Subject" class=tip>
                                    <i class="fa fa-book" aria-hidden="true"></i>
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
                                            <a <?php echo active_single_menu('dashboard', $page); ?> href="<?php echo base_url(); ?>professor/dashboard">
                                                <i class="fa fa-dashboard" aria-hidden="true"></i>
                                                <span class=txt>Dashboard</span>
                                            </a>
                                        </li>          

                                        <?php
                                        $pages = [
                                            'student', 'subject', 'syllabus', 'holiday', 'assessments', 'vocational_register_student', 'vocational_course'
                                        ];
                                        ?>

                                        <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                            <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 fa fa-chain"></i>
                                                <span class="txt">Basic Management</span></a>
                                            <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                                <li>
                                                    <a id="link-student" href="<?php echo base_url(); ?>professor/student">
                                                        <i class="s16 icomoon-icon-user-plus-2"></i>
                                                        <span class="txt">Student</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a id="link-subject" href="<?php echo base_url(); ?>professor/subject">
                                                        <i class="s16 fa fa-book"></i>
                                                        <span class="txt">Subject</span></a></li>
                                                <li>
                                                    <a id="link-syllabus" href="<?php echo base_url(); ?>professor/syllabus">
                                                        <i class="s16 fa fa-list"></i>
                                                        <span class="txt">Syllabus</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a id="link-holiday" href="<?php echo base_url(); ?>professor/holiday">
                                                        <i class="s16 fa fa-calendar"></i>
                                                        <span class="txt">Holiday</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a id="link-assessments" href="<?php echo base_url(); ?>professor/assessments">
                                                        <i class="s16 icomoon-icon-unlocked"></i>
                                                        <span class="txt">Assessments</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a id="link-vocational_course" href="<?php echo base_url(); ?>professor/vocationalcourse">
                                                        <i class="s16 fa fa-newspaper-o"></i>
                                                        <span class="txt">Vocational Course</span>
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </li>

                                        <?php
                                        $pages = [
                                            'events', 'assignments', 'study_resources', 'project', 'digital_library',
                                            'participate', 'courseware'
                                        ];
                                        ?>

                                        <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                            <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 icomoon-icon-folder"></i>
                                                <span class="txt">Assets Management</span></a>
                                            <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                                <li>
                                                    <a id="link-events" href="<?php echo base_url(); ?>professor/events">
                                                        <i class="s16 fa fa-calendar"></i>
                                                        <span class="txt">Events</span>
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a id="link-assignments" href="<?php echo base_url(); ?>professor/assignment">
                                                        <i class="s16 fa fa-book"></i>
                                                        <span class="txt">Assignments</span>
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a id="link-study_resources" href="<?php echo base_url(); ?>professor/study_resource">
                                                        <i class="s16 fa fa-pencil-square"></i>
                                                        <span class="txt">Study Resources</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a id="link-project" href="<?php echo base_url(); ?>professor/project">
                                                        <i class="s16 fa fa-code-fork"></i>
                                                        <span class="txt">Project/Synopsis</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a id="link-digital_library" href="<?php echo base_url(); ?>professor/digital_library">
                                                        <i class="s16 icomoon-icon-file-2"></i>
                                                        <span class="txt">Digital Library</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a id="link-participate" href="<?php echo base_url(); ?>professor/participate">
                                                        <i class="s16 icomoon-icon-user-plus-2"></i>
                                                        <span class="txt">Participate</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a id="link-courseware" href="<?php echo base_url(); ?>professor/courseware">
                                                        <i class="s16 icomoon-icon-attachment"></i>
                                                        <span class="txt">Courseware</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a <?php echo active_single_menu('class_routine', $page); ?> href="<?php echo base_url(); ?>professor/class_routine">
                                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                                <span class=txt>Class Routine </span>
                                            </a>
                                        </li> 
                                        <li>
                                            <a  href="<?php echo base_url(); ?>site/forums">
                                                <i class="fa fa-comment" aria-hidden="true"></i>
                                                <span class=txt>Forum & Discussion</span>
                                            </a>
                                        </li> 
                                        <?php
                                        $pages = [
                                            'graduates'
                                        ];
                                        ?>

                                        <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                            <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 icomoon-icon-lock"></i>
                                                <span class="txt">University</span></a>
                                            <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                                <li>
                                                    <a id="link-graduates" href="<?php echo base_url(); ?>professor/graduate">
                                                        <i class="s16 fa fa-graduation-cap"></i>
                                                        <span class="txt">Toppers Graduate</span>
                                                    </a>
                                                </li>                                          
                                            </ul>
                                        </li>
                                        <li>
                                            <a <?php echo active_single_menu('attendance', $page); ?> href="<?php echo base_url(); ?>professor/attendance">
                                                <i class="s16 fa fa-calculator"></i>
                                                <span class=txt>Attendance </span>
                                            </a>
                                        </li>

                                        <?php
                                        $pages = [
                                            'exam', 'exam_schedule', 'exam_marks'
                                        ];
                                        ?>

                                        <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                            <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 fa fa-pencil"></i>
                                                <span class="txt">Examination</span></a>
                                            <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                                <li>
                                                    <a id="link-exam" href="<?php echo base_url(); ?>professor/exam">
                                                        <i class="s16 fa fa-paper-plane-o"></i>
                                                        <span class="txt">Exam</span>
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a id="link-exam_schedule" href="<?php echo base_url(); ?>professor/exam_schedule">
                                                        <i class="s16 fa fa-history"></i>
                                                        <span class="txt">Exam Schedule</span>
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a id="link-exam_marks" href="<?php echo base_url(); ?>professor/exam_marks">
                                                        <i class="s16 fa fa-star-o"></i>
                                                        <span class="txt">Exam Marks</span>
                                                    </a>
                                                </li>  
                                            </ul>
                                        </li>

                                        <?php
                                        $pages = [
                                            'email_compose', 'email_inbox', 'email_sent'
                                        ];
                                        ?>

                                        <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                            <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 fa fa-envelope"></i>
                                                <span class="txt">Email</span></a>
                                            <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                                <li>
                                                    <a id="link-email_compose" href="<?php echo base_url(); ?>professor/email_compose">
                                                        <i class="s16 fa fa-envelope"></i>
                                                        <span class="txt">Compose</span>
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a id="link-email_inbox" href="<?php echo base_url(); ?>professor/email_inbox">
                                                        <i class="s16 fa fa-inbox"></i>
                                                        <span class="txt">Inbox</span>
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a id="link-email_sent" href="<?php echo base_url(); ?>professor/email_sent">
                                                        <i class="s16 fa fa-send"></i>
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
                            <div class=resBtnSearch><a href=#><span class="s16 icomoon-icon-search-3"></span></a>
                            </div>
                            <div class="search_box">
                                <!-- .search -->
                                <form action="<?php echo base_url(); ?>student/search" method="post" class="form-horizontal" id="searchform">
                                    <input value="" placeholder="Search here ..." class="top-search from-control" name="search"> 
                                    <input type="submit" class="search-btn">
                                    <div class="category">
                                        <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            Category                                     
                                        </a>

                                        <ul class="dropdown-menu" style="margin-left: -46.3833px;">
                                            <li class="menu">
                                                <ul>
                                                    <li>
                                                        <label>
                                                            <div class="checkbox-custom">
                                                                <input type="checkbox" name="exam" value="exam" 
                                                                       <?php if (isset($from['exam'])) echo 'checked'; ?>><label for="chbox0"></label></div>
                                                            <span>Exam</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <div class="checkbox-custom">
                                                                <input type="checkbox" name="assignment" value="assignment"
                                                                       <?php if (isset($from['assignment'])) echo 'checked'; ?>><label for="chbox1"></label></div>
                                                            <span>Assignment</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <div class="checkbox-custom">
                                                                <input type="checkbox" name="participate" value="participate"
                                                                       <?php if (isset($from['participate'])) echo 'checked'; ?>><label for="chbox2"></label></div>
                                                            <span>Participate</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <div class="checkbox-custom">
                                                                <input type="checkbox" name="event" value="event"
                                                                       <?php if (isset($from['event'])) echo 'checked'; ?>><label for="chbox3"></label></div>
                                                            <span>Events</span>
                                                        </label>
                                                    </li> 
                                                </ul>                                           
                                            </li>
                                        </ul> 
                                    </div>
                                </form>
                            </div>
                            <?php echo create_breadcrumb(); ?>

                            <?php echo set_active_menu($page); ?>
                        </div>

                        <!-- End  / heading-->
