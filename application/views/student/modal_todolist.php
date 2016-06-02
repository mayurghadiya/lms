<?php
echo $param2."<br>";
$data=$this->db->get_where('todo_list',array('todo_datetime'=>$param2,'todo_role'=>'student','todo_role_id'=>$this->session->userdata('student_id')))->result();
    echo $this->db->last_query();
print_r($data);
?>