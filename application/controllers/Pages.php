<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {
    
    /**
     * CMS page routing
     * @param type $page
     */
    public function view($page = '', $type = '') {
        $this->data['news'] = $this->db->get_where('cms_manager', [
            'c_status'  => 1,
            'c_slug'    => $type
        ])->result_array();
        $this->data['title'] = $this->data['news'][0]['c_title'];
        $this->__site_template('student/' . $page, $this->data);
    }

}
