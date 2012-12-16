<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        session_start();
        $this->load->helper('url');
        $this->load->database();

        //if (!isset($_SESSION['student_id']) || $_SESSION['student_id'] == '' || $_SESSION['student_id'] == '0') {
        header('location: login');
        //}

        //$this->load->view('welcome');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */