<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    /**
     * Constructor
     * 
     * @return void
     */
    function __construct() {
        parent::__construct();

        //check for admin user loggedin or not
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        //load the common crud model
        $this->load->model('admin/Crud_model');
    }

    /**
     * Index action
     */
    function index() {
        $this->data['title'] = 'Admin Dashboard';
        $this->__site_template('admin/dashboard', $this->data);
    }

    /**
     * Dashboard index
     */
    function dashboard() {
        $this->index();
    }

    /*
     * Basic Management
     * All the inventory management including department, branch, batch, etc.
     */

    /**
     * Degree management
     * @param string $param1
     * @param string $param2
     */
    function degree($param1 = '', $param2 = '') {
        if ($_POST) {
            if ($param1 == 'create') {
                $data['d_name'] = $this->input->post('d_name');
                $data['d_status'] = $this->status($this->input->post('degree_status'));
                $data['created_date'] = date('Y-m-d');

                $this->db->insert('degree', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('save_department'));
                redirect(base_url('admin/department'));
            }
            if ($param1 == 'do_update') {
                $data['d_name'] = $this->input->post('d_name');
                $data['d_status'] = $this->status($this->input->post('degree_status'));
                $this->db->where('d_id', $param2);
                $this->db->update('degree', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('update_department'));
                redirect(base_url('admin/department'));
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('d_id', $param2);
            $this->db->delete('degree');
            $this->session->set_flashdata('flash_message', $this->lang_message('delete_department'));
            redirect(base_url('admin/department'));
        }
        $this->data['title'] = $this->lang_message('department_title');
        $this->data['page'] = 'department';
        $this->data['degrees'] = $this->db->get('degree')->result_array();
        $this->__site_template('admin/degree', $this->data);
    }

    /**
     * Branch management
     * @param string $param1
     * @param string $param2
     */
    function courses($param1 = '', $param2 = '') {
        if ($_POST) {
            if ($param1 == 'create') {
                $semimplode = implode(',', $this->input->post('semester'));
                $data['c_name'] = $this->input->post('c_name');
                $data['course_alias_id'] = $this->input->post('course_alias_id');
                $data['c_description'] = $this->input->post('c_description');
                $data['course_status'] = $this->status($this->input->post('course_status'));
                $data['degree_id'] = $this->input->post('degree');
                $data['semester_id'] = $semimplode;
                $this->db->insert('course', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('save_branch'));
                redirect(base_url() . 'admin/courses/', 'refresh');
            }
            if ($param1 == 'do_update') {
                $semimplode = implode(',', $this->input->post('semester'));
                $data['c_name'] = $this->input->post('c_name');
                $data['course_alias_id'] = $this->input->post('course_alias_id');
                $data['c_description'] = $this->input->post('c_description');
                $data['course_status'] = $this->status($this->input->post('course_status'));
                $data['degree_id'] = $this->input->post('degree');
                $data['semester_id'] = $semimplode;
                $this->db->where('course_id', $param2);
                $this->db->update('course', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('update_branch'));
                redirect(base_url() . 'admin/courses/', 'refresh');
            } else if ($param1 == 'edit') {
                $page_data['edit_data'] = $this->db->get_where('course', array(
                            'course_id' => $param2
                        ))->result_array();
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('course_id', $param2);
            $this->db->delete('course');
            $this->session->set_flashdata('flash_message', $this->lang_message('delete_branch'));
            redirect(base_url() . 'admin/courses/', 'refresh');
        }
        $this->data['degree'] = $this->db->get('degree')->result_array();
        $this->data['courses'] = $this->db->get('course')->result_array();
        $this->data['semesters'] = $this->db->get('semester')->result_array();
        $this->data['title'] = $this->lang_message('branch_title');
        $this->data['page'] = 'branch';
        $this->__site_template('admin/course', $this->data);
    }

    /**
     * Batch management
     * @param string $param1
     * @param string $param2
     */
    function batch($param1 = '', $param2 = '') {
        if ($_POST) {
            if ($param1 == 'create') {
                $data['b_name'] = $this->input->post('b_name');
                $data['degree_id'] = implode(',', $this->input->post('degree'));
                $data['course_id'] = implode(',', $this->input->post('course'));
                $data['b_status'] = $this->status($this->input->post('batch_status'));
                $data['created_date'] = date('Y-m-d');
                $this->db->insert('batch', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('save_batch'));
                redirect(base_url() . 'admin/batch/', 'refresh');
            }
            if ($param1 == 'do_update') {
                $data['b_name'] = $this->input->post('b_name');
                $data['degree_id'] = implode(',', $this->input->post('degree1'));
                $data['course_id'] = implode(',', $this->input->post('course1'));
                $data['b_status'] = $this->status($this->input->post('batch_status'));
                $this->db->where('b_id', $param2);
                $this->db->update('batch', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('update_batch'));
                redirect(base_url() . 'admin/batch/', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('b_id', $param2);
            $this->db->delete('batch');
            $this->session->set_flashdata('flash_message', $this->lang_message('delete_batch'));
            redirect(base_url() . 'admin/batch/', 'refresh');
        }
        $this->data['title'] = $this->lang_message('batch_title');
        $this->data['batches'] = $this->db->get('batch')->result_array();
        $this->data['degree'] = $this->db->get('degree')->result_array();
        $this->data['course'] = $this->db->get('course')->result();
        $this->data['page'] = 'batch';
        $this->__site_template('admin/batch', $this->data);
    }

    /**
     * Semester managemnet
     * @param string $param1
     * @param string $param2
     */
    function semester($param1 = '', $param2 = '') {
        if ($_POST) {
            if ($param1 == 'create') {
                $data['s_name'] = $this->input->post('s_name');
                $data['s_status'] = $this->status($this->input->post('semester_status'));
                $data['created_date'] = date('Y-m-d');

                $this->db->insert('semester', $data);
                $this->session->set_flashdata('flash_message', get_phrase('semester_added_successfully'));
                redirect(base_url() . 'admin/semester/', 'refresh');
            }
            if ($param1 == 'do_update') {
                $data['s_name'] = $this->input->post('s_name');
                $data['s_status'] = $this->status($this->input->post('semester_status'));

                $this->db->where('s_id', $param2);
                $this->db->update('semester', $data);
                $this->session->set_flashdata('flash_message', get_phrase('semester_updated_successflly'));
                redirect(base_url() . 'admin/semester/', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('s_id', $param2);
            $this->db->delete('semester');
            $this->session->set_flashdata('flash_message', get_phrase('semester_deleted_successfully'));
            redirect(base_url() . 'admin/semester/', 'refresh');
        }
        $this->data['semesters'] = $this->db->get('semester')->result_array();
        $this->data['page'] = 'semester';
        $this->data['title'] = $this->lang_message('semester_title');
        $this->__site_template('admin/semesterlist', $this->data);
    }

    /**
     * Class/division management
     * @param string $param1
     * @param string $param2
     */
    function division($param1 = '', $param2 = '') {
        if ($_POST) {
            if ($param1 == 'create') {
                $data['class_name'] = $this->input->post('class_name');
                $data['created_date'] = date('Y-m-d');
                $this->db->insert('class', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('save_class'));
                redirect(base_url() . 'admin/division/', 'refresh');
            }

            if ($param1 == 'do_update') {
                $data['class_name'] = $this->input->post('class_name');
                $data['updated_date'] = date('Y-m-d');

                $this->db->where('class_id', $param2);
                $this->db->update('class', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('update_class'));

                redirect(base_url() . 'admin/division/', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('class_id', $param2);
            $this->db->delete('class');
            $this->session->set_flashdata('flash_message', $this->lang_message('delete_class'));

            redirect(base_url() . 'admin/division/', 'refresh');
        }
        $this->data['title'] = $this->lang_message('class_title');
        $this->data['class'] = $this->db->get('class')->result_array();
        $this->data['page'] = 'class';
        $this->__site_template('admin/class', $this->data);
    }

    /**
     * Admission type management
     * @param string $param1
     * @param string $param2
     */
    function admission_type($param1 = '', $param2 = '') {
        if ($_POST) {
            if ($param1 == 'create') {
                $data['at_name'] = $this->input->post('at_name');
                $data['at_status'] = $this->status($this->input->post('at_status'));
                $data['created_date'] = date('Y-m-d');

                $this->db->insert('admission_type', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('save_admission_type'));
                redirect(base_url() . 'admin/admission_type/', 'refresh');
            }
            if ($param1 == 'do_update') {

                $data['at_name'] = $this->input->post('at_name');
                $data['at_status'] = $this->status($this->input->post('at_status'));
                $this->db->where('at_id', $param2);
                $this->db->update('admission_type', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('update_admission_type'));
                redirect(base_url() . 'admin/admission_type/', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('at_id', $param2);
            $this->db->delete('admission_type');
            $this->session->set_flashdata('flash_message', $this->lang_message('delete_admission_type'));
            redirect(base_url() . 'admin/admission_type/', 'refresh');
        }
        $this->data['title'] = $this->lang_message('admission_type_title');
        $this->data['admission_type'] = $this->db->get('admission_type')->result_array();
        $page_data['page'] = 'admission_type';
        $this->__site_template('admin/admission_type', $this->data);
    }

    /**
     * Student management
     * @param string $param1
     * @param string $param2
     */
    function student($param1 = '', $param2 = '') {
        if ($_POST) {
            if ($param1 == 'create') {
                if ($_FILES['profilefile']['name'] != '') {

                    $config['upload_path'] = 'uploads/student_image';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('profilefile')) {
                        $this->session->set_flashdata('flash_message', "Invalid File!");
                        redirect(base_url() . 'admin/student/', 'refresh');
                    } else {
                        $file = $this->upload->data();
                        $data['profile_photo'] = $file['file_name'];
                        //$file_url = base_url().'uploads/project_file/'.$data['lm_filename'];
                    }
                } else {

                    $data['profile_photo'] = '';
                }
                $data['email'] = $this->input->post('email_id');
                $data['password'] = md5($this->input->post('password'));
                $data['std_first_name'] = $this->input->post('f_name');
                $data['std_last_name'] = $this->input->post('l_name');
                $data['std_gender'] = $this->input->post('gen');
                $data['std_birthdate'] = $this->input->post('birthdate');
                $data['std_marital'] = $this->input->post('maritalstatus');
                $data['std_batch'] = $this->input->post('batch');
                $data['semester_id'] = $this->input->post('semester');
                $data['course_id'] = $this->input->post('course');
                $data['std_about'] = $this->input->post('std_about');
                $data['std_mobile'] = $this->input->post('mobileno');
                $data['parent_name'] = $this->input->post('parentname');
                $data['parent_contact'] = $this->input->post('parentcontact');
                $data['parent_email'] = $this->input->post('parent_email_id');
                $data['real_pass'] = $this->input->post('password');
                $data['address'] = $this->input->post('address');
                $data['city'] = $this->input->post('city');
                $data['zip'] = $this->input->post('zip');
                $data['std_fb'] = $this->input->post('facebook');
                $data['std_twitter'] = $this->input->post('twitter');
                $data['group_id'] = $this->input->post('group');
                $data['user_type'] = $this->input->post('usertype');
                $data['admission_type_id'] = $this->input->post('admissiontype');
                $data['std_status'] = 1;
                $data['std_degree'] = $this->input->post('degree');
                $data['class_id'] = $this->input->post('class');
                $data['created_date'] = date('Y-m-d');
                $data['password_status'] = 0;
                $data['user_type'] = 1;
                //roll no
                $this->db->insert('student', $data);
                $lastid = $this->db->insert_id();
                $rollno = date('Y');
                $rollno.=$this->db->get_where('course', array('course_id' => $this->input->post('course')))->row()->course_alias_id;
                $rollno.='-' . $lastid;
                $updaterollno['std_roll'] = $rollno;
                $this->db->where('std_id', $lastid);
                $this->db->update('student', $updaterollno);
                //end roll no
                //email

                $data['rollno'] = $rollno;
                $msg = $this->load->view("backend/admin/emailmessage", $data, true);
                $this->email->from('mayur.ghadiya@searchnative.in', 'Search Native India');
                $this->email->to($data['email']);
                //  $this->email->cc('mayur.ghadiya@searchnative.in');
                $this->email->subject('Login credential');
                $this->email->message($msg);

                if ($this->email->send()) {
                    $this->session->set_flashdata('flash_message', $this->lang_message('save_student'));

                    redirect(base_url() . 'admin/student/', 'refresh');
                } else {
                    show_error($this->email->print_debugger());
                }
                //end email
            }
            if ($param1 == 'do_update') {
                if ($_FILES['profilefile']['name'] != "") {

                    $ext_img = explode(".", $_FILES['profilefile']['name']);
                    $ext = strtolower(end($ext_img));

                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $ext_arr = explode("|", $config['allowed_types']);

                    if (in_array($ext, $ext_arr)) {
                        if (file_exists("uploads/student_image/" . $this->input->post('txtoldfile'))) {
                            unlink("uploads/student_image/" . $this->input->post('txtoldfile'));
                        }
                        $config['file_name'] = date('dmYhis') . '.' . $ext;
                        $config['upload_path'] = 'uploads/student_image';
                        //$config['allowed_types'] = 'gif|jpg|png';
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        $this->upload->do_upload('profilefile');


                        $file = $this->upload->data();
                        $data['profile_photo'] = $file['file_name'];
                    } else {
                        $this->session->set_flashdata("flash_message", 'Update failed. Invalid Image!');
                        redirect(base_url() . 'admin/student/', 'refresh');
                    }
                }
                $data['email'] = $this->input->post('email_id');
                $data['password'] = md5($this->input->post('password'));
                $data['real_pass'] = $this->input->post('password');
                $data['std_first_name'] = $this->input->post('f_name');
                $data['std_last_name'] = $this->input->post('l_name');
                $data['std_gender'] = $this->input->post('gen');
                $data['std_birthdate'] = $this->input->post('birthdate1');
                $data['std_marital'] = $this->input->post('maritalstatus');
                $data['std_batch'] = $this->input->post('batch');
                $data['semester_id'] = $this->input->post('semester');
                $data['course_id'] = $this->input->post('course');
                $data['std_about'] = $this->input->post('std_about');
                $data['std_mobile'] = $this->input->post('mobileno');
                $data['parent_name'] = $this->input->post('parentname');
                $data['parent_contact'] = $this->input->post('parentcontact');
                $data['parent_email'] = $this->input->post('parent_email_id');
                $data['address'] = $this->input->post('address');
                $data['city'] = $this->input->post('city');
                $data['zip'] = $this->input->post('zip');
                $data['std_fb'] = $this->input->post('facebook');
                $data['std_twitter'] = $this->input->post('twitter');
                $data['group_id'] = $this->input->post('group');
                $data['user_type'] = $this->input->post('usertype');
                $data['admission_type_id'] = $this->input->post('admissiontype');
                $data['std_degree'] = $this->input->post('degree');

                $this->db->where('std_id', $param2);
                $this->db->update('student', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('update_student'));
                redirect(base_url() . 'admin/student/', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('std_id', $param2);
            $this->db->delete('student');
            $this->session->set_flashdata('flash_message', $this->lang_message('delete_student'));
            redirect(base_url() . 'admin/student/', 'refresh');
        }
        $this->data['title'] = $this->lang_message('student_title');
        $this->data['student'] = $this->db->get('student')->result();
        $this->data['page'] = 'student';
        $this->__site_template('admin/student', $this->data);
    }

    /**
     * Syllabus Management
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
                        redirect(base_url() . 'admin/syllabus/', 'refresh');
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

                $this->crud_model->add_syllabus($insert);
                $this->session->set_flashdata('flash_message', $this->lang_message('save_syllabus'));
                redirect(base_url() . 'admin/syllabus/', 'refresh');
            }
            if ($param == 'do_update') {
                $syllabus = $this->crud_model->getsyllabus($param2);

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
                        redirect(base_url() . 'admin/syllabus/', 'refresh');
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

                $this->crud_model->update_syllabus($insert, $param2);
                $this->session->set_flashdata('flash_message', $this->lang_message('update_syllabus'));
                redirect(base_url() . 'admin/syllabus/', 'refresh');
            }
        }
        if ($param == 'delete') {
            $this->crud_model->delete_syllabus($param2);
            $this->session->set_flashdata('flash_message', $this->lang_message('delete_syllabus'));
            redirect(base_url() . 'admin/syllabus/', 'refresh');
        }
        $this->data['syllabus'] = $this->Crud_model->get_syllabus();
        $this->data['course'] = $this->db->get('course')->result();
        $this->data['semester'] = $this->db->get('semester')->result();
        $this->data['degree'] = $this->db->get('degree')->result();
        $this->data['title'] = $this->lang_message('syllabus_title');
        $page_data['title'] = 'Syllabus Management';
        $page_data['page_name'] = 'syllabus';
        $this->__site_template('admin/syllabus', $this->data);
    }

    /**
     * Holiday Management
     * @param string $param1
     * @param string $param2
     */
    function holiday($param1 = '', $param2 = '') {
        if ($_POST) {
            if ($param1 == 'create') {
                $data['holiday_name'] = $this->input->post('holiday_name');
                $data['holiday_startdate'] = date('Y-m-d', strtotime($this->input->post('holiday_startdate')));
                $data['holiday_enddate'] = date('Y-m-d', strtotime($this->input->post('holiday_enddate')));
                $year = explode('-', $data['holiday_startdate']);
                $data['holiday_year'] = $year[0];
                $data['holiday_status'] = $this->status($this->input->post('holiday_status'));
                $data['created_date'] = date('Y-m-d');

                $this->db->insert('holiday', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('save_holiday'));
                redirect(base_url() . 'admin/holiday/', 'refresh');
            }
            if ($param1 == 'do_update') {
                $data['holiday_name'] = $this->input->post('holiday_name');
                $data['holiday_startdate'] = date('Y-m-d', strtotime($this->input->post('holiday_startdate1')));
                $data['holiday_enddate'] = date('Y-m-d', strtotime($this->input->post('holiday_enddate1')));
                $year = explode('-', $data['holiday_startdate']);
                $data['holiday_year'] = $year[0];
                $data['holiday_status'] = $this->status($this->input->post('batch_status'));
                $this->db->where('holiday_id', $param2);
                $this->db->update('holiday', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('update_holiday'));
                redirect(base_url() . 'admin/holiday/', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('holiday_id', $param2);
            $this->db->delete('holiday');
            $this->session->set_flashdata('flash_message', $this->lang_message('delete_holiday'));

            redirect(base_url() . 'admin/holiday/', 'refresh');
        }
        $this->data['title'] = $this->lang_message('holiday_title');
        $this->data['holiday'] = $this->db->get('holiday')->result_array();
        $this->data['page'] = 'holiday';
        $this->__site_template('admin/holiday', $this->data);
    }

    /**
     * Chancellor
     * @param string $param1
     * @param string $param2
     */
    function chancellor($param1 = '', $param2 = '') {
        if ($_POST) {
            if ($param1 == 'create') {
                $data['people_name'] = $this->input->post('name');
                $data['people_phone'] = $this->input->post('mobileno');
                $data['people_email'] = $this->input->post('email_id');
                $data['people_designation'] = $this->input->post('designation');
                $data['people_description'] = $this->input->post('description');
                $data['facebook_link'] = $this->input->post('facebook');
                $data['twitter_link'] = $this->input->post('twitter');
                $data['google_plus_link'] = $this->input->post('googleplus');

                if ($_FILES['profilefile']['name'] != '') {

                    $config['upload_path'] = 'uploads/system_image';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('profilefile')) {
                        $this->session->set_flashdata('flash_message', "Invalid File!");
                        redirect(base_url() . 'admin/chancellor/', 'refresh');
                    } else {
                        $file = $this->upload->data();
                        $data['people_photo'] = $file['file_name'];
                    }
                } else {

                    $data['people_photo'] = '';
                }

                $this->db->insert('university_peoples', $data);
                $this->session->set_flashdata('flash_message', get_phrase('chancellor_added_successfully'));
                redirect(base_url() . 'admin/chancellor/', 'refresh');
            }
            if ($param1 == 'do_update') {
                $data['people_name'] = $this->input->post('name');
                $data['people_phone'] = $this->input->post('mobileno');
                $data['people_email'] = $this->input->post('email_id');
                $data['people_designation'] = $this->input->post('designation');
                $data['people_description'] = $this->input->post('description');
                $data['facebook_link'] = $this->input->post('facebook');
                $data['twitter_link'] = $this->input->post('twitter');
                $data['google_plus_link'] = $this->input->post('googleplus');

                if ($_FILES['profilefile']['name'] != '') {
                    unlink("uploads/system_image/" . $this->input->post('txtoldfile'));
                    $config['upload_path'] = 'uploads/system_image';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('profilefile')) {
                        $this->session->set_flashdata('flash_message', "Invalid File!");
                        redirect(base_url() . 'admin/chancellor/', 'refresh');
                    } else {
                        $file = $this->upload->data();
                        $data['people_photo'] = $file['file_name'];
                    }
                }
                $this->db->where('university_people_id', $param2);
                $this->db->update('university_peoples', $data);

                $this->session->set_flashdata('flash_message', get_phrase('chancellor_updated_successfully'));
                redirect(base_url() . 'admin/chancellor/', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('university_people_id', $param2);
            $this->db->delete('university_peoples');
            $this->session->set_flashdata('flash_message', get_phrase('chancellor_deleted_successfully'));
            redirect(base_url() . 'admin/chancellor/', 'refresh');
        }
        $this->data['title'] = 'Chancellor Management';
        $this->data['chancellor'] = $this->db->get('university_peoples')->result_array();
        $this->data['page'] = 'chancellor';
        $this->__site_template('admin/chancellor', $this->data);
    }

    /**
     * Vocation courses
     * @param type $param1
     * @param type $param2
     */
    function vocationalcourse($param1 = '', $param2 = '') {
        if ($_POST) {
            if ($param1 == 'create') {
                $data['course_name'] = $this->input->post('course_name');
                $data['course_startdate'] = date('Y-m-d', strtotime($this->input->post('startdate')));
                $data['course_enddate'] = date('Y-m-d', strtotime($this->input->post('enddate')));
                $data['course_fee'] = $this->input->post('fee');
                $data['professor_id'] = $this->input->post('professor');
                $data['status'] = $this->status($this->input->post('course_status'));
                $data['created_date'] = date('Y-m-d');

                $this->db->insert('vocational_course', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('save_vocational_course'));
                redirect(base_url() . 'admin/vocationalcourse/', 'refresh');
            }
            if ($param1 == 'do_update') {
                $data['course_name'] = $this->input->post('course_name');
                $data['course_startdate'] = date('Y-m-d', strtotime($this->input->post('startdate1')));
                $data['course_enddate'] = date('Y-m-d', strtotime($this->input->post('enddate1')));
                $data['course_fee'] = $this->input->post('fee');
                $data['professor_id'] = $this->input->post('professor');
                $data['status'] = $this->status($this->input->post('course_status'));
                $data['updated_date'] = date('Y-m-d');

                $this->db->where('vocational_course_id', $param2);
                $this->db->update('vocational_course', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('update_vocational_course'));
                redirect(base_url() . 'admin/vocationalcourse/', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('vocational_course_id', $param2);
            $this->db->delete('vocational_course');
            $this->session->set_flashdata('flash_message', $this->lang_message('delete_vocational_course'));

            redirect(base_url() . 'admin/vocationalcourse/', 'refresh');
        }
        $this->data['title'] = $this->lang_message('vocational_course');
        $this->data['vocationalcourse'] = $this->db->get('vocational_course')->result_array();
        $this->data['page'] = 'vocational_course';
        $this->__site_template('admin/vocational_course', $this->data);
    }

    /**
     * Assessment management
     * @param string $param
     * @param string $id
     */
    function assessments($param = '', $id = '') {
        if ($_POST) {
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
                $this->Crud_model->create_assessment($data);
                $this->session->set_flashdata('flash_message', $this->lang_message('save_assessment'));
                redirect(base_url('admin/assessments'));
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
                $this->Crud_model->update_assessment($data, $id);
                $this->session->set_flashdata('flash_message', $this->lang_message('update_assessment'));
                redirect(base_url('admin/assessments'));
            }
        }

        if ($param == 'delete') {
            $this->Crud_model->delete_assessment($id);
            $this->session->set_flashdata('flash_message', $this->lang_message('delete_assessment'));
            redirect(base_url('admin/assessments'));
        }

        $this->data['title'] = $this->lang_message('assessment_title');
        $this->data['page'] = 'assessments';
        $this->data['assessments'] = $this->Crud_model->assessment();
        $this->data['degree'] = $this->Crud_model->get_all_degree();
        $this->data['course'] = $this->Crud_model->get_all_course();
        $this->data['semester'] = $this->Crud_model->get_all_semester();
        $this->data['batch'] = $this->Crud_model->get_all_bacth();
        $this->__site_template('admin/assessments', $this->data);
    }

    /**
     * AJAX request response
     */

    /**
     * Get Course
     * @param string $param
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
     * Get batches
     * @param string $param
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
     * Get semester
     * @param string $param
     */
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
     * Get filter student
     */
    function get_filter_student() {
        $batch = $this->input->post("batch");
        $sem = $this->input->post("sem");
        $degree = $this->input->post("degree");
        $course = $this->input->post("course");
        $class = $this->input->post("divclass");
        $data['datastudent'] = $this->db->get_where("student", array("std_batch" => $batch, 'std_status' => 1, "semester_id" => $sem, 'course_id' => $course, 'std_degree' => $degree, 'class_id' => $class))->result();

        $this->session->set_flashdata('flash_message', count($data['datastudent']) . ' records found.');
        $this->load->view("admin/ajax_student", $data);
    }

}
