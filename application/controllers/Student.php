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
        $streaming =  $this->streaming_list_widget();
        $this->data['all'] = $streaming['all'];
        $this->data['live_streaming'] = $streaming['live_streaming'];
       
        $this->__site_template('student/dashboard', $this->data);
    }
    
    function streaming_list_widget()
    {
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
    
    function student_cms_page_list_widget()
    {
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

}
