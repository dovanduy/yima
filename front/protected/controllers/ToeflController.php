<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ToeflController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $Course_testModel;
    private $TestModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $Course_testModel Course_testModel */
        $this->Course_testModel = new Course_testModel();
        /* @var $TestModel TestModel */
        $this->TestModel = new TestModel();
    }

    public function actionIndex($p = 1) {
        $args = '';

        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $toefl = $this->Course_testModel->get_toefl_course($args, $p, $ppp);
        $total = $this->Course_testModel->get_toefl_counts();


        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/index/p/", $total, $p) : "";
        $this->viewData['toefl'] = $toefl;
        $this->viewData['total'] = $total;

        $this->render('index', $this->viewData);
    }

    public function actionView($id, $p = 1) {
        $toefl = $this->Course_testModel->get_source($id);
        if (!$toefl)
            $this->load_404();
        $this->layout = "view-test";
        $ppp = Yii::app()->params['ppp'];
        $args = array('deleted' => 0, 'ref_id' => $toefl['id'], 'ref_type' => 'toefl');
        //$comments = $this->CommentModel->gets($args, $p, $ppp);
        //$total = $this->CommentModel->counts($args);
        //$this->viewData['has_buy'] = $this->TestModel->get_user_test(UserControl::getId(), $test['id']);
        $this->viewData['post'] = $toefl;
        $this->viewData['c_id'] = $id;
        //$this->viewData['comments'] = $comments;
        //$this->viewData['total'] = $total;
        //$this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/test/view/s/$s/p/", $total, $p) : "";
        //$this->viewData['best_comment'] = $this->CommentModel->get_best_comment($test['id'], 'test_nt');
        $this->render('view', $this->viewData);
    }

    public function actionMarks_reading() {
        HelperGlobal::require_login();
        $right_choice = 0;
        $wrong_choice = 0;

        $test_id = $_POST['rid'];
        $c_id = $_POST['cid'];
        $type = 'toefl_reading_' . $_POST['part'];
        $relationship = $this->TestModel->get_user_toefl(UserControl::getId(), $test_id, $type);
        if ($relationship['id'] != "")
            $relationship_id = $relationship['id'];
        else
            $relationship_id = $this->TestModel->add_user_toefl(UserControl::getId(), $test_id, $c_id, $type);

        $data['scq'] = explode(',', $_POST['scq_id']);
        $data['scq_user_choice'] = explode(',', $_POST['scq_choice']);
        $total_scq = count($data['scq']);

        $user_choices_scq = array();
        $right_choices_scq = array();
        for ($i = 1; $i <= $total_scq; $i++) {
            $right_choices_scq[$data['scq'][$i - 1]] = $this->Course_testModel->get_sc_reading($data['scq'][$i - 1]);
            $user_choices_scq[$data['scq'][$i - 1]] = $data['scq_user_choice'][$i - 1] != "" ? $data['scq_user_choice'][$i - 1] : 0;
        }


//        for ($i = 0; $i < $total_scq; $i++) {
//            $answer = $this->TestModel->get_reading_scq_answer($data['scq'][$i]);
//            if ($data['scq_user_choice'][$i] == $answer['answer'])
//                $right_choice++;
//            $wrong_choice++;
//        }

        $data['mcq_id'] = explode(',', $_POST['mcq_id']);
        $data['mcq_choice'] = explode(',', $_POST['mcq_choice']);
        $total_mcq = count($data['mcq_id']);

        $user_choices_mcq = array();
        $right_choices_mcq = array();
        for ($i = 1; $i <= $total_mcq; $i++) {
            $right_choices_mcq[$data['mcq_id'][$i - 1]] = $this->Course_testModel->get_mc_reading($data['mcq_id'][$i - 1]);
            $user_choices_mcq[$data['mcq_id'][$i - 1]] = $data['mcq_choice'][$i - 1] != "" ? $data['mcq_choice'][$i - 1] : 0;
        }

        // print_r($user_choices_mcq);print_r($right_choices_mcq);die;
//        for ($i = 0; $i < $total_mcq; $i++) {
//            $answer = $this->TestModel->get_reading_mcq_answer($data['mcq_id'][$i]);
//            if ($data['scq_user_choice'][$i] == $answer['answer'])
//                $right_choice++;
//        }

        $data['iq_id'] = explode(',', $_POST['iq_id']);

        $data['iq_choice'] = explode(',', $_POST['iq_choice']);
        $total_iq = count($data['iq_id']);

        $user_choices_iq = array();
        $right_choices_iq = array();
        for ($i = 1; $i <= $total_iq; $i++) {
            $right_choices_iq[$data['iq_id'][$i - 1]] = $this->Course_testModel->get_iq_reading($data['iq_id'][$i - 1]);
            $user_choices_iq[$data['iq_id'][$i - 1]] = $data['iq_choice'][$i - 1] != "" ? $data['iq_choice'][$i - 1] : 0;
        }


        $data['ddq_id'] = explode(',', $_POST['ddq_id']);
        $data['ddq_subject'] = explode(',', $_POST['ddq_subject']);
        $data['ddq_choice'] = explode(',', $_POST['ddq_choice']);
        $total_ddq = count($data['ddq_id']);

        $user_choices_ddq = array();
        $right_choices_ddq = array();
        for ($i = 1; $i <= $total_ddq; $i++) {
            $right_choices_ddq[$data['ddq_id'][$i - 1]] = $this->Course_testModel->get_ddq_reading($data['ddq_id'][$i - 1]);
            $user_choices_ddq[$data['ddq_id'][$i - 1]] = $data['ddq_choice'][$i - 1] != "" ? $data['ddq_choice'][$i - 1] : 0;
        }


        $tmp_user_choices_ddq = array();
        $tmp_user_choices_ddq_1 = array();
        $ans = array();
        $i = 0;
        foreach ($user_choices_ddq as $v) {
            $ans = explode(';', $v);
            foreach ($ans as $k => $a) {
                //$tmp_user_choices_ddq[$ans[$k]] = $ans[$k];
                $tmp_user_choices_ddq[$i] = $ans[$k];
                $i++;
            }
        }
        $i = 0;
        $tmp_right_choices_ddq = array();
        foreach ($right_choices_ddq as $k => $v) {
            foreach ($v as $sub) {
                $tmp_right_choices_ddq[$sub['ans_id']] = $sub;
                $tmp_user_choices_ddq_1[$sub['ans_id']] = $tmp_user_choices_ddq[$i];
                $i++;
            }
        }

        $right_choices_ddq = $tmp_right_choices_ddq;
        $user_choices_ddq = $tmp_user_choices_ddq_1;


        $data['oq_id'] = explode(',', $_POST['oq_id']);
        $data['oq_choice'] = explode(',', $_POST['oq_choice']);
        $total_oq = count($data['oq_id']);

        $user_choices_oq = array();
        $right_choices_oq = array();
        for ($i = 1; $i <= $total_oq; $i++) {
            $right_choices_oq[$data['oq_id'][$i - 1]] = $this->Course_testModel->get_oq_reading($data['oq_id'][$i - 1]);
            $user_choices_oq[$data['oq_id'][$i - 1]] = $data['oq_choice'][$i - 1] != "" ? $data['oq_choice'][$i - 1] : 0;
        }


        $user_choices = array('scq' => $user_choices_scq, 'mcq' => $user_choices_mcq, 'iq' => $user_choices_iq, 'ddq' => $user_choices_ddq, 'oq' => $user_choices_oq);
        $right_choices = array('scq' => $right_choices_scq, 'mcq' => $right_choices_mcq, 'iq' => $right_choices_iq, 'ddq' => $right_choices_ddq, 'oq' => $right_choices_oq);
        $all_data = serialize(array('user_choices' => $user_choices, 'right_choices' => $right_choices));

        $rela = $this->TestModel->add_test_relationship($relationship_id, $all_data, 0, $right_choice);
        echo json_encode($rela);
    }

    public function actionMarks_listening() {
        HelperGlobal::require_login();

        $test_id = $_POST['lid'];
        $type = 'toefl_listening_' . $_POST['part'];
        $c_id = $_POST['cid'];
        $relationship = $this->TestModel->get_user_toefl(UserControl::getId(), $test_id, $type);
        if ($relationship['id'] != "")
            $relationship_id = $relationship['id'];
        else
            $relationship_id = $this->TestModel->add_user_toefl(UserControl::getId(), $test_id, $c_id, $type);

        $data['scq_id'] = explode(',', $_POST['scq_id']);
        $data['scq_choice'] = explode(',', $_POST['scq_choice']);
        $total_scq = count($data['scq_id']);

        $user_choices_scq = array();
        $right_choices_scq = array();

        for ($i = 1; $i <= $total_scq; $i++) {
            $right_choices_scq[$data['scq_id'][$i - 1]] = $this->Course_testModel->get_sc_listening($data['scq_id'][$i - 1]);
            $user_choices_scq[$data['scq_id'][$i - 1]] = $data['scq_choice'][$i - 1] != "" ? $data['scq_choice'][$i - 1] : 0;
        }

        $data['mcq_id'] = explode(',', $_POST['mcq_id']);
        $data['mcq_choice'] = explode(',', $_POST['mcq_choice']);
        $total_mcq = count($data['mcq_id']);
        $user_choices_mcq = array();
        $right_choices_mcq = array();
        for ($i = 1; $i <= $total_mcq; $i++) {
            $right_choices_mcq[$data['mcq_id'][$i - 1]] = $this->Course_testModel->get_mc_listening($data['mcq_id'][$i - 1]);
            $user_choices_mcq[$data['mcq_id'][$i - 1]] = $data['mcq_choice'][$i - 1] != "" ? $data['mcq_choice'][$i - 1] : 0;
        }

        $data['cq_id'] = explode(',', $_POST['cq_id']);
        $data['cq_choice'] = explode(',', $_POST['cq_choice']);
        $total_cq = count($data['cq_id']);

        $user_choices_cq = array();
        $right_choices_cq = array();

        for ($i = 1; $i <= $total_cq; $i++) {
            $right_choices_cq[$data['cq_id'][$i - 1]] = $this->Course_testModel->get_cq_listening($data['cq_id'][$i - 1]);
            $user_choices_cq[$data['cq_id'][$i - 1]] = $data['cq_choice'][$i - 1] != "" ? $data['cq_choice'][$i - 1] : 0;
        }

        $tmp_user_choices_cq = array();
        $tmp_user_choices_cq_1 = array();
        $ans = array();
        $i = 0;
        foreach ($user_choices_cq as $v) {
            $ans = explode(';', $v);
            foreach ($ans as $k => $a) {
                //$tmp_user_choices_ddq[$ans[$k]] = $ans[$k];
                $tmp_user_choices_cq[$i] = $ans[$k];
                $i++;
            }
        }
        $i = 0;

        $tmp_right_choices_cq = array();
        foreach ($right_choices_cq as $k => $v) {
            foreach ($v as $sub) {
                $tmp_right_choices_cq[$sub['ro_id']] = $sub;
                $tmp_user_choices_cq_1[$sub['ro_id']] = substr($tmp_user_choices_cq[$i], 4, 3);
                $i++;
            }
        }
        $right_choices_cq = $tmp_right_choices_cq;
        $user_choices_cq = $tmp_user_choices_cq_1;

        $data['oq_id'] = explode(',', $_POST['oq_id']);
        $data['oq_choice'] = explode(',', $_POST['oq_choice']);
        $total_oq = count($data['oq_id']);
        $user_choices_oq = array();
        $right_choices_oq = array();
        for ($i = 1; $i <= $total_oq; $i++) {
            $right_choices_oq[$data['oq_id'][$i - 1]] = $this->Course_testModel->get_oq_listening($data['oq_id'][$i - 1]);
            $user_choices_oq[$data['oq_id'][$i - 1]] = $data['oq_choice'][$i - 1] != "" ? $data['oq_choice'][$i - 1] : 0;
        }

        $user_choices = array('scq' => $user_choices_scq, 'mcq' => $user_choices_mcq, 'cq' => $user_choices_cq, 'oq' => $user_choices_oq);
        $right_choices = array('scq' => $right_choices_scq, 'mcq' => $right_choices_mcq, 'cq' => $right_choices_cq, 'oq' => $right_choices_oq);
        $all_data = serialize(array('user_choices' => $user_choices, 'right_choices' => $right_choices));

        $rela = $this->TestModel->add_test_relationship($relationship_id, $all_data, 0, 0);
        echo json_encode($rela);
    }

    public function actionMarks_speaking() {
        HelperGlobal::require_login();

        $test_id = $_POST['sid'];
        $type = 'toefl_speaking';
        $c_id = $_POST['cid'];
        $relationship = $this->TestModel->get_user_toefl(UserControl::getId(), $test_id, $type);
        if ($relationship['id'] != "")
            $relationship_id = $relationship['id'];
        else
            $relationship_id = $this->TestModel->add_user_toefl(UserControl::getId(), $test_id, $c_id, $type);

        $speaking_part = explode(',', $_POST('speaking_part'));
        $all_data = serialize($data);
        $this->TestModel->add_test_relationship($relationship_id, $all_data, 0, 0);
    }

    public function actionMarks_writing() {
        HelperGlobal::require_login();

        $wd1 = $_POST['wid1'];
        $wd2 = $_POST['wid2'];

        $writing1 = $_POST['writing1'];
        $writing2 = $_POST['writing2'];

        $test_id = $wd1 . ',' . $wd2;
        $type = 'toefl_writing';
        $c_id = $_POST['cid'];


        $relationship = $this->TestModel->get_user_toefl(UserControl::getId(), $test_id, $type);
        if ($relationship['id'] != "")
            $relationship_id = $relationship['id'];
        else
            $relationship_id = $this->TestModel->add_user_toefl(UserControl::getId(), $test_id, $c_id, $type);

        $all_data = serialize(array('writing1' => $writing1, 'writing2' => $writing2, 'writing_id1' => $wd1, 'writing_id2' => $wd2));

        $rela = $this->TestModel->add_test_relationship($relationship_id, $all_data, 0, 0);
        echo json_encode($rela);
    }

    public function actionFinished($id, $part) {
        HelperGlobal::require_login();
        $finish = $this->TestModel->get_test_relationship_toefl($id,$part);
        //print_r($finish);die;
        if (!$finish || $finish['user_id'] != UserControl::getId())
            $this->load_404();

        $this->layout = "main";
        $this->viewData['finish'] = $finish;
        //print_r($finish);die;
        $this->render('finish_' . $part, $this->viewData);
    }
    
  
    
}

?>
