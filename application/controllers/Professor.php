<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Professor extends MY_Controller {

    /**
     * Constructor
     * 
     * @return void
     */
    function __construct() {
        parent::__construct();

        //check for professor login
        if ((!$this->session->userdata('professor_login')) &&
                ($this->session->userdata('login_type') != 'professor'))
            redirect(base_url('site/user_login'));

        $this->load->model('professor/Professor_model');
    }

    /**
     * Index action
     */
    function index() {
        $this->__site_template('professor/dashboard', $this->data);
    }

    /**
     * Dashboard action
     */
    function dashboard() {
        $this->data['title'] = 'Professor Dashboard';
        $this->__site_template('professor/dashboard', $this->data);
    }

    /**
     * Student list
     */
    function student() {
        $dpet = $this->session->userdata('department');
        $branch = $this->session->userdata('branch');

        $this->data['student'] = $this->Professor_model->get_prof_student($dpet, $branch);
        $this->data['page'] = 'student';
        $this->data['title'] = 'Student Management';
        $this->__site_template('professor/student', $this->data);
    }

    /**
     * Subject list
     */
    function subject() {
        $dept = $this->session->userdata('department');
        $this->data['subject'] = $this->db->query("SELECT * FROM subject_manager WHERE FIND_IN_SET('" . $dept . "',professor_id)")->result();
        $login_id = $this->session->userdata('login_user_id');
        $degree = $this->db->get_where("professor", array("professor_id" => $login_id))->result();
        $this->db->where("degree_id", $degree[0]->department);
        $this->data['course'] = $this->db->get('course')->result();
        $this->data['semester'] = $this->db->get('semester')->result();
        $this->data['page'] = 'subject';
        $this->data['title'] = 'Subject Management';
        $this->__site_template('professor/subject', $this->data);
    }

    /**
     * Syllabus 
     * @param string $param
     * @param string $param2
     */
    function syllabus($param = '', $param2 = '') {
        if ($_POST) {
            if ($param == "create") {
                if ($_FILES['syllabusfile']['name'] != "") {
                    $path = FCPATH . 'uploads/syllabus';
                    if (!is_dir($path)) {
                        mkdir($path, 0777);
                    }
                    $config['upload_path'] = 'uploads/syllabus';
                    $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    //$this->upload->set_allowed_types('*');	

                    if (!$this->upload->do_upload('syllabusfile')) {
                        $this->session->set_flashdata('flash_message', "Invalid File!");
                        redirect(base_url() . 'professor/syllabus/', 'refresh');
                    } else {
                        $file = $this->upload->data();
                        $insert['syllabus_filename'] = $file['file_name'];
                    }
                } else {
                    $insert['syllabus_filename'] = '';
                }

                $insert['syllabus_title'] = $this->input->post('title');
                $insert['syllabus_degree'] = $this->input->post('degree');
                $insert['syllabus_course'] = $this->input->post('course');
                $insert['syllabus_sem'] = $this->input->post('semester');
                $insert['syllabus_desc'] = $this->input->post('description');


                $this->Professor_model->add_syllabus($insert);
                $this->session->set_flashdata('flash_message', "Syllabus Added Successfully");
                redirect(base_url() . 'professor/syllabus/', 'refresh');
            }
            if ($param == 'do_update') {
                $syllabus = $this->Professor_model->getsyllabus($param2);

                if ($_FILES['syllabusfile']['name'] != "") {
                    $path = FCPATH . 'uploads/syllabus';
                    if (!is_dir($path)) {
                        mkdir($path, 0777);
                    }
                    $config['upload_path'] = 'uploads/syllabus';
                    $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    //$this->upload->set_allowed_types('*');	

                    if (!$this->upload->do_upload('syllabusfile')) {
                        $this->session->set_flashdata('flash_message', "Invalid File!");
                        redirect(base_url() . 'professor/syllabus/', 'refresh');
                    } else {
                        $file = $this->upload->data();
                        $insert['syllabus_filename'] = $file['file_name'];
                    }
                } else {

                    $insert['syllabus_filename'] = $syllabus[0]->syllabus_filename;
                }
                $insert['syllabus_title'] = $this->input->post('title');
                $insert['syllabus_degree'] = $this->input->post('degree');
                $insert['syllabus_course'] = $this->input->post('course');
                $insert['syllabus_sem'] = $this->input->post('semester');
                $insert['syllabus_desc'] = $this->input->post('description');
                $insert['update_date'] = date('Y-m-d H:i:s');

                $this->Professor_model->update_syllabus($insert, $param2);
                $this->session->set_flashdata('flash_message', "Syllabus Updated Successfully");
                redirect(base_url() . 'professor/syllabus/', 'refresh');
            }
        }

        if ($param == 'delete') {
            $this->Professor_model->delete_syllabus($param2);
            $this->session->set_flashdata('flash_message', "Syllabus Deleted Successfully");
            redirect(base_url() . 'professor/syllabus/', 'refresh');
        }
        $dept = $this->session->userdata('department');
        $this->data['syllabus'] = $this->Professor_model->get_syllabus();
        $this->data['course'] = $this->db->get('course')->result();
        $this->data['semester'] = $this->db->get('semester')->result();
        $this->data['degree'] = $this->db->get('degree')->result();
        $this->data['title'] = 'Syllabus Management';
        $this->data['page_name'] = 'syllabus';
        $this->__site_template('professor/syllabus', $this->data);
    }

    /**
     * Holiday
     */
    function holiday() {
        $this->data['holiday'] = $this->Professor_model->getholiday();
        $this->data['name'] = 'holiday';
        $this->data['title'] = 'Holiday Management';
        $this->__site_template('professor/holiday', $this->data);
    }

    /**
     * Assessment
     * @param string $param
     * @param string $id
     */
    function assessments($param = '', $id = '') {
        $this->load->model('admin/Crud_model');
        if ($param == 'create') {
            $data['degree'] = $this->input->post('degree');
            $data['course'] = $this->input->post('course');
            $data['batch'] = $this->input->post('batch');
            $data['semester'] = $this->input->post('semester');
            $data['student'] = $this->input->post('student');
            $data['instruction'] = $this->input->post('instruction');
            $data['submissions'] = $this->input->post('submissions');
            $data['feedback_tutor'] = $this->input->post('feedback');
            $data['marks'] = $this->input->post('marks');
            $data['user_role'] = $this->session->userdata('login_type');
            $data['user_role_id'] = $this->session->userdata('login_user_id');
            $this->Professor_model->create_assessment($data);
            $this->session->set_flashdata('flash_message', 'Assessment added Successfully.');
            redirect(base_url('professor/assessments'));
        }

        if ($param == 'update') {
            $data['degree'] = $this->input->post('degree');
            $data['course'] = $this->input->post('course');
            $data['batch'] = $this->input->post('batch');
            $data['semester'] = $this->input->post('semester');
            $data['student'] = $this->input->post('student');
            $data['instruction'] = $this->input->post('instruction');
            $data['submissions'] = $this->input->post('submissions');
            $data['feedback_tutor'] = $this->input->post('feedback');
            $data['marks'] = $this->input->post('marks');
            $this->Professor_model->update_assessment($data, $id);
            $this->session->set_flashdata('flash_message', 'Assessment update Successfully.');
            redirect(base_url('professor/assessments'));
        }
        if ($param == 'delete') {
            $this->Professor_model->delete_assessment($id);
            $this->session->set_flashdata('flash_message', 'Assessment delete Successfully.');
            redirect(base_url('professor/assessments'));
        }

        $this->data['title'] = 'Assessments';
        $this->data['pge'] = 'assessments';
        $this->data['assessments'] = $this->Professor_model->assessment();
        $this->data['degree'] = $this->Professor_model->get_all_degree();
        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['semester'] = $this->Professor_model->get_all_semester();
        $this->data['batch'] = $this->Professor_model->get_all_bacth();
        $this->__site_template('professor/assessments', $this->data);
    }

    /**
     * Events
     */
    function events() {
        $this->load->model('admin/Crud_model');
        $this->data['page'] = 'events';
        $this->data['title'] = 'Events';
        $this->data['events'] = $this->Crud_model->event_manager();
        $this->__site_template('professor/events', $this->data);
    }

    /**
     * Assignments
     * @param string $param1
     * @param string $param2
     */
    function assignment($param1 = '', $param2 = '') {
        if ($_POST) {
            if ($param1 == 'create') {
                if ($_FILES['assignmentfile']['name'] != "") {

                    $config['upload_path'] = 'uploads/project_file';
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    //$this->upload->set_allowed_types('*');	

                    if (!$this->upload->do_upload('assignmentfile')) {
                        $this->session->set_flashdata('flash_message', "Invalid File!");
                        redirect(base_url() . 'professor/assignment/', 'refresh');
                    } else {
                        $file = $this->upload->data();

                        $data['assign_filename'] = $file['file_name'];
                        $file_url = base_url() . 'uploads/project_file/' . $data['assign_filename'];
                    }
                } else {
                    $data['assign_filename'] = '';
                    $file_url = '';
                }
                $data['course_id'] = $this->input->post('course');
                $data['assign_title'] = $this->input->post('title');
                $data['assign_batch'] = $this->input->post('batch');
                $data['assign_url'] = $file_url;
                $data['assign_sem'] = $this->input->post('semester');
                $data['class_id'] = $this->input->post('class');
                $data['assign_desc'] = $this->input->post('description');
                $data['assign_dos'] = $this->input->post('submissiondate');
                $data['assign_status'] = 1;
                $data['created_date'] = date('Y-m-d');
                $data['assign_degree'] = $this->input->post('degree');
                $this->Professor_model->addassignment($data);
                $last_id = $this->db->insert_id();

                $assign_degree = $data['assign_degree'];
                $assign_sem = $data['assign_sem'];
                $assign_batch = $data['assign_batch'];
                $course_id = $data['course_id'];
                $this->db->where('std_batch', $assign_batch);
                $this->db->where('semester_id', $assign_sem);
                $this->db->where('std_degree', $assign_degree);
                $this->db->where('course_id', $course_id);
                $students = $this->db->get('student')->result();
                $std_id = '';
                foreach ($students as $std) {
                    $id = $std->std_id;


                    $std_id[] = $id;
                    //  $student_id = implode(",",$id);
                    // $std_ids[] =$student_id;
                }
                if ($std_id != '') {
                    $student_ids = implode(",", $std_id);
                } else {
                    $student_ids = '';
                }
                $this->db->where("notification_type", "assignment_manager");
                $res = $this->db->get("notification_type")->result();
                if ($res != '') {
                    $notification_id = $res[0]->notification_type_id;
                    $notify['notification_type_id'] = $notification_id;
                    $notify['student_ids'] = $student_ids;
                    $notify['degree_id'] = $assign_degree;
                    $notify['course_id'] = $course_id;
                    $notify['batch_id'] = $assign_batch;
                    $notify['semester_id'] = $assign_sem;
                    $notify['data_id'] = $last_id;
                    $this->db->insert("notification", $notify);
                }

                $this->session->set_flashdata('flash_message', 'Assignment Added Successfully');
                redirect(base_url() . 'professor/assignment/', 'refresh');
            }
            if ($param1 == 'do_update') {
                if ($_FILES['assignmentfile']['name'] != "") {

                    $config['upload_path'] = 'uploads/project_file';
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    //$this->upload->set_allowed_types('*');	

                    if (!$this->upload->do_upload('assignmentfile')) {
                        $this->session->set_flashdata('flash_message', "Invalid File!");
                        redirect(base_url() . 'professor/assignment/', 'refresh');
                    } else {
                        $file = $this->upload->data();

                        $data['assign_filename'] = $file['file_name'];
                        $file_url = base_url() . 'uploads/project_file/' . $data['assign_filename'];
                    }
                } else {

                    $file_url = $this->input->post('assignmenturl');
                }

                $data['course_id'] = $this->input->post('course');
                $data['assign_title'] = $this->input->post('title');
                $data['assign_batch'] = $this->input->post('batch');
                $data['assign_url'] = $file_url;
                $data['assign_sem'] = $this->input->post('semester');
                $data['class_id'] = $this->input->post('class');
                $data['assign_desc'] = $this->input->post('description');
                $data['assign_dos'] = $this->input->post('submissiondate1');
                $data['assign_degree'] = $this->input->post('degree');
                $data['assign_status'] = 1;

                $this->Professor_model->updateassignment($data, $param2);
                $this->session->set_flashdata('flash_message', 'Assignment Updated Successfully');
                redirect(base_url() . 'professor/assignment/', 'refresh');
            }
        }

        if ($param1 == 'delete') {
            $this->Professor_model->deleteassignment($param2);
            delete_notification('assignment_manager', $param2);
            $this->session->set_flashdata('flash_message', 'Assignment Deleted Successfully');
            redirect(base_url() . 'professor/assignment/', 'refresh');
        }

        $this->data['assignment'] = $this->Professor_model->get_assignment();

        $this->data['submitedassignment'] = $this->Professor_model->submitttedassignment();

        $this->data['degree'] = $this->Professor_model->get_all_degree();
        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['semester'] = $this->Professor_model->get_all_semester();
        $this->data['batch'] = $this->Professor_model->get_all_bacth();

        $this->data['course'] = $this->db->get('course')->result();
        $this->data['semester'] = $this->db->get('semester')->result();
        $this->data['batch'] = $this->db->get('batch')->result();
        $this->data['degree'] = $this->db->get('degree')->result();
        $this->data['class'] = $this->db->get('class')->result();
        $this->data['page'] = 'assignment';
        $this->data['title'] = 'Assignment Management';
        $this->__site_template('professor/assignment', $this->data);
    }

    /**
     * Study resource
     * @param string $param1
     * @param string $param2
     */
    function studyresource($param1 = '', $param2 = '') {
        if ($_POST) {
            if ($param1 == 'create') {
                if ($_FILES['resourcefile']['name'] != "") {

                    $config['upload_path'] = 'uploads/project_file';
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    //$this->upload->set_allowed_types('*');	

                    if (!$this->upload->do_upload('resourcefile')) {
                        $this->session->set_flashdata('flash_message', "Invalid File!");
                        redirect(base_url() . 'professor/studyresource/', 'refresh');
                    } else {
                        $file = $this->upload->data();
                        $data['study_filename'] = $file['file_name'];
                        $file_url = base_url() . 'uploads/project_file/' . $data['study_filename'];
                    }
                } else {

                    $file_url = '';
                }
                $data['study_degree'] = $this->input->post('degree');
                $data['study_title'] = $this->input->post('title');
                $data['study_batch'] = $this->input->post('batch');
                $data['study_url'] = $file_url;
                $data['study_sem'] = $this->input->post('semester');
                $data['study_course'] = $this->input->post('course');
                $data['study_status'] = 1;
                $data['created_date'] = date('Y-m-d');

                $this->db->insert('study_resources', $data);
                $last_id = $this->db->insert_id();
                $batch = $data['study_batch'];
                $degree = $data['study_degree'];
                $semester = $data['study_sem'];
                $course = $data['study_course'];
                if ($degree == 'All') {
                    $students = $this->db->get('student')->result();
                } else {
                    if ($course == 'All') {
                        $this->db->where('std_degree', $degree);
                        $students = $this->db->get('student')->result();
                    } else {
                        if ($batch == 'All') {
                            $this->db->where('std_degree', $degree);
                            $this->db->where('course_id', $course);
                            $students = $this->db->get('student')->result();
                        } else {
                            if ($semester == 'All') {
                                $this->db->where('std_batch', $batch);
                                $this->db->where('std_degree', $degree);
                                $this->db->where('course_id', $course);
                                $students = $this->db->get('student')->result();
                            } else {
                                $this->db->where('std_batch', $batch);
                                $this->db->where('std_degree', $degree);
                                $this->db->where('course_id', $course);
                                $this->db->where('semester_id', $semester);
                                $students = $this->db->get('student')->result();
                            }
                        }
                    }
                }
                $std_id = '';
                foreach ($students as $std) {
                    $id = $std->std_id;
                    $std_id[] = $id;
                    //  $student_id = implode(",",$id);
                    // $std_ids[] =$student_id;
                }
                if ($std_id != '') {
                    $student_ids = implode(",", $std_id);
                } else {
                    $student_ids = '';
                }
                $this->db->where("notification_type", "study_resources");
                $res = $this->db->get("notification_type")->result();
                if ($res != '') {
                    $notification_id = $res[0]->notification_type_id;
                    $notify['notification_type_id'] = $notification_id;
                    $notify['student_ids'] = $student_ids;
                    $notify['degree_id'] = $degree;
                    $notify['course_id'] = $course;
                    $notify['batch_id'] = $batch;
                    $notify['semester_id'] = $semester;
                    $notify['data_id'] = $last_id;
                    $this->db->insert("notification", $notify);
                }
                $this->session->set_flashdata('flash_message', 'Studyresource Added Successfully');
                redirect(base_url() . 'professor/studyresource/', 'refresh');
            }
            if ($param1 == 'do_update') {
                if ($_FILES['resourcefile']['name'] != "") {
                    $config['upload_path'] = 'uploads/project_file';
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    //$this->upload->set_allowed_types('*');	

                    if (!$this->upload->do_upload('resourcefile')) {
                        $this->session->set_flashdata('flash_message', "Invalid File!");
                        redirect(base_url() . 'professor/studyresource/', 'refresh');
                    } else {
                        $file = $this->upload->data();
                        $data['study_filename'] = $file['file_name'];
                        $file_url = base_url() . 'uploads/project_file/' . $data['study_filename'];
                    }
                } else {
                    $file_url = $this->input->post('pageurl');
                }
                $data['study_degree'] = $this->input->post('degree');
                $data['study_title'] = $this->input->post('title');
                $data['study_batch'] = $this->input->post('batch');
                $data['study_url'] = $file_url;
                $data['study_sem'] = $this->input->post('semester');
                $data['study_course'] = $this->input->post('course');
                $data['study_status'] = 1;

                $this->db->where('study_id', $param2);
                $this->db->update('study_resources', $data);
                $this->session->set_flashdata('flash_message', 'Studyresource Updated Successfully');

                redirect(base_url() . 'professor/studyresource/', 'refresh');
            }
        }

        if ($param1 == 'delete') {
            $this->db->where('study_id', $param2);
            $this->db->delete('study_resources');
            delete_notification('study_resources', $param2);
            $this->session->set_flashdata('flash_message', 'Studyresource Deleted Successfully');
            redirect(base_url() . 'professor/studyresource/', 'refresh');
        }

        $this->data['studyresource'] = $this->Professor_model->get_studyresource();
        $this->data['degree'] = $this->Professor_model->get_all_degree();
        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['semester'] = $this->Professor_model->get_all_semester();
        $this->data['batch'] = $this->Professor_model->get_all_bacth();
        $this->data['name'] = 'studyresource';
        $this->data['title'] = 'Study Resource Management';
        $this->__site_template('professor/studyresource', $this->data);
    }

    /**
     * Project management
     * @param string $param1
     * @param string $param2
     */
    function project($param1 = '', $param2 = '') {
        if ($_POST) {
            if ($param1 == 'create') {
                $checkstd = $this->input->post('student');
                if (empty($checkstd)) {
                    $this->session->set_flashdata('flash_message', "Student not found, data not added!");
                    redirect(base_url() . 'professor/project/', 'refresh');
                }
                if ($_FILES['projectfile']['name'] != "") {


                    $config['upload_path'] = 'uploads/project_file';
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    //$this->upload->set_allowed_types('*');	

                    if (!$this->upload->do_upload('projectfile')) {
                        $this->session->set_flashdata('flash_message', "Invalid File!");
                        redirect(base_url() . 'professor/project/', 'refresh');
                    } else {
                        $file = $this->upload->data();
                        $data['pm_filename'] = $file['file_name'];
                        $file_url = base_url() . 'uploads/project_file/' . $data['pm_filename'];
                    }
                } else {

                    $file_url = '';
                }
                $data['pm_degree'] = $this->input->post('degree');
                $data['pm_title'] = $this->input->post('title');
                $data['pm_batch'] = $this->input->post('batch');
                $data['pm_url'] = $file_url;
                $data['pm_semester'] = $this->input->post('semester');
                $data['class_id'] = $this->input->post('class');
                $data['pm_desc'] = $this->input->post('description');
                $data['pm_dos'] = $this->input->post('dateofsubmission');
                $data['pm_status'] = 1;
                // $data['pm_student_id'] = $this->input->post('student');
                $stud = implode(',', $this->input->post('student'));
                $data['pm_student_id'] = $stud;
                $data['pm_course'] = $this->input->post('course');
                $data['created_date'] = date('Y-m-d');


                $this->db->insert('project_manager', $data);
                $last_id = $this->db->insert_id();
                $this->db->where("notification_type", "project_manager");
                $res = $this->db->get("notification_type")->result();
                if ($res != '') {
                    $notification_id = $res[0]->notification_type_id;
                    $notify['notification_type_id'] = $notification_id;
                    $notify['student_ids'] = $data['pm_student_id'];
                    $notify['degree_id'] = $data['pm_degree'];
                    $notify['course_id'] = $data['pm_course'];
                    $notify['batch_id'] = $data['pm_batch'];
                    $notify['semester_id'] = $data['pm_semester'];
                    $notify['data_id'] = $last_id;
                    $this->db->insert("notification", $notify);
                }

                $this->session->set_flashdata('flash_message', 'Project Added Successfully');
                redirect(base_url() . 'professor/project/', 'refresh');
            }
            if ($param1 == 'do_update') {
                $checkstd = $this->input->post('student');
                if (empty($checkstd)) {
                    $this->session->set_flashdata('flash_message', "Student not found, data not added!");
                    redirect(base_url() . 'professor/project/', 'refresh');
                }

                if ($_FILES['projectfile']['name'] != "") {

                    $config['upload_path'] = 'uploads/project_file';
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    //$this->upload->set_allowed_types('*');	

                    if (!$this->upload->do_upload('projectfile')) {
                        $this->session->set_flashdata('flash_message', "Invalid File!");
                        redirect(base_url() . 'professor/project/', 'refresh');
                    } else {
                        $file = $this->upload->data();
                        $data['pm_filename'] = $file['file_name'];
                        $file_url = base_url() . 'uploads/project_file/' . $data['pm_filename'];
                    }
                } else {

                    $file_url = $this->input->post('pageurl');
                }

                $data['pm_degree'] = $this->input->post('degree');
                $data['pm_title'] = $this->input->post('title');
                $data['pm_batch'] = $this->input->post('batch');
                $data['pm_url'] = $file_url;
                $data['pm_semester'] = $this->input->post('semester');
                $data['class_id'] = $this->input->post('class2');
                $data['pm_desc'] = $this->input->post('description');
                $data['pm_dos'] = $this->input->post('dateofsubmission1');
                $data['pm_status'] = 1;
                //$data['pm_student_id'] = $this->input->post('student');
                $stud = implode(',', $this->input->post('student'));
                $data['pm_student_id'] = $stud;
                $data['pm_course'] = $this->input->post('course');

                $this->db->where('pm_id', $param2);
                $this->db->update('project_manager', $data);
                $this->session->set_flashdata('flash_message', 'Project Updated Successfully');

                redirect(base_url() . 'professor/project/', 'refresh');
            }
        }

        if ($param1 == 'delete') {
            $this->db->where('pm_id', $param2);
            $this->db->delete('project_manager');
            delete_notification('project_manager', $param2);
            $this->session->set_flashdata('flash_message', 'Project Deleted Successfully');
            redirect(base_url() . 'professor/project/', 'refresh');
        }
        $this->data['project'] = $this->Professor_model->get_projects();

        $this->data['submitedproject'] = $this->Professor_model->submittedproject();
        $this->data['degree'] = $this->Professor_model->get_all_degree();
        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['semester'] = $this->Professor_model->get_all_semester();
        $this->data['batch'] = $this->Professor_model->get_all_bacth();
        $this->data['class'] = $this->db->get('class')->result();
        $this->data['student'] = $this->db->get('student')->result();
        $this->data['page'] = 'project';
        $this->data['title'] = 'Project Management';
        $this->__site_template('professor/project', $this->data);
    }

    function library($param1 = '', $param2 = '') {
        if ($param1 == 'create') {
            if ($_FILES['libraryfile']['name'] != "") {
                $config['upload_path'] = 'uploads/project_file';
                $config['allowed_types'] = '*';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                //$this->upload->set_allowed_types('*');	

                if (!$this->upload->do_upload('libraryfile')) {
                    $this->session->set_flashdata('flash_message', "Invalid File!");
                    redirect(base_url() . 'professor/library/', 'refresh');
                } else {
                    $file = $this->upload->data();

                    $data['lm_filename'] = $file['file_name'];
                    $file_url = base_url() . 'uploads/project_file/' . $data['lm_filename'];
                }
            } else {

                $file_url = '';
            }

            $data['lm_degree'] = $this->input->post('degree');
            $data['lm_title'] = $this->input->post('title');
            $data['lm_batch'] = $this->input->post('batch');
            $data['lm_url'] = $file_url;
            $data['lm_semester'] = $this->input->post('semester');
            $data['lm_desc'] = $this->input->post('description');

            $data['lm_status'] = 1;
            //  $data['lm_student_id'] = $this->input->post('student');
            $data['lm_course'] = $this->input->post('course');
            $data['created_date'] = date('Y-m-d');


            $this->db->insert('library_manager', $data);
            $last_id = $this->db->insert_id();
            $batch = $data['lm_batch'];
            $degree = $data['lm_degree'];
            $semester = $data['lm_semester'];
            $course = $data['lm_course'];
            if ($degree == 'All') {
                $students = $this->db->get('student')->result();
            } else {
                if ($course == 'All') {
                    $this->db->where('std_degree', $degree);
                    $students = $this->db->get('student')->result();
                } else {
                    if ($batch == 'All') {
                        $this->db->where('std_degree', $degree);
                        $this->db->where('course_id', $course);
                        $students = $this->db->get('student')->result();
                    } else {
                        if ($semester == 'All') {
                            $this->db->where('std_batch', $batch);
                            $this->db->where('std_degree', $degree);
                            $this->db->where('course_id', $course);
                            $students = $this->db->get('student')->result();
                        } else {
                            $this->db->where('std_batch', $batch);
                            $this->db->where('std_degree', $degree);
                            $this->db->where('course_id', $course);
                            $this->db->where('semester_id', $semester);
                            $students = $this->db->get('student')->result();
                        }
                    }
                }
            }

            $std_id = '';
            foreach ($students as $std) {
                $id = $std->std_id;


                $std_id[] = $id;
                //  $student_id = implode(",",$id);
                // $std_ids[] =$student_id;
            }
            if ($std_id != '') {
                $student_ids = implode(",", $std_id);
            } else {
                $student_ids = '';
            }
            $this->db->where("notification_type", "library_manager");
            $res = $this->db->get("notification_type")->result();
            if ($res != '') {
                $notification_id = $res[0]->notification_type_id;
                $notify['notification_type_id'] = $notification_id;
                $notify['student_ids'] = $student_ids;
                $notify['degree_id'] = $degree;
                $notify['course_id'] = $course;
                $notify['batch_id'] = $batch;
                $notify['semester_id'] = $semester;
                $notify['data_id'] = $last_id;
                $this->db->insert("notification", $notify);
            }
            $this->session->set_flashdata('flash_message', 'Library Added Successfully');
            redirect(base_url() . 'professor/library/', 'refresh');
        }
        if ($param1 == 'do_update') {
            if ($_FILES['libraryfile']['name'] != "") {
                if (file_exists("uploads/project_file/" . $this->input->post('txtoldfile'))) {
                    unlink("uploads/project_file/" . $this->input->post('txtoldfile'));
                }

                $config['upload_path'] = 'uploads/project_file';
                $config['allowed_types'] = '*';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('libraryfile')) {
                    $this->session->set_flashdata('flash_message', "Invalid File!");
                    redirect(base_url() . 'professor/library/', 'refresh');
                } else {
                    $file = $this->upload->data();
                    $data['lm_filename'] = $file['file_name'];
                    $file_url = base_url() . 'uploads/project_file/' . $data['lm_filename'];
                }
            } else {
                $file_url = $this->input->post('pageurl');
            }
            $data['lm_degree'] = $this->input->post('degree');
            $data['lm_title'] = $this->input->post('title');
            $data['lm_batch'] = $this->input->post('batch');
            $data['lm_url'] = $file_url;
            $data['lm_semester'] = $this->input->post('semester');
            $data['lm_desc'] = $this->input->post('description');
            $data['lm_status'] = 1;
            //  $data['lm_student_id'] = $this->input->post('student');
            $data['lm_course'] = $this->input->post('course');

            $this->db->where('lm_id', $param2);
            $this->db->update('library_manager', $data);
            $this->session->set_flashdata('flash_message', 'Library Updated Successfully');

            redirect(base_url() . 'professor/library/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('lm_id', $param2);
            $this->db->delete('library_manager');
            delete_notification('library_manager', $param2);
            $this->session->set_flashdata('flash_message', 'Library Deleted Successfully');
            redirect(base_url() . 'professor/library/', 'refresh');
        }
        $this->data['library'] = $this->Professor_model->get_libraries();
        $this->data['degree'] = $this->Professor_model->get_all_degree();
        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['semester'] = $this->Professor_model->get_all_semester();
        $this->data['batch'] = $this->Professor_model->get_all_bacth();
        $this->data['student'] = $this->db->get('student')->result();
        $this->data['page_name'] = 'library';
        $this->data['page_title'] = 'Library Management';
        $this->__site_template('professor/library', $this->data);
    }

    /**
     * Participate
     * @param string $param1
     * @param string $param2
     */
    function participate($param1 = '', $param2 = '') {
        $this->db->select("ls.*,s.*");
        $this->db->from('survey_list ls');
        $this->db->join("student s", "s.std_id=ls.student_id");

        $this->data['survey'] = $this->db->get()->result();
        $this->data['questions'] = $this->db->get('survey_question')->result();

        $this->data['participate'] = $this->db->get('participate_manager')->result();
        $this->data['degree'] = $this->db->get('degree')->result();
        $this->data['batch'] = $this->db->get('batch')->result();
        $this->data['semester'] = $this->db->get('semester')->result();
        $this->data['student'] = $this->db->get('student')->result();
        $this->data['course'] = $this->db->get('course')->result();

        $this->data['page_name'] = 'participate';
        $this->data['page_title'] = 'Participate Management';
        $this->data['volunteer'] = $this->db->get('participate_student')->result_array();
        $this->data['uploads'] = $this->db->get('student_upload')->result_array();
        $this->__site_template('professor/participate', $this->data);
    }

    /**
     * Courseware
     * @param string $param
     * @param string $param2
     */
    function courseware($param = '', $param2 = '') {
        if ($_POST) {
            if ($param == "create") {
                if ($_FILES['attachment']['name'] != "") {
                    $path = FCPATH . 'uploads/syllabus';
                    if (!is_dir($path)) {
                        mkdir($path, 0777);
                    }
                    $config['upload_path'] = 'uploads/courseware';
                    $config['allowed_types'] = '*';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    //$this->upload->set_allowed_types('*');	

                    if (!$this->upload->do_upload('attachment')) {
                        $this->session->set_flashdata('flash_message', $this->upload->display_errors());
                        redirect(base_url() . 'professor/courseware/', 'refresh');
                    } else {
                        $file = $this->upload->data();
                        $insert['attachment'] = $file['file_name'];
                    }
                } else {
                    $insert['attachment'] = '';
                }

                $insert['topic'] = $this->input->post('topic');
                $insert['description'] = $this->input->post('description');
                $insert['branch_id'] = $this->input->post('branch');
                $insert['status'] = $this->input->post('status');
                $insert['professor_id'] = $this->session->userdata('login_user_id');
                $insert['created_date'] = date('Y-m-d');

                $this->Professor_model->add_courseware($insert);
                $this->session->set_flashdata('flash_message', "Courseware added successfully");
                redirect(base_url() . 'professor/courseware/', 'refresh');
            }

            if ($param == 'do_update') {
                if ($_FILES['attachment']['name'] != "") {
                    if ($this->input->post('oldfile') != "") {
                        error_reporting(0);
                        unlink("uploads/courseware/" . $this->input->post('oldfile'));
                    }
                    $path = FCPATH . 'uploads/courseware';
                    if (!is_dir($path)) {
                        mkdir($path, 0777);
                    }
                    $config['upload_path'] = 'uploads/courseware';
                    $config['allowed_types'] = '*';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    //$this->upload->set_allowed_types('*');	

                    if (!$this->upload->do_upload('attachment')) {
                        $this->session->set_flashdata('flash_message', $this->upload->display_errors());
                        redirect(base_url() . 'professor/courseware/', 'refresh');
                    } else {
                        $file = $this->upload->data();
                        $insert['attachment'] = $file['file_name'];
                    }
                }
                $insert['topic'] = $this->input->post('topic');
                $insert['description'] = $this->input->post('description');
                $insert['branch_id'] = $this->input->post('branch');
                $insert['status'] = $this->input->post('status');
                $insert['updated_date'] = date('Y-m-d');

                $this->Professor_model->courseware_update($insert, $param2);
                $this->session->set_flashdata('flash_message', "Courseware Updated Successfully");
                redirect(base_url() . 'professor/courseware/', 'refresh');
            }
        }

        if ($param == 'delete') {
            $data = $this->db->get_where('courseware', array('courseware_id' => $param2))->result_array();

            $this->Professor_model->delete_courseware($param2);
            $this->session->set_flashdata('flash_message', "Courseware deleted successfully");
            redirect(base_url() . 'professor/courseware/', 'refresh');
        }
        $this->data['courseware'] = $this->Professor_model->getcourseware();
        $this->data['page'] = 'courseware';
        $this->data['title'] = 'Courseware Management';
        $this->__site_template('professor/courseware', $this->data);
    }

    /**
     * Graduate
     */
    function graduate() {
        $this->load->model('admin/Crud_model');
        $this->data['title'] = 'Recent Graduates';
        $this->data['page_name'] = 'graduate';
        $this->data['degree'] = $this->Crud_model->get_all_degree();
        $this->data['graduates'] = $this->Crud_model->get_all_graduates();
        $this->__site_template('professor/graduate', $this->data);
    }

    /**
     * Attendance
     */
    function attendance() {
        $this->load->model('admin/Crud_model');
        $this->data['department'] = '';
        $this->data['branch'] = '';
        $this->data['batch'] = '';
        $this->data['semester'] = '';
        $this->data['class_name'] = '';
        $this->data['professor'] = '';
        $this->data['class_routine'] = '';
        $this->data['date'] = '';
        $this->data['student'] = array();
        if ($_POST) {
            $this->data['department'] = $_POST['department'];
            $this->data['branch'] = $_POST['branch'];
            $this->data['batch'] = $_POST['batch'];
            $this->data['semester'] = $_POST['semester'];
            $this->data['class_name'] = $_POST['class'];
            $this->data['professor'] = $this->session->userdata('login_user_id');
            $this->data['date'] = $_POST['date'];
            $this->data['class_routine'] = $_POST['class_routine'];
            $student = $this->Crud_model->student_list_by_department_course_batch_semester_class($this->data['department'], $this->data['branch'], $this->data['batch'], $this->data['semester'], $this->data['class_name']);
            $this->data['student'] = $student;
        }
        $this->data['title'] = 'Attendance';
        $this->data['page'] = 'attendance';
        $this->data['title'] = 'Attendance';
        $this->data['degree'] = $this->Crud_model->get_all_degree();
        $this->data['class'] = $this->Crud_model->class_list();
        $this->__site_template('professor/attendance', $this->data);
    }

    /**
     * Exam management
     * @param string $param1
     * @param string $param2
     */
    function exam($param1 = '', $param2 = '') {
        if ($param1 == 'delete') {
            //delete
            $this->db->where('em_id', $param2);
            $this->db->delete('exam_manager');
            delete_notification('exam_manager', $param2);
            $this->session->set_flashdata('flash_message', 'Exam is successfully deleted.');
            redirect(base_url('professor/exam'));
        }
        if ($_POST) {
            if ($param1 == 'create') {
                //check for duplication

                $is_record_present = $this->Professor_model->exam_duplication_check(
                        $_POST['degree'], $_POST['course'], $_POST['batch'], $_POST['semester'], $_POST['exam_name']);

                if (count($is_record_present)) {
                    $this->session->set_flashdata('flash_message', 'Data is already present.');
                    redirect(base_url('professor/exam'));
                } else {
                    // check for validation
                    if ($this->form_validation->run('exam_insert_update') != FALSE) {
                        $data = array(
                            'em_name' => $this->input->post('exam_name', TRUE),
                            'em_type' => $this->input->post('exam_type', TRUE),
                            'total_marks' => $this->input->post('total_marks', TRUE),
                            'passing_mark' => $this->input->post('passing_marks', TRUE),
                            'em_year' => $this->input->post('year', TRUE),
                            'degree_id' => $this->input->post('degree', TRUE),
                            'course_id' => $this->input->post('course', TRUE),
                            'batch_id' => $this->input->post('batch', TRUE),
                            'em_semester' => $this->input->post('semester', TRUE),
                            'em_status' => $this->input->post('status', TRUE),
                            'em_date' => $this->input->post('date', TRUE),
                            'em_start_time' => $this->input->post('start_date_time', TRUE),
                            'em_end_time' => $this->input->post('end_date_time', TRUE),
                        );

                        $this->Professor_model->insert_exam($data);
                        $insert_id = $this->db->insert_id();
                        //$this->exam_email_notification($_POST);
                        $this->session->set_flashdata('flash_message', 'Exam is successfully added.');

                        //create seat no
                        $seat_no_initial = chr(mt_rand(65, 90));

                        //get students
                        $students_info = $this->Professor_model->custom_student_details(array(
                            'std_degree' => $_POST['degree'],
                            'course_id' => $_POST['course'],
                            'std_batch' => $_POST['batch'],
                            'semester_id' => $_POST['semester']
                        ));

                        $seat_no = str_pad($insert_id, 4, 0, STR_PAD_RIGHT);
                        $seat_no .= mt_rand(12348, 69535);

                        //echo '<pre>';
                        foreach ($students_info as $student) {
                            //var_dump($student);
                            $seat_no++;
                            $student_seat_no = $seat_no_initial . $seat_no;
                            $this->Professor_model->save_exam_seat_no([
                                'student_id' => $student->std_id,
                                'exam_id' => $insert_id,
                                'seat_no' => $student_seat_no
                            ]);
                        }



                        create_notification('exam_manager', $_POST['degree'], $_POST['course'], $_POST['batch'], $_POST['semester'], $insert_id);

                        redirect(base_url('professor/exam'));
                    } else {
                        $page_data['edit_error'] = validation_errors();
                        redirect(base_url('professor/exam'));
                    }
                }
            } elseif ($param1 == 'do_update') {

                //do validation
                if ($this->form_validation->run('exam_insert_update') != FALSE) {
                    $data = array(
                        'em_name' => $this->input->post('exam_name', TRUE),
                        'em_type' => $this->input->post('exam_type', TRUE),
                        'total_marks' => $this->input->post('total_marks', TRUE),
                        'em_year' => $this->input->post('year', TRUE),
                        'degree_id' => $this->input->post('degree', TRUE),
                        'course_id' => $this->input->post('course', TRUE),
                        'batch_id' => $this->input->post('batch', TRUE),
                        'em_semester' => $this->input->post('semester', TRUE),
                        'em_status' => $this->input->post('status', TRUE),
                        'em_date' => $this->input->post('date', TRUE),
                        'em_start_time' => $this->input->post('start_date_time', TRUE),
                        'em_end_time' => $this->input->post('end_date_time', TRUE),
                    );

                    $this->Professor_model->update_exam($param2, $data);
                    $this->session->set_flashdata('flash_message', 'Exam is successfully updated.');
                    redirect(base_url('professor/exam'));
                } else {
                    $page_data['edit_error'] = validation_errors();
                    redirect(base_url('professor/exam'));
                }
            }
        }
//$exam = $this->Professor_model->exam_details();

        $this->data['page_name'] = 'exam';
        $this->data['page_title'] = 'Exam Management';
        $this->data['exams'] = $this->Professor_model->exam_details();
        $this->data['exam_type'] = $this->Professor_model->get_all_exam_type();
        $this->data['degree'] = $this->Professor_model->get_all_degree();
        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['semester'] = $this->Professor_model->get_all_semester();
        $this->data['centerlist'] = $this->db->get('center_user')->result();
        $this->__site_template('professor/exam', $this->data);
    }

    /**
     * Exam time table
     * @param string $param1
     * @param string $param2
     */
    function exam_time_table($param1 = '', $param2 = '') {
        $this->load->model('professor/Professor_model');
        if ($param1 == 'delete') {
            //delete
            $this->db->where('exam_time_table_id', $param2);
            $this->db->delete('exam_time_table');
            delete_notification('exam_time_table', $param2);
            $this->session->set_flashdata('flash_message', 'Exam time table deleted successfully');
            redirect(base_url('professor/exam_time_table'));
        }
        if ($_POST) {
            if ($param1 == 'create') {
                //check for duplication
                $is_record_present = $this->Professor_model->exam_time_table_duplication(
                        $_POST['exam'], $_POST['subject']);

                if (count($is_record_present)) {
                    $this->session->set_flashdata('flash_message', 'Data is already present.');
                } else {
                    // do form validation
                    if ($this->form_validation->run('time_table_insert_update') != FALSE) {
                        //create
                        $this->Professor_model->exam_time_table_save(array(
                            'degree_id' => $this->input->post('degree', TRUE),
                            'course_id' => $this->input->post('course', TRUE),
                            'batch_id' => $this->input->post('batch', TRUE),
                            'semester_id' => $this->input->post('semester', TRUE),
                            'exam_id' => $this->input->post('exam', TRUE),
                            'subject_id' => $this->input->post('subject', TRUE),
                            'exam_date' => $this->input->post('exam_date', TRUE),
                            'exam_start_time' => $this->input->post('start_time', TRUE),
                            'exam_end_time' => $this->input->post('end_time', TRUE),
                        ));
                        $insert_id = $this->db->insert_id();
                        create_notification('exam_time_table', $_POST['degree'], $_POST['course'], $_POST['batch'], $_POST['semester'], $insert_id);
                        $this->session->set_flashdata('flash_message', 'Time table is added successfully.');
                        redirect(base_url('professor/exam_time_table'));
                    }
                }
            } elseif ($param1 == 'update') {
                // do form validation
                if ($this->form_validation->run('time_table_insert_update') != FALSE) {
                    //update
                    $this->Professor_model->exam_time_table_save(array(
                        'degree_id' => $this->input->post('degree', TRUE),
                        'course_id' => $this->input->post('course', TRUE),
                        'batch_id' => $this->input->post('batch', TRUE),
                        'exam_id' => $this->input->post('exam', TRUE),
                        'subject_id' => $this->input->post('subject', TRUE),
                        'exam_date' => $this->input->post('exam_date', TRUE),
                        'exam_start_time' => $this->input->post('start_time', TRUE),
                        'exam_end_time' => $this->input->post('end_time', TRUE),
                            ), $param2);
                    $this->session->set_flashdata('flash_message', 'Time table updated successfully');
                    redirect(base_url('professor/exam_time_table'));
                }
            }
        }
        $this->data['degree'] = $this->Professor_model->get_all_degree();
        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['semester'] = $this->Professor_model->get_all_semester();
        $this->data['time_table'] = $this->Professor_model->time_table();
        $this->data['title'] = 'Exam Schedule';
        $this->data['page'] = 'exam_time_table';
        $this->__site_template('professor/exam_time_table', $this->data);
    }

    /**
     * Exam marks CRUD
     * @param string $course_id
     * @param string $semester_id
     * @param string $exam_id
     */
    function marks($degree_id = '', $course_id = '', $batch_id = '', $semester_id = '', $exam_id = '', $student_id = '') {
        $this->load->model('professor/Professor_model');
        if ($_POST) {
            //exam details

            $exam_detail = $this->Professor_model->exam_detail($exam_id);

            //subject details
            $subject_details = $this->Professor_model->exam_time_table_subject_list($exam_id);

            //$subject_details = $this->Crud_model->exam_time_table_subject_list($exam_detail[0]->em_id);
            //student list
            $student_list = $this->Professor_model->student_list_by_course_semester($degree_id, $course_id, $batch_id, $semester_id);

            $total_students = $_POST['total_student'];


            for ($i = 1; $i <= $total_students; $i++) {
                //subject loop
                if ($student_id != '') {
                    if ($student_id != $student_list[$i - 1]->std_id)
                        continue;
                }
                for ($j = 0; $j < count($subject_details); $j++) {
                    //where

                    $where = array(
                        'mm_std_id' => $student_list[$i - 1]->std_id,
                        'mm_subject_id' => $subject_details[$j]->sm_id,
                        'mm_exam_id' => $exam_detail[0]->em_id,
                    );

                    $marks = $this->Professor_model->student_exam_mark($where);

                    if (count($marks)) {
                        if ($student_id != '') {
                            $this->Professor_model->mark_update(array(
                                'mm_std_id' => $student_list[$i - 1]->std_id,
                                'mm_subject_id' => $subject_details[$j]->sm_id,
                                'mm_exam_id' => $exam_detail[0]->em_id,
                                'mark_obtained' => $_POST["mark_1_{$student_list[$i - 1]->std_id}_{$exam_detail[0]->em_id}_{$subject_details[$j]->sm_id}"],
                                'mm_remarks' => $_POST["remark_1_{$student_list[$i - 1]->std_id}_{$exam_detail[0]->em_id}"],
                                    ), $where);
                        } else {
                            $this->Professor_model->mark_update(array(
                                'mm_std_id' => $student_list[$i - 1]->std_id,
                                'mm_subject_id' => $subject_details[$j]->sm_id,
                                'mm_exam_id' => $exam_detail[0]->em_id,
                                'mark_obtained' => $_POST["mark_{$i}_{$student_list[$i - 1]->std_id}_{$exam_detail[0]->em_id}_{$subject_details[$j]->sm_id}"],
                                'mm_remarks' => $_POST["remark_{$i}_{$student_list[$i - 1]->std_id}_{$exam_detail[0]->em_id}"],
                                    ), $where);
                        }
                        //udpate                        
                    } else {
                        //insert    
                        if ($student_id != '') {
                            $this->Professor_model->mark_insert(array(
                                'mm_std_id' => $student_list[$i - 1]->std_id,
                                'mm_subject_id' => $subject_details[$j]->sm_id,
                                'mm_exam_id' => $exam_detail[0]->em_id,
                                'mark_obtained' => $_POST["mark_1_{$student_list[$i - 1]->std_id}_{$exam_detail[0]->em_id}_{$subject_details[$j]->sm_id}"],
                                'mm_remarks' => $_POST["remark_1_{$student_list[$i - 1]->std_id}_{$exam_detail[0]->em_id}"],
                            ));
                        } else {
                            $this->Professor_model->mark_insert(array(
                                'mm_std_id' => $student_list[$i - 1]->std_id,
                                'mm_subject_id' => $subject_details[$j]->sm_id,
                                'mm_exam_id' => $exam_detail[0]->em_id,
                                'mark_obtained' => $_POST["mark_{$i}_{$student_list[$i - 1]->std_id}_{$exam_detail[0]->em_id}_{$subject_details[$j]->sm_id}"],
                                'mm_remarks' => $_POST["remark_{$i}_{$student_list[$i - 1]->std_id}_{$exam_detail[0]->em_id}"],
                            ));
                        }

                        $insert_id = $this->db->insert_id();
                        create_notification('marks_manager', $student_list[$i - 1]->std_degree, $student_list[$i - 1]->course_id, $student_list[$i - 1]->std_batch, $student_list[$i - 1]->semester_id, $insert_id, $student_list[$i - 1]->std_id);
                    }
                }
            }
            if ($student_id != '') {
                $this->session->set_flashdata('flash_message', 'Marks is successfully updated.');
                redirect(base_url('professor/marks/' . $degree_id . '/' . $course_id . '/' . $batch_id . '/' . $semester_id . '/' . $exam_id . '/' . $student_id));
            }
            $this->session->set_flashdata('flash_message', 'Marks is successfully updated.');
            redirect(base_url('professor/marks/' . $degree_id . '/' . $course_id . '/' . $batch_id . '/' . $semester_id . '/' . $exam_id));
        }
        $this->data['degree_id'] = '';
        $this->data['course_id'] = '';
        $this->data['semester_id'] = '';
        $this->data['exam_id'] = '';
        $this->data['batch_id'] = '';
        $this->data['student_id'] = $student_id;
        $this->data['student_list'] = array();
        $this->data['subject_details'] = array();
        $this->data['exam_detail'] = array();

        if ($degree_id != '' && $course_id != '' && $batch_id != '' && $semester_id != '' && $exam_id != '') {
            //assign variable
            $this->data['degree_id'] = $degree_id;
            $this->data['course_id'] = $course_id;
            $this->data['batch_id'] = $batch_id;
            $this->data['semester_id'] = $semester_id;
            $this->data['exam_id'] = $exam_id;

            //exam details
            $this->data['exam_detail'] = $this->Professor_model->exam_detail($exam_id);

            //subject details
            $this->data['subject_details'] = $this->Professor_model->exam_time_table_subject_list($exam_id);

            //student list
            $this->data['student_list'] = $this->Professor_model->student_list_by_course_semester($degree_id, $course_id, $batch_id, $semester_id);
        }
        $this->data['degree'] = $this->Professor_model->get_all_degree();
        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['semester'] = $this->Professor_model->get_all_semester();
        $this->data['time_table'] = $this->Professor_model->time_table();
        $this->data['title'] = 'Exam Marks';
        $this->data['page'] = 'exam_marks';
        $this->__site_template('professor/exam_marks', $this->data);
    }
    
    

}
