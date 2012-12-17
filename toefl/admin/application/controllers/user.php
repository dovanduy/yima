<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    private $object;
    private $theme;
    private $data;

    public function __construct() {
        parent::__construct();

        //--- object name
        $this->object = 'user';
        $this->data['object'] = $this->object;

        //--- check login and set user_info
        check_login($this->object);
        $this->data['user_info'] = $this->session->userdata('user_info');

        //--- default theme
        $this->theme = $this->config->item('theme');

        //--- load object model
        $this->load->model('User_model');

        //--- prepare links
        $this->data['link_base'] = base_url();
        $this->data['link_current'] = $this->data['link_base'] . uri_string();

        $this->data['link_object'] = base_url() . $this->object . '/';
        $this->data['link_search'] = base_url() . $this->object . '/search/';
        $this->data['link_add'] = base_url() . $this->object . '/add/';
        $this->data['link_edit'] = base_url() . $this->object . '/edit/';
        $this->data['link_delete'] = base_url() . $this->object . '/delete/';
        $this->data['link_confirm_delete'] = base_url() . $this->object . '/confirm_delete/';
        //--- end prepare links
        
        $this->data['user_group'][1]='Admin';
        $this->data['user_group'][2]='Staff';
        
        //--- Load campus
        $this->load->model('Campus_model');
        $items = $this->Campus_model->get_all_entries();
        foreach ($items as $item) {
            $campus[$item->id] = $item->title;
        }

        $this->data['campus'] = $campus;
    }

    //--- validate post data
    private function validate() {
        $message = '';

        if ($this->input->post('title') == '')
            $msg[] = 'Please input Username.';

        if ($this->input->post('password') == '' && $this->input->post('action') == 'add')
            $msg[] = 'Please input Username.';

        if ($this->input->post('password') != $_POST['confirm_password'])
            $msg[] = 'Password doesn\'t match.';

        if ($this->input->post('firstname') == '')
            $msg[] = 'Please input First Name.';

        if ($this->input->post('lastname') == '')
            $msg[] = 'Please input Last Name.';

        if ($this->input->post('group_id') == 0)
            $msg[] = 'Please choose Group';

        if (isset($msg))
            $message = implode('<br/>', $msg);

        return($message);
    }

    //--- return $post_item when invalid data
    private function post_item() {
        if (isset($_POST['title'])) {
            $post->title = $this->input->post('title');
            $post->password_post = $this->input->post('password');
            $post->confirm_password = $this->input->post('confirm_password');
            $post->firstname = $this->input->post('firstname');
            $post->lastname = $this->input->post('lastname');
            $post->group_id = $this->input->post('group_id');
            
            $post->campus_id = $this->input->post('campus_id');
            
            $post->qb_view = $this->input->post('qb_view');
            $post->qb_edit = $this->input->post('qb_edit');
            $post->qb_delete = $this->input->post('qb_delete');
            $post->source_view = $this->input->post('source_view');
            $post->source_edit = $this->input->post('source_edit');
            $post->source_delete = $this->input->post('source_delete');
            $post->ss_view = $this->input->post('ss_view');
            $post->ss_edit = $this->input->post('ss_edit');
            $post->ss_delete = $this->input->post('ss_delete');
            $post->ss_source = $this->input->post('ss_source');
            $post->ss_class = $this->input->post('ss_class');
            $post->ss_assign = $this->input->post('ss_assign');
            
            $post->ss_assign_status = $this->input->post('ss_assign_status');
            $post->ss_assign_mixed = $this->input->post('ss_assign_mixed');
            $post->ss_assign_order = $this->input->post('ss_assign_order');
            
            $post->teacher_view = $this->input->post('teacher_view');
            $post->teacher_edit = $this->input->post('teacher_edit');
            $post->teacher_delete = $this->input->post('teacher_delete');
            
            $post->student_view = $this->input->post('student_view');
            $post->student_edit = $this->input->post('student_edit');
            $post->student_delete = $this->input->post('student_delete');
            
            $post->class_view = $this->input->post('class_view');
            $post->class_edit = $this->input->post('class_edit');
            $post->class_delete = $this->input->post('class_delete');
            
            
            return $post;
        }
    }

    public function search() {
        $search_val = $this->input->post('search_val');
        $this->data['search_val'] = $search_val;
        //--- set pop up message
        $this->data['notification'] = "Search for <strong>$search_val</strong>";

        $this->data['items'] = $this->User_model->search_entries();

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
        $config['total_rows'] = $this->User_model->count_all_entries();
        $config['base_url'] = $this->data['link_object'] . 'page/';
        $config['per_page'] = $this->config->item('per_page');

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //--- end generate pagination
        //--- get entry list by page
        $this->data['items'] = $this->User_model->get_entries($start);

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
                $this->User_model->insert_entry();

                //--- set pop up message
                $this->session->set_flashdata('message', '<strong>'.$this->input->post('title').'</strong> is added.');
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
        $item = $this->User_model->get_entry($id);
        if (isset($item[0]))
            $this->data['item'] = $item[0];

        if (isset($_POST['title'])) {
            $message = $this->validate();

            if ($message == '') {
                $this->User_model->update_entry();

                //--- set pop up message
                $this->session->set_flashdata('message', '<strong>'.$this->input->post('title').'</strong> is updated.');
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
        $item = $this->User_model->get_entry($id);
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
        $item = $this->User_model->get_entry($id);

        //--- set pop up message
        if (isset($item[0]))
            $this->session->set_flashdata('message', '<strong>'.$item[0]->title.'</strong> is deleted.');

        $this->User_model->delete_entry($id);

        //--- redirect to list page
        redirect($this->data['link_object']);
    }

}