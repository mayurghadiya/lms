<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

//custom routing
$route['admin/department'] = 'admin/degree';
$route['admin/branch'] = 'admin/courses';
$route['admin/class'] = 'admin/division';
$route['admin/study_resourse'] = 'admin/studyresource';
$route['admin/digital_library'] = 'admin/library';
$route['admin/exam_schedule'] = 'admin/exam_time_table';
$route['admin/exam_marks'] = 'admin/marks';
$route['admin/exam_grade'] = 'admin/grade';
$route['admin/cms_pages'] = 'admin/cms';

$route['professor/study_resource'] = 'professor/studyresource';
$route['professor/digital_library'] = 'professor/library';
$route['professor/exam_schedule'] = 'professor/exam_time_table';
$route['professor/exam_marks'] = 'professor/marks';

$route['student/exam'] = 'student/exam_listing';
$route['pages/(:any)'] = 'pages/view/pages/$1';

$route['home'] = 'site/home';
$route['course/(:any)'] = 'site/course/$1';
$route['branch/(:any)'] = 'site/branch_details/$1';
$route['about'] = 'site/about';
$route['syllabus'] = 'site/syllabus';
$route['contact'] = 'site/contact';
$route['events'] = 'site/events';
$route['alumni'] = 'site/alumni';
$route['forums'] = 'site/forums';

