<?php

class CouponController extends Controller {

    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $viewData;
    private $CouponModel;
    private $TransactionModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();
        
        /* @var $CouponModel CouponModel */
        $this->CouponModel = new CouponModel();
        
        /* @var $TransactionModel TransactionModel */
        $this->TransactionModel = new TransactionModel();
    }

    public function actions() {
        
    }

    public function actionAdd() {
        HelperGlobal::require_login();

        if(!HelperApp::check_timeout('pay_coupon', 15))
            $this->message['error'][] = "Bạn nạp coupon quá nhanh. Vui lòng đợi thêm 15 giây.";
        
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            echo json_encode(array('message' => $this->message));
            die;
        }
        
        $code = isset($_POST['code']) ? $_POST['code'] : "";
        if ($this->validator->is_empty_string($code))
            $this->message['error'][] = "Mã coupon không được rỗng.";
        if (strlen($code) != 9)
            $this->message['error'][] = "Mã coupon dài 9 chữ số.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            echo json_encode(array('message' => $this->message));
            die;
        }

        $coupon = $this->CouponModel->get_by_title($code);
        if (!$coupon)
            $this->message['error'][] = "Mã coupon không tồn tại.";

        if($this->CouponModel->is_used($coupon['id'], UserControl::getId()))
            $this->message['error'][] = "Bạn đã sử dụng mã coupon này rồi.";        
        
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            echo json_encode(array('message' => $this->message));
            die;
        }

        $this->TransactionModel->add('coupon', $coupon['id'], UserControl::getId(), $coupon['amount'], Helper::_trans_des('coupon'));        
        $this->CouponModel->add_coupon_user($coupon['id'], UserControl::getId());
        $amount = $this->TransactionModel->get_user_amount(UserControl::getId());
        $this->message['error'][] = "Bạn đã nạp coupon thành công.<br/>
                                     Tài khoản của bạn hiện nay có <span class='label label-info'>".  number_format($amount)."đ</span><br/>
                                     Bấm vào <a href='".Yii::app()->request->baseUrl."/user/transaction/'>đây</a> để xem lịch sử giao dịch của bạn";
        echo json_encode(array('message'=>$this->message,'data'=>array('user_amount'=>$amount)));
    }

}