<?php

class Reading_oq_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('rid', $this->session->userdata('rid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('reading_oq');
        return $query->result();
    }

    function count_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('rid', $this->session->userdata('rid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        return $this->db->count_all_results('reading_oq');
    }

    function search_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('rid', $this->session->userdata('rid'));
        $this->db->like('title', $this->input->post('search_val'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('reading_oq');
        return $query->result();
    }

    function get_entries($start = 0) {
        $per_page = $this->config->item('per_page');

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('rid', $this->session->userdata('rid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('reading_oq', $per_page, $start);
        return $query->result();
    }

    function get_entry($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('reading_oq');

        return $query->result();
    }

    function insert_entry() {
        $data->title = $this->input->post('title');
        
        $data->rid = $this->session->userdata('rid');
        
        $data->choice1 = $this->input->post('choice1');
        $data->choice2 = $this->input->post('choice2');
        $data->choice3 = $this->input->post('choice3');
        $data->choice4 = $this->input->post('choice4');
        $data->content = $this->input->post('content');

        $time = time();
        $data->date_added = $time;
        $data->last_modified = $time;

        $this->db->insert('reading_oq', $data);
    }

    function update_entry() {
        $data->title = $this->input->post('title');
        
        $data->choice1 = $this->input->post('choice1');
        $data->choice2 = $this->input->post('choice2');
        $data->choice3 = $this->input->post('choice3');
        $data->choice4 = $this->input->post('choice4');
        $data->content = $this->input->post('content');

        $data->last_modified = time();

        $this->db->update('reading_oq', $data, array('id' => $this->input->post('id')));
    }

    function delete_entry($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('reading_oq', $data);
    }

}
