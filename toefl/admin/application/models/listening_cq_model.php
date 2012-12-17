<?php

class Listening_cq_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening_cq');
        return $query->result();
    }

    function count_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        return $this->db->count_all_results('listening_cq');
    }

    function search_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->like('title', $this->input->post('search_val'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening_cq');
        return $query->result();
    }

    function get_entries($start = 0) {
        $per_page = $this->config->item('per_page');

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('lid', $this->session->userdata('lid'));
        $this->db->order_by("id", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening_cq', $per_page, $start);
        return $query->result();
    }

    function get_entry($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('listening_cq');

        return $query->result();
    }

    function insert_entry() {
        $data->title = $this->input->post('title');
        
        $data->content = $this->input->post('content');
        
        $data->lid = $this->session->userdata('lid');

        $time = time();
        $data->date_added = $time;
        $data->last_modified = $time;

        $this->db->insert('listening_cq', $data);
        
        $id = $this->db->insert_id();

        if (isset($_FILES["lsound"]) && $_FILES["lsound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["lsound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'listening_lsound' . $id . '.' . $tail;
            $filename = "data/sounds/listening/cq/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["lsound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->lsound = $newname;
            $this->db->update('listening_cq', $data1, array('id' => $id));
        }
    }

    function update_entry() {
        $data->title = $this->input->post('title');
        
        $data->content = $this->input->post('content');

        $data->last_modified = time();

        $this->db->update('listening_cq', $data, array('id' => $this->input->post('id')));
        
        $id = $this->input->post('id');

        if (isset($_FILES["lsound"]) && $_FILES["lsound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["lsound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'listening_lsound' . $id . '.' . $tail;
            $filename = "data/sounds/listening/cq/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["lsound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->lsound = $newname;
            $this->db->update('listening_cq', $data1, array('id' => $id));
        }
    }

    function delete_entry($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('listening_cq', $data);
    }

    function load_columns($cqid) {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('cqid', $cqid);
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening_cq_column');
        return $query->result();
    }
    
    function add_column($cqid,$title) {
        $data->title = $title;
        $data->cqid = $cqid;
        $this->db->insert('listening_cq_column', $data);
        
        $id = $this->db->insert_id();
        return $id;
    }
    
    function update_column($id, $title) {
        $data->title = $title;
        $this->db->update('listening_cq_column', $data, array('id' => $id));
    }
    
    function delete_column($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('listening_cq_column', $data);
    }
    
    function load_rows($cqid) {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('cqid', $cqid);
        $this->db->order_by("title", "asc");
        $query = $this->db->get('listening_cq_row');
        return $query->result();
    }
    
    function add_row($cqid,$title) {
        $data->title = $title;
        $data->cqid = $cqid;
        $this->db->insert('listening_cq_row', $data);
        
        $id = $this->db->insert_id();
        return $id;
    }
    
    function update_row($id, $title) {
        $data->title = $title;
        $this->db->update('listening_cq_row', $data, array('id' => $id));
    }
    
    function delete_row($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('listening_cq_row', $data);
    }
    
    function update_row_column($row_id,$col_id) {
        $data->col = $col_id;
        $this->db->update('listening_cq_row', $data, array('id' => $row_id));
    }
}
