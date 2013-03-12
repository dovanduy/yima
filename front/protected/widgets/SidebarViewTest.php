<?php

class SidebarViewTest extends CWidget {
    
    private $OrganizationModel;
    private $TestModel;
    private $viewData;
    private $TransactionModel;
    

    public function init() {
        
        /* @var $OrganizationModel OrganizationModel */
        $this->OrganizationModel = new OrganizationModel();
        
        /* @var $TestModel TestModel */
        $this->TestModel = new TestModel();
        
        /* @var $TransactionModel TransactionModel */
        $this->TransactionModel = new TransactionModel();
    }
    
    public function run(){
        $test = Yii::app()->params['test'];
        
        $faculties = $this->OrganizationModel->get_faculty($test['organization_id']);
        $tests = $this->TestModel->gets(array('subject_id'=>$test['subject_id'],'organization_id'=>$test['organization_id']),1,10);
        $transactions = $this->TransactionModel->gets(array('ref_id'=>$test['id'],'ref_type'=>'buy_nt_test'),1,10);
        $latest_test_users = $this->TestModel->get_latest_user_tests($test['id']);
        
        
        $this->viewData['faculties'] = $faculties;
        $this->viewData['tests'] = $tests;
        $this->viewData['test'] = $test;
        $this->viewData['transactions'] = $transactions;
        $this->viewData['latest_test_users'] = $latest_test_users;
        $this->render('sidebar-view-test',$this->viewData);
    }
}