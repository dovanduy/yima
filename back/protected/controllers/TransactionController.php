<?php

class TransactionController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $TransactionModel;

    public function init() {

        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $TransactionModel TransactionModel */
        $this->TransactionModel = new TransactionModel();
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
        if(isset($_GET['uid']) && $_GET['uid'])
            $args['user_id'] = $_GET['uid'];
        Yii::app()->params['page'] = "transaction";

        $transactions = $this->TransactionModel->gets($args, $p, $ppp);
        $total = $this->TransactionModel->counts($args);

        $this->viewData['transactions'] = $transactions;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/transaction/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

}