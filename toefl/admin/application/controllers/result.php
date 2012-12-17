<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Result extends CI_Controller {

    private $object;
    private $theme;
    private $data;
    private $scaled_score_sk;
    private $scaled_score_wt;

    public function __construct() {
        parent::__construct();

        //--- object name
        $this->object = 'result';
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

        $this->data['link_view'] = base_url() . $this->object . '/view/';
        $this->data['link_download'] = base_url() . $this->object . '/download/';
        //--- end prepare links

        $this->scaled_score_sk["4"] = 30;
        $this->scaled_score_sk["3.83"] = 29;
        $this->scaled_score_sk["3.66"] = 28;
        $this->scaled_score_sk["3.5"] = 27;
        $this->scaled_score_sk["3.33"] = 26;
        $this->scaled_score_sk["3.16"] = 24;
        $this->scaled_score_sk["3"] = 23;
        $this->scaled_score_sk["2.83"] = 22;
        $this->scaled_score_sk["2.66"] = 20;
        $this->scaled_score_sk["2.5"] = 19;
        $this->scaled_score_sk["2.33"] = 18;
        $this->scaled_score_sk["2.16"] = 17;
        $this->scaled_score_sk["2"] = 15;
        $this->scaled_score_sk["1.83"] = 14;
        $this->scaled_score_sk["1.66"] = 13;
        $this->scaled_score_sk["1.5"] = 11;
        $this->scaled_score_sk["1.33"] = 10;
        $this->scaled_score_sk["1.16"] = 9;
        $this->scaled_score_sk["1"] = 8;
        $this->scaled_score_sk["0.83"] = 6;
        $this->scaled_score_sk["0.66"] = 5;
        $this->scaled_score_sk["0.5"] = 4;
        $this->scaled_score_sk["0.33"] = 3;
        $this->scaled_score_sk["0.16"] = 1;
        $this->scaled_score_sk["0"] = 0;

        $this->scaled_score_wt["5"] = 30;
        $this->scaled_score_wt["4.75"] = 29;
        $this->scaled_score_wt["4.5"] = 28;
        $this->scaled_score_wt["4.25"] = 27;
        $this->scaled_score_wt["4"] = 25;
        $this->scaled_score_wt["3.75"] = 24;
        $this->scaled_score_wt["3.5"] = 22;
        $this->scaled_score_wt["3.25"] = 21;
        $this->scaled_score_wt["3"] = 20;
        $this->scaled_score_wt["2.75"] = 18;
        $this->scaled_score_wt["2.5"] = 17;
        $this->scaled_score_wt["2.25"] = 15;
        $this->scaled_score_wt["2"] = 14;
        $this->scaled_score_wt["1.75"] = 12;
        $this->scaled_score_wt["1.5"] = 11;
        $this->scaled_score_wt["1.25"] = 10;
        $this->scaled_score_wt["1"] = 8;
        $this->scaled_score_wt["0.75"] = 7;
        $this->scaled_score_wt["0.5"] = 5;
        $this->scaled_score_wt["0.25"] = 4;
        $this->scaled_score_wt["0"] = 0;

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
            $filter_classes[] = 0;
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
            $filter_sessions[] = 0;
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

    private function scaled_score_rd($raw_score) {
        switch ($raw_score) {
            case 39: return 30;
            case 38: return 29;
            case 37: return 29;
            case 36: return 28;
            case 35: return 27;
            case 34: return 27;
            case 33: return 26;
            case 32: return 25;
            case 31: return 24;
            case 30: return 23;
            case 29: return 23;
            case 28: return 22;
            case 27: return 22;
            case 26: return 21;
            case 25: return 20;
            case 24: return 20;
            case 23: return 19;
            case 22: return 19;
            case 21: return 18;
            case 20: return 18;
            case 19: return 17;
            case 18: return 17;
            case 17: return 16;
            case 16: return 16;
            case 15: return 15;
            case 14: return 15;
            case 13: return 14;
            case 12: return 13;
            case 11: return 12;
            case 10: return 11;
            case 9: return 10;
            case 8: return 9;
            case 7: return 8;
            case 6: return 6;
            case 5: return 5;
            case 4: return 4;
            case 3: return 3;
            case 2: return 2;
            case 1: return 1;
            case 0: return 0;
            default: return 30;
        }
    }

    private function scaled_score_ln($raw_score) {
        switch ($raw_score) {
            case 34: return 30;
            case 33: return 29;
            case 32: return 28;
            case 31: return 28;
            case 30: return 27;
            case 29: return 26;
            case 28: return 25;
            case 27: return 25;
            case 26: return 24;
            case 25: return 23;
            case 24: return 22;
            case 23: return 22;
            case 22: return 21;
            case 21: return 21;
            case 20: return 20;
            case 19: return 19;
            case 18: return 19;
            case 17: return 18;
            case 16: return 17;
            case 15: return 17;
            case 14: return 16;
            case 13: return 15;
            case 12: return 15;
            case 11: return 14;
            case 10: return 13;
            case 9: return 13;
            case 8: return 12;
            case 7: return 11;
            case 6: return 9;
            case 5: return 8;
            case 4: return 6;
            case 3: return 5;
            case 2: return 4;
            case 1: return 2;
            case 0: return 0;
            default: return 30;
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

    public function view($session_id) {
        $item = $this->Session_model->get_entry($session_id);
        if (isset($item[0]))
            $this->data['session'] = $item[0];

        $filter_class = '';
        if (current_group_id() == 2 || current_group_id() == 3)
            $filter_class = ' and ss.class in (' . implode(',', $this->session->userdata('filter_classes')) . ') ';

        $query = $this->db->query('SELECT ss.id,ss.student,ss.mixed_test,ss.test_order, ss.disabled, ss.status, ss.class as class_id,
                    reading1, reading2, reading3,
                    listening1, listening2, listening3, listening4, listening5, listening6,
                    ss.score_sk1, ss.score_sk2, ss.score_sk3, ss.score_sk4, ss.score_sk5, ss.score_sk6,
                    score_wt1,score_wt2,
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

            if ($row->status == 1) {
                $this->data["assigns"][$i]["score_rd"] = $this->reading_score($row->id);
                $this->data["assigns"][$i]["scaled_score_rd"] = $this->scaled_score_rd($this->data["assigns"][$i]["score_rd"]);

                $this->data["assigns"][$i]["score_ln"] = $this->listening_score($row->id);
                $this->data["assigns"][$i]["scaled_score_ln"] = $this->scaled_score_ln($this->data["assigns"][$i]["score_ln"]);

                $this->data["assigns"][$i]["score_sk"] = floor(($row->score_sk1 + $row->score_sk2 + $row->score_sk3 + $row->score_sk4 + $row->score_sk5 + $row->score_sk6) / 6 * 100) / 100;
                $this->data["assigns"][$i]["scaled_score_sk"] = $this->scaled_score_sk[(string) $this->data["assigns"][$i]["score_sk"]];

                $this->data["assigns"][$i]["score_wt"] = floor(($row->score_wt1 + $row->score_wt2) / 2 * 100) / 100;
                $this->data["assigns"][$i]["scaled_score_wt"] = $this->scaled_score_wt[(string) $this->data["assigns"][$i]["score_wt"]];
            } else {

                $this->data["assigns"][$i]["score_rd"] = 0;
                $this->data["assigns"][$i]["scaled_score_rd"] = 0;

                $this->data["assigns"][$i]["score_ln"] = 0;
                $this->data["assigns"][$i]["scaled_score_ln"] = 0;

                $this->data["assigns"][$i]["score_sk"] = 0;
                $this->data["assigns"][$i]["scaled_score_sk"] = 0;

                $this->data["assigns"][$i]["score_wt"] = 0;
                $this->data["assigns"][$i]["scaled_score_wt"] = 0;
            }
        }

        //--- load view
        $this->load->view($this->theme . '/header', $this->data);
        $this->load->view($this->theme . '/nav', $this->data);
        $this->load->view($this->theme . '/' . $this->object . '/view', $this->data);
        $this->load->view($this->theme . '/footer', $this->data);
        //--- end load view
    }

    public function download($session_id) {
        $this->db->empty_table('tmp_result');

        $item = $this->Session_model->get_entry($session_id);
        if (isset($item[0]))
            $this->data['session'] = $item[0];

        $filter_class = '';
        if (current_group_id() == 2 || current_group_id() == 3)
            $filter_class = ' and ss.class in (' . implode(',', $this->session->userdata('filter_classes')) . ') ';

        $query = $this->db->query('SELECT ss.id,ss.student,ss.mixed_test,ss.test_order, ss.disabled, ss.status,
                    reading1, reading2, reading3,
                    listening1, listening2, listening3, listening4, listening5, listening6,
                    ss.score_sk1, ss.score_sk2, ss.score_sk3, ss.score_sk4, ss.score_sk5, ss.score_sk6,
                    score_wt1,score_wt2,
                    (select c.title from ' . $this->db->dbprefix('class') . ' c where c.id=ss.class limit 0,1) as class,
                    (select s.firstname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as firstname,
                    (select s.lastname from ' . $this->db->dbprefix('user') . ' s where s.id=ss.student limit 0,1) as lastname,
                    (select m.title from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as mixed_test_title,
                    (select t.title from ' . $this->db->dbprefix('test_order') . ' t where t.id=ss.test_order limit 0,1) as test_order_title
                    FROM ' . $this->db->dbprefix('session_student') . ' ss where deleted=0 ' . $filter_class . ' and session=' . $session_id);

        $data->Student = 'Student';
        $data->Class_Name = 'Class_Name';
        $data->RD = 'RD';
        $data->SRD = 'SRD';

        $data->LN = 'LN';
        $data->SLN = 'SLN';

        $data->SK = 'SK';
        $data->SSK = 'SSK';

        $data->WT = 'WT';
        $data->SWT = 'SWT';

        $this->db->insert('tmp_result', $data);


        foreach ($query->result() as $row) {
            $data->Student = $row->firstname . " " . $row->lastname;
            $data->Class_Name = $row->class;

            if ($row->status == 1) {

                $data->RD = $this->reading_score($row->id);
                $data->SRD = $this->scaled_score_rd($data->RD);

                $data->LN = $this->listening_score($row->id);
                $data->SLN = $this->scaled_score_ln($data->LN);

                $data->SK = floor(($row->score_sk1 + $row->score_sk2 + $row->score_sk3 + $row->score_sk4 + $row->score_sk5 + $row->score_sk6) / 6 * 100) / 100;
                $data->SSK = $this->scaled_score_sk[(string) $data->SK];

                $data->WT = floor(($row->score_wt1 + $row->score_wt2) / 2 * 100) / 100;
                $data->SWT = $this->scaled_score_wt[(string) $data->WT];
            } else {

                $data->RD = 0;
                $data->SRD = 0;

                $data->LN = 0;
                $data->SLN = 0;

                $data->SK = 0;
                $data->SSK = 0;

                $data->WT = 0;
                $data->SWT = 0;
            }

            $this->db->insert('tmp_result', $data);
        }

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('tmp_result') . ' order by Class_Name, Student');
        $this->to_excel($query, 'result');
    }

    private function to_excel($query, $filename = 'exceloutput') {
        $headers = ''; // just creating the var for field headers to append to below
        $data = ''; // just creating the var for field data to append to below

        $obj = & get_instance();

        $fields = $query->field_data();
        if ($query->num_rows() == 0) {
            echo '<p>The table appears to have no data.</p>';
        } else {
            foreach ($fields as $field) {
                $headers .= $field->name . "\t";
            }

            foreach ($query->result() as $row) {
                $line = '';
                foreach ($row as $value) {
                    if ((!isset($value)) OR ($value == "")) {
                        $value = "\t";
                    } else {
                        $value = str_replace('"', '""', $value);
                        $value = '"' . $value . '"' . "\t";
                    }
                    $line .= $value;
                }
                $data .= trim($line) . "\n";
            }

            $data = str_replace("\r", "", $data);

            header("Content-type: application/x-msdownload");
            header("Content-Disposition: attachment; filename=$filename.xls");
            echo "$headers\n$data";
        }
    }

    public function reading_score($session_student_id) {
        $query = $this->db->query('SELECT ss.mixed_test, ss.reading1, ss.reading2, ss.reading3,
                (select m.reading1 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as rid1,
                (select m.reading2 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as rid2,
                (select m.reading3 from ' . $this->db->dbprefix('mixed_test') . ' m where m.id=ss.mixed_test limit 0,1) as rid3
                FROM ' . $this->db->dbprefix('session_student') . ' ss where ss.id=' . $session_student_id);

        foreach ($query->result() as $row) {
            $mixed_test = $row->mixed_test;
            $rid1 = $row->rid1;
            $rid2 = $row->rid2;
            $rid3 = $row->rid3;

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

        $reading1_scq = $this->reading_get_scq($rid1, $scq1);
        $reading1_mcq = $this->reading_get_mcq($rid1, $mcq1);
        $reading1_iq = $this->reading_get_iq($rid1, $iq1);
        $reading1_ddq = $this->reading_get_ddq($rid1, $ddq1);
        $reading1_oq = $this->reading_get_oq($rid1, $oq1);
        $total1 = $reading1_scq + $reading1_mcq + $reading1_iq + $reading1_ddq + $reading1_oq;

        $reading2_scq = $this->reading_get_scq($rid2, $scq2);
        $reading2_mcq = $this->reading_get_mcq($rid2, $mcq2);
        $reading2_iq = $this->reading_get_iq($rid2, $iq2);
        $reading2_ddq = $this->reading_get_ddq($rid2, $ddq2);
        $reading2_oq = $this->reading_get_oq($rid2, $oq2);
        $total2 = $reading2_scq + $reading2_mcq + $reading2_iq + $reading2_ddq + $reading2_oq;

        $reading3_scq = $this->reading_get_scq($rid3, $scq3);
        $reading3_mcq = $this->reading_get_mcq($rid3, $mcq3);
        $reading3_iq = $this->reading_get_iq($rid3, $iq3);
        $reading3_ddq = $this->reading_get_ddq($rid3, $ddq3);
        $reading3_oq = $this->reading_get_oq($rid3, $oq3);
        $total3 = $reading3_scq + $reading3_mcq + $reading3_iq + $reading3_ddq + $reading3_oq;

        return $total1 + $total2 + $total3;
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
        $score = 0;

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('reading_scq') . ' where deleted=0 and rid=' . $rid);

        foreach ($query->result_array() as $rows) {
            $student_answer = 0;
            foreach ($scq as $key => $value) {
                if ($key == $rows['id'])
                    $student_answer = $value;
            }

            if ($rows['answer'] == $student_answer)
                $score++;
        }

        return $score;
    }

    private function reading_get_mcq($rid, $mcq) {
        $score = 0;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('reading_mcq') . ' where deleted=0 and rid=' . $rid);

        foreach ($query->result_array() as $rows) {
            $answer_arr = explode(',', $rows['answer']);

            $student_answer = '';
            foreach ($mcq as $key => $value) {
                if ($key == $rows['id'])
                    $student_answer = $value;
            }

            $raw_score = 0;
            $answer_arr1 = explode(';', $student_answer);
            foreach ($answer_arr1 as $a) {
                if (in_array($a, $answer_arr))
                    $raw_score++;
            }
            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('configure_score') . ' where question_type="r_mcq" and question_id=' . $rows['id'] . ' and rightchoices=' . $raw_score);
            $scaled_score = 0;
            foreach ($query1->result_array() as $rows1) {
                $scaled_score = $rows1['score'];
            }
            $score+=$scaled_score;
        }

        return $score;
    }

    private function reading_get_iq($rid, $iq) {
        $score = 0;
        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('reading_iq') . ' where deleted=0 and rid=' . $rid);
        foreach ($query->result_array() as $rows) {
            $student_answer = 0;
            foreach ($iq as $key => $value) {
                if ($key == $rows['id'])
                    $student_answer = $value;
            }

            if ($rows['answer'] == $student_answer)
                $score++;
        }

        return $score;
    }

    private function reading_get_ddq($rid, $ddq) {
        $score = 0;

        /* Array (
          [104] => Array ( //DDQ ID
          [141] => Array ( //Subject ID
          [0] => 623 //Answer ID
          [1] => 624 //Answer ID
          )
          )
          [154] => Array (
          [] => Array (
          [0] =>
          )
          )
          ) */

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('reading_ddq') . ' where deleted=0 and rid=' . $rid);
        foreach ($query->result_array() as $rows) {
            if (isset($subjects))
                unset($subjects);
            //load subjects array and choices belong to that subject
            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('reading_ddq_answer') . ' where deleted=0 and ddqid=' . $rows['id']);
            foreach ($query1->result() as $row1) {
                $subjects[$row1->subid][] = $row1->id;
            }

            $raw_score = 0;
            if (isset($ddq[$rows['id']]))
                foreach ($ddq[$rows['id']] as $subject_id => $answers) {
                    foreach ($answers as $a) {
                        if (in_array($a, $subjects[$subject_id]))
                            $raw_score++;
                    }
                }

            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('configure_score') . ' where question_type="r_ddq" and question_id=' . $rows['id'] . ' and rightchoices=' . $raw_score);
            $scaled_score = 0;
            foreach ($query1->result_array() as $rows1) {
                $scaled_score = $rows1['score'];
            }
            $score+=$scaled_score;
        }

        return $score;
    }

    private function reading_get_oq($rid, $oq) {
        $score = 0;
        foreach ($oq as $key => $value) {
            if ($value != '') {
                $answer_arr = explode(';', $value);

                $raw_score = 0;
                if ($answer_arr[0] == 1)
                    $raw_score++;
                if ($answer_arr[1] == 2)
                    $raw_score++;
                if ($answer_arr[2] == 3)
                    $raw_score++;
                if ($answer_arr[3] == 4)
                    $raw_score++;

                $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('configure_score') . ' where question_type="r_oq" and question_id=' . $key . ' and rightchoices=' . $raw_score);
                $scaled_score = 0;
                foreach ($query1->result_array() as $rows1) {
                    $scaled_score = $rows1['score'];
                }
                $score+=$scaled_score;
            }
        }

        return $score;
    }

    public function listening_score($session_student_id) {
        $query = $this->db->query('SELECT ss.mixed_test, ss.listening1, ss.listening2, ss.listening3, ss.listening4, ss.listening5, ss.listening6,
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

        $listening1_scq = $this->listening_get_scq($lid1, $scq1);
        $listening1_mcq = $this->listening_get_mcq($lid1, $mcq1);
        $listening1_cq = $this->listening_get_cq($lid1, $cq1);
        $listening1_oq = $this->listening_get_oq($lid1, $oq1);
        $total1 = $listening1_scq + $listening1_mcq + $listening1_cq + $listening1_oq;

        $listening2_scq = $this->listening_get_scq($lid2, $scq2);
        $listening2_mcq = $this->listening_get_mcq($lid2, $mcq2);
        $listening2_cq = $this->listening_get_cq($lid2, $cq2);
        $listening2_oq = $this->listening_get_oq($lid2, $oq2);
        $total2 = $listening2_scq + $listening2_mcq + $listening2_cq + $listening2_oq;

        $listening3_scq = $this->listening_get_scq($lid3, $scq3);
        $listening3_mcq = $this->listening_get_mcq($lid3, $mcq3);
        $listening3_cq = $this->listening_get_cq($lid3, $cq3);
        $listening3_oq = $this->listening_get_oq($lid3, $oq3);
        $total3 = $listening3_scq + $listening3_mcq + $listening3_cq + $listening3_oq;

        $listening4_scq = $this->listening_get_scq($lid4, $scq4);
        $listening4_mcq = $this->listening_get_mcq($lid4, $mcq4);
        $listening4_cq = $this->listening_get_cq($lid4, $cq4);
        $listening4_oq = $this->listening_get_oq($lid4, $oq4);
        $total4 = $listening4_scq + $listening4_mcq + $listening4_cq + $listening4_oq;

        $listening5_scq = $this->listening_get_scq($lid5, $scq5);
        $listening5_mcq = $this->listening_get_mcq($lid5, $mcq5);
        $listening5_cq = $this->listening_get_cq($lid5, $cq5);
        $listening5_oq = $this->listening_get_oq($lid5, $oq5);
        $total5 = $listening5_scq + $listening5_mcq + $listening5_cq + $listening5_oq;

        $listening6_scq = $this->listening_get_scq($lid6, $scq6);
        $listening6_mcq = $this->listening_get_mcq($lid6, $mcq6);
        $listening6_cq = $this->listening_get_cq($lid6, $cq6);
        $listening6_oq = $this->listening_get_oq($lid6, $oq6);
        $total6 = $listening6_scq + $listening6_mcq + $listening6_cq + $listening6_oq;

        return $total1 + $total2 + $total3 + $total4 + $total5 + $total6;
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
        $score = 0;

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('listening_scq') . ' where deleted=0 and lid=' . $lid);
        foreach ($query->result_array() as $rows) {
            $student_answer = 0;
            foreach ($scq as $key => $value) {
                if ($key == $rows['id'])
                    $student_answer = $value;
            }

            if ($rows['answer'] == $student_answer)
                $score++;
        }

        return $score;
    }

    private function listening_get_mcq($lid, $mcq) {
        $score = 0;

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('listening_mcq') . ' where deleted=0 and lid=' . $lid);

        foreach ($query->result_array() as $rows) {
            $answer_arr = explode(',', $rows['answer']);

            foreach ($mcq as $key => $value) {
                if ($key == $rows['id'])
                    $student_answer = $value;

                $raw_score = 0;
                if (isset($student_answer)) {
                    $answer_arr1 = explode(';', $student_answer);
                    foreach ($answer_arr1 as $a) {
                        if (in_array($a, $answer_arr))
                            $raw_score++;
                    }
                }
            }

            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('configure_score') . ' where question_type="l_mcq" and question_id=' . $rows['id'] . ' and rightchoices=' . $raw_score);
            $scaled_score = 0;
            foreach ($query1->result_array() as $rows1) {
                $scaled_score = $rows1['score'];
            }
            $score+=$scaled_score;
        }

        return $score;
    }

    private function listening_get_cq($lid, $cq) {
        $score = 0;

        $query = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('listening_cq') . ' where deleted=0 and lid=' . $lid);
        foreach ($query->result_array() as $rows) {
            $query1 = $this->db->query('SELECT *,
                (select c.title from ' . $this->db->dbprefix('listening_cq_column') . ' c where c.id=r.col limit 0,1) as col_title
                FROM ' . $this->db->dbprefix('listening_cq_row') . ' r where r.deleted=0 and r.cqid=' . $rows['id']);

            $raw_score = 0;
            foreach ($query1->result_array() as $rows1) {
                if ($cq[$rows['id']][$rows1['id']] == $rows1['col'])
                    $raw_score++;
            }

            $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('configure_score') . ' where question_type="l_cq" and question_id=' . $rows['id'] . ' and rightchoices=' . $raw_score);
            $scaled_score = 0;
            foreach ($query1->result_array() as $rows1) {
                $scaled_score = $rows1['score'];
            }
            $score+=$scaled_score;
        }


        return $score;
    }
    
    private function listening_get_oq($lid, $oq) {
        $score = 0;
        foreach ($oq as $key => $value) {
            if ($value != '') {
                $answer_arr = explode(';', $value);

                $raw_score = 0;
                if ($answer_arr[0] == 1)
                    $raw_score++;
                if ($answer_arr[1] == 2)
                    $raw_score++;
                if ($answer_arr[2] == 3)
                    $raw_score++;
                if ($answer_arr[3] == 4)
                    $raw_score++;

                $query1 = $this->db->query('SELECT * FROM ' . $this->db->dbprefix('configure_score') . ' where question_type="l_oq" and question_id=' . $key . ' and rightchoices=' . $raw_score);
                $scaled_score = 0;
                foreach ($query1->result_array() as $rows1) {
                    $scaled_score = $rows1['score'];
                }
                $score+=$scaled_score;
            }
        }

        return $score;
    }

}