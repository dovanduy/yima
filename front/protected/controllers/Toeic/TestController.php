<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TestController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $Source_testModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $Course_testModel Course_testModel */
        $this->Source_testModel = new Toeic_Source_TestModel();
    }

    public function actionIndex($p = 1) {
        $args = '';
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $tests = $this->Source_testModel->gets($args);
        $total = $this->Source_testModel->counts($args);

        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toeic/test/index/p/", $total, $p) : "";
        $this->viewData['tests'] = $tests;
        $this->viewData['total'] = $total;

        $this->render('index', $this->viewData);
    }

}

?>
