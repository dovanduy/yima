<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Classes extends CI_Controller {

    private $object;
    private $theme;
    private $data;

    public function __construct() {
        parent::__construct();

        //--- object name
        $this->object = 'class';
        $this->data['object'] = $this->object;

        //--- check login and set user_info
        check_login($this->object);
        $this->data['user_info'] = $this->session->userdata('user_info');

        //--- default theme
        $this->theme = $this->config->item('theme');

        //--- load object model
        $this->load->model('Class_model');

        //--- prepare links
        $this->data['link_base'] = base_url();
        $this->data['link_current'] = $this->data['link_base'] . uri_string();

        $this->data['link_object'] = base_url() . $this->object . 'es/';
        $this->data['link_search'] = base_url() . $this->object . 'es/search/';
        $this->data['link_add'] = base_url() . $this->object . 'es/add/';
        $this->data['link_assign_teacher'] = base_url() . $this->object . 'es/assign_teacher/';
        $this->data['link_assign_student'] = base_url() . $this->object . 'es/assign_student/';
        $this->data['link_edit'] = base_url() . $this->object . 'es/edit/';
        $this->data['link_delete'] = base_url() . $this->object . 'es/delete/';
        $this->data['link_confirm_delete'] = base_url() . $this->object . 'es/confirm_delete/';
        //--- end prepare links
        //--- Load campus
        $this->load->model('Campus_model');
        $items = $this->Campus_model->get_all_entries();
        foreach ($items as $item) {
            if ($this->data['user_info']['group_id'] == 2) {
                if ($item->id == $this->data['user_info']['campus_id'])
                    $campus[$item->id] = $item->title;
            }else {
                $campus[$item->id] = $item->title;
            }
        }

        $this->data['campus'] = $campus;
    }

    //--- validate post data
    private function validate() {
        $message = '';

        if ($this->input->post('campus_id') == 0)
            $msg[] = 'Please choose Campus.';

        if ($this->input->post('title') == '')
            $msg[] = 'Please input Class Name.';

        if (isset($msg))
            $message = implode('<br/>', $msg);

        return($message);
    }

    //--- return $post_item when invalid data
    private function post_item() {
        if (isset($_POST['title'])) {
            $post->campus_id = $this->input->post('campus_id');
            $post->title = $this->input->post('title');
            return $post;
        }
    }

    public function search() {
        $search_val = $this->input->post('search_val');
        $this->data['search_val'] = $search_val;
        //--- set pop up message
        $this->data['notification'] = "Search for <strong>$search_val</strong>";

        $this->data['items'] = $this->Class_model->search_entries();

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
        $config['total_rows'] = $this->Class_model->count_all_entries();
        $config['base_url'] = $this->data['link_object'] . 'page/';
        $config['per_page'] = $this->config->item('per_page');

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //--- end generate pagination
        //--- get entry list by page
        $this->data['items'] = $this->Class_model->get_entries($start);

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/list', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function add() {
        if (isset($_POST['title'])) {
            $message = $this->validate();

            if ($message == '') {
                //--- insert entry to database
                $this->Class_model->insert_entry();

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
        $item = $this->Class_model->get_entry($id);
        if (isset($item[0]))
            $this->data['item'] = $item[0];

        if (isset($_POST['title'])) {
            $message = $this->validate();

            if ($message == '') {
                $this->Class_model->update_entry();

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
        $item = $this->Class_model->get_entry($id);
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
        $item = $this->Class_model->get_entry($id);

        //--- set pop up message
        if (isset($item[0]))
            $this->session->set_flashdata('message', '<strong>' . $item[0]->title . '</strong> is deleted.');

        $this->Class_model->delete_entry($id);

        //--- redirect to list page
        redirect($this->data['link_object']);
    }

    public function assign_teacher($id = 0) {
        $this->data['class_id'] = $id;

        //--- load object model
        $this->load->model('Teacher_model');

        if (isset($_POST['search_val']) && $_POST['search_val'] != '') {
            $this->data['items'] = $this->Teacher_model->search_entries();
        } else {
            $this->data['items'] = $this->Teacher_model->get_all_entries();
        }

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('class_teacher') . ' where deleted=0 and class_id=' . $id);
        foreach ($query->result() as $row) {
            $this->data["classes"][$row->teacher_id] = 1;
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/assign_teacher', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function teacher_remove_from_class() {
        $response['status'] = 'success';

        $class_id = $this->input->post('class_id');
        $teacher_id = $this->input->post('teacher_id');

        $this->db->query('update ' . $this->db->dbprefix('class_teacher') . ' set deleted=1 where class_id=' . $class_id . ' and teacher_id=' . $teacher_id);
        echo json_encode($response);
    }

    public function teacher_add_to_class() {
        $response['status'] = 'success';

        $class_id = $this->input->post('class_id');
        $teacher_id = $this->input->post('teacher_id');

        $id = 0;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('class_teacher') . ' where class_id=' . $class_id . ' and teacher_id=' . $teacher_id);
        foreach ($query->result() as $row) {
            $id = $row->id;
        }

        if ($id == 0) {
            $this->db->query('insert into ' . $this->db->dbprefix('class_teacher') . '
                                          (class_id,teacher_id)
                                          values ("' . $class_id . '","' . $teacher_id . '")');
        } else {
            $this->db->query('update ' . $this->db->dbprefix('class_teacher') . ' set deleted=0 where class_id=' . $class_id . ' and teacher_id=' . $teacher_id);
        }

        echo json_encode($response);
    }

    public function assign_student($id = 0, $campus_id = 0) {
        $this->data['class_id'] = $id;

        //--- load object model
        $this->load->model('Student_model');

        $this->data['items'] = $this->Student_model->get_all_entries_by_campus($campus_id);

        //--- Load campus
        $this->load->model('Campus_model');
        $items = $this->Campus_model->get_all_entries();
        foreach ($items as $item) {
            $campus[$item->id] = $item->title;
        }

        $this->data['campus'] = $campus;

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('class_student') . ' where deleted=0 and class_id=' . $id);
        foreach ($query->result() as $row) {
            $this->data["classes"][$row->student_id] = 1;
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/assign_student', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function student_remove_from_class() {
        $response['status'] = 'success';

        $class_id = $this->input->post('class_id');
        $student_id = $this->input->post('student_id');

        $this->db->query('update ' . $this->db->dbprefix('class_student') . ' set deleted=1 where class_id=' . $class_id . ' and student_id=' . $student_id);
        echo json_encode($response);
    }

    public function student_add_to_class() {
        $response['status'] = 'success';

        $class_id = $this->input->post('class_id');
        $student_id = $this->input->post('student_id');

        $id = 0;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('class_student') . ' where class_id=' . $class_id . ' and student_id=' . $student_id);
        foreach ($query->result() as $row) {
            $id = $row->id;
        }

        if ($id == 0) {
            $this->db->query('insert into ' . $this->db->dbprefix('class_student') . '
                                          (class_id,student_id)
                                          values ("' . $class_id . '","' . $student_id . '")');
        } else {
            $this->db->query('update ' . $this->db->dbprefix('class_student') . ' set deleted=0 where class_id=' . $class_id . ' and student_id=' . $student_id);
        }

        echo json_encode($response);
    }

}