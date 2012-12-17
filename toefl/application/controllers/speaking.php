<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Speaking extends CI_Controller {

    public function index($sid1, $sid2, $sid3, $sid4, $sid5, $sid6, $cid) {
        session_start();
        $this->load->helper('url');
        $this->load->database();
        /*  $params = array('filename' => '');
          $this->load->library('mp3file', $params);

          $step = $_SESSION['steps'];
          $current_step = $_SESSION['current_step'];

          if (!isset($step[$current_step]['part']) || $step[$current_step]['part'] != 'speaking')
          header('location: login');

          $sid1 = $_SESSION['mt_speaking1'];
          $sid2 = $_SESSION['mt_speaking2'];
          $sid3 = $_SESSION['mt_speaking3'];
          $sid4 = $_SESSION['mt_speaking4'];
          $sid5 = $_SESSION['mt_speaking5'];
          $sid6 = $_SESSION['mt_speaking6'];

          $data['session_student_id'] = $_SESSION['session_student_id'];

          $this->db->query('UPDATE session_student set refreshS=refreshS+1 where id=' . $data['session_student_id']);

          $data['student_id'] = $_SESSION['student_id'];
          $data['student_username'] = $_SESSION['student_username'];
          $data['student_firstname'] = $_SESSION['student_firstname'];
          $data['student_lastname'] = $_SESSION['student_lastname']; */

        $data['speaking1'] = $this->get_speaking($sid1);
        $data['speaking2'] = $this->get_speaking($sid2);
        $data['speaking3'] = $this->get_speaking($sid3);
        $data['speaking4'] = $this->get_speaking($sid4);
        $data['speaking5'] = $this->get_speaking($sid5);
        $data['speaking6'] = $this->get_speaking($sid6);
        $data['cid'] = $cid;

        $this->prepare_recorder();

        $this->load->view('header');
        $this->load->view('speaking/header', $data);
        $this->load->view('speaking/main', $data);
        $this->load->view('speaking/footer', $data);
        $this->load->view('footer');
    }

    private function copy_recorder($dir) {
        copy('record/example.wav', $dir . '/example.wav');
        chmod($dir . '/example.wav', 0777);

        copy('record/saveWav.php', $dir . '/saveWav.php');
        chmod($dir . '/saveWav.php', 0777);

        copy('record/sound.wav', $dir . '/sound.wav');
        chmod($dir . '/sound.wav', 0777);

        copy('record/voicerecorder.swf', $dir . '/voicerecorder.swf');
        chmod($dir . '/voicerecorder.swf', 0777);
    }

    private function create_config_recorder($dir) {
        $current = file_get_contents('record/config.xml');
        $current = str_replace('record/example.wav', $dir . '/example.wav', $current);
        $current = str_replace('record/saveWav.php', $dir . '/saveWav.php', $current);
        file_put_contents($dir . '/config.xml', $current);
        chmod($dir . '/config.xml', 0777);
    }

    private function prepare_recorder() {
        $session_student_id = $_SESSION['session_student_id'];
        $dir = "admin/data/student/speaking/" . $session_student_id;
        if (!file_exists($dir)) {
            mkdir($dir, 0, true);
            chmod($dir, 0777);
        }

        $dir = "admin/data/student/speaking/" . $session_student_id . '/01';
        if (!file_exists($dir)) {
            mkdir($dir, 0, true);
            chmod($dir, 0777);
            $this->copy_recorder($dir);
            $this->create_config_recorder($dir);
        }

        $dir = "admin/data/student/speaking/" . $session_student_id . '/02';
        if (!file_exists($dir)) {
            mkdir($dir, 0, true);
            chmod($dir, 0777);
            $this->copy_recorder($dir);
            $this->create_config_recorder($dir);
        }

        $dir = "admin/data/student/speaking/" . $session_student_id . '/04';
        if (!file_exists($dir)) {
            mkdir($dir, 0, true);
            chmod($dir, 0777);
            $this->copy_recorder($dir);
            $this->create_config_recorder($dir);
        }

        $dir = "admin/data/student/speaking/" . $session_student_id . '/05';
        if (!file_exists($dir)) {
            mkdir($dir, 0, true);
            chmod($dir, 0777);
            $this->copy_recorder($dir);
            $this->create_config_recorder($dir);
        }

        $dir = "admin/data/student/speaking/" . $session_student_id . '/07';
        if (!file_exists($dir)) {
            mkdir($dir, 0, true);
            chmod($dir, 0777);
            $this->copy_recorder($dir);
            $this->create_config_recorder($dir);
        }

        $dir = "admin/data/student/speaking/" . $session_student_id . '/08';
        if (!file_exists($dir)) {
            mkdir($dir, 0, true);
            chmod($dir, 0777);
            $this->copy_recorder($dir);
            $this->create_config_recorder($dir);
        }

        $dir = "admin/data/student/speaking/" . $session_student_id . '/09';
        if (!file_exists($dir)) {
            mkdir($dir, 0, true);
            chmod($dir, 0777);
            $this->copy_recorder($dir);
            $this->create_config_recorder($dir);
        }

        $dir = "admin/data/student/speaking/" . $session_student_id . '/10';
        if (!file_exists($dir)) {
            mkdir($dir, 0, true);
            chmod($dir, 0777);
            $this->copy_recorder($dir);
            $this->create_config_recorder($dir);
        }
    }

    private function get_speaking($sid) {
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toefl_speaking') . ' where id=' . $sid);
        foreach ($query->result() as $row) {
            $response['id'] = $row->id;
            $response['title'] = $row->title;
            $response['level'] = $row->level;
            $response['source'] = $row->source;
            $response['keyword'] = $row->keyword;
            $response['speaking_part'] = $row->speaking_part;

            $response['limg'] = $row->limg;
            $response['lsound'] = $row->lsound;
            if ($row->lsound == '') {
                $response['lsound_duration'] = 3;
            } else {
                $f = 'admin/data/sounds/speaking/' . $row->lsound;
                if (file_exists($f)) {
                    $response['lsound_duration'] = sound_length($f) + 3;
                } else {
                    $response['lsound_duration'] = 3;
                }
            }


            $response['subject'] = $row->subject;
            $response['ssound'] = $row->ssound;
            if ($row->ssound == '') {
                $response['ssound_duration'] = 3;
            } else {
                $f = 'admin/data/sounds/speaking/' . $row->ssound;
                if (file_exists($f)) {
                    $response['ssound_duration'] = sound_length($f) + 3;
                } else {
                    $response['ssound_duration'] = 3;
                }
            }


            $response['direction'] = $row->direction;
            $response['dsound'] = $row->dsound;
            if ($row->dsound == '') {
                $response['dsound_duration'] = 6;
            } else {
                $f = 'admin/data/sounds/speaking/' . $row->dsound;
                if (file_exists($f)) {
                    $response['dsound_duration'] = sound_length($f) + 6;
                } else {
                    $response['dsound_duration'] = 6;
                }
            }


            $response['introsound'] = $row->introsound;
            if ($row->introsound == '') {
                $response['introsound_duration'] = 3;
            } else {
                $f = 'admin/data/sounds/speaking/' . $row->introsound;
                if (file_exists($f)) {
                    $response['introsound_duration'] = sound_length($f) + 3;
                } else {
                    $response['introsound_duration'] = 3;
                }
            }


            $response['content'] = stripslashes($row->content);
        }
        return $response;
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */