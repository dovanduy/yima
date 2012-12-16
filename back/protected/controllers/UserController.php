<?php

class UserController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $UserModel;
    private $TransactionModel;
    private $CardModel;
    private $CouponModel;
    private $PostModel;
    private $TestNTModel;

    public function init() {

        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $UserModel UserModel */
        $this->UserModel = new UserModel();

        /* @var $TransactionModel TransactionModel */
        $this->TransactionModel = new TransactionModel();

        /* @var $CardModel CardModel */
        $this->CardModel = new CardModel();

        /* @var $CouponModel CouponModel */
        $this->CouponModel = new CouponModel();

        /* @var $PostModel PostModel */
        $this->PostModel = new PostModel();

        /* @var $TestModel TestModel */
        $this->TestNTModel = new TestNTModel();
    }

    public function actionIndex($p = 1) {

        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);
        $users = $this->UserModel->gets($args, $p, $ppp);
        $total_user = $this->UserModel->counts($args);

        $this->viewData['users'] = $users;
        $this->viewData['total'] = $total_user;
        $this->viewData['paging'] = $total_user > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/user/index/p/", $total_user, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionOverview($id = 0) {
        $this->CheckPermission();
        $user = $this->UserModel->get($id);
        if (!$user)
            $this->load_404();

        $this->viewData['user'] = $user;
        $this->viewData['transactions'] = $this->TransactionModel->gets(array('user_id' => $user['id']), 1, 5);
        $this->viewData['total_transaction'] = $this->TransactionModel->counts(array('user_id' => $user['id']));
        $this->viewData['cards'] = $this->CardModel->gets(array('user_id' => $user['id']), 1, 5);
        $this->viewData['total_card'] = $this->CardModel->counts(array('user_id' => $user['id']), 1, 5);
        $this->viewData['coupons'] = $this->CouponModel->get_by_user(array('user_id' => $user['id']), 1, 5);
        $this->viewData['total_coupon'] = $this->CouponModel->count_by_user(array('user_id' => $user['id']));
        $this->viewData['posts'] = $this->PostModel->gets(array('author_id' => $user['id'], 'deleted' => 0), 1, 5);
        $this->viewData['total_post'] = $this->PostModel->counts(array('author_id' => $user['id'], 'deleted' => 0));
        $this->viewData['tests'] = $this->TestNTModel->gets(array('deleted' => 0, 'author_id' => $user['id']), 1, 5);
        $this->viewData['total_test'] = $this->TestNTModel->counts(array('deleted' => 0, 'author_id' => $user['id']));
        $this->viewData['finish_tests'] = $this->TestNTModel->get_finished_tests(array('user_id'=>$user['id']), 1, 5);
        $this->viewData['total_finish_test'] = $this->TestNTModel->count_finished_tests(array('user_id'=>$user['id']));

        $this->render('overview', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $user = $this->UserModel->get($id);
        if (!$user)
            $this->load_404();
        if ($_POST)
            $this->do_edit($user);

        $this->viewData['message'] = $this->message;
        $this->viewData['user'] = $user;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($user) {
        $title = trim($_POST['title']);
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $email = trim($_POST['email']);
        $role = trim($_POST['role']);
        $file = $_FILES['file'];
        //   $password = trim($_POST['password']);
        //  $confirm_password = trim($_POST['confirm_password']);
        // $hasher = new PasswordHash(10, TRUE);

        if ($this->validator->is_empty_string($email))
            $this->message['error'][] = "Email cannot be empty.";
        if (!$this->validator->is_email($email))
            $this->message['error'][] = "Email is invalid.";
        if ($this->UserModel->email_existed($email) && $email != $user['email'])
            $this->message['error'][] = "This Email is existed.";
        if ($role == 'none')
            $this->message['error'][] = "Role of User cannot be empty.";
        if (!$this->validator->is_empty_string($file['name']) && !$this->validator->is_valid_image($file))
            $this->message['error'][] = "This Image's format or size is incorrect.";

        if (!$this->validator->is_empty_string($file['name']) && !$this->validator->check_min_image_size(150, 150, $file['tmp_name']))
            $this->message['error'][] = "This Image's format or size is incorrect.";
        // if ($this->validator->is_empty_string($password))
        // $this->message['error'][] = "Mật khẩu mới cannot be empty.";
        //   if ($password != $confirm_password)
        //    $this->message['error'][] = "Password và Confirm Password không trùng nhau.";


        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $img = $user['img'];
        $thumbnail = $user['thumbnail'];

        if (!$this->validator->is_empty_string($file['name'])) {
            $resize = HelperApp::resize_images($file, HelperApp::get_avatar_sizes());
            $img = $resize['img'];
            $thumbnail = $resize['thumbnail'];
        }

        // $new_password = $hasher->HashPassword($password);
        $this->UserModel->update(array('title' => $title, 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'role' => $role, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'img' => $img, 'thumbnail' => $thumbnail, 'id' => $user['id']));
        unset($user['password']);
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $user, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/user/edit/id/$user[id]/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $user = $this->UserModel->get($id);
        if (!$user)
            return;

        $this->UserModel->update(array('deleted' => 1, 'id' => $id));
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
        $title = trim($_POST['title']);
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $file = $_FILES['file'];
        $email = trim($_POST['email']);
        $role = trim($_POST['role']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
        $hasher = new PasswordHash(10, TRUE);

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Username cannot be empty.";
        if ($this->UserModel->user_existed($title))
            $this->message['error'][] = "This Username is existed.";
        if ($this->validator->is_empty_string($email))
            $this->message['error'][] = "Email cannot be empty.";
        if (!$this->validator->is_email($email))
            $this->message['error'][] = "Email is invalid.";
        if ($this->UserModel->email_existed($email))
            $this->message['error'][] = "This Email is existed.";
        if ($role == 'none')
            $this->message['error'][] = "Role of User cannot be empty.";
        if ($this->validator->is_empty_string($password))
            $this->message['error'][] = "Password cannot be empty.";
        if ($this->validator->is_empty_string($firstname))
            $this->message['error'][] = "First Name cannot be empty.";
        if ($this->validator->is_empty_string($lastname))
            $this->message['error'][] = "Last Name cannot be empty.";
        if ($password != $confirm_password)
            $this->message['error'][] = "Password and Confirm Password is not match.";
        if (!$this->validator->is_empty_string($file['name']) && !$this->validator->is_valid_image($file))
            $this->message['error'][] = "This Image's format or size is incorrect.";
        if (!$this->validator->is_empty_string($file['name']) && !$this->validator->check_min_image_size(300, 300, $file['tmp_name']))
            $this->message['error'][] = "This Image's format or size is incorrect.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        $img = "";
        $thumbnail = "";

        if (!$this->validator->is_empty_string($file['name'])) {
            $resize = HelperApp::resize_images($file, HelperApp::get_category_sizes());
            $img = $resize['img'];
            $thumbnail = $resize['thumbnail'];
        }

        $new_password = $hasher->HashPassword($password);
        $secret_key = Ultilities::base32UUID();
        $user_id = $this->UserModel->add($title, $new_password, $secret_key, $role, $firstname, $lastname, $email, $img, $thumbnail, time());
        unset($_POST['password']);
        unset($_POST['confirm_password']);
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/user/edit/id/$user_id/?s=1");
    }

}

?>
