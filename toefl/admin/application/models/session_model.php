<?php

class Session_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        if (current_group_id() == 3)
            $this->db->where_in('id', $this->session->userdata('filter_sessions'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('session');
        return $query->result();
    }

    function count_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        if (current_group_id() == 3)
            $this->db->where_in('id', $this->session->userdata('filter_sessions'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        return $this->db->count_all_results('session');
    }

    function search_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        if (current_group_id() == 3)
            $this->db->where_in('id', $this->session->userdata('filter_sessions'));
        $this->db->like('title', $this->input->post('search_val'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('session');
        return $query->result();
    }

    function get_entries($start = 0) {
        $per_page = $this->config->item('per_page');

        $this->db->select('*');
        $this->db->where('deleted', 0);
        if (current_group_id() == 3)
            $this->db->where_in('id', $this->session->userdata('filter_sessions'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('session', $per_page, $start);
        return $query->result();
    }

    function get_entry($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('session');

        return $query->result();
    }

    function insert_entry() {
        $this->title = $this->input->post('title');

        $this->start_date = strtotime($this->input->post('start_date'));
        $this->end_date = strtotime($this->input->post('end_date'));

        $user_info = $this->session->userdata('user_info');
        $this->author = $user_info['id'];

        $time = time();
        $this->date_added = $time;
        $this->last_modified = $time;

        $this->db->insert('session', $this);
    }

    function update_entry() {
        $data->title = $this->input->post('title');

        $data->start_date = strtotime($this->input->post('start_date'));
        $data->end_date = strtotime($this->input->post('end_date'));

        $data->last_modified = time();

        $this->db->update('session', $data, array('id' => $this->input->post('id')));
    }

    function delete_entry($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('session', $data);
    }

}