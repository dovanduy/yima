<?php

class Listening_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('listening_part', $this->session->userdata('part'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening');
        return $query->result();
    }

    function count_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('listening_part', $this->session->userdata('part'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        return $this->db->count_all_results('listening');
    }

    function search_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('listening_part', $this->session->userdata('part'));
        $this->db->like('title', $this->input->post('search_val'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening');
        return $query->result();
    }

    function get_entries($start = 0) {
        $per_page = $this->config->item('per_page');

        $this->db->select('*, (select count(listening_video.id) from listening_video where lid=listening.id and listening_video.deleted=0) as count_video
                , (select count(listening_scq.id) from listening_scq where lid=listening.id and listening_scq.deleted=0) as count_scq
                , (select count(listening_mcq.id) from listening_mcq where lid=listening.id and listening_mcq.deleted=0) as count_mcq
                , (select count(listening_cq.id) from listening_cq where lid=listening.id and listening_cq.deleted=0) as count_cq
                , (select count(listening_oq.id) from listening_oq where lid=listening.id and listening_oq.deleted=0) as count_oq');
        $this->db->where('deleted', 0);
        $this->db->where('listening_part', $this->session->userdata('part'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening', $per_page, $start);
        return $query->result();
    }

    function get_entry($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('listening');

        return $query->result();
    }

    function insert_entry() {
        $data->title = $this->input->post('title');

        $data->level = $this->input->post('level');
        $data->listening_type = $this->input->post('listening_type');
        $data->test_time = $this->input->post('test_time');
        $data->source = $this->input->post('source');
        $data->keyword = $this->input->post('keyword');

        $data->listening_part = $this->session->userdata('part');

        $user_info = $this->session->userdata('user_info');
        $data->author = $user_info['id'];

        $time = time();
        $data->date_added = $time;
        $data->last_modified = $time;

        $this->db->insert('listening', $data);

        $id = $this->db->insert_id();

        if (isset($_FILES["lsound"]) && $_FILES["lsound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["lsound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'listening_lsound' . $id . '.' . $tail;
            $filename = "data/sounds/listening/listening_page/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["lsound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->lsound = $newname;
            $this->db->update('listening', $data1, array('id' => $id));
        }
    }

    function update_entry() {
        $data->title = $this->input->post('title');

        $data->level = $this->input->post('level');
        $data->listening_type = $this->input->post('listening_type');
        $data->test_time = $this->input->post('test_time');
        $data->source = $this->input->post('source');
        $data->keyword = $this->input->post('keyword');

        $data->last_modified = time();

        $this->db->update('listening', $data, array('id' => $this->input->post('id')));

        $id = $this->input->post('id');

        if (isset($_FILES["lsound"]) && $_FILES["lsound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["lsound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'listening_lsound' . $id . '.' . $tail;
            $filename = "data/sounds/listening/listening_page/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["lsound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->lsound = $newname;
            $this->db->update('listening', $data1, array('id' => $id));
        }
    }

    function delete_entry($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('listening', $data);
    }

}
