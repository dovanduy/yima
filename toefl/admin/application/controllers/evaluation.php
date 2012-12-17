<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Evaluation extends CI_Controller {

    private $object;
    private $theme;
    private $data;

    public function __construct() {
        parent::__construct();

        //--- object name
        $this->object = 'evaluation';
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

        $this->data['link_reading'] = base_url() . $this->object . '/reading/';
        $this->data['link_listening'] = base_url() . $this->object . '/listening/';
        $this->data['link_speaking'] = base_url() . $this->object . '/speaking/';
        $this->data['link_writing'] = base_url() . $this->object . '/writing/';
        //--- end prepare links
        //Filter By Teacher
        if (current_group_id() == 3) {
            $this->db->select('*');
            $this->db->where('deleted', 0);
            $this->db->where('teacher_id', current_user_id());
            $query = $this->db->get('class_teacher');
            $filter_classes[] = 0;
            foreach ($query->result() as $item) {
                $filter_classes[] = $item->class_id;
            }
            $this->session->set_userdata('filter_classes', $filter_classes);

            $this->db->select('*');
            $this->db->where('deleted', 0);
            $this->db->where_in('id', $filter_classes);
            $this->db->order_by('title', 'asc');
            $query = $this->db->get('class');
            $classes[0] = '--- All Classes ---';
            foreach ($query->result() as $item) {
                $classes[$item->id] = $item->title;
            }
            $this->data['classes'] = $classes;

            $this->db->select('*');
            $this->db->where('deleted', 0);
            $this->db->where_in('class_id', $filter_classes);
            $query = $this->db->get('session_class');
            $filter_sessions[] = 0;
            foreach ($query->result() as $item) {
                $filter_sessions[] = $item->session_id;
            }
            $this->session->set_userdata('filter_sessions', $filter_sessions);
        }

        //Filter By Staff
        if (current_group_id() == 2) {
            $this->db->select('*');
            $this->db->where('deleted', 0);
            $this->db->where('campus_id', $this->data['user_info']['campus_id']);
            $this->db->order_by('title', 'asc');
            $query = $this->db->get('class');
            $filter_classes;
            $classes[0] = '--- All Classes ---';
            foreach ($query->result() as $item) {
                $filter_classes[] = $item->id;
                $classes[$item->id] = $item->title;
            }
            $this->data['classes'] = $classes;
            $this->session->set_userdata('filter_classes', $filter_classes);

            $this->db->select('*');
            $this->db->where('deleted', 0);
            $this->db->where_in('class_id', $filter_classes);
            $query = $this->db->get('session_class');
            $filter_sessions;
            foreach ($query->result() as $item) {
                $filter_sessions[] = $item->session_id;
            }
            $this->session->set_userdata('filter_sessions', $filter_sessions);
        }

        //Filter By Staff
        if (current_group_id() == 1) {
            $this->db->select('*');
            $this->db->where('deleted', 0);
            $this->db->order_by('title', 'asc');
            $query = $this->db->get('class');
            $filter_classes[] = 0;
            $classes[0] = '--- All Classes ---';
            foreach ($query->result() as $item) {
                $filter_classes[] = $item->id;
                $classes[$item->id] = $item->title;
            }
            $this->data['classes'] = $classes;
            $this->session->set_userdata('filter_classes', $filter_classes);
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

    public function reading($session_id) {

        $filter_class = '';
        if (current_group_id() == 3 || current_group_id() == 2)
            $filter_class = ' and ss.class in (' . implode(',', $this->session->userdata('filter_classes')) . ') ';

        $query = $this->db->query('SELECT ss.id,ss.student,ss.mixed_test,ss.test_order, ss.disabled, ss.status, ss.class as class_id,
                    (select c.title from ' . $this->db->dbprefix('class') . ' c where c.id=ss.class limit 0,1) as class,
                    (select s.firstname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as firstname,
                    (select s.lastname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as lastname,
                    (select m.title from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as mixed_test_title,
                    (select t.title from ' . $this->db->dbprefix('test_order') . ' t where t.id=ss.test_order limit 0,1) as test_order_title
                    FROM ' . $this->db->dbprefix('session_student') . ' ss where deleted=0 ' . $filter_class . ' and session=' . $session_id . ' order by ss.class, firstname');
        $i = -1;
        foreach ($query->result() as $row) {
            $i++;
            $this->data["assigns"][$i]["id"] = $row->id;
            $this->data["assigns"][$i]["class"] = $row->class;
            $this->data["assigns"][$i]["class_id"] = $row->class_id;
            $this->data["assigns"][$i]["fullname"] = $row->firstname . " " . $row->lastname;
            $this->data["assigns"][$i]["mixed_tests"] = $row->mixed_test_title;
            $this->data["assigns"][$i]["test_orders"] = $row->test_order_title;
            if ($row->disabled == 0) {
                $this->data["assigns"][$i]["disabled"] = "Enabled";
            } else {
                $this->data["assigns"][$i]["disabled"] = "Disabled";
            }

            if ($row->status == 0) {
                $this->data["assigns"][$i]["status"] = "Not Tested";
            } else {
                $this->data["assigns"][$i]["status"] = "Tested";
            }
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/reading', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function reading_details() {
        $session_student_id = $this->input->post('session_student_id');
        $query = $this->db->query('SELECT ss.mixed_test, ss.reading1, ss.reading2, ss.reading3,
                (select s.firstname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as firstname,
                (select s.lastname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as lastname,
                (select m.reading1 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as rid1,
                (select m.reading2 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as rid2,
                (select m.reading3 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as rid3
                FROM ' . $this->db->dbprefix('session_student') . ' ss where ss.id=' . $session_student_id);

        foreach ($query->result() as $row) {
            $mixed_test = $row->mixed_test;
            $rid1 = $row->rid1;
            $rid2 = $row->rid2;
            $rid3 = $row->rid3;

            $this->data['firstname'] = $row->firstname;
            $this->data['lastname'] = $row->lastname;

            $reading1 = unserialize(stripslashes($row->reading1));
            $reading2 = unserialize(stripslashes($row->reading2));
            $reading3 = unserialize(stripslashes($row->reading3));

            //SCQ
            $scq1 = $this->reading_split_scq($reading1['scq_id'], $reading1['scq_choice']);
            $scq2 = $this->reading_split_scq($reading2['scq_id'], $reading2['scq_choice']);
            $scq3 = $this->reading_split_scq($reading3['scq_id'], $reading3['scq_choice']);

            //MCQ
            $mcq1 = $this->reading_split_mcq($reading1['mcq_id'], $reading1['mcq_choice']);
            $mcq2 = $this->reading_split_mcq($reading2['mcq_id'], $reading2['mcq_choice']);
            $mcq3 = $this->reading_split_mcq($reading3['mcq_id'], $reading3['mcq_choice']);

            //IQ
            $iq1 = $this->reading_split_iq($reading1['iq_id'], $reading1['iq_choice']);
            $iq2 = $this->reading_split_iq($reading2['iq_id'], $reading2['iq_choice']);
            $iq3 = $this->reading_split_iq($reading3['iq_id'], $reading3['iq_choice']);

            //DDQ
            $ddq1 = $this->reading_split_ddq($reading1['ddq_id'], $reading1['ddq_subject'], $reading1['ddq_choice']);
            $ddq2 = $this->reading_split_ddq($reading2['ddq_id'], $reading2['ddq_subject'], $reading2['ddq_choice']);
            $ddq3 = $this->reading_split_ddq($reading3['ddq_id'], $reading3['ddq_subject'], $reading3['ddq_choice']);

            //OQ
            $oq1 = $this->reading_split_oq($reading1['oq_id'], $reading1['oq_choice']);
            $oq2 = $this->reading_split_oq($reading2['oq_id'], $reading2['oq_choice']);
            $oq3 = $this->reading_split_oq($reading3['oq_id'], $reading3['oq_choice']);
        }

        $this->number_question = 0;
        $this->data['reading1_scq'] = $this->reading_get_scq($rid1, $scq1);
        $this->data['reading1_mcq'] = $this->reading_get_mcq($rid1, $mcq1);
        $this->data['reading1_iq'] = $this->reading_get_iq($rid1, $iq1);
        $this->data['reading1_ddq'] = $this->reading_get_ddq($rid1, $ddq1);
        $this->data['reading1_oq'] = $this->reading_get_oq($rid1, $oq1);
        $this->data['number_question1'] = $this->number_question;

        $this->number_question = 0;
        $this->data['reading2_scq'] = $this->reading_get_scq($rid2, $scq2);
        $this->data['reading2_mcq'] = $this->reading_get_mcq($rid2, $mcq2);
        $this->data['reading2_iq'] = $this->reading_get_iq($rid2, $iq2);
        $this->data['reading2_ddq'] = $this->reading_get_ddq($rid2, $ddq2);
        $this->data['reading2_oq'] = $this->reading_get_oq($rid2, $oq2);
        $this->data['number_question2'] = $this->number_question;

        $this->number_question = 0;
        $this->data['reading3_scq'] = $this->reading_get_scq($rid3, $scq3);
        $this->data['reading3_mcq'] = $this->reading_get_mcq($rid3, $mcq3);
        $this->data['reading3_iq'] = $this->reading_get_iq($rid3, $iq3);
        $this->data['reading3_ddq'] = $this->reading_get_ddq($rid3, $ddq3);
        $this->data['reading3_oq'] = $this->reading_get_oq($rid3, $oq3);
        $this->data['number_question3'] = $this->number_question;

        $this->load->view($this->theme . '/' . $this->object . '/reading_details', $this->data);
    }

    private function reading_split_scq($scq_id, $scq_choice) {
        $scq_id_arr = explode(',', $scq_id);
        $scq_choice_arr = explode(',', $scq_choice);
        for ($i = 0; $i < count($scq_id_arr); $i++) {
            $scq[$scq_id_arr[$i]] = $scq_choice_arr[$i];
        }
        return $scq;
    }

    private function reading_split_mcq($mcq_id, $mcq_choice) {
        $mcq_id_arr = explode(',', $mcq_id);
        $mcq_choice_arr = explode(',', $mcq_choice);
        for ($i = 0; $i < count($mcq_id_arr); $i++) {
            $mcq[$mcq_id_arr[$i]] = $mcq_choice_arr[$i];
        }
        return $mcq;
    }

    private function reading_split_iq($iq_id, $iq_choice) {
        $iq_id_arr = explode(',', $iq_id);
        $iq_choice_arr = explode(',', $iq_choice);
        for ($i = 0; $i < count($iq_id_arr); $i++) {
            $iq[$iq_id_arr[$i]] = $iq_choice_arr[$i];
        }
        return $iq;
    }

    private function reading_split_ddq($ddq_id, $ddq_subject, $ddq_choice) {
        $ddq_id_arr = explode(',', $ddq_id);
        $ddq_subject_arr = explode(',', $ddq_subject);
        $ddq_choice_arr = explode(',', $ddq_choice);
        for ($i = 0; $i < count($ddq_id_arr); $i++) {
            $sub_id_arr = explode(';', $ddq_subject_arr[$i]);
            $choice_id_arr = explode(';', $ddq_choice_arr[$i]);
            for ($j = 0; $j < count($sub_id_arr); $j++) {
                $ddq[$ddq_id_arr[$i]][$sub_id_arr[$j]] = explode('/', $choice_id_arr[$j]);
            }
        }
        return $ddq;
    }
    
    private function reading_split_oq($oq_id, $oq_choice) {
        $oq_id_arr = explode(',', $oq_id);
        $oq_choice_arr = explode(',', $oq_choice);
        for ($i = 0; $i < count($oq_id_arr); $i++) {
            $oq[$oq_id_arr[$i]] = $oq_choice_arr[$i];
        }
        return $oq;
    }

    private function reading_get_scq($rid, $scq) {
        $question;

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('reading_scq') . ' where deleted=0 and rid=' . $rid);

        foreach ($query->result_array() as $rows) {
            $student_answer = 0;
            foreach ($scq as $key => $value) {
                if ($key == $rows['id'])
                    $student_answer = $value;
            }

            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'answer' => $rows['choice' . $rows['answer']],
                'student_answer' => ($student_answer != '' && $student_answer != 0) ? $rows['choice' . $student_answer] : '',
            );
        }
        if (isset($question))
            return $question;
    }

    private function reading_get_mcq($rid, $mcq) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('reading_mcq') . ' where deleted=0 and rid=' . $rid);

        foreach ($query->result_array() as $rows) {
            $answer_arr = explode(',', $rows['answer']);
            if (isset($answer_arr1))
                unset($answer_arr1);
            foreach ($answer_arr as $a) {
                $answer_arr1[] = $a . '. ' . $rows['choice' . $a];
            }
            $answer = implode('<br/>', $answer_arr1);

            foreach ($mcq as $key => $value) {
                if ($key == $rows['id'])
                    $student_answer = $value;

                $answer_arr = explode(';', $student_answer);
                if (isset($answer_arr1))
                    unset($answer_arr1);
                foreach ($answer_arr as $a) {
                    $answer_arr1[] = $a . '. ' . $rows['choice' . $a];
                }
                $student_answer_value = implode('<br/>', $answer_arr1);
            }

            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'answer' => $answer,
                'student_answer' => $student_answer_value,
            );
        }
        if (isset($question))
            return $question;
    }

    private function reading_get_iq($rid, $iq) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('reading_iq') . ' where deleted=0 and rid=' . $rid);
        foreach ($query->result_array() as $rows) {
            $student_answer = 0;
            foreach ($iq as $key => $value) {
                if ($key == $rows['id'])
                    $student_answer = $value;
            }

            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'answer' => $rows['answer'],
                'student_answer' => $student_answer,
            );
        }
        if (isset($question))
            return $question;
    }

    private function reading_get_ddq($rid, $ddq) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('reading_ddq') . ' where deleted=0 and rid=' . $rid);
        foreach ($query->result_array() as $rows) {
            //load choices
            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('reading_ddq_answer') . ' where deleted=0 and ddqid=' . $rows['id']);
            $i = -1;
            if (isset($choice_arr))
                unset($choice_arr);
            foreach ($query1->result() as $row1) {
                $i++;
                $choice[$i]['id'] = $row1->id;
                $choice[$i]['subid'] = $row1->subid;
                $choice[$i]['title'] = $row1->title;

                $choice_arr[$row1->id] = $row1->title;
            }

            //load subjects
            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('reading_ddq_subjects') . ' where deleted=0 and ddqid=' . $rows['id']);
            //load answer
            if (isset($subject_arr))
                unset($subject_arr);
            if (isset($stu_subject_arr))
                unset($stu_subject_arr);
            foreach ($query1->result() as $row1) {
                if (isset($answer_arr))
                    unset($answer_arr);
                foreach ($choice as $c) {
                    if ($c['subid'] == $row1->id) {
                        $answer_arr[] = $c['title'];
                    }
                }
                $subject_arr[] = '<strong>' . $row1->title . '</strong><br/><ul><li>' . implode('</li><li>', $answer_arr) . '</li></ul>';

                //load student's answer
                if (isset($choice_in_subject_arr))
                    unset($choice_in_subject_arr);

                if (isset($ddq[$rows['id']][$row1->id]))
                    foreach ($ddq[$rows['id']][$row1->id] as $stu_choice_id) {
                        if (isset($choice_arr[$stu_choice_id]))
                            $choice_in_subject_arr[] = $choice_arr[$stu_choice_id];
                    }

                if (isset($choice_in_subject_arr))
                    $stu_subject_arr[] = '<strong>' . $row1->title . '</strong><br/><ul><li>' . implode('</li><li>', $choice_in_subject_arr) . '</li></ul>';
            }

            if (isset($subject_arr))
                $answer = implode('<br/>', $subject_arr);

            //load student's answer
            if (isset($stu_subject_arr))
                $student_answer = implode('<br/>', $stu_subject_arr);

            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'content' => stripslashes($rows['content']),
                'answer' => $answer,
                'student_answer' => (isset($student_answer)) ? $student_answer : '',
            );
        }
        if (isset($question))
            return $question;
    }
    
    private function reading_get_oq($rid, $oq) {
        $question;

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('reading_oq') . ' where deleted=0 and rid=' . $rid);

        foreach ($query->result_array() as $rows) {
            $student_answer = '';
            foreach ($oq as $key => $value) {
                if ($key == $rows['id'])
                    $student_answer = $value;
            }

            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'answer' => '1-2-3-4',
                'student_answer' => str_replace(';','-',$student_answer),
            );
        }
        if (isset($question))
            return $question;
    }

    //--- LISTENING
    public function listening($session_id) {

        $filter_class = '';
        if (current_group_id() == 3 || current_group_id() == 2)
            $filter_class = ' and ss.class in (' . implode(',', $this->session->userdata('filter_classes')) . ') ';

        $query = $this->db->query('SELECT ss.id,ss.student,ss.mixed_test,ss.test_order, ss.disabled, ss.status, ss.class as class_id,
                    (select c.title from ' . $this->db->dbprefix('class') . ' c where c.id=ss.class limit 0,1) as class,
                    (select s.firstname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as firstname,
                    (select s.lastname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as lastname,
                    (select m.title from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as mixed_test_title,
                    (select t.title from ' . $this->db->dbprefix('test_order') . ' t where t.id=ss.test_order limit 0,1) as test_order_title
                    FROM ' . $this->db->dbprefix('session_student') . ' ss where deleted=0 ' . $filter_class . ' and session=' . $session_id . ' order by ss.class, firstname');
        $i = -1;
        foreach ($query->result() as $row) {
            $i++;
            $this->data["assigns"][$i]["id"] = $row->id;
            $this->data["assigns"][$i]["class_id"] = $row->class_id;
            $this->data["assigns"][$i]["class"] = $row->class;
            $this->data["assigns"][$i]["fullname"] = $row->firstname . " " . $row->lastname;
            $this->data["assigns"][$i]["mixed_tests"] = $row->mixed_test_title;
            $this->data["assigns"][$i]["test_orders"] = $row->test_order_title;
            if ($row->disabled == 0) {
                $this->data["assigns"][$i]["disabled"] = "Enabled";
            } else {
                $this->data["assigns"][$i]["disabled"] = "Disabled";
            }

            if ($row->status == 0) {
                $this->data["assigns"][$i]["status"] = "Not Tested";
            } else {
                $this->data["assigns"][$i]["status"] = "Tested";
            }
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/listening', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function listening_details() {
        $session_student_id = $this->input->post('session_student_id');
        $query = $this->db->query('SELECT ss.mixed_test, ss.listening1, ss.listening2, ss.listening3, ss.listening4, ss.listening5, ss.listening6,
                (select s.firstname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as firstname,
                (select s.lastname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as lastname,
                (select m.listening1 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as lid1,
                (select m.listening2 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as lid2,
                (select m.listening3 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as lid3,
                (select m.listening4 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as lid4,
                (select m.listening5 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as lid5,
                (select m.listening6 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as lid6
                FROM ' . $this->db->dbprefix('session_student') . ' ss where ss.id=' . $session_student_id);

        foreach ($query->result() as $row) {
            $mixed_test = $row->mixed_test;
            $lid1 = $row->lid1;
            $lid2 = $row->lid2;
            $lid3 = $row->lid3;
            $lid4 = $row->lid4;
            $lid5 = $row->lid5;
            $lid6 = $row->lid6;

            $listening1 = unserialize(stripslashes($row->listening1));
            $listening2 = unserialize(stripslashes($row->listening2));
            $listening3 = unserialize(stripslashes($row->listening3));
            $listening4 = unserialize(stripslashes($row->listening4));
            $listening5 = unserialize(stripslashes($row->listening5));
            $listening6 = unserialize(stripslashes($row->listening6));

            $this->data['firstname'] = $row->firstname;
            $this->data['lastname'] = $row->lastname;

            //SCQ
            $scq1 = $this->listening_split_scq($listening1['scq_id'], $listening1['scq_choice']);
            $scq2 = $this->listening_split_scq($listening2['scq_id'], $listening2['scq_choice']);
            $scq3 = $this->listening_split_scq($listening3['scq_id'], $listening3['scq_choice']);
            $scq4 = $this->listening_split_scq($listening4['scq_id'], $listening4['scq_choice']);
            $scq5 = $this->listening_split_scq($listening5['scq_id'], $listening5['scq_choice']);
            $scq6 = $this->listening_split_scq($listening6['scq_id'], $listening6['scq_choice']);

            //MCQ
            $mcq1 = $this->listening_split_mcq($listening1['mcq_id'], $listening1['mcq_choice']);
            $mcq2 = $this->listening_split_mcq($listening2['mcq_id'], $listening2['mcq_choice']);
            $mcq3 = $this->listening_split_mcq($listening3['mcq_id'], $listening3['mcq_choice']);
            $mcq4 = $this->listening_split_mcq($listening4['mcq_id'], $listening4['mcq_choice']);
            $mcq5 = $this->listening_split_mcq($listening5['mcq_id'], $listening5['mcq_choice']);
            $mcq6 = $this->listening_split_mcq($listening6['mcq_id'], $listening6['mcq_choice']);

            //CQ
            $cq1 = $this->listening_split_cq($listening1['cq_id'], $listening1['cq_choice']);
            $cq2 = $this->listening_split_cq($listening2['cq_id'], $listening2['cq_choice']);
            $cq3 = $this->listening_split_cq($listening3['cq_id'], $listening3['cq_choice']);
            $cq4 = $this->listening_split_cq($listening4['cq_id'], $listening4['cq_choice']);
            $cq5 = $this->listening_split_cq($listening5['cq_id'], $listening5['cq_choice']);
            $cq6 = $this->listening_split_cq($listening6['cq_id'], $listening6['cq_choice']);
            
            //OQ
            $oq1 = $this->listening_split_oq($listening1['oq_id'], $listening1['oq_choice']);
            $oq2 = $this->listening_split_oq($listening2['oq_id'], $listening2['oq_choice']);
            $oq3 = $this->listening_split_oq($listening3['oq_id'], $listening3['oq_choice']);
            $oq4 = $this->listening_split_oq($listening4['oq_id'], $listening4['oq_choice']);
            $oq5 = $this->listening_split_oq($listening5['oq_id'], $listening5['oq_choice']);
            $oq6 = $this->listening_split_oq($listening6['oq_id'], $listening6['oq_choice']);
        }

        //print_r($cq1);

        $this->number_question = 0;
        $this->data['listening1_scq'] = $this->listening_get_scq($lid1, $scq1);
        $this->data['listening1_mcq'] = $this->listening_get_mcq($lid1, $mcq1);
        $this->data['listening1_cq'] = $this->listening_get_cq($lid1, $cq1);
        $this->data['listening1_oq'] = $this->listening_get_oq($lid1, $oq1);
        $this->data['number_question1'] = $this->number_question;

        $this->number_question = 0;
        $this->data['listening2_scq'] = $this->listening_get_scq($lid2, $scq2);
        $this->data['listening2_mcq'] = $this->listening_get_mcq($lid2, $mcq2);
        $this->data['listening2_cq'] = $this->listening_get_cq($lid2, $cq2);
        $this->data['listening2_oq'] = $this->listening_get_oq($lid2, $oq2);
        $this->data['number_question2'] = $this->number_question;

        $this->number_question = 0;
        $this->data['listening3_scq'] = $this->listening_get_scq($lid3, $scq3);
        $this->data['listening3_mcq'] = $this->listening_get_mcq($lid3, $mcq3);
        $this->data['listening3_cq'] = $this->listening_get_cq($lid3, $cq3);
        $this->data['listening3_oq'] = $this->listening_get_oq($lid3, $oq3);
        $this->data['number_question3'] = $this->number_question;

        $this->number_question = 0;
        $this->data['listening4_scq'] = $this->listening_get_scq($lid4, $scq4);
        $this->data['listening4_mcq'] = $this->listening_get_mcq($lid4, $mcq4);
        $this->data['listening4_cq'] = $this->listening_get_cq($lid4, $cq4);
        $this->data['listening4_oq'] = $this->listening_get_oq($lid4, $oq4);
        $this->data['number_question4'] = $this->number_question;


        $this->number_question = 0;
        $this->data['listening5_scq'] = $this->listening_get_scq($lid5, $scq5);
        $this->data['listening5_mcq'] = $this->listening_get_mcq($lid5, $mcq5);
        $this->data['listening5_cq'] = $this->listening_get_cq($lid5, $cq5);
        $this->data['listening5_oq'] = $this->listening_get_oq($lid5, $oq5);
        $this->data['number_question5'] = $this->number_question;


        $this->number_question = 0;
        $this->data['listening6_scq'] = $this->listening_get_scq($lid6, $scq6);
        $this->data['listening6_mcq'] = $this->listening_get_mcq($lid6, $mcq6);
        $this->data['listening6_cq'] = $this->listening_get_cq($lid6, $cq6);
        $this->data['listening6_oq'] = $this->listening_get_oq($lid6, $oq6);
        $this->data['number_question6'] = $this->number_question;

        $this->load->view($this->theme . '/' . $this->object . '/listening_details', $this->data);
    }

    private function listening_split_scq($scq_id, $scq_choice) {
        $scq_id_arr = explode(',', $scq_id);
        $scq_choice_arr = explode(',', $scq_choice);
        for ($i = 0; $i < count($scq_id_arr); $i++) {
            $scq[$scq_id_arr[$i]] = $scq_choice_arr[$i];
        }
        return $scq;
    }

    private function listening_split_mcq($mcq_id, $mcq_choice) {
        $mcq_id_arr = explode(',', $mcq_id);
        $mcq_choice_arr = explode(',', $mcq_choice);
        for ($i = 0; $i < count($mcq_id_arr); $i++) {
            $mcq[$mcq_id_arr[$i]] = $mcq_choice_arr[$i];
        }
        return $mcq;
    }

    private function listening_split_cq($cq_id, $cq_choice) {
        if ($cq_id != '0') {
            $cq_id_arr = explode(',', $cq_id);
            $cq_choice_arr = explode(',', $cq_choice);
            for ($i = 0; $i < count($cq_id_arr); $i++) {
                $row_arr = explode(';', $cq_choice_arr[$i]);
                foreach ($row_arr as $r) {
                    $row_col_arr = explode('/', $r);
                    if (isset($row_col_arr[1]))
                        $cq[$cq_id_arr[$i]][$row_col_arr[0]] = $row_col_arr[1];
                }
            }
            if (isset($cq))
                return $cq;
        }
    }
    
    private function listening_split_oq($oq_id, $oq_choice) {
        $oq_id_arr = explode(',', $oq_id);
        $oq_choice_arr = explode(',', $oq_choice);
        for ($i = 0; $i < count($oq_id_arr); $i++) {
            $oq[$oq_id_arr[$i]] = $oq_choice_arr[$i];
        }
        return $oq;
    }

    private function listening_get_scq($lid, $scq) {
        $question;

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('listening_scq') . ' where deleted=0 and lid=' . $lid);
        foreach ($query->result_array() as $rows) {
            $student_answer = 0;
            foreach ($scq as $key => $value) {
                if ($key == $rows['id'])
                    $student_answer = $value;
            }

            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'answer' => $rows['choice' . $rows['answer']],
                'student_answer' => ($student_answer != '' && $student_answer != 0) ? $rows['choice' . $student_answer] : '',
            );
        }
        if (isset($question))
            return $question;
    }

    private function listening_get_mcq($lid, $mcq) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('listening_mcq') . ' where deleted=0 and lid=' . $lid);

        foreach ($query->result_array() as $rows) {
            $answer_arr = explode(',', $rows['answer']);
            if (isset($answer_arr1))
                unset($answer_arr1);
            foreach ($answer_arr as $a) {
                $answer_arr1[] = $a . '. ' . $rows['choice' . $a];
            }
            $answer = implode('<br/>', $answer_arr1);

            foreach ($mcq as $key => $value) {
                if ($key == $rows['id'])
                    $student_answer = $value;

                $answer_arr = explode(';', $student_answer);
                if (isset($answer_arr1))
                    unset($answer_arr1);
                foreach ($answer_arr as $a) {
                    $answer_arr1[] = $a . '. ' . $rows['choice' . $a];
                }
                $student_answer_value = implode('<br/>', $answer_arr1);
            }

            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'answer' => $answer,
                'student_answer' => $student_answer_value,
            );
        }
        if (isset($question))
            return $question;
    }

    private function listening_get_cq($lid, $cq) {
        $question;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('listening_cq') . ' where deleted=0 and lid=' . $lid);
        foreach ($query->result_array() as $rows) {
            if (isset($col))
                unset($col);
            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('listening_cq_column') . ' where deleted=0 and cqid=' . $rows['id']);
            foreach ($query1->result_array() as $rows1) {
                $col[$rows1['id']] = $rows1['title'];
            }


            $query1 = $this->db->query('SELECT *,
                (select c.title from ' . $this->db->dbprefix('listening_cq_column') . ' c where c.id=r.col limit 0,1) as col_title
                FROM ' . $this->db->dbprefix('listening_cq_row') . ' r where r.deleted=0 and r.cqid=' . $rows['id']);
            if (isset($cq_row_arr))
                unset($cq_row_arr);
            if (isset($stu_cq_row_arr))
                unset($stu_cq_row_arr);
            foreach ($query1->result_array() as $rows1) {
                $cq_row_arr[] = '<li>' . $rows1['title'] . ': ' . $rows1['col_title'] . '</li>';

                if (isset($col[$cq[$rows['id']][$rows1['id']]]))
                    $stu_cq_row_arr[] = '<li>' . $rows1['title'] . ': ' . $col[$cq[$rows['id']][$rows1['id']]] . '</li>';
            }
            $answer = '<ul>' . implode(' ', $cq_row_arr) . '</ul>';

            if (isset($stu_cq_row_arr))
                $student_answer = '<ul>' . implode(' ', $stu_cq_row_arr) . '</ul>';

            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'answer' => $answer,
                'student_answer' => (isset($student_answer)) ? $student_answer : '',
            );
        }
        if (isset($question))
            return $question;
    }
    
    private function listening_get_oq($lid, $oq) {
        $question;

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('listening_oq') . ' where deleted=0 and lid=' . $lid);

        foreach ($query->result_array() as $rows) {
            $student_answer = '';
            foreach ($oq as $key => $value) {
                if ($key == $rows['id'])
                    $student_answer = $value;
            }

            $this->number_question++;
            $question[] = array(
                'number_question' => $this->number_question,
                'id' => $rows['id'],
                'title' => $rows['title'],
                'answer' => '1-2-3-4',
                'student_answer' => str_replace(';','-',$student_answer),
            );
        }
        if (isset($question))
            return $question;
    }

    //--- SPEAKING
    public function speaking($session_id) {
        $scaled_score["4"] = 30;
        $scaled_score["3.83"] = 29;
        $scaled_score["3.66"] = 28;
        $scaled_score["3.5"] = 27;
        $scaled_score["3.33"] = 26;
        $scaled_score["3.16"] = 24;
        $scaled_score["3"] = 23;
        $scaled_score["2.83"] = 22;
        $scaled_score["2.66"] = 20;
        $scaled_score["2.5"] = 19;
        $scaled_score["2.33"] = 18;
        $scaled_score["2.16"] = 17;
        $scaled_score["2"] = 15;
        $scaled_score["1.83"] = 14;
        $scaled_score["1.66"] = 13;
        $scaled_score["1.5"] = 11;
        $scaled_score["1.33"] = 10;
        $scaled_score["1.16"] = 9;
        $scaled_score["1"] = 8;
        $scaled_score["0.83"] = 6;
        $scaled_score["0.66"] = 5;
        $scaled_score["0.5"] = 4;
        $scaled_score["0.33"] = 3;
        $scaled_score["0.16"] = 1;
        $scaled_score["0"] = 0;

        $filter_class = '';
        if (current_group_id() == 3 || current_group_id() == 2)
            $filter_class = ' and ss.class in (' . implode(',', $this->session->userdata('filter_classes')) . ') ';

        $query = $this->db->query('SELECT ss.id,ss.student,ss.mixed_test,ss.test_order, ss.disabled, ss.status, ss.class as class_id,
                    ss.score_sk1, ss.score_sk2, ss.score_sk3, ss.score_sk4, ss.score_sk5, ss.score_sk6,
                    (select c.title from ' . $this->db->dbprefix('class') . ' c where c.id=ss.class limit 0,1) as class,
                    (select s.firstname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as firstname,
                    (select s.lastname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as lastname,
                    (select m.title from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as mixed_test_title,
                    (select t.title from ' . $this->db->dbprefix('test_order') . ' t where t.id=ss.test_order limit 0,1) as test_order_title
                    FROM ' . $this->db->dbprefix('session_student') . ' ss where deleted=0 ' . $filter_class . ' and session=' . $session_id . ' order by ss.class, firstname');
        $i = -1;
        foreach ($query->result() as $row) {
            $i++;
            $this->data["assigns"][$i]["id"] = $row->id;
            $this->data["assigns"][$i]["class_id"] = $row->class_id;
            $this->data["assigns"][$i]["class"] = $row->class;
            $this->data["assigns"][$i]["fullname"] = $row->firstname . " " . $row->lastname;
            $this->data["assigns"][$i]["mixed_tests"] = $row->mixed_test_title;
            $this->data["assigns"][$i]["test_orders"] = $row->test_order_title;

            $this->data["assigns"][$i]["score"] = floor(($row->score_sk1 + $row->score_sk2 + $row->score_sk3 + $row->score_sk4 + $row->score_sk5 + $row->score_sk6) / 6 * 100) / 100;

            $this->data["assigns"][$i]["scaled_score"] = $scaled_score[(string) $this->data["assigns"][$i]["score"]];

            if ($row->disabled == 0) {
                $this->data["assigns"][$i]["disabled"] = "Enabled";
            } else {
                $this->data["assigns"][$i]["disabled"] = "Disabled";
            }

            if ($row->status == 0) {
                $this->data["assigns"][$i]["status"] = "Not Tested";
            } else {
                $this->data["assigns"][$i]["status"] = "Tested";
            }
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/speaking', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function speaking_details() {
        $session_student_id = $this->input->post('session_student_id');
        $query = $this->db->query('SELECT ss.mixed_test, ss.id, score_sk1, score_sk2, score_sk3, score_sk4, score_sk5, score_sk6,
                (select s.firstname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as firstname,
                (select s.lastname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as lastname,
                (select m.speaking1 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as sid1,
                (select m.speaking2 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as sid2,
                (select m.speaking3 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as sid3,
                (select m.speaking4 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as sid4,
                (select m.speaking5 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as sid5,
                (select m.speaking6 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as sid6
                FROM ' . $this->db->dbprefix('session_student') . ' ss where ss.id=' . $session_student_id);

        foreach ($query->result() as $row) {
            $mixed_test = $row->mixed_test;
            $sid1 = $row->sid1;
            $sid2 = $row->sid2;
            $sid3 = $row->sid3;
            $sid4 = $row->sid4;
            $sid5 = $row->sid5;
            $sid6 = $row->sid6;

            $this->data['firstname'] = $row->firstname;
            $this->data['lastname'] = $row->lastname;

            $this->data['speaking1'] = $this->get_speaking($sid1, $row->id, 1, $row->score_sk1);
            $this->data['speaking2'] = $this->get_speaking($sid2, $row->id, 2, $row->score_sk2);
            $this->data['speaking3'] = $this->get_speaking($sid3, $row->id, 3, $row->score_sk3);
            $this->data['speaking4'] = $this->get_speaking($sid4, $row->id, 4, $row->score_sk4);
            $this->data['speaking5'] = $this->get_speaking($sid5, $row->id, 5, $row->score_sk5);
            $this->data['speaking6'] = $this->get_speaking($sid6, $row->id, 6, $row->score_sk6);
        }

        $this->load->view($this->theme . '/' . $this->object . '/speaking_details', $this->data);
    }

    private function get_speaking($sid, $session_student_id, $speaking_part, $score_sk) {
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('speaking') . ' where id=' . $sid);
        foreach ($query->result() as $row) {
            $response['id'] = $row->id;
            $response['subject'] = $row->subject;

            $file_number = $speaking_part;
            if ($speaking_part == 3)
                $file_number = 4;
            if ($speaking_part == 4)
                $file_number = 5;
            if ($speaking_part == 5)
                $file_number = 7;
            if ($speaking_part == 6)
                $file_number = 8;

            $recording = 'data/student/speaking/' . $session_student_id . "/0" . $file_number . "/sound.wav";
            if (file_exists($recording)) {
                //$response['recording'] = base_url() . "data/student/speaking/speaking_ss" . $session_student_id . "_" . $speaking_part . ".wav";
                $response['recording'] = base_url() . $recording;
            } else {
                $response['recording'] = '';
            }


            $score = "<select class='sel_score' alt='" . $session_student_id . "' speaking_part='" . $speaking_part . "'>";

            $score.="<option value='0' ";
            if ($score_sk == 0)
                $score.=" selected='selected' ";
            $score.=" >0</option>";

            $score.="<option value='1' ";
            if ($score_sk == 1)
                $score.=" selected='selected' ";
            $score.=" >1</option>";

            $score.="<option value='2' ";
            if ($score_sk == 2)
                $score.=" selected='selected' ";
            $score.=" >2</option>";

            $score.="<option value='3' ";
            if ($score_sk == 3)
                $score.=" selected='selected' ";
            $score.=" >3</option>";

            $score.="<option value='4' ";
            if ($score_sk == 4)
                $score.=" selected='selected' ";
            $score.=" >4</option>";

            $score.="</select>";
            $response['score'] = $score;
        }
        return $response;
    }

    //--- WRITING
    public function writing($session_id) {
        $scaled_score["5"] = 30;
        $scaled_score["4.75"] = 29;
        $scaled_score["4.5"] = 28;
        $scaled_score["4.25"] = 27;
        $scaled_score["4"] = 25;
        $scaled_score["3.75"] = 24;
        $scaled_score["3.5"] = 22;
        $scaled_score["3.25"] = 21;
        $scaled_score["3"] = 20;
        $scaled_score["2.75"] = 18;
        $scaled_score["2.5"] = 17;
        $scaled_score["2.25"] = 15;
        $scaled_score["2"] = 14;
        $scaled_score["1.75"] = 12;
        $scaled_score["1.5"] = 11;
        $scaled_score["1.25"] = 10;
        $scaled_score["1"] = 8;
        $scaled_score["0.75"] = 7;
        $scaled_score["0.5"] = 5;
        $scaled_score["0.25"] = 4;
        $scaled_score["0"] = 0;

        $filter_class = '';
        if (current_group_id() == 3 || current_group_id() == 2)
            $filter_class = ' and ss.class in (' . implode(',', $this->session->userdata('filter_classes')) . ') ';

        $query = $this->db->query('SELECT ss.id,ss.student,ss.mixed_test,ss.test_order, ss.disabled, ss.status, ss.score_wt1, ss.score_wt2, ss.class as class_id,
                    (select c.title from ' . $this->db->dbprefix('class') . ' c where c.id=ss.class limit 0,1) as class,
                    (select s.firstname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as firstname,
                    (select s.lastname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as lastname,
                    (select m.title from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as mixed_test_title,
                    (select t.title from ' . $this->db->dbprefix('test_order') . ' t where t.id=ss.test_order limit 0,1) as test_order_title
                    FROM ' . $this->db->dbprefix('session_student') . ' ss where deleted=0 ' . $filter_class . ' and session=' . $session_id . ' order by ss.class, firstname');
        $i = -1;
        foreach ($query->result() as $row) {
            $i++;
            $this->data["assigns"][$i]["id"] = $row->id;
            $this->data["assigns"][$i]["class_id"] = $row->class_id;
            $this->data["assigns"][$i]["class"] = $row->class;
            $this->data["assigns"][$i]["fullname"] = $row->firstname . " " . $row->lastname;
            $this->data["assigns"][$i]["mixed_tests"] = $row->mixed_test_title;
            $this->data["assigns"][$i]["test_orders"] = $row->test_order_title;

            $this->data["assigns"][$i]["score"] = floor(($row->score_wt1 + $row->score_wt2) / 2 * 100) / 100;

            $this->data["assigns"][$i]["scaled_score"] = $scaled_score[(string) $this->data["assigns"][$i]["score"]];

            if ($row->disabled == 0) {
                $this->data["assigns"][$i]["disabled"] = "Enabled";
            } else {
                $this->data["assigns"][$i]["disabled"] = "Disabled";
            }

            if ($row->status == 0) {
                $this->data["assigns"][$i]["status"] = "Not Tested";
            } else {
                $this->data["assigns"][$i]["status"] = "Tested";
            }
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/writing', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function writing_details() {
        $session_student_id = $this->input->post('session_student_id');
        $query = $this->db->query('SELECT ss.mixed_test, ss.id, ss.score_wt1, ss.score_wt2, ss.writing1, ss.writing2,
                (select s.firstname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as firstname,
                (select s.lastname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as lastname,
                (select m.writing1 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as wid1,
                (select m.writing2 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as wid2
                FROM ' . $this->db->dbprefix('session_student') . ' ss where ss.id=' . $session_student_id);

        foreach ($query->result() as $row) {
            $mixed_test = $row->mixed_test;
            $wid1 = $row->wid1;
            $wid2 = $row->wid2;

            $this->data['firstname'] = $row->firstname;
            $this->data['lastname'] = $row->lastname;

            $this->data['writing1'] = $this->get_writing($wid1, $row->id, 1, $row->score_wt1);
            $this->data['writing2'] = $this->get_writing($wid2, $row->id, 2, $row->score_wt2);

            $this->data['student_writing1'] = stripslashes($row->writing1);
            $this->data['student_writing2'] = stripslashes($row->writing2);
        }

        $this->load->view($this->theme . '/' . $this->object . '/writing_details', $this->data);
    }

    private function get_writing($wid, $session_student_id, $writing_part, $score_wt) {
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('writing') . ' where id=' . $wid);
        foreach ($query->result() as $row) {
            $response['id'] = $row->id;
            $response['subject'] = $row->subject;


            $score = "<select class='sel_score' alt='" . $session_student_id . "' writing_part='" . $writing_part . "'>";

            $score.="<option value='0' ";
            if ($score_wt == 0)
                $score.=" selected='selected' ";
            $score.=" >0</option>";

            $score.="<option value='1' ";
            if ($score_wt == 1)
                $score.=" selected='selected' ";
            $score.=" >1</option>";

            $score.="<option value='2' ";
            if ($score_wt == 2)
                $score.=" selected='selected' ";
            $score.=" >2</option>";

            $score.="<option value='3' ";
            if ($score_wt == 3)
                $score.=" selected='selected' ";
            $score.=" >3</option>";

            $score.="<option value='4' ";
            if ($score_wt == 4)
                $score.=" selected='selected' ";
            $score.=" >4</option>";

            $score.="<option value='5' ";
            if ($score_wt == 5)
                $score.=" selected='selected' ";
            $score.=" >5</option>";

            $score.="</select>";
            $response['score'] = $score;
        }
        return $response;
    }

    public function speaking_update_sel_score() {
        $id = $this->input->post('id');
        $speaking_part = $this->input->post('speaking_part');
        $score = $this->input->post('score');

        $this->db->query('update ' . $this->db->dbprefix('session_student') . ' set score_sk' . $speaking_part . '=' . $score . ', sk_teacher_id=' . $this->data['user_info']['id'] . ', sk_date=' . time() . ' where id=' . $id);
    }

    public function writing_update_sel_score() {
        $id = $this->input->post('id');
        $writing_part = $this->input->post('writing_part');
        $score = $this->input->post('score');

        $this->db->query('update ' . $this->db->dbprefix('session_student') . ' set score_wt' . $writing_part . '=' . $score . ', wt_teacher_id=' . $this->data['user_info']['id'] . ', wt_date=' . time() . ' where id=' . $id);
    }

}