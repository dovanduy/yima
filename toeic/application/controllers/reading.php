<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reading extends CI_Controller {

    private $number_question = 0;

    public function index($rid,$cid) {
        if (!$rid)
            return;
        session_start();
        $this->load->helper('url');
        $this->load->database();

        /*  $step = $_SESSION['steps'];
          $current_step = $_SESSION['current_step'];

          if (!isset($step[$current_step]['part']) || $step[$current_step]['part'] != 'reading')
          header('location: login');

          $rid = $step[$current_step]['id'];

          $data['student_id'] = $_SESSION['student_id'];
          $data['student_username'] = $_SESSION['student_username'];
          $data['student_firstname'] = $_SESSION['student_firstname'];
          $data['student_lastname'] = $_SESSION['student_lastname']; */

        $data['reading'] = $this->get_reading($rid);
        $data['reading_part5'] = $this->get_part5($rid);
        $data['reading_part6'] = $this->get_part6($rid);
        $data['reading_part7'] = $this->get_part7($rid);
        $data['rid'] = $rid;
        $data['cid'] = $cid;

        $data['number_question'] = $this->number_question;

        //SCQ
        $part5_id_arr;
        if ($data['reading_part5']) {
            foreach ($data['reading_part5'] as $reading_part5) {
                $part5_id_arr[] = $reading_part5['id'];
            }
            $data['reading_part5_arr'] = implode(',', $part5_id_arr);
        } else {
            $data['reading_part5_arr'] = '0';
        }

        //MCQ
        $part6_id_arr;
        if ($data['reading_part6']) {
            foreach ($data['reading_part6'] as $reading_part6) {
                $part6_id_arr[] = $reading_part6['id'];
            }
            $data['reading_part6_arr'] = implode(',', $part6_id_arr);
        } else {
            $data['reading_part6_arr'] = '0';
        }

        //IQ
        $part7_id_arr;
        if ($data['reading_part7']) {
            foreach ($data['reading_part7'] as $reading_part7) {
                $part7_id_arr[] = $reading_part7['id'];
            }
            $data['reading_part7_arr'] = implode(',', $part7_id_arr);
        } else {
            $data['reading_part7_arr'] = '0';
        }



        //------------------


        $this->load->view('header');
        $this->load->view('reading/header', $data);
        $this->load->view('reading/main', $data);
        $this->load->view('reading/part5', $data);
        $this->load->view('reading/part6', $data);
        $this->load->view('reading/part7', $data);
        $this->load->view('reading/footer', $data);
        $this->load->view('footer');
    }

    private function get_reading($rid) {
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_reading') . ' where id=' . $rid);
        foreach ($query->result() as $row) {
            $response['id'] = $row->id;
            $response['title'] = $row->title;
            $response['level'] = $row->level;
            $response['test_time'] = $row->test_time;
            $minute = floor($row->test_time / 60);
            $second = floor($row->test_time - $minute * 60);
            $response['test_time_lbl'] = str_pad($minute, 2, "0", STR_PAD_LEFT) . ' : ' . str_pad($second, 2, "0", STR_PAD_LEFT);

            $response['keyword'] = $row->keyword;
            $response['source'] = $row->source;
            $response['reading_part'] = $row->reading_part;
            $response['content'] = stripslashes($row->content);
        }
        return $response;
    }

    private function get_part5($rid) {
        $question;

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_reading_part5') . ' where deleted=0 and rid=' . $rid);
        foreach ($query->result_array() as $rows) {
            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'content' => stripslashes($rows['question']),
                'title' => $rows['title'],
                'choice1' => $rows['choice1'],
                'choice2' => $rows['choice2'],
                'choice3' => $rows['choice3'],
                'choice4' => $rows['choice4'],
                'answer' => $rows['answer'],
            );
        }
        if (isset($question))
            return $question;
    }

    private function get_part6($rid) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_reading_part6') . ' where deleted=0 and rid=' . $rid);
        foreach ($query->result_array() as $rows) {
            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'content' => stripslashes($rows['question']),
                'title' => $rows['title'],
                'choice1' => $rows['choice1'],
                'choice2' => $rows['choice2'],
                'choice3' => $rows['choice3'],
                'choice4' => $rows['choice4'],
                'answer' => $rows['answer'],
            );
        }
        if (isset($question))
            return $question;
    }

    private function str_replace_first($search, $replace, $subject) {
        return implode($replace, explode($search, $subject, 2));
    }

    private function get_part7($rid) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toeic_reading_part7') . ' where deleted=0 and rid=' . $rid);
        foreach ($query->result_array() as $rows) {
            $this->number_question++;
            $content = $this->str_replace_first('[box]', '<span class="square" alt="1" number_question="' . $this->number_question . '" iqid="' . $rows['id'] . '">&nbsp;</span>&nbsp;', stripslashes($rows['content']));
            $content = $this->str_replace_first('[box]', '<span class="square" alt="2" number_question="' . $this->number_question . '" iqid="' . $rows['id'] . '">&nbsp;</span>&nbsp;', $content);
            $content = $this->str_replace_first('[box]', '<span class="square" alt="3" number_question="' . $this->number_question . '" iqid="' . $rows['id'] . '">&nbsp;</span>&nbsp;', $content);
            $content = $this->str_replace_first('[box]', '<span class="square" alt="4" number_question="' . $this->number_question . '" iqid="' . $rows['id'] . '">&nbsp;</span>&nbsp;', $content);
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                //'content' => str_replace('[box]', '<span class="square" alt="1">&nbsp;</span>&nbsp;', stripslashes($rows['content'])),
                'content' => $content,
                'choice1' => $rows['choice1'],
                'choice2' => $rows['choice2'],
                'choice3' => $rows['choice3'],
                'choice4' => $rows['choice4'],
                'title' => $rows['question'],
                'answer' => $rows['answer'],
            );
        }
        if (isset($question))
            return $question;
    }

}

/* End of file login.php */
    /* Location: ./application/controllers/login.php */