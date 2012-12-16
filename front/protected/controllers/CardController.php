<?php

class CardController extends Controller {

    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $viewData;
    private $CardModel;
    private $TransactionModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $CardModel CardModel */
        $this->CardModel = new CardModel();

        /* @var $TransactionModel TransactionModel */
        $this->TransactionModel = new TransactionModel();
    }

    public function actions() {
        
    }

    public function actionAdd() {
        HelperGlobal::require_login();

        if(!HelperApp::check_timeout('pay_card', 15))
            $this->message['error'][] = "Bạn nạp card quá nhanh. Vui lòng đợi thêm 15 giây.";
        
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            echo json_encode(array('message' => $this->message));
            die;
        }
        
        $code = isset($_POST['code']) ? $_POST['code'] : "";
        if ($this->validator->is_empty_string($code))
            $this->message['error'][] = "Mã thẻ cào không được rỗng.";
        if (strlen($code) != 9)
            $this->message['error'][] = "Mã thẻ cào dài 9 chữ số.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            echo json_encode(array('message' => $this->message));
            die;
        }

        $card = $this->CardModel->get_by_title($code);
        if (!$card)
            $this->message['error'][] = "Mã thẻ cào không tồn tại hoặc đã được sử dụng.";

        if ($card && $card['date_expired'] < time())
            $this->message['error'][] = "Mã thẻ cào này đã hết hạn sử dụng.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            echo json_encode(array('message' => $this->message));
            die;
        }

        $this->TransactionModel->add('card', $card['id'], UserControl::getId(), $card['amount'], Helper::_trans_des('card'));
        $this->CardModel->update(array('user_id' => UserControl::getId(), 'is_used' => 1, 'last_modified' => time(), 'id' => $card['id']));
        $amount = $this->TransactionModel->get_user_amount(UserControl::getId());
        $this->message['error'][] = "Bạn đã nạp thẻ cào thành công.<br/>
                                     Tài khoản của bạn hiện nay có <span class='label label-info'>".  number_format($amount)."đ</span><br/>
                                     Bấm vào <a href='".Yii::app()->request->baseUrl."/user/transaction/'>đây</a> để xem lịch sử giao dịch của bạn";
        echo json_encode(array('message'=>$this->message,'data'=>array('user_amount'=>$amount)));
    }

}