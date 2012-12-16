<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_command extends CI_Controller {

    private function build_step() {
        $index = -1;
        $test_order_value = explode(' - ', strtolower($_SESSION['test_order_value']));
        foreach ($test_order_value as $to) {
            switch ($to) {
                case 'reading':
                    $index++;
                    $steps[$index]['part'] = 'reading';
                    $steps[$index]['id'] = $_SESSION['mt_reading1'];
                    $steps[$index]['section'] = 1;

                    $index++;
                    $steps[$index]['part'] = 'reading';
                    $steps[$index]['id'] = $_SESSION['mt_reading2'];
                    $steps[$index]['section'] = 2;

                    $index++;
                    $steps[$index]['part'] = 'reading';
                    $steps[$index]['id'] = $_SESSION['mt_reading3'];
                    $steps[$index]['section'] = 3;
                    break;

                case 'listening':
                    $index++;
                    $steps[$index]['part'] = 'listening';
                    $steps[$index]['id'] = $_SESSION['mt_listening1'];
                    $steps[$index]['section'] = 1;

                    $index++;
                    $steps[$index]['part'] = 'listening';
                    $steps[$index]['id'] = $_SESSION['mt_listening2'];
                    $steps[$index]['section'] = 2;

                    $index++;
                    $steps[$index]['part'] = 'listening';
                    $steps[$index]['id'] = $_SESSION['mt_listening3'];
                    $steps[$index]['section'] = 3;

                    $index++;
                    $steps[$index]['part'] = 'listening';
                    $steps[$index]['id'] = $_SESSION['mt_listening4'];
                    $steps[$index]['section'] = 4;

                    $index++;
                    $steps[$index]['part'] = 'listening';
                    $steps[$index]['id'] = $_SESSION['mt_listening5'];
                    $steps[$index]['section'] = 5;

                    $index++;
                    $steps[$index]['part'] = 'listening';
                    $steps[$index]['id'] = $_SESSION['mt_listening6'];
                    $steps[$index]['section'] = 6;
                    break;

                case 'speaking':
                    $index++;
                    $steps[$index]['part'] = 'speaking';
                    break;

                case 'writing':
                    $index++;
                    $steps[$index]['part'] = 'writing';
                    break;
            }
        }
        $_SESSION['steps'] = $steps;
    }

    public function index() {
        session_start();
        $this->load->helper('url');
        $this->load->database();

        foreach ($_POST as $key => $value) {
            $$key = $this->input->post($key);
        }


        switch ($action) {
            case 'change_password':
                if ($password == $confirm) {
                    $student_id = $_SESSION['student_id'];
                    $this->db->query('UPDATE `user` SET  `password` =  "' . md5($password) . '" WHERE  `id` =' . $student_id);
                    $response['status'] = 'success';
                } else {
                    $response['status'] = 'fail';
                }
                echo json_encode($response);
                break;

            case 'select_session':
                $query = $this->db->query('SELECT *, (select t.title from ' . $this->db->dbprefix('test_order') . ' t where t.id=ss.test_order limit 0,1) as test_order_value
                        FROM ' . $this->db->dbprefix('session_student') . ' ss
                        where ss.session="' . $session_id . '" and ss.student="' . $_SESSION['student_id'] . '"');
                foreach ($query->result() as $row) {
                    $_SESSION['session_student_id'] = $row->id;
                    $_SESSION['test_order_value'] = $row->test_order_value;
                    $_SESSION['test_order'] = $row->test_order;
                    $_SESSION['status'] = $row->status;
                    $_SESSION['current_step'] = $row->current_step - 1;
                }

                $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('mixed_test') . ' mt where mt.id=(select mixed_test from ' . $this->db->dbprefix('session_student') . ' ss where session="' . $session_id . '" and student="' . $_SESSION['student_id'] . '"  limit 0,1)');
                foreach ($query->result() as $row) {
                    $_SESSION['mt_reading1'] = $row->reading1;
                    $_SESSION['mt_reading2'] = $row->reading2;
                    $_SESSION['mt_reading3'] = $row->reading3;

                    $_SESSION['mt_listening1'] = $row->listening1;
                    $_SESSION['mt_listening2'] = $row->listening2;
                    $_SESSION['mt_listening3'] = $row->listening3;
                    $_SESSION['mt_listening4'] = $row->listening4;
                    $_SESSION['mt_listening5'] = $row->listening5;
                    $_SESSION['mt_listening6'] = $row->listening6;

                    $_SESSION['mt_speaking1'] = $row->speaking1;
                    $_SESSION['mt_speaking2'] = $row->speaking2;
                    $_SESSION['mt_speaking3'] = $row->speaking3;
                    $_SESSION['mt_speaking4'] = $row->speaking4;
                    $_SESSION['mt_speaking5'] = $row->speaking5;
                    $_SESSION['mt_speaking6'] = $row->speaking6;

                    $_SESSION['mt_writing1'] = $row->writing1;
                    $_SESSION['mt_writing2'] = $row->writing2;
                }

                $this->build_step();

                break;

            case 'check_login':
                $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('user') . ' where title="' . $username . '" and password="' . md5($password) . '"');
                if ($query->num_rows) {
                    $response['status'] = 'success';

                    //set user info
                    foreach ($query->result() as $row) {
                        $_SESSION['student_id'] = $row->id;
                        $_SESSION['student_username'] = $row->title;
                        $_SESSION['student_firstname'] = $row->firstname;
                        $_SESSION['student_lastname'] = $row->lastname;
                    }
                    $student_id = $_SESSION['student_id'];

                    $query1 = $this->db->query('SELECT *, 
                           (select mt.title 
                            from ' . $this->db->dbprefix('session') . ' mt 
                            where ss.session=mt.id limit 0,1) as ss_title 
                        FROM ' . $this->db->dbprefix('session_student') . ' ss 
                        where ss.student="' . $student_id . '" and ss.deleted=0 and ss.disabled=0 and ss.status=0 order by ss.id desc');

                    $available_test = "<ul class='stats-summary'>";
                    foreach ($query1->result() as $row1) {
                        $available_test .= '<li class="session" alt="' . $row1->session . '">
                                    <p>' . $row1->ss_title . '</p>
                                    <a rel="tooltip" alt="' . $row1->session . '" title="Join This Session" class="button stats-view select_session" href="#">Select</a>
                                </li>';
                    }
                    $available_test .= "</ul>";

                    $response['available_test'] = $available_test;
                } else {
                    $response['status'] = 'fail';
                }
                echo json_encode($response);
                break;
        }
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */