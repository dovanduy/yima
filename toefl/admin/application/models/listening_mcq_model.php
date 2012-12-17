<?php

class Listening_mcq_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening_mcq');
        return $query->result();
    }

    function count_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        return $this->db->count_all_results('listening_mcq');
    }

    function search_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->like('title', $this->input->post('search_val'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening_mcq');
        return $query->result();
    }

    function get_entries($start = 0) {
        $per_page = $this->config->item('per_page');

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening_mcq', $per_page, $start);
        return $query->result();
    }

    function get_entry($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('listening_mcq');

        return $query->result();
    }

    function insert_entry() {
        $data->title = $this->input->post('title');
        
        $data->lid = $this->session->userdata('lid');
        
        $data->choice1 = $this->input->post('choice1');
        $data->choice2 = $this->input->post('choice2');
        $data->choice3 = $this->input->post('choice3');
        $data->choice4 = $this->input->post('choice4');
        
        $answer=$this->input->post('answer');
        $data->answer = implode(',',$answer);
		
		$data->replay = $this->input->post('replay');
		$data->replay_from = $this->input->post('replay_from');
		$data->replay_to = $this->input->post('replay_to');
		
		$data->sentence = $this->input->post('sentence');
		
        $time = time();
        $data->date_added = $time;
        $data->last_modified = $time;

        $this->db->insert('listening_mcq', $data);
        
        $id = $this->db->insert_id();

        if (isset($_FILES["lsound"]) && $_FILES["lsound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["lsound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'listening_lsound' . $id . '.' . $tail;
            $filename = "data/sounds/listening/mcq/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["lsound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->lsound = $newname;
            $this->db->update('listening_mcq', $data1, array('id' => $id));
        }
		
		if (isset($_FILES["replay_sound"]) && $_FILES["replay_sound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["replay_sound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'replay_sound' . $id . '.' . $tail;
            $filename = "data/sounds/listening/replay_sound/mcq/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["replay_sound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->replay_sound = $newname;
            $this->db->update('listening_mcq', $data1, array('id' => $id));
        }
		
		if (isset($_FILES["sentence_sound"]) && $_FILES["sentence_sound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["sentence_sound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'sentence_sound' . $id . '.' . $tail;
            $filename = "data/sounds/listening/sentence_sound/mcq/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["sentence_sound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->sentence_sound = $newname;
            $this->db->update('listening_mcq', $data1, array('id' => $id));
        }
    }

    function update_entry() {
        $data->title = $this->input->post('title');
        
        $data->choice1 = $this->input->post('choice1');
        $data->choice2 = $this->input->post('choice2');
        $data->choice3 = $this->input->post('choice3');
        $data->choice4 = $this->input->post('choice4');
        
        $answer=$this->input->post('answer');
        $data->answer = implode(',',$answer);
		
		$data->replay = $this->input->post('replay');
		$data->replay_from = $this->input->post('replay_from');
		$data->replay_to = $this->input->post('replay_to');
		
		$data->sentence = $this->input->post('sentence');
		
        $data->last_modified = time();

        $this->db->update('listening_mcq', $data, array('id' => $this->input->post('id')));
        
        $id = $this->input->post('id');

        if (isset($_FILES["lsound"]) && $_FILES["lsound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["lsound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'listening_lsound' . $id . '.' . $tail;
            $filename = "data/sounds/listening/mcq/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["lsound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->lsound = $newname;
            $this->db->update('listening_mcq', $data1, array('id' => $id));
        }
		
		if (isset($_FILES["replay_sound"]) && $_FILES["replay_sound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["replay_sound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'replay_sound' . $id . '.' . $tail;
            $filename = "data/sounds/listening/replay_sound/mcq/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["replay_sound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->replay_sound = $newname;
            $this->db->update('listening_mcq', $data1, array('id' => $id));
        }
		
		if (isset($_FILES["sentence_sound"]) && $_FILES["sentence_sound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["sentence_sound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'sentence_sound' . $id . '.' . $tail;
            $filename = "data/sounds/listening/sentence_sound/mcq/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["sentence_sound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->sentence_sound = $newname;
            $this->db->update('listening_mcq', $data1, array('id' => $id));
        }
    }

    function delete_entry($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('listening_mcq', $data);
    }

}
