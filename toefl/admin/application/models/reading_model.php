<?php

class Reading_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('reading_part', $this->session->userdata('part'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('reading');
        return $query->result();
    }

    function count_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('reading_part', $this->session->userdata('part'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        return $this->db->count_all_results('reading');
    }

    function search_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('reading_part', $this->session->userdata('part'));
        $this->db->like('title', $this->input->post('search_val'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('reading');
        return $query->result();
    }

    function get_entries($start = 0) {
        $per_page = $this->config->item('per_page');

        $this->db->select('*, (select count(reading_scq.id) from reading_scq where rid=reading.id and reading_scq.deleted=0) as count_scq
            , (select count(reading_mcq.id) from reading_mcq where rid=reading.id and reading_mcq.deleted=0) as count_mcq
            , (select count(reading_iq.id) from reading_iq where rid=reading.id and reading_iq.deleted=0) as count_iq
            , (select count(reading_ddq.id) from reading_ddq where rid=reading.id and reading_ddq.deleted=0) as count_ddq
            , (select count(reading_oq.id) from reading_oq where rid=reading.id and reading_oq.deleted=0) as count_oq');
        $this->db->where('deleted', 0);
        $this->db->where('reading_part', $this->session->userdata('part'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('reading', $per_page, $start);
        return $query->result();
    }

    function get_entry($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('reading');

        return $query->result();
    }

    function insert_entry() {
        $data->title = $this->input->post('title');
        
        $data->level = $this->input->post('level');
        $data->test_time = $this->input->post('test_time');
        $data->source = $this->input->post('source');
        $data->keyword = $this->input->post('keyword');
        $data->content = $this->input->post('content');
        
        $data->reading_part = $this->session->userdata('part');
        
        $user_info = $this->session->userdata('user_info');
        $data->author=$user_info['id'];

        $time = time();
        $data->date_added = $time;
        $data->last_modified = $time;

        $this->db->insert('reading', $data);
    }

    function update_entry() {
        $data->title = $this->input->post('title');
        
        $data->level = $this->input->post('level');
        $data->test_time = $this->input->post('test_time');
        $data->source = $this->input->post('source');
        $data->keyword = $this->input->post('keyword');
        $data->content = $this->input->post('content');

        $data->last_modified = time();

        $this->db->update('reading', $data, array('id' => $this->input->post('id')));
    }

    function delete_entry($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('reading', $data);
    }

}
