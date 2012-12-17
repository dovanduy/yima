<?php

class Reading_ddq_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('rid', $this->session->userdata('rid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('reading_ddq');
        return $query->result();
    }

    function count_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('rid', $this->session->userdata('rid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        return $this->db->count_all_results('reading_ddq');
    }

    function search_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('rid', $this->session->userdata('rid'));
        $this->db->like('title', $this->input->post('search_val'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('reading_ddq');
        return $query->result();
    }

    function get_entries($start = 0) {
        $per_page = $this->config->item('per_page');

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('rid', $this->session->userdata('rid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('reading_ddq', $per_page, $start);
        return $query->result();
    }

    function get_entry($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('reading_ddq');

        return $query->result();
    }

    function insert_entry() {
        $data->title = $this->input->post('title');

        $data->content = $this->input->post('content');

        $data->rid = $this->session->userdata('rid');

        $time = time();
        $data->date_added = $time;
        $data->last_modified = $time;

        $this->db->insert('reading_ddq', $data);
    }

    function update_entry() {
        $data->title = $this->input->post('title');

        $data->content = $this->input->post('content');

        $data->last_modified = time();

        $this->db->update('reading_ddq', $data, array('id' => $this->input->post('id')));
    }

    function delete_entry($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('reading_ddq', $data);
    }

    //--- Subjects
    function load_subjects($ddqid) {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('ddqid', $ddqid);
        $this->db->order_by("title", "asc");
        $query = $this->db->get('reading_ddq_subjects');
        return $query->result();
    }

    function add_subject($ddqid, $title) {
        $data->title = $title;
        $data->ddqid = $ddqid;
        $this->db->insert('reading_ddq_subjects', $data);
        
        $id = $this->db->insert_id();
        return $id;
    }

    function update_subject($id, $title) {
        $data->title = $title;
        $this->db->update('reading_ddq_subjects', $data, array('id' => $id));
    }

    function delete_subject($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('reading_ddq_subjects', $data);
    }

    //--- Choices
    function load_choices($ddqid) {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('ddqid', $ddqid);
        $this->db->order_by("title", "asc");
        $query = $this->db->get('reading_ddq_answer');
        return $query->result();
    }

    function add_choice($ddqid, $title) {
        $data->title = $title;
        $data->ddqid = $ddqid;
        $this->db->insert('reading_ddq_answer', $data);
        
        $id = $this->db->insert_id();
        return $id;
    }

    function update_choice($id, $title) {
        $data->title = $title;
        $this->db->update('reading_ddq_answer', $data, array('id' => $id));
    }

    function delete_choice($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('reading_ddq_answer', $data);
    }

    function update_choice_subject($id, $subid) {
        $data->subid = $subid;
        $this->db->update('reading_ddq_answer', $data, array('id' => $id));
    }

}
