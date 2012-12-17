<?php

class Student_model extends CI_Model {

    var $title = '';
    var $password = '';
    var $firstname = '';
    var $lastname = '';
    var $group_id = 2;
    var $date_added = 0;
    var $last_modified = 0;
    var $disabled = 0;
    var $deleted = 0;

    function __construct() {
        parent::__construct();
    }

    function get_all_entries_by_campus($campus_id) {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('group_id', 4);
        if (current_group_id()==2) $this->db->where('campus_id', current_campus_id());
        $this->db->where('campus_id', $campus_id);
        $this->db->order_by("campus_id", "asc");
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('user');
        return $query->result();
    }
    
    function get_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('group_id', 4);
        if (current_group_id()==2) $this->db->where('campus_id', current_campus_id());
        $this->db->order_by("campus_id", "asc");
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('user');
        return $query->result();
    }

    function count_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('group_id', 4);
        if (current_group_id()==2) $this->db->where('campus_id', current_campus_id());
        $this->db->order_by("campus_id", "asc");
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        return $this->db->count_all_results('user');
    }

    function search_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('group_id', 4);
        if (current_group_id()==2) $this->db->where('campus_id', current_campus_id());
        $this->db->like('title', $this->input->post('search_val'));
        $this->db->order_by("campus_id", "asc");
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('user');
        return $query->result();
    }

    function get_entries($start = 0) {
        $per_page = $this->config->item('per_page');

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('group_id', 4);
        if (current_group_id()==2) $this->db->where('campus_id', current_campus_id());
        $this->db->order_by("campus_id", "asc");
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('user', $per_page, $start);
        return $query->result();
    }

    function get_entry($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('user');

        return $query->result();
    }

    function insert_entry() {
        $this->campus_id = $this->input->post('campus_id');

        $this->title = $this->input->post('title');
        $this->password = md5($this->input->post('password'));
        $this->firstname = $this->input->post('firstname');
        $this->lastname = $this->input->post('lastname');
        $this->group_id = $this->input->post('group_id');

        $time = time();
        $this->date_added = $time;
        $this->last_modified = $time;

        $this->db->insert('user', $this);
    }

    function update_entry() {
        $data->campus_id = $this->input->post('campus_id');
        
        $data->title = $this->input->post('title');
        if ($this->input->post('password') != '')
            $data->password = md5($this->input->post('password'));
        $data->firstname = $this->input->post('firstname');
        $data->lastname = $this->input->post('lastname');
        $data->group_id = $this->input->post('group_id');

        $data->last_modified = time();

        $this->db->update('user', $data, array('id' => $this->input->post('id')));
    }

    function delete_entry($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }

}
