<?php

class CouponController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $UserModel;
    private $CouponModel;

    public function init() {
        $this->validator = new FormValidator();

        /* @var $UserModel UserModel */
        $this->UserModel = new UserModel();

        /* @var $CouponModel CouponModel */
        $this->CouponModel = new CouponModel();
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0);
        $coupons = $this->CouponModel->gets($args, $p, $ppp);
        $total = $this->CouponModel->counts($args);

        $this->viewData['coupons'] = $coupons;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/coupon/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }
    
    public function actionUser($id,$p = 1) {
        $this->CheckPermission();
        $user = $this->UserModel->get($id);
        if(!$user)
            $this->load_404 ();
        
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);
        $coupons = $this->CouponModel->get_by_user($args, $p, $ppp);
        $total = $this->CouponModel->count_by_user($args);
        
        $this->viewData['user'] = $user;
        $this->viewData['coupons'] = $coupons;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/coupon/user/id/$id/p/", $total, $p) : "";

        $this->render('user', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $coupon = $this->CouponModel->get($id);
        if (!$coupon)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($coupon);

        $this->viewData['message'] = $this->message;
        $this->viewData['coupon'] = $coupon;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($coupon) {
        $money = trim($_POST['money']);

        if ($this->validator->is_empty_string($money))
            $this->message['error'][] = "Money cannot be blank.";
        if (!$this->validator->is_integer($money))
            $this->message['error'][] = "Money must be a number greater than zero";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $this->CouponModel->update(array('deleted' => $_POST['deleted'], 'amount' => $money, 'last_modified' => time(), 'id' => $coupon['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $coupon, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/coupon/edit/id/$coupon[id]/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();

        $coupon = $this->CouponModel->get($id);
        if (!$coupon)
            return;

        $this->CouponModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function actionAdd() {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add();
        $this->viewData['message'] = $this->message;
        $this->render('add', $this->viewData);
    }

    private function do_add() {
        $money = trim($_POST['money']);

        if ($this->validator->is_empty_string($money))
            $this->message['error'][] = "Money cannot be blank.";
        if (!$this->validator->is_integer($money))
            $this->message['error'][] = "Money must be a number greater than zero";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        $quantity = $this->validator->is_integer($_POST['quantity']) ? trim($_POST['quantity']) : 1;
        for ($i = 0; $i < $quantity; $i++) {
            $coupon_id = $this->CouponModel->add(Ultilities::base32UUID(), $money);
            HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        }
        $this->redirect(Yii::app()->request->baseUrl . "/coupon/");
    }

}