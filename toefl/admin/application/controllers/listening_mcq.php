<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Listening_mcq extends CI_Controller {

    private $object;
    private $theme;
    private $data;

    public function __construct() {
        parent::__construct();

        //--- object name
        $this->object = 'listening_mcq';
        $this->data['object'] = $this->object;

        //--- check login and set user_info
        check_login($this->object);
        $this->data['user_info'] = $this->session->userdata('user_info');

        //--- default theme
        $this->theme = $this->config->item('theme');

        //--- load object model
        $this->load->model('Listening_mcq_model');
        $this->load->model('Listening_model');

        //--- load part
        $this->data['part'] = $this->session->userdata('part');
        $this->data['lid'] = $this->session->userdata('lid');
        if ($this->data['lid'] != '') {
            $item = $this->Listening_model->get_entry($this->data['lid']);
            $this->data['listening_title'] = $item[0]->title;
        }

        //--- prepare links
        $this->data['link_base'] = base_url();
        $this->data['link_current'] = $this->data['link_base'] . uri_string();

        $this->data['link_object'] = base_url() . $this->object . '/';
        $this->data['link_search'] = base_url() . $this->object . '/search/';
        $this->data['link_add'] = base_url() . $this->object . '/add/';
        $this->data['link_edit'] = base_url() . $this->object . '/edit/';
        $this->data['link_delete'] = base_url() . $this->object . '/delete/';
        $this->data['link_confirm_delete'] = base_url() . $this->object . '/confirm_delete/';
        
        $this->data['link_listening'] = base_url() . 'listening/part/'.$this->data['part'];
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

        $this->data['items'] = $this->Listening_mcq_model->search_entries();

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

    public function listening($id) {
        $this->session->set_userdata('lid', $id);
        redirect($this->data['link_object']);
    }

    public function index($start = 0) {
        //--- set pop up message
        $message = $this->session->flashdata('message');
        if ($message != '')
            $this->data['notification'] = $this->session->flashdata('message');

        //--- generate pagination
        $config = set_default_pagination();
        $config['total_rows'] = $this->Listening_mcq_model->count_all_entries();
        $config['base_url'] = $this->data['link_object'] . 'page/';
        $config['per_page'] = $this->config->item('per_page');

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //--- end generate pagination
        //--- get entry list by page
        $this->data['items'] = $this->Listening_mcq_model->get_entries($start);

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
                $this->Listening_mcq_model->insert_entry();

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
        $item = $this->Listening_mcq_model->get_entry($id);
        if (isset($item[0])){
            $item[0]->answer=explode(',',$item[0]->answer);
            $this->data['item'] = $item[0];
        }
            

        if (isset($_POST['title'])) {
            $message = $this->validate();

            if ($message == '') {
                $this->Listening_mcq_model->update_entry();

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
        $item = $this->Listening_mcq_model->get_entry($id);
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
        $item = $this->Listening_mcq_model->get_entry($id);

        //--- set pop up message
        if (isset($item[0]))
            $this->session->set_flashdata('message', '<strong>' . $item[0]->title . '</strong> is deleted.');

        $this->Listening_mcq_model->delete_entry($id);

        //--- redirect to list page
        redirect($this->data['link_object']);
    }

}