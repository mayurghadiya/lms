<div class="row">
    <!-- .row -->
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <a href=# class="stats-btn mb20 lead-stats color_green">
                    <span data-to="568" data-from="0" class="stats-number dolar">Course</span>
                    <span class="stats-icon"><i class="fa fa-book color-green"></i></span>
                    <h5>Lorem Ipsum ...</h5>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <a href=# class="stats-btn mb20 lead-stats news_icon">
                    <span data-to="568" data-from="0" class="stats-number dolar">News</span>
                    <span class="stats-icon"><i class="fa fa-newspaper-o news-icon"></i></span>
                    <h5>Lorem Ipsum ...</h5>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <a href=# class="stats-btn mb20 lead-stats attendant_green">
                    <span data-to="568" data-from="0" class="stats-number dolar">Admissions</span>
                    <span class="stats-icon"><i class="fa fa-file attendant-color"></i></span>
                    <h5>Lorem Ipsum ...</h5>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <a href=# class="stats-btn mb20 lead-stats admissions_color">
                    <span data-to="568" data-from="0" class="stats-number dolar">Holiday</span>
                    <span class="stats-icon"><i class="fa fa-universal-access admissions-color"></i></span>
                    <h5>Lorem Ipsum ...</h5>
                </a>
            </div>
            <!-- <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
               <a href=# title="I`m with pattern" class="stats-btn mb20"><i class="fa fa-book" aria-hidden="true"></i> <span class=txt>Books</span> <span class="notification green">23</span></a>
               </div>
               
               <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                <a href=# title="I`m with pattern" class="stats-btn mb20"><i class="fa fa-universal-access" aria-hidden="true"></i> <span class=txt>Holiday </span> <span class="notification green">23</span></a>
               </div> -->
        </div>
    </div>
</div>
<!-- / .row -->
<div class="row">
    <!-- .row -->
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <div data-duration="2" data-suffix="%" data-to="99.9" data-from="0" data-count=".num" class="xe-widget xe-counter-block">
                    <div class="xe-upper">
                        <div class="xe-icon"> 
                            <i class="fa fa-money"></i> 
                        </div>
                        <div class="xe-label"> 
                            <strong class="num">STUDY RESOURCES</strong>                             
                        </div>
                    </div>
                    <div class="xe-lower scroll-bar-box">
                        <div class="border"></div>
                        <?php
                        foreach ($studyresource as $row):
                            ?>
                            <a href="uploads/project_file/<?php echo $row['study_filename']; ?>"  title="<?php echo $row['study_desc']; ?>" download="" target="_newtab" ><?php echo $row['study_title']; ?></a>      
                        <?php endforeach; ?>                                      
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <div data-duration="3" data-to="512" data-from="0" data-count=".num" class="xe-widget xe-counter-block xe-counter-block-purple">
                    <div class="xe-upper">
                        <div class="xe-icon"> <i class="fa fa-camera-retro" aria-hidden="true"></i> </div>
                        <div class="xe-label"> <strong class="num">STAFF & EMAIL DIRECTORY</strong> <span>Email</span> </div>
                    </div>
                    <div class="xe-lower">
                        <div class="border"></div>
                        <a href="<?php echo base_url('student/email_inbox'); ?>" target="_blank"> 
                            Email
                        </a> 
                    </div>


                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <div data-easing="false" data-duration="4" data-to="310" data-from="0" data-count=".num" data-suffix="k" class="xe-widget xe-counter-block xe-counter-block-blue">
                    <div class="xe-upper">
                        <div class="xe-icon"> <i class="fa fa-television" aria-hidden="true"></i> </div>
                        <div class="xe-label"> <strong class="num">DIGITAL<br> LIBRARY</strong> <span>Daily Visits</span> </div>
                    </div>
                    <div class="xe-lower scroll-bar-box">
                        <div class="border"></div>
                        <?php
                        foreach ($library as $lbr):
                            ?>
                            <a  download=""  href="uploads/project_file/<?php echo $lbr['lm_filename']; ?>" target="_blank" ><?php echo $lbr['lm_title']; ?></a>
                        <?php endforeach; ?>   
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <div class="xe-widget xe-counter-block xe-counter-block-orange">
                    <div class="xe-upper">
                        <div class="xe-icon"> <i class="fa fa-life-ring" aria-hidden="true"></i> </div>
                        <div class="xe-label"> <strong class="num">VIDEO CONFERENCING</strong> <span>Live Support</span> </div>
                    </div>
                    <div class="xe-lower">
                        <div class="border"></div>

                        <?php foreach ($live_streaming as $video) { ?>
                            <li>
                                <a target="_blank" href="<?php echo base_url('video_streaming#' . $video->url_link); ?>">
                                    <div class="menu-icon">
                                        <i class=" icon-trophy"></i>
                                    </div>
                                    <div class="menu-text"><?php echo $video->title; ?></div>
                                </a>
                            </li>
                        <?php } ?>
                        <?php foreach ($all as $video) { ?>
                            <li>
                                <a target="_blank" href="<?php echo base_url('video_streaming#' . $video->url_link); ?>">
                                    <div class="menu-icon">
                                        <i class=" icon-trophy"></i>
                                    </div>
                                    <div class="menu-text"><?php echo $video->title; ?></div>
                                </a>
                            </li>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <div data-duration="3" data-to="512" data-from="0" data-count=".num" class="xe-widget xe-counter-block xe-counter-block-black">
                    <div class="xe-upper">
                        <div class="xe-icon"> <i class="fa fa-paperclip" aria-hidden="true"></i> </div>
                        <div class="xe-label"> <strong class="num">Assignment</strong> <span>Assignment List</span> </div>
                    </div>
                    <div class="xe-lower">
                        <div class="border"></div>
                        <a href="<?php echo base_url(); ?>student/assignment" target="_blank"> <div class="menu-icon"></div> <div class="menu-text">Assignment Listing</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <!-- col-md-8 start here -->
            <div class="panel panel-default chart">
                <div class=panel-heading>
                    <h4 class=panel-title><i class="s16 fa fa-calendar"></i> <span>Calendar </span></h4>
                </div>
                <div class="panel-body">
                    <div id="calendar" class="fc fc-ltr fc-unthemed">
                        <div class="fc-toolbar">
                            <div class="fc-left">
                                <h2 class="month_year_title">May 2016</h2>
                            </div>
                            <div class="fc-right">
                                <div class="fc-button-group">
                                    <div class="btn-group mr10"><button class="btn btn-sm btn-default" type="button"><span class="fc-icon fc-icon-left-single-arrow"></span></button><button class="btn btn-sm btn-default" type="button" disabled="disabled">today</button><button class="btn btn-sm btn-default" type="button"><span class="fc-icon fc-icon-right-single-arrow"></span></button></div>
                                    <br class="hidden">
                                    <div class="btn-group"><button class="btn btn-sm btn-default" type="button">day</button><button class="btn btn-sm btn-default" type="button">week</button><button class="btn btn-sm btn-default" type="button">month</button></div>
                                </div>
                            </div>
                            <div class="fc-center"></div>
                            <div class="fc-clear"></div>
                        </div>
                        <div class="fc-view-container" style="">
                            <div class="fc-view fc-month-view fc-basic-view" style="">
                                <table>
                                    <thead>
                                        <tr>
                                            <td class="fc-widget-header">
                                                <div class="fc-row fc-widget-header" style="border-right-width: 1px; margin-right: 16px;">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th class="fc-day-header fc-widget-header fc-sun">Sun</th>
                                                                <th class="fc-day-header fc-widget-header fc-mon">Mon</th>
                                                                <th class="fc-day-header fc-widget-header fc-tue">Tue</th>
                                                                <th class="fc-day-header fc-widget-header fc-wed">Wed</th>
                                                                <th class="fc-day-header fc-widget-header fc-thu">Thu</th>
                                                                <th class="fc-day-header fc-widget-header fc-fri">Fri</th>
                                                                <th class="fc-day-header fc-widget-header fc-sat">Sat</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fc-widget-content">
                                                <div class="fc-day-grid-container fc-scroller" style="height: 275px;">
                                                    <div class="fc-day-grid">
                                                        <div class="fc-row fc-week fc-widget-content">
                                                            <div class="fc-bg">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td data-date="2016-05-01" class="fc-day fc-widget-content fc-sun fc-past"></td>
                                                                            <td data-date="2016-05-02" class="fc-day fc-widget-content fc-mon fc-past"></td>
                                                                            <td data-date="2016-05-03" class="fc-day fc-widget-content fc-tue fc-past"></td>
                                                                            <td data-date="2016-05-04" class="fc-day fc-widget-content fc-wed fc-past"></td>
                                                                            <td data-date="2016-05-05" class="fc-day fc-widget-content fc-thu fc-past"></td>
                                                                            <td data-date="2016-05-06" class="fc-day fc-widget-content fc-fri fc-past"></td>
                                                                            <td data-date="2016-05-07" class="fc-day fc-widget-content fc-sat fc-past"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td data-date="2016-05-01" class="fc-day-number fc-sun fc-past">1</td>
                                                                            <td data-date="2016-05-02" class="fc-day-number fc-mon fc-past">2</td>
                                                                            <td data-date="2016-05-03" class="fc-day-number fc-tue fc-past">3</td>
                                                                            <td data-date="2016-05-04" class="fc-day-number fc-wed fc-past">4</td>
                                                                            <td data-date="2016-05-05" class="fc-day-number fc-thu fc-past">5</td>
                                                                            <td data-date="2016-05-06" class="fc-day-number fc-fri fc-past">6</td>
                                                                            <td data-date="2016-05-07" class="fc-day-number fc-sat fc-past">7</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-event-container">
                                                                                <a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable">
                                                                                    <div class="fc-content"><span class="fc-time">12:00</span> <span class="fc-title">All Day Event</span></div>
                                                                                </a>
                                                                            </td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content">
                                                            <div class="fc-bg">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td data-date="2016-05-08" class="fc-day fc-widget-content fc-sun fc-past"></td>
                                                                            <td data-date="2016-05-09" class="fc-day fc-widget-content fc-mon fc-past"></td>
                                                                            <td data-date="2016-05-10" class="fc-day fc-widget-content fc-tue fc-past"></td>
                                                                            <td data-date="2016-05-11" class="fc-day fc-widget-content fc-wed fc-past"></td>
                                                                            <td data-date="2016-05-12" class="fc-day fc-widget-content fc-thu fc-past"></td>
                                                                            <td data-date="2016-05-13" class="fc-day fc-widget-content fc-fri fc-past"></td>
                                                                            <td data-date="2016-05-14" class="fc-day fc-widget-content fc-sat fc-past"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td data-date="2016-05-08" class="fc-day-number fc-sun fc-past">8</td>
                                                                            <td data-date="2016-05-09" class="fc-day-number fc-mon fc-past">9</td>
                                                                            <td data-date="2016-05-10" class="fc-day-number fc-tue fc-past">10</td>
                                                                            <td data-date="2016-05-11" class="fc-day-number fc-wed fc-past">11</td>
                                                                            <td data-date="2016-05-12" class="fc-day-number fc-thu fc-past">12</td>
                                                                            <td data-date="2016-05-13" class="fc-day-number fc-fri fc-past">13</td>
                                                                            <td data-date="2016-05-14" class="fc-day-number fc-sat fc-past">14</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td rowspan="2"></td>
                                                                            <td rowspan="2"></td>
                                                                            <td rowspan="2"></td>
                                                                            <td class="fc-event-container" colspan="3">
                                                                                <a class="fc-day-grid-event fc-event fc-start fc-end fc-draggable">
                                                                                    <div class="fc-content"><span class="fc-time">12:00</span> <span class="fc-title">Long Event</span></div>
                                                                                </a>
                                                                            </td>
                                                                            <td rowspan="2"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td class="fc-event-container">
                                                                                <a class="fc-day-grid-event fc-event fc-start fc-end fc-event-default fc-draggable">
                                                                                    <div class="fc-content"><i class="fa fa-repeat"></i><span class="fc-time">4:00</span> <span class="fc-title">Repeating Event</span></div>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content">
                                                            <div class="fc-bg">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td data-date="2016-05-15" class="fc-day fc-widget-content fc-sun fc-past"></td>
                                                                            <td data-date="2016-05-16" class="fc-day fc-widget-content fc-mon fc-today fc-state-highlight"></td>
                                                                            <td data-date="2016-05-17" class="fc-day fc-widget-content fc-tue fc-future"></td>
                                                                            <td data-date="2016-05-18" class="fc-day fc-widget-content fc-wed fc-future"></td>
                                                                            <td data-date="2016-05-19" class="fc-day fc-widget-content fc-thu fc-future"></td>
                                                                            <td data-date="2016-05-20" class="fc-day fc-widget-content fc-fri fc-future"></td>
                                                                            <td data-date="2016-05-21" class="fc-day fc-widget-content fc-sat fc-future"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td data-date="2016-05-15" class="fc-day-number fc-sun fc-past">15</td>
                                                                            <td data-date="2016-05-16" class="fc-day-number fc-mon fc-today fc-state-highlight">16</td>
                                                                            <td data-date="2016-05-17" class="fc-day-number fc-tue fc-future">17</td>
                                                                            <td data-date="2016-05-18" class="fc-day-number fc-wed fc-future">18</td>
                                                                            <td data-date="2016-05-19" class="fc-day-number fc-thu fc-future">19</td>
                                                                            <td data-date="2016-05-20" class="fc-day-number fc-fri fc-future">20</td>
                                                                            <td data-date="2016-05-21" class="fc-day-number fc-sat fc-future">21</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td rowspan="2"></td>
                                                                            <td class="fc-event-container">
                                                                                <a class="fc-day-grid-event fc-event fc-start fc-end fc-event-default fc-draggable">
                                                                                    <div class="fc-content"><i class="fa fa-clock-o"></i><span class="fc-time">10:30</span> <span class="fc-title">Meeting</span></div>
                                                                                </a>
                                                                            </td>
                                                                            <td class="fc-event-container" rowspan="2">
                                                                                <a class="fc-day-grid-event fc-event fc-start fc-end fc-event-success fc-draggable">
                                                                                    <div class="fc-content"><span class="fc-time">7:00</span> <span class="fc-title">Birthday Party</span></div>
                                                                                </a>
                                                                            </td>
                                                                            <td rowspan="2"></td>
                                                                            <td rowspan="2"></td>
                                                                            <td class="fc-event-container" rowspan="2">
                                                                                <a class="fc-day-grid-event fc-event fc-start fc-end fc-event-default fc-draggable">
                                                                                    <div class="fc-content"><i class="fa fa-repeat"></i><span class="fc-time">4:00</span> <span class="fc-title">Repeating Event</span></div>
                                                                                </a>
                                                                            </td>
                                                                            <td rowspan="2"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-event-container">
                                                                                <a class="fc-day-grid-event fc-event fc-start fc-end fc-event-danger fc-draggable">
                                                                                    <div class="fc-content"><span class="fc-time">12:00</span> <span class="fc-title">Lunch</span></div>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content">
                                                            <div class="fc-bg">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td data-date="2016-05-22" class="fc-day fc-widget-content fc-sun fc-future"></td>
                                                                            <td data-date="2016-05-23" class="fc-day fc-widget-content fc-mon fc-future"></td>
                                                                            <td data-date="2016-05-24" class="fc-day fc-widget-content fc-tue fc-future"></td>
                                                                            <td data-date="2016-05-25" class="fc-day fc-widget-content fc-wed fc-future"></td>
                                                                            <td data-date="2016-05-26" class="fc-day fc-widget-content fc-thu fc-future"></td>
                                                                            <td data-date="2016-05-27" class="fc-day fc-widget-content fc-fri fc-future"></td>
                                                                            <td data-date="2016-05-28" class="fc-day fc-widget-content fc-sat fc-future"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td data-date="2016-05-22" class="fc-day-number fc-sun fc-future">22</td>
                                                                            <td data-date="2016-05-23" class="fc-day-number fc-mon fc-future">23</td>
                                                                            <td data-date="2016-05-24" class="fc-day-number fc-tue fc-future">24</td>
                                                                            <td data-date="2016-05-25" class="fc-day-number fc-wed fc-future">25</td>
                                                                            <td data-date="2016-05-26" class="fc-day-number fc-thu fc-future">26</td>
                                                                            <td data-date="2016-05-27" class="fc-day-number fc-fri fc-future">27</td>
                                                                            <td data-date="2016-05-28" class="fc-day-number fc-sat fc-future">28</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td class="fc-event-container">
                                                                                <a href="http://google.com/" class="fc-day-grid-event fc-event fc-start fc-end fc-event-info fc-draggable">
                                                                                    <div class="fc-content"><i class="fa fa-link"></i><span class="fc-time">12:00</span> <span class="fc-title">Click for Google</span></div>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content">
                                                            <div class="fc-bg">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td data-date="2016-05-29" class="fc-day fc-widget-content fc-sun fc-future"></td>
                                                                            <td data-date="2016-05-30" class="fc-day fc-widget-content fc-mon fc-future"></td>
                                                                            <td data-date="2016-05-31" class="fc-day fc-widget-content fc-tue fc-future"></td>
                                                                            <td data-date="2016-06-01" class="fc-day fc-widget-content fc-wed fc-other-month fc-future"></td>
                                                                            <td data-date="2016-06-02" class="fc-day fc-widget-content fc-thu fc-other-month fc-future"></td>
                                                                            <td data-date="2016-06-03" class="fc-day fc-widget-content fc-fri fc-other-month fc-future"></td>
                                                                            <td data-date="2016-06-04" class="fc-day fc-widget-content fc-sat fc-other-month fc-future"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td data-date="2016-05-29" class="fc-day-number fc-sun fc-future">29</td>
                                                                            <td data-date="2016-05-30" class="fc-day-number fc-mon fc-future">30</td>
                                                                            <td data-date="2016-05-31" class="fc-day-number fc-tue fc-future">31</td>
                                                                            <td data-date="2016-06-01" class="fc-day-number fc-wed fc-other-month fc-future">1</td>
                                                                            <td data-date="2016-06-02" class="fc-day-number fc-thu fc-other-month fc-future">2</td>
                                                                            <td data-date="2016-06-03" class="fc-day-number fc-fri fc-other-month fc-future">3</td>
                                                                            <td data-date="2016-06-04" class="fc-day-number fc-sat fc-other-month fc-future">4</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="fc-row fc-week fc-widget-content">
                                                            <div class="fc-bg">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td data-date="2016-06-05" class="fc-day fc-widget-content fc-sun fc-other-month fc-future"></td>
                                                                            <td data-date="2016-06-06" class="fc-day fc-widget-content fc-mon fc-other-month fc-future"></td>
                                                                            <td data-date="2016-06-07" class="fc-day fc-widget-content fc-tue fc-other-month fc-future"></td>
                                                                            <td data-date="2016-06-08" class="fc-day fc-widget-content fc-wed fc-other-month fc-future"></td>
                                                                            <td data-date="2016-06-09" class="fc-day fc-widget-content fc-thu fc-other-month fc-future"></td>
                                                                            <td data-date="2016-06-10" class="fc-day fc-widget-content fc-fri fc-other-month fc-future"></td>
                                                                            <td data-date="2016-06-11" class="fc-day fc-widget-content fc-sat fc-other-month fc-future"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="fc-content-skeleton">
                                                                <table>
                                                                    <thead>
                                                                        <tr>
                                                                            <td data-date="2016-06-05" class="fc-day-number fc-sun fc-other-month fc-future">5</td>
                                                                            <td data-date="2016-06-06" class="fc-day-number fc-mon fc-other-month fc-future">6</td>
                                                                            <td data-date="2016-06-07" class="fc-day-number fc-tue fc-other-month fc-future">7</td>
                                                                            <td data-date="2016-06-08" class="fc-day-number fc-wed fc-other-month fc-future">8</td>
                                                                            <td data-date="2016-06-09" class="fc-day-number fc-thu fc-other-month fc-future">9</td>
                                                                            <td data-date="2016-06-10" class="fc-day-number fc-fri fc-other-month fc-future">10</td>
                                                                            <td data-date="2016-06-11" class="fc-day-number fc-sat fc-other-month fc-future">11</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End .panel -->
            <!-- / .row -->
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <div data-duration="2" data-to="12425" data-from="0" data-count=".num" class="xe-widget xe-progress-counter xe-progress-counter-pink h400">
                <div class="xe-background"> 
                    <i class="fa fa-heart" aria-hidden="true"></i> 
                </div>
                <div class="xe-upper">
                    <div class="xe-icon"> 
                        <i class="fa fa-heart-o" aria-hidden="true"></i> 
                    </div>
                    <div class="xe-label"> 
                        <span>All the best</span> 
                        <strong class="num">EXAMINATIONS</strong> 
                    </div>
                </div>
                <div class="xe-progress"> 
                    <span data-fill-easing="true" data-fill-duration="2" data-fill-property="width" data-fill-unit="%" data-fill-to="56" data-fill-from="0" class="xe-progress-fill" style="width: 56%;"></span> 
                </div>
                <div class="xe-lower scroll-bar-box"> 
                    <?php foreach ($exam_listing as $row) { ?>

                        <a href="<?php echo base_url('student/exam_schedule/' . $row->em_id); ?>" target="_blank">  
                            <?php echo $row->em_name; ?>
                        </a> 
                        <br>

                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <div data-duration="3" data-suffix="k" data-to="520" data-from="0" data-count=".num" class="xe-widget xe-progress-counter xe-progress-counter-turquoise">
                <div class="xe-background"> <i class="fa fa-weixin" aria-hidden="true"></i> </div>
                <div class="xe-upper">
                    <div class="xe-icon"> <i class="fa fa-weixin" aria-hidden="true"></i> </div>
                    <div class="xe-label"> <span>comming soon...</span> <strong class="num">RESULTS</strong> </div>
                </div>
                <div class="xe-progress"> <span data-fill-easing="true" data-fill-duration="3" data-fill-property="width" data-fill-unit="%" data-fill-to="82" data-fill-from="0" class="xe-progress-fill" style="width: 82%;"></span> </div>
                <div class="xe-lower"> 
                    <a href="<?php echo base_url('student/exam_marks'); ?>" target="_blank"> 
                        Exam Marks </a><br>
                    <a href="<?php echo base_url('student/statement_of_marks'); ?>" target="_blank">  
                        Statement of Marks</a> 
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <div data-duration="2" data-suffix="%" data-to="99.9" data-from="0" data-count=".num" class="xe-widget xe-counter-block xe-counter-block-red">
                <div class="xe-upper">
                    <div class="xe-icon"> <i class="fa fa-first-order" aria-hidden="true"></i> </div>
                    <div class="xe-label"> <strong class="num">PARTICIPATE</strong> <span>Volunteer ,Survey ,Upload</span> </div>
                </div>
                <div class="xe-lower">
                    <div class="border"></div>
                    <ul>
                        <a href="<?php echo base_url(); ?>student/volunteer" target="_blank">Volunteer                                        
                        </a><br><br>
                        <a href="<?php echo base_url(); ?>student/participate" target="_blank"> <div class="menu-icon"></div> <div class="menu-text">Survey</div> </a><br>
                        <a href="<?php echo base_url(); ?>student/uploads" target="_blank"> <div class="menu-icon"></div> <div class="menu-text">Upload</div> </a>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row">
    <!-- .row start -->
    <!-- col-md-8 end here -->
    <div class=col-md-4>
        <!-- col-md-4 start here -->
        <div class="panel panel-default toggle panelClose panelRefresh panelMove">
            <!-- Start .panel -->
            <div class=panel-heading>
                <h4 class=panel-title>To Do List</h4>
            </div>
            <div class=panel-body>
                <div class=todo-widget>
                    <!-- .todo-widget -->
                    <div class=todo-header>

                        <div class="todo-addform col-sm-5" id="todo-addform"  >
                            <form id="frmtodo">
                                <div class=form-group>
                                    <label class="col-lg-2 col-md-3 control-label">Task Title</label>
                                    <input type="text" id="todo_title" class=form-control name="todo_title" >
                                </div>

                                <div class=form-group>
                                    <label class="col-lg-2 col-md-3 control-label">Task Date</label>
                                    <input id="basic-datepicker" type="text" name="tado_date" class="form-control" readonly="">
                                </div>
                                <div class=form-group>
                                    <label class="col-lg-10 col-md-5">Task Time</label>
                                    <div class="col-lg-5 col-md-5">
                                        <div class="input-group bootstrap-timepicker">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <input id="minute-step-timepicker" name="todo_time" type="text" class="form-control"  readonly="" >
                                        </div>
                                    </div>
                                </div>

                                <div class=form-group>

                                    <input type="button" class="btn btn-primary" name="submit" value="Add New Task" id="addbutton" >
                                    <input type="button" class="btn btn-primary" name="submit" value="Close" id="closeform" >
                                </div>
                            </form>
                        </div>
                        <div id="updateformhtml">

                        </div>

                        <div class=todo-add><a href=# class="btn btn-primary tip" id="addnewtodo" title="Add new todo"><i class="icomoon-icon-plus mr0"></i></a></div>


                    </div>
                    <div class=todo-search>
                        <form><input class=form-control name=search placeholder="Search for todo ..."></form>
                    </div>
                    <h4 class=todo-period>To Do List</h4>

                    <div id="wait" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;"><img src='<?php echo base_url() . 'assets/img/preloader.gif' ?>' width="64" height="64" /><br>Loading..</div>
                    <ul class=todo-list id=today>
                        <?php foreach ($todolist as $todo) { ?>  
                            <li class="todo-task-item <?php
                            if ($todo->todo_status == "0") {
                                echo "task-done";
                            }
                            ?>" id="todo-task-item-id<?php echo $todo->todo_id; ?>">
                                <div class=checkbox-custom><input type="checkbox" <?php
                                    if ($todo->todo_status == "0") {
                                        echo "checked=''";
                                    }
                                    ?> value="<?php echo $todo->todo_id ?>" id="checkbox<?php echo $todo->todo_id ?>" class="taskstatus"><label for=checkbox1></label></div>               
                                    <span class="todo-category label label-primary"><?php echo date_duration($todo->todo_datetime); ?></span>

                                <div class=todo-task-text><?php echo $todo->todo_title; ?></div>
                                <button type=button class="label label-primary updateclick" value="<?php echo $todo->todo_id; ?>">Edit</button>
                                <button type=button class="close todo-close" value="<?php echo $todo->todo_id; ?>">&times;</button>

                            </li>
                        <?php } ?>
                    </ul>

                </div>
            </div>   
            <!-- End .todo-widget -->
        </div>
        <!-- End .panel -->
    </div>
    <!-- col-md-4 end here -->
    <div class="col-md-5">
        <!-- col-md-6 start here -->
        <div class="panel panel-default toggle panelClose panelRefresh panelMove" id="supr3">
            <!-- Start .panel -->
            <div class="panel-heading">
                <h4 class="panel-title"> Growth</h4>
                <div class="panel-controls panel-controls-right"><a class="panel-refresh" href="#"><i class="fa fa-refresh s12"></i></a><a class="toggle panel-minimize" href="#"><i class="fa fa-plus s12"></i></a><a class="panel-close" href="#"><i class="fa fa-times s12"></i></a></div>
            </div>
            <div class="panel-body">
                <div class="vital-stats">
                    <!-- Vital stats -->
                    <ul class="list-unstyled">
                        <li>
                            <i class="fa fa-caret-up s24 color-green" aria-hidden="true"></i>
                            Subject 1 
                            <span class="pull-right strong">567</span>
                            <div class="progress progress-striped animated-bar mt0">
                                <div data-transitiongoal="81" role="progressbar" class="progress-bar" style="width: 81%;" aria-valuenow="81">
                                    81%
                                </div>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-caret-up s24 color-green" aria-hidden="true"></i> Subject 2 <span class="pull-right strong">507</span>
                            <div class="progress progress-striped animated-bar mt0">
                                <div data-transitiongoal="72" role="progressbar" class="progress-bar progress-bar-success" style="width: 72%;" aria-valuenow="72">72%</div>
                            </div>
                        </li>
                        <li>
                            <i class="s24 fa fa-caret-down color-red" aria-hidden="true"></i>
                            Subject 3 <span class="pull-right strong">457</span>
                            <div class="progress progress-striped animated-bar mt0">
                                <div data-transitiongoal="53" role="progressbar" class="progress-bar progress-bar-warning" style="width: 53%;" aria-valuenow="53">53%</div>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-caret-up s24 color-green" aria-hidden="true"></i>
                            Subject 4 <span class="pull-right strong">8</span>
                            <div class="progress progress-striped animated-bar mt0">
                                <div data-transitiongoal="15" role="progressbar" class="progress-bar progress-bar-danger" style="width: 15%;" aria-valuenow="15">15%</div>
                            </div>
                        </li>
                        <li>
                            <i class="s24 fa fa-caret-down color-red" aria-hidden="true"></i>
                            Subject 5 <span class="pull-right strong">457</span>
                            <div class="progress progress-striped animated-bar mt0">
                                <div data-transitiongoal="53" role="progressbar" class="progress-bar progress-bar-warning" style="width: 53%;" aria-valuenow="53">53%</div>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-caret-up s24 color-green" aria-hidden="true"></i>
                            Subject 6 <span class="pull-right strong">8</span>
                            <div class="progress progress-striped animated-bar mt0">
                                <div data-transitiongoal="15" role="progressbar" class="progress-bar progress-bar-danger" style="width: 15%;" aria-valuenow="15">15%</div>
                            </div>
                        </li>
                        <li>
                            <i class="s24 fa fa-caret-down color-red" aria-hidden="true"></i>
                            Subject 7 <span class="pull-right strong">457</span>
                            <div class="progress progress-striped animated-bar mt0">
                                <div data-transitiongoal="53" role="progressbar" class="progress-bar progress-bar-warning" style="width: 53%;" aria-valuenow="53">53%</div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- / Vital stats -->
            </div>
        </div>
        <!-- End .panel --><!-- / .panel -->
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
        <div class="xe-widget xe-counter-block xe-counter-block-red attendance-box" data-count=".num" data-from="0" data-to="99.9" data-suffix="%" data-duration="2">
            <div class="xe-upper">
                <div class="xe-icon"> <i aria-hidden="true" class="fa fa-clock-o"></i> </div>
                <div class="xe-label"> <strong class="num">Admission</strong> <span>Volunteer ,Survey ,Upload</span> </div>
            </div>
            <div class="xe-lower">
                <div class="border"></div>               

                <a href="<?php echo base_url('student/profile'); ?>" target="_blank"> 
                    <div class="menu-text">Profile</div> 
                </a> <br>
                <a href="<?php echo base_url('student/fee_record'); ?>" target="_blank"> 
                    <div class="menu-text"> Student Payment Record</div> 
                </a> <br>
                <a href="<?php echo base_url('student/student_fees'); ?>" target="_blank">                                 
                    <div class="menu-text">Pay Online 

                    </div> </a> <br>

                <?php foreach ($cms_pages as $page) { ?>

                    <a href="<?php echo base_url('student/cms_page/' . $page->am_id); ?>" target="_blank">
                        <div><?php echo $page->am_title; ?></div>
                    </a>

                <?php } ?>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
        <div data-duration="3" data-to="512" data-from="0" data-count=".num" class="xe-widget xe-counter-block xe-counter-block-black">
            <div class="xe-upper">
                <div class="xe-icon"> <i class="fa fa-paperclip" aria-hidden="true"></i> </div>
                <div class="xe-label"> <strong class="num">PROJECT</strong> <span>Project List</span> </div>
            </div>
            <div class="xe-lower">
                <div class="border"></div>
                <a href="<?php echo base_url(); ?>student/project/submission" target="_blank"> <div class="menu-icon"></div> <div class="menu-text">Project List
                </a>
            </div>
        </div>
    </div>
</div>
    
    <div class="col-lg-7">
                <div class="panel panel-default toggle">
                    <!-- Start .panel -->
                    <div class=panel-heading>
                        <h4 class="panel-title marginzero">
                            Timeline
                        </h4>
                    </div>
                    <div class=panel-body>
                            <div id="demo">
                                <section id="examples">         
                                    <!-- content -->
                                    <div id="content-1">
                                        <div class="timeline-box timeline-horizontal" style="width: 2500px;">
                                            <?php $i = 0;
                                            foreach ($timeline as $time_line) {
                                                ?>
                                                <div class="tl-row">
                                                    <div class="tl-item <?php if ($i % 2) { ?> float-right <?php } ?>">
                                                        <div class="tl-bullet bg-blue"></div>
                                                        <div class="tl-panel"><?php echo $time_line->timeline_year; ?></div>
                                                        <div class="popover <?php if ($i % 2) { ?> bottom <?php } else { ?> top <?php } ?>">
                                                            <div class="arrow"></div>
                                                            <div class="popover-content">
                                                                <h3 class="tl-title"><?php echo $time_line->timeline_title; ?></h3>
                                                                <p class="tl-content"><?php echo $time_line->timeline_desc; ?></p>
                                                                <div class="tl-time"><i aria-hidden="true" class="fa fa-clock-o"></i> <?php echo date_duration($time_line->timeline_created_date); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $i++;
                                            }
                                            ?>

                                        </div>
                                    </div>          
                                </section>
                            </div>
                    </div>
                </div>
            </div>
<!-- / .row -->
</div>
<!-- End contentwrapper -->
</div>
<!-- End #content -->
<!-- To do list js -->
<script type="text/javascript">
    $(document).ready(function () {
        $("#todo-addform").hide();
        $("#basic-datepicker").datepicker({
            dateFormat: ' MM dd, yy',
            minDate: '0 days',
            autoclose: true,
        });

        //task-done

        $('#minute-step-timepicker').timepicker({
            upArrowStyle: 'fa fa-angle-up',
            downArrowStyle: 'fa fa-angle-down',
            minuteStep: 30
        });
        $(document).ajaxStart(function () {
            $("#wait").css("display", "block");
        });
        $(document).ajaxComplete(function () {
            $("#wait").css("display", "none");
        });

        $(".todo-close").click(function () {
            var id = $(this).val();
            var dataString = "id=" + id;
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>student/removetodolist",
                data: dataString,
                success: function () {

                }

            });

        });


        $("#addnewtodo").click(function () {
            $("#updateformhtml").html('');
            $("#todo-addform").show(500);

        });
        $("#frmtodo #addbutton").click(function ()
        {
            var title = $("#todo_title").val();
            var todo_date = $("#basic-datepicker").val();
            var todo_time = $("#minute-step-timepicker").val();
            if (title != "" && todo_date != "" && todo_time != "")
            {
                var dataString = "title=" + title + "&todo_date=" + todo_date + "&todo_time=" + todo_time;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>student/add_to_do",
                    data: dataString,
                    success: function (response) {
                        $(".todo-list").html(response);
                        $('#frmtodo #todo_title').val('');
                        $('#frmtodo #basic-datepicker').val('');
                    }

                });
            } else {
                if (title == "")
                {
                    $("#todo_title").css('border-color', 'red');
                } else {
                    $("#todo_title").css('border-color', '#ccc');
                }
                if (todo_date == "")
                {
                    $("#basic-datepicker").css('border-color', 'red');

                } else {
                    $("#basic-datepicker").css('border-color', '#ccc');
                }
                if (todo_time == "")
                {
                    $("#minute-step-timepicker").css('border-color', 'red');

                } else {
                    $("#minute-step-timepicker").css('border-color', '#ccc');
                }
            }

        });
        $(".taskstatus").click(function () {
            if ($(this).is(':checked'))
            {

                $(this).closest('li.todo-task-item').addClass('task-done');
                var id = $(this).val(); // todo id
                var dataString = "id=" + id + "&status=0";

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>student/changestatus",
                    data: dataString,
                    success: function () {

                    }
                });

            } else {
                $(this).closest('li.todo-task-item').removeClass('task-done');

                var id = $(this).val(); // todo id
                var dataString = "id=" + id + "&status=1";

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>student/changestatus",
                    data: dataString,
                    success: function () {

                    }
                });

            }

        });

        /**
         * Update ajax request
         */
        $(".updateclick").click(function () {

            var id = $(this).val();
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>student/todoupdateform/" + id,
                success: function (response)
                {
                    $("#updateformhtml").html(response);
                    $("#todo-addform").hide();
                    $('.todo-close').css('pointer-events', 'none');
                }
            });
        });
       
        $("#closeform").click(function () {
            $("#todo-addform").hide(500);
        });
    });

</script>
<!--  end to do list -->