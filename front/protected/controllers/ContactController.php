<?php

class ContactController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;

    public function init() {
        /* @var $this ContactController */
        $this->validator = new FormValidator();
    }

    public function actionIndex() {
        if ($_POST)
            $this->do_contact();
        $this->viewData['message'] = $this->message;
        $this->render('index', $this->viewData);
    }

    public function do_contact() {
        $first_name = trim($_POST['firstname']);
        $last_name = trim($_POST['lastname']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $content = trim($_POST['content']);

        if ($this->validator->is_empty_string($first_name))
            $this->message['error'][] = "Tên không được để trống.";
        if ($this->validator->is_empty_string($last_name))
            $this->message['error'][] = "Họ và tên đệm không được để trống.";
        if ($this->validator->is_empty_string($email))
            $this->message['error'][] = "Email không được để trống.";
        if (!$this->validator->is_empty_string($email) && !$this->validator->is_email($email))
            $this->message['error'][] = "Email không đúng định dạng.";
        if ($this->validator->is_empty_string($phone))
            $this->message['error'][] = "Tên sự kiện không được để trống.";
        if ($this->validator->is_empty_string($content))
            $this->message['error'][] = "Tên sự kiện không được để trống.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }


        $to = 'Lienhe@yima.vn';
        $subject = "Liên hệ";
        $message = 'Ngày: ' . date('Y-m-d') . '<br/>
                    Người liên hệ: ' . $last_name . ' ' . $first_name . '<br/>
                    Email: ' . $email . '<br/><br/>
                    Điện thoại: ' . $phone . '<br/><br/>
                    Nội dung: <br/> <br/>' . $content;

        $header =
                "MIME-Version: 1.0\r\n" .
                "Content-type: text/html; charset=UTF-8\r\n" .
                "From: $email\r\n" .
                "Reply-to: $email" .
                "Date: " . date("r") . "\r\n";
        @mail($to, $subject, $message, $header);
        
        $this->redirect(Yii::app()->request->baseUrl . "/contact/index/?s=1&msg=Quí khách đã liên hệ thành công");
    }

}

?>
