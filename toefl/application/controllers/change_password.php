<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Change_password extends CI_Controller {

    public function index() {
        session_start();
        $this->load->helper('url');
        $this->load->database();

        $this->load->view('header');
        $this->load->view('change_password');
        $this->load->view('footer');
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */