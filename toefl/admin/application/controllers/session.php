<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Session extends CI_Controller {

    private $object;
    private $theme;
    private $data;

    public function __construct() {
        parent::__construct();

        //--- object name
        $this->object = 'session';
        $this->data['object'] = $this->object;

        //--- check login and set user_info
        check_login($this->object);
        $this->data['user_info'] = $this->session->userdata('user_info');

        //--- default theme
        $this->theme = $this->config->item('theme');

        //--- load object model
        $this->load->model('Session_model');

        //--- prepare links
        $this->data['link_base'] = base_url();
        $this->data['link_current'] = $this->data['link_base'] . uri_string();

        $this->data['link_object'] = base_url() . $this->object . '/';
        $this->data['link_search'] = base_url() . $this->object . '/search/';
        $this->data['link_add'] = base_url() . $this->object . '/add/';
        $this->data['link_edit'] = base_url() . $this->object . '/edit/';
        $this->data['link_delete'] = base_url() . $this->object . '/delete/';
        $this->data['link_confirm_delete'] = base_url() . $this->object . '/confirm_delete/';

        $this->data['link_source'] = base_url() . $this->object . '/source/';
        $this->data['link_mixed'] = base_url() . $this->object . '/mixed/';
        $this->data['link_class'] = base_url() . $this->object . '/classes/';
        $this->data['link_assign'] = base_url() . $this->object . '/assign/';
        //--- end prepare links
        //Filter By Staff
        if (current_group_id() == 2) {
            $this->db->select('*');
            $this->db->where('deleted', 0);
            $this->db->where('campus_id', $this->data['user_info']['campus_id']);
            $query = $this->db->get('class');
            $filter_classes[] = 0;
            foreach ($query->result() as $item) {
                $filter_classes[] = $item->id;
            }
            $this->session->set_userdata('filter_classes', $filter_classes);

            $this->db->select('*');
            $this->db->where('deleted', 0);
            $this->db->where_in('class_id', $filter_classes);
            $query = $this->db->get('session_class');
            $filter_sessions = 0;
            foreach ($query->result() as $item) {
                $filter_sessions[] = $item->session_id;
            }
            $this->session->set_userdata('filter_sessions', $filter_sessions);
        }
    }

    //--- validate post data
    private function validate() {
        $message = '';

        if ($this->input->post('title') == '')
            $msg[] = 'Please input Session Name.';

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

        $this->data['items'] = $this->Session_model->search_entries();

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
        $config['total_rows'] = $this->Session_model->count_all_entries();
        $config['base_url'] = $this->data['link_object'] . 'page/';
        $config['per_page'] = $this->config->item('per_page');

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //--- end generate pagination
        //--- get entry list by page
        $this->data['items'] = $this->Session_model->get_entries($start);

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
                $this->Session_model->insert_entry();

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
        $item = $this->Session_model->get_entry($id);
        if (isset($item[0]))
            $this->data['item'] = $item[0];

        if (isset($_POST['title'])) {
            $message = $this->validate();

            if ($message == '') {
                $this->Session_model->update_entry();

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
        $item = $this->Session_model->get_entry($id);
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
        $item = $this->Session_model->get_entry($id);

        //--- set pop up message
        if (isset($item[0]))
            $this->session->set_flashdata('message', '<strong>' . $item[0]->title . '</strong> is deleted.');

        $this->Session_model->delete_entry($id);

        //--- redirect to list page
        redirect($this->data['link_object']);
    }

    public function source($session_id = 0) {
        $this->data["session_id"] = $session_id;

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('source_test') . ' where deleted=0 order by title');
        $i = -1;
        foreach ($query->result() as $row) {
            $i++;
            $this->data["source_tests"][$i]["id"] = $row->id;
            $this->data["source_tests"][$i]["title"] = $row->title;
        }

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('session_source_test') . ' where deleted=0 and session_id=' . $session_id);
        foreach ($query->result() as $row) {
            $this->data["session_source_test"][$row->source_test_id] = 1;
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/source', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function source_test_session($action = 'add') {
        $session_id = $this->input->post('session_id');
        $source_test_id = $this->input->post('source_test_id');

        //--- add/remove source test from session
        if ($action == 'add') {
            //Check if existed
            $id = 0;
            $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('session_source_test') . ' where session_id=' . $session_id . ' and source_test_id=' . $source_test_id);
            foreach ($query->result() as $row) {
                $id = $row->id;
            }

            //Add new or revert
            if ($id == 0) {
                $this->db->query('insert into ' . $this->db->dbprefix('session_source_test') . ' 
                                          (session_id,source_test_id) 
                                          values ("' . $session_id . '","' . $source_test_id . '")');
            } else {
                $this->db->query('update ' . $this->db->dbprefix('session_source_test') . ' set deleted=0 where session_id=' . $session_id . ' and source_test_id=' . $source_test_id);
            }
        } else {
            $this->db->query('update ' . $this->db->dbprefix('session_source_test') . ' set deleted=1 where session_id=' . $session_id . ' and source_test_id=' . $source_test_id);
        }

        //--- prepare mixed test
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('session') . ' where id=' . $session_id);
        foreach ($query->result() as $row) {
            $session_title = $row->title;
        }

        $source_test[] = 0;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('session_source_test') . ' where deleted=0 and session_id=' . $session_id);
        foreach ($query->result() as $row) {
            $source_test[] = $row->source_test_id;
        }
        $source_tests = implode(',', $source_test);

        $this->create_mixed_test($session_id, $session_title, $source_tests);
    }

    public function mixed($session_id = 0) {
        $query = $this->db->query('SELECT mt.id, mt.title,
                    (select r.title from ' . $this->db->dbprefix('reading') . ' r where r.id=mt.reading1 limit 0,1) as reading1,
                    (select r.title from ' . $this->db->dbprefix('reading') . ' r where r.id=mt.reading2 limit 0,1) as reading2,
                    (select r.title from ' . $this->db->dbprefix('reading') . ' r where r.id=mt.reading3 limit 0,1) as reading3,
                    (select r.title from ' . $this->db->dbprefix('listening') . ' r where r.id=mt.listening1 limit 0,1) as listening1,
                    (select r.title from ' . $this->db->dbprefix('listening') . ' r where r.id=mt.listening2 limit 0,1) as listening2,
                    (select r.title from ' . $this->db->dbprefix('listening') . ' r where r.id=mt.listening3 limit 0,1) as listening3,
                    (select r.title from ' . $this->db->dbprefix('listening') . ' r where r.id=mt.listening4 limit 0,1) as listening4,
                    (select r.title from ' . $this->db->dbprefix('listening') . ' r where r.id=mt.listening5 limit 0,1) as listening5,
                    (select r.title from ' . $this->db->dbprefix('listening') . ' r where r.id=mt.listening6 limit 0,1) as listening6,
                    (select r.title from ' . $this->db->dbprefix('speaking') . ' r where r.id=mt.speaking1 limit 0,1) as speaking1,
                    (select r.title from ' . $this->db->dbprefix('speaking') . ' r where r.id=mt.speaking2 limit 0,1) as speaking2,
                    (select r.title from ' . $this->db->dbprefix('speaking') . ' r where r.id=mt.speaking3 limit 0,1) as speaking3,
                    (select r.title from ' . $this->db->dbprefix('speaking') . ' r where r.id=mt.speaking4 limit 0,1) as speaking4,
                    (select r.title from ' . $this->db->dbprefix('speaking') . ' r where r.id=mt.speaking5 limit 0,1) as speaking5,
                    (select r.title from ' . $this->db->dbprefix('speaking') . ' r where r.id=mt.speaking6 limit 0,1) as speaking6,
                    (select r.title from ' . $this->db->dbprefix('writing') . ' r where r.id=mt.writing1 limit 0,1) as writing1,
                    (select r.title from ' . $this->db->dbprefix('writing') . ' r where r.id=mt.writing2 limit 0,1) as writing2
                    FROM ' . $this->db->dbprefix('mixed_test') . ' mt 
                    WHERE mt.deleted=0 and mt.session=' . $session_id . ' order by mt.title');

        $i = -1;
        foreach ($query->result() as $row) {
            $i++;
            $this->data["mixed_tests"][$i]["id"] = $row->id;
            $this->data["mixed_tests"][$i]["title"] = $row->title;

            $this->data["mixed_tests"][$i]["reading1"] = $row->reading1;
            $this->data["mixed_tests"][$i]["reading2"] = $row->reading2;
            $this->data["mixed_tests"][$i]["reading3"] = $row->reading3;

            $this->data["mixed_tests"][$i]["listening1"] = $row->listening1;
            $this->data["mixed_tests"][$i]["listening2"] = $row->listening2;
            $this->data["mixed_tests"][$i]["listening3"] = $row->listening3;
            $this->data["mixed_tests"][$i]["listening4"] = $row->listening4;
            $this->data["mixed_tests"][$i]["listening5"] = $row->listening5;
            $this->data["mixed_tests"][$i]["listening6"] = $row->listening6;

            $this->data["mixed_tests"][$i]["speaking1"] = $row->speaking1;
            $this->data["mixed_tests"][$i]["speaking2"] = $row->speaking2;
            $this->data["mixed_tests"][$i]["speaking3"] = $row->speaking3;
            $this->data["mixed_tests"][$i]["speaking4"] = $row->speaking4;
            $this->data["mixed_tests"][$i]["speaking5"] = $row->speaking5;
            $this->data["mixed_tests"][$i]["speaking6"] = $row->speaking6;

            $this->data["mixed_tests"][$i]["writing1"] = $row->writing1;
            $this->data["mixed_tests"][$i]["writing2"] = $row->writing2;
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/mixed', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function classes($session_id = 0) {
        $filter_class = '';
        if (current_group_id() == 2)
            $filter_class = ' and id in (' . implode(',', $this->session->userdata('filter_classes')) . ') ';

        $this->data["session_id"] = $session_id;

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('class') . ' where deleted=0 ' . $filter_class . ' order by title');
        $i = -1;
        foreach ($query->result() as $row) {
            $i++;
            $this->data["classes"][$i]["id"] = $row->id;
            $this->data["classes"][$i]["title"] = $row->title;
        }

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('session_class') . ' where deleted=0 and session_id=' . $session_id);
        foreach ($query->result() as $row) {
            $this->data["session_class"][$row->class_id] = 1;
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/class', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view        
    }

    public function class_session($action = 'add') {
        $session_id = $this->input->post('session_id');
        $class_id = $this->input->post('class_id');

        //--- add/remove source test from session
        if ($action == 'add') {
            //add or revert class from session
            $id = 0;
            $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('session_class') . ' where session_id=' . $session_id . ' and class_id=' . $class_id);
            foreach ($query->result() as $row) {
                $id = $row->id;
            }

            if ($id == 0) {
                $this->db->query('insert into ' . $this->db->dbprefix('session_class') . ' 
                                          (session_id,class_id) 
                                          values ("' . $session_id . '","' . $class_id . '")');
            } else {
                $this->db->query('update ' . $this->db->dbprefix('session_class') . ' set deleted=0 where session_id=' . $session_id . ' and class_id=' . $class_id);
            }
            //------------------------------------
            //add or revert student from session
            $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('class_student') . ' where deleted=0 and class_id=' . $class_id);
            foreach ($query->result() as $row) {
                //check if existed
                $id = 0;
                $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('session_student') . ' where session=' . $session_id . ' and student=' . $row->student_id . ' and class=' . $class_id);
                foreach ($query1->result() as $row1) {
                    $id = $row1->id;
                }

                $mixed_test = 0;
                $query1 = $this->db->query('SELECT id FROM ' . $this->db->dbprefix('mixed_test') . ' where session=' . $session_id . ' and deleted=0 limit 0,1');
                foreach ($query1->result() as $row1) {
                    $mixed_test = $row1->id;
                }

                if ($id == 0) {
                    $this->db->query('insert into ' . $this->db->dbprefix('session_student') . ' 
                                          (session,class,student,mixed_test) 
                                          values ("' . $session_id . '","' . $class_id . '","' . $row->student_id . '","' . $mixed_test . '")');
                } else {
                    $this->db->query('update ' . $this->db->dbprefix('session_student') . ' set deleted=0 where id=' . $id);
                }
            }
            //----------------------------------
        } else {
            //remove class from session
            $this->db->query('update ' . $this->db->dbprefix('session_class') . ' set deleted=1 where session_id=' . $session_id . ' and class_id=' . $class_id);

            //remove student from session
            $this->db->query('update ' . $this->db->dbprefix('session_student') . ' set deleted=1 where session=' . $session_id . ' and class=' . $class_id);
        }
    }

    public function assign($session_id = 0) {
        $filter_class = '';
        if (current_group_id() == 2)
            $filter_class = ' and ss.class in (' . implode(',', $this->session->userdata('filter_classes')) . ') ';

        $query = $this->db->query('SELECT ss.id,ss.student,ss.mixed_test,ss.test_order, ss.disabled, ss.status, ss.refreshR,ss.refreshL,ss.refreshS,ss.refreshW,
                    ss.sk_teacher_id,ss.sk_date,ss.wt_teacher_id,ss.wt_date,
                    (select s.title from ' . $this->db->dbprefix('user') . ' s where s.id=ss.sk_teacher_id limit 0,1) as sk_teacher,
                    (select s.title from ' . $this->db->dbprefix('user') . ' s where s.id=ss.wt_teacher_id limit 0,1) as wt_teacher,
                    (select c.title from ' . $this->db->dbprefix('class') . ' c where c.id=ss.class limit 0,1) as class,
                    (select s.firstname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as firstname,
                    (select s.lastname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as lastname
                    FROM ' . $this->db->dbprefix('session_student') . ' ss where deleted=0 ' . $filter_class . ' and session=' . $session_id);
        $i = -1;
        foreach ($query->result() as $row) {
            $i++;
            $this->data["assigns"][$i]["sk_teacher_id"] = $row->sk_teacher_id;
            $this->data["assigns"][$i]["sk_teacher"] = $row->sk_teacher;
            $this->data["assigns"][$i]["sk_date"] = $row->sk_date;
            $this->data["assigns"][$i]["wt_teacher_id"] = $row->wt_teacher_id;
            $this->data["assigns"][$i]["wt_teacher"] = $row->wt_teacher;
            $this->data["assigns"][$i]["wt_date"] = $row->wt_date;
            
            $this->data["assigns"][$i]["refreshR"] = $row->refreshR;
            $this->data["assigns"][$i]["refreshL"] = $row->refreshL;
            $this->data["assigns"][$i]["refreshS"] = $row->refreshS;
            $this->data["assigns"][$i]["refreshW"] = $row->refreshW;

            $this->data["assigns"][$i]["class"] = $row->class;
            $this->data["assigns"][$i]["fullname"] = $row->firstname . " " . $row->lastname;

            $this->data["assigns"][$i]["disabled"] = "<select class='sel_disabled' id='sel_disabled_" . $row->id . "' alt='" . $row->id . "'>";
            $this->data["assigns"][$i]["disabled"].="<option value='0' ";
            if ($row->disabled == 0)
                $this->data["assigns"][$i]["disabled"].=" selected='selected' ";
            $this->data["assigns"][$i]["disabled"].=" >Enabled</option>";
            $this->data["assigns"][$i]["disabled"].="<option value='1' ";
            if ($row->disabled == 1)
                $this->data["assigns"][$i]["disabled"].=" selected='selected' ";
            $this->data["assigns"][$i]["disabled"].=" >Disabled</option>";
            $this->data["assigns"][$i]["disabled"].="</select>";

            $this->data["assigns"][$i]["status"] = "<select class='sel_status' id='sel_status_" . $row->id . "' alt='" . $row->id . "'>";
            $this->data["assigns"][$i]["status"].="<option value='0' ";
            if ($row->status == 0)
                $this->data["assigns"][$i]["status"].=" selected='selected' ";
            $this->data["assigns"][$i]["status"].=" >Not Tested</option>";
            $this->data["assigns"][$i]["status"].="<option value='1' ";
            if ($row->status == 1)
                $this->data["assigns"][$i]["status"].=" selected='selected' ";
            $this->data["assigns"][$i]["status"].=" >Tested</option>";
            $this->data["assigns"][$i]["status"].="</select>";

            //prepare $this->data["assigns"][$i]["mixed_tests"]
            $query1 = $this->db->query('SELECT mt.id, mt.title                    
                    FROM ' . $this->db->dbprefix('mixed_test') . ' mt 
                    WHERE mt.deleted=0 and mt.session=' . $session_id . ' order by mt.title');

            $this->data["assigns"][$i]["mixed_tests"] = "<select class='sel_mixed_tests' id='sel_mixed_tests_" . $row->id . "' alt='" . $row->id . "'>";
            $this->data["assigns"][$i]["mixed_tests"].="<option value='0'>--- Please select ---</option>";
            foreach ($query1->result_array() as $row1) {
                $this->data["assigns"][$i]["mixed_tests"].="<option value='" . $row1["id"] . "' ";
                if ($row1["id"] == $row->mixed_test)
                    $this->data["assigns"][$i]["mixed_tests"].=" selected='selected' ";
                $this->data["assigns"][$i]["mixed_tests"].=" >" . $row1["title"] . "</option>";
            }
            $this->data["assigns"][$i]["mixed_tests"].="</select>";

            //prepare $this->data["assigns"][$i]["test_orders"]
            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('test_order'));

            $this->data["assigns"][$i]["test_orders"] = "<select class='sel_test_orders' id='sel_test_orders_" . $row->id . "' alt='" . $row->id . "'>";
            $this->data["assigns"][$i]["test_orders"].="<option value='0'>--- Please select ---</option>";
            foreach ($query1->result_array() as $row1) {
                $this->data["assigns"][$i]["test_orders"].="<option value='" . $row1["id"] . "' ";
                if ($row1["id"] == $row->test_order)
                    $this->data["assigns"][$i]["test_orders"].=" selected='selected' ";
                $this->data["assigns"][$i]["test_orders"].=" >" . $row1["title"] . "</option>";
            }
            $this->data["assigns"][$i]["test_orders"].="</select>";
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/assign', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function update_sel_mixed_tests() {
        $id = $this->input->post('id');
        $mixed_test = $this->input->post('mixed_test');
        $this->db->query('update ' . $this->db->dbprefix('session_student') . ' set mixed_test=' . $mixed_test . ' where id=' . $id);
    }

    public function update_sel_disabled() {
        $id = $this->input->post('id');
        $disabled = $this->input->post('disabled');
        $this->db->query('update ' . $this->db->dbprefix('session_student') . ' set disabled=' . $disabled . ' where id=' . $id);
    }

    public function update_sel_status() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $this->db->query('update ' . $this->db->dbprefix('session_student') . ' set status=' . $status . ' where id=' . $id);
    }

    public function update_sel_test_orders() {
        $id = $this->input->post('id');
        $test_order = $this->input->post('test_order');
        $this->db->query('update ' . $this->db->dbprefix('session_student') . ' set current_step=0, test_order=' . $test_order . ' where id=' . $id);
    }

    private function create_mixed_test($session, $session_title, $source_test) {
        $this->load->database();

        $this->db->query('update ' . $this->db->dbprefix('mixed_test') . ' set deleted="1" where session="' . $session . '"');

        if ($source_test != '0') {
            $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('source_test') . ' where deleted=0 and id in (' . $source_test . ') order by title');
            $i = -1;
            foreach ($query->result() as $row) {
                $i++;
                $tests[$i]["title"] = 'MT' . str_pad(($i + 1), 5, "0", STR_PAD_LEFT) . ' - ' . $session_title;

                $tests[$i]["reading1"] = $row->reading1;
                $tests[$i]["reading2"] = $row->reading2;
                $tests[$i]["reading3"] = $row->reading3;

                $tests[$i]["listening1"] = $row->listening1;
                $tests[$i]["listening2"] = $row->listening2;
                $tests[$i]["listening3"] = $row->listening3;
                $tests[$i]["listening4"] = $row->listening4;
                $tests[$i]["listening5"] = $row->listening5;
                $tests[$i]["listening6"] = $row->listening6;

                $tests[$i]["speaking1"] = $row->speaking1;
                $tests[$i]["speaking2"] = $row->speaking2;
                $tests[$i]["speaking3"] = $row->speaking3;
                $tests[$i]["speaking4"] = $row->speaking4;
                $tests[$i]["speaking5"] = $row->speaking5;
                $tests[$i]["speaking6"] = $row->speaking6;

                $tests[$i]["writing1"] = $row->writing1;
                $tests[$i]["writing2"] = $row->writing2;
            }

            $count = $i;
            $k = $i;
            for ($i = 0; $i <= $count - 1; $i++) {
                for ($j = $i + 1; $j <= $count; $j++) {
                    $k++;
                    $tests[$k]["title"] = 'MT' . str_pad(($k + 1), 5, "0", STR_PAD_LEFT) . ' - ' . $session_title;

                    $tests[$k]["reading1"] = $tests[$i]["reading1"];
                    $tests[$k]["reading2"] = $tests[$i]["reading2"];
                    $tests[$k]["reading3"] = $tests[$i]["reading3"];

                    $tests[$k]["listening1"] = $tests[$i]["listening1"];
                    $tests[$k]["listening2"] = $tests[$i]["listening2"];
                    $tests[$k]["listening3"] = $tests[$i]["listening3"];
                    $tests[$k]["listening4"] = $tests[$i]["listening4"];
                    $tests[$k]["listening5"] = $tests[$i]["listening5"];
                    $tests[$k]["listening6"] = $tests[$i]["listening6"];

                    $tests[$k]["speaking1"] = $tests[$j]["speaking1"];
                    $tests[$k]["speaking2"] = $tests[$j]["speaking2"];
                    $tests[$k]["speaking3"] = $tests[$j]["speaking3"];
                    $tests[$k]["speaking4"] = $tests[$j]["speaking4"];
                    $tests[$k]["speaking5"] = $tests[$j]["speaking5"];
                    $tests[$k]["speaking6"] = $tests[$j]["speaking6"];

                    $tests[$k]["writing1"] = $tests[$j]["writing1"];
                    $tests[$k]["writing2"] = $tests[$j]["writing2"];

                    $k++;
                    $tests[$k]["title"] = 'MT' . str_pad(($k + 1), 5, "0", STR_PAD_LEFT) . ' - ' . $session_title;

                    $tests[$k]["reading1"] = $tests[$j]["reading1"];
                    $tests[$k]["reading2"] = $tests[$j]["reading2"];
                    $tests[$k]["reading3"] = $tests[$j]["reading3"];

                    $tests[$k]["listening1"] = $tests[$j]["listening1"];
                    $tests[$k]["listening2"] = $tests[$j]["listening2"];
                    $tests[$k]["listening3"] = $tests[$j]["listening3"];
                    $tests[$k]["listening4"] = $tests[$j]["listening4"];
                    $tests[$k]["listening5"] = $tests[$j]["listening5"];
                    $tests[$k]["listening6"] = $tests[$j]["listening6"];

                    $tests[$k]["speaking1"] = $tests[$i]["speaking1"];
                    $tests[$k]["speaking2"] = $tests[$i]["speaking2"];
                    $tests[$k]["speaking3"] = $tests[$i]["speaking3"];
                    $tests[$k]["speaking4"] = $tests[$i]["speaking4"];
                    $tests[$k]["speaking5"] = $tests[$i]["speaking5"];
                    $tests[$k]["speaking6"] = $tests[$i]["speaking6"];

                    $tests[$k]["writing1"] = $tests[$i]["writing1"];
                    $tests[$k]["writing2"] = $tests[$i]["writing2"];

                    $k++;
                    $tests[$k]["title"] = 'MT' . str_pad(($k + 1), 5, "0", STR_PAD_LEFT) . ' - ' . $session_title;

                    $tests[$k]["reading1"] = $tests[$i]["reading1"];
                    $tests[$k]["reading2"] = $tests[$i]["reading2"];
                    $tests[$k]["reading3"] = $tests[$i]["reading3"];

                    $tests[$k]["listening1"] = $tests[$j]["listening1"];
                    $tests[$k]["listening2"] = $tests[$j]["listening2"];
                    $tests[$k]["listening3"] = $tests[$j]["listening3"];
                    $tests[$k]["listening4"] = $tests[$j]["listening4"];
                    $tests[$k]["listening5"] = $tests[$j]["listening5"];
                    $tests[$k]["listening6"] = $tests[$j]["listening6"];

                    $tests[$k]["speaking1"] = $tests[$i]["speaking1"];
                    $tests[$k]["speaking2"] = $tests[$i]["speaking2"];
                    $tests[$k]["speaking3"] = $tests[$i]["speaking3"];
                    $tests[$k]["speaking4"] = $tests[$i]["speaking4"];
                    $tests[$k]["speaking5"] = $tests[$i]["speaking5"];
                    $tests[$k]["speaking6"] = $tests[$i]["speaking6"];

                    $tests[$k]["writing1"] = $tests[$j]["writing1"];
                    $tests[$k]["writing2"] = $tests[$j]["writing2"];

                    $k++;
                    $tests[$k]["title"] = 'MT' . str_pad(($k + 1), 5, "0", STR_PAD_LEFT) . ' - ' . $session_title;

                    $tests[$k]["reading1"] = $tests[$j]["reading1"];
                    $tests[$k]["reading2"] = $tests[$j]["reading2"];
                    $tests[$k]["reading3"] = $tests[$j]["reading3"];

                    $tests[$k]["listening1"] = $tests[$i]["listening1"];
                    $tests[$k]["listening2"] = $tests[$i]["listening2"];
                    $tests[$k]["listening3"] = $tests[$i]["listening3"];
                    $tests[$k]["listening4"] = $tests[$i]["listening4"];
                    $tests[$k]["listening5"] = $tests[$i]["listening5"];
                    $tests[$k]["listening6"] = $tests[$i]["listening6"];

                    $tests[$k]["speaking1"] = $tests[$j]["speaking1"];
                    $tests[$k]["speaking2"] = $tests[$j]["speaking2"];
                    $tests[$k]["speaking3"] = $tests[$j]["speaking3"];
                    $tests[$k]["speaking4"] = $tests[$j]["speaking4"];
                    $tests[$k]["speaking5"] = $tests[$j]["speaking5"];
                    $tests[$k]["speaking6"] = $tests[$j]["speaking6"];

                    $tests[$k]["writing1"] = $tests[$i]["writing1"];
                    $tests[$k]["writing2"] = $tests[$i]["writing2"];
                }
            }

            foreach ($tests as $test) {
                $this->db->query('insert into ' . $this->db->dbprefix('mixed_test') . ' 
                                          (title, session, 
                                          reading1, reading2, reading3,
                                          listening1, listening2, listening3, listening4, listening5, listening6,
                                          speaking1, speaking2, speaking3, speaking4, speaking5, speaking6,
                                          writing1, writing2) 
                                          values ("' . $test['title'] . '","' . $session . '",
                                          "' . $test['reading1'] . '","' . $test['reading2'] . '","' . $test['reading3'] . '",
                                          "' . $test['listening1'] . '","' . $test['listening2'] . '","' . $test['listening3'] . '","' . $test['listening4'] . '","' . $test['listening5'] . '","' . $test['listening6'] . '",
                                          "' . $test['speaking1'] . '","' . $test['speaking2'] . '","' . $test['speaking3'] . '","' . $test['speaking4'] . '","' . $test['speaking5'] . '","' . $test['speaking6'] . '",
                                          "' . $test['writing1'] . '","' . $test['writing2'] . '")');
            }
        }
    }

}