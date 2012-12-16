<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        $this->load->library('user_agent');
        if ($this->agent->browser() == 'Internet Explorer') {
            echo '<div style="text-align: center; margin: 20px; line-height: 20px; font-size: 14px;">Please use <strong>Google Chrome</strong> or <strong>Firefox</strong> instead of <strong>Internet Explorer</strong>.<br/>
                You can download Google Chrome or Firefox by clicking on these links <a href="https://www.google.com/chrome">Google Chrome</a> or <a href="http://www.mozilla.org/en-US/firefox/new/">Firefox</a>.
                    </div>';
        } else {
            session_start();
            $this->load->helper('url');
            $this->load->database();

            $this->load->view('header');
            $this->load->view('login');
            $this->load->view('footer');
        }
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */