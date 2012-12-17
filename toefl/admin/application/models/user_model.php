<?php

class User_model extends CI_Model {

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

    function get_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('group_id != ', 3);
        $this->db->where('group_id != ', 4);
        $this->db->order_by("group_id", "asc");
        $this->db->order_by("campus_id", "asc");
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('user');
        return $query->result();
    }

    function count_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('group_id != ', 3);
        $this->db->where('group_id != ', 4);
        $this->db->order_by("group_id", "asc");
        $this->db->order_by("campus_id", "asc");
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        return $this->db->count_all_results('user');
    }

    function search_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('group_id != ', 3);
        $this->db->where('group_id != ', 4);
        $this->db->like('title', $this->input->post('search_val'));
        $this->db->order_by("group_id", "asc");
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
        $this->db->where('group_id != ', 3);
        $this->db->where('group_id != ', 4);
        $this->db->order_by("group_id", "asc");
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

        $this->qb_view = $this->input->post('qb_view');
        $this->qb_edit = $this->input->post('qb_edit');
        $this->qb_delete = $this->input->post('qb_delete');

        $this->source_view = $this->input->post('source_view');
        $this->source_edit = $this->input->post('source_edit');
        $this->source_delete = $this->input->post('source_delete');

        $this->ss_view = $this->input->post('ss_view');
        $this->ss_edit = $this->input->post('ss_edit');
        $this->ss_delete = $this->input->post('ss_delete');
        
        $this->ss_source = $this->input->post('ss_source');
        $this->ss_class = $this->input->post('ss_class');
        $this->ss_assign = $this->input->post('ss_assign');
        
        $this->ss_assign_status = $this->input->post('ss_assign_status');
        $this->ss_assign_mixed = $this->input->post('ss_assign_mixed');
        $this->ss_assign_order = $this->input->post('ss_assign_order');
        
        $this->student_view = $this->input->post('student_view');
        $this->student_edit = $this->input->post('student_edit');
        $this->student_delete = $this->input->post('student_delete');
        
        
        $this->teacher_view = $this->input->post('teacher_view');
        $this->teacher_edit = $this->input->post('teacher_edit');
        $this->teacher_delete = $this->input->post('teacher_delete');
        
        $this->class_view = $this->input->post('class_view');
        $this->class_edit = $this->input->post('class_edit');
        $this->class_delete = $this->input->post('class_delete');

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

        $data->qb_view = $this->input->post('qb_view');
        $data->qb_edit = $this->input->post('qb_edit');
        $data->qb_delete = $this->input->post('qb_delete');

        $data->source_view = $this->input->post('source_view');
        $data->source_edit = $this->input->post('source_edit');
        $data->source_delete = $this->input->post('source_delete');
        
        $data->ss_view = $this->input->post('ss_view');
        $data->ss_edit = $this->input->post('ss_edit');
        $data->ss_delete = $this->input->post('ss_delete');
        
        $data->ss_source = $this->input->post('ss_source');
        $data->ss_class = $this->input->post('ss_class');
        $data->ss_assign = $this->input->post('ss_assign');
        
        $data->ss_assign_status = $this->input->post('ss_assign_status');
        $data->ss_assign_mixed = $this->input->post('ss_assign_mixed');
        $data->ss_assign_order = $this->input->post('ss_assign_order');
        
        $data->student_view = $this->input->post('student_view');
        $data->student_edit = $this->input->post('student_edit');
        $data->student_delete = $this->input->post('student_delete');
        
        $data->teacher_view = $this->input->post('teacher_view');
        $data->teacher_edit = $this->input->post('teacher_edit');
        $data->teacher_delete = $this->input->post('teacher_delete');
        
        $data->class_view = $this->input->post('class_view');
        $data->class_edit = $this->input->post('class_edit');
        $data->class_delete = $this->input->post('class_delete');

        $data->last_modified = time();

        $this->db->update('user', $data, array('id' => $this->input->post('id')));
    }

    function delete_entry($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }

}
