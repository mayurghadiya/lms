<!DOCTYPE html>
<html class=no-js>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?> | <?php echo system_name(); ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Import google fonts - Heading first/ text second -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel=stylesheet type=text/css>
        <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel=stylesheet type=text/css>
        <!-- Css files -->
        <?php
        //calendar css
        $css = [
            ['event_calendar/eventCalendar.css'],
            ['event_calendar/eventCalendar_theme_responsive.css']
        ];
        $this->carabiner->group('calendar_css', [
            'css' => $css
        ]);
        $this->carabiner->display('calendar_css');

        //header css
        $css = [
            ['jquery.mCustomScrollbar.min.css'],
            ['main.min.css'],
            ['plugins.css'],
            ['custom.css']
        ];
        $this->carabiner->group('header_css', [
            'css' => $css
        ]);
        $this->carabiner->display('header_css');

        //scollbar
        $this->carabiner->css('jquery.mCustomScrollbar.min.css');
        $this->carabiner->display('css');

        //Js
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
        <style>                
            .notification2 {
                background: #ed7a53 none repeat scroll 0 0;
                border-radius: 2px;
                box-shadow: 0 1px 0 0 rgba(0, 0, 0, 0.2);
                color: #fff;
                font-family: Tahoma;
                font-size: 12px;
                font-weight: 700;
                padding: 0 7px;
                position: relative;
                right: 10px;
                text-shadow: none;
                top: 11px;
            }
        </style>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="<?php echo $this->router->fetch_method(); ?>">
        <!--[if lt IE 9]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]--><!-- .#header -->
        <div id="header">
            <nav class="navbar navbar-default" role=navigation>
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>admin">
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
                            <a href="<?php echo base_url(); ?>admin/email_inbox">
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
                                        <li class=header><strong>No notification is there</strong></li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class=dropdown>
                            <a href=# class="dropdown-toggle avatar" data-toggle=dropdown><img src=<?php echo $this->Crud_model->get_image_url('admin', $this->session->userdata('admin_id')); ?> alt="" class="image"> 
                                <span class=txt><?php echo $this->session->userdata('user_name'); ?></span> <b class=caret></b>
                            </a>
                            <ul class="dropdown-menu right">
                                <li class=menu>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard" aria-hidden="true"></i>Home</a>
                                        </li>
                                        <li><a href="<?php echo base_url(); ?>admin/manage_profile">
                                                <i class="fa fa-user" aria-hidden="true"></i>Edit profile</a>
                                        </li>
                                        <li><a href="<?php echo base_url(); ?>site/logout"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
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
                        <li><a href="<?php echo base_url(); ?>admin/system_settings" title="System Settings" class=tip>
                                <i class="fa fa-life-ring" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>admin/backup" title="Database backup" class=tip>
                                <i class="fa fa-database" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>admin/report_chart" title="Reports" class=tip>
                                <i class="fa fa-pie-chart" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>admin/manage_profile" title="Profile" class=tip>
                                <i class="fa fa-user" aria-hidden="true"></i>
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
                                        <a <?php echo active_single_menu('dashboard', $page); ?> href="<?php echo base_url(); ?>admin/dashboard">
                                            <i class="s16 fa fa-dashboard"></i>
                                            <span class="txt">Dashboard</span>
                                            <span class="indicator"></span>
                                        </a>
                                    </li>          

                                    <?php
                                    $pages = [
                                        'department', 'branch', 'batch', 'semester', 'class', 'admission_type', 'student',
                                        'syllabus', 'subject', 'holiday', 'chancellor', 'course_category', 'vocational_course',
                                        'assessments', 'timeline', 'vocational_register_student'
                                    ];
                                    ?>

                                    <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                        <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 fa fa-chain"></i>
                                            <span class="txt">Basic Management</span></a>
                                        <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                            <li>
                                                <a id="link-department" href="<?php echo base_url(); ?>admin/department">
                                                    <i class="s16 fa fa-exchange"></i>
                                                    <span class="txt">Department</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-branch" href="<?php echo base_url(); ?>admin/branch">
                                                    <i class="s16 icomoon-icon-file"></i>
                                                    <span class="txt">Branch</span></a></li>
                                            <li>
                                                <a id="link-batch" href="<?php echo base_url(); ?>admin/batch">
                                                    <i class="s16 fa fa-share-alt"></i>
                                                    <span class="txt">Batch</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-semester" href="<?php echo base_url(); ?>admin/semester">
                                                    <i class="s16 fa fa-sitemap"></i>
                                                    <span class="txt">Semester</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-class" href="<?php echo base_url(); ?>admin/class">
                                                    <i class="s16 icomoon-icon-unlocked"></i>
                                                    <span class="txt">Class</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-admission_type" href="<?php echo base_url(); ?>admin/admission_type">
                                                    <i class="s16 fa fa-key"></i>
                                                    <span class="txt">Admission Type</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-student" href="<?php echo base_url(); ?>admin/student">
                                                    <i class="s16 icomoon-icon-user-plus-2"></i>
                                                    <span class="txt">Student</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-subject" href="<?php echo base_url(); ?>admin/subject">
                                                    <i class="s16 fa fa-book"></i>
                                                    <span class="txt">Subject Management</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-syllabus" href="<?php echo base_url(); ?>admin/syllabus">
                                                    <i class="s16 icomoon-icon-file-2"></i>
                                                    <span class="txt">Syllabus Management</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-holiday" href="<?php echo base_url(); ?>admin/holiday">
                                                    <i class="s16 icomoon-icon-file"></i>
                                                    <span class="txt">Holiday</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-chancellor" href="<?php echo base_url(); ?>admin/chancellor">
                                                    <i class="s16 fa fa-user"></i>
                                                    <span class="txt">Chancellor</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-course_category" href="<?php echo base_url(); ?>admin/category">
                                                    <i class="s16 fa fa-globe"></i>
                                                    <span class="txt"> Course Category</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-vocational_course" href="<?php echo base_url(); ?>admin/vocationalcourse">
                                                    <i class="s16 fa fa-life-ring"></i>
                                                    <span class="txt">Vocational Course</span>
                                                </a>
                                            </li>
                                           
                                            <li>
                                                <a id="link-assessments" href="<?php echo base_url(); ?>admin/assessments">
                                                    <i class="s16 icomoon-icon-file"></i>
                                                    <span class="txt">Assessment</span>
                                                </a>
                                            </li>
                                            <!--<li>
                                                <a id="link-timeline" href="<?php echo base_url(); ?>admin/time_line">
                                                    <i class="s16 icomoon-icon-file"></i>
                                                    <span class="txt">Time Line</span>
                                                </a>
                                            </li>-->                                               
                                        </ul>
                                    </li>
                                    
                                    <?php
                                    $pages = [
                                        'event', 'assignment', 'studyresource', 'project', 'library', 'courseware', 'subscriber',
                                        'participate'
                                    ];
                                    ?>

                                    <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                        <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 fa fa-try"></i>
                                            <span class="txt">Assets Management</span></a>
                                        <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                            <li>
                                                <a id="link-event" href="<?php echo base_url(); ?>admin/events">
                                                    <i class="s16 fa fa-calendar"></i>
                                                    <span class="txt">Events</span>
                                                </a>
                                            </li> 
                                            <li>
                                                <a id="link-assignment" href="<?php echo base_url(); ?>admin/assignment">
                                                    <i class="s16 icomoon-icon-file-2"></i>
                                                    <span class="txt">Assignments</span>
                                                </a>
                                            </li> 
                                            <li>
                                                <a id="link-studyresource" href="<?php echo base_url(); ?>admin/studyresource">
                                                    <i class="s16 icomoon-icon-attachment"></i>
                                                    <span class="txt">Study Resources</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-project" href="<?php echo base_url(); ?>admin/project">
                                                    <i class="s16 icomoon-icon-unlocked"></i>
                                                    <span class="txt">Project/Synopsis</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-library" href="<?php echo base_url(); ?>admin/digital_library">
                                                    <i class="s16 icomoon-icon-file-2"></i>
                                                    <span class="txt">Digital Library</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-participate" href="<?php echo base_url(); ?>admin/participate">
                                                    <i class="s16 icomoon-icon-user-plus-2"></i>
                                                    <span class="txt">Participate</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-courseware" href="<?php echo base_url(); ?>admin/courseware">
                                                    <i class="s16 icomoon-icon-attachment"></i>
                                                    <span class="txt">Courseware</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-subscriber" href="<?php echo base_url(); ?>admin/subscriber">
                                                    <i class="s16 icomoon-icon-user-plus-2"></i>
                                                    <span class="txt">Subscriber</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a <?php echo active_single_menu('class_routine', $page); ?> href="<?php echo base_url() . 'admin/class_routine' ?>">
                                            <i class="s16 fa fa-book"></i>
                                            <span class=txt>Class Routine </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a <?php echo active_single_menu('video_streaming', $page); ?> href="<?php echo base_url(); ?>video_streaming">
                                            <i class="s16 fa fa-video-camera"></i>
                                            <span class=txt>Video Streaming </span>
                                        </a>
                                    </li>                                    

                                    <?php
                                    $pages = [
                                        'forum', 'forum_topic', 'forum_comment'
                                    ];
                                    ?>

                                    <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                        <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 fa fa-comment"></i>
                                            <span class="txt">Forum</span></a>
                                        <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                            <li>
                                                <a id="link-forum" href="<?php echo base_url(); ?>admin/forum">
                                                    <i class="s16 icomoon-icon-file-2"></i>
                                                    <span class="txt">Forum & Discussion</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-forum_topic" href="<?php echo base_url(); ?>admin/forumtopics">
                                                    <i class="s16 icomoon-icon-file-2"></i>
                                                    <span class="txt">Forum Topics</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <?php
                                    $pages = [
                                        'photo_gallery', 'banner_slider'
                                    ];
                                    ?>

                                    <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                        <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 fa fa-picture-o"></i>
                                            <span class="txt">Media</span></a>
                                        <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                            <li>
                                                <a id="link-photo_gallery" href="<?php echo base_url(); ?>admin/photogallery">
                                                    <i class="s16 fa fa-picture-o"></i>
                                                    <span class="txt">Photo Gallery</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-banner_slider" href="<?php echo base_url(); ?>admin/bannerslider">
                                                    <i class="s16 fa fa-desktop"></i>
                                                    <span class="txt">Banner Slider</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <?php
                                    $pages = [
                                        'compose', 'inbox', 'sent', 'reply'
                                    ];
                                    ?>
                                    <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                        <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 fa fa-envelope"></i>
                                            <span class="txt">Email </span></a>
                                        <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                            <li>
                                                <a id="link-compose" href="<?php echo base_url(); ?>admin/email_compose">
                                                    <i class="s16 fa fa-envelope"></i>
                                                    <span class="txt">Compose E-Mail</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-inbox" href="<?php echo base_url(); ?>admin/email_inbox">
                                                    <i class="s16 fa fa-inbox"></i>
                                                    <span class="txt">Inbox</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-sent" href="<?php echo base_url(); ?>admin/email_sent">
                                                    <i class="s16 fa fa-send"></i>
                                                    <span class="txt">Sent</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>

                                    <?php
                                    $pages = [
                                        'import', 'export'
                                    ];
                                    ?>

                                    <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                        <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 icomoon-icon-folder"></i>
                                            <span class="txt">Import & Export </span></a>
                                        <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                            <li>
                                                <a id="link-import" href="<?php echo base_url(); ?>admin/import">
                                                    <i class="s16 fa fa-upload"></i>
                                                    <span class="txt">Import</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-export" href="<?php echo base_url(); ?>admin/export">
                                                    <i class="s16 fa fa-download"></i>
                                                    <span class="txt">Export</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <?php
                                    $pages = [
                                        'system_setting', 'authorize_config'
                                    ];
                                    ?>

                                    <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                        <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 fa fa-gears"></i>
                                            <span class="txt">System Setting</span></a>
                                        <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                            <li>
                                                <a id="link-system_setting" href="<?php echo base_url(); ?>admin/system_settings">
                                                    <i class="s16 fa fa-gears"></i>
                                                    <span class="txt">System Settings</span>
                                                </a>
                                            </li> 
                                            <li>
                                                <a id="link-authorize_config" href="<?php echo base_url(); ?>admin/authorize_payment_config">
                                                    <i class="s16 fa fa-globe"></i>
                                                    <span class="txt">Authorize.net Config</span>
                                                </a>
                                            </li>                                                 
                                        </ul>
                                    </li>

                                    <?php
                                    $pages = [
                                        'graduate', 'charity'
                                    ];
                                    ?>

                                    <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                        <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 fa fa-building"></i>
                                            <span class="txt">University</span></a>
                                        <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                            <li>
                                                <a id="link-graduate" href="<?php echo base_url(); ?>admin/graduate">
                                                    <i class="s16 fa fa-graduation-cap"></i>
                                                    <span class="txt">Toppers Graduate</span>
                                                </a>
                                            </li> 
                                            <li>
                                                <a id="link-charity" href="<?php echo base_url(); ?>admin/charity_fund">
                                                    <i class="s16 fa fa-money"></i>
                                                    <span class="txt">Charity Fund</span>
                                                </a>
                                            </li>                                                 
                                        </ul>
                                    </li>
                                    <li>
                                        <a <?php echo active_single_menu('professor', $page); ?> href="<?php echo base_url(); ?>admin/professor">
                                            <i class="s16 fa fa-user"></i>
                                            <span class=txt>Professor </span>
                                        </a>
                                    </li>

                                    <?php
                                    $pages = [
                                        'exam', 'exam_schedule', 'exam_grade', 'marks'
                                    ];
                                    ?>

                                    <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                        <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 fa fa-pencil"></i>
                                            <span class="txt">Examination</span></a>
                                        <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                            <li>
                                                <a id="link-exam" href="<?php echo base_url(); ?>admin/exam">
                                                    <i class="s16 fa fa-paper-plane-o"></i>
                                                    <span class="txt">Exam</span>
                                                </a>
                                            </li> 
                                            <li>
                                                <a id="link-exam_schedule" href="<?php echo base_url(); ?>admin/exam_schedule">
                                                    <i class="s16 fa fa-history"></i>
                                                    <span class="txt">Exam Schedule</span>
                                                </a>
                                            </li> 
                                            <li>
                                                <a id="link-marks" href="<?php echo base_url(); ?>admin/exam_marks">
                                                    <i class="s16 fa fa-star-o"></i>
                                                    <span class="txt">Exam Marks</span>
                                                </a>
                                            </li>     
                                            <li>
                                                <a id="link-exam_grade" href="<?php echo base_url(); ?>admin/exam_grade">
                                                    <i class="s16 fa fa-pencil"></i>
                                                    <span class="txt">Exam Grade</span>
                                                </a>
                                            </li> 
                                        </ul>
                                    </li>
                                    <li>
                                        <a <?php echo active_single_menu('cms', $page); ?> href="<?php echo base_url(); ?>admin/cms_pages">
                                            <i class="s16 fa fa-pagelines"></i>
                                            <span class=txt>CMS Pages</span></a>
                                    </li>

                                    <?php
                                    $pages = [
                                        'fee_structure', 'make_payment', 'due_amount'
                                    ];
                                    ?>

                                    <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                        <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 fa fa-money"></i>
                                            <span class="txt">Payment</span></a>
                                        <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                            <li>
                                                <a id="link-fee_structure" href="<?php echo base_url(); ?>admin/fees_structure">
                                                    <i class="s16 fa fa-code-fork"></i>
                                                    <span class="txt">Fee Structure</span>
                                                </a>
                                            </li> 
                                            <li>
                                                <a id="link-make_payment" href="<?php echo base_url(); ?>admin/make_payment">
                                                    <i class="s16 fa fa-credit-card"></i>
                                                    <span class="txt">Make Payment</span>
                                                </a>
                                            </li> 
                                            <li>
                                                <a id="link-due_amount" href="<?php echo base_url(); ?>admin/due_amount">
                                                    <i class="s16 fa fa-recycle"></i>
                                                    <span class="txt">Due Amount</span>
                                                </a>
                                            </li> 
                                        </ul>
                                    </li>
                                    <li>
                                        <a <?php echo active_single_menu('report_chart', $page); ?> href="<?php echo base_url(); ?>admin/report_chart">
                                            <i class="s16 fa fa-bar-chart"></i>
                                            <span class=txt>Reports</span>
                                        </a>
                                    </li>

                                    <?php
                                    $pages = [
                                        'backup', 'restore'
                                    ];
                                    ?>

                                    <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                        <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 fa fa-download"></i>
                                            <span class="txt">Backup/Restore</span></a>
                                        <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                            <li>
                                                <a id="link-backup" href="<?php echo base_url(); ?>admin/backup">
                                                    <i class="s16 fa fa-cloud-download"></i>
                                                    <span class="txt">Backup</span>
                                                </a>
                                            </li> 
                                            <li>
                                                <a id="link-restore" href="<?php echo base_url(); ?>admin/restore">
                                                    <i class="s16 fa fa-cloud-upload"></i>
                                                    <span class="txt">Restore</span>
                                                </a>
                                            </li>                                                 
                                        </ul>
                                    </li>                                    

                                    <?php
                                    $pages = [
                                        'create_group', 'list_group', 'assign_module', 'list_module'
                                    ];
                                    ?>

                                    <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                        <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="s16 fa fa-users"></i>
                                            <span class="txt">User Management</span></a>
                                        <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                            <li >
                                                <a id="link-create_group" href="<?php echo base_url(); ?>admin/create_group">
                                                    <i class="s16 fa fa-group"></i>
                                                    <span class="menu-text">Create Groups</span>  
                                                </a>
                                            </li>
                                            <li >
                                                <a id="link-list_group" href="<?php echo base_url(); ?>admin/list_group">
                                                    <i class="s16 fa fa-list"></i>
                                                    <span class="menu-text">List Groups</span>  
                                                </a>
                                            </li>
                                            <li>
                                                <a id="link-assign_module" href="<?php echo base_url(); ?>admin/assign_module">
                                                    <i class="s16 fa fa-bolt"></i>
                                                    <span class="menu-text">Assign Module</span>  
                                                </a>
                                            </li>
                                            <li>
                                                <a id="list_module" href="<?php echo base_url(); ?>admin/list_module">
                                                    <i class="s16 fa fa-paw"></i>
                                                    <span class="menu-text">List Module</span>  
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
                        <div class="search_box">
                            <!-- .search -->
                            <form id=searchform class=form-horizontal method="post" action="<?php echo base_url(); ?>admin/search">
                                <input name="search" class="top-search from-control" placeholder="Search here ..."
                                       value="<?php echo isset($search_string) ? $search_string : ''; ?>"> 
                                <input type=submit class=search-btn>
                                <div class="category">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                                        Category                                     
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li class="menu">
                                            <ul>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" value="degree" name="degree"
                                                               <?php if (isset($from['degree'])) echo 'checked'; ?>>
                                                        <span>Department</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" value="student" name="student"
                                                               <?php if (isset($from['student'])) echo 'checked'; ?>>
                                                        <span>Student</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" value="course" name="course"
                                                               <?php if (isset($from['course'])) echo 'checked'; ?>>
                                                        <span>Branch</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" value="exam" name="exam"
                                                               <?php if (isset($from['exam'])) echo 'checked'; ?>>
                                                        <span>Exam</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" value="event" name="event"
                                                               <?php if (isset($from['event'])) echo 'checked'; ?>>
                                                        <span>Event</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" value="batch" name="batch"
                                                               <?php if (isset($from['batch'])) echo 'checked'; ?>>
                                                        <span>Batch</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" value="assignment" name="assignment"
                                                               <?php if (isset($from['assignment'])) echo 'checked'; ?>>
                                                        <span>Assignment</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" value="participate" name="participate"
                                                               <?php if (isset($from['participate'])) echo 'checked'; ?>>
                                                        <span>Participate</span>
                                                    </label>
                                                </li> 
                                                <li>
                                                    <label>
                                                        <input type="checkbox" value="professor" name="professor"
                                                               <?php if (isset($from['professor'])) echo 'checked'; ?>>
                                                        <span>Professor</span>
                                                    </label>
                                                </li>
                                            </ul>                                           
                                        </li>
                                    </ul> 
                                </div>
                            </form>
                        </div>                           
                        <!--  /search -->
                        <?php echo create_breadcrumb(); ?>        

                        <?php echo set_active_menu($page); ?>
                    </div>
                    <!-- End  / heading-->