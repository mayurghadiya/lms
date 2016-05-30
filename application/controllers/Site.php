<?php

class Site extends MY_Controller {

    /**
     * Constructor
     * 
     * @retun void
     */
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Site_model');
        $this->load->helper('system_setting');
    }

    /**
     * Custom template magic method
     * @param string $view_name
     * @param mixed $data
     */
    function __template($view_name, $data) {
        $data['courses'] = $this->Site_model->get_all_courses();
        $this->load->view('site/header.php', $data);
        $this->load->view('site/' . $view_name);
        $this->load->view('site/footer.php');
    }

    function index() {
        $this->home();
    }

    /**
     * Home action
     * 
     * @return response
     */
    function home() {
        $this->data['title'] = 'Home Page';
        $this->data['branch'] = $this->Site_model->all_branch();
        $this->data['events'] = $this->Site_model->events();
        $this->data['banner'] = $this->Site_model->banners();
        $this->data['recent_graduates'] = $this->Site_model->recent_graduates();
        $this->data['slide_setting'] = $this->Site_model->banner_setting();
        $this->__template('home', $this->data);
    }

    /**
     * Course action
     * @param string $course_id
     */
    function course($course_id = '') {
        $this->data['title'] = 'Course Details';
        $this->data['course_details'] = $this->Site_model->course_details($course_id);
        $this->data['course_branch'] = $this->Site_model->course_branch($course_id);
        $this->__template('course', $this->data);
    }

    /**
     * Branch details
     * @param string $id
     */
    function branch_details($id = '') {
        $this->data['title'] = 'Branch Details';
        $this->data['branch_details'] = $this->Site_model->branch_details($id);
        $this->__template('branch_details', $this->data);
    }

    /**
     * About action 
     * 
     * @return response
     */
    function about() {
        $this->data['title'] = 'About us';
        $this->data['university_peoples'] = $this->Site_model->recent_universiy_peoples();
        $this->__template('about', $this->data);
    }

    /*
     * 
     */

    function syllabus() {
        $this->data['title'] = 'Syllabus';
        $this->data['syllabus'] = $this->Site_model->get_all_syllabus();
        $this->__template('syllabus', $this->data);
    }

    /**
     * Contact action
     * 
     * @return response
     */
    function contact() {
        if ($_POST) {
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
            $this->email->from($_POST['email'], $_POST['name']);
            $this->email->to('mayur.ghadiya@searchnative.in');
            $this->email->set_newline("\r\n");
            $this->email->subject('Contact Inquiry');
            $this->email->message($_POST['message']);
            $this->email->send();

            $this->session->set_flashdata('message', 'Your inquiry successfully sent.');
            redirect(base_url('index.php?contact'));
        }
        $this->data['title'] = 'Contact us';
        $this->__template('contact', $this->data);
    }

    /**
     * Add new subcriber 
     * 
     * @return response
     */
    function subscriber() {
        $email = $_POST['email'];
        $is_subscriber = $this->Site_model->check_subscriber($email);
        if ($is_subscriber) {
            echo 'Email adderess is already registered.';
        } else {
            $this->Site_model->save_subscriber(array(
                'email' => $_POST['email']
            ));
            echo 'Thank you for subscribing';
        }
    }

    /**
     * User login action 
     * 
     * @return response
     */
    function user_login() {
        $this->user_dashboard();
        if ($_POST) {
            $email = $_POST["email"];
            $password = md5($_POST["password"]);
            if ($this->validate_login($email, $password) == 'invalid') {
                $this->session->set_flashdata('error', 'Invalid username or password');
            }

            redirect(base_url('site/user_login'));
        }
        $this->data['title'] = 'User Login';
        $this->load->view('site/user_login', $this->data);
    }

    function logout() {
        $this->session->sess_destroy();
        redirect(base_url('site/user_login'));
    }

    /**
     * Validate login
     * @param string $email
     * @param string $password
     * @return string
     */
    function validate_login($email = '', $password = '') {
        $credential = array('email' => $email, 'password' => $password);
        $std_credential = array('email' => $email, 'password' => $password, 'std_status' => 1);
        $center_credential = array('emailid' => $email, 'password' => $password, 'center_status' => 1);

        // Checking login credential for admin
        $query = $this->db->get_where('admin', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('admin_id', $row->admin_id);
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('email', $row->email);
            $this->session->set_userdata('login_type', 'admin');
            $update = array("online" => '1');
            $this->db->where('admin_id', $row->admin_id);
            $this->db->update('admin', $update);

            redirect(base_url('admin/dashboard'));
        }
        // Checking login credential for student
        $query = $this->db->get_where('student', $std_credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('student_login', '1');
            $this->session->set_userdata('std_id', $row->std_id);
            $this->session->set_userdata('student_id', $row->std_id);
            $this->session->set_userdata('login_user_id', $row->std_id);
            $this->session->set_userdata('std_roll', $row->std_roll);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'student');
            $this->session->set_userdata('email', $row->email);
            $this->session->set_userdata('user_type', '2');
            $this->session->set_userdata('group_id', $row->group_id);
            $this->session->set_userdata('online', '1');
            $this->session->set_userdata('profile_photo', $row->profile_photo);
            $this->session->set_userdata('password_status', $row->password_status);
            $update = array("online" => '1');
            $this->db->where('std_id', $row->std_id);
            $this->db->update('student', $update);

            redirect(base_url('student/dashboard'));
        }

        //check for sub admin
        $query = $this->db->get_where('sub_admin', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $this->session->set_userdata('subadmin_login', '1');
            $this->session->set_userdata('sub_admin_id', $row->sub_admin_id);
            $this->session->set_userdata('login_user_id', $row->sub_admin_id);
            $this->session->set_userdata('name', 'sub admin 1');
            $this->session->set_userdata('email', $row->email);
            $this->session->set_userdata('login_type', 'subadmin');
            redirect(base_url('sub_admin/dashboard'));
        }

        $query = $this->db->get_where('professor', $credential);
        if ($query->num_rows()) {
            $row = $query->row();
            $this->session->set_userdata('professor_login', '1');
            $this->session->set_userdata('login_user_id', $row->professor_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('email', $row->email);
            $this->session->set_userdata('branch', $row->branch);
            $this->session->set_userdata('department', $row->department);
            $this->session->set_userdata('login_type', 'professor');
            $this->session->set_userdata('image_path', $row->image_path);
            redirect(base_url('professor/dashboard'));
        }
        $this->flash_notification('danger', 'Invalid username or password');
        return 'invalid';
    }

    /**
     * Loggedin user dashboard
     * 
     * @return response
     */
    function user_dashboard() {
        $type = $this->session->userdata('login_type');

        if ($type == 'admin') {
            redirect(base_url('admin/dashboard'));
        } elseif ($type == 'student') {
            redirect(base_url('student/dashboard'));
        } elseif ($type == 'subadmin') {
            redirect(base_url('sub_admin'));
        } elseif ($type == 'professor') {
            redirect(base_url('professor/dashboard'));
        }
    }

    /**
     * Forgot password 
     * 
     * @return response
     */
    function forgot_password() {
        if ($_POST) {
            //check for student
            $record = $this->Site_model->is_user_email_present($_POST['email']);

            if ($record) {
                // send email for forgot password
                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'mayur.ghadiya@searchnative.in',
                    'smtp_pass' => 'the mayurz97375',
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1'
                );
                
                $user_id = '';
                //get the user id
                if($record->user_type == 'student')
                    $user_id = $record->std_id;
                elseif($record->user_type == 'admin')
                    $user_id = $record->admin_id;
                elseif($record->user_type == 'professor')
                    $user_id = $record->professor_id;
                
                $this->update_forgot_password_key($record->user_type, $user_id, $this->random_string_generate($record->user_type));
            } else {
                // email is not registered in the system
            }
            //check for admin
            //check for professor
        } else {
            redirect(base_url('site/user_login'));
        }
    }
    
    /**
     * Generate random string
     * @return string
     */
    function random_string_generate() {               
        return random_string('alnum', 16);
    }
    
    /**
     * Forgot password url
     * @param string $user_type
     * @param string $user_id
     * @param string $random_string
     * @return string
     */
    function forgot_password_url($user_type, $user_id, $random_string) {
        $this->load->helper('string');
        $this->load->library('encrypt');
        $base_url = base_url();
        $user_type = urlencode($this->encrypt->encode($user_type));
        
        return $base_url . 'reset_password/' . $user_id . '/' . $user_type . '/' . $random_string;
    }
    
    /**
     * Update forgot password key for user
     * @param string $user_type
     * @param string $user_id
     * @param string $key
     */
    function update_forgot_password_key($user_type, $user_id, $key) {
        if($user_type != '' && $user_id != '' && $key != '') {
            $this->Site_model->update_forgot_password_key($user_type, $user_id, $key);
        } else {
            redirect(base_url('site/user_login'));
        }
    }

    /**
     * Events actions
     * 
     * @return response
     */
    function events() {
        $this->data['title'] = 'Events';
        $this->data['events'] = $this->Site_model->all_events();
        $this->__template('events', $this->data);
    }

    /**
     * Alumni action
     * 
     * @return response
     */
    function alumni() {
        $this->data['title'] = 'Alumni';
        $this->__template('alumni', $this->data);
    }

    function forums() {
        $this->data['title'] = 'Forum';
        $this->db->where("forum_status", "1");
        $this->data['forums'] = $this->db->get("forum")->result();
        $this->__template('forum', $this->data);
    }

    function topics($param = '') {
        $this->data['title'] = 'Forum Topics';
        $this->db->where("forum_topic_status", "1");
        $this->db->where("forum_id", $param);


        $this->data['topics'] = $this->db->get("forum_topics")->result();
        $this->data['param'] = $param;
        $this->db->where("forum_id", $param);
        $this->data['forum'] = $this->db->get("forum")->result();
        $this->__template('topic', $this->data);
    }

    function viewtopic($param = '') {
        $this->data['title'] = 'Forum Topic Discussion';
        $this->db->where("forum_topic_status", "1");
        $this->db->where("forum_topic_id", $param);
        $this->data['param'] = $param;
        $this->data['topics'] = $this->db->get("forum_topics")->result();

        $this->data['comments'] = $this->db->get_where("forum_comment", array("forum_topic_id" => $param, "forum_comment_status" => '1'))->result();
        $this->__template('discussion', $this->data);
    }

    function comment($param = '') {
        if ($param == "create") {
            $data['forum_topic_id'] = $this->input->post('forum_topic_id');
            $data['forum_comments'] = $this->input->post('discussion');
            $data['forum_comment_status'] = '0';
            $data['user_role'] = $this->session->userdata('login_type');
            $data['user_role_id'] = $this->session->userdata('login_user_id');
            $this->Site_model->create_comment($data);
            $this->session->set_flashdata('message', ' Your comment has been queued for review by site administrators and will be published after approval.');
            redirect(base_url('index.php?site/viewtopic/' . $data['forum_topic_id']));
        }
    }

    function crudtopic($param = '') {
        if ($param = 'create') {
            $data['forum_id'] = $this->input->post('forum_id');
            $data['forum_topic_title'] = $this->input->post('subject');
            $data['forum_topic_desc'] = $this->input->post('discussion');
            $data['forum_topic_status'] = '0';
            $data['user_role'] = $this->session->userdata('login_type');
            $data['user_role_id'] = $this->session->userdata('login_user_id');

            $this->Site_model->create_topic($data);
            $this->session->set_flashdata('message', ' Your Topic has been queued for review by site administrators and will be published after approval.');
            redirect(base_url('index.php?site/topics/' . $data['forum_id']));
        }
    }

}
