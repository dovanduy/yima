<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Listening_command extends CI_Controller {

    public function index() {
        session_start();
        $this->load->helper('url');
        $this->load->database();

        $data['scq_id'] = $this->input->post('scq_id');
        $data['scq_choice'] = $this->input->post('scq_choice');
        
        $data['mcq_id'] = $this->input->post('mcq_id');
        $data['mcq_choice'] = $this->input->post('mcq_choice');
        
        $data['cq_id'] = $this->input->post('cq_id');
        $data['cq_choice'] = $this->input->post('cq_choice');
        
        $data['oq_id'] = $this->input->post('oq_id');
        $data['oq_choice'] = $this->input->post('oq_choice');
        
        
        $all_data=addslashes(serialize($data));
        
        $session_student_id = $_SESSION['session_student_id'];
        
        
        $step = $_SESSION['steps'];
        $current_step = $_SESSION['current_step'];
        $section = $step[$current_step]['section'];
        $this->db->query('update ' . $this->db->dbprefix('session_student') . ' set listening'.$section.'="'.$all_data.'" where id=' . $session_student_id);
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */