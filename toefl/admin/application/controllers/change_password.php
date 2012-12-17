<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Change_password extends CI_Controller {

    private $object;
    private $theme;
    private $data;

    public function __construct() {
        parent::__construct();

        //--- object name
        $this->object = 'campus';
        $this->data['object'] = $this->object;

        //--- check login and set user_info
        check_login($this->object);
        $this->data['user_info'] = $this->session->userdata('user_info');

        //--- default theme
        $this->theme = $this->config->item('theme');

        //--- load object model
        $this->load->model('Campus_model');

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
    }

    public function index($start = 0) {
        if (isset($_POST['password'])) {
            $message = ($_POST['password']==$_POST['confirm_password'])?'':'Password doesn\'t match. Please try again!';

            if ($message == '') {
                $data->password = md5($this->input->post('password'));
                $this->db->update('user', $data, array('id' => current_user_id()));
                redirect(base_url());
            } else {
                //--- set pop up message
                $this->data['notification'] = $message;
            }
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/change_password', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }
}