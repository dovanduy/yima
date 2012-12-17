<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Qb_configure_score_command extends CI_Controller {

    public function index() {
        session_start();
        $this->load->database();
        $this->load->helper('url');

        $id = $this->input->post('id');
        $action = $this->input->post('action');

        switch ($action) {
            case 'load_list':
                $question_type = $this->input->post('question_type');
                $question_id = $this->input->post('question_id');
                
                $data['question_type'] = $question_type;
                $data['question_id'] = $question_id;
                
                $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('configure_score') . ' where question_type="' . $question_type.'" and question_id="' . $question_id.'" order by score');
                $i = -1;
                foreach ($query->result() as $row) {
                    $i++;
                    $data["scores"][$i]['id'] = $row->id;
                    $data["scores"][$i]['question_type'] = $row->question_type;
                    $data["scores"][$i]['question_id'] = $row->question_id;
                    $data["scores"][$i]['rightchoices'] = $row->rightchoices;
                    $data["scores"][$i]['score'] = $row->score;
                }
                if (isset($data))
                    $this->load->view('configure_score', $data);
                break;
            
            case 'load_details':
                $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('configure_score') . ' where id=' . $id);
                foreach ($query->result() as $row) {
                    $response['id'] = $row->id;
                    $response['question_type'] = $row->question_type;
                    $response['question_id'] = $row->question_id;
                    $response['rightchoices'] = $row->rightchoices;
                    $response['score'] = $row->score;
                }
                echo json_encode($response);
                break;
                
            case 'add':
            case 'edit':
                $response['message'] = '';
                $response['status'] = 'success';

                $question_type = $this->input->post('question_type');
                $question_id = $this->input->post('question_id');
                $rightchoices = $this->input->post('rightchoices');
                $score = $this->input->post('score');

                if ($question_type == '')
                    $msg[] = 'Please choose Question Type.';
                
                if (isset($msg) && is_array($msg)) {
                    $response['message'] = implode('<br/>', $msg);
                    $response['status'] = 'error';
                } else {
                    if ($action == 'add') {
                        $this->db->query('insert into ' . $this->db->dbprefix('configure_score') . ' 
                                          (question_type, question_id, rightchoices, score) 
                                          values ("' . $question_type . '","' . $question_id . '","' . $rightchoices . '","' . $score . '")');
                        $id=$this->db->insert_id();
                        $response['message']='Score is added successfully!';
                    } else {
                        $this->db->query('update ' . $this->db->dbprefix('configure_score') . ' 
                                          set question_type="'.$question_type.'",question_id="'.$question_id.'",rightchoices="'.$rightchoices.'",score="'.$score.'"
                                          where id=' . $id);
                        $response['message']='Score is updated successfully!';
                    }
                }
                
                $response['id']=$id;

                echo json_encode($response);
                break;
            
            case 'delete':
                $this->db->query('delete from ' . $this->db->dbprefix('configure_score') . ' where id=' . $id);
                break;
        }
    }

}

/* End of file branch.php */