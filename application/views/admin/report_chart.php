<?php
$this->load->helper('report_chart');
$course = unique_branch_list();
$department = student_ratio_department_wise();
?>

<!-- charts js and library -->
<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js"></script>

<script>
    $(function () {
    $('#course_count_ratio').highcharts({
    chart: {
    plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
    },
    legend: {
            align: 'center',
            verticalAlign: 'top',
            layout: 'horizontol',
            x: 0,
            y: 30
        },
            title: {
            text: 'Male to Female course count ratio'
            },
            tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
            pie: {
            allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                    enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                    }
            }
            },
            series: [{
            name: 'Gender',
                    colorByPoint: true,
                    data: [{
                    name: 'Male',
                            y: <?php echo $male_female_pie_chart['total_male_student']; ?>,
                            //sliced: true,
                            selected: true
                    }, {
                    name: 'Female',
                            y: <?php echo $male_female_pie_chart['total_female_student']; ?>
                    }]
            }]
    });
    });</script>
<!-- bar chart year wise students -->
<script>
    $(function () {
    $('#stduent-enrolled').highcharts({
    chart: {
    type: 'column'
    },
    legend: {
            align: 'center',
            verticalAlign: 'top',
            layout: 'horizontol',
            x: 0,
            y: 30
        },
            title: {
            text: 'Student Enrolled'
            },
            subtitle: {
            text: ''
            },
            xAxis: {
            categories: [
                <?php foreach ($new_student_joining as $row) { ?>
                                '<?php echo $row->Year; ?>',
                <?php } ?>
                            ],
                                    crosshair: true
                            },
                            yAxis: {
                            min: 0,
                                    title: {
                                    text: 'Students Enrolled'
                                    }
                            },
                            tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                    footerFormat: '</table>',
                                    shared: true,
                                    useHTML: true
                            },
                            plotOptions: {
                            column: {
                            pointPadding: 0.2,
                                    borderWidth: 0
                            }
                            },
                            series: [{
                            name: 'Students',
                                    data: [
                <?php foreach ($new_student_joining as $row) { ?>
                    <?php echo $row->Total; ?>,
                <?php } ?>
                                    ]

                            }]
                    });
                    });
</script>
<!-- bar chart course wise male and female -->
<script>
    $(function () {
    $('#course-male-female').highcharts({
    chart: {
    type: 'column'
    },
    legend: {
            align: 'center',
            verticalAlign: 'top',
            layout: 'horizontol',
            x: 0,
            y: 30
        },
            title: {
            text: 'Department student count ratio'
            },
            subtitle: {
            text: ''
            },
            xAxis: {
            categories: [
                    <?php
                    //$course = unique_branch_list();
                    foreach ($department as $row) {
                        ?>
                                    '<?php echo $row->d_name; ?>',
                    <?php } ?>
                                ],
                                        crosshair: true
                                },
                                yAxis: {
                                min: 0,
                                        title: {
                                        text: 'Students'
                                        }
                                },
                                tooltip: {
                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                        footerFormat: '</table>',
                                        shared: true,
                                        useHTML: true
                                },
                                plotOptions: {
                                column: {
                                pointPadding: 0.2,
                                        borderWidth: 0
                                }
                                },
                                series: [
                                {
                                name: 'Student',
                                        data: [
                    <?php
                    //$male = male_ratio_course_wise();
                    foreach ($department as $row) {
                        ?>
                        <?php echo $row->TotalStudent; ?>,
                    <?php } ?>
                                        ]
                                }]
                        });
                        });
</script>
<!-- bar chart course wise students -->
<script>
    $(function () {
    $('#course-wise-student').highcharts({
    chart: {
    type: 'column'
    },
    legend: {
            align: 'center',
            verticalAlign: 'top',
            layout: 'horizontol',
            x: 0,
            y: 30
        },
            title: {
            text: 'Students Enrolled in Courses'
            },
            subtitle: {
            text: ''
            },
            xAxis: {
            categories: [
                <?php foreach ($course as $row) { ?>
                                '<?php echo $row->c_name; ?>',
                <?php } ?>
                            ],
                                    crosshair: true
                            },
                            yAxis: {
                            min: 0,
                                    title: {
                                    text: 'Students'
                                    }
                            },
                            tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                                    footerFormat: '</table>',
                                    shared: true,
                                    useHTML: true
                            },
                            plotOptions: {
                            column: {
                            pointPadding: 0.2,
                                    borderWidth: 0
                            }
                            },
                            series: [{
                            name: 'Students',
                                    data: [
                <?php
                $students = total_count_of_student_branch_wise();
                foreach ($students as $student) {
                    ?>
                    <?php echo $student->TotalStudent; ?>,
                <?php } ?>
                                    ]

                            }]
                    });
                    });
</script>

 <!-- Start Report Charts -->
        <div class="panel panel-default toggle">
            <div class="panel-heading">
                <h4 class="panel-title">Report Charts</h4>
            </div>
            <div class="panel-body margin25top">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Male to Female Course count Ratio</h4>
                            </div>
                            <div class="panel-body ratio_count" id="course_count_ratio" style="height:450px;" ></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Students enrolled</h4>
                            </div>
                            <div class="panel-body" id="stduent-enrolled" style="height:450px;"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Male to Female Course count Ratio</h4>
                            </div>
                            <div class="panel-body" id="course-male-female" style="height: 500px;"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Students Enrolled (Coursewise)</h4>
                            </div>
                            <div class="panel-body" id="course-wise-student" style="height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Report Charts -->
</div>
<!-- jQuery Scrollbar Js start -->
<script src="<?php echo base_url(); ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
    (function($) {

    $(window).load(function() {
 
    $("#course-male-female").mCustomScrollbar({
    theme: "inset-2-dark",
            axis: "yx",
            advanced: {
            autoExpandHorizontalScroll: true
            },
            /* change mouse-wheel axis on-the-fly */
            callbacks: {
            onOverflowY:function(){
             var opt=$(this).data("mCS").opt;
             if(opt.mouseWheel.axis!=="y") opt.mouseWheel.axis="y";
            },
            onOverflowX: function() {
            var opt = $(this).data("mCS").opt;
            if (opt.mouseWheel.axis !== "x") opt.mouseWheel.axis = "x";
            },
            }
    }); 
        $("#course-wise-student").mCustomScrollbar({
    theme: "inset-2-dark",
            axis: "yx",
            advanced: {
            autoExpandHorizontalScroll: true
            },
            /* change mouse-wheel axis on-the-fly */
            callbacks: {
            onOverflowY:function(){
             var opt=$(this).data("mCS").opt;
             if(opt.mouseWheel.axis!=="y") opt.mouseWheel.axis="y";
            },
            onOverflowX: function() {
            var opt = $(this).data("mCS").opt;
            if (opt.mouseWheel.axis !== "x") opt.mouseWheel.axis = "x";
            },
            }
    });
        $("#stduent-enrolled").mCustomScrollbar({
    theme: "inset-2-dark",
            axis: "yx",
            advanced: {
            autoExpandHorizontalScroll: true
            },
            /* change mouse-wheel axis on-the-fly */
            callbacks: {
            onOverflowY:function(){
             var opt=$(this).data("mCS").opt;
             if(opt.mouseWheel.axis!=="y") opt.mouseWheel.axis="y";
            },
            onOverflowX: function() {
            var opt = $(this).data("mCS").opt;
            if (opt.mouseWheel.axis !== "x") opt.mouseWheel.axis = "x";
            },
            }
    });
        $("#course_count_ratio").mCustomScrollbar({
    theme: "inset-2-dark",
            axis: "yx",
            advanced: {
            autoExpandHorizontalScroll: true
            },
            /* change mouse-wheel axis on-the-fly */
            callbacks: {
            onOverflowY:function(){
             var opt=$(this).data("mCS").opt;
             if(opt.mouseWheel.axis!=="y") opt.mouseWheel.axis="y";
            },
            onOverflowX: function() {
            var opt = $(this).data("mCS").opt;
            if (opt.mouseWheel.axis !== "x") opt.mouseWheel.axis = "x";
            },
            }
    });        
    });

    })(jQuery);</script>
<!-- Scrollbar Js end -->