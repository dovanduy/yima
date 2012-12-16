<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function index() {
        session_start();
        session_destroy();
        header('location: login');
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */