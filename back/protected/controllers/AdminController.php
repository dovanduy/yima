<?php

class AdminController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $AdminModel;

    public function init() {

        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $AdminModel AdminModel */
        $this->AdminModel = new AdminModel();
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

        $admins = $this->AdminModel->gets($args, $p, $ppp);
        $total = $this->AdminModel->counts($args);

        $this->viewData['admins'] = $admins;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/admin/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionLogout() {

        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thoát'));
        UserControl::DoLogout();
        $this->redirect(Yii::app()->request->baseUrl . "/admin/login/");
    }

    public function actionLogin() {
        if (UserControl::LoggedIn())
            $this->redirect(Yii::app()->request->baseUrl);
        $this->layout = "login";
        if ($_POST)
            $this->do_login();
        $this->viewData['message'] = $this->message;
        $this->render('login', $this->viewData);
    }

    private function do_login() {

        $title = trim($_POST['title']);
        $password = trim($_POST['password']);

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Username is empty.";
        if ($this->validator->is_empty_string($password))
            $this->message['error'][] = "Password is empty.";
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $admin = $this->AdminModel->get_by_title($title);
        if ($admin['deleted'] || $admin['disabled']) {
            $this->message['error'][] = "This account was disabled or deleted.";
            $this->message['success'] = false;
            return false;
        }
        if (!$admin) {
            $this->message['error'][] = "Account or Password is incorect.";
            $this->message['success'] = false;
            return false;
        }

        $hasher = new PasswordHash(10, true);
        if (!$hasher->CheckPassword($password, $admin['password'])) {
            $this->message['error'][] = "Account or Password is incorect.";
            $this->message['success'] = false;
            return false;
        }

        HelperApp::add_cookie('secret_key', $admin['secret_key'], true);
        //HelperApp::add_cookie('secret_key', $admin['secret_key'], false);
        HelperGlobal::add_log($admin['id'], $this->controllerID(), $this->methodID(), array('Hành động' => 'Đăng nhập'));
        $this->redirect(Yii::app()->request->baseUrl . "/home/");
    }

    public function actionPassword() {

        HelperGlobal::require_login();

        if ($_POST)
            $this->do_password();
        $this->viewData['message'] = $this->message;
        $this->render('password', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $admin = $this->AdminModel->get($id);
        if (!$admin)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($admin);

        $this->viewData['message'] = $this->message;
        $this->viewData['admin'] = $admin;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($admin) {
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';
        $new_password = $admin['password'];
        $hasher = new PasswordHash(10, TRUE);

        if (!$this->validator->is_empty_string($password) && $password != $confirm_password)
            $this->message['error'][] = "Password and Repassword are not match.";

        if ($admin['id'] == 1 && ($_POST['disabled'] == 1 || $_POST['deleted'] == 1)) {
            $this->message['error'][] = "Cannot delete or disable this account.";
        }
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        if (!$this->validator->is_empty_string($password)) {
            $new_password = $hasher->HashPassword($password);
        }

        $this->AdminModel->update(array('password' => $new_password, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $admin['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Đổi mật khẩu'));
        $this->redirect(Yii::app()->request->baseUrl . "/admin/edit/id/$admin[id]/?s=1");
    }

    private function do_password() {
        $oldpwd = trim($_POST['oldpwd']);
        $newpwd1 = trim($_POST['newpwd1']);
        $newpwd2 = trim($_POST['newpwd2']);

        $hasher = new PasswordHash(10, TRUE);

        if ($this->validator->is_empty_string($oldpwd))
            $this->message['error'][] = "Old Password cannot be empty.";
        if (!$hasher->CheckPassword($oldpwd, UserControl::getPassword()))
            $this->message['error'][] = "Old Password  is invalid.";
        if ($this->validator->is_empty_string($newpwd1))
            $this->message['error'][] = "Old Password  cannot be empty.";
        if ($newpwd1 != $newpwd2)
            $this->message['error'][] = "Password and Repassword are not match.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $password = $hasher->HashPassword($newpwd1);
        $this->AdminModel->update(array('password' => $password, 'id' => UserControl::getId()));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Đổi mật khẩu'));
        $this->redirect(Yii::app()->request->baseUrl . "/admin/password/?s=1");
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
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
        $role = trim($_POST['role']);
        $hasher = new PasswordHash(10, TRUE);

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Username cannot be empty.";
        if ($this->AdminModel->admin_existed($title))
            $this->message['error'][] = "Admin này đã tồn tại.";
        if ($this->validator->is_empty_string($password))
            $this->message['error'][] = "Password cannot be empty.";
        if ($password != $confirm_password)
            $this->message['error'][] = "Password and Repassword are not match.";
        if ($role == 'none')
            $this->message['error'][] = "Role cannot be empty.";
        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $new_password = $hasher->HashPassword($password);
        $secret_key = Ultilities::base32UUID();
        $admin_id = $this->AdminModel->add($title, $new_password, $secret_key, $role, time());
        unset($_POST['password']);
        unset($_POST['confirm_password']);
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/admin/edit/id/$admin_id/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $admin = $this->AdminModel->get($id);

        if ($id == 1) {
            return;
        }
        if (!$admin)
            return;

        $this->AdminModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id, 'title' => $admin['title'])));
    }

}