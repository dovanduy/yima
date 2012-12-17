<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Source_test extends CI_Controller {

    private $object;
    private $theme;
    private $data;

    public function __construct() {
        parent::__construct();

        //--- object name
        $this->object = 'source_test';
        $this->data['object'] = $this->object;

        //--- check login and set user_info
        check_login($this->object);
        $this->data['user_info'] = $this->session->userdata('user_info');

        //--- default theme
        $this->theme = $this->config->item('theme');

        //--- load object model
        $this->load->model('Source_test_model');

        //--- prepare links
        $this->data['link_base'] = base_url();
        $this->data['link_current'] = $this->data['link_base'] . uri_string();

        $this->data['link_object'] = base_url() . $this->object . '/';
        $this->data['link_search'] = base_url() . $this->object . '/search/';
        $this->data['link_add'] = base_url() . $this->object . '/add/';
        $this->data['link_edit'] = base_url() . $this->object . '/edit/';
        $this->data['link_import'] = base_url() . $this->object . '/import/';
        $this->data['link_export'] = base_url() . 'export/' . $this->object . '/';
        $this->data['link_delete'] = base_url() . $this->object . '/delete/';
        $this->data['link_confirm_delete'] = base_url() . $this->object . '/confirm_delete/';
        //--- end prepare links
    }

    //--- validate post data
    private function validate() {
        $message = '';

        if ($this->input->post('title') == '')
            $msg[] = 'Please input Source_test Name.';

        if (isset($msg))
            $message = implode('<br/>', $msg);

        return($message);
    }

    //--- return $post_item when invalid data
    private function post_item() {
        if (isset($_POST['title'])) {
            $post->title = $this->input->post('title');
            return $post;
        }
    }

    public function search() {
        $search_val = $this->input->post('search_val');
        $this->data['search_val'] = $search_val;
        //--- set pop up message
        $this->data['notification'] = "Search for <strong>$search_val</strong>";

        $this->data['items'] = $this->Source_test_model->search_entries();

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/list', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function page($start = 0) {
        $this->index($start);
    }

    public function index($start = 0) {
        //--- set pop up message
        $message = $this->session->flashdata('message');
        if ($message != '')
            $this->data['notification'] = $this->session->flashdata('message');

        //--- generate pagination
        $config = set_default_pagination();
        $config['total_rows'] = $this->Source_test_model->count_all_entries();
        $config['base_url'] = $this->data['link_object'] . 'page/';
        $config['per_page'] = $this->config->item('per_page');

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //--- end generate pagination
        //--- get entry list by page
        $this->data['items'] = $this->Source_test_model->get_entries($start);

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/list', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function migrate_db($source_test_id = 0) {
        $this->load->helper('import');
        migrate_db($source_test_id);
    }

    public function import() {
        $this->data['h2_title'] = 'Import';

        if (isset($_FILES['import'])) {
            $this->load->helper('file');

            $filename = $_FILES['import']['name'];
            $id = str_replace('.zip', '', $filename);

            if (file_exists('data/import/' . $filename))
                unlink('data/import/' . $filename);

            if (file_exists('data/import/' . $id)) {
                // delete 
                exec('rm -rf ' . 'data/import/' . $id);
            }


            move_uploaded_file($_FILES['import']['tmp_name'], 'data/import/' . $filename);

            chmod('data/import/' . $filename, 0777);

            //change directory so the zip file doesnt have a tree structure in it.
            chdir('data/import/');

            // unzip 
            exec('tar -zxvf ' . $filename);
            chmod($id, 0777);

            //change directory so the zip file doesnt have a tree structure in it.
            chdir('../../');

            $this->load->helper('import');

            $this->db->empty_table('_listening');
            $this->db->empty_table('_listening_cq');
            $this->db->empty_table('_listening_cq_column');
            $this->db->empty_table('_listening_cq_row');
            $this->db->empty_table('_listening_mcq');
            $this->db->empty_table('_listening_oq');
            $this->db->empty_table('_listening_scq');
            $this->db->empty_table('_listening_video');
            $this->db->empty_table('_reading');
            $this->db->empty_table('_reading_ddq');
            $this->db->empty_table('_reading_ddq_answer');
            $this->db->empty_table('_reading_ddq_subjects');
            $this->db->empty_table('_reading_iq');
            $this->db->empty_table('_reading_mcq');
            $this->db->empty_table('_reading_oq');
            $this->db->empty_table('_reading_scq');
            $this->db->empty_table('_source_test');
            $this->db->empty_table('_speaking');
            $this->db->empty_table('_writing');

            $source_test = import_source_test($id);

            import_reading($id, $source_test->reading1);
            import_reading($id, $source_test->reading2);
            import_reading($id, $source_test->reading3);

            import_listening($id, $source_test->listening1);
            import_listening($id, $source_test->listening2);
            import_listening($id, $source_test->listening3);
            import_listening($id, $source_test->listening4);
            import_listening($id, $source_test->listening5);
            import_listening($id, $source_test->listening6);

            import_speaking($id, $source_test->speaking1);
            import_speaking($id, $source_test->speaking2);
            import_speaking($id, $source_test->speaking3);
            import_speaking($id, $source_test->speaking4);
            import_speaking($id, $source_test->speaking5);
            import_speaking($id, $source_test->speaking6);

            import_writing($id, $source_test->writing1);
            import_writing($id, $source_test->writing2);
            
            migrate_db($id);

            //--- set pop up message
            $this->session->set_flashdata('message', '<strong>' . $filename . '</strong> is imported.');
            redirect($this->data['link_object']);
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/import', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function add() {
        if (isset($_POST['title'])) {
            $message = $this->validate();

            if ($message == '') {
                //--- insert entry to database
                $this->Source_test_model->insert_entry();

                //--- set pop up message
                $this->session->set_flashdata('message', '<strong>' . $this->input->post('title') . '</strong> is added.');
                redirect($this->data['link_object']);
            } else {
                $this->data['item'] = $this->post_item();

                //--- set pop up message
                $this->data['notification'] = $message;
            }
        }

        $this->data['h2_title'] = 'Add';
        $this->data['action'] = 'add';

        //--- create test choice
        $table1[] = "reading";
        $table1[] = "listening";
        $table1[] = "speaking";
        $table1[] = "writing";

        for ($part = 1; $part <= 6; $part++) {
            foreach ($table1 as $tbl) {
                $query = $this->db->query('SELECT id, title FROM ' . $this->db->dbprefix($tbl) . ' where ' . $tbl . '_part=' . $part . ' and deleted=0 order by title');
                $i = -1;
                $tbl = $tbl . $part;
                $this->data["sel_" . $tbl] = "<select name='" . $tbl . "' id='sel_" . $tbl . "'>";
                $this->data["sel_" . $tbl].="<option value='0'>--- Please select ---</option>";
                foreach ($query->result_array() as $row) {
                    $i++;
                    $this->data["sel_" . $tbl].="<option value='" . $row["id"] . "'>" . $row["title"] . "</option>";
                }
                $this->data["sel_" . $tbl].="</select>";
            }
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/details', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function edit($id = 0) {
        $this->data['h2_title'] = 'Edit';
        $this->data['action'] = 'edit';

        $this->data['id'] = $id;


        //--- create test choice
        $table1[] = "reading";
        $table1[] = "listening";
        $table1[] = "speaking";
        $table1[] = "writing";

        for ($part = 1; $part <= 6; $part++) {
            foreach ($table1 as $tbl) {
                $query = $this->db->query('SELECT id, title FROM ' . $this->db->dbprefix($tbl) . ' where ' . $tbl . '_part=' . $part . ' and deleted=0 order by title');
                $i = -1;
                $tbl = $tbl . $part;
                $this->data["sel_" . $tbl] = "<select name='" . $tbl . "' id='sel_" . $tbl . "'>";
                $this->data["sel_" . $tbl].="<option value='0'>--- Please select ---</option>";
                foreach ($query->result_array() as $row) {
                    $i++;
                    $this->data["sel_" . $tbl].="<option value='" . $row["id"] . "'>" . $row["title"] . "</option>";
                }
                $this->data["sel_" . $tbl].="</select>";
            }
        }

        $item = $this->Source_test_model->get_entry($id);
        if (isset($item[0]))
            $this->data['item'] = $item[0];

        if (isset($_POST['title'])) {
            $message = $this->validate();

            if ($message == '') {
                $this->Source_test_model->update_entry();

                //--- set pop up message
                $this->session->set_flashdata('message', '<strong>' . $this->input->post('title') . '</strong> is updated.');
                redirect($this->data['link_object']);
            } else {
                $this->data['item'] = $this->post_item();

                //--- set pop up message
                $this->data['notification'] = $message;
            }
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/details', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function delete($id = 0) {
        $this->data['id'] = $id;

        //--- get entry by id
        $item = $this->Source_test_model->get_entry($id);
        if (isset($item[0]))
            $this->data['item'] = $item[0];

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/delete', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function confirm_delete($id = 0) {
        //--- get entry by id
        $item = $this->Source_test_model->get_entry($id);

        //--- set pop up message
        if (isset($item[0]))
            $this->session->set_flashdata('message', '<strong>' . $item[0]->title . '</strong> is deleted.');

        $this->Source_test_model->delete_entry($id);

        //--- redirect to list page
        redirect($this->data['link_object']);
    }

}