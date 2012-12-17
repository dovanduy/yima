<?php

class Writing_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('writing_part', $this->session->userdata('part'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('writing');
        return $query->result();
    }

    function count_all_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('writing_part', $this->session->userdata('part'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        return $this->db->count_all_results('writing');
    }

    function search_entries() {
        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('writing_part', $this->session->userdata('part'));
        $this->db->like('title', $this->input->post('search_val'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('writing');
        return $query->result();
    }

    function get_entries($start = 0) {
        $per_page = $this->config->item('per_page');

        $this->db->select('*');
        $this->db->where('deleted', 0);
        $this->db->where('writing_part', $this->session->userdata('part'));
        $this->db->order_by("disabled", "asc");
        $this->db->order_by("title", "asc");
        $query = $this->db->get('writing', $per_page, $start);
        return $query->result();
    }

    function get_entry($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('writing');

        return $query->result();
    }

    function check_upload_file($id) {
        if (isset($_FILES["limg"]) && $_FILES["limg"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["limg"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'writing_limg' . $id . '.' . $tail;
            $filename = "data/images/writing/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["limg"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->limg = $newname;
            $this->db->update('writing', $data1, array('id' => $id));
        }

        if (isset($_FILES["lsound"]) && $_FILES["lsound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["lsound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'writing_lsound' . $id . '.' . $tail;
            $filename = "data/sounds/writing/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["lsound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->lsound = $newname;
            $this->db->update('writing', $data1, array('id' => $id));
        }

        if (isset($_FILES["ssound"]) && $_FILES["ssound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["ssound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'writing_ssound' . $id . '.' . $tail;
            $filename = "data/sounds/writing/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["ssound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->ssound = $newname;
            $this->db->update('writing', $data1, array('id' => $id));
        }

        if (isset($_FILES["dsound"]) && $_FILES["dsound"]["tmp_name"] != "") {
            $temp = strrchr($_FILES["dsound"]["name"], ".");
            $tail = substr($temp, 1, strlen($temp) - 1);
            $newname = 'writing_dsound' . $id . '.' . $tail;
            $filename = "data/sounds/writing/" . $newname;
            if (file_exists($filename)) {
                unlink($filename);
            }
            move_uploaded_file($_FILES["dsound"]["tmp_name"], $filename);
            chmod($filename, 0777);

            $data1->dsound = $newname;
            $this->db->update('writing', $data1, array('id' => $id));
        }
    }

    function insert_entry() {
        $data->title = $this->input->post('title');

        $data->writing_part = $this->session->userdata('part');

        $data->level = $this->input->post('level');
        $data->keyword = $this->input->post('keyword');
        $data->source = $this->input->post('source');
        $data->content = addslashes($this->input->post('content'));
        $data->subject = $this->input->post('subject');
        $data->direction = $this->input->post('direction');

        $user_info = $this->session->userdata('user_info');
        $data->author = $user_info['id'];

        $time = time();
        $data->date_added = $time;
        $data->last_modified = $time;

        $this->db->insert('writing', $data);

        $this->check_upload_file($this->db->insert_id());
    }

    function update_entry() {
        $data->title = $this->input->post('title');

        $data->level = $this->input->post('level');
        $data->keyword = $this->input->post('keyword');
        $data->source = $this->input->post('source');
        $data->content = addslashes($this->input->post('content'));
        $data->subject = $this->input->post('subject');
        $data->direction = $this->input->post('direction');

        $data->last_modified = time();

        $this->db->update('writing', $data, array('id' => $this->input->post('id')));

        $this->check_upload_file($this->input->post('id'));
    }

    function delete_entry($id) {
        $data = array('deleted' => 1);
        $this->db->where('id', $id);
        $this->db->update('writing', $data);
    }

}
