<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reading extends CI_Controller {

    private $number_question = 0;

    public function index($rid,$part,$cid) {
   
          session_start();
            
          $this->load->helper('url');
          $this->load->database();
/* 
          $step = $_SESSION['steps'];
          $current_step = $_SESSION['current_step'];

          if (!isset($step[$current_step]['part']) || $step[$current_step]['part'] != 'reading')
          header('location: login');

          $data['session_student_id'] = $_SESSION['session_student_id'];
          $this->db->query('UPDATE session_student set refreshR=refreshR+1 where id=' . $data['session_student_id']); */

       

        /* $data['student_id'] = $_SESSION['student_id'];
          $data['student_username'] = $_SESSION['student_username'];
          $data['student_firstname'] = $_SESSION['student_firstname'];
          $data['student_lastname'] = $_SESSION['student_lastname']; */

        $data['reading'] = $this->get_reading($rid);
        $data['reading_scq'] = $this->get_scq($rid);
        $data['reading_mcq'] = $this->get_mcq($rid);
        $data['reading_iq'] = $this->get_iq($rid);
        $data['reading_ddq'] = $this->get_ddq($rid);
        $data['reading_oq'] = $this->get_oq($rid);
         $data['cid']= $cid;

        $data['number_question'] = $this->number_question;
        $data['rid'] = $rid;
        $data['part'] = $part;
        //SCQ
        $scq_id_arr;
        if ($data['reading_scq']) {
            foreach ($data['reading_scq'] as $reading_scq) {
                $scq_id_arr[] = $reading_scq['id'];
            }
            $data['reading_scq_arr'] = implode(',', $scq_id_arr);
        } else {
            $data['reading_scq_arr'] = '0';
        }

        //MCQ
        $mcq_id_arr;
        if ($data['reading_mcq']) {
            foreach ($data['reading_mcq'] as $reading_mcq) {
                $mcq_id_arr[] = $reading_mcq['id'];
            }
            $data['reading_mcq_arr'] = implode(',', $mcq_id_arr);
        } else {
            $data['reading_mcq_arr'] = '0';
        }

        //IQ
        $iq_id_arr;
        if ($data['reading_iq']) {
            foreach ($data['reading_iq'] as $reading_iq) {
                $iq_id_arr[] = $reading_iq['id'];
            }
            $data['reading_iq_arr'] = implode(',', $iq_id_arr);
        } else {
            $data['reading_iq_arr'] = '0';
        }

        //DDQ
        $ddq_id_arr;
        if ($data['reading_ddq']) {
            foreach ($data['reading_ddq'] as $reading_ddq) {
                $ddq_id_arr[] = $reading_ddq['id'];
            }
            $data['reading_ddq_arr'] = implode(',', $ddq_id_arr);
        } else {
            $data['reading_ddq_arr'] = '0';
        }

        //OQ
        $oq_id_arr;
        if ($data['reading_oq']) {
            foreach ($data['reading_oq'] as $reading_oq) {
                $oq_id_arr[] = $reading_oq['id'];
            }
            $data['reading_oq_arr'] = implode(',', $oq_id_arr);
        } else {
            $data['reading_oq_arr'] = '0';
        }

        //------------------


        $this->load->view('header');
        $this->load->view('reading/header', $data);
        $this->load->view('reading/main', $data);
        $this->load->view('reading/scq', $data);
        $this->load->view('reading/mcq', $data);
        $this->load->view('reading/iq', $data);
        $this->load->view('reading/ddq', $data);
        $this->load->view('reading/oq', $data);
        $this->load->view('reading/footer', $data);
        $this->load->view('footer');
    }

    private function get_reading($rid) {
    
        $sql = 'SELECT * FROM yima_toefl_reading where id=' . $rid;
   
        $query = $this->db->query($sql);
      
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

    private function get_scq($rid) {
        $question;
        $sql='SELECT * FROM yima_toefl_reading_scq where deleted=0 and rid=' . $rid;
      
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $rows) {
            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'content' => stripslashes($rows['content']),
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

    private function get_mcq($rid) {
        $question;
        $sql = 'SELECT * FROM ' . $this->db->dbprefix('yima_toefl_reading_mcq') . ' where deleted=0 and rid=' . $rid;
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $rows) {
            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'content' => stripslashes($rows['content']),
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

    private function get_iq($rid) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toefl_reading_iq') . ' where deleted=0 and rid=' . $rid);
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
                'title' => $rows['title'],
                'answer' => $rows['answer'],
            );
        }
        if (isset($question))
            return $question;
    }

    private function get_ddq($rid) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toefl_reading_ddq') . ' where deleted=0 and rid=' . $rid);
        foreach ($query->result_array() as $rows) {
            //load choices
            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toefl_reading_ddq_answer') . ' where deleted=0 and ddqid=' . $rows['id']);
            $i = -1;

            if (isset($choice))
                unset($choice);
            foreach ($query1->result() as $row1) {
                $i++;
                $choice[$i]['id'] = $row1->id;
                $choice[$i]['subid'] = $row1->subid;
                $choice[$i]['title'] = $row1->title;
            }

            //load subjects
            if (isset($subject))
                unset($subject);
            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toefl_reading_ddq_subjects') . ' where deleted=0 and ddqid=' . $rows['id']);
            $i = -1;
            foreach ($query1->result() as $row1) {
                $i++;
                $subject[$i]['id'] = $row1->id;
                $subject[$i]['title'] = $row1->title;
                ;
            }

            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'content' => stripslashes($rows['content']),
                'title' => $rows['title'],
                'choice' => $choice,
                'subject' => $subject,
            );
        }
        if (isset($question))
            return $question;
    }

    function get_oq($rid) {
        $question;

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('yima_toefl_reading_oq') . ' where deleted=0 and rid=' . $rid);
        foreach ($query->result_array() as $rows) {
            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'content' => stripslashes($rows['content']),
                'title' => $rows['title'],
                'choice1' => $rows['choice1'],
                'choice2' => $rows['choice2'],
                'choice3' => $rows['choice3'],
                'choice4' => $rows['choice4'],
            );
        }
        if (isset($question))
            return $question;
    }

}

/* End of file login.php */
    /* Location: ./application/controllers/login.php */