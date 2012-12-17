<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Speaking_command extends CI_Controller {

    public function index() {
        session_start();
        $this->load->helper('url');
        $this->load->database();
        
        $speaking_part = $this->input->post('speaking_part');
        $session_student_id = $_SESSION['session_student_id'];

        $fromfile = "sound.wav";
        //$filename = "admin/data/student/speaking/speaking_ss" . $session_student_id . "_" . $speaking_part . ".wav";
        
        //copy($fromfile, $filename);
        
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */