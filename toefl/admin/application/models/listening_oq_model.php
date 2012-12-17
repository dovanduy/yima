<?php

class Listening_oq_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening_oq');
        return $query->result();
    }

    function count_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        return $this->db->count_all_results('listening_oq');
    }

    function search_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->like('title', $this->input->post('search_val'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening_oq');
        return $query->result();
    }

    function get_entries($start = 0) {
        $per_page = $this->config->item('per_page');

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening_oq', $per_page, $start);
        return $query->result();
    }

    function get_entry($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('listening_oq');

        return $query->result();
    }

    function insert_entry() {
        $data->title = $this->input->post('title');
        
        $data->choice1 = $this->input->post('choice1');
        $data->choice2 = $this->input->post('choice2');
        $data->choice3 = $this->input->post('choice3');
        $data->choice4 = $this->input->post('choice4');
        
        $data->lid = $this->session->userdata('lid');

        $time = time();
        $data->date_added = $time;
        $data->last_modified = $time;

        $this->db->insert('listening_oq', $data);
        
        $id = $this->db->insert_id();

        if (isset($_FILES["lsound"]) && $_FILES["lsound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["lsound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'listening_lsound' . $id . '.' . $tail;
            $filename = "data/sounds/listening/oq/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["lsound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->lsound = $newname;
            $this->db->update('listening_oq', $data1, array('id' => $id));
        }
    }

    function update_entry() {
        $data->title = $this->input->post('title');
        
        $data->choice1 = $this->input->post('choice1');
        $data->choice2 = $this->input->post('choice2');
        $data->choice3 = $this->input->post('choice3');
        $data->choice4 = $this->input->post('choice4');

        $data->last_modified = time();

        $this->db->update('listening_oq', $data, array('id' => $this->input->post('id')));
        
        $id = $this->input->post('id');

        if (isset($_FILES["lsound"]) && $_FILES["lsound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["lsound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'listening_lsound' . $id . '.' . $tail;
            $filename = "data/sounds/listening/oq/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["lsound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->lsound = $newname;
            $this->db->update('listening_oq', $data1, array('id' => $id));
        }
    }

    function delete_entry($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('listening_oq', $data);
    }

}
