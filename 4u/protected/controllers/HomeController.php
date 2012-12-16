<?php

class HomeController extends Controller {
    
    public $defaultAction = 'hay';
    private $viewData;
    private $OrganizationModel;
    private $PostModel;

    public function init() {

        /* @var $OrganizationModel OrganizationModel */
        $this->OrganizationModel = new OrganizationModel();
        
        /* @var $PostModel PostModel */
        $this->PostModel = new PostModel();
    }

    public function actions() {
        
    }
    
    public function actionHay($p = 1){
        $ppp = Yii::app()->params['ppp'];
        $args = array('deleted'=>0,'type'=>'hay');
        $posts = $this->PostModel->gets($args,$p,$ppp);
        $total = $this->PostModel->counts($args);
        Yii::app()->params['page'] = 'hay';
        
        $this->viewData['posts'] = $posts;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl."/home/index/p/", $total, $p) : "";
        $this->render('index',$this->viewData);      
    }
    
    public function actionNew($p = 1){
        $ppp = Yii::app()->params['ppp'];
        $args = array('deleted'=>0);
        $posts = $this->PostModel->gets($args,$p,$ppp);
        $total = $this->PostModel->counts($args);
        Yii::app()->params['page'] = 'new';
        
        $this->viewData['posts'] = $posts;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl."/home/index/p/", $total, $p) : "";
        $this->render('index',$this->viewData);      
    }

    public function actionContact_us() {
        $this->render('contact');
    }

    public function actionError404() {
        $this->layout = "404";
        $this->render("error");
    }

}