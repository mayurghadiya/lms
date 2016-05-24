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
        $this->load->model('forum_model');
        $this->load->model('photo_gallery');

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
            if ($param1 == 'create') 
            {
                $data['s_name'] = $this->input->post('s_name');
                $data['s_status'] = $this->status($this->input->post('semester_status'));
                $data['created_date'] = date('Y-m-d');
                $this->db->insert('semester', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('semseter_add'));
                redirect(base_url() . 'admin/semester/', 'refresh');
            }
            if ($param1 == 'do_update') 
            {
                $data['s_name'] = $this->input->post('s_name');
                $data['s_status'] = $this->status($this->input->post('semester_status'));

                $this->db->where('s_id', $param2);
                $this->db->update('semester', $data);
                $this->session->set_flashdata('flash_message', $this->lang_message('semseter_update'));
                redirect(base_url() . 'admin/semester/', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('s_id', $param2);
            $this->db->delete('semester');
            $this->session->set_flashdata('flash_message', $this->lang_message('semester_delete'));
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

    
    /*
     * System Setting
     * System general settings
     */

    /**
    * system_settings
    *  @param string $param1
    *  @param string $param2
    *  @param string $param3
    */

    function system_settings($param1 = '', $param2 = '', $param3 = '') {
        if($_POST)
        {
            if ($param1 == 'do_update') {
                $data['description'] = $this->input->post('system_name');
                $this->db->where('type', 'system_name');
                $this->db->update('system_setting', $data);

                $data['description'] = $this->input->post('system_title');
                $this->db->where('type', 'system_title');
                $this->db->update('system_setting', $data);

                $data['description'] = $this->input->post('address');
                $this->db->where('type', 'address');
                $this->db->update('system_setting', $data);

                $data['description'] = $this->input->post('phone');
                $this->db->where('type', 'phone');
                $this->db->update('system_setting', $data);

                $data['description'] = $this->input->post('paypal_email');
                $this->db->where('type', 'paypal_email');
                $this->db->update('system_setting', $data);

                $data['description'] = $this->input->post('currency');
                $this->db->where('type', 'currency');
                $this->db->update('system_setting', $data);

                $data['description'] = $this->input->post('system_email');
                $this->db->where('type', 'system_email');
                $this->db->update('system_setting', $data);

                $data['description'] = $this->input->post('system_name');
                $this->db->where('type', 'system_name');
                $this->db->update('system_setting', $data);

                $data['description'] = $this->input->post('userfile');
                $this->db->where('type', 'userfile');
                $this->db->update('system_setting', $data);

                $data['description'] = $this->input->post('language');
                $this->db->where('type', 'language');
                $this->db->update('system_setting', $data);

                $data['description'] = $this->input->post('text_align');
                $this->db->where('type', 'text_align');
                $this->db->update('system_setting', $data);

                $data['description'] = $this->input->post('countryCode');
                $this->db->where('type', 'country_code');
                $this->db->update('system_setting', $data);
                //$path = "uploads/system_image/" . $this->session->userdata('admin_id');
                //unlink($path);
                $as = move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/system_image/' . $this->session->userdata('admin_id') . '.jpg');

                $this->session->set_flashdata('flash_message', $this->lang_message('update_system'));
                redirect(base_url() . 'admin/system_settings/', 'refresh');
            }
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');

            $this->session->set_flashdata('flash_message',$this->lang_message('update_system'));
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
        if ($param1 == 'change_skin') {
            $data['description'] = $param2;
            $this->db->where('type', 'skin_colour');
            $this->db->update('system_setting', $data);
            $this->session->set_flashdata('flash_message', '');
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }      
        $this->data['title'] = $this->lang_message('system_title');
        $this->data['page'] = 'system_settings';
        $this->data['settings'] = $this->db->get('system_setting')->result_array();      
        $this->__site_template('admin/system_settings', $this->data);
        
    }
    
    /**
     *  Forum & Discussion
     */
    /**
    * Forum
    *     
    */
    function forum()
    {
        $this->data['page'] = 'forum';
        $this->data['title'] = $this->lang_message('forum_title');
        $this->data['forum'] = $this->forum_model->getforum();
        $this->__site_template('admin/forum', $this->data);
    }
    
    /**
     * forum crud
     * 
     */
    /**
     * @param string $param 
     * @param int $id
     */
     function crud($param='',$id='')
        {
            if($param=="create")
            {
                $data['forum_title']  = $this->input->post("forum_title");
                $data['forum_status'] = $this->input->post("forum_status");
                $this->forum_model->create($data);
                  $this->session->set_flashdata('flash_message', 'Forum Added Successfully');
                redirect(base_url() . 'forum/', 'refresh');
            }
            if($param=="update")
            {
                $data['forum_title']  = $this->input->post("forum_title");
                $data['forum_status'] = $this->input->post("forum_status");
                $this->forum_model->update($data,$id);
                  $this->session->set_flashdata('flash_message', 'Forum Updated Successfully');
                redirect(base_url() . 'forum/', 'refresh');
            }
            if($param=="delete")
            {
                
                $this->forum_model->delete($id);
                  $this->session->set_flashdata('flash_message', 'Forum Deleted Successfully');
                redirect(base_url() . 'forum/', 'refresh');
            }
            
        }
        
    /**
     * forum topics
     * 
     */
         
        function forumtopics()
        {
        $this->data['page'] = 'forum_topic';
        $this->data['title'] = $this->lang_message('forum_topic_title');
        $this->data['forum_topic'] = $this->forum_model->getforum_topic();
        $this->__site_template('admin/forum_topic', $this->data);
        }
        
    /**
     * Forum Topics crud
     * @param String $param 
     * @param int $id 
     */
        function topicscrud($param='',$id = '')
        {
            if($param=="create")
            {
                $data['forum_topic_title'] = $this->input->post('topic_title');
                $data['forum_topic_status'] = $this->input->post('topic_status');
                $data['forum_topic_desc'] = $this->input->post('description');
                $data['user_role'] = $this->session->userdata('login_type');
                $data['user_role_id'] = $this->session->userdata('login_id');
                $data['forum_id'] = $this->input->post('forum_id');
                
                
                $this->forum_model->create_topic($data);
                 $this->session->set_flashdata('flash_message', 'Forum Topic Added Successfully');
                redirect(base_url() . 'forum/forumtopics', 'refresh');
                
            }
             if($param=="update")
            {
                $topic = $this->forum_model->getforumtopic($id);
                $data['forum_topic_title'] = $this->input->post('topic_title');
                $data['forum_topic_status'] = $this->input->post('topic_status');
                $data['forum_id'] = $this->input->post('forum_id');
                $data['forum_topic_desc'] = $this->input->post('description');
                if($topic[0]['user_role']==$this->session->userdata('login_type'))
                {
                    $data['user_role'] = $this->session->userdata('login_type');
                    $data['user_role_id'] = $this->session->userdata('login_id');
                }
                $this->forum_model->update_topic($data,$id);
                $this->session->set_flashdata('flash_message', 'Forum Topic Updated Successfully');
                redirect(base_url() . 'forum/forumtopics', 'refresh');
                
            }
            if($param=="delete")
            {
                 $this->forum_model->forum_topicsdelete($id);
                  $this->session->set_flashdata('flash_message', 'Forum Topic Deleted Successfully');
                redirect(base_url() . 'forum/forumtopics', 'refresh');
            }
        }
        
    /**
     * furum comment list
     * @param int $param 
     * get comment particular topics
     */    
       function forumcomment($param = '')
       {
            if($param!="")
            {
             $this->data['forum_comment'] =  $this->forum_model->getcomments($param);
            }
             $this->data['page'] = 'forum_comment';
             $this->data['title'] = $this->lang_message('forum_comment_title');       
             $this->__site_template('admin/forum_comment', $this->data);
        }
        
        /**
         * Delete Comment
         * @param int $param comment id
         * @param int $topic topic id
         */
        function commentdelete($param='',$topic)
        {
            $this->forum_model->delete_comment($param);
             $this->session->set_flashdata('flash_message', 'Forum Comment Delete Successfully');
                redirect(base_url() . 'forum/forumcomment/'.$topic, 'refresh');
        }
        
        /**
         * Approve Comment
         * @param int $param comment id
         * @param int $topic topic id
         */
        function confirmcomment($param='',$topic)
        {
             $this->forum_model->confirm($param);
              $this->session->set_flashdata('flash_message', 'Forum Comment Approve Successfully');
                redirect(base_url() . 'forum/forumcomment/'.$topic, 'refresh');
        }
        
        /**
         * Photo gallery
         * @param String $param
         * @param String $param2
         */
        public function photogallery($param = '' , $param2 = '')
        {
            if($param=='create')
            {
                if($this->input->post())
                {
                  // retrieve the number of images uploaded;
                  $number_of_files = sizeof($_FILES['galleryimg']['tmp_name']);
                  // considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
                  $files = $_FILES['galleryimg'];
                  $errors = array();

                  // first make sure that there is no error in uploading the files
                  for($i=0;$i<$number_of_files;$i++)
                  {
                    if($_FILES['galleryimg']['error'][$i] != 0) $errors[$i][] = 'Couldn\'t upload file '.$_FILES['galleryimg']['name'][$i];
                  }
                  if(sizeof($errors)==0)
                  {
                    // now, taking into account that there can be more than one file, for each file we will have to do the upload
                    // we first load the upload library
                    $this->load->library('upload');
                    if(!is_dir(FCPATH . 'uploads/photogallery'))
                    {
                        $path = FCPATH . 'uploads/photogallery';
                        mkdir($path,0777);
                    }
                    // next we pass the upload path for the images
                    $config['upload_path'] = FCPATH . 'uploads/photogallery';
                    // also, we make sure we allow only certain type of images
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    for ($i = 0; $i < $number_of_files; $i++) {
                      $_FILES['galleryimg']['name'] = $files['name'][$i];
                      $_FILES['galleryimg']['type'] = $files['type'][$i];
                      $_FILES['galleryimg']['tmp_name'] = $files['tmp_name'][$i];
                      $_FILES['galleryimg']['error'] = $files['error'][$i];
                      $_FILES['galleryimg']['size'] = $files['size'][$i];

                      $file_ext = explode(".",$_FILES['galleryimg']['name']);
                      $ext_file = strtolower(end($file_ext));
                      $config['file_name'] = $i.date('dmYhis').'.'.$ext_file;

                      //now we initialize the upload library
                      $this->upload->initialize($config);
                      // we retrieve the number of files that were uploaded
                      if ($this->upload->do_upload('galleryimg'))
                      {
                        $data['uploads'][$i] = $this->upload->data();
                      }
                      else
                      {
                        $data['upload_errors'][$i] = $this->upload->display_errors();
                      }
                    }
                  }
                  else
                  {
                    $error = $this->lang_message('invalid_image');
                    $this->session->set_flashdata('flash_message',$error);
                    redirect(base_url().'admin/photogallery');

                  }

                  $upload_files =  $data['uploads'];
                  for($u=0;$u<count($upload_files);$u++)
                  {
                  $uploaded_file[] =   $upload_files[$u]['file_name'];    

                  }

                  if(!empty($uploaded_file))
                  {
                  $gallery = implode(",",$uploaded_file);
                  }else{
                  $gallery = '';    
                  }

                  if(is_uploaded_file($_FILES['main_img']['tmp_name']))
                  {
                   $config1['upload_path'] = FCPATH . 'uploads/photogallery';
                    $config1['allowed_types'] = 'gif|jpg|png|jpeg';
                    $ext = explode(".",$_FILES['main_img']['name']);
                    $ext_file =strtolower(end($ext));
                    $config1['file_name'] = date('dmYhis').'main.'.$ext_file;

                    $this->load->library('upload', $config1);

                    if ( ! $this->upload->do_upload('main_img'))
                    {

                        $error = $this->lang_message('invalid_main_image');
                        $this->session->set_flashdata('flash_message',$error);
                        redirect(base_url().'admin/photogallery');
                    }
                    else
                    {
                        $upl_path= FCPATH . 'uploads/photogallery/'.$config1['file_name'];
                       move_uploaded_file($_FILES['main_img']['tmp_name'],$upl_path);

                         $main_img = $config1['file_name'];
                    }
                  }


                  $title = $this->input->post("title");
                  $status = $this->input->post("status");
                  $description = $this->input->post("description");
                  $gallery_img = $gallery;
                  $insert = array("gallery_title"=>$title,
                                  "gallery_desc"=>$description,
                                  "gallery_img"=>$gallery_img,
                                  "main_img"=>$main_img,
                      "gal_status"=>$status);

                   $this->photo_gallery->addmedia("photo_gallery",$insert);

                      $success = $this->lang_message('gallery_success');
                    $this->session->set_flashdata('flash_message',$success);
                    redirect(base_url().'index.php?media/photogallery');




                }
            }

            if($param=='do_update')
            { 
                $gal_data = $this->photo_gallery->getgallery($param2);
                if($this->input->post())
                {
                  // retrieve the number of images uploaded;
                 if(!empty($_FILES['galleryimg2']['name'][0]))
                  {


                  $number_of_files = sizeof($_FILES['galleryimg2']['tmp_name']);
                  // considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
                  $files = $_FILES['galleryimg2'];
                  $errors = array();

                  // first make sure that there is no error in uploading the files
                  for($i=0;$i<$number_of_files;$i++)
                  {
                    if($_FILES['galleryimg2']['error'][$i] != 0) $errors[$i][] = 'Couldn\'t upload file '.$_FILES['galleryimg']['name'][$i];
                  }
                  if(sizeof($errors)==0)
                  {
                    // now, taking into account that there can be more than one file, for each file we will have to do the upload
                    // we first load the upload library
                    $this->load->library('upload');
                    if(!is_dir(FCPATH . 'uploads/photogallery'))
                    {
                        $path = FCPATH . 'uploads/photogallery';
                        mkdir($path,0777);
                    }
                    // next we pass the upload path for the images
                    $config['upload_path'] = FCPATH . 'uploads/photogallery';
                    // also, we make sure we allow only certain type of images
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    for ($i = 0; $i < $number_of_files; $i++) {
                      $_FILES['galleryimg2']['name'] = $files['name'][$i];
                      $_FILES['galleryimg2']['type'] = $files['type'][$i];
                      $_FILES['galleryimg2']['tmp_name'] = $files['tmp_name'][$i];
                      $_FILES['galleryimg2']['error'] = $files['error'][$i];
                      $_FILES['galleryimg2']['size'] = $files['size'][$i];

                      $file_ext = explode(".",$_FILES['galleryimg2']['name']);
                      $ext_file = strtolower(end($file_ext));
                      $config['file_name'] = $i.date('dmYhis').'.'.$ext_file;

                      //now we initialize the upload library
                      $this->upload->initialize($config);
                      // we retrieve the number of files that were uploaded
                      if ($this->upload->do_upload('galleryimg2'))
                      {
                        $data['uploads'][$i] = $this->upload->data();
                      }
                      else
                      {
                        $data['upload_errors'][$i] = $this->upload->display_errors();
                      }
                    }
                  }
                  else
                  {
                      $error =  $this->lang_message('invalid_image');
                    $this->session->set_flashdata('flash_message',$error);
                    redirect(base_url().'admin/photogallery');

                  }

                  $upload_files =  $data['uploads'];
                  for($u=0;$u<count($upload_files);$u++)
                  {
                  $uploaded_file[] =   $upload_files[$u]['file_name'];    

                  }

                  if(!empty($uploaded_file))
                  {
                      $new_gallery = implode(",",$uploaded_file);
                  }
                    $old_gal = $gal_data[0]->gallery_img;

                    if(!empty($old_gal)){
                    $all_img = $new_gallery.','.$old_gal;
                    }
                    else{
                         $all_img = $new_gallery;
                    }

                   }
                   else{
                         $all_img  = $gal_data[0]->gallery_img;
                   }
                    if(is_uploaded_file($_FILES['main_img']['tmp_name']))
                  {

                    $allowed_types = 'gif|jpg|png|jpeg';
                    $type = explode("|",$allowed_types);


                    $ext = explode(".",$_FILES['main_img']['name']);
                    $ext_file =strtolower(end($ext));
                    $image1 = date('dmYhis').'main.'.$ext_file;

                    $this->load->library('upload', $config1);

                    if (in_array($ext_file, $type))
                    {

                         $upl_path= FCPATH . 'uploads/photogallery/'.$image1;
                       move_uploaded_file($_FILES['main_img']['tmp_name'],$upl_path);

                         $main_img = $image1;
                    }
                    else
                    {
                       $error =  $this->lang_message('invalid_main_image');
                    $this->session->set_flashdata('flash_message',$error);
                    redirect(base_url().'admin/photogallery');
                    }
                  }
                  else{
                      $main_img = $gal_data[0]->main_img;

                  }

                  $title = $this->input->post("title");
                  $status = $this->input->post("status");
                  $description = $this->input->post("description");
                  $gallery_img = $all_img;
                  $update_date = date("Y-m-d H:i:s");
                  $update = array("gallery_title"=>$title,
                                  "gallery_desc"=>$description,
                                  "gallery_img"=>$gallery_img,                              
                                  "main_img"=>$main_img,
                                  "update_date"=>$update_date,
                      "gal_status"=>$status);


                   $this->photo_gallery->updatemedia($update,$param2);

                      $success =  $this->lang_message('gallery_update');
                    $this->session->set_flashdata('flash_message',$success);
                    redirect(base_url().'admin/photogallery');




                }
            }
            if($param=="delete")
            {
                $this->db->where("gallery_id",$param2);
                $this->db->delete("photo_gallery");
                $success = $this->lang_message('gallery_delete');
                $this->session->set_flashdata('flash_message',$success);
                redirect(base_url().'index.php?media/photogallery');
            }

           $this->data['gallery'] =  $this->photo_gallery->getphotogallery();
            $this->data['title'] = 'Photo Gallery';
            $this->data['page'] = 'photo_gallery';
           $this->__site_template('admin/photo_gallery', $this->data);
        }
        
    /**
     * Remove image
     */
        function removeimg()
    {
        
        $item = $_POST['image'];
        $id =  $_POST['id'];
        $get_gallery = $this->photo_gallery->getgallery($id);
            $str =    $get_gallery[0]->gallery_img;
       
          $parts = explode(',', $str);

            while(($i = array_search($item, $parts)) !== false) {
                unset($parts[$i]);
            }

           $new_img =  implode(',', $parts);
           $data = array("gallery_img"=>$new_img);
       $this->photo_gallery->updatemedia($data,$id);
       echo $item;
       
        
    }
        
    /**
     * banner slider
     * @param type $param
     * @param type $param2
     */    
          
    function bannerslider($param='' , $param2='')
    {
        if($_POST)
        {
        if($param=="create")
        {            
              if(is_uploaded_file($_FILES['main_img']['tmp_name']))
              {
                      $path= FCPATH . 'uploads/bannerimg/';
                      if(!is_dir($path))
                      {
                          mkdir($path,0777);
                      }
                      
		$allowed_types = 'gif|jpg|png|jpeg';
                $type = explode("|",$allowed_types);
                $ext = explode(".",$_FILES['main_img']['name']);
                $ext_file =strtolower(end($ext));
                $image1 = date('dmYhis').'main.'.$ext_file;               
		
            		if (in_array($ext_file, $type))
            		{
                               $upl_path= FCPATH . 'uploads/bannerimg/'.$image1;
                               move_uploaded_file($_FILES['main_img']['tmp_name'],$upl_path);
                               $main_img = $image1;
            		}
            		else
            		{
                                $error = "Invalid main image";
                                $this->session->set_flashdata('flash_message',$error);
                                redirect(base_url().'admin/bannerslider');
            		}
              }
              
              
              $title  = $this->input->post("title");
              $status  = $this->input->post("status");
              $slide_option  = $this->input->post("slide_option");
              $description  = $this->input->post("description");             
            $insert = array("banner_title"=>$title,
                "banner_desc"=>$description,
                "banner_status"=>$status,
                "banner_img"=>$main_img,
                "slide_option"=>$slide_option);
            
            $this->photo_gallery->addbanner($insert);
             $success = $this->lang_message('banner_add');
                    $this->session->set_flashdata('flash_message',$success);
                    redirect(base_url().'admin/bannerslider');
        }
        if($param=="do_update")
        {
           $banner =  $this->photo_gallery->getbanner($param2);
             if(is_uploaded_file($_FILES['main_img']['tmp_name']))
              {
                      $path= FCPATH . 'uploads/bannerimg/';
                      if(!is_dir($path))
                      {
                          mkdir($path,0777);
                      }
               
		$allowed_types = 'gif|jpg|png|jpeg';
                $type = explode("|",$allowed_types);
                $ext = explode(".",$_FILES['main_img']['name']);
                $ext_file =strtolower(end($ext));
                $image1 = date('dmYhis').'main.'.$ext_file;               
            		
            		if (in_array($ext_file, $type))
            		{
                               $upl_path= FCPATH . 'uploads/bannerimg/'.$image1;
                               move_uploaded_file($_FILES['main_img']['tmp_name'],$upl_path);
                               $main_img = $image1;
            		}
            		else
            		{
                                $error = $this->lang_message('invalid_main_image');
                                $this->session->set_flashdata('flash_message',$error);
                                redirect(base_url().'admin/bannerslider');
            		}
              }
              else{
                  $main_img = $banner[0]->banner_img;
              }
              
              
              $title  = $this->input->post("title");
              $status  = $this->input->post("status");
              $description  = $this->input->post("description");
               $slide_option  = $this->input->post("slide_option");
              
            $insert = array("banner_title"=>$title,
                "banner_desc"=>$description,
                "banner_status"=>$status,
                "banner_img"=>$main_img,
                "slide_option"=>$slide_option);
            
            $this->photo_gallery->updatebanner($insert,$param2);
             $success = $this->lang_message('banner_update');
                    $this->session->set_flashdata('flash_message',$success);
                    redirect(base_url().'admin/bannerslider');
        }
        }
        if($param=="delete")
        {
            $this->db->where("banner_id",$param2);
            $this->db->delete("banner_slider");
            $success = $this->lang_message('banner_delete');
            $this->session->set_flashdata('flash_message',$success);
            redirect(base_url().'admin/bannerslider');
        }
        if($param=="general")
        {
            if(strtolower($_SERVER['REQUEST_METHOD'])=="post")
            {
             $pause_time = $this->input->post("pause_time");
                $pause_on_hover = $this->input->post("pause_on_hover");
                $caption_opacity =  $this->input->post("caption_opacity");
                $anim_speed =  $this->input->post("anim_speed");
                $update_general = array("pause_time"=>$pause_time,
                "pause_on_hover"=>$pause_on_hover,
                "caption_opacity"=>$caption_opacity,
                "anim_speed"=>$anim_speed);
             
                 $this->photo_gallery->update_general($update_general);
              
                $success = $this->lang_message('banner_general');
                $this->session->set_flashdata('flash_message',$success);
                redirect(base_url().'admin/bannerslider');
            }
             
        }
        
      
        $this->data["banners"] =  $this->photo_gallery->get_banner();
        $this->data['general'] = $this->photo_gallery->general_setting();
     
        $this->data['title'] = 'Banner Slider';
        $this->data['page'] = 'banner_slider';
       $this->__site_template('admin/banner_slider', $this->data);
        
        
    }
    
     /**
     * Email inbox
     */
    function email_inbox() {
        $this->load->helper('system_email');

        $this->data['inbox'] = admin_inbox();
        $this->data['title'] = 'Inbox';
        //$this->data['content'] = 'backend/admin/email_inbox';
        $this->__site_template('admin/email_inbox', $this->data);
    }
    
      /**
     * Admin inbox email view
     * @param int $id
     */
    function inbox_email($id) {
      
        $this->load->helper('system_email');

        $this->data['email'] = admin_inbox_email_view($id);
        $this->data['title'] = $this->data['email']->subject;       
        $this->__site_template('admin/email_inbox_view', $this->data);
    }
    
     /**
     * View particular email details
     * @param int $id
     */
    function email_view($id) {
        $this->load->model('admin/Crud_model');
        $this->load->helper('system_email');
        $this->data['email'] = view_email($id);
        $this->data['title'] =  $this->data['email']->subject;        
        $this->data['page'] = 'email_view';        
        $this->__site_template('admin/email_view', $this->data);
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
     * Email compose
     * 
     * @return response
     */
    function email_compose() {
        ini_set('max_execution_time', 500);
        //load the Crud model      
        $this->load->helper('system_email');        
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

            if ($_POST['course'] == 'all') {
                // send to all students 
                send_to_all_course($_POST);
            } else if ($_POST['semester'] == 'all') {
                //send to all semester of the course
                send_to_course_all_semester($_POST, $_POST['course']);
            } else if ($_POST['student'][0] == 'all') {
                //send to all students of the course and semeter
                send_to_all_student_course_semester($_POST, $_POST['course'], $_POST['semester']);
            } else {               
                //send particular student                
                send_to_single_student($_POST);
            }

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

            //send email
            //var_dump($teacher_list);
            //exit;
            $this->setemail($teacher_list, $_POST['subject'], $_POST['message'], $email_cc_list, $attachments);

            redirect(base_url('admin/email_inbox'));
        }

        $this->data['course'] = $this->Crud_model->get_all_course();
        $this->data['degree'] = $this->Crud_model->get_all_degree();
        $this->data['semester'] = $this->Crud_model->get_all_semester();
        $this->data['teacher'] = $this->Crud_model->get_all_teacher();
        //set the template and view
        $this->data['title'] = 'Compose Email';
        $this->data['content'] = 'backend/admin/email_compose';
        $this->data['page'] = 'email_compose';
       $this->__site_template('admin/email_compose', $this->data);
    }
    
    
    /**
     * Email reply from admin
     * @param int $id
     */
    function email_reply($id) {
      
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

            admin_email_reply($_POST);

            redirect(base_url('admin/email_inbox'));
        }

        $this->data['email'] = admin_inbox_email_view($id);
        $this->data['title'] = $this->data['email']->subject;
       $this->data['page'] = 'email_reply';
       
        
       /// $this->data['content'] = 'backend/admin/email_reply';
        $this->__site_template('admin/email_reply', $this->data);
    }
    
     /**
     * View sent email of the admin
     */
    function email_sent() {
        $this->load->helper('system_email');
        $this->data['sent_mail'] = admin_sent_email();
        $this->data['title'] ='Sent Email';
       $this->data['page'] = 'email_sent';
        $this->__site_template('admin/email_sent', $this->data);
    }
    
    
    /**
     * Import data
     */
    function import($param1 = '') {
        $this->load->helper('import_export');     
        if ($_FILES) {
            $file_name = $_FILES['userfile']['tmp_name'];
            $this->load->library('CSVReader');
            $csv_result = $this->csvreader->parse_file($file_name);

            switch ($_POST['module']) {
                case 'degree':
                    //import degree CSV
                    foreach ($csv_result as $result) {
                        $where = array(
                            'd_name' => $result['Degree Name']
                        );
                        $data = array(
                            'd_name' => $result['Degree Name'],
                            'd_status' => 1
                        );
                        import_degree($data, $where);
                    }
                    break;

                case 'admission_type':
                    //import admission type
                    foreach ($csv_result as $result) {
                        $where = array(
                            'at_name' => $result['Admission Type']
                        );
                        $data = array(
                            'at_name' => $result['Admission Type'],
                            'at_status' => 1
                        );
                        import_admission_type($data, $where);
                    }
                    break;
                case 'batch':
                    //import batch
                    foreach ($csv_result as $result) {
                        $where = array(
                            'degree' => array(
                                'd_name' => $result['Degree Name']
                            ),
                            'course' => array(
                                'c_name' => $result['Course Name']
                            )
                        );
                        $data = array(
                            'b_name' => $result['Batch Name'],
                            'b_status' => 1
                        );
                        import_batch($data, $where);
                    }
                    break;
                case 'event_manager':
                    //import event manager
                    foreach ($csv_result as $result) {
                        $where = array(
                            'event_name' => $result['Event Name']
                        );
                        $data = array(
                            'event_name' => $result['Event Name'],
                            'event_desc' => $result['Event Description'],
                            'event_date' => $result['Event Date'],
                            'event_time' => $result['Event Time']
                        );
                        import_event_manager($data, $where);
                    }
                    break;
                case 'exam_manager':
                    //exam manager csv import
                    foreach ($csv_result as $result) {
                        $where = array(
                            'degree' => array(
                                'd_name' => $result['Degree Name'],
                            ),
                            'course_name' => array(
                                'c_name' => $result['Course Name']
                            ),
                            'batch' => array(
                                'b_name' => $result['Batch']
                            ),
                            'semester' => array(
                                's_name' => $result['Semester']
                            ),
                            'exam_type' => array(
                                'exam_type_name' => $result['Exam Type']
                            )
                        );
                        $data = array(
                            'em_name' => $result['Exam Name'],
                            'em_status' => 1,
                            'total_marks' => $result['Total Marks'],
                            'passing_mark' => $result['Passing Marks'],
                        );
                        import_exam_manager($data, $where);
                    }
                    break;
                case 'fees_structure':
                    //fees structure csv import
                    foreach ($csv_result as $result) {
                        $where = array(
                            'semester' => array(
                                's_name' => $result['Semester']
                            ),
                            'course' => array(
                                'c_name' => $result['Branch Name']
                            ),
                            'degree' => array(
                                'd_name' => $result['Course Name']
                            ),
                            'batch' => array(
                                'b_name' => $result['Batch Name']
                            ),
                            'fees_structure' => array(
                                'title' => $result['Title']
                            )
                        );
                        $data = array(
                            'title' => $result['Title'],
                            'total_fee' => $result['Fees']
                        );
                        import_fees_structure($data, $where);
                    }
                    break;
                case 'subject':
                    //import subject csv
                    foreach ($csv_result as $result) {
                        $where = array(
                            'semester' => array(
                                's_name' => $result['Semester']
                            ),
                            'course' => array(
                                'c_name' => $result['Course']
                            ),
                            'subject' => array(
                                'subject_name' => $result['Subject Name']
                            //'subject_code'  => $result['Subject Code']
                            )
                        );
                        $data = array(
                            'subject_name' => $result['Subject Name'],
                            'subject_code' => $result['Subject Code']
                        );
                        import_subject($data, $where);
                    }
                    break;
                case 'exam_marks':
                    $this->load->model('Admin/Crud_model');
                    $exam_id = $_POST['exam_detail'];
                    $course_id = $_POST['course_detail'];
                    $semester_id = $_POST['sem_detail'];
                    $subjects = $this->Crud_model->exam_subjects($exam_id);

                    $exam_subject = array();
                    foreach ($subjects as $row) {
                        array_push($exam_subject, $row->subject_name);
                    }
                    foreach ($csv_result as $result) {
                        $where = array(
                            'marks' => array(
                                'mm_exam_id' => $exam_id,
                                'mm_std_id' => $result['Student ID']
                            ),
                            'subject' => $exam_subject
                        );
                        $data = $result;

                        import_exam_marks($data, $where);
                    }
                    //exit;
                    break;
                case 'student':
                    //import student
                    foreach ($csv_result as $result) {
                        $where = array(
                            'student_roll_no' => array(
                                'std_roll' => $result['Roll No']
                            ),
                            'semester' => array(
                                's_name' => $result['Semester']
                            ),
                            'course' => array(
                                'c_name' => $result['Course Name']
                            ),
                            'batch' => array(
                                'b_name' => $result['Batch']
                            ),
                            'degree' => array(
                                'd_name' => $result['Degree Name']
                            ),
                            'admission_type' => array(
                                'at_name' => $result['Admission Type']
                            )
                        );
                        $data = array(
                            'email' => $result['Email'],
                            'std_roll' => $result['Roll No'],
                            'std_first_name' => $result['First Name'],
                            'std_last_name' => $result['Last Name'],
                            'std_gender' => $result['Gender'],
                            'address' => $result['Address'],
                            'country' => $result['Country'],
                            'state' => $result['State'],
                            'city' => $result['City'],
                            'zip' => $result['Zip'],
                            'std_birthdate' => $result['Birth Date'],
                            'std_marital' => $result['Merital'],
                            'std_about' => $result['About'],
                            'std_mobile' => $result['Mobile']
                        );
                        import_student($data, $where);
                    }
                    break;
                case 'course':
                    //import course csv
                    foreach ($csv_result as $result) {
                        $where = array(
                            'course' => array(
                                'c_name' => $result['Course Name']
                            ),
                            'degree' => array(
                                'd_name' => $result['Degree Name']
                            )
                        );
                        $data = array(
                            'c_name' => $result['Course Name'],
                            'c_description' => $result['Description'],
                            'course_alias_id' => $result['Course Alias']
                        );
                        import_course($data, $where);
                    }
                    break;
                case 'exam_time_table':
                    foreach ($csv_result as $result) {
                        $where = array(
                            'subject' => array(
                                'subject_name' => $result['Subject Name'],
                                'sm_course_id' => $_POST['course'],
                                'sm_sem_id' => $_POST['sem_detail']
                            ),
                            'time_table' => array(
                                'exam_id' => $_POST['exam_detail']
                            )
                        );
                        $data = array(
                            'exam_date' => $result['Exam Date'],
                            'exam_start_time' => $result['Start Time'],
                            'exam_end_time' => $result['End Time'],
                            'degree_id' => $_POST['degree'],
                            'course_id' => $_POST['course'],
                            'batch_id' => $_POST['batch'],
                            'semester_id' => $_POST['sem_detail']
                        );
                        exam_time_table_import($data, $where);
                    }
                    break;
            }
            $this->session->set_flashdata('flash_message',$this->lang_message('data_import'));
            redirect(base_url('admin/import'));
        }
        $this->data['degree'] = $this->Crud_model->get_all_degree();
        $this->data['title'] = $this->lang_message('import_title');
        $this->data['page'] = 'import';       
        $this->__site_template('admin/import', $this->data);
    }
    
    
    /**
     * Download import sheet
     * @param string $param1
     */
    function download_import($param1 = '') {
        $this->load->helper('download');
        $this->load->helper('import_export');
        $sheet_name = '';

        switch ($param1) {
            case 'exam_manager':
                //exam manager
                $this->import_demo_sheet_download_config('Exam Manager');
                //import_export_helper function
                exam_manager();
                break;
            case 'course':
                $this->import_demo_sheet_download_config('Branch');
                //import_export_helper function
                course();
                break;
            case 'degree':
                $this->import_demo_sheet_download_config('Course');
                degree();
                break;
            case 'admission_type':
                $this->import_demo_sheet_download_config('Admission Type');
                admission_type();
                break;
            case 'batch':
                $this->import_demo_sheet_download_config('Batch');
                batch();
                break;
            case 'event_manager':
                $this->import_demo_sheet_download_config('Event Manager');
                event_manager();
                break;
            case 'exam_manager':
                $this->import_demo_sheet_download_config('Exam Manager');
                exam_manager();
                break;
            case 'fees_structure':
                $this->import_demo_sheet_download_config('Fees Structure');
                fees_structure();
                break;
            case 'subject':
                $this->import_demo_sheet_download_config('Subject');
                subject();
                break;
            case 'exam_marks':
                $this->import_demo_sheet_download_config('Exam Marks');
                exam_marks();
                break;
            case 'student':
                $this->import_demo_sheet_download_config('Student');
                student_import_sample();
                break;
            case 'exam_time_table':
                $this->import_demo_sheet_download_config('Exam Time Table');
                exam_time_table();
                break;
            default:
            //default sheet
        }
    }
    
     /**
     * Import demo sheet download configuration
     * @param string $sheet_name
     */
    function import_demo_sheet_download_config($sheet_name) {
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename={$sheet_name}" . ".csv");
        header("Pragma: no-cache");
        header("Expires: 0");
    }

    /**
     * Exoprt
     */
    function export() {        
        $this->data['title'] = 'Export';
        $this->data['page'] = 'export';
        $this->data['degree'] = $this->Crud_model->get_all_degree();
        $this->data['course'] = $this->Crud_model->get_all_course();
        $this->data['semester'] = $this->Crud_model->get_all_semester();
        $this->__site_template('admin/export', $this->data);
    }
    
    
    
    //Starting Herry Patel

    /*     * **GROUP MANAGEMENT**** */
    /*     * **Develop By Hardik Bhut 29-Feb-2016**** */
    function create_group($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['group_name'] = $this->input->post('group_name');
            $data['user_type'] = $this->input->post('user_type');
            $data['user_role'] = implode(',', $this->input->post('user_role'));

            $this->db->insert('group', $data);
            $this->session->set_flashdata('flash_message', 'Group Added Successfully');

            redirect(base_url() . 'admin/create_group', 'refresh');
        }
        $this->data['user_role'] = $param1;
        $this->data['groups'] = $this->db->get('group')->result_array();
        $this->data['groups'] = $this->db->get_where('group', array('user_role' => $param1))->result_array();
        $this->data['page'] = 'create_group';
        $this->data['title'] = 'Create Group';
        
         $this->__site_template('admin/create_group', $this->data);
    }

    function list_group($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'do_update') {
            $data['user_role'] = implode(',', $this->input->post('user_role'));
            $this->db->where('g_id', $this->input->post('group_name'));
            $this->db->update('group', $data);
            $this->session->set_flashdata('flash_message', get_phrase('group_updated_successfully'));
            redirect(base_url() . 'admin/list_group', 'refresh');
        }
        if ($param1 == 'delete') {

            $this->input->post('group_name_delete');
            $this->db->where('group_id', $this->input->post('group_name_delete'));
            $this->db->delete('group');
            $this->db->where('group_id', $this->input->post('group_name_delete'));
            $this->db->delete('assign_module');

            $this->session->set_flashdata('flash_message', get_phrase('group_deleted_successfully'));
            redirect(base_url() . 'admin/list_group', 'refresh');
        }
        $this->data['user_role'] = $param1;
        $this->data['group_list'] = $this->db->get_where('group')->result_array();
        $this->data['groups'] = $this->db->get_where('group', array('user_role' => $param1))->result_array();
        $this->data['page'] = 'list_group';
        $this->data['title'] = 'List Group';        
        $this->__site_template('admin/list_group', $this->data);
    }

    /**
     *  admin group
     */
    function get_group_admin()
    {
         $dataprofessor = $this->db->get("admin")->result_array();
        foreach ($dataprofessor as $row) {
            $html .='<option value="' . $row['admin_id'] . '">' . $row['name'] . '</option>';
        }
        echo $html;
    }
    
    
     function get_group_ajax($group_id) {
        $get_group_list = $this->db->get_where('group', array('g_id' => $group_id))->result_array();
        $user_role=explode(',',$get_group_list[0]['user_role']);
        $full_user_list=array();
        $group=array();
           if($get_group_list[0]['user_type']=='student')
           {               
               $user_type[]='<option value="student">Student</option>';
               $sections=$this->db->get('student')->result_array();
                foreach ($sections as $row) {
                    if(!in_array($row['std_id'],$user_role))
                    {
                        $full_user_list[]= '<option value="' . $row['std_id'] . '">' . $row['name'] . '</option>';
                        }

                    if(in_array($row['std_id'],$user_role))
                    {
                        $group[]= '<option value="' . $row['std_id'] . '">' . $row['name'] . '</option>';
                        }

                    }
           }
           if($get_group_list[0]['user_type']=='professor')
           {               
               $user_type[]='<option value="professor">Professor</option>';
               $sections=$this->db->get('professor')->result_array();
                foreach ($sections as $row) {
                    if(!in_array($row['professor_id'],$user_role))
                    {
                        $full_user_list[]= '<option value="' . $row['professor_id'] . '">' . $row['name'] . '</option>';
                        }

                    if(in_array($row['professor_id'],$user_role))
                    {
                        $group[]= '<option value="' . $row['professor_id'] . '">' . $row['name'] . '</option>';
                        }

                    }
           }
           if($get_group_list[0]['user_type']=='admin')
           {
               $user_type[]='<option value="admin">Admin</option>';
               $sections=$this->db->get('admin')->result_array();
                foreach ($sections as $row) {
                    if(!in_array($row['admin_id'],$user_role))
                    {
                        $full_user_list[]= '<option value="' . $row['admin_id'] . '">' . $row['name'] . '</option>';
                        }

                    if(in_array($row['admin_id'],$user_role))
                    {
                        $group[]= '<option value="' . $row['admin_id'] . '">' . $row['name'] . '</option>';
                        }

                    }
           }
        $out = array('group'=>$group,'user_type'=>$user_type,'full_user_list'=>$full_user_list); 
	echo json_encode($out);             
    }

/**
     * Course list from degree
     * @param int $degree_id
     */
    function course_list_from_degree($degree_id) {
        $this->load->model('admin/Crud_model');
        $course = $this->Crud_model->course_list_from_degree($degree_id);

        echo json_encode($course);
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
     * Batch list from degree and course
     * @param int $degree
     * @param int $course
     */
    function batch_list_from_degree_and_course($degree = '', $course = '') {
        $this->load->model('admin/Crud_model');
        $batch = $this->Crud_model->batch_list_from_degree_and_course($degree, $course);

        echo json_encode($batch);
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
     * Send emails
     * @param type $email
     * @param type $subject
     * @param type $message
     * @param type $cc
     * @param type $attachments
     */
    public function sendEmail($email, $subject, $message, $cc, $attachments) {
        //$this->email->set_newline("\r\n");
        $this->email->from('mayur.ghadiya@searchnative.in', 'Search Native India');
        $this->email->to($email);
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

    //send mail
    function sendmail($from, $from_name, $to, $subject, $cc, $bcc, $message) {
        $this->email->clear();
        $this->email->from($from, $from_name);
        //$list = array($to);
        $this->email->to($to);
        $this->email->cc($cc);
        $this->email->bcc($bcc);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }
    
    /**
     * Check duplicate record
     */
     function check_degree() {
        $data = $this->db->get_where('degree', array('d_name' => $this->input->post('course')))->result();
        if (count($data) > 0) {
            echo "false";
        } else {
            echo "true";
        }
    }
    
    
    function check_duplicate_department($id = '') {
        $degree = $this->input->post('d_name');      
        $data = $this->db->get_where('degree', array('d_name' => $degree,
                    'd_id!=' => $id))->result_array();
        echo json_encode($data);
    }
    
     function status($str) {
        if ($str) {
            return 1;
        } else {
            return 0;
        }
    }
    
    function check_course() {
        $data = $this->db->get_where('course', array('c_name' => $this->input->post('course'),
                    'degree_id' => $this->input->post('degree')))->result();

        if (count($data) > 0) {
            echo "false";
        } else {
            echo "true";
        }
    }
    
    function check_batch() {
//        $degree = implode(',', $this->input->post("degree"));
//        $course = implode(',', $this->input->post("course"));
//        $batchname = $this->input->post('batch');
//       // $data = $this->db->query("select * from batch where  FIND_IN_SET('degree_id','".$degree."') and  FIND_IN_SET('course_id','".$course."') and b_name='".$batchname."'")->result_array();
//        $data= $batch = $this->Crud_model->batch_list_from_degree_and_course($degree, $course);

        $degree = $this->input->post("degree");
        $course = $this->input->post("course");
        $query = 'SELECT * FROM `batch` WHERE b_name="' . $this->input->post('batch') . '" AND '; // construct query
        foreach ($degree as $d) {
            $query .= "FIND_IN_SET($d, degree_id) AND "; // append every time for set 
        }
        foreach ($course as $c) {
            $query .= "FIND_IN_SET($c, course_id) AND "; // append every time for set 
        }

        $query = rtrim($query, ' AND'); // remove last AND

        $data = $this->db->query($query)->result_array();
        echo json_encode($data);
    }
    
    function get_cource_multiple($param = '') {
        $did = implode(',', $this->input->post("degree"));
        $courceid = explode(',', $this->input->post("courseid"));
        $cource = $this->db->query("select * from course where degree_id in($did)")->result_array();
        $html = '<option value="default">Select Branch</option>';
        foreach ($cource as $c) {
            if (in_array($c['course_id'], $courceid)) {
                $html .='<option value="' . $c['course_id'] . '" selected>' . $c['c_name'] . '</option>';
            } else {
                $html .='<option value="' . $c['course_id'] . '">' . $c['c_name'] . '</option>';
            }
        }
        echo $html;
    }
    
    function check_semester() {
        $data = $this->db->get_where('semester', array('s_name' => $this->input->post('semester')))->result();
        if (count($data) > 0) {
            echo "false";
        } else {
            echo "true";
        }
    }
    
     function check_admission_type() {
        $data = $this->db->get_where('admission_type', array('at_name' => $this->input->post('admission_type')))->result();
        if (count($data) > 0) {
            echo "false";
        } else {
            echo "true";
        }
    }


}
