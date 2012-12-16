<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Start extends CI_Controller {

    public function index() {
        session_start();
        $this->load->helper('url');
        $this->load->database();

        $step = $_SESSION['steps'];
        $current_step = $_SESSION['current_step'];
        $current_step++;
        $_SESSION['current_step'] = $current_step;
        
        $this->db->query('update ' . $this->db->dbprefix('session_student') . ' set current_step='.$current_step.' where id=' . $_SESSION['session_student_id']);

        $count_step = count($step);

        if ($current_step >= $count_step) {
            $this->db->query('update ' . $this->db->dbprefix('session_student') . ' set status=1 where id=' . $_SESSION['session_student_id']);
            header('location: end_test');
        } else {
            header('location: ' . $step[$current_step]['part']);
        }
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */