<?php

class Class_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        if (current_group_id()==2) $this->db->where('campus_id', current_campus_id());
        $this->db->order_by("campus_id", "asc");
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('class');
        return $query->result();
    }

    function count_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        if (current_group_id()==2) $this->db->where('campus_id', current_campus_id());
        $this->db->order_by("campus_id", "asc");
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        return $this->db->count_all_results('class');
    }

    function search_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        if (current_group_id()==2) $this->db->where('campus_id', current_campus_id());
        $this->db->like('title', $this->input->post('search_val'));
        $this->db->order_by("campus_id", "asc");
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('class');
        return $query->result();
    }

    function get_entries($start = 0) {
        $per_page = $this->config->item('per_page');

        $this->db->select('*');
        $this->db->where('deleted', 0);
        if (current_group_id()==2) $this->db->where('campus_id', current_campus_id());
        $this->db->order_by("campus_id", "asc");
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('class', $per_page, $start);
        return $query->result();
    }

    function get_entry($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('class');

        return $query->result();
    }

    function insert_entry() {
        $this->campus_id = $this->input->post('campus_id');
        $this->title = $this->input->post('title');

        $time = time();
        $this->date_added = $time;
        $this->last_modified = $time;

        $this->db->insert('class', $this);
    }

    function update_entry() {
        $data->campus_id = $this->input->post('campus_id');
        $data->title = $this->input->post('title');

        $data->last_modified = time();

        $this->db->update('class', $data, array('id' => $this->input->post('id')));
    }

    function delete_entry($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('class', $data);
    }

}
