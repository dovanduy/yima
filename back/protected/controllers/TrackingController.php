<?php

class TrackingController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $TrackingModel;

    public function init() {

        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $TrackingModel TrackingModel */
        $this->TrackingModel = new TrackingModel();
    }

    public function actions() {
        
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($p = 1) {

        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);
        Yii::app()->params['page'] = "tracking";

        $trackings = $this->TrackingModel->gets($args, $p, $ppp);
        $total = $this->TrackingModel->counts($args);

        $this->viewData['trackings'] = $trackings;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/tracking/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }
    
    public function actionCard($p = 1){
        
    }

}