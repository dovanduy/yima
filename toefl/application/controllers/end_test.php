<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class End_test extends CI_Controller {

    public function index() {
        session_start();
        $this->load->helper('url');
        $this->load->database();
        
        $wid1 = $_SESSION['mt_writing1'];
        $wid2 = $_SESSION['mt_writing2'];
        
        $data['student_id'] = $_SESSION['student_id'];
        $data['student_username'] = $_SESSION['student_username'];
        $data['student_firstname'] = $_SESSION['student_firstname'];
        $data['student_lastname'] = $_SESSION['student_lastname'];

        $this->load->view('header');
        $this->load->view('end_test', $data);
        $this->load->view('footer');
    }
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */