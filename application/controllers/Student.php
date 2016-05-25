<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends MY_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        $this->load->model('Student/Student_model');
    }

    function index() {
        
    }

    /**
     * Student dashborad action
     */
    function dashboard() {
        $student_detail = $this->db->get_where('student', array(
                    'std_id' => $this->session->userdata('login_user_id')
                ))->row();
        $this->data['title'] = 'Student Dashboard';
        $this->data['cms_pages'] = $this->db->get_where('cms_pages', array(
                    'am_course' => $student_detail->course_id,
                    'am_semester' => $student_detail->semester_id,
                    'am_batch' => $student_detail->std_batch
                ))->result();
        $this->data['studyresource'] = $this->db->get_where('study_resources')->result_array();
        $this->data['library'] = $this->db->get_where('library_manager')->result_array();
        $this->data['exam_listing'] = $this->student_exam_listing_widget();
        $this->data['cms_pages'] = $this->student_cms_page_list_widget();
        $streaming = $this->streaming_list_widget();
        $this->data['all'] = $streaming['all'];
        $this->data['live_streaming'] = $streaming['live_streaming'];

        $this->__site_template('student/dashboard', $this->data);
    }

    function streaming_list_widget() {
        $date = date('Y-m-d');
        $student_details = $this->db->get_where('student', array(
                    'std_id' => $this->session->userdata('student_id')
                ))->row();
        //var_dump($student_details);
        $where = array(
            'course' => $student_details->course_id,
            'semester' => $student_details->semester_id,
            'is_active' => '1'
        );
        $live_streaming = $this->db->select()
                        ->from('broadcast_and_streaming')
                        ->where($where)
                        ->like('created_at', $date)
                        ->get()->result();
        $all = $this->db->select()->from('broadcast_and_streaming')
                ->where('course', 'all')
                //->or_where('semester', 'all')
                ->where('is_active', '1')
                ->like('created_at', $date)
                ->get()
                ->result();
        $data['all'] = $all;
        $data['live_streaming'] = $live_streaming;


        return $data;
    }

    function student_cms_page_list_widget() {
        $student_detail = $this->db->get_where('student', array(
                    'std_id' => $this->session->userdata('login_user_id')
                ))->row();
        //echo $student_detail->std_batc
        $cms_pages = $this->db->get_where('cms_pages', array(
                    'am_course' => $student_detail->course_id,
                    'am_semester' => $student_detail->semester_id,
                    'am_batch' => $student_detail->std_batch
                ))->result();
        return $cms_pages;
    }

    function student_exam_listing_widget() {
        $student_details = $this->db->get_where('student', array(
                    'std_id' => $this->session->userdata('login_user_id')
                ))->row();
        $page_data['exam_listing'] = $this->db->select()
                ->from('exam_manager')
                ->join('exam_type', 'exam_type.exam_type_id = exam_manager.em_type')
                ->join('semester', 'semester.s_id = exam_manager.em_semester')
                ->where(array(
                    'exam_manager.course_id' => $student_details->course_id,
                    'exam_manager.em_semester' => $student_details->semester_id,
                    'exam_manager.exam_ref_name' => 'reguler'
                ))
                ->order_by('exam_manager.em_start_time', 'DESC')
                ->get()
                ->result();

        //check for time table
        $student_id = $this->session->userdata('student_id');
        foreach ($page_data['exam_listing'] as $exam) {
            $is_pass = TRUE;
            //find exam schedule
            $exam_schedule = $this->db->select()
                    ->from('exam_time_table')
                    ->join('subject_manager', 'subject_manager.sm_id = exam_time_table.subject_id')
                    ->where('exam_time_table.exam_id', $exam->em_id)
                    ->get()
                    ->result();

            //find marks
            $exam_marks = $this->db->select()
                    ->from('marks_manager')
                    ->join('subject_manager', 'subject_manager.sm_id = marks_manager.mm_subject_id')
                    ->where(array(
                        'mm_std_id' => $student_id,
                        'mm_exam_id' => $exam->em_id
                    ))
                    ->get()
                    ->result();

            //check for pass or fail
            foreach ($exam_marks as $mark) {
                if ($mark->mark_obtained < $exam->passing_mark) {
                    $is_pass = FALSE;
                    break;
                }
            }

            //find remedial exams if fail
            if (!$is_pass) {
                $remedial_exam = $this->db->select()
                        ->from('exam_manager')
                        ->join('exam_type', 'exam_type.exam_type_id = exam_manager.em_type')
                        ->join('semester', 'semester.s_id = exam_manager.em_semester')
                        ->where(array(
                            'exam_manager.exam_ref_id' => $exam->em_id
                        ))
                        ->order_by('exam_manager.em_start_time', 'DESC')
                        ->get()
                        ->result();

                foreach ($remedial_exam as $remedial) {
                    $is_remedial_exam_pass = FALSE;
                    array_push($page_data['exam_listing'], $remedial);
                    //check for exam schedule
                    $remedial_exam_schedule = $this->db->select()
                            ->from('exam_time_table')
                            ->join('subject_manager', 'subject_manager.sm_id = exam_time_table.subject_id')
                            ->where('exam_time_table.exam_id', $remedial->em_id)
                            ->get()
                            ->result();

                    foreach ($remedial_exam_schedule as $schedule) {
                        //check for marks
                        $marks = $this->db->select()
                                ->from('marks_manager')
                                ->join('subject_manager', 'subject_manager.sm_id = marks_manager.mm_subject_id')
                                ->where(array(
                                    'mm_std_id' => $student_id,
                                    'mm_exam_id' => $remedial->em_id
                                ))
                                ->get()
                                ->result();

                        //check for pass or fail
                        foreach ($marks as $m) {
                            if ($m->mark_obtained >= $remedial->passing_mark) {
                                $is_remedial_exam_pass = TRUE;
                            } else {
                                $is_remedial_exam_pass = FALSE;
                                break;
                            }
                        }
                        if (!$is_remedial_exam_pass)
                            break;
                    }
                    if ($is_remedial_exam_pass)
                        break;
                }
            }
        }

        return $page_data['exam_listing'];
    }

    /**
     * Volunteer
     * @param string $param
     */
    function volunteer($param = '') {
        if ($param == "create") {
            $p_id = $this->input->post('pp_id');
            $std_id = $this->input->post('std_id');
            $status = $this->input->post('p_status');
            $res = $this->db->get_where('participate_student', array('pp_id' => $p_id, 'student_id' => $std_id))->num_rows();
            if ($res > 0) {
                $this->session->set_flashdata('flash_message', 'Data already exists');
                redirect(base_url() . 'student/participate_attend/' . $p_id, 'refresh');
            }
            $data['pp_id'] = $this->input->post('pp_id');
            $data['student_id'] = $this->input->post('std_id');
            $data['p_status'] = $this->input->post('p_status');
            $data['comment'] = $this->input->post('comment');
            $this->db->insert("participate_student", $data);
            $this->session->set_flashdata('flash_message', 'Participation successfully');
            redirect(base_url() . 'student/dashboard', 'refresh');
        }
        clear_notification('participate_manager', $this->session->userdata('student_id'));
        unset($this->session->userdata('notifications')['participate_manager']);
        $this->data['page'] = 'participate_form';
        $this->data['title'] = 'Participate Form';
        $this->__site_template('student/participate_form', $this->data);
    }

    /**
     * Participate attend
     * @param string $param
     */
    function participate_attend($param = '') {
        if ($param == "create") {
            $p_id = $this->input->post('pp_id');
            $std_id = $this->input->post('std_id');
            $status = $this->input->post('p_status');
            $res = $this->db->get_where('participate_student', array('pp_id' => $p_id, 'student_id' => $std_id))->num_rows();
            if ($res > 0) {
                $this->session->set_flashdata('flash_message', 'Data already exists.');
                redirect(base_url() . 'student/participate_attend/' . $p_id, 'refresh');
            }
            $data['pp_id'] = $this->input->post('pp_id');
            $data['student_id'] = $this->input->post('std_id');
            $data['p_status'] = $this->input->post('p_status');
            $data['comment'] = $this->input->post('comment');
            $this->db->insert("participate_student", $data);
            $this->session->set_flashdata('flash_message', 'Data added successfullly.');
            redirect(base_url() . 'student/dashboard', 'refresh');
        }
        $this->data['page'] = 'participate_form';
        $this->data['title'] = 'Survey Application Form';
        $this->data['param'] = $param;
        $this->__site_template('student/participate_form', $this->data);
    }

    /**
     * Participate
     * @param string $param1
     * @param string $param2
     */
    function participate($param1 = '', $param2 = '') {
        if ($param1 == "create") {
            $survey = $this->db->get_where('survey_question', array('question_status' => '1'))->result();
            $count = 1;
            foreach ($survey as $res) {
                // echo $count;
                $question[] = $this->input->post('question_id' . $count);
                $field[] = $this->input->post('Field' . $count);
                $que = implode(",", $question);
                $status = implode(",", $field);
                $count++;
            }

            $data['sq_id'] = $que;
            $data['survey_status'] = $status;

            $data['student_id'] = $this->session->userdata('std_id');
            +
                    $this->db->insert('survey_list', $data);
            $this->session->set_flashdata('flash_message', 'Survey added successfully');
            redirect(base_url() . 'student/participate', 'refresh');
        }
        $std = $this->session->userdata('std_id');
        //$page_data['survey']= $this->db->get_where('survey',array('student_id'=>$std,'created_date'=>date('Y')))->result();
        $this->data['survey'] = $this->db->get_where('survey_question', array('question_status' => '1'))->result();
        $this->data['page'] = 'participate';
        $this->data['title'] = 'Survey Application Form';
        $this->data['param'] = $param1;
        $this->__site_template('student/participate', $this->data);
    }

    /**
     * Uploads
     */
    function uploads() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $config['upload_path'] = 'uploads/project_file';
            $config['allowed_types'] = '*';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            //$this->upload->set_allowed_types('*');
            if (!$this->upload->do_upload('fileupload')) {
                $this->session->set_flashdata('flash_message', 'Please upload valid file.');
                redirect(base_url() . 'student/uploads/', 'refresh');
            } else {
                $file = $this->upload->data();
                $data['upload_file_name'] = $file['file_name'];
                $file_url = base_url() . 'uploads/project_file/' . $data['upload_file_name'];
                $data['upload_url'] = $file_url;
            }
            $data['std_id'] = $this->session->userdata('std_id');
            $this->db->insert("student_upload", $data);
            $this->session->set_flashdata('flash_message', 'File is successfully uploaded.');
            redirect(base_url() . 'student/uploads/', 'refresh');
        }
        $this->data['page'] = 'upload_data';
        $this->data['title'] = 'Upload';
        $this->__site_template('student/upload_data', $this->data);
    }

    /**
     * Email inbox
     */
    function email_inbox() {
        $this->load->model('admin/Crud_model');
        $this->load->helper('system_email');
        $this->data['inbox'] = student_inbox();
        $this->data['title'] = 'Inbox';
        $this->data['page'] = 'email_inbox';
        $this->__site_template('student/email_inbox', $this->data);
    }

    /**
     * Inbox email
     * @param type $id
     */
    function inbox_email($id) {
        $this->load->model('admin/Crud_model');
        $this->load->helper('system_email');
        //$data['email'] = $this->Crud_model->view_mail($id);
        $this->data['email'] = student_email_view($id);
        $this->data['title'] = $this->data['email']->subject;
        $this->data['page'] = 'email_inbox_view';
        $this->__site_template('student/email_inbox_view', $this->data);
    }

    /**
     * Email reply
     * @param string $id
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
                $filename = rtrim($filename, ',');
            }
            $_POST['file_name'] = $filename;
            reply_from_student($_POST);
            redirect(base_url('student/email_inbox'));
        }
        //$data['email'] = $this->Crud_model->view_mail($id);
        $this->data['email'] = student_email_view($id);
        $this->data['title'] = 'Email Reply';
        $this->data['page'] = 'backend/student/email_reply';
        $this->__site_template('student/email_reply', $this->data);
    }

    /**
     * Email compose
     * 
     * @return response
     */
    function email_compose() {
        //load the Crud model
        ini_set('max_execution_time', 500);
        $this->load->model('admin/Crud_model');
        $this->load->model('Student/Student_model');
        $this->load->helper('system_email');
        if ($_POST) {
            if ($_POST) {
                $filename = '';
                $attachments = array();
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
                        array_push($attachments, $uploaded['full_path']);
                    }
                }
                $filename = rtrim($filename, ',');
                $_POST['file_name'] = $filename;
                student_email_send_to_admin($_POST);
                $teacher_list = array();
                //send mails to others
                if (count($_POST['teacheremail'])) {
                    $teacher_list = $_POST['teacheremail'];
                }
                //cc
                $cc_list = explode(',', $_POST['cc']);
                $email_cc_list = array();
                foreach ($cc_list as $row) {
                    array_push($email_cc_list, $row);
                }
                $this->setemail($teacher_list, $_POST['subject'], $_POST['message'], $email_cc_list, $attachments);
                redirect(base_url('student/email_inbox'));
            }
        }
        //get all student information
        $this->data['students'] = $this->Crud_model->get_all_students();
        $this->data['teacher'] = $this->Crud_model->get_all_teacher();
        $this->data['all_admin'] = $this->Crud_model->get_all_admin();
        //set the template and view
        $this->data['title'] = 'Compose Email';
        $this->data['page'] = 'email_compose';
        $this->__site_template('student/email_compose', $this->data);
    }

    /**
     * View sent email of the admin
     */
    function email_sent() {
        $this->load->model('admin/Crud_model');
        $this->data['sent_mail'] = $this->Crud_model->my_sent_mail($this->session->userdata('email')); //admin
        $this->data['title'] = 'Sent Email';
        $this->data['page'] = 'email_sent';
        $this->__site_template('student/email_sent', $this->data);
    }

    /**
     * View particular email details
     * @param int $id
     */
    function email_view($id) {
        $this->load->model('admin/Crud_model');
        $this->data['email'] = $this->Crud_model->view_mail($id);
        if ($data['email']->email_to == $this->session->userdata('email')) {
            //update read status
            $update = array(
                'read' => 1
            );
            $this->Crud_model->update_email_read_status($id, $update);
        }
        $this->data['title'] = $this->data['email']->subject;
        $this->data['page'] = 'email_view';
        $this->__site_template('student/email_view', $this->data);
    }

    /**
     * Project
     * @param string $param1
     * @param string $param2
     */
    function project($param1 = '', $param2 = '') {
        if ($param1 == 'create') {
            if ($_FILES['projectfile']['name'] != "") {
                $config['upload_path'] = 'uploads/project_file';
                $config['allowed_types'] = '*';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                //$this->upload->set_allowed_types('*');	
                if (!$this->upload->do_upload('projectfile')) {
                    $data = array('msg' => $this->upload->display_errors());
                } else {
                    $file = $this->upload->data();
                    $data['pm_filename'] = $file['file_name'];
                }
            }
            $data['pm_degree'] = $this->input->post('degree');
            $data['pm_title'] = $this->input->post('title');
            $data['pm_batch'] = $this->input->post('batch');
            $data['pm_url'] = $this->input->post('pageurl');
            $data['pm_semester'] = $this->input->post('semester');
            $data['pm_desc'] = $this->input->post('description');
            $data['pm_dos'] = $this->input->post('dateofsubmission');
            $data['pm_status'] = 1;
            $data['pm_student_id'] = $this->input->post('student');
            $data['created_date'] = date('Y-m-d');
            $this->db->insert('project_manager', $data);
            $this->session->set_flashdata('flash_message', 'Project added successfully');
            redirect(base_url() . 'student/project/submission', 'refresh');
        }
        if ($param1 == "submit_project") {
            if ($_FILES['document_file']['name'] != "") {
                $config['upload_path'] = 'uploads/project_file';
                $config['allowed_types'] = '*';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('document_file')) {
                    //$datafile = array('msg' => $this->upload->display_errors());
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('flash_message', $error);
                    redirect(base_url() . 'student/project/submission', 'refresh');
                } else {
                    $file = $this->upload->data();
                    $data['document_file'] = $file['file_name'];
                }
            }
            $data['description'] = $this->input->post('comment');
            $data['project_id'] = $this->input->post('project_id');
            $data['student_id'] = $this->session->userdata('std_id');
            $data['dos'] = date('Y-m-d');
            $this->db->insert('project_document_submission', $data);
            $this->session->set_flashdata('flash_message', 'Project added successfully');
            redirect(base_url() . 'student/project/submission', 'refresh');
        }
        if ($param1 == "submission") {
            $std_id = $this->session->userdata('std_id');
            $std = $this->db->get_where('student', array('std_id' => $std_id))->result_array();
            // $this->db->get_where('project_manager',array('	pm_degree'=>$std[0]['std_degree'],
            //'pm_batch'=>$std[0]['std_batch'],'pm_semester'=>$std[0]['semester_id'],'pm_course'=>$std[0]['course_id']))->result();
            $degree = $std[0]['std_degree'];
            $batch = $std[0]['std_batch'];
            $sem = $std[0]['semester_id'];
            $course = $std[0]['course_id'];
            $class = $std[0]['class_id'];
            $this->data['project'] = $this->db->query("SELECT * FROM project_manager WHERE pm_degree='$degree' AND pm_batch = '$batch' AND pm_semester = '$sem' AND pm_course = '$course' AND class_id='$class' AND FIND_IN_SET('$std_id',pm_student_id)")->result();
            // $page_data['project'] = $this->db->get_where('project_manager', array("pm_student_id" => $this->session->userdata('std_id')))->result();
            $this->data['degree'] = $this->db->get('degree')->result();
            $this->data['batch'] = $this->db->get('batch')->result();
            $this->data['course'] = $this->db->get('course')->result();
            $this->data['semester'] = $this->db->get('semester')->result();
            $this->data['class'] = $this->db->get('class')->result();
            $this->data['student'] = $this->db->get('student')->result();
            $this->data['page'] = 'project';
            $this->data['title'] = 'Project List';
            $this->data['param'] = $param1;
            clear_notification('project_manager', $this->session->userdata('student_id'));
            unset($this->session->userdata('notifications')['project_manager']);
            $this->__site_template('student/project', $this->data);
        }
        if ($param1 == "video") {
            $this->data['project'] = $this->db->get('project_manager')->result();
            $this->data['page'] = 'project';
            $this->data['title'] = 'Project List';
            $this->data['param'] = $param1;
            $this->__site_template('student/project', $this->data);
        }
    }

    /**
     * Student profile
     */
    function profile() {
        $this->load->model('Student/Student_model');
        $this->load->model('admin/Crud_model');
        $page_data['error'] = '';
        if ($_POST) {
            //update password
            $old_password = $_POST['password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            if ($old_password != '' && $new_password != '' && $confirm_password != '') {
                $student = $this->Student_model->student_details($this->session->userdata('student_id'));
                if ($old_password == $student->real_pass) {
                    if ($new_password == $confirm_password) {
                        //update password
                        $id = $student->std_id;
                        $data = array(
                            'password' => hash('md5', $new_password),
                            'real_pass' => $new_password
                        );
                        $this->Student_model->update_password($data, $id);
                        $this->session->set_flashdata('message', 'Password is successfully changed.');
                        redirect(base_url('student/profile'));
                    } else {
                        $this->data['error'] = 'Password is mismatched.';
                    }
                } else {
                    $this->data['error'] = 'Invalid old password';
                }
            }

            //change profile pic
            if ($_FILES['userfile']['name'] != '') {
                $path = FCPATH . 'uploads/student_image/';
                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $path . $this->session->userdata('student_id') . '.jpg')) {
                    echo 'uploaded';
                }
                $this->db->where('std_id', $this->session->userdata('student_id'));
                $this->db->update('student', array(
                    'profile_photo' => $this->session->userdata('student_id') . '.jpg '
                ));
                $this->session->set_flashdata('message', 'Profile pic is changed');
                redirect(base_url('student/profile'));
            }
        }
        $this->data['title'] = 'Student Profile';
        $this->data['page'] = 'student_profile';
        $this->data['profile'] = $this->Student_model->student_details($this->session->userdata('login_user_id'));
        $this->data['profile_pic'] = $this->Crud_model->get_image_url('student', $this->session->userdata('std_id'));
        $this->__site_template('student/student_profile', $this->data);
    }

    /**
     * Assignment
     * @param string $param1
     * @param string $param2
     */
    function assignment($param1 = '', $param2 = '') {
        if ($param1 == 'submit_assignment') {
            if ($_FILES['document_file']['name'] != "") {
                $config['upload_path'] = 'uploads/project_file';
                $config['allowed_types'] = '*';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                //$this->upload->set_allowed_types('*');	
                if (!$this->upload->do_upload('document_file')) {
                    $datafile = array('msg' => $this->upload->display_errors());
                } else {
                    $file = $this->upload->data();
                    $data['document_file'] = $file['file_name'];
                }
            }
            $data['comment'] = $this->input->post('comment');
            $data['assign_id'] = $this->input->post('assignment_id');
            $data['student_id'] = $this->session->userdata('std_id');
            $data['submited_date'] = date('Y-m-d');
            $this->db->insert('assignment_submission', $data);
            $this->session->set_flashdata('flash_message', 'Assignment is added successfully.');
            redirect(base_url() . 'student/assignment/submited_assignment', 'refresh');
        }
        $std_id = $this->session->userdata('std_id');
        $std = $this->db->get_where('student', array('std_id' => $std_id))->result_array();
        $this->data['assignment'] = $this->db->get_where('assignment_manager', array('	assign_degree' => $std[0]['std_degree'],
                    'assign_batch' => $std[0]['std_batch'], 'assign_sem' => $std[0]['semester_id'], 'course_id' => $std[0]['course_id'], 'class_id' => $std[0]['class_id']))->result();

        $this->data['course'] = $this->db->get('course')->result();
        $this->data['degree'] = $this->db->get('degree')->result();
        $this->data['semester'] = $this->db->get('semester')->result();
        $this->data['batch'] = $this->db->get('batch')->result();
        $this->data['page'] = 'assignment';
        $this->data['param'] = $param1;
        $this->data['title'] = 'Assignment List';
        clear_notification('assignment_manager', $this->session->userdata('student_id'));
        unset($this->session->userdata('notifications')['assignment_manager']);
        $this->__site_template('student/assignment', $this->data);
    }

    /**
     * Student fees records
     */
    function fee_record() {
        $this->data['student_detail'] = $this->db->get_where('student', array(
                    'std_id' => $this->session->userdata('login_user_id')
                ))->row();
        $this->data['fees_structure'] = '';
        $this->data['semester'] = $this->Student_model->get_all_semester();
        $this->data['fees_record'] = $this->Student_model->fees_record($this->session->userdata('login_user_id'));
        $this->data['page'] = 'fees_record';
        $this->data['title'] = 'Student Fees Record';
        $this->__site_template('student/fees_record', $this->data);
    }

    /**
     * Invoice details
     * @param string $id
     */
    function invoice($id = '') {
        $this->data['page'] = 'invoice';
        $this->data['title'] = 'Student invoice';
        $this->data['invoice'] = $this->Student_model->invoice_detail($id);
        $paid_fees = $this->Student_model->student_paid_fees($this->data['invoice']->fees_structure_id, $this->data['invoice']->std_id);
        $total_paid = 0;
        if (count($paid_fees)) {
            foreach ($paid_fees as $paid) {
                $total_paid += $paid->paid_amount;
            }
        }
        $this->data['due_amount'] = $this->data['invoice']->total_fee - $total_paid;
        $this->data['total_paid'] = $total_paid;
        $this->__site_template('student/invoice', $this->data);
    }

    /**
     * Invoice print
     * @param string $id
     */
    function invoice_print($id) {
        $this->data['invoice'] = $this->Student_model->invoice_detail($id);
        $paid_fees = $this->Student_model->student_paid_fees($this->data['invoice']->fees_structure_id, $this->data['invoice']->std_id);
        $total_paid = 0;
        if (count($paid_fees)) {
            foreach ($paid_fees as $paid) {
                $total_paid += $paid->paid_amount;
            }
        }
        $this->data['due_amount'] = $this->data['invoice']->total_fee - $total_paid;
        $this->data['total_paid'] = $total_paid;
        $html = utf8_encode($this->load->view('student/invoice_print', $this->data, true));
        //this the the PDF filename that user will get to download
        $pdfFilePath = "invoice copy.pdf";
        //load mPDF library
        $this->load->library('m_pdf');
        //load the view and saved it into $html variable
        //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }
    
    /**
     * get volunteer description
     */
    
    function get_desc() {
        $pp_id = $this->input->post('pp_id');
        if ($pp_id != "") {
            $res = $this->db->get_where('participate_manager', array('pp_id' => $pp_id))->result_array();
            echo '<label class="col-sm-3 control-label">Description : </label>'
            . '<div class="col-sm-5" >' . $res[0]['pp_desc'] . '</div>';
        }
    }
    
    /**
     * assessment
     */
    public function assessment()
    {
              
            $this->load->model('Student/Student_model');
        $this->data['assessments'] = $this->Student_model->student_assessment();
        
        $this->data['page'] = 'assessment';
        $this->data['title'] = 'Assessment';
        $this->__site_template('student/assessment', $this->data);
    }

}
