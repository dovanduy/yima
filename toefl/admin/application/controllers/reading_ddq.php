<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reading_ddq extends CI_Controller {

    private $object;
    private $theme;
    private $data;

    public function __construct() {
        parent::__construct();

        //--- object name
        $this->object = 'reading_ddq';
        $this->data['object'] = $this->object;

        //--- check login and set user_info
        check_login($this->object);
        $this->data['user_info'] = $this->session->userdata('user_info');

        //--- default theme
        $this->theme = $this->config->item('theme');

        //--- load object model
        $this->load->model('Reading_ddq_model');
        $this->load->model('Reading_model');

        //--- load part
        $this->data['part'] = $this->session->userdata('part');
        $this->data['rid'] = $this->session->userdata('rid');
        if ($this->data['rid'] != '') {
            $item = $this->Reading_model->get_entry($this->data['rid']);
            $this->data['reading_title'] = $item[0]->title;
            $this->data['reading_content'] = $item[0]->content;
        }

        //--- prepare links
        $this->data['link_base'] = base_url();
        $this->data['link_current'] = $this->data['link_base'] . uri_string();

        $this->data['link_object'] = base_url() . $this->object . '/';
        $this->data['link_search'] = base_url() . $this->object . '/search/';
        $this->data['link_add'] = base_url() . $this->object . '/add/';
        $this->data['link_edit'] = base_url() . $this->object . '/edit/';
        $this->data['link_manage'] = base_url() . $this->object . '/manage/';
        $this->data['link_delete'] = base_url() . $this->object . '/delete/';
        $this->data['link_confirm_delete'] = base_url() . $this->object . '/confirm_delete/';

        $this->data['link_reading'] = base_url() . 'reading/part/' . $this->data['part'];
        //--- end prepare links
    }

    //--- validate post data
    private function validate() {
        $message = '';

        if ($this->input->post('title') == '')
            $msg[] = 'Please input Question.';

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

        $this->data['items'] = $this->Reading_ddq_model->search_entries();

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

    public function reading($id) {
        $this->session->set_userdata('rid', $id);
        redirect($this->data['link_object']);
    }

    public function index($start = 0) {
        //--- set pop up message
        $message = $this->session->flashdata('message');
        if ($message != '')
            $this->data['notification'] = $this->session->flashdata('message');

        //--- generate pagination
        $config = set_default_pagination();
        $config['total_rows'] = $this->Reading_ddq_model->count_all_entries();
        $config['base_url'] = $this->data['link_object'] . 'page/';
        $config['per_page'] = $this->config->item('per_page');

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //--- end generate pagination
        //--- get entry list by page
        $this->data['items'] = $this->Reading_ddq_model->get_entries($start);

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
                $this->Reading_ddq_model->insert_entry();

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
        $item = $this->Reading_ddq_model->get_entry($id);
        if (isset($item[0]))
            $this->data['item'] = $item[0];

        if (isset($_POST['title'])) {
            $message = $this->validate();

            if ($message == '') {
                $this->Reading_ddq_model->update_entry();

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
        $item = $this->Reading_ddq_model->get_entry($id);
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
        $item = $this->Reading_ddq_model->get_entry($id);

        //--- set pop up message
        if (isset($item[0]))
            $this->session->set_flashdata('message', '<strong>' . $item[0]->title . '</strong> is deleted.');

        $this->Reading_ddq_model->delete_entry($id);

        //--- redirect to list page
        redirect($this->data['link_object']);
    }

    public function manage($ddqid = 0) {
        if ($ddqid == 0)
            redirect($this->data['link_object']);

        $this->data['ddqid'] = $ddqid;

        $item = $this->Reading_ddq_model->get_entry($ddqid);
        if (isset($item[0]))
            $this->data['item'] = $item[0];

        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/manage', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
    }

    public function load_subjects($ddqid = 0) {
        $items = $this->Reading_ddq_model->load_subjects($ddqid);
        $i = -1;
        foreach ($items as $row) {
            $i++;
            $response[$i] = $row->id;
            $i++;
            $title = $row->title;
            $response[$i] = $title;
        }
        $response['count'] = $i;
        echo json_encode($response);
    }

    public function add_subject() {
        $ddqid = $this->input->post('ddqid');
        $title = $this->input->post('title');

        $id = $this->Reading_ddq_model->add_subject($ddqid, $title);

        $response['status'] = 'success';
        $response['id'] = $id;

        echo json_encode($response);
    }

    public function delete_subject($id = 0) {
        $this->Reading_ddq_model->delete_subject($id);
    }

    public function update_subject() {
        $id = $this->input->post('id');
        $title = $this->input->post('title');

        $this->Reading_ddq_model->update_subject($id, $title);
    }

    public function load_choices($ddqid = 0) {
        $items = $this->Reading_ddq_model->load_choices($ddqid);
        $i = -1;
        foreach ($items as $row) {
            $i++;
            $response[$i] = $row->id;
            $i++;
            $response[$i] = $row->subid;
            $i++;
            $response[$i] = $row->title;
        }
        $response['count'] = $i;
        echo json_encode($response);
    }

    public function delete_choice($id = 0) {
        $this->Reading_ddq_model->delete_choice($id);
    }

    public function add_choice() {
        $ddqid = $this->input->post('ddqid');
        $title = $this->input->post('title');

        $id = $this->Reading_ddq_model->add_choice($ddqid, $title);
        
        $response['status'] = 'success';
        $response['id'] = $id;

        echo json_encode($response);
    }

    public function update_choice() {
        $id = $this->input->post('id');
        $title = $this->input->post('title');

        $this->Reading_ddq_model->update_choice($id, $title);
    }

    public function update_choice_subject() {
        $id = $this->input->post('id');
        $subid = $this->input->post('subid');

        $this->Reading_ddq_model->update_choice_subject($id, $subid);
    }

}