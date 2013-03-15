<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TestController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $ToeicModel;
    private $TestModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $ToeicModel Toeic_Source_TestModel */
        $this->ToeicModel = new Toeic_Source_TestModel();

        /* @var $TestModel TestModel */
        $this->TestModel = new TestModel();
    }

    public function actionIndex($p = 1) {
        $args = '';
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $tests = $this->ToeicModel->gets($args);
        $total = $this->ToeicModel->counts($args);

        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toeic/test/index/p/", $total, $p) : "";
        $this->viewData['tests'] = $tests;
        $this->viewData['total'] = $total;
        
        $this->render('index', $this->viewData);
    }

    public function actionView($id, $p = 1) {
        $toeic = $this->ToeicModel->get($id);
        if (!$toeic)
            $this->load_404();
        $this->layout = "view-test";
        $ppp = Yii::app()->params['ppp'];
        $args = array('deleted' => 0, 'ref_id' => $toeic['id'], 'ref_type' => 'toeic');
        //$comments = $this->CommentModel->gets($args, $p, $ppp);
        //$total = $this->CommentModel->counts($args);
        //$this->viewData['has_buy'] = $this->TestModel->get_user_test(UserControl::getId(), $test['id']);
        $this->viewData['post'] = $toeic;
        $this->viewData['cid'] = $id;
        //$this->viewData['comments'] = $comments;
        //$this->viewData['total'] = $total;
        //$this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/test/view/s/$s/p/", $total, $p) : "";
        //$this->viewData['best_comment'] = $this->CommentModel->get_best_comment($test['id'], 'test_nt');
        $this->render('view', $this->viewData);
    }

    public function actionMarks_reading() {
        
        HelperGlobal::require_login();
        $test_id = $_POST['rid'];
        $c_id = $_POST['cid'];
        $type = 'toeic_reading';
        $relationship = $this->TestModel->get_user_toefl(UserControl::getId(), $test_id, $type);
        if ($relationship['id'] != "")
            $relationship_id = $relationship['id'];
        else
            $relationship_id = $this->TestModel->add_user_toefl(UserControl::getId(), $test_id, $c_id, $type);

        $data['scq_5'] = explode(',', $_POST['part5_id']);
        $data['scq_user_choice_5'] = explode(',', $_POST['part5_choice']);
        $total_scq_5 = count($data['scq_5']);

        $user_choices_scq_5 = array();
        $right_choices_scq_5 = array();
        for ($i = 1; $i <= $total_scq_5; $i++) {
            $right_choices_scq_5[$data['scq_5'][$i - 1]] = $this->ToeicModel->get_sc_reading($data['scq_5'][$i - 1]);
            $user_choices_scq_5[$data['scq_5'][$i - 1]] = $data['scq_user_choice_5'][$i - 1] != "" ? $data['scq_user_choice_5'][$i - 1] : 0;
        }
        
        $data['scq_6'] = explode(',', $_POST['part6_id']);
        $data['scq_user_choice_6'] = explode(',', $_POST['part6_choice']);
        $total_scq_6 = count($data['scq_6']);

        $user_choices_scq_6 = array();
        $right_choices_scq_6 = array();
        for ($i = 1; $i <= $total_scq_6; $i++) {
            $right_choices_scq_6[$data['scq_6'][$i - 1]] = $this->ToeicModel->get_sc_reading($data['scq_6'][$i - 1]);
            $user_choices_scq_6[$data['scq_6'][$i - 1]] = $data['scq_user_choice_6'][$i - 1] != "" ? $data['scq_user_choice_6'][$i - 1] : 0;
        }
        
        $data['scq_7'] = explode(',', $_POST['part7_id']);
        $data['scq_user_choice_7'] = explode(',', $_POST['part7_choice']);
        $total_scq_7 = count($data['scq_7']);

        $user_choices_scq_7 = array();
        $right_choices_scq_7 = array();
        for ($i = 1; $i <= $total_scq_7; $i++) {
            $right_choices_scq_7[$data['scq_7'][$i - 1]] = $this->ToeicModel->get_sc_reading($data['scq_7'][$i - 1]);
            $user_choices_scq_7[$data['scq_7'][$i - 1]] = $data['scq_user_choice_7'][$i - 1] != "" ? $data['scq_user_choice_7'][$i - 1] : 0;
        }
        
        $user_choices = array('scq_part5' => $user_choices_scq_5,'scq_part6' => $user_choices_scq_6,'scq_part7' => $user_choices_scq_7);
        $right_choices = array('scq_part5' => $right_choices_scq_5,'scq_part6' => $right_choices_scq_6,'scq_part7' => $right_choices_scq_7);
        $all_data = serialize(array('user_choices' => $user_choices, 'right_choices' => $right_choices,));

        $rela = $this->TestModel->add_test_relationship($relationship_id, $all_data, 0, 0);
        echo json_encode($rela);
    }
    
      public function actionFinished($id, $part) {
          //print_r();die;
        HelperGlobal::require_login();
        $finish = $this->TestModel->get_test_relationship_toeic($id,$part);
        
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
