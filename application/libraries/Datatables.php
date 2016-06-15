<?php

class Datatables {
    
    protected $CI;
            
    function __construct() {
        $this->CI = & get_instance();
    }

    /**
     * Admin student datatable
     */
    function admin_student_datable($where = array()) {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('profile_photo', 'std_roll', 'std_first_name', 'std_last_name', 'email', 'std_mobile', 'address');

        // DB table to use
        $sTable = 'student';
        //

        $iDisplayStart = $this->CI->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->CI->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->CI->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->CI->input->get_post('iSortingCols', true);
        $sSearch = $this->CI->input->get_post('sSearch', true);
        $sEcho = $this->CI->input->get_post('sEcho', true);

        // Paging
        if (isset($iDisplayStart) && $iDisplayLength != '-1') {
            $this->CI->db->limit($this->CI->db->escape_str($iDisplayLength), $this->CI->db->escape_str($iDisplayStart));
        }

        // Ordering
        if (isset($iSortCol_0)) {
            for ($i = 0; $i < intval($iSortingCols); $i++) {
                $iSortCol = $this->CI->input->get_post('iSortCol_' . $i, true);
                $bSortable = $this->CI->input->get_post('bSortable_' . intval($iSortCol), true);
                $sSortDir = $this->CI->input->get_post('sSortDir_' . $i, true);

                if ($bSortable == 'true') {
                    $this->CI->db->order_by($aColumns[intval($this->CI->db->escape_str($iSortCol))], $this->CI->db->escape_str($sSortDir));
                }
            }
        }

        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        if (isset($sSearch) && !empty($sSearch)) {
            for ($i = 0; $i < count($aColumns); $i++) {
                $bSearchable = $this->CI->input->get_post('bSearchable_' . $i, true);

                // Individual column filtering
                if (isset($bSearchable) && $bSearchable == 'true') {
                    $this->CI->db->or_like($aColumns[$i], $this->CI->db->escape_like_str($sSearch));
                }
            }
        }

        // Select Data
        $this->CI->db->select('SQL_CALC_FOUND_ROWS ' . str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $this->CI->db->join("degree", "degree.d_id = $sTable.std_degree");
        $this->CI->db->where($where);
        $rResult = $this->CI->db->get($sTable);

        // Data set length after filtering
        $this->CI->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->CI->db->get()->row()->found_rows;

        // Total data set length
        $iTotal = $this->CI->db->count_all($sTable);

        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );

        foreach ($rResult->result_array() as $aRow) {
            $row = array();

            foreach ($aColumns as $col) {
                $row[] = $aRow[$col];
            }
            $link = '<a href="#" onclick="showAjaxModal(\'' . base_url() . 'modal/popup/modal_edit_student/' . $row[0] . '\')" data-original-title="edit" data-toggle="tooltip" data-placement="top"><span class="label label-primary mr6 mb6"></span><i class="fa fa-pencil"></i>View</a>';
            array_push($row, $link);
            $output['aaData'][] = $row;
        }

        echo json_encode($output);
    }

}
