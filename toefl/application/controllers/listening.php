<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Listening extends CI_Controller {

    private $number_question = 0;

    public function index($lid, $part, $cid) {
        session_start();
        $this->load->helper('url');
        $this->load->database();


        /* $step = $_SESSION['steps'];
          $current_step = $_SESSION['current_step'];

          if (!isset($step[$current_step]['part']) || $step[$current_step]['part'] != 'listening')
          header('location: login');

          $data['session_student_id'] = $_SESSION['session_student_id'];
          $this->db->query('UPDATE session_student set refreshL=refreshL+1 where id=' . $data['session_student_id']);

          $lid = $step[$current_step]['id'];

          $data['student_id'] = $_SESSION['student_id'];
          $data['student_username'] = $_SESSION['student_username'];
          $data['student_firstname'] = $_SESSION['student_firstname'];
          $data['student_lastname'] = $_SESSION['student_lastname'];
         */
        $data['listening'] = $this->get_listening($lid);
        $data['listening_video'] = $this->get_video($lid);
        $data['listening_scq'] = $this->get_scq($lid);
        $data['listening_mcq'] = $this->get_mcq($lid);
        $data['listening_cq'] = $this->get_cq($lid);
        $data['listening_oq'] = $this->get_oq($lid);
        $data['cid'] = $cid;
        $data['number_question'] = $this->number_question;

//SCQ
        $scq_id_arr;
        if ($data['listening_scq']) {
            foreach ($data['listening_scq'] as $listening_scq) {
                $scq_id_arr[] = $listening_scq['id'];
            }
            $data['listening_scq_arr'] = implode(',', $scq_id_arr);
        } else {
            $data['listening_scq_arr'] = '0';
        }

//MCQ
        $mcq_id_arr;
        if ($data['listening_mcq']) {
            foreach ($data['listening_mcq'] as $listening_mcq) {
                $mcq_id_arr[] = $listening_mcq['id'];
            }
            $data['listening_mcq_arr'] = implode(',', $mcq_id_arr);
        } else {
            $data['listening_mcq_arr'] = '0';
        }

//CQ
        $cq_id_arr;
        if ($data['listening_cq']) {
            foreach ($data['listening_cq'] as $listening_cq) {
                $cq_id_arr[] = $listening_cq['id'];
            }
            $data['listening_cq_arr'] = implode(',', $cq_id_arr);
        } else {
            $data['listening_cq_arr'] = '0';
        }

        $data['lid'] = $lid;
        $data['part'] = $part;

//CQ
        $cq_id_arr;
        if ($data['listening_oq']) {
            foreach ($data['listening_oq'] as $listening_oq) {
                $oq_id_arr[] = $listening_oq['id'];
            }
            $data['listening_oq_arr'] = implode(',', $oq_id_arr);
        } else {
            $data['listening_oq_arr'] = '0';
        }

        $this->load->view('header');
        $this->load->view('listening/header', $data);
        $this->load->view('listening/main', $data);
        $this->load->view('listening/scq', $data);
        $this->load->view('listening/mcq', $data);
        $this->load->view('listening/cq', $data);
        $this->load->view('listening/oq', $data);
        $this->load->view('listening/footer', $data);
        $this->load->view('footer');
    }

    private function get_listening($lid) {
        $query = $this->db->query('SELECT *, (select v.limg from ' . $this->db->dbprefix('yima_toefl_listening_video') . ' v where v.lid=l.id order by time limit 0,1) as video FROM ' . $this->db->dbprefix('yima_toefl_listening') . ' l where l.id=' . $lid);

        foreach ($query->result() as $row) {
            $response['id'] = $row->id;
            $response['title'] = $row->title;
            $response['level'] = $row->level;

            $response['test_time'] = $row->test_time;
            $minute = floor($row->test_time / 60);
            $second = floor($row->test_time - $minute * 60);
            $response['test_time_lbl'] = str_pad($minute, 2, "0", STR_PAD_LEFT) . ' : ' . str_pad($second, 2, "0", STR_PAD_LEFT);

            $response['video'] = $row->video;
            $response['keyword'] = $row->keyword;
            $response['source'] = $row->source;
            $response['listening_part'] = $row->listening_part;
            $response['listening_type'] = $row->listening_type;

            $response['lsound'] = $row->lsound;
            $f = HelperURL::upload_url() . "audio/toefl/listening/listening_page/" . $row->lsound;
//$f = 'admin/data/sounds/listening/listening_page/' . $row->lsound;
            if (file_exists($f)) {
                $response['lsound_duration'] = sound_length($f) + 3;
            } else {
                $response['lsound_duration'] = 3;
            }
        }
        return $response;
    }

    private function get_video($lid) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toefl_listening_video') . ' where deleted=0 and lid=' . $lid . ' order by time');
        foreach ($query->result_array() as $rows) {
            $question[] = array(
                'id' => $rows['id'],
                'title' => $rows['title'],
                'limg' => $rows['limg'],
                'time' => $rows['time'],
            );
        }
        if (isset($question))
            return $question;
    }

    private function get_scq($lid) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toefl_listening_scq') . ' where deleted=0 and lid=' . $lid);
        foreach ($query->result_array() as $rows) {
            $f = HelperURL::upload_url() . "audio/toefl/listening/scq/" . $rows['lsound'];
//$f = 'admin/data/sounds/listening/scq/' . $rows['lsound'];
            if (file_exists($f)) {
                $length = sound_length($f) + 3;
            } else {
                $length = 3;
            }
            $f = HelperURL::upload_url() . "audio/toefl/listening/scq/" . $rows['sentence_sound'];
// $f = 'admin/data/sounds/listening/sentence_sound/scq/' . $rows['sentence_sound'];
            if (file_exists($f)) {
                $sentence_length = sound_length($f) + 3;
            } else {
                $sentence_length = 3;
            }


            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'choice1' => $rows['choice1'],
                'choice2' => $rows['choice2'],
                'choice3' => $rows['choice3'],
                'choice4' => $rows['choice4'],
                'answer' => $rows['answer'],
                'replay' => $rows['replay'],
                'replay_from' => $rows['replay_from'],
                'replay_to' => $rows['replay_to'],
                'replay_sound' => $rows['replay_sound'],
                'sentence' => $rows['sentence'],
                'sentence_sound' => $rows['sentence_sound'],
                'sentence_sound_duration' => $sentence_length,
                'lsound' => $rows['lsound'],
                'lsound_duration' => $length,
            );
        }
        if (isset($question))
            return $question;
    }

    private function get_mcq($lid) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toefl_listening_mcq') . ' where deleted=0 and lid=' . $lid);
        foreach ($query->result_array() as $rows) {
            $f = HelperURL::upload_url() . "audio/toefl/listening/mcq/" . $rows['lsound'];
//$f = 'admin/data/sounds/listening/mcq/' . $rows['lsound'];
            if (file_exists($f)) {
                $length = sound_length($f) + 3;
            } else {
                $length = 3;
            }
            $f = HelperURL::upload_url() . "audio/toefl/listening/mcq/" . $rows['sentence_sound'];
            //$f = 'admin/data/sounds/listening/sentence_sound/mcq/' . $rows['sentence_sound'];
            if (file_exists($f)) {
                $sentence_length = sound_length($f) + 3;
            } else {
                $sentence_length = 3;
            }

            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'choice1' => $rows['choice1'],
                'choice2' => $rows['choice2'],
                'choice3' => $rows['choice3'],
                'choice4' => $rows['choice4'],
                'answer' => $rows['answer'],
                'replay' => $rows['replay'],
                'replay_from' => $rows['replay_from'],
                'replay_to' => $rows['replay_to'],
                'replay_sound' => $rows['replay_sound'],
                'sentence' => $rows['sentence'],
                'sentence_sound' => $rows['sentence_sound'],
                'sentence_sound_duration' => $sentence_length,
                'lsound' => $rows['lsound'],
                'lsound_duration' => $length,
            );
        }
        if (isset($question))
            return $question;
    }

    private function get_cq($lid) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toefl_listening_cq') . ' where deleted=0 and lid=' . $lid);
        foreach ($query->result_array() as $rows) {
            $f = HelperURL::upload_url() . "audio/toefl/listening/cq" . $rows['sentence_sound'];
            //$f = 'admin/data/sounds/listening/cq/' . $rows['lsound'];
            if (file_exists($f)) {
                $length = sound_length($f) + 3;
            } else {
                $length = 3;
            }
            $f = HelperURL::upload_url() . "audio/toefl/listening/cq" . $rows['sentence_sound'];
            //$f = 'admin/data/sounds/listening/sentence_sound/cq/' . $rows['sentence_sound'];
            if (file_exists($f)) {
                $sentence_length = sound_length($f) + 3;
            } else {
                $sentence_length = 3;
            }

            $table = '<table><tr><td></td>';

            if (isset($col))
                unset($col);
            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toefl_listening_cq_column') . ' where deleted=0 and cqid=' . $rows['id']);
            foreach ($query1->result_array() as $rows1) {
                $table.='<td class="center">' . $rows1['title'] . '</td>';
                $col[] = $rows1['id'];
            }
            $table.='</tr>';

            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toefl_listening_cq_row') . ' where deleted=0 and cqid=' . $rows['id']);
            foreach ($query1->result_array() as $rows1) {
                $table.='<tr class="cq' . $rows['id'] . '" alt="' . $rows1['id'] . '"><td>' . $rows1['title'] . '</td>';
                foreach ($col as $c) {
                    $table.='<td class="center"><input type="radio" class="table_radio" name="row' . $rows1['id'] . '" alt="' . $rows1['id'] . '" value="' . $c . '" /></td>';
                }
                $table.='</tr>';
            }

            $table.='</table>';

            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'content' => stripslashes($rows['content']),
                'table' => $table,
                'replay' => $rows['replay'],
                'replay_from' => $rows['replay_from'],
                'replay_to' => $rows['replay_to'],
                'replay_sound' => $rows['replay_sound'],
                'sentence' => $rows['sentence'],
                'sentence_sound' => $rows['sentence_sound'],
                'sentence_sound_duration' => $sentence_length,
                'lsound' => $rows['lsound'],
                'lsound_duration' => $length,
            );
        }
        if (isset($question))
            return $question;
    }

    private function get_oq($lid) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toefl_listening_oq') . ' where deleted=0 and lid=' . $lid);
        foreach ($query->result_array() as $rows) {
            $f = HelperURL::upload_url() . "/audio/toefl/listening/oq/" . $rows['lsound'];
            //$f = 'admin/data/sounds/listening/oq/' . $rows['lsound'];
            if (file_exists($f)) {
                $length = sound_length($f) + 3;
            } else {
                $length = 3;
            }

            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'choice1' => $rows['choice1'],
                'choice2' => $rows['choice2'],
                'choice3' => $rows['choice3'],
                'choice4' => $rows['choice4'],
                'lsound' => $rows['lsound'],
                'lsound_duration' => $length,
            );
        }
        if (isset($question))
            return $question;
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */