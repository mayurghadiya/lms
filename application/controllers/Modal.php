<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Modal extends MY_Controller {

    /**
     * Constructor
     * 
     * @return void
     */
    function __construct() {
        parent::__construct();
        $this->load->model('admin/Crud_model');
        $this->load->model('professor/Professor_model');
        $this->load->model('forum_model');
    }

    /*
     * 	$page_name		=	The name of page
     */

    function popup($page_name = '', $param2 = '', $param3 = '') {
        $account_type = $this->session->userdata('login_type');
        $page_data['param2'] = $param2;
        $page_data['param3'] = $param3;
        if ($page_name == "add_exam_schedual") {
            if ($this->session->userdata('login_type') == "professor") {
                $page_data['degree'] = $this->Professor_model->get_all_degree();
                $page_data['course'] = $this->Professor_model->get_all_course();
                $page_data['semester'] = $this->Professor_model->get_all_semester();
                $page_data['time_table'] = $this->Professor_model->time_table();
            } else {
                $page_data['degree'] = $this->Crud_model->get_all_degree();
                $page_data['course'] = $this->Crud_model->get_all_course();
                $page_data['semester'] = $this->Crud_model->get_all_semester();
                $page_data['time_table'] = $this->Crud_model->time_table();
            }
        }
        if ($page_name == "addexam") {
            if ($this->session->userdata('login_type') == "professor") {
                $page_data['exams'] = $this->Professor_model->exam_details();
                $page_data['exam_type'] = $this->Professor_model->get_all_exam_type();
                $page_data['degree'] = $this->Professor_model->get_all_degree();
                $page_data['course'] = $this->Professor_model->get_all_course();
                $page_data['semester'] = $this->Professor_model->get_all_semester();
            } else {
                $page_data['exams'] = $this->Crud_model->exam_details();
                $page_data['exam_type'] = $this->Crud_model->get_all_exam_type();
                $page_data['degree'] = $this->Crud_model->get_all_degree();
                $page_data['course'] = $this->Crud_model->get_all_course();
                $page_data['semester'] = $this->Crud_model->get_all_semester();
            }
            //$page_data['centerlist'] = $this->db->get('center_user')->result(); 
        }
        if ($page_name == "addremedial") {
            $page_data['exams'] = $this->Crud_model->exam_details();
            $page_data['exam_type'] = $this->Crud_model->get_all_exam_type();
            $page_data['degree'] = $this->Crud_model->get_all_degree();
            $page_data['course'] = $this->Crud_model->get_all_course();
            $page_data['semester'] = $this->Crud_model->get_all_semester();
            //$page_data['centerlist'] = $this->db->get('center_user')->result(); 
        }
        if ($page_name == "addremedial_schedual") {
            $page_data['degree'] = $this->Crud_model->get_all_degree();
            $page_data['course'] = $this->Crud_model->get_all_course();
            $page_data['semester'] = $this->Crud_model->get_all_semester();
            $page_data['time_table'] = $this->Crud_model->time_table();
        }
        if ($page_name == "addfees" || $page_name == "addpayment") {
            if ($this->session->userdata('login_type') == "professor") {
                $page_data['degree'] = $this->Professor_model->get_all_degree();
                $page_data['course'] = $this->Professor_model->get_all_course();
                $page_data['semester'] = $this->Professor_model->get_all_semester();
                $page_data['fees_structure'] = $this->Professor_model->get_all_fees_structure();
            } else {
                $page_data['degree'] = $this->Crud_model->get_all_degree();
                $page_data['course'] = $this->Crud_model->get_all_course();
                $page_data['semester'] = $this->Crud_model->get_all_semester();
                $page_data['fees_structure'] = $this->Crud_model->get_all_fees_structure();
            }
        }
        if ($page_name == "add_forum_topic" || $page_name == "modal_edit_forumtopic") {
            $page_data['forum'] = $this->forum_model->getforum();
        }
        if ($page_name == "add_forum_question") {
            $page_data['forum'] = $this->forum_model->getforum();
            $page_data['forum_topic'] = $this->forum_model->getforum_topic();
        }
        if ($page_name == "addassessment" || $page_name == "modal_edit_assessment") {

            if ($this->session->userdata('login_type') == "professor") {
                $page_data['degree'] = $this->Professor_model->get_all_degree();
                $page_data['course'] = $this->Professor_model->get_all_course();
                $page_data['semester'] = $this->Professor_model->get_all_semester();
                $page_data['fees_structure'] = $this->Professor_model->get_all_fees_structure();
            } else {
                $page_data['degree'] = $this->Crud_model->get_all_degree();
                $page_data['course'] = $this->Crud_model->get_all_course();
                $page_data['semester'] = $this->Crud_model->get_all_semester();
                $page_data['batch'] = $this->Crud_model->get_all_bacth();
            }
        }
        if ($page_name == "modal_student_detail") {
            $page_data['student'] = $this->Professor_model->getstudentinfo($param2);
        }
        if ($page_name == "addsyllabus" || $page_name == "modal_edit_syllabus") {
            if ($this->session->userdata('login_type') == "professor") {
                $dept = $this->session->userdata('department');
                $this->db->where("d_id", $dept);
                $page_data['degree'] = $this->db->get_where('degree', array('d_status' => 1))->result();

                $page_data['courses'] = $this->db->get('course')->result_array();
                $page_data['semesters'] = $this->db->get('semester')->result_array();
            }
        }
        if ($page_name == "addassignment" || $page_name == "modal_edit_assignment") {
            if ($this->session->userdata('login_type') == "professor") {
                $dept = $this->session->userdata('department');
                $this->db->where("d_id", $dept);
                $page_data['degree'] = $this->db->get_where('degree', array('d_status' => 1))->result();

                $page_data['courses'] = $this->db->get('course')->result_array();
                $page_data['semesters'] = $this->db->get('semester')->result_array();
            }
        }


        if ($page_name == "addcourseware" || $page_name == "modal_edit_courseware") {
            $page_data['branch'] = $this->db->get('course')->result_array();
        }
        if ($page_name == "addstudyresource" || $page_name == "modal_edit_studyresource") {
            if ($this->session->userdata('login_type') == "professor") {
                $dept = $this->session->userdata('department');
                $this->db->where("d_id", $dept);
                $page_data['degree'] = $this->db->get_where('degree', array('d_status' => 1))->result();

                $page_data['courses'] = $this->db->get('course')->result_array();
                $page_data['semesters'] = $this->db->get('semester')->result_array();
            }
        }
        if ($page_name == "addlibrary" || $page_name == "modal_edit_library") {
            if ($this->session->userdata('login_type') == "professor") {
                $dept = $this->session->userdata('department');
                $this->db->where("d_id", $dept);
                $page_data['degree'] = $this->db->get_where('degree', array('d_status' => 1))->result();

                $page_data['courses'] = $this->db->get('course')->result_array();
                $page_data['semesters'] = $this->db->get('semester')->result_array();
            }
        }
        if ($page_name == "addproject" || $page_name == "modal_edit_project") {
            if ($this->session->userdata('login_type') == "professor") {
                $dept = $this->session->userdata('department');
                $this->db->where("d_id", $dept);
                $page_data['degree'] = $this->db->get_where('degree', array('d_status' => 1))->result();
                $page_data['courses'] = $this->db->get('course')->result_array();
                $page_data['semesters'] = $this->db->get('semester')->result_array();
            }
        }
        if($page_name=="modal_assessment")
        {
             $this->db->select("ass.*,am.*,s.* ");
        $this->db->from('assignment_submission ass');
        $this->db->join("assignment_manager am", "am.assign_id=ass.assign_id");
        $this->db->join("student s", "s.std_id=ass.student_id");
        $this->db->where("ass.assignment_submit_id",$param2);
        $page_data['assessment'] = $this->db->get()->result();
        }
        if($page_name=="addcomments")
        {            
            $page_data['forum'] = $this->db->get("forum")->result_array();
            $page_data['param2'] = $param2;
        }
        if($page_name=="modal_edit_comment")
        {            
            $page_data['forum'] = $this->db->get("forum")->result_array();
            $this->db->where("forum_comment_id",$param2);
            $page_data['comment'] = $this->db->get("forum_comment")->result();
            $page_data['param2'] = $param3;
            
        }
        $page_data['action_page_name'] = 'abd';
        $this->load->view($account_type . '/' . $page_name . '.php', $page_data);
       
    }

}
