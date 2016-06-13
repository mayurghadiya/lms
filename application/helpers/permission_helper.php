<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('user_role')) {

    /**
     * User Role 
     * @param string $user_type , 
     * @return string
     */
    function user_role() {
        $CI = & get_instance();
        $result = $CI->db->get_where('system_setting', [
            'type' => $type
        ]);

        if ($result->num_rows()) {
            return $result->row()->description;
        }

        return 'No data found';
    }

}
if (!function_exists('user_permission')) {

    /**
     * User Role 
     * @param string $user_type , 
     * @return string
     */
    function user_permission() {

        $CI = & get_instance();
         if($CI->uri->segment(2)!="")
        {
         
            $run = "FIND_IN_SET('".$CI->session->userdata('login_user_id')."', user_role)";
        $CI->db->where($run);
        $CI->db->where('user_type',$CI->session->userdata('login_type'));
        $user_role_query=$CI->db->get('group')->result_array();
        if(empty($user_role_query))
        {
            $url=base_url().$CI->session->userdata('login_type').'/dashboard';
           echo "<script>alert('You have not permission to access this page.'); window.location.href ='".$url."'</script>"; 
        }
        else
        {
            $module_role_query = $CI->db->get_where('assign_module' , array('group_id' => $user_role_query[0]['g_id']))->row();
         $assign_module_id=explode(',',$module_role_query->module_id);
        foreach($assign_module_id as $assign_module_id_row)
        {
                 $module_role_query_final = $CI->db->get_where('modules' , array('module_id' => $assign_module_id_row))->result_array();
//                
//                 foreach($module_role_query_final as $module_role_query_row)
//                 {	
                        $final_module_assgin[] = $module_role_query_final[0]['module_name_file'];
                 //}
        }
       
        if(!in_array($CI->uri->segment(2),$final_module_assgin))
        {
            //echo 'iffffffff';
           $url=base_url().$CI->session->userdata('login_type').'/dashboard';
           echo "<script>alert('You have not permission to access this page.'); window.location.href ='".$url."'</script>";
        }
//        echo $CI->uri->segment(2);
//       exit;
        }
        

        }

//        if ($CI->uri->segment(2) != "") {
//
//            $run = "FIND_IN_SET('" . $CI->session->userdata('login_user_id') . "', user_role)";
//            $CI->db->where($run);
//            $CI->db->where('user_type', $CI->session->userdata('login_type'));
//            $user_role_query = $CI->db->get('group')->result_array();
//            
//            if (empty($user_role_query)) {
//                $url = base_url() . $CI->session->userdata('login_type') . '/dashboard';
//                echo "<script>alert('You have not permission to access this page.'); window.location.href ='" . $url . "'</script>";
//            } else {
//                $module_role_query = $CI->db->get_where('assign_module', array('group_id' => $user_role_query[0]['g_id']))->row();
//                $assign_module_id = explode(',', $module_role_query->module_id);
//                $modules = $CI->db->select('module_name_file')->from('modules')->where_in($assign_module_id)->get()->result();
//                $final_module_assignment = array();
//                foreach ($modules as $row) {
//                    array_push($final_module_assignment, $row->module_name_file);
//                }
//
//                if (!in_array($CI->uri->segment(2), $final_module_assignment)) {
//                    $url = base_url() . $CI->session->userdata('login_type') . '/dashboard';
//                    echo "<script>alert('You have not permission to access this page.'); window.location.href ='" . $url . "'</script>";
//                }
//            }
//        }
    }

}
    