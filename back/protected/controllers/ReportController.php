<?php

class ReportController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $ReportModel;

    public function init() {
        Yii::app()->params['group'] = "4u";
        Yii::app()->params['page'] = "report";

        $this->validator = new FormValidator();
        
        /* @var $ReportModel ReportModel */
        $this->ReportModel = new ReportModel();
    }

    public function actionIndex($type = "post",$p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s,'ref_type'=>$type);
        $reports = $this->ReportModel->gets($args, $p, $ppp);
        $total = $this->ReportModel->counts($args);

        $this->viewData['reports'] = $reports;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/report/index/type/$type/p/", $total, $p) : "";
        $this->viewData['type'] = $type;
        $this->render('index', $this->viewData);
    }


    public function actionDelete($id,$type,$author) {
        $this->CheckPermission();

        $this->ReportModel->remove($id, $type, $author);
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id,'type'=>$type,'author'=>$author)));
    }

}