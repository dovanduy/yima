<?php

class OptionController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $SiteOptionModel;

    public function init() {

        /* @var $validator FormValidator */
        $this->validator = new FormValidator();
        
        /* @var $OptionModel SiteOptionModel */
        $this->SiteOptionModel = new SiteOptionModel();
        
    }

    public function actions() {
        
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($p = 1) {

        $this->CheckPermission();        

        $options = $this->SiteOptionModel->gets();
        
        if($_POST)
            $this->do_update($options);
        
        $this->viewData['message'] = $this->message;
        $this->viewData['options'] = $options;        
        $this->render('index', $this->viewData);
    }
    
    private function do_update($options){
        
        foreach($options as $k=>$v)
            $this->SiteOptionModel->update_meta ($v['meta_key'], $_POST[$v['meta_key']]);
        $this->redirect(Yii::app()->request->baseUrl."/option/?s=1");
    }
    
    public function actionAdd(){
        $this->CheckPermission();
        if($_POST)
            $this->do_add();
        $this->viewData['message'] = $this->message;
        $this->render('add',$this->viewData);
    }
    
    private function do_add(){
        $meta_label = trim($_POST['meta_label']);
        $meta_key = trim($_POST['meta_key']);
        $meta_value = trim($_POST['meta_value']);
        if($this->validator->is_empty_string($meta_label))
            $this->message['error'][] = "Meta Label cannot be blank.";
        if($this->validator->is_empty_string($meta_key))
            $this->message['error'][] = "Meta Key cannot be blank.";
        if(SiteOption::hasOption($meta_key))
            $this->message['error'][] = "This meta key has already exist.";
        if($this->validator->is_empty_string($meta_value))
            $this->message['error'][] = "Meta Value cannot be blank.";
        
        if(count($this->message['error']) > 0){
            $this->message['success'] = false;
            return false;
        }
        
        $this->SiteOptionModel->add($meta_key, $meta_value, $_GET['meta_type'], $meta_label);
        $this->redirect(Yii::app()->request->baseUrl."/option/");
    }
    
    public function actionDelete($id = 0){
        $this->SiteOptionModel->delete($id);
    }
    
}