<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $data = array();

    /**
     * Constructor
     * 
     * @return void
     */
    function __construct() {
        parent::__construct();
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");

        //load laguage file
        $this->load->language('lms');
        $this->data['title'] = 'Dashboard';
    }

    /**
     * Template file for users
     * @param string $view
     * @param mixed $data
     */
    function __site_template($view, $data) {
        $files = $this->login_user_type();
        $this->load->view($files['header_file'], $this->data);
        $this->load->view($view);
        $this->load->view($files['footer_file'], $this->data);
        //footer
    }

    function system_setting() {
        //fetch the system settings
    }

    /**
     * Check which user loggedin
     * @return mixed
     */
    function login_user_type() {
        $user_type = $this->session->userdata('login_type');

        switch ($user_type) {
            case 'admin':
                $this->data['header_file'] = 'admin/header';
                $this->data['footer_file'] = 'admin/footer';
                break;
            case 'student':
                $this->data['header_file'] = 'student/header';
                $this->data['footer_file'] = 'student/footer';
                break;
            case 'professor':
                $this->data['header_file'] = 'professor/header';
                $this->data['footer_file'] = 'professor/footer';
                break;
        }

        return $this->data;
    }

    /**
     * Flash notification
     * @param string $type
     * @param string $message
     */
    function flash_notification($type, $message) {
        $notification = [
            'type' => $type,
            'message' => $message
        ];
        $this->session->set_flashdata($notification);
    }

    /**
     * Get language message
     * @param string $lang
     * @return string
     */
    function lang_message($lang = '') {
        return $this->lang->line($lang);
    }

}
