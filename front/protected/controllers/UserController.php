<?php

class UserController extends Controller {

    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $viewData;
    private $UserModel;
    private $TransactionModel;
    private $TrackingModel;
    private $TestModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $UserModel UserModel */
        $this->UserModel = new UserModel();

        /* @var $TransactionModel TransactionModel */
        $this->TransactionModel = new TransactionModel();

        /* @var $TrackingModel TrackingModel */
        $this->TrackingModel = new TrackingModel();
        
        /* @var $TestModel TestModel */
        $this->TestModel = new TestModel();
    }

    public function actions() {
        
    }

    public function actionIndex() {
        
    }

    public function actionSignup() {

        if ($_POST)
            $this->do_signup();
        $this->viewData['message'] = $this->message;
        $this->render('signup', $this->viewData);
    }

    private function do_signup() {
        $pattern = '/^[A-Za-z0-9]+(?:[_][A-Za-z0-9]+)*$/';
        $special_char = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
        $email = trim($_POST['email']);
        $pwd1 = trim($_POST['pwd1']);
        $pwd2 = trim($_POST['pwd2']);

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        $is_session = isset($_POST['remember']) ? false : true;

        if ($this->validator->is_empty_string($email))
            $this->message['error'][] = "Email không được để trống.";
        if (!$this->validator->is_email($email))
            $this->message['error'][] = "Email không đúng định dạng.";
        if ($this->UserModel->is_existed_email($email))
            $this->message['error'][] = "Email này đã có rồi.";
        if ($this->validator->is_empty_string($pwd1))
            $this->message['error'][] = "Mật khẩu không được để trống.";
        if (strlen($pwd1) < 6 || strlen($pwd1) > 20)
            $this->message['error'][] = "Mật khẩu ít nhất 6, tối đa 20 ký tự.";
        if ($pwd1 != $pwd2)
            $this->message['error'][] = "Mật khẩu và xác nhận mật khẩu phải giống nhau.";
        if ($this->validator->is_empty_string($firstname))
            $this->message['error'][] = "Họ và tên không được để trống.";
        if (preg_match($special_char, $firstname))
            $this->message['error'][] = "Họ và tên không bao gồm ký tự đặc biệt.";
        if ($this->validator->is_empty_string($lastname))
            $this->message['error'][] = "Họ và tên không được để trống.";
        if (preg_match($special_char, $lastname))
            $this->message['error'][] = "Họ và tên không bao gồm ký tự đặc biệt.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $hasher = new PasswordHash(10, TRUE);
        $password = $hasher->HashPassword($pwd1);
        $secret_key = Ultilities::base32UUID();

        $user_id = $this->UserModel->add($email, $password, $secret_key, $firstname, $lastname);
        HelperApp::add_cookie('secret_key', $secret_key, $is_session);
        $this->redirect(Yii::app()->request->baseUrl . "/home/");
    }

    public function actionSignin() {
        if ($_POST)
            $this->do_signin();
        $this->viewData['message'] = $this->message;

        $this->render('signin', $this->viewData);
    }

    private function do_signin() {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $is_session = isset($_POST['remember']) ? false : true;
        if ($this->validator->is_empty_string($email))
            $this->message['error'][] = "Email không được để trống.";
        if (!$this->validator->is_email($email))
            $this->message['error'][] = "Email không đúng định dạng.";
        if ($this->validator->is_empty_string($password))
            $this->message['error'][] = "Mật khẩu không được để trống.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $user = $this->UserModel->get_by_email($email);
        if (!$user) {
            $this->message['error'][] = "Email hoặc mật khẩu không chính xác.";
            $this->message['success'] = false;
            return false;
        }

        $hasher = new PasswordHash(10, TRUE);
        if (!$hasher->CheckPassword($password, $user['password'])) {
            $this->message['error'][] = "Email hoặc mật khẩu không chính xác.";
            $this->message['success'] = false;
            return false;
        }

        HelperApp::add_cookie('secret_key', $user['secret_key'], $is_session);
        $url = isset($_GET['return']) ? $_GET['return'] : Yii::app()->request->baseUrl . "/home/";
        $this->redirect($url);
    }

    public function actionSignout() {
        UserControl::DoLogout();
        $this->redirect(Yii::app()->request->baseUrl . "/home/");
    }

    public function actionForgot() {

        if ($_POST)
            $this->do_forgot();
        $this->viewData['message'] = $this->message;
        $this->render('forgot-password', $this->viewData);
    }

    private function do_forgot() {
        $email = trim($_POST['email']);
        $user = $this->UserModel->get_by_email($email);
        if ($this->validator->is_empty_string($email))
            $this->message['error'][] = "Email không được để trống";
        if (!$this->validator->is_email($email))
            $this->message['error'][] = "Email không đúng định dạng.";
        if (!$user)
            $this->message['error'][] = "Email này không tồn tại.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $token = Ultilities::base32UUID();
        $date_added = time();
        $date_expired = $date_added + (Yii::app()->getParams()->itemAt('token_time')) * 86400;

        $this->UserModel->add_token($token, $user['id'], 'password', $date_added, $date_expired);
        $msg = "Email đã gửi đến bạn. Vui lòng kiểm tra hộp thư đến (inbox), nếu không có vui lòng kiểm tra hộp thư rác (spam mail).";

        $forgot_url = Yii::app()->request->hostInfo . Yii::app()->request->baseUrl . "/user/reset/t/$token";
        $to = $email;
        $subject = "Yêu cầu lấy lại mật khẩu";
        $message = 'Xin chào <strong>' . $user['fullname'] . '</strong>, <br /><br />
                    Đã có yêu cầu lấy lại mật khẩu tại website VeSuKien.vn. 
                    Nếu đó là bạn, hãy nhấn vào đường dẫn bên dưới để tiếp tục.
                    Nếu không, hãy bỏ qua email này.<br/><br />
                    <a href="' . $forgot_url . '">' . $forgot_url . '</a><br/><br/>
        
                    Nếu bạn có bất kỳ thắc mắc nào, vui lòng liện hệ với chúng tôi theo địa chỉ 
                    email <a href="mailto:info@htmlfivemedia.com">info@htmlfivemedia.com</a> hoặc gọi <strong>08.668.22033</strong> để được tư vấn trực tuyến.<br /><br />
                    
                    Chúc bạn thành công!<br /><br />                    
                    ';

        HelperApp::email($to, $subject, $message);
        $this->redirect(Yii::app()->request->baseUrl . "/user/forgot/?s=1&msg=$msg");
    }

    public function actionReset($t = "") {
        if ($this->validator->is_empty_string($t))
            $this->redirect(Yii::app()->request->baseUrl . "/user/forgot/");

        $token = $this->UserModel->get_token($t);
        if (!$token)
            $this->message['success'] = false;
        if ($_POST)
            $this->do_reset($token);
        $this->viewData['token'] = $token;
        $this->viewData['message'] = $this->message;
        $this->render('reset-password', $this->viewData);
    }

    private function do_reset($token) {
        $pwd1 = trim($_POST['pwd1']);
        $pwd2 = trim($_POST['pwd2']);

        if ($this->validator->is_empty_string($pwd1))
            $this->message['error'][] = "Mật khẩu không được để trống.";
        if (strlen($pwd1) < 6 || strlen($pwd1) > 20)
            $this->message['error'][] = "Mật khẩu ít nhất 6, tối đa 20 ký tự.";
        if ($pwd1 != $pwd2)
            $this->message['error'][] = "Mật khẩu và xác nhận mật khẩu phải giống nhau.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }
        $haser = new PasswordHash(10, true);
        $password = $haser->HashPassword($pwd1);

        $this->UserModel->update_token($token['id']);
        $this->UserModel->update(array('password' => $password, 'id' => $token['user_id']));
        $this->redirect(Yii::app()->request->baseUrl . "/user/signin/");
    }

    public function actionProfile() {
        $this->render('profile');
    }

    public function actionTransaction($type = "all", $p = 1) {
        HelperGlobal::require_login();
        $this->layout = "search_test";
        $ppp = Yii::app()->params['ppp'];
        if ($type == "all") {
            $transactions = $this->TransactionModel->gets(array('user_id' => UserControl::getId()), $p, $ppp);
            $total = $this->TransactionModel->counts(array('user_id' => UserControl::getId()));
        } else if ($type == "card") {
            $transactions = $this->TransactionModel->get_by_cards(array('user_id' => UserControl::getId()), $p, $ppp);
            $total = $this->TransactionModel->count_by_cards(array('user_id' => UserControl::getId()));
        } else if ($type == "coupon") {
            $transactions = $this->TransactionModel->get_by_coupons(array('user_id' => UserControl::getId()), $p, $ppp);
            $total = $this->TransactionModel->count_by_coupons(array('user_id' => UserControl::getId()));
        } else if ($type == "paypal") {
            $transactions = $this->TrackingModel->get_paypals(array('user_id' => UserControl::getId()), $p, $ppp);
            $total = $this->TrackingModel->count_paypals(array('user_id' => UserControl::getId()));
        }

        $this->viewData['transactions'] = $transactions;
        $this->viewData['total'] = $total;
        $this->viewData['type'] = $type;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/user/transaction/type/$type/p/", $total, $p) : "";
        $this->render("transaction", $this->viewData);
    }

    public function actionPassword() {
        HelperGlobal::require_login();
        if ($_POST)
            $this->do_password();
        $this->layout = "search_test";
        $this->viewData['message'] = $this->message;
        $this->render('password', $this->viewData);
    }

    private function do_password() {
        $oldpwd = trim($_POST['oldpwd']);
        $pwd1 = trim($_POST['pwd1']);
        $pwd2 = trim($_POST['pwd2']);
        $hasher = new PasswordHash(10, TRUE);
        if ($this->validator->is_empty_string($oldpwd))
            $this->message['error'][] = "Mật khẩu cũ không được để trống.";
        if (!$hasher->CheckPassword($oldpwd, UserControl::getPassword()))
            $this->message['error'][] = "Mật khẩu cũ không chính xác.";
        if ($this->validator->is_empty_string($pwd1))
            $this->message['error'][] = "Mật khẩu mới không được để trống.";
        if (strlen($pwd1) < 6 || strlen($pwd1) > 20)
            $this->message['error'][] = "Mật khẩu mới từ 6-20 ký tự.";
        if ($pwd1 != $pwd2)
            $this->message['error'][] = "Mật khẩu mới và xác nhận mật khẩu phải giống nhau.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $newpwd = $hasher->HashPassword($pwd1);
        $this->UserModel->update(array('password' => $newpwd, 'id' => UserControl::getId()));
        $this->redirect(Yii::app()->request->baseUrl . "/user/password/?s=1");
    }

    public function actionSetting() {
        HelperGlobal::require_login();
        if ($_POST)
            $this->do_setting();
        $this->layout = "search_test";
        $this->viewData['message'] = $this->message;
        $this->render('setting', $this->viewData);
    }

    private function do_setting() {
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);

        if ($this->validator->is_empty_string($lastname))
            $this->message['error'][] = "Họ không được để trống.";

        if ($this->validator->is_valid(Yii::app()->params['speacial_char'], $lastname))
            $this->message['error'][] = "Họ không bao gồm ký tự đặc biệt.";

        if ($this->validator->is_empty_string($firstname))
            $this->message['error'][] = "Tên không được để trống.";

        if ($this->validator->is_valid(Yii::app()->params['speacial_char'], $firstname))
            $this->message['error'][] = "Tên không bao gồm ký tự đặc biệt.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $this->UserModel->update(array('firstname' => $firstname, 'lastname' => $lastname, 'id' => UserControl::getId()));
        $this->redirect(Yii::app()->request->baseUrl . "/user/setting/?s=1");
    }

    public function actionAvatar() {
        HelperGlobal::require_login();
        $file = isset($_FILES['avatar']) ? $_FILES['avatar'] : null;
        if (!$file || trim($file['name']) == "")
            $this->redirect(Yii::app()->request->baseUrl . "/user/setting/");

        if ($this->validator->is_empty_string($file['name']))
            $this->message['error'][] = "Hình ảnh không được rỗng.";

        if (!$this->validator->check_min_image_size(150, 150, $file['tmp_name']) || !$this->validator->is_valid_image($file, 1048576))
            $this->message['error'][] = "Ảnh đại diện có kích thước tối thiểu 150x150 pixel, size tối đa 1MB";

        if (count($this->message['error']) > 0)
            $this->redirect(Yii::app()->request->baseUrl . "/user/setting/");

        $img_info = HelperApp::resize_images($file, HelperApp::get_avatar_sizes());

        $this->UserModel->update(array('id' => UserControl::getId(), 'img' => $img_info['img'], 'thumbnail' => $img_info['thumbnail']));
        $this->redirect(Yii::app()->request->baseUrl . "/user/setting/?s=1");
    }

    public function actionTest($type = "created", $p = 1) {
        HelperGlobal::require_login();
        $this->layout = "search_test";
        if ($type == "created")
            $this->created_test($p);
        else if ($type == "done")
            $this->done_test($p);
    }

    private function created_test($p = 1) {
        $ppp = Yii::app()->params['ppp'];
        $args = array('author_id'=>  UserControl::getId());
        $tests = $this->TestModel->gets($args,$p,$ppp);              
        $total = $this->TestModel->counts($args);        
        
        $this->viewData['tests'] = $tests;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl."/user/test/type/created/p/", $total, $p) : "";
        $this->viewData['message'] = $this->message;
        $this->render('created-test',$this->viewData);
    }
    
    private function done_test($p = 1){
        $ppp = Yii::app()->params['ppp'];
        $args = array('user_id'=>  UserControl::getId());
        $tests = $this->TestModel->get_finished_tests($args,$p,$ppp);
        $total = $this->TestModel->count_finished_tests($args);
        
        $this->viewData['tests'] = $tests;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl."/user/test/type/done/p/", $total, $p) : "";
        $this->viewData['message'] = $this->message;
        $this->render('done-test',$this->viewData);
    }

}