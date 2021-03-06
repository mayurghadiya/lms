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
        if (!$this->input->is_ajax_request()) {
            $this->load->helper('permission');
            user_permission();
        }
    }

    /**
     * Index action
     */
    function index() {
        $this->data['todolist'] = $this->Professor_model->get_todo();
        $this->data['page'] = 'dashboard';
        $this->data['title'] = 'Professor Dashboard';
        $this->data['recent_activity'] = $this->Professor_model->get_recent_activity();
        $this->__site_template('professor/dashboard', $this->data);
    }

    /**
     * Dashboard action
     */
    function dashboard() {
        $this->data['page'] = 'dashboard';
        $this->data['title'] = 'Professor Dashboard';
        $this->data['todolist'] = $this->Professor_model->get_todo();
        $this->data['recent_activity'] = $this->Professor_model->get_recent_activity();
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
        $this->data['title'] = 'Student';
        $this->data['detail_title'] = $this->lang_message('student_detail');
        $this->__site_template('professor/student', $this->data);
    }

    /**
     * Subject list
     */
    function subject() {
        $dept = $this->session->userdata('department');
        $this->data['subject'] = $this->db->query("SELECT * FROM subject_manager WHERE FIND_IN_SET('" . $this->session->userdata('login_user_id') . "',professor_id)")->result();

        $login_id = $this->session->userdata('login_user_id');
        //$this->db->get_where("professor", array("professor_id" => $login_id))->result();
        $degree = $this->db->select('professor_id, department')->from('professor')->where('professor_id', $login_id)->get()->result();
        $this->db->where("department", $degree[0]->department);
        $degree = $this->db->get_where("professor", array("professor_id" => $login_id))->result();
        //$this->db->where("degree_id", $degree[0]->department);
        $this->data['course'] = $this->db->get('course')->result();
        $this->data['semester'] = $this->db->get('semester')->result();
        $this->data['page'] = 'subject';
        $this->data['title'] = 'Subject';
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
                    $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|pdf';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    //$this->upload->set_allowed_types('*');	

                    if (!$this->upload->do_upload('syllabusfile')) {
                        $this->session->set_flashdata('flash_message', "Invalid File!");
                        $this->session->set_userdata('last_activity', "Syllabus Create Operation Failed Invalid File!");
                        $this->session->set_userdata('activity_status', "0");
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
                $this->session->set_userdata('last_activity', "Syllabus Created " . $insert['syllabus_title']);
                $this->session->set_userdata('activity_status', "1");
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
                    $config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|pdf';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    //$this->upload->set_allowed_types('*');	

                    if (!$this->upload->do_upload('syllabusfile')) {
                        $this->session->set_flashdata('flash_message', "Invalid File!");
                        $this->session->set_userdata('last_activity', "Syllabus update operation failed Invalid File!");
                        $this->session->set_userdata('activity_status', "0");
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
                $this->session->set_userdata('last_activity', "Syllabus Updated " . $insert['syllabus_title']);
                $this->session->set_userdata('activity_status', "1");
                redirect(base_url() . 'professor/syllabus/', 'refresh');
            }
        }

        if ($param == 'delete') {
            $this->Professor_model->delete_syllabus($param2);
            $this->session->set_flashdata('flash_message', "Syllabus Deleted Successfully");
            $this->session->set_userdata('last_activity', "Syllabus Deleted");
            $this->session->set_userdata('activity_status', "1");
            redirect(base_url() . 'professor/syllabus/', 'refresh');
        }
        $dept = $this->session->userdata('department');
        $this->data['syllabus'] = $this->Professor_model->get_syllabus();
        $this->data['course'] = $this->db->get('course')->result();
        $this->data['semester'] = $this->db->get('semester')->result();
        //$this->data['degree'] = $this->db->get('degree')->result();
        $this->data['degree'] = $this->Professor_model->get_all_degree();

        $this->data['title'] = 'Syllabus';
        $this->data['add_title'] = $this->lang_message('add_syllabus');
        $this->data['edit_title'] = $this->lang_message('edit_syllabus');
        $this->data['page'] = 'syllabus';
        $this->__site_template('professor/syllabus', $this->data);
    }

    /**
     * syllabus filter
     * @param type $param
     */
    function getsyllabus($param = '') {
        $degree = $this->input->post('degree');
        $course = $this->input->post('course');
        $semester = $this->input->post("semester");

        $data['course'] = $this->db->get('course')->result();
        $data['semester'] = $this->db->get('semester')->result();

        $data['degree'] = $this->db->get('degree')->result();

        $this->db->where("syllabus_course", $course);
        $this->db->where("syllabus_degree", $degree);
        $this->db->where("syllabus_sem", $semester);


        $data['syllabus'] = $this->db->get('smart_syllabus')->result();

        $this->load->view("professor/getsyllabus", $data);
    }

    /**
     * Holiday
     */
    function holiday() {
        $this->data['holiday'] = $this->Professor_model->getholiday();
        $this->data['page'] = 'holiday';
        $this->data['title'] = 'Holiday';
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
        if ($param == "submitted") {
            $data['feedback'] = $this->input->post('feedback');
            $data['grade'] = $this->input->post('grade');
            $data['user_role'] = $this->session->userdata("login_type");
            $data['user_role_id'] = $this->session->userdata("login_user_id");
            $data['assessment_status'] = '1';
            $this->Professor_model->update_submitted_assessment($data, $id);
            $this->session->set_flashdata('flash_message', $this->lang_message('update_submitted_assessment'));
            $this->session->set_userdata('last_activity', "Assessment Added.");
            $this->session->set_userdata('activity_status', "1");
            redirect(base_url('professor/assessments'));
        }
        if ($param == 'delete') {
            $this->Professor_model->delete_assessment($id);
            $this->session->set_flashdata('flash_message', 'Assessment delete Successfully.');
            redirect(base_url('professor/assessments'));
        }

        $this->data['title'] = 'Assessments';
        $this->data['add_title'] = $this->lang_message('add_assessments');
        $this->data['edit_title'] = $this->lang_message('edit_assessments');
        $this->data['page'] = 'assessments';
        $this->data['assessment'] = $this->Professor_model->get_submitted_assessment();
        $this->data['submitedassignment'] = $this->Professor_model->submitttedassignment();
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
        $this->data['events'] = $this->Professor_model->event_manager();
        $this->session->set_userdata('last_activity', "Event Module Visited.");
        $this->session->set_userdata('activity_status', "1");
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
                        $this->session->set_userdata('last_activity', "Assignment Create Operation Failed Invalid File!.");
                        $this->session->set_userdata('activity_status', "0");
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
                $data['assignment_instruction'] = $this->input->post('instruction');
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
                $this->session->set_userdata('last_activity', "Assignment added " . $this->input->post('title'));
                $this->session->set_userdata('activity_status', "1");
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
                $data['assignment_instruction'] = $this->input->post('instruction');
                $data['assign_dos'] = $this->input->post('submissiondate1');
                $data['assign_degree'] = $this->input->post('degree');
                $data['assign_status'] = 1;

                $this->Professor_model->updateassignment($data, $param2);
                $this->session->set_userdata('last_activity', "Assignment updated " . $this->input->post('title'));
                $this->session->set_userdata('activity_status', "1");
                $this->session->set_flashdata('flash_message', 'Assignment Updated Successfully');
                redirect(base_url() . 'professor/assignment/', 'refresh');
            }
            if($param1=="reopen")
            {
                $implode = implode(",",$this->input->post('student'));
                if(!empty($implode))
                {
                    $insert['student_id'] = $implode;
                    $insert['assign_id'] = $param2;                    
                    $this->Professor_model->insert_update_assignment_reopen($insert,$param2);
                    $this->session->set_flashdata('flash_message', 'Assignment reopen Successfully');
                    redirect(base_url() . 'professor/assignment/', 'refresh');
                }
                else{
                    $this->session->set_flashdata('flash_message', 'Assignment reopen failed');
                    redirect(base_url() . 'professor/assignment/', 'refresh');
                }
            }
        }

        if ($param1 == 'delete') {
            $this->Professor_model->deleteassignment($param2);
            delete_notification('assignment_manager', $param2);
            $this->session->set_flashdata('flash_message', 'Assignment Deleted Successfully');
            $this->session->set_userdata('last_activity', "Assignment Deleted.");
            $this->session->set_userdata('activity_status', "1");
            redirect(base_url() . 'professor/assignment/', 'refresh');
        }

        $this->data['assignment'] = $this->Professor_model->get_assignment();

        $this->data['submitedassignment'] = $this->Professor_model->submitttedassignment();

        $this->data['degree'] = $this->Professor_model->get_all_degree();
        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['semester'] = $this->Professor_model->get_all_semester();
        $this->data['batch'] = $this->Professor_model->get_all_bacth();

        /*  $this->data['course'] = $this->db->get('course')->result();
          $this->data['semester'] = $this->db->get('semester')->result();
          $this->data['batch'] = $this->db->get('batch')->result();
          $this->data['degree'] = $this->db->get('degree')->result();
         */
        //$this->data['class'] = $this->db->get('class')->result();
        $this->data['page'] = 'assignments';
        $this->data['title'] = 'Assignment';
        $this->data['add_title'] = $this->lang_message('add_assignment');
        $this->data['edit_title'] = $this->lang_message('edit_assignment');
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
                        $this->session->set_userdata('last_activity', "Study Resource Create Oparion Failed Invalid File!");
                        $this->session->set_userdata('activity_status', "0");
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
                $this->session->set_userdata('last_activity', "Study Resource Added." . $this->input->post('title'));
                $this->session->set_userdata('activity_status', "1");
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
                        $this->session->set_userdata('last_activity', "Study Resource Update Operation failed Invalid File!");
                        $this->session->set_userdata('activity_status', "0");
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
                $this->session->set_userdata('last_activity', "Study Resource Updated." . $this->input->post('title'));
                $this->session->set_userdata('activity_status', "1");
                $this->session->set_flashdata('flash_message', 'Studyresource Updated Successfully');

                redirect(base_url() . 'professor/studyresource/', 'refresh');
            }
        }

        if ($param1 == 'delete') {
            $this->db->where('study_id', $param2);
            $this->db->delete('study_resources');
            delete_notification('study_resources', $param2);
            $this->session->set_flashdata('flash_message', 'Studyresource Deleted Successfully');
            $this->session->set_userdata('last_activity', "Study Resource Deleted.");
            $this->session->set_userdata('activity_status', "1");
            redirect(base_url() . 'professor/studyresource/', 'refresh');
        }

        $this->data['studyresource'] = $this->Professor_model->get_studyresource();
        $this->data['degree'] = $this->Professor_model->get_all_degree();
        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['semester'] = $this->Professor_model->get_all_semester();
        $this->data['batch'] = $this->Professor_model->get_all_bacth();
        $this->data['page'] = 'study_resources';
        $this->data['title'] = 'Study Resource';
        $this->data['add_title'] = $this->lang_message('add_studyresource');
        $this->data['edit_title'] = $this->lang_message('edit_studyresource');
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
                    $this->session->set_userdata('last_activity', "Project Create Oparion Failed Student not found!");
                    $this->session->set_userdata('activity_status', "0");
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
                        $this->session->set_userdata('last_activity', "Project Create Oparion Failed Invalid File!");
                        $this->session->set_userdata('activity_status', "0");
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
                $this->session->set_userdata('last_activity', "Project Added " . $this->input->post('title'));
                $this->session->set_userdata('activity_status', "1");
                $this->session->set_flashdata('flash_message', 'Project Added Successfully');
                redirect(base_url() . 'professor/project/', 'refresh');
            }
            if ($param1 == 'do_update') {
                $checkstd = $this->input->post('student');
                if (empty($checkstd)) {
                    $this->session->set_userdata('last_activity', "Project Update Operation Failed Student not found," . $this->input->post('title'));
                    $this->session->set_userdata('activity_status', "0");
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
                        $this->session->set_userdata('last_activity', "Project Update Operation Failed Invalid File!," . $this->input->post('title'));
                        $this->session->set_userdata('activity_status', "0");
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
                $this->session->set_userdata('last_activity', "Project Updated" . $this->input->post('title'));
                $this->session->set_userdata('activity_status', "1");
                redirect(base_url() . 'professor/project/', 'refresh');
            }
        }

        if ($param1 == 'delete') {
            $this->db->where('pm_id', $param2);
            $this->db->delete('project_manager');
            delete_notification('project_manager', $param2);
            $this->session->set_userdata('last_activity', "Project Deleted");
            $this->session->set_userdata('activity_status', "1");
            $this->session->set_flashdata('flash_message', 'Project Deleted Successfully');
            redirect(base_url() . 'professor/project/', 'refresh');
        }
        $this->data['project'] = $this->Professor_model->get_projects();

        $this->data['submitedproject'] = $this->Professor_model->submittedproject();
        $this->data['degree'] = $this->Professor_model->get_all_degree();
        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['semester'] = $this->Professor_model->get_all_semester();
        $this->data['batch'] = $this->Professor_model->get_all_bacth();
        //$this->data['class'] = $this->db->get('class')->result();
        //$this->db->get('student')->result();
        $this->data['student'] = $this->db->select('std_id, std_first_name, std_last_name')->from('student')->get()->result();
        $this->data['page'] = 'project';
        $this->data['title'] = 'Project';
        $this->data['add_title'] = $this->lang_message('add_project');
        $this->data['edit_title'] = $this->lang_message('edit_project');
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
                    $this->session->set_userdata('last_activity', "Library create operation Failed Invalid File!");
                    $this->session->set_userdata('activity_status', "0");
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
            $this->session->set_userdata('last_activity', "Library added " . $this->input->post('title'));
            $this->session->set_userdata('activity_status', "1");
            $this->session->set_flashdata('flash_message', 'Library Added Successfully');
            redirect(base_url() . 'professor/library/', 'refresh');
        }
        if ($param1 == 'do_update') {
            if ($_FILES['libraryfile']['name'] != "") {
                if (file_exists("uploads/project_file/" . $this->input->post('txtoldfile'))) {
                    //unlink("uploads/project_file/" . $this->input->post('txtoldfile'));
                }

                $config['upload_path'] = 'uploads/project_file';
                $config['allowed_types'] = '*';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('libraryfile')) {
                    $this->session->set_flashdata('flash_message', "Invalid File!");
                    $this->session->set_userdata('last_activity', "Library update operation Invalid File! " . $this->input->post('title'));
                    $this->session->set_userdata('activity_status', "1");
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
            $this->session->set_userdata('last_activity', "Library Updated " . $this->input->post('title'));
            $this->session->set_userdata('activity_status', "1");
            $this->session->set_flashdata('flash_message', 'Library Updated Successfully');

            redirect(base_url() . 'professor/library/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('lm_id', $param2);
            $this->db->delete('library_manager');
            delete_notification('library_manager', $param2);
            $this->session->set_userdata('last_activity', "Library Deleted");
            $this->session->set_userdata('activity_status', "1");
            $this->session->set_flashdata('flash_message', 'Library Deleted Successfully');
            redirect(base_url() . 'professor/library/', 'refresh');
        }
        $this->data['library'] = $this->Professor_model->get_libraries();
        $this->data['degree'] = $this->Professor_model->get_all_degree();
        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['semester'] = $this->Professor_model->get_all_semester();
        $this->data['batch'] = $this->Professor_model->get_all_bacth();
        //$this->data['student'] = $this->db->get('student')->result();
        $this->data['page'] = 'digital_library';
        $this->data['title'] = 'Digital Library';
        $this->data['add_title'] = $this->lang_message('add_digital_library');
        $this->data['edit_title'] = $this->lang_message('edit_digital_library');
        $this->__site_template('professor/library', $this->data);
    }

    /**
     * Participate
     * @param string $param1
     * @param string $param2
     */
    function participate($param1 = '', $param2 = '') {
        //$this->db->select("ls.*,s.*");
        //$this->db->from('survey_list ls');
        //$this->db->join("student s", "s.std_id=ls.student_id");
        //$this->data['survey'] = $this->db->get()->result();
        //$this->data['questions'] = $this->db->get('survey_question')->result();
        //$this->db->get('participate_manager')->result();
        $this->data['participate'] = $this->db->select('pp_title, pp_degree, pp_course, pp_batch, pp_semester, pp_dos')->from('participate_manager')->get()->result();
        //$this->db->get('degree')->result();
        $this->data['degree'] = $this->db->select('d_id, d_name')->from('degree')->get()->result();
        //$this->db->get('batch')->result();
        $this->data['batch'] = $this->db->select('b_id, b_name')->from('batch')->get()->result();
        //$this->db->get('semester')->result();
        $this->data['semester'] = $this->db->select('s_id, s_name')->from('semester')->get()->result();
        //$this->data['student'] = $this->db->get('student')->result();
        //$this->db->get('course')->result();
        $this->data['course'] = $this->db->select('course_id, c_name')->from('course')->get()->result();

        $this->data['page'] = 'participate';
        $this->data['title'] = 'Participate';
        //$this->data['volunteer'] = $this->db->get('participate_student')->result_array();
        //$this->data['uploads'] = $this->db->get('student_upload')->result_array();
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
                        $this->session->set_userdata('last_activity', "Courseware create operation failed Invalid File!.");
                        $this->session->set_userdata('activity_status', "0");
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
                $insert['subject_id'] = $this->input->post('subject');
                $insert['chapter'] = $this->input->post('chapter');
                $insert['status'] = $this->input->post('status');
                $insert['professor_id'] = $this->session->userdata('login_user_id');
                $insert['created_date'] = date('Y-m-d');

                $this->Professor_model->add_courseware($insert);
                $this->session->set_userdata('last_activity', "Courseware Chapter added " . $this->input->post('chapter'));
                $this->session->set_userdata('activity_status', "1");
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
                        $this->session->set_userdata('last_activity', "Courseware Chapter update operation failed Invalid File!");
                        $this->session->set_userdata('activity_status', "0");
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
                $insert['subject_id'] = $this->input->post('subject');
                $insert['chapter'] = $this->input->post('chapter');
                $insert['status'] = $this->input->post('status');
                $insert['updated_date'] = date('Y-m-d');

                $this->Professor_model->courseware_update($insert, $param2);
                $this->session->set_userdata('last_activity', "Courseware Chapter updated " . $this->input->post('chapter'));
                $this->session->set_userdata('activity_status', "1");
                $this->session->set_flashdata('flash_message', "Courseware Updated Successfully");
                redirect(base_url() . 'professor/courseware/', 'refresh');
            }
        }

        if ($param == 'delete') {
            $data = $this->db->get_where('courseware', array('courseware_id' => $param2))->result_array();
            unlink("uploads/courseware/" . $data[0]['attachment']);
            $this->Professor_model->delete_courseware($param2);
            $this->session->set_userdata('last_activity', "Courseware deleted ");
            $this->session->set_userdata('activity_status', "1");
            $this->session->set_flashdata('flash_message', "Courseware deleted successfully");
            redirect(base_url() . 'professor/courseware/', 'refresh');
        }
        $this->data['courseware'] = $this->Professor_model->getcourseware();

        $this->data['page'] = 'courseware';
        $this->data['title'] = 'Courseware';
        $this->data['add_title'] = $this->lang_message('add_courseware');
        $this->data['edit_title'] = $this->lang_message('edit_courseware');
        $this->__site_template('professor/courseware', $this->data);
    }

    function getcourseware($param1="")
    {
        if($param1="edit")
        {
            $this->db->where('branch_id',$this->input->post('branch'));
            $this->db->where('subject_id',$this->input->post('subject'));
            $this->db->where('chapter',$this->input->post('chapter'));
            $this->db->where('topic',$this->input->post('topic'));
            $this->db->where_not_in('courseware_id',$this->input->post('editid'));
            $data=$this->db->get('courseware')->result();
//            echo $this->db->last_query();
//            print_r($data);
//            exit;
            if(count($data)>0)
            {
                echo 'false';
            }
            else
            {
                echo 'true';
            }
        }
        else {
            $this->db->where('branch_id',$this->input->post('branch'));
            $this->db->where('subject_id',$this->input->post('subject'));
            $this->db->where('chapter',$this->input->post('chapter'));
            $this->db->where('topic',$this->input->post('topic'));
            $data=$this->db->get('courseware')->result();

            if(count($data)>0)
            {
                echo 'false';
            }
            else
            {
                echo 'true';
            }
        }       
        
    }
    
    function getsubject() {
        $this->data['subject'] = $this->Professor_model->getsubject($this->input->post('id'));

        echo json_encode($this->data['subject']);
    }

    /**
     * Graduate
     */
    function graduate() {
        $this->load->model('admin/Crud_model');
        $this->data['title'] = 'Recent Graduates';
        $this->data['page'] = 'graduates';
        //$this->data['degree'] = $this->Crud_model->get_all_degree();
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
        $this->data['degree'] = $this->Professor_model->professor_class_department();
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
            $this->session->set_userdata('last_activity', "Exam deleted");
            $this->session->set_userdata('activity_status', "1");
            $this->session->set_flashdata('flash_message', 'Exam is successfully deleted.');
            redirect(base_url('professor/exam'));
        }
        if ($_POST) {
            if ($param1 == 'create') {
                //check for duplication

                $is_record_present = $this->Professor_model->exam_duplication_check(
                        $_POST['degree'], $_POST['course'], $_POST['batch'], $_POST['semester'], $_POST['exam_name']);

                if (count($is_record_present)) {
                    $this->session->set_userdata('last_activity', "Exam create operation failed Data is already present " . $_POST['exam_name']);
                    $this->session->set_userdata('activity_status', "0");
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
                        $this->session->set_userdata('last_activity', "Exam added " . $this->input->post('exam_name'));
                        $this->session->set_userdata('activity_status', "1");
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
                    $this->session->set_userdata('last_activity', "Exam updated " . $this->input->post('exam_name'));
                    $this->session->set_userdata('activity_status', "1");
                    $this->session->set_flashdata('flash_message', 'Exam is successfully updated.');
                    redirect(base_url('professor/exam'));
                } else {
                    $page_data['edit_error'] = validation_errors();
                    redirect(base_url('professor/exam'));
                }
            }
        }
//$exam = $this->Professor_model->exam_details();

        $this->data['page'] = 'exam';
        $this->data['title'] = 'Exam';
        $this->data['add_title'] = 'Add Exam';
        $this->data['edit_title'] = 'Update Exam';
        $this->data['exams'] = $this->Professor_model->exam_details();
        //$this->data['exam_type'] = $this->Professor_model->get_all_exam_type();
        $this->data['degree'] = $this->Professor_model->get_all_degree();
        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['semester'] = $this->Professor_model->get_all_semester();
        //$this->data['centerlist'] = $this->db->get('center_user')->result();   
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
            $this->session->set_userdata('last_activity', "Exam time table deleted");
            $this->session->set_userdata('activity_status', "1");
            $this->session->set_flashdata('flash_message', 'Exam time table deleted successfully');
            redirect(base_url('professor/exam_time_table'));
        }
        if ($_POST) {
            if ($param1 == 'create') {
                //check for duplication
                $is_record_present = $this->Professor_model->exam_time_table_duplication(
                        $_POST['exam'], $_POST['subject']);

                if (count($is_record_present)) {
                    $this->session->set_userdata('last_activity', "Exam time table Data is already present");
                    $this->session->set_userdata('activity_status', "1");
                    $this->session->set_flashdata('flash_message', 'Data is already present.');
                    redirect(base_url('professor/exam_schedule'));
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
                        $this->session->set_userdata('last_activity', "Exam time table added");
                        $this->session->set_userdata('activity_status', "1");
                        $this->session->set_flashdata('flash_message', 'Time table is added successfully.');
                        redirect(base_url('professor/exam_schedule'));
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
                    $this->session->set_userdata('last_activity', "Exam time table updated");
                    $this->session->set_userdata('activity_status', "1");
                    $this->session->set_flashdata('flash_message', 'Time table updated successfully');
                    redirect(base_url('professor/exam_schedule'));
                }
            }
        }
        $this->data['degree'] = $this->Professor_model->get_all_degree();

        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['semester'] = $this->Professor_model->get_all_semester();

        $this->data['time_table'] = $this->Professor_model->time_table();
        $this->data['title'] = 'Exam Schedule';
        $this->data['add_title'] = $this->lang_message('add_exam_schedule');
        $this->data['edit_title'] = $this->lang_message('edit_exam_schedule');
        $this->data['page'] = 'exam_schedule';
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
                $this->session->set_userdata('last_activity', "Marks updated");
                $this->session->set_userdata('activity_status', "1");
                $this->session->set_flashdata('flash_message', 'Marks is successfully updated.');
                redirect(base_url('professor/marks/' . $degree_id . '/' . $course_id . '/' . $batch_id . '/' . $semester_id . '/' . $exam_id . '/' . $student_id));
            }
            $this->session->set_userdata('last_activity', "Marks updated");
            $this->session->set_userdata('activity_status', "1");
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
        //$this->data['course'] = $this->Professor_model->get_all_course();
        //$this->data['semester'] = $this->Professor_model->get_all_semester();
        $this->data['time_table'] = $this->Professor_model->time_table();
        $this->data['title'] = 'Exam Marks';
        $this->data['page'] = 'exam_marks';
        $this->__site_template('professor/exam_marks', $this->data);
    }

    /**
     * Get all semesters of the branch
     * @param string $branch_id
     */
    function get_semesters_of_branch($branch_id = '') {
        $this->load->model('professor/Professor_model');
        $semester = $this->Professor_model->get_semesters_of_branch($branch_id);

        echo json_encode($semester);
    }

    /**
     * Batch list from degree and course
     * @param int $degree
     * @param int $course
     */
    function batch_list_from_degree_and_course($degree = '', $course = '') {
        $this->load->model('professor/Professor_model');
        $batch = $this->Professor_model->batch_list_from_degree_and_course($degree, $course);

        echo json_encode($batch);
    }

    /**
     * Course list from degree
     * @param int $degree_id
     */
    function course_list_from_degree($degree_id) {
        $course = $this->Professor_model->course_list_from_degree($degree_id);

        echo json_encode($course);
    }

    function get_course($param = '') {
        $did = $this->input->post("degree");

        if ($did != '') {
            $cource = $this->db->get_where("course", array("degree_id" => $did))->result_array();
            $html = '<option value="">Select Branch</option>';
            foreach ($cource as $crs):
                $html .='<option value="' . $crs['course_id'] . '">' . $crs['c_name'] . '</option>';

            endforeach;
            echo $html;
        }
    }

    function get_batches($param = '') {
        $cid = $this->input->post("course");
        $did = $this->input->post("degree");
        if ($cid != '') {

            // $cource = $this->db->get_where("batch",array("degree_id"=>$cid))->result_array();
            $batch = $this->db->query("SELECT * FROM batch WHERE FIND_IN_SET('" . $did . "',degree_id) AND FIND_IN_SET('" . $cid . "',course_id)")->result_array();
            // echo $this->db->last_query();

            $html = '<option value="">Select Batch</option>';

            foreach ($batch as $btc):
                $html .='<option value="' . $btc['b_id'] . '">' . $btc['b_name'] . '</option>';

            endforeach;
            echo $html;
        }
    }

    function assessment_student() {
        $batch = $this->input->post("batch");
        $sem = $this->input->post("semester");
        $degree = $this->input->post("degree");
        $course = $this->input->post("course");

        $datastudent = $this->db->get_where("student", array("std_batch" => $batch, 'std_status' => 1, "semester_id" => $sem, 'course_id' => $course, 'std_degree' => $degree))->result();
        $html = '<option value="">Select Student</option>';
        foreach ($datastudent as $row):
            $html .='<option value="' . $row->std_id . '">' . $row->name . '</option>';
        endforeach;
        echo $html;
    }

    function get_semester($param = '') {
        $cid = $this->input->post("course");
        $course = $this->db->get_where('course', array('course_id' => $cid))->result_array();

        $semexplode = explode(',', $course[0]['semester_id']);
        $semester = $this->db->get('semester')->result_array();

        foreach ($semester as $sem) {
            if (in_array($sem['s_id'], $semexplode)) {
                $semdata[] = $sem;
            }
        }
        $option = "<option value=''>Select semester</option>";
        foreach ($semdata as $s) {
            $option .="<option value=" . $s['s_id'] . ">" . $s['s_name'] . "</option>";
        }
        echo $option;
    }

    /**
     * get course
     * @param int $param
     */
    function get_cource($param = '') {

        $did = $this->input->post("degree");

        if ($did != '') {

            if ($did == "All") {
                
            } else {

                $cource = $this->db->get_where("course", array("degree_id" => $did))->result_array();

                $html = '<option value="">Select Branch</option>';
                if ($param == '') {
                    $html .= '<option value="All">All</option>';
                }
                foreach ($cource as $crs):
                    $html .='<option value="' . $crs['course_id'] . '">' . $crs['c_name'] . '</option>';

                endforeach;
                echo $html;
            }
        }
    }

    /**
     * Check assignment
     * return json
     */
    function checkassignments() {
        $degree = $this->input->post('degree');
        $course = $this->input->post('course');
        $batch = $this->input->post('batch');
        $semester = $this->input->post('semester');
        $title = $this->input->post('title');
        $data = $this->db->get_where('assignment_manager', array('assign_degree' => $degree,
                    'course_id' => $course,
                    'assign_title' => $title,
                    'assign_batch' => $batch, 'assign_sem' => $semester))->result_array();
        echo json_encode($data);
    }

    /**
     * check duplicate assignment
     * @param int $id
     */
    function checkassignment($id = '') {
        $degree = $this->input->post('degree');
        $course = $this->input->post('course');
        $batch = $this->input->post('batch');
        $semester = $this->input->post('semester');
        $title = $this->input->post('title');
        $data = $this->db->get_where('assignment_manager', array('assign_degree' => $degree,
                    'course_id' => $course,
                    'assign_title' => $title,
                    'assign_batch' => $batch, 'assign_sem' => $semester, 'assign_id!=' => $id))->result_array();

        echo json_encode($data);
    }

    /**
     * Exam filter
     * @param string $degree
     * @param string $course
     * @param string $batch
     * @param string $semester
     */
    function get_exam_filter($degree, $course, $batch, $semester) {
        $this->data['exams'] = $this->Professor_model->get_exam_filter($degree, $course, $batch, $semester);
        $this->load->view("professor/exam_filter", $this->data);
    }

    /**
     * Get exam list by course name and semester
     * @param type $course_id
     * @param type $semester_id
     * 
     */
    function get_exam_list($degree_id = '', $course_id = '', $batch_id = '', $semester_id = '', $time_table = '') {
        $this->load->model('admin/Crud_model');
        $exam_detail = $this->Crud_model->get_exam_list($degree_id, $course_id, $batch_id, $semester_id);
        echo "<option value=''>Select</option>";
        foreach ($exam_detail as $row) {
            ?>
            <option value="<?php echo $row->em_id ?>"
                    <?php if ($row->em_id == $time_table) echo 'selected'; ?>><?php echo $row->em_name . '  (Marks' . $row->total_marks . ')'; ?></option>
            <!--echo "<option value={$row->em_id}>{$row->em_name}  (Marks{$row->total_marks})</option>";-->
            <?php
        }
    }

    /**
     * Subject list from course and semester
     * @param int $course
     * @param int $semester
     */
    function subject_list_from_course_and_semester($course, $semester) {
        $this->load->model('admin/Crud_model');
        $subjects = $this->Crud_model->subject_list_from_course_and_semester($course, $semester);

        echo json_encode($subjects);
    }

    /**
     * Semester list from branch
     * @param string $branch_id
     */
    function semesters_list_from_branch($branch_id) {
        $this->load->model('admin/Crud_model');
        $semester = $this->Crud_model->get_semesters_of_branch($branch_id);

        echo json_encode($semester);
    }

    /**
     * Email inbox
     */
    function email_inbox() {
        $this->load->helper('system_email');
        $this->data['inbox'] = professor_inbox();
        $this->data['title'] = 'Inbox';
        $this->data['page'] = 'email_inbox';
        $this->__site_template('professor/email_inbox', $this->data);
    }

    /**
     * Email compose
     * 
     * @return response
     */
    function email_compose() {
        ini_set('max_execution_time', 500);
        //load the Crud model
        $this->load->model('professor/Professor_model');
        $this->load->model('admin/Crud_model');
        $this->load->helper('system_email');
        $this->load->library('upload');
        if ($_POST) {
            $filename = '';
            $attachments = array();
            if ($_FILES['userfile']['name'][0] != '') {
                $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload();
                    $uploaded = $this->upload->data();
                    $filename .= $uploaded['file_name'] . ',';
                    array_push($attachments, $uploaded['full_path']);
                }
            }
            $filename = rtrim($filename, ',');
            $_POST['file_name'] = $filename;
            $admin_list = array();
            if (count($_POST['to'])) {
                $admin_list = $_POST['to'];
                $admin_to = '';
                foreach ($admin_list as $row) {


                    $admin_to .= $row . ',';
                }
            }
            //  $admin_to;
            $admin_to = rtrim($admin_to, ',');

            if ($_POST['course'] == 'all') {
                // send to all students 
                send_to_all_course_professor($_POST, $admin_to);
            } else if ($_POST['semester'] == 'all') {
                //send to all semester of the course
                send_to_course_all_semester_professor($_POST, $_POST['course'], $admin_to);
            } else if ($_POST['student'][0] == 'all' || $_POST['student']) {


                //send to all students of the course and semeter
                send_to_all_student_course_semester_professor($_POST, $_POST['course'], $_POST['semester'], $admin_to);
            } else {
                //send particular student                
                send_to_single_student_professor($_POST, $admin_to);
            }

            $cc_list = explode(',', $_POST['cc']);
            $email_cc_list = array();
            foreach ($cc_list as $row) {
                array_push($email_cc_list, $row);
            }

            //send email
            //var_dump($admin_list);
            //exit;
            $this->setemail($admin_list, $_POST['subject'], $_POST['message'], $email_cc_list, $attachments);
            $this->session->set_userdata('last_activity', "Email sent.");
            $this->session->set_userdata('activity_status', "1");
            $this->session->set_flashdata('flash_message', 'Email was sent successfully.');
            redirect(base_url('professor/email_inbox'));
        }
        $this->data['course'] = $this->Professor_model->get_all_course();
        $this->data['degree'] = $this->Professor_model->get_all_degree();
        $this->data['semester'] = $this->Crud_model->get_all_semester();
        //$this->data['students'] = $this->Crud_model->get_all_students();
        //$this->db->select('professor_id, email, name')->from('professor')->get()->result();
        //$this->data['teacher'] = $this->Crud_model->get_all_teacher();
        $this->data['all_admin'] = $this->Crud_model->get_all_admin();
        //set the template and view
        $this->data['title'] = 'Compose';
        $this->data['content'] = 'email_compose';
        $this->data['page'] = 'email_compose';
        $this->__site_template('professor/email_compose', $this->data);
    }

    function set_upload_options() {
        //upload an image options
        $config = array(
            'upload_path' => './uploads/emails/',
            'allowed_types' => 'gif|jpg|png|pdf|xlsx|xls|doc|docx|ppt|pptx|pdf',
            'max_size' => '10000'
        );
        return $config;
    }

    /**
     * Set mail config
     */
    function setemail($emails, $subject = '', $message = '', $cc, $attachment) {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'mayur.ghadiya@searchnative.in',
            'smtp_pass' => 'the mayurz97375',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        //$this->load->library('email');
        //$this->email->initialize($config);
        $subject = $subject;
        $message = $message;
        foreach ($emails as $email) {
            $this->email->clear(TRUE);
            $this->sendEmail($email, $subject, $message, $cc, $attachment);
        }
    }

    /**
     * Send email
     * @param string $email
     * @param string $subject
     * @param string $message
     * @param string $cc
     * @param string $attachments
     */
    public function sendEmail($email, $subject, $message, $cc, $attachments) {
        //$this->email->set_newline("\r\n");
        $this->email->from('mayur.ghadiya@searchnative.in', 'Search Native India');
        $this->email->to('admin@example.com');
        foreach ($cc as $row) {
            $this->email->cc($row);
        }
        $this->email->subject($subject);
        $this->email->message($message);
        //$files = array('D:\unit testing.docx', 'D:\vtiger trial version features.docx');        
        if (count($attachments)) {
            foreach ($attachments as $row) {
                $this->email->attach($row);
            }
        }
        if ($this->email->send()) {
            echo 'Email send.';
        } else {
            show_error($this->email->print_debugger());
        }
    }

    /**
     * Get all student by course and semester
     * @param string $course_id
     * @param string $semester_id
     */
    function course_semester_student($course_id = '', $semester_id = '') {
        $this->load->model('admin/Crud_model');
        $students = $this->Crud_model->course_semester_student($course_id, $semester_id);
        foreach ($students as $row) {
            ?>
            <option value="<?php echo $row->std_id; ?>"><?php echo $row->std_first_name . ' ' . $row->std_last_name; ?></option>
            <?php
        }
    }

    /**
     * Email sent
     */
    function email_sent() {
        $this->load->helper('system_email');
        $this->data['sent_mail'] = professor_sent_email(); //admin
        $this->data['title'] = 'Sent Email';
        $this->data['page'] = 'email_sent';
        $this->__site_template('professor/email_sent', $this->data);
    }

    /**
     * View particular email details
     * @param int $id
     */
    function email_view($id) {
        $this->load->model('admin/Crud_model');
        $this->load->helper('system_email');
        $this->data['email'] = view_email($id);
        $this->data['title'] = $this->data['email']->subject;
        $this->data['content'] = 'email_view';
        $this->data['page'] = 'email_inbox';
        $this->__site_template('professor/email_view', $this->data);
    }

    /**
     * Delete email
     * @param type $id
     */
    function delete_email($id) {
        $this->load->library('user_agent');
        $this->load->model('admin/Crud_model');
        $this->Crud_model->delete_email($id);
        redirect($this->agent->referrer());
    }

    /**
     * get batches
     * @param String $param
     */
    function get_batchs($param = '') {
        $cid = $this->input->post("course");
        $did = $this->input->post("degree");
        $html = '';
        if ($cid != '') {
            if ($cid == "All") {
                $html .= '<option value="All">All</option>';
            } else {
                $batch = $this->db->query("SELECT * FROM batch WHERE FIND_IN_SET('" . $did . "',degree_id) AND FIND_IN_SET('" . $cid . "',course_id)")->result_array();
                $html = '<option value="">Select Batch</option>';
                if ($param == "") {
                    $html .= '<option value="All">All</option>';
                }
                foreach ($batch as $btc):
                    $html .='<option value="' . $btc['b_id'] . '">' . $btc['b_name'] . '</option>';

                endforeach;
            }
            echo $html;
        }
    }

    /**
     * get study resource filter list
     */
    function getstudyresource() {
        $degree = $this->input->post('degree');
        $course = $this->input->post('course');
        $batch = $this->input->post('batch');
        $semester = $this->input->post("semester");
        $data['course'] = $this->db->get('course')->result();
        $data['semester'] = $this->db->get('semester')->result();
        $data['batch'] = $this->db->get('batch')->result();
        $data['degree'] = $this->db->get('degree')->result();
        $data['student'] = $this->db->get('student')->result();

        if ($degree == "All") {


            $data['studyresource'] = $this->db->get('study_resources')->result();
        } else {
            if ($course == "All") {
                $this->db->where("study_degree", $degree);
                $data['studyresource'] = $this->db->get('study_resources')->result();
            } else {
                if ($batch == 'All') {
                    $this->db->where("study_course", $course);
                    $this->db->where("study_degree", $degree);
                    $data['studyresource'] = $this->db->get('study_resources')->result();
                } else {
                    if ($semester == "All") {
                        $this->db->where("study_batch", $batch);
                        $this->db->where("study_course", $course);
                        $this->db->where("study_degree", $degree);
                        $data['studyresource'] = $this->db->get('study_resources')->result();
                    } else {
                        $this->db->where("study_sem", $semester);
                        $this->db->where("study_batch", $batch);
                        $this->db->where("study_course", $course);
                        $this->db->where("study_degree", $degree);
                        $data['studyresource'] = $this->db->get('study_resources')->result();
                    }
                }
            }
        }

        // $this->db->where("study_course",$course);
        // $this->db->or_where('study_course >', 'All'); 
        //     $this->db->where("study_batch",$batch);
        //  $this->db->or_where('study_batch >', 'All'); 
        //      $this->db->where("study_degree",$degree);
        //     $this->db->or_where('study_degree >', 'All'); 
        //    $this->db->where("study_sem",$semester);
        //   $this->db->or_where('study_sem >', 'All'); 
        //     $data['studyresource'] = $this->db->get('study_resources')->result();
        //$page_data['studyresource'] = $this->db->get('study_resources')->result();

        $this->load->view("professor/getstudyresource", $data);
    }

    /**
     * 
     * @param String $param
     */
    function get_courcestudy($param = '') {

        $did = $this->input->post("degree");

        if ($did != '') {



            $cource = $this->db->get_where("course", array("degree_id" => $did))->result_array();

            $html = '<option value="">Select Branch</option>';
            if ($param == '') {
                $html .= '<option value="All">All</option>';
            }
            foreach ($cource as $crs):
                $html .='<option value="' . $crs['course_id'] . '">' . $crs['c_name'] . '</option>';

            endforeach;
            echo $html;
        }
    }

    /**
     * 
     * @param string $param
     */
    function getassignment($param = '') {
        if ($param == 'allassignment') {
            $degree = $this->input->post('degree');
            $course = $this->input->post('course');
            $batch = $this->input->post('batch');
            $semester = $this->input->post("semester");
            $class = $this->input->post("divclass");
            $data['course'] = $this->db->get('course')->result();
            $data['semester'] = $this->db->get('semester')->result();
            $data['batch'] = $this->db->get('batch')->result();
            $data['degree'] = $this->db->get('degree')->result();
            $data['class'] = $this->db->get('class')->result();
            $this->db->where("course_id", $course);
            $this->db->where("assign_batch", $batch);
            $this->db->where("assign_degree", $degree);
            $this->db->where("assign_sem", $semester);
            $this->db->where("class_id", $class);
            $data['param'] = $param;
            $data['assignment'] = $this->db->get('assignment_manager')->result();

            $this->load->view("professor/getassignment", $data);
        }
        if ($param == "submitted") {

            $degree = $this->input->post('degree');
            $course = $this->input->post('course');
            $batch = $this->input->post('batch');
            $semester = $this->input->post("semester");
            // $class = $this->input->post("divclass");
            $data['course'] = $this->db->get('course')->result();
            $data['semester'] = $this->db->get('semester')->result();
            $data['batch'] = $this->db->get('batch')->result();
            $data['degree'] = $this->db->get('degree')->result();
            $data['class'] = $this->db->get('class')->result();
            //   $this->db->where("course_id",$course);
            //   $this->db->where("assign_batch",$batch);
            //  $this->db->where("assign_degree",$degree);
            //   $this->db->where("assign_sem",$semester);
            //$data['assignment'] = $this->db->get('assignment_manager')->result();

            $this->db->select("ass.*,am.*,s.*,s.class_id");
            $this->db->from('assignment_submission ass');
            $this->db->join("assignment_manager am", "am.assign_id=ass.assign_id");
            $this->db->join("student s", "s.std_id=ass.student_id");
            $this->db->where("am.course_id", $course);
            $this->db->where("am.assign_batch", $batch);
            $this->db->where("am.assign_degree", $degree);
            $this->db->where("am.assign_sem", $semester);
            //$this->db->where("am.class_id", $class);
            $data['submitedassignment'] = $this->db->get()->result();

            $data['param'] = $param;
            $this->load->view("professor/getassignment", $data);
        }
        if ($param == "assessments") {

            $degree = $this->input->post('degree');
            $course = $this->input->post('course');
            $batch = $this->input->post('batch');
            $semester = $this->input->post("semester");
            // $class = $this->input->post("divclass");
            $data['course'] = $this->db->get('course')->result();
            $data['semester'] = $this->db->get('semester')->result();
            $data['batch'] = $this->db->get('batch')->result();
            $data['degree'] = $this->db->get('degree')->result();
            $data['class'] = $this->db->get('class')->result();
            //   $this->db->where("course_id",$course);
            //   $this->db->where("assign_batch",$batch);
            //  $this->db->where("assign_degree",$degree);
            //   $this->db->where("assign_sem",$semester);
            //$data['assignment'] = $this->db->get('assignment_manager')->result();

            $this->db->select("ass.*,am.*,s.*,s.class_id");
            $this->db->from('assignment_submission ass');
            $this->db->join("assignment_manager am", "am.assign_id=ass.assign_id");
            $this->db->join("student s", "s.std_id=ass.student_id");
            $this->db->where("am.course_id", $course);
            $this->db->where("am.assign_batch", $batch);
            $this->db->where("am.assign_degree", $degree);
            $this->db->where("am.assign_sem", $semester);
            //$this->db->where("am.class_id", $class);
            $data['submitedassignment'] = $this->db->get()->result();

            $data['param'] = $param;
            $this->load->view("professor/getassignment", $data);
        }
    }

    /**
     * course filter
     * @param String  $param
     */
    function course_filter($param = '') {
        $did = $this->input->post("degree");

        if ($did != '') {
            if ($did == 'All') {
                echo ' <option value="">Select Branch</option>
                   <option value="All">All</option>';
            } else {
                $cource = $this->db->get_where("course", array("degree_id" => $did))->result_array();
                $html = '';
                foreach ($cource as $crs):
                    $html .='<option value="' . $crs['course_id'] . '">' . $crs['c_name'] . '</option>';

                endforeach;
                echo $html;
            }
        }
    }

    /**
     * batch filter
     * @param String $param
     */
    function batch_filter($param = '') {
        $cid = $this->input->post("course");
        $did = $this->input->post("degree");
        if ($cid != '') {
            $html = '';
            // $cource = $this->db->get_where("batch",array("degree_id"=>$cid))->result_array();
            if ($cid == "All") {
                //$batch = $this->db->query("SELECT * FROM batch WHERE FIND_IN_SET('" . $did . "',degree_id)")->result_array();
                // $batch = '';
                echo ' <option value="">Select Batch</option>
                   <option value="All">All</option>';
            } else {
                $batch = $this->db->query("SELECT * FROM batch WHERE FIND_IN_SET('" . $did . "',degree_id) AND FIND_IN_SET('" . $cid . "',course_id)")->result_array();


                // echo $this->db->last_query();           

                foreach ($batch as $btc):
                    $html .='<option value="' . $btc['b_id'] . '">' . $btc['b_name'] . '</option>';

                endforeach;
                echo $html;
            }
        }
    }

    /**
     * 
     * @param String $param
     */
    function getprojects($param = '') {
        if ($param == 'allproject') {
            $degree = $this->input->post('degree');
            $course = $this->input->post('course');
            $batch = $this->input->post('batch');
            $semester = $this->input->post("semester");
            $class = $this->input->post("divclass");
            $data['course'] = $this->db->get('course')->result();
            $data['semester'] = $this->db->get('semester')->result();
            $data['batch'] = $this->db->get('batch')->result();
            $data['degree'] = $this->db->get('degree')->result();
            $data['class'] = $this->db->get('class')->result();
            $data['student'] = $this->db->get('student')->result();
            $this->db->where("pm_course", $course);
            $this->db->where("pm_batch", $batch);
            $this->db->where("pm_degree", $degree);
            $this->db->where("pm_semester", $semester);
            $this->db->where("class_id", $class);
            $data['param'] = $param;
            $data['project'] = $this->db->get('project_manager')->result();

            $this->load->view("professor/getprojects", $data);
        }
        if ($param == 'submitted') {
            $degree = $this->input->post('degree');
            $course = $this->input->post('course');
            $batch = $this->input->post('batch');
            $semester = $this->input->post("semester");
            $data['course'] = $this->db->get('course')->result();
            $data['semester'] = $this->db->get('semester')->result();
            $data['batch'] = $this->db->get('batch')->result();
            $data['degree'] = $this->db->get('degree')->result();
            $data['student'] = $this->db->get('student')->result();
            $data['student'] = $this->db->get('student')->result();
            $this->db->select("ps.*,pm.*,s.* ");
            $this->db->from('project_document_submission ps');
            $this->db->join("project_manager pm", "pm.pm_id=ps.project_id");
            $this->db->join("student s", "s.std_id=ps.student_id");
            $this->db->where("pm_course", $course);
            $this->db->where("pm_batch", $batch);
            $this->db->where("pm_degree", $degree);
            $this->db->where("pm_semester", $semester);
            $data['submitedproject'] = $this->db->get()->result();
            $data['param'] = $param;
            $this->load->view("professor/getprojects", $data);
        }
    }

    /**
     * 
     * @param int $id
     */
    function checkprjectsedit($id = '') {
        $degree = $this->input->post('degree');
        $course = $this->input->post('course');
        $batch = $this->input->post('batch');
        $semester = $this->input->post('semester');
        $title = $this->input->post('title');
        $data = $this->db->get_where('project_manager', array('pm_degree' => $degree,
                    'pm_course' => $course,
                    'pm_title' => $title,
                    'pm_batch' => $batch, 'pm_semester' => $semester, 'pm_id!=' => $id))->result_array();
        echo json_encode($data);
    }

    /**
     * 
     * @param int $param
     */
    function batchwisestudentcheckbox($param = '') {
        $batch = $this->input->post("batch");
        $sem = $this->input->post("sem");
        $degree = $this->input->post("degree");
        $course = $this->input->post("course");
        $html = '';
        if ($param != '') {
            $edit_data = $this->db->get_where('project_manager', array('pm_id' => $param))->result_array();
            $student = $edit_data[0]['pm_student_id'];
            $std = explode(",", $student);
        }

        if ($batch != "") {
            $datastudent = $this->db->get_where("student", array("std_batch" => $batch, 'semester_id' => $sem, 'std_status' => 1, 'course_id' => $course, 'std_degree' => $degree))->result();
            //  $datastudent = $this->db->get_where('student', array('std_status' => 1))->result();

            foreach ($datastudent as $rowstu) {
                if (isset($std)) {
                    if (in_array($rowstu->std_id, $std)) {
                        $html .='<div class="checkedstudent"><input type="checkbox" class="checkbox1" onclick="uncheck();" name="student[]" value="' . $rowstu->std_id . '" checked="">' . $rowstu->std_first_name . '&nbsp' . $rowstu->std_last_name . '</div>';
                    } else {
                        $html .='<div class="checkedstudent"><input type="checkbox" class="checkbox1" onclick="uncheck();" name="student[]" value="' . $rowstu->std_id . '">' . $rowstu->std_first_name . '&nbsp' . $rowstu->std_last_name . '</div>';
                    }
                } else {
                    $html .='<div class="checkedstudent"><input type="checkbox" class="checkbox1" onclick="uncheck();" name="student[]" value="' . $rowstu->std_id . '">' . $rowstu->std_first_name . '&nbsp' . $rowstu->std_last_name . '</div>';
                }
            }
        }
    }

    /**
     * 
     * @param int $param
     */
    function checkboxstudent($param = '') {

        $batch = $this->input->post("batch");
        $sem = $this->input->post("sem");
        $degree = $this->input->post("degree");
        $course = $this->input->post("course");
        $class = $this->input->post("divclass");

        $datastudent = $this->db->get_where("student", array("std_batch" => $batch, 'std_status' => 1, "semester_id" => $sem, 'course_id' => $course, 'std_degree' => $degree, 'class_id' => $class))->result();
        $html = '';
        if ($param != '') {
            $edit_data = $this->db->get_where('project_manager', array('pm_id' => $param))->result_array();
            $student = $edit_data[0]['pm_student_id'];
            $std = explode(",", $student);
        }

        foreach ($datastudent as $rowstu) {
            //$rowstu->std_id . . $rowstu->name;
            if (isset($std)) {
                if (in_array($rowstu->std_id, $std)) {
                    $html .='<div class="checkedstudent"><input type="checkbox" class="checkbox1" onclick="uncheck();" name="student[]" value="' . $rowstu->std_id . '" checked="">' . $rowstu->std_first_name . '&nbsp' . $rowstu->std_last_name . '</div>';
                } else {
                    $html .='<div class="checkedstudent"><input type="checkbox" class="checkbox1" onclick="uncheck();" name="student[]" value="' . $rowstu->std_id . '">' . $rowstu->std_first_name . '&nbsp' . $rowstu->std_last_name . '</div>';
                }
            } else {
                $html .='<div class="checkedstudent"><input type="checkbox" class="checkbox1" onclick="uncheck();" name="student[]" value="' . $rowstu->std_id . '">' . $rowstu->std_first_name . '&nbsp' . $rowstu->std_last_name . '</div>';
            }
        }
        echo $html;
    }

    /**
     * check duplicate project
     */
    function checkprjects() {
        $degree = $this->input->post('degree');
        $course = $this->input->post('course');
        $batch = $this->input->post('batch');
        $semester = $this->input->post('semester');
        $title = $this->input->post('title');
        $data = $this->db->get_where('project_manager', array('pm_degree' => $degree,
                    'pm_course' => $course,
                    'pm_title' => $title,
                    'pm_batch' => $batch, 'pm_semester' => $semester))->result_array();
        echo json_encode($data);
    }

    /**
     * Student Project list 
     * return boolean
     */
    function checkprojectstd() {
        $batch = $this->input->post("batch");
        $sem = $this->input->post("sem");
        $degree = $this->input->post("degree");
        $course = $this->input->post("course");
        $datastudent = $this->db->get_where("student", array("std_batch" => $batch, 'std_status' => 1, "semester_id" => $sem, 'course_id' => $course, 'std_degree' => $degree))->result();
        if (count($datastudent) > 0) {
            echo "true";
        } else {
            echo "false";
        }
    }

    function getlibrary($param = '') {

        $degree = $this->input->post('degree');
        $course = $this->input->post('course');
        $batch = $this->input->post('batch');
        $semester = $this->input->post("semester");
        $data['course'] = $this->db->get('course')->result();
        $data['semester'] = $this->db->get('semester')->result();
        $data['batch'] = $this->db->get('batch')->result();
        $data['degree'] = $this->db->get('degree')->result();
        if ($degree == "All") {
            $data['library'] = $this->db->get('library_manager')->result();
        } else {
            if ($course == "All") {
                $this->db->where("lm_degree", $degree);
                $data['library'] = $this->db->get('library_manager')->result();
            } else {
                if ($batch == 'All') {
                    $this->db->where("lm_course", $course);
                    $this->db->where("lm_degree", $degree);
                    $data['library'] = $this->db->get('library_manager')->result();
                } else {
                    if ($semester == "All") {
                        $this->db->where("lm_batch", $batch);
                        $this->db->where("lm_course", $course);
                        $this->db->where("lm_degree", $degree);
                        $data['library'] = $this->db->get('library_manager')->result();
                    } else {
                        $this->db->where("lm_semester", $semester);
                        $this->db->where("lm_batch", $batch);
                        $this->db->where("lm_course", $course);
                        $this->db->where("lm_degree", $degree);
                        $data['library'] = $this->db->get('library_manager')->result();
                    }
                }
            }
        }
        $this->load->view("professor/getlibrary", $data);
    }

    function batchwisestudent() {
        $batch = $this->input->post("batch");
        if ($batch != "") {
            $datastudent = $this->db->get_where("student", array("std_batch" => $batch, 'std_status' => 1))->result();
            //  $datastudent = $this->db->get_where('student', array('std_status' => 1))->result();
            $html = '<option value="">Select student</option>';
            foreach ($datastudent as $rowstu) {
                $html .='<option value="' . $rowstu->std_id . '">' . $rowstu->name . '</option>';
            }
        } else {
            $html = '<option value="">Select student</option>';
        }
        echo $html;
    }

    function semwisestudent() {
        $batch = $this->input->post("batch");
        $sem = $this->input->post("sem");
        $degree = $this->input->post("degree");
        $course = $this->input->post("course");

        $datastudent = $this->db->get_where("student", array("std_batch" => $batch, 'std_status' => 1, "semester_id" => $sem, 'course_id' => $course, 'std_degree' => $degree))->result();
        $html = '<option value="">Select student</option>';
        foreach ($datastudent as $rowstu) {
            $html .='<option value="' . $rowstu->std_id . '">' . $rowstu->name . '</option>';
        }
        echo $html;
    }

    function get_semesterall() {

        $cid = $this->input->post("course");

        if ($cid == 'All') {
            $course = $this->db->get('course')->result_array();
        } else {

            $course = $this->db->get_where('course', array('course_id' => $cid))->result_array();
        }

        $semexplode = explode(',', $course[0]['semester_id']);
        $semester = $this->db->get('semester')->result_array();
        $semdata = '';
        foreach ($semester as $sem) {
            if (in_array($sem['s_id'], $semexplode)) {
                $semdata[] = $sem;
            }
        }
        $option = "<option value=''>Select semester</option>";
        $option .="<option value='All'>All</option>";

        foreach ($semdata as $s) {
            $option .="<option value=" . $s['s_id'] . ">" . $s['s_name'] . "</option>";
        }
        echo $option;
    }

    /**
     * manage profile
     * @param String $param1
     * @param int $param2
     * @param type $param3
     */
    function manage_profile($param1 = '', $param2 = '', $param3 = '') {
        $this->load->model('admin/Crud_model');
        $this->data['error'] = '';
        if ($param1 == 'update_profile_info') {
            if (!empty($_POST)) {
                //update password
                $old_password = $_POST['password'];
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];
                if ($old_password != '' && $new_password != '' && $confirm_password != '') {
                    $professor = $this->Professor_model->professor_details($this->session->userdata('login_user_id'));
                    if ($old_password == $professor->real_pass) {
                        if ($new_password == $confirm_password) {
                            //update password
                            $id = $professor->professor_id;
                            $data = array(
                                'password' => hash('md5', $new_password),
                                'real_pass' => $new_password
                            );
                            $this->Professor_model->update_password($data, $id);
                            $this->session->set_flashdata('flash_message', 'Password is successfully changed.');
                            redirect(base_url('professor/manage_profile'));
                        } else {
                            $this->data['error'] = 'Password is mismatched.';
                        }
                    } else {
                        $this->data['error'] = 'Invalid old password';
                    }
                }
                if ($_FILES['userfile']['name'] != '') {


                    $allowed_types = explode('|', 'gif|jpg|png|jpeg');

                    $ext = explode(".", $_FILES['userfile']['name']);
                    $ext_file = strtolower(end($ext));
                    $file_name = date('dmYhis') . '.' . $ext_file;
                    if (in_array($ext_file, $allowed_types)) {

                        $upl_path = FCPATH . 'uploads/professor/' . $file_name;
                        //  mkdir(FCPATH . 'uploads/professor', 0777);


                        move_uploaded_file($_FILES['userfile']['tmp_name'], $upl_path);
                        chmod($upl_path, 0777);
                        $this->session->set_userdata('image_path', $file_name);
                    } else {
                        $file_name = '';
                    }

                    $data['image_path'] = $file_name;
                    $this->session->set_userdata('image_path', $file_name);
                    $param2 = $this->session->userdata("login_user_id");                    
                    $this->Crud_model->save_professor($data, $param2);
                    $this->session->set_flashdata("flash_message", 'Profile update successfully');
                    redirect(base_url() . 'professor/manage_profile');
                }
            }
        }
        $this->data['page'] = 'manage_profile';
        $this->data['title'] = 'Manage Profile';
        $this->data['degree_list'] = $this->Professor_model->get_all_degree();
        $this->data['edit_data'] = $this->db->get_where('professor', array('professor_id' => $this->session->userdata('login_user_id')))->result_array();
        $this->__site_template('professor/manage_profile', $this->data);
    }

    /**
     * Professor class routine
     */
    function class_routine() {
        //$this->load->view('professor/class_routine', array('title' => 'Class routine'));
        $this->data['title'] = 'Class Routine';
        $this->data['page'] = 'class_routine';
        $this->__site_template('professor/class_routine', $this->data);
    }

    /**
     * Class routine data
     */
    function class_routine_data() {
        $class_routine = $this->Professor_model->professor_class_schedule();
        //$class_routine = $this->db->get('class_routine')->result();
        echo json_encode($class_routine);
    }

    /**
     * Professor class routine
     */
    function professor_class_routine() {
        $this->load->view('professor/professor_class_routine');
    }

    /**
     * Check class routine
     */
    function check_class_routine() {
        date_default_timezone_set('Etc/UTC');
        if ($_POST) {
            require 'vendor/autoload.php';
            $this->load->library('Class_routine_attendance');
            $this->load->model('admin/Crud_model');
            if ($_POST) {
                $class_routine = $this->Professor_model->class_routine_attendance($_POST);
                $attendance_routine = array();
                $selected_date = date('Y-m-d', strtotime($_POST['class_date']));
                foreach ($class_routine as $row) {
                    if ($row->RecurrenceRule) {
                        //parse reccurrence rule
                        $rule = $this->class_routine_attendance->parse_reccurrence_rule($row->RecurrenceRule);
                        $rule_array = array();
                        $reccur_rule = '';
                        foreach ($rule as $key => $value) {
                            $separate_rule = explode('=>', $value);
                            $reccur_rule .= "'$separate_rule[0]' => '$separate_rule[1]'" . ';';
                        }
                        $conditional_rules = $this->class_routine_attendance->conditional_reccurrence_rule($reccur_rule);
                        $conditional_rules['DTSTART'] = $row->Start;
                        $rrule = new RRule\RRule($conditional_rules);
                        foreach ($rrule as $occurrence) {
                            if ($occurrence->format('Y-m-d') == $selected_date) {
                                array_push($attendance_routine, $row);
                                //echo $occurrence->format('Y-m-d');
                                break;
                            }
                            //break;
                        }
                    } else {
                        //single schedule event
                        array_push($attendance_routine, $row);
                    }
                }
            }
            echo '<option value="">Select</option>';
            foreach ($attendance_routine as $row) {
                ?>
                <option value="<?php echo $row->ClassRoutineId; ?>"><?php echo $row->subject_name . '--' . date('h:i A', strtotime($row->Start)) . '-' . date('h:i A', strtotime($row->End)); ?></option>
                <?php
            }
        }
    }

    /**
     * Submit student class routine attendance
     */
    function take_class_routine_attendance() {
        if ($_POST) {
            $this->load->model('admin/Crud_model');
            $student = $this->Crud_model->student_list_by_department_course_batch_semester_class($_POST['department'], $_POST['branch'], $_POST['batch'], $_POST['semester'], $_POST['class']);

            foreach ($student as $row) {
                $date = date('Y-m-d', strtotime($_POST['date']));
                $status = $this->Crud_model->check_attendance_status($_POST['department'], $_POST['branch'], $_POST['batch'], $_POST['semester'], $_POST['class'], $_POST['class_routine'], $date, $row->std_id);

                //check for existing attendnace
                if ($status) {
                    //update existing attendance of the student
                    if (isset($_POST['student_' . $status->student_id])) {
                        //present
                        $update['is_present'] = 1;
                    } else {
                        //absent
                        $update['is_present'] = 0;
                    }
                    $this->Crud_model->save_student_attendance($update, $status->attendance_id);
                } else {
                    $save = array(
                        'department_id' => $_POST['department'],
                        'branch_id' => $_POST['branch'],
                        'batch_id' => $_POST['batch'],
                        'semester_id' => $_POST['semester'],
                        'class_id' => $_POST['class'],
                        'professor_id' => $_POST['professor'],
                        'class_routine_id' => $_POST['class_routine'],
                        'date_taken' => $date
                    );
                    if (isset($_POST['student_' . $row->std_id])) {
                        //present student
                        $save['student_id'] = $row->std_id;
                        $save['is_present'] = 1;
                    } else {
                        //absent student
                        $save['student_id'] = $row->std_id;
                        $save['is_present'] = 0;
                    }
                    $this->Crud_model->save_student_attendance($save);
                }
            }
        }
        $this->session->set_flashdata('flash_message', 'Attendance is successfully updated.');
        redirect(base_url('professor/attendance'));
    }

    /**
     * add to do list
     */
    function add_to_do() {
        if ($_POST) {
            $title = $this->input->post('title');
            $todo_date = $this->input->post('todo_date');
            $todo_time = $this->input->post('todo_time');
            $datetime = $todo_date . ' ' . $todo_time;

            $datetime = strtotime($datetime);
            $datetime = date('Y-m-d H:i:s', $datetime);

            $data['todo_datetime'] = $datetime;
            $data['todo_title'] = $title;
            $data['todo_role'] = $this->session->userdata('login_type');
            $data['todo_role_id'] = $this->session->userdata('login_user_id');
            $this->Professor_model->insert_todo($data);
            $this->data['todolist'] = $this->Professor_model->get_todo();
            $this->load->view("professor/gettodo", $this->data);
        }
    }

    /**
     * Change status done undone
     */
    function changestatus() {
        if ($_POST) {
            $id = $this->input->post('id');
            $data['todo_status'] = $this->input->post('status');
            $this->Professor_model->change_status($data, $id);
        }
    }

    /**
     * remove to do list
     */
    function removetodolist() {
        if ($_POST) {
            $id = $this->input->post('id');

            $this->Professor_model->removetodo($id);
        }
    }

    /**
     * update form data
     * @param int $param
     */
    function todoupdateform($param = '') {

        $this->data['todolist'] = $this->Professor_model->gettododata($param);
        $this->load->view("professor/todoupdateform", $this->data);
    }

    /**
     * update to do list
     */
    function updatetodolist() {
        if ($_POST) {
            $title = $this->input->post('title');
            $todo_date = $this->input->post('todo_date');
            $todo_time = $this->input->post('todo_time');
            $datetime = $todo_date . ' ' . $todo_time;

            $datetime = strtotime($datetime);
            $datetime = date('Y-m-d H:i:s', $datetime);
            $data['todo_role'] = $this->session->userdata('login_type');
            $data['todo_role_id'] = $this->session->userdata('login_user_id');
            $data['todo_datetime'] = $datetime;
            $data['todo_title'] = $title;
            $id = $this->input->post('todo_id');
            $this->Professor_model->update_todo($data, $id);
            $this->data['todolist'] = $this->Professor_model->get_todo();
            $this->load->view("professor/gettodo", $this->data);
        }
    }

    /**
     * Email reply from admin
     * @param int $id
     */
    function email_reply($id) {
        $this->load->model('admin/Crud_model');
        $this->load->helper('system_email');
        if ($_POST) {
            $filename = '';
            if ($_FILES) {
                $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload();
                    $uploaded = $this->upload->data();
                    $filename .= $uploaded['file_name'] . ',';
                }
            }
            $filename = rtrim($filename, ',');
            $_POST['file_name'] = $filename;

            professor_email_reply($_POST);
            $this->session->set_userdata('last_activity', " Email replied.");
            $this->session->set_userdata('activity_status', "1");
            redirect(base_url('professor/email_inbox'));
        }

        $this->data['email'] = admin_inbox_email_view($id);
        $this->data['title'] = $this->data['email']->subject;
        $this->data['page'] = 'email_reply';
        $this->__site_template('professor/email_reply', $this->data);
    }

    /**
     * Vocational course Student List
     */
    function vocational_student($param1 = '', $param2 = '') {
        $professor_id = $this->session->userdata('login_user_id');
        $this->data['student'] = $this->Professor_model->get_vocational_student($param1);
        $this->data['title'] = 'Vocational Course Students';
        $this->data['page'] = 'vocational_register_student';
        $this->load->view('professor/vocational_register_student', $this->data);
    }

    /**
     * Get subject list by course and semester
     * @param type $course_id
     * @param type $semester_id
     */
    function subject_list($course_id = '', $semester_id, $time_table = '') {
        $this->load->model('admin/Crud_model');
        $subjects = $this->Crud_model->subject_list($course_id, $semester_id);
        echo "<option vale=''>Select</option>";
        foreach ($subjects as $row) {
            ?>
            <option value="<?php echo $row->sm_id; ?>"
                    <?php if ($row->sm_id == $time_table) echo 'selected'; ?>><?php echo $row->subject_name . '  Code: ' . $row->subject_code; ?></option>
            <!--echo "<option value={$row->sm_id}>{$row->subject_name}  (Code: {$row->subject_code})</option>";-->
            <?php
        }
    }

    /**
     * Professor inbox email view
     * @param int $id
     */
    function inbox_email($id) {
        $this->load->model('admin/Crud_model');
        $this->load->helper('system_email');

        $this->data['email'] = admin_inbox_email_view($id);
        $this->data['title'] = $this->data['email']->subject;
        $this->data['page'] = 'Inbox Email';
        $this->__site_template('professor/email_inbox_view', $this->data);
    }

    /**
     * Exam schedule ajax filter
     * @param string $degree
     * @param string $course
     * @param string $batch
     * @param string $semester
     * @param string $exam
     */
    function get_exam_schedule_filter($degree, $course, $batch, $semester, $exam) {
        $this->load->model('admin/Crud_model');
        $data['time_table'] = $this->Crud_model->exam_schedule_filter($degree, $course, $batch, $semester, $exam);
        $this->load->view("professor/exam_schedule_filter", $data);
    }

    /**
     * Vocation courses
     * @param type $param1
     * @param type $param2
     */
    function vocationalcourse($param1 = '', $param2 = '') {
        $this->data['title'] = $this->lang_message('vocational_course');
        $professor_id = $this->session->userdata('login_user_id');
        $this->data['vocationalcourse'] = $this->Professor_model->get_vocational_course($professor_id);
        $this->data['page'] = 'vocational_course';
        $this->__site_template('professor/vocational_course', $this->data);
    }

}
