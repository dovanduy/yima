<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class OrganizationController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $OrganizationModel;
    private $TestModel;
    private $SubjectModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $OrganizationModel OrganizationModel */
        $this->OrganizationModel = new OrganizationModel();

        /* @var $TestModel TestModel */
        $this->TestModel = new TestModel();
        
        /* @var $SubjectModel SubjectModel */
        $this->SubjectModel = new SubjectModel();
    }

    public function actionIndex($slug, $subject_id = 0, $p = 1) {
        $ppp = Yii::app()->params['ppp'];
        $organization = $this->OrganizationModel->get_by_slug($slug);
        if (!$organization)
            $this->load_404();
        $args = array('organization_id' => $organization['id']);
        $subject = null;
        if ($subject_id > 0) {
            $subject = $this->SubjectModel->get($subject_id);
            
            if(!$subject)
                $this->load_404 ();
            
            $args['subject_id'] = $subject_id;
        }

        $tests = $this->TestModel->gets($args, $p, $ppp);
        $total = $this->TestModel->counts($args);
        $this->viewData['tests'] = $tests;
        $this->viewData['slug'] = $slug;
        $this->viewData['subject'] = $subject;
        $this->viewData['subjects'] = $this->SubjectModel->gets(array('deleted'=>0,'disabled'=>0,'organization_id'=>$organization['id']));
        $this->viewData['organization'] = $organization;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl."/organization/index/slug/$slug/subject_id/$subject_id/p/", $total, $p) : "";
        $this->render('index', $this->viewData);
    }

}