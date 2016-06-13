<!DOCTYPE html>
<!--[if lt IE 8]><html class="no-js lt-ie8"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class=no-js>
        <head>
            <meta charset=utf-8>
            <title><?php echo $title; ?> | <?php echo system_name(); ?></title>
            <!-- Mobile specific metas -->
            <meta name=viewport content="width=device-width,initial-scale=1,maximum-scale=1">
            <!-- Force IE9 to render in normal mode -->
            <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
            <meta name=author content="">
            <meta name=description content="">
            <meta name=keywords content="">
            <meta name=application-name content="">
            <!-- Import google fonts - Heading first/ text second -->
            <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel=stylesheet type=text/css>
            <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel=stylesheet type=text/css>
            <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
            <!-- Css files -->
            <?php
            //header css
            $css = [
                ['jquery.mCustomScrollbar.min.css'],
                ['main.min.css'],
                ['plugins.css'],
                ['custom.css'],
                ['bootstrap-datetimepicker.min.css']
            ];
            $this->carabiner->group('header_css', [
                'css' => $css
            ]);
            $this->carabiner->display('header_css');

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
            <meta name=msapplication-TileColor content="#3399cc">
            <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
            <script>
                var base_url = '<?php echo base_url(); ?>';
            </script>
        </head>
        <body class="<?php echo $this->router->fetch_method(); ?> student_dashboard">
            <!--[if lt IE 9]>
          <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
            <!-- .#header -->
            <div id="header">
                <nav class="navbar navbar-default" role=navigation>
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo base_url(); ?>student">
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
                                <a href="<?php echo base_url(); ?>student/email_inbox">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span class=txt>Messages</span></a>                                
                            </li>
                        </ul>
                        <ul class="nav navbar-right usernav">
                            <li class="dropdown">
                                <a href=# class="dropdown-toggle" data-toggle=dropdown>
                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                 <?php  if($this->session->userdata('notifications')['total_notification'] > 0){ ?>   <span class="notification"><?php echo $this->session->userdata('notifications')['total_notification']; ?></span><?php } ?>
                                </a>
                                <ul class="dropdown-menu right">
                                    <li class=menu>
                                        <ul class=notif>
                                            <li class=header><strong>Notifications</strong> (<?php echo $this->session->userdata('notifications')['total_notification']; ?>) items</li>
                                            <?php if (isset($this->session->userdata('notifications')['fees_structure'])) { ?>
                                                <li><a href="<?php echo base_url('student/student_fees'); ?>"><span class=icon>
                                                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                        </span> <span class=event> New fee structure was added.</span></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (isset($this->session->userdata('notifications')['exam_manager']) || isset($this->session->userdata('notifications')['exam_time_table'])) { ?>
                                                <li><a href="<?php echo base_url('student/exam_listing'); ?>"><span class=icon><i class="s16 fa fa-commenting"></i></span> <span class=event>New Exam or Exam schedule was added.</span></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (isset($this->session->userdata('notifications')['assignment_manager'])) { ?>
                                                <li><a href="<?php echo base_url('student/assignment/assignment_list'); ?>"><span class=icon><i class="s16 fa fa-newspaper-o"></i></span> <span class=event>New Assignment was added.</span></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (isset($this->session->userdata('notifications')['project_manager'])) { ?>
                                                <li><a href="<?php echo base_url('student/project/submission'); ?>"><span class=icon><i class="s16 fa fa-newspaper-o"></i></span> <span class=event>New Project was added.</span></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (isset($this->session->userdata('notifications')['marks_manager'])) { ?>
                                                <li><a href="<?php echo base_url('student/exam_marks'); ?>"><span class=icon><i class="s16 fa fa-newspaper-o"></i></span> <span class=event>Exam marks was added.</span></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (isset($this->session->userdata('notifications')['participate_manager'])) { ?>
                                                <li><a href="<?php echo base_url('student/volunteer'); ?>"><span class=icon><i class="s16 fa fa-newspaper-o"></i></span> <span class=event>New Participate was added.</span></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (isset($this->session->userdata('notifications')['study_resources'])) { ?>
                                                <li><a href="<?php echo base_url('student/studyresources'); ?>"><span class=icon><i class="s16 fa fa-newspaper-o"></i></span> <span class=event>New Study Resources was added.</span></a>
                                                </li>
                                            <?php } ?>
                                            <?php if (isset($this->session->userdata('notifications')['library_manager'])) { ?>
                                                <li><a href="<?php echo base_url('student/digitallibrary'); ?>"><span class=icon><i class="s16 fa fa-newspaper-o"></i></span> <span class=event>New Digital Library was added.</span></a>
                                                </li>
                                            <?php } ?>
                               <!-- <li class=view-all><a href=#>View all notifications <i class="s16 fa fa-angle-double-right"></i></a>
                                </li>-->
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class=dropdown>
                                <a href=# class="dropdown-toggle avatar" data-toggle=dropdown><img src="<?php
                                    if ($this->session->userdata('profile_photo') != "") {
                                        echo base_url() . 'uploads/student_image/' . $this->session->userdata('profile_photo');
                                    } else {
                                        echo base_url() . 'assets/img/avatar.jpg';
                                    }
                                    ?>" alt="" class="image"> 
                                    <span class=txt><?php echo $this->session->userdata('email'); ?></span> <b class=caret></b>
                                </a>
                                <ul class="dropdown-menu right">
                                    <li class=menu>
                                        <ul>
                                            <li>
                                                <a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard" aria-hidden="true"></i>Home</a>
                                            </li>
                                            <li><a href="<?php echo base_url(); ?>student/profile">
                                                    <i class="fa fa-user-plus" aria-hidden="true"></i>Edit profile</a>
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
            <div id="wrapper">
                <!-- #wrapper -->
                <!--Sidebar background-->
                <div id="sidebarbg" class="hidden-lg hidden-md hidden-sm hidden-xs"></div>
                <!--Sidebar content-->
                <div id="sidebar" class="page-sidebar hidden-lg hidden-md hidden-sm hidden-xs">
                    <div class=shortcuts>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>student/email_inbox" title="Message Inbox" class=tip>
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>student/gallery" title="Photo Gallery" class=tip>
                                    <i class="fa fa-image" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>student/project/submission" title="Project" class=tip>
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>student/profile" title="Profile" class=tip>
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
                                            <a <?php echo active_single_menu('dashboard', $page); ?> href="<?php echo base_url(); ?>student/dashboard"><i class="fa fa-desktop" aria-hidden="true"></i><span class=txt>Dashboard</span></a>
                                        </li>

                                        <?php
                                        $pages = [
                                            'inbox', 'compose', 'sent'
                                        ];
                                        ?>

                                        <li class="hasSub<?php echo highlight_menu($page, $pages); ?>">
                                            <a href="#" class="<?php echo exapnd_not_expand_menu($page, $pages); ?>"><i class="icomoon-icon-arrow-down-2 s16 hasDrop"></i><i class="fa fa-envelope"></i>
                                                <span class="txt">Email </span></a>
                                            <ul <?php echo navigation_show_hide_ul($page, $pages); ?>>
                                                <li>
                                                    <a id="link-compose" href="<?php echo base_url(); ?>student/email_compose">
                                                        <i class="fa fa-envelope"></i>
                                                        <span class="txt">Compose E-Mail</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a id="link-inbox" href="<?php echo base_url(); ?>student/email_inbox">
                                                        <i class="fa fa-inbox"></i>
                                                        <span class="txt">Inbox</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a id="link-sent" href="<?php echo base_url(); ?>student/email_sent">
                                                        <i class="s16 icomoon-icon-file-2"></i>
                                                        <span class="txt">Sent</span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li>
                                            <a <?php echo active_single_menu('class_routine', $page); ?> href="<?php echo base_url(); ?>student/class_routine">
                                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                <span class=txt>Class Routine</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a <?php echo active_single_menu('syllabus', $page); ?> href="<?php echo base_url(); ?>student/syllabus">
                                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                <span class=txt>Syllabus</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a <?php echo active_single_menu('assignment', $page); ?> href="<?php echo base_url(); ?>student/assignment/"><i class="s16 fa fa-table"></i><span class="txt">Assignments </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a <?php echo active_single_menu('project', $page); ?> href="<?php echo base_url(); ?>student/project/submission/"><i class="s16 icomoon-icon-cube"></i><span class="txt">Projects </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a <?php echo active_single_menu('video_streaming', $page); ?> href="<?php echo base_url(); ?>video_streaming"><i class="s16 fa fa-desktop"></i><span class=txt>Video Streaming </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a <?php echo active_single_menu('exam', $page); ?> href="<?php echo base_url(); ?>student/exam"><i class="s16 fa fa-picture-o"></i>
                                                <span class=txt>Exam</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a <?php echo active_single_menu('exam_marks', $page); ?> href="<?php echo base_url(); ?>student/exam_marks">
                                                <i class="s16 fa fa-clock-o"></i>
                                                <span class=txt>Exam Marks</span>
                                            </a>
                                        </li>                                        
                                        <li>
                                            <a <?php echo active_single_menu('student_fees', $page); ?> href="<?php echo base_url(); ?>student/student_fees"><i class="s16 fa fa-dollar"></i>
                                                <span class=txt>Pay Online </span>
                                            </a>
                                        </li> 
                                        <li>
                                            <a <?php echo active_single_menu('fees_record', $page); ?> href="<?php echo base_url(); ?>student/fee_record"><i class="s16 fa fa-newspaper-o"></i><span class=txt>Fee Record </span>
                                            </a>
                                        </li>                                        
                                        <li>
                                            <a <?php echo active_single_menu('holiday', $page); ?> href="<?php echo base_url(); ?>student/holiday">
                                                <i class="s16 fa fa-book"></i>
                                                <span class=txt>Holiday </span>
                                            </a>
                                        </li>                                           
                                        <li>
                                            <a <?php echo active_single_menu('courseware', $page); ?> href="<?php echo base_url(); ?>student/courseware">
                                                <i class="s16 fa fa-file-o"></i>
                                                <span class=txt>Courseware</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a <?php echo active_single_menu('vocational_course', $page); ?> href="<?php echo base_url(); ?>student/vocationalcourse">
                                                <i class="s16 fa fa-spinner"></i>
                                                <span class=txt>Vocational Course</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a <?php echo active_single_menu('gallery', $page); ?> href="<?php echo base_url(); ?>student/gallery"><i class="s16 fa fa-picture-o"></i>
                                                <span class=txt>Gallery </span>
                                            </a>
                                        </li>  
                                        <?php
                                        $news_conent = $this->db->get_where('cms_manager', array('c_status' => 1))->result_array();
                                        foreach ($news_conent as $row) {
                                            ?>
                                            <li>
                                                <a <?php echo active_single_menu($row['c_slug'], $page); ?> href="<?php echo base_url(); ?>pages/<?php echo @$row['c_slug']; ?>">
                                                    <i class="s16 fa fa-universal-access"></i>
                                                    <span class=txt><?php echo @$row['c_title']; ?> </span>
                                                </a>
                                            </li>
                                        <?php } ?>


                                    </ul> 
                                </div>
                            </div>
                            <!-- End sidenav -->

                            <!-- End .sidenav-widget -->
                        </div>
                        <!-- End .sidebar-scrollarea -->
                    </div>
                    <!-- End .sidebar-inner -->
                </div>
                <!-- End #sidebar -->
                <!--Sidebar background-->
                <!--Body content-->
                <div id="content" class="page-content clearfix ">
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
                            <!--  /search -->  
                            <?php echo create_breadcrumb(); ?>    

                            <?php echo set_active_menu($page); ?>
                        </div>
                        <!-- End  / heading-->