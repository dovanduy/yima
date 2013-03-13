<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {        
        //--- default theme
        $this->theme = $this->config->item('theme');

        //--- load view
        $this->load->view($this->theme . '/login');
    }

    public function logout() {
        $user_info = $this->session->userdata('user_info');
        if (isset($user_info))
            $this->session->unset_userdata('user_info');

        $back_url = $this->session->userdata('back_url');
        header('location: ' . base_url() . $back_url);
    }

    public function check() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('user') . ' where deleted=0 and title="' . $username . '" and password="' . md5($password) . '"');
        if ($query->num_rows > 0) {
            //--- set back_url
            $response['back_url'] = $this->session->userdata('back_url');
            $response['status'] = 'success';

            //--- set user info
            foreach ($query->result() as $row) {
                $user_info['id'] = $row->id;
                $user_info['username'] = $row->title;
                $user_info['firstname'] = $row->firstname;
                $user_info['lastname'] = $row->lastname;
                $user_info['group_id'] = $row->group_id;
                $user_info['campus_id'] = $row->campus_id;

                switch ($user_info['group_id']) {
                    case 1: //admin
                        $user_info['qb_view'] = 1;
                        $user_info['qb_edit'] = 1;
                        $user_info['qb_delete'] = 1;

                        $user_info['source_view'] = 1;
                        $user_info['source_edit'] = 1;
                        $user_info['source_delete'] = 1;

                        $user_info['ss_view'] = 1;
                        $user_info['ss_edit'] = 1;
                        $user_info['ss_delete'] = 1;

                        $user_info['ss_source'] = 1;
                        $user_info['ss_class'] = 1;
                        $user_info['ss_assign'] = 1;

                        $user_info['e_view'] = 1;
                        $user_info['e_edit'] = 1;
                        $user_info['e_delete'] = 1;
                        
                        $user_info['ss_assign_status'] = 1;
                        $user_info['ss_assign_mixed'] = 1;
                        $user_info['ss_assign_order'] = 1;
                        
                        $user_info['student_view'] = 1;
                        $user_info['student_edit'] = 1;
                        $user_info['student_delete'] = 1;
                        
                        $user_info['teacher_view'] = 1;
                        $user_info['teacher_edit'] = 1;
                        $user_info['teacher_delete'] = 1;
                        
                        $user_info['class_view'] = 1;
                        $user_info['class_edit'] = 1;
                        $user_info['class_delete'] = 1;

                        $user_info['system'] = 1;
                        break;

                    case 2: //staff
                        $user_info['qb_view'] = $row->qb_view;
                        $user_info['qb_edit'] = $row->qb_edit;
                        $user_info['qb_delete'] = $row->qb_delete;

                        $user_info['source_view'] = $row->source_view;
                        $user_info['source_edit'] = $row->source_edit;
                        $user_info['source_delete'] = $row->source_delete;

                        $user_info['ss_view'] = $row->ss_view;
                        $user_info['ss_edit'] = $row->ss_edit;
                        $user_info['ss_delete'] = $row->ss_delete;

                        $user_info['ss_source'] = $row->ss_source;
                        $user_info['ss_class'] = $row->ss_class;
                        $user_info['ss_assign'] = $row->ss_assign;

                        $user_info['e_view'] = 0;
                        $user_info['e_edit'] = 0;
                        $user_info['e_delete'] = 0;
                        
                        $user_info['ss_assign_status'] = $row->ss_assign_status;
                        $user_info['ss_assign_mixed'] = $row->ss_assign_mixed;
                        $user_info['ss_assign_order'] = $row->ss_assign_order;
                        
                        $user_info['student_view'] = $row->student_view;
                        $user_info['student_edit'] = $row->student_edit;
                        $user_info['student_delete'] = $row->student_delete;
                        
                        $user_info['teacher_view'] = $row->teacher_view;
                        $user_info['teacher_edit'] = $row->teacher_edit;
                        $user_info['teacher_delete'] = $row->teacher_delete;
                        
                        $user_info['class_view'] = $row->class_view;
                        $user_info['class_edit'] = $row->class_edit;
                        $user_info['class_delete'] = $row->class_delete;

                        $user_info['system'] = 0;
                        break;

                    case 3: //teacher
                        $user_info['qb_view'] = 0;
                        $user_info['qb_edit'] = 0;
                        $user_info['qb_delete'] = 0;

                        $user_info['source_view'] = 0;
                        $user_info['source_edit'] = 0;
                        $user_info['source_delete'] = 0;

                        $user_info['ss_view'] = 0;
                        $user_info['ss_edit'] = 0;
                        $user_info['ss_delete'] = 0;

                        $user_info['ss_source'] = 0;
                        $user_info['ss_class'] = 0;
                        $user_info['ss_assign'] = 0;
                        
                        $user_info['ss_assign_status'] = 0;
                        $user_info['ss_assign_mixed'] = 0;
                        $user_info['ss_assign_order'] = 0;
                        
                        $user_info['student_view'] = 0;
                        $user_info['student_edit'] = 0;
                        $user_info['student_delete'] = 0;
                        
                        $user_info['class_view'] = 0;
                        $user_info['class_edit'] = 0;
                        $user_info['class_delete'] = 0;
                        
                        $user_info['teacher_view'] = 0;
                        $user_info['teacher_edit'] = 0;
                        $user_info['teacher_delete'] = 0;

                        $user_info['e_view'] = 1;
                        $user_info['e_edit'] = 1;
                        $user_info['e_delete'] = 1;

                        $user_info['system'] = 0;
                        break;
                    case 4: //student
                        $user_info['qb_view'] = 0;
                        $user_info['qb_edit'] = 0;
                        $user_info['qb_delete'] = 0;

                        $user_info['source_view'] = 0;
                        $user_info['source_edit'] = 0;
                        $user_info['source_delete'] = 0;

                        $user_info['ss_view'] = 0;
                        $user_info['ss_edit'] = 0;
                        $user_info['ss_delete'] = 0;

                        $user_info['ss_source'] = 0;
                        $user_info['ss_class'] = 0;
                        $user_info['ss_assign'] = 0;

                        $user_info['e_view'] = 0;
                        $user_info['e_edit'] = 0;
                        $user_info['e_delete'] = 0;
                        
                        $user_info['ss_assign_status'] = 0;
                        $user_info['ss_assign_mixed'] = 0;
                        $user_info['ss_assign_order'] = 0;
                        
                        $user_info['student_view'] = 0;
                        $user_info['student_edit'] = 0;
                        $user_info['student_delete'] = 0;
                        
                        $user_info['teacher_view'] = 0;
                        $user_info['teacher_edit'] = 0;
                        $user_info['teacher_delete'] = 0;
                        
                        $user_info['class_view'] = 0;
                        $user_info['class_edit'] = 0;
                        $user_info['class_delete'] = 0;

                        $user_info['system'] = 0;
                        
                        break;
                }

                $this->session->set_userdata('user_info', $user_info);
            }
        } else {
            $response['status'] = 'fail';
        }
        echo json_encode($response);
    }

}