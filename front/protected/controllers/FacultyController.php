<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class FacultyController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $OrganizationModel;
    private $TestModel;
    private $SubjectModel;
    private $FacultyModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $OrganizationModel OrganizationModel */
        $this->OrganizationModel = new OrganizationModel();

        /* @var $TestModel TestModel */
        $this->TestModel = new TestModel();
        
        /* @var $SubjectModel SubjectModel */
        $this->SubjectModel = new SubjectModel();
        
        /* @var $FacultyModel FacultyModel */
        $this->FacultyModel = new FacultyModel();
    }

    public function actionIndex($id = 0,$oid = 0, $p = 1) {
        $ppp = Yii::app()->params['ppp'];
        $organization = $this->OrganizationModel->get($oid);
        $faculty = $this->FacultyModel->get($id);
        
        if(!$organization ||  !$faculty)
            $this->load_404 ();       
        
        $args = array('organization_id'=>$organization['id'],'faculty_id'=>$faculty['id']);

        $tests = $this->TestModel->gets($args, $p, $ppp);
        $total = $this->TestModel->counts($args);
        
        $this->viewData['tests'] = $tests;        
        $this->viewData['subjects'] = $this->SubjectModel->gets(array('deleted'=>0,'disabled'=>0,'organization_id'=>$organization['id'],'faculty_id'=>$faculty['id']));        
        $this->viewData['organization'] = $organization;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl."/faculty/index/id/$id/oid/$oid/p/", $total, $p) : "";
        $this->viewData['faculty'] = $faculty;
        $this->render('index', $this->viewData);
    }

}