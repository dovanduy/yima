<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TrackingController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $TrackingModel;
    private $PaypalModel;
    private $CardModel;
    public function init() {

        /* @var $validator FormValidator */
        $this->validator = new FormValidator();
        
        /* @var $TrackingModel TrackingModel */
        $this->TrackingModel = new TrackingModel();
        
        /* @var $PaypalModel PaypalModel */
        $this->PaypalModel = new PaypalModel();
        
        /* @var $CardModel CardModel */
        $this->CardModel = new CardModel();
    }
    
    public function actionPaypal(){
        HelperGlobal::require_login();
        
        $cards = isset($_POST['card']) ? $_POST['card'] : NULL;        
        if(!$cards)
            return;
        // validate
        $card_types = HelperGlobal::get_card_types();
        $_types = array();
        $card_ids = array();
        foreach($card_types as $k=>$v)
        {
            $card_ids[] = $v['id'];
            $_types[$v['id']] = $v['description'];
        }
        
        foreach($cards as $k=>$v)
        {
            if(array_search($k, $card_ids) === false)
                $this->message['error'][] = "Vui lòng chọn đúng loại thẻ";
        }
        
        if(count($cards) != count($card_types))
            $this->message['error'][] = "Số lượng loại thẻ không chính xác.";
        
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            echo json_encode(array('message' => $this->message));
            die;
        }
        
        $count = 0;
        foreach($cards as $k=>$v){
            
            $value = trim($v);
            if($this->validator->is_empty_string($value))
                $count++;
            if(!$this->validator->is_empty_string($value) && !$this->validator->is_integer($value))
                $this->message['error'][] = "Số lượng ".$_types[$k]." phải là số lớn hơn 0.";
        }
        
        if($count == count($card_types))
            $this->message['error'][] = "Vui lòng chọn ít nhất 1 loại thẻ.";
        
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            echo json_encode(array('message' => $this->message));
            die;
        }
        //process tracking and count amount
        
        $amount_vnd = 0;
        $payment_to = Yii::app()->params['business'];
        $currency = "USD";
        $card_ids = array();
        $card_info = array();
        $item_name = "";
        foreach($card_types as $k=>$v){
            if($this->validator->is_empty_string($cards[$v['id']]))
                continue;
            $amount_vnd = $amount_vnd + ($cards[$v['id']] * $v['amount']);
            $card_ids[$v['id']] = $cards[$v['id']];
            $card_info[$v['id']] = $v;
            $item_name.= $v['title'].": ".$cards[$v['id']]." | ";
        }
        
        $total_usd = $amount_vnd / SiteOption::getUsdRate();
        
        $tracking_id = $this->TrackingModel->add('paypal', $payment_to, $currency, UserControl::getId(), $total_usd, $amount_vnd,  serialize($card_info),  serialize($card_ids),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']);
        
        //store necessary information and send to paypal
        $return_url = Yii::app()->request->hostInfo . Yii::app()->request->baseUrl . "/";
        $cancel_url = Yii::app()->request->hostInfo . Yii::app()->request->baseUrl . "/";
        $notify_url = Yii::app()->request->hostInfo . Yii::app()->request->baseUrl . "/tracking/do_paypal/";

        $queryStr = "?business=" . urlencode($payment_to);

        $data = array('item_name' => $item_name,
            'amount' => $total_usd,
            'first_name' => UserControl::getFirstName(),
            'last_name' => UserControl::getLastName(),
            'payer_email' => UserControl::getEmail(),
            'cmd' => '_xclick',
            'no_note' => '1',
            'lc' => 'US',
            'currency_code' => $currency,
            'item_number' => 0,
            'return' => $return_url,
            'cancel_return' => $cancel_url,
            'custom' => $tracking_id,
            'quantity' => 1,
            'notify_url' => $notify_url);
        foreach ($data as $key => $value) {
            $value = urlencode(stripslashes($value));
            $queryStr .= "&$key=$value";
        }

        //$this->redirect('https://www.sandbox.paypal.com/cgi-bin/webscr' . $queryStr);
        echo json_encode(array('message' => $this->message,'data'=>array('link'=>'https://www.sandbox.paypal.com/cgi-bin/webscr' . $queryStr)));
        exit();
    }
    
    public function actionDo_paypay(){
        if (!$_POST)
            return;
        $txn_id = isset($_POST['txn_id']) ? $_POST['txn_id'] : null;
        if (!$txn_id)
            return;

        $data['item_number'] = $_POST['item_number'];
        $data['package_id'] = $_POST['item_number'];
        $data['payment_status'] = $_POST['payment_status'];
        $data['payment_amount'] = $_POST['mc_gross'];
        $data['paypal_fee'] = $_POST['mc_fee'];
        $data['txn_id'] = $_POST['txn_id'];
        $data['custom'] = $_POST['custom'];
        $data['currency'] = $_POST['mc_currency'];
        $payment_to = Yii::app()->params['business'];

        /*
          if ($_POST['test_ipn'] == 1)
          exit();
         * 
         */
        // check that receiver_email is your Primary PayPal email and status must be completed
        if ($_POST['business'] != $payment_to || $data['payment_status'] != "Completed")
            exit();
        //check if has txn_id 
        if ($this->TrackingModel->get_by_txn_id($data['txn_id']))
            exit();

        $tracking = $this->TrackingModel->get($data['custom']);

        // check that payment_amount/payment_currency are correct
        if (!$tracking || $tracking['payment_type'] != "paypal" || $tracking['amount'] != $data['payment_amount'] || $tracking['completed'] == 1 || strtoupper($data['currency']) != $tracking['currency'])
            exit();

        $req = 'cmd=_notify-validate';
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
        $header = '';
        // post back to PayPal system to validate

        $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
        //comment this line if not sandbox
        $header .= "Host: www.sandbox.paypal.com \r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
        $fp = fsockopen('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);


        if (!$fp)
            exit();

        fputs($fp, $header . $req);
        while (!feof($fp)) {

            $res = fgets($fp, 1024);

            if (strcmp($res, "INVALID") == 0) {
                //log for manual investigation
                fclose($fp);
                exit();
            }
            //process payment if all verfified
            //$this->PaypalModel->test($res);
            if (strcmp($res, "VERIFIED") == 0) {
                $paypal_id = $this->PaypalModel->add($data['txn_id'], $tracking['id'], $data['paypal_fee'], serialize($_POST));
                $this->TrackingModel->update(array('ref_id' => $paypal_id, 'txn_id' => $data['txn_id'], 'completed' => 1, 'id' => $tracking['id']));
                $this->generate_cards($tracking);
            }
        }
        fclose($fp);
        exit();
    }
    
    public function actionTest(){
        
        $tracking = $this->TrackingModel->get(5);
        $this->generate_cards($tracking);
    }
    
    private function generate_cards($tracking){
        $ids = unserialize($tracking['card_ids']);
        $info = unserialize($tracking['card_info']);
        
        foreach($ids as $k=>$v){
            
            for($i = 0;$i < $v;$i++){                
                $card_id = $this->CardModel->add($k, Ultilities::base32UUID(), time() + 63072000, $info[$k]['amount'],1);
                $this->TrackingModel->add_tracking_card($tracking['id'], $card_id, $tracking['user_id']);
            }
        }
    }
    
    public function actionUpdate_price(){
        HelperGlobal::require_login();
        
        $cards = isset($_POST['card']) ? $_POST['card'] : NULL;        
        if(!$cards)
            return;
        $vnd = 0;
        $usd = 0;
        $card_types = HelperGlobal::get_card_types();
        foreach($card_types as $k=>$v){
            if($this->validator->is_empty_string($cards[$v['id']]))
                continue;
            if(!$this->validator->is_empty_string($cards[$v['id']]) && !$this->validator->is_integer($cards[$v['id']]))
                continue;
            $vnd+= $cards[$v['id']] * $v['amount'];
        }
        
        $usd = $vnd / SiteOption::getUsdRate();
        echo json_encode(array('vnd'=>  number_format($vnd)." VNĐ",'usd'=>"$".  number_format($usd, 2)));
    }
}