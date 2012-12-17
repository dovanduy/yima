<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Listening extends CI_Controller {

    private $number_question = 0;

    public function index($lid,$cid) {
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
        $data['student_lastname'] = $_SESSION['student_lastname'];*/

        $data['listening'] = $this->get_listening($lid);
        //$data['listening_video'] = $this->get_video($lid);
        $data['listening_part1'] = $this->get_part1($lid);
//        $data['listening_part2'] = $this->get_part2($lid);
   //     $data['listening_part3'] = $this->get_part3($lid);
//        $data['listening_part4'] = $this->get_part4($lid);
        //$data['listening_mcq'] = $this->get_mcq($lid);
        //$data['listening_cq'] = $this->get_cq($lid);
        //$data['listening_oq'] = $this->get_oq($lid);

        $data['number_question'] = $this->number_question;

//        $scq_id_arr;
//        if ($data['listening_part1']) {
//            foreach ($data['listening_part1'] as $listening_part1) {
//                $scq_id_arr[] = $listening_part1['id'];
//            }
//            $data['listening_scq_arr'] = implode(',', $scq_id_arr);
//        } else {
//            $data['listening_scq_arr'] = '0';
//        }
        
        $part1_arr = array();
        if ($data['listening_part1']) {
            
            foreach ($data['listening_part1'] as $listening_part1) {
                $part1_arr[] = $listening_part1['id'];
            }
            $data['part1_arr'] = implode(',', $part1_arr);
            
        } else {
            $data['part1_arr'] = '0';
        }
        
        if ($data['listening_part2']) {
            
            foreach ($data['listening_part2'] as $listening_part2) {
                $part2_arr[] = $listening_part2['id'];
            }
            $data['part2_arr'] = implode(',', $part2_arr);
            
        } else {
            $data['part2_arr'] = '0';
        }
$part1_arr2 = array();
       //print_r($data['part1_arr'] );die;

        $this->load->view('header');
        $this->load->view('listening/header', $data);
        $this->load->view('listening/main', $data);
       $this->load->view('listening/part1', $data);
//        $this->load->view('listening/part2', $data);
       // $this->load->view('listening/part3', $data);
   //     $this->load->view('listening/part4', $data);

//        $this->load->view('listening/footer', $data);
        $this->load->view('footer');
    }

    private function get_listening($lid) {
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_listening') . ' l where l.id=' . $lid);
        foreach ($query->result() as $row) {
            $response['id'] = $row->id;
            $response['title'] = $row->title;
            $response['level'] = $row->level;

            $response['test_time'] = $row->test_time;
            $minute = floor($row->test_time / 60);
            $second = floor($row->test_time - $minute * 60);
            $response['test_time_lbl'] = str_pad($minute, 2, "0", STR_PAD_LEFT) . ' : ' . str_pad($second, 2, "0", STR_PAD_LEFT);

            //$response['video'] = $row->video;
            $response['keyword'] = $row->keyword;
            $response['source'] = $row->source;
            //$response['listening_part'] = $row->listening_part;
            //$response['listening_type'] = $row->listening_type;

            //$response['lsound'] = $row->lsound;
            //$f = 'admin/data/sounds/listening/listening_page/' . $row->lsound;
//            if (file_exists($f)) {
//                $response['lsound_duration'] = sound_length($f) + 3;
//            } else {
//                $response['lsound_duration'] = 3;
//            }
        }
        return $response;
    }

//    private function get_video($lid) {
//        $question;
//        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_listening_video') . ' where deleted=0 and lid=' . $lid . ' order by time');
//        foreach ($query->result_array() as $rows) {
//            $question[] = array(
//                'id' => $rows['id'],
//                'title' => $rows['title'],
//                'limg' => $rows['limg'],
//                'time' => $rows['time'],
//            );
//        }
//        if (isset($question))
//            return $question;
//    }

    private function get_part1($lid) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_listening_part1') . ' where deleted=0 and lid=' . $lid);
        
        
        foreach ($query->result_array() as $rows) {
            $f = HelperURL::upload_url(). $rows['lsound'];
            if (file_exists($f)) {
                $length = sound_length($f) + 3;
            } else {
                $length = 3;
            }
//
//            $f = 'admin/data/sounds/listening/sentence_sound/scq/' . $rows['sentence_sound'];
//            if (file_exists($f)) {
//                $sentence_length = sound_length($f) + 3;
//            } else {
//                $sentence_length = 3;
//            }

       
                $thumbnail = unserialize($rows['thumbnail']);
                $img = HelperURL::upload_url().'media/'.$thumbnail['full']['folder'].'/'.$thumbnail['full']['filename'];
                
            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'choice1' => 'A',
                'choice2' => 'B',
                'choice3' => 'C',
                'choice4' => 'D',
                'answer' => $rows['answer'],
                'img'=>$img,

                'lsound' => $rows['lsound'],
                'lsound_duration' => $length,
            );
        }
        //print_r($question);die;
        if (isset($question))
            return $question;
    }
    
    private function get_part2($lid) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_listening_part2') . ' where deleted=0 and lid=' . $lid);
        
        
        foreach ($query->result_array() as $rows) {
            $f = HelperURL::upload_url(). $rows['lsound'];
            if (file_exists($f)) {
                $length = sound_length($f) + 3;
            } else {
                $length = 3;
            }
//
//            $f = 'admin/data/sounds/listening/sentence_sound/scq/' . $rows['sentence_sound'];
//            if (file_exists($f)) {
//                $sentence_length = sound_length($f) + 3;
//            } else {
//                $sentence_length = 3;
//            }

       
               
                
            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'choice1' => 'A',
                'choice2' => 'B',
                'choice3' => 'C',
                'choice4' => 'D',
                'answer' => $rows['answer'],
                
//                'replay' => $rows['replay'],
//                'replay_from' => $rows['replay_from'],
//                'replay_to' => $rows['replay_to'],
//                'replay_sound' => $rows['replay_sound'],
//                'sentence' => $rows['sentence'],
//                'sentence_sound' => $rows['sentence_sound'],
//                'sentence_sound_duration' => $sentence_length,
                'lsound' => $rows['lsound'],
                'lsound_duration' => $length,
            );
        }
        //print_r($question);die;
        if (isset($question))
            return $question;
    }
    
    private function get_part3($lid) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_listening_part3') . ' where deleted=0 and lid=' . $lid);
        
       
        foreach ($query->result_array() as $rows) {
            $f = HelperURL::upload_url(). $rows['lsound'];
            if (file_exists($f)) {
                $length = sound_length($f) + 3;
            } else {
                $length = 3;
            }
        
            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                   
                'question_1' => $rows['question_1'],
                'choice1_1' => $rows['choice1_1'],
                'choice2_1' => $rows['choice2_1'],
                'choice3_1' => $rows['choice3_1'],
                'choice4_1' => $rows['choice4_1'],
                
                'question_2' => $rows['question_2'],
                'choice1_2' => $rows['choice1_2'],
                'choice2_2' => $rows['choice2_2'],
                'choice3_2' => $rows['choice3_2'],
                'choice4_2' => $rows['choice4_2'],
                
                'question_3' => $rows['question_3'],
                'choice1_3' => $rows['choice1_3'],
                'choice2_3' => $rows['choice2_3'],
                'choice3_3' => $rows['choice3_3'],
                'choice4_3' => $rows['choice4_3'],
                
                'lsound' => $rows['lsound'],
                'lsound_duration' => $length,
            );
        }
        //print_r($question);die;
        if (isset($question))
            return $question;
    }
    
    private function get_part4($lid) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_listening_part4') . ' where deleted=0 and lid=' . $lid);
        
       
        foreach ($query->result_array() as $rows) {
            $f = HelperURL::upload_url(). $rows['lsound'];
            if (file_exists($f)) {
                $length = sound_length($f) + 3;
            } else {
                $length = 3;
            }
        
            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                   
                'question_1' => $rows['question_1'],
                'choice1_1' => $rows['choice1_1'],
                'choice2_1' => $rows['choice2_1'],
                'choice3_1' => $rows['choice3_1'],
                'choice4_1' => $rows['choice4_1'],
                
                'question_2' => $rows['question_2'],
                'choice1_2' => $rows['choice1_2'],
                'choice2_2' => $rows['choice2_2'],
                'choice3_2' => $rows['choice3_2'],
                'choice4_2' => $rows['choice4_2'],
                
                'question_3' => $rows['question_3'],
                'choice1_3' => $rows['choice1_3'],
                'choice2_3' => $rows['choice2_3'],
                'choice3_3' => $rows['choice3_3'],
                'choice4_3' => $rows['choice4_3'],
                
                'lsound' => $rows['lsound'],
                'lsound_duration' => $length,
            );
        }
        //print_r($question);die;
        if (isset($question))
            return $question;
    }

//    private function get_mcq($lid) {
//        $question;
//        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_listening_mcq') . ' where deleted=0 and lid=' . $lid);
//        foreach ($query->result_array() as $rows) {
//            $f = 'admin/data/sounds/listening/mcq/' . $rows['lsound'];
//            if (file_exists($f)) {
//                $length = sound_length($f) + 3;
//            } else {
//                $length = 3;
//            }
//
//            $f = 'admin/data/sounds/listening/sentence_sound/mcq/' . $rows['sentence_sound'];
//            if (file_exists($f)) {
//                $sentence_length = sound_length($f) + 3;
//            } else {
//                $sentence_length = 3;
//            }
//
//            $this->number_question++;
//            $question[] = array(
//                'number_question' => $this->number_question,
//                'id' => $rows['id'],
//                'title' => $rows['title'],
//                'choice1' => $rows['choice1'],
//                'choice2' => $rows['choice2'],
//                'choice3' => $rows['choice3'],
//                'choice4' => $rows['choice4'],
//                'answer' => $rows['answer'],
//                'replay' => $rows['replay'],
//                'replay_from' => $rows['replay_from'],
//                'replay_to' => $rows['replay_to'],
//                'replay_sound' => $rows['replay_sound'],
//                'sentence' => $rows['sentence'],
//                'sentence_sound' => $rows['sentence_sound'],
//                'sentence_sound_duration' => $sentence_length,
//                'lsound' => $rows['lsound'],
//                'lsound_duration' => $length,
//            );
//        }
//        if (isset($question))
//            return $question;
//    }
//
//    private function get_cq($lid) {
//        $question;
//        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_listening_cq') . ' where deleted=0 and lid=' . $lid);
//        foreach ($query->result_array() as $rows) {
//            $f = 'admin/data/sounds/listening/cq/' . $rows['lsound'];
//            if (file_exists($f)) {
//                $length = sound_length($f) + 3;
//            } else {
//                $length = 3;
//            }
//
//            $f = 'admin/data/sounds/listening/sentence_sound/cq/' . $rows['sentence_sound'];
//            if (file_exists($f)) {
//                $sentence_length = sound_length($f) + 3;
//            } else {
//                $sentence_length = 3;
//            }
//
//            $table = '<table><tr><td></td>';
//
//            if (isset($col))
//                unset($col);
//            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_listening_cq_column') . ' where deleted=0 and cqid=' . $rows['id']);
//            foreach ($query1->result_array() as $rows1) {
//                $table.='<td class="center">' . $rows1['title'] . '</td>';
//                $col[] = $rows1['id'];
//            }
//            $table.='</tr>';
//
//            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_listening_cq_row') . ' where deleted=0 and cqid=' . $rows['id']);
//            foreach ($query1->result_array() as $rows1) {
//                $table.='<tr class="cq' . $rows['id'] . '" alt="' . $rows1['id'] . '"><td>' . $rows1['title'] . '</td>';
//                foreach ($col as $c) {
//                    $table.='<td class="center"><input type="radio" class="table_radio" name="row' . $rows1['id'] . '" alt="' . $rows1['id'] . '" value="' . $c . '" /></td>';
//                }
//                $table.='</tr>';
//            }
//
//            $table.='</table>';
//
//            $this->number_question++;
//            $question[] = array(
//                'number_question' => $this->number_question,
//                'id' => $rows['id'],
//                'title' => $rows['title'],
//                'content' => stripslashes($rows['content']),
//                'table' => $table,
//                'replay' => $rows['replay'],
//                'replay_from' => $rows['replay_from'],
//                'replay_to' => $rows['replay_to'],
//                'replay_sound' => $rows['replay_sound'],
//                'sentence' => $rows['sentence'],
//                'sentence_sound' => $rows['sentence_sound'],
//                'sentence_sound_duration' => $sentence_length,
//                'lsound' => $rows['lsound'],
//                'lsound_duration' => $length,
//            );
//        }
//        if (isset($question))
//            return $question;
//    }
//
//    private function get_oq($lid) {
//        $question;
//        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_listening_oq') . ' where deleted=0 and lid=' . $lid);
//        foreach ($query->result_array() as $rows) {
//            $f = 'admin/data/sounds/listening/oq/' . $rows['lsound'];
//            if (file_exists($f)) {
//                $length = sound_length($f) + 3;
//            } else {
//                $length = 3;
//            }
//
//            $this->number_question++;
//            $question[] = array(
//                'number_question' => $this->number_question,
//                'id' => $rows['id'],
//                'title' => $rows['title'],
//                'choice1' => $rows['choice1'],
//                'choice2' => $rows['choice2'],
//                'choice3' => $rows['choice3'],
//                'choice4' => $rows['choice4'],
//                'lsound' => $rows['lsound'],
//                'lsound_duration' => $length,
//            );
//        }
//        if (isset($question))
//            return $question;
//    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */