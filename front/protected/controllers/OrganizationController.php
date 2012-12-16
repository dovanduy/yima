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

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $OrganizationModel OrganizationModel */
        $this->OrganizationModel = new OrganizationModel();
    }

    public function actionIndex($slug, $subject_id = 0) {

        $organization = $this->OrganizationModel->get_by_slug($slug);
        $subject = $this->OrganizationModel->get_test_nt_by_organization($organization['id']);

        
        if ($subject_id > 0) {
            $question = $this->OrganizationModel->get_question($subject_id, $organization['id']);
        } else 
            {
            $question = $this->OrganizationModel->get_question_all($organization['id']);
        }

        $this->viewData['question'] = $question;
        $this->viewData['slug'] = $slug;
        $this->viewData['subject'] = $subject;
        $this->viewData['organization'] = $organization;
        $this->render('index', $this->viewData);
    }

}

?>
