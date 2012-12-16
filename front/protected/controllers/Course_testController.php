<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Course_testController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $Course_testModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $Course_testModel Course_testModel */
        $this->Course_testModel = new Course_testModel();
    }

    public function actionIndex($p = 1) {
        $args ='';
     
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $course = $this->Course_testModel->get_toefl_course($args, $p, $ppp);
        $total = $this->Course_testModel->get_toefl_counts();
        
        
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/course_test/index/p/", $total, $p) : "";
        $this->viewData['course'] = $course;
        $this->viewData['total'] = $total;

        $this->render('index', $this->viewData);
    }

}

?>
