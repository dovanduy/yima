<?php

class PaypalController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $TrackingModel;
    private $PaypalModel;

    public function init() {

        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $TrackingModel TrackingModel */
        $this->TrackingModel = new TrackingModel();
        
        /* @var $PaypalModel PaypalModel */
        $this->PaypalModel = new PaypalModel();
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
        Yii::app()->params['page'] = "paypal";

        $paypals = $this->PaypalModel->gets($args, $p, $ppp);
        $total = $this->PaypalModel->counts($args);

        $this->viewData['paypals'] = $paypals;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/paypal/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

}