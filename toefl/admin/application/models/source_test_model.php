<?php

class Source_test_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('source_test');
        return $query->result();
    }

    function count_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        return $this->db->count_all_results('source_test');
    }

    function search_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->like('title', $this->input->post('search_val'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('source_test');
        return $query->result();
    }

    function get_entries($start = 0) {
        $per_page = $this->config->item('per_page');

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('source_test', $per_page, $start);
        return $query->result();
    }

    function get_entry($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('source_test');

        return $query->result();
    }

    function insert_entry() {
        $this->title = $this->input->post('title');
        
        $this->reading1 = $this->input->post('reading1');
        $this->reading2 = $this->input->post('reading2');
        $this->reading3 = $this->input->post('reading3');
        
        $this->listening1 = $this->input->post('listening1');
        $this->listening2 = $this->input->post('listening2');
        $this->listening3 = $this->input->post('listening3');
        $this->listening4 = $this->input->post('listening4');
        $this->listening5 = $this->input->post('listening5');
        $this->listening6 = $this->input->post('listening6');
        
        $this->speaking1 = $this->input->post('speaking1');
        $this->speaking2 = $this->input->post('speaking2');
        $this->speaking3 = $this->input->post('speaking3');
        $this->speaking4 = $this->input->post('speaking4');
        $this->speaking5 = $this->input->post('speaking5');
        $this->speaking6 = $this->input->post('speaking6');
        
        $this->writing1 = $this->input->post('writing1');
        $this->writing2 = $this->input->post('writing2');
        
        $user_info = $this->session->userdata('user_info');
        $this->author = $user_info['id'];

        $time = time();
        $this->date_added = $time;
        $this->last_modified = $time;

        $this->db->insert('source_test', $this);
    }

    function update_entry() {
        $data->title = $this->input->post('title');
        
        $data->reading1 = $this->input->post('reading1');
        $data->reading2 = $this->input->post('reading2');
        $data->reading3 = $this->input->post('reading3');
        
        $data->listening1 = $this->input->post('listening1');
        $data->listening2 = $this->input->post('listening2');
        $data->listening3 = $this->input->post('listening3');
        $data->listening4 = $this->input->post('listening4');
        $data->listening5 = $this->input->post('listening5');
        $data->listening6 = $this->input->post('listening6');
        
        $data->speaking1 = $this->input->post('speaking1');
        $data->speaking2 = $this->input->post('speaking2');
        $data->speaking3 = $this->input->post('speaking3');
        $data->speaking4 = $this->input->post('speaking4');
        $data->speaking5 = $this->input->post('speaking5');
        $data->speaking6 = $this->input->post('speaking6');
        
        $data->writing1 = $this->input->post('writing1');
        $data->writing2 = $this->input->post('writing2');

        $data->last_modified = time();

        $this->db->update('source_test', $data, array('id' => $this->input->post('id')));
    }

    function delete_entry($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('source_test', $data);
    }

}
