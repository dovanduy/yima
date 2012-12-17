<?php

class Listening_video_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening_video');
        return $query->result();
    }

    function count_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        return $this->db->count_all_results('listening_video');
    }

    function search_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->like('title', $this->input->post('search_val'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening_video');
        return $query->result();
    }

    function get_entries($start = 0) {
        $per_page = $this->config->item('per_page');

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening_video', $per_page, $start);
        return $query->result();
    }

    function get_entry($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('listening_video');

        return $query->result();
    }

    function insert_entry() {
        $data->title = $this->input->post('title');

        $data->time = $this->input->post('time');

        $data->lid = $this->session->userdata('lid');

        $time = time();
        $data->date_added = $time;
        $data->last_modified = $time;

        $this->db->insert('listening_video', $data);

        $id = $this->db->insert_id();

        if (isset($_FILES["limg"]) && $_FILES["limg"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["limg"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'speaking_limg' . $id . '.' . $tail;
            $filename = "data/images/listening/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["limg"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->limg = $newname;
            $this->db->update('listening_video', $data1, array('id' => $id));
        }
    }

    function update_entry() {
        $data->title = $this->input->post('title');

        $data->time = $this->input->post('time');

        $data->last_modified = time();

        $this->db->update('listening_video', $data, array('id' => $this->input->post('id')));

        $id = $this->input->post('id');

        if (isset($_FILES["limg"]) && $_FILES["limg"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["limg"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'speaking_limg' . $id . '.' . $tail;
            $filename = "data/images/listening/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["limg"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->limg = $newname;
            $this->db->update('listening_video', $data1, array('id' => $id));
        }
    }

    function delete_entry($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('listening_video', $data);
    }

}
