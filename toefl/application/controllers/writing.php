<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Writing extends CI_Controller {

    public function index($wid1,$wid2,$cid) {
        session_start();
        $this->load->helper('url');
        $this->load->database();
        $params = array('filename' => '');
        $this->load->library('mp3file', $params);

        /*$step = $_SESSION['steps'];
        $current_step = $_SESSION['current_step'];

        if (!isset($step[$current_step]['part']) || $step[$current_step]['part'] != 'writing')
            header('location: login');
        
        $data['session_student_id'] = $_SESSION['session_student_id'];

        $this->db->query('UPDATE session_student set refreshW=refreshW+1 where id=' . $data['session_student_id']);

        $wid1 = $_SESSION['mt_writing1'];
        $wid2 = $_SESSION['mt_writing2'];

        $data['student_id'] = $_SESSION['student_id'];
        $data['student_username'] = $_SESSION['student_username'];
        $data['student_firstname'] = $_SESSION['student_firstname'];
        $data['student_lastname'] = $_SESSION['student_lastname'];*/

        $data['writing1'] = $this->get_writing($wid1);
        $data['writing2'] = $this->get_writing($wid2);
        $data['wid1']= $wid1;
        $data['wid2']= $wid2;
        $data['cid']= $cid;

        $this->load->view('header');
        $this->load->view('writing/header', $data);
        $this->load->view('writing/main', $data);
        $this->load->view('writing/footer', $data);
        $this->load->view('footer');
    }

    private function get_writing($wid) {
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toefl_writing') . ' where id=' . $wid);
        foreach ($query->result() as $row) {
            $response['id'] = $row->id;
            $response['title'] = $row->title;
            $response['level'] = $row->level;
            $response['source'] = $row->source;
            $response['keyword'] = $row->keyword;
            $response['writing_part'] = $row->writing_part;

            $response['limg'] = $row->limg;
            $response['lsound'] = $row->lsound;
            if ($row->lsound == '') {
                $response['lsound_duration'] = 5;
            } else {
                $f = 'admin/data/sounds/writing/' . $row->lsound;
                if (file_exists($f)) {
                    $response['lsound_duration'] = sound_length($f) + 5;
                } else {
                    $response['lsound_duration'] = 5;
                }
            }

            $response['subject'] = $row->subject;
            $response['ssound'] = $row->ssound;
            if ($row->ssound == '') {
                $response['ssound_duration'] = 5;
            } else {
                $f = 'admin/data/sounds/writing/' . $row->ssound;
                if (file_exists($f)) {
                    $response['ssound_duration'] = sound_length($f) + 5;
                } else {
                    $response['ssound_duration'] = 5;
                }
            }

            $response['direction'] = $row->direction;

            $response['content'] = stripslashes($row->content);
        }
        return $response;
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */