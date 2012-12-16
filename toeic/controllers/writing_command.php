<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Writing_command extends CI_Controller {

    public function index() {
        session_start();
        $this->load->helper('url');
        $this->load->database();

        $writing1 = addslashes($this->input->post('writing1'));
        $writing2 = addslashes($this->input->post('writing2'));
        
        $session_student_id = $_SESSION['session_student_id'];
        
        $this->db->query('update ' . $this->db->dbprefix('session_student') . ' set writing1="'.$writing1.'", writing2="'.$writing2.'" where id=' . $session_student_id);
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */