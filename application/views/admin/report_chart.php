<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!-- pie chart (male vs female) -->
<script>
    $(function () {
    $('#container').highcharts({
    chart: {
    plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
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
            name: 'Genger',
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
    });</script>
<!-- bar chart course wise male and female -->
<script>
    $(function () {
<?php
$course = $this->db->get('course')->result();
$this->load->helper('report_chart');
?>
    $('#course-male-female').highcharts({
    chart: {
    type: 'column'
    },
            title: {
            text: 'Male to Female Course count Ratio'
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
            series: [
            {
            name: 'Male',
                    data: [
<?php foreach ($course as $row) { ?>
    <?php echo course_male_student_count($row->course_id); ?>,
<?php } ?>
                    ]

            },
            {
            name: 'Female',
                    data: [
<?php foreach ($course as $row) { ?>
    <?php echo course_female_student_count($row->course_id); ?>,
<?php } ?>
                    ]
            }]
    });
    });</script>
<!-- bar chart course wise students -->
<script>
    $(function () {
    $('#course-wise-student').highcharts({
    chart: {
    type: 'column'
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
<?php foreach ($course as $row) { ?>
    <?php echo course_wise_student($row->course_id); ?>,
<?php } ?>
                    ]

            }]
    });
    });</script>


<!-- Start Report Charts -->
<div class="panel-default toggle">
    
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Male to Female Course count Ratio</div>
                    </div>
                    <div class="panel-body" id="container" style="width: 450px; height: 450px;"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Students enrolled</div>
                    </div>
                    <div class="panel-body" id="stduent-enrolled" style="height: 450px; width: 450px;"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Male to Female Course count Ratio</div>
                    </div>
                    <div class="panel-body" id="course-male-female" style="height: 500px;"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Students Enrolled (Coursewise)</div>
                    </div>
                    <div class="panel-body" id="course-wise-student" style="height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Report Charts -->