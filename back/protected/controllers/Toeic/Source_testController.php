<?php

class Source_testController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $Source_testModel;
    private $ReadingModel;
    private $ListeningModel;
    private $OrganizationModel;
    private $UserModel;

    public function init() {
        /* @var $this Source_testController */
        $this->validator = new FormValidator();
        /* @var $this Source_testController */
        $this->Source_testModel = new Toeic_Source_TestModel();
        /* @var $this Source_testController */
        $this->ReadingModel = new Toeic_ReadingModel();
        /* @var $this Source_testController */
        $this->ListeningModel = new Toeic_ListeningModel();
        /* @var $this Source_testController */
        $this->OrganizationModel = new OrganizationModel();
        /* @var $this Source_testController */
        $this->UserModel = new UserModel();
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $source_tests = $this->Source_testModel->gets($args, $p, $ppp);
        $total = $this->Source_testModel->counts($args);

        $this->viewData['source_tests'] = $source_tests;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toeic/source_test/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();

        $agrs = null;
        $source_test = $this->Source_testModel->get($id);
        $readings = $this->ReadingModel->get_all();
        $listenings = $this->ListeningModel->get_all();
        $users = $this->UserModel->get_all();
        $organizations = $this->OrganizationModel->get_all($agrs);
        if (!$source_test)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($source_test);
        //print_r($source_test); die;
        $this->viewData['readings'] = $readings;
        $this->viewData['listenings'] = $listenings;
        $this->viewData['users'] = $users;
        $this->viewData['organizations'] = $organizations;
        $this->viewData['source_test'] = $source_test;
        $this->viewData['message'] = $this->message;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($source_test) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $organization = $_POST['organization'];
        $reading = $_POST['reading'];
        $listening = $_POST['listening'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";
        if ($reading == 0)
            $this->message['error'][] = "Reading cannot be empty.";
        if ($listening == 0)
            $this->message['error'][] = "Listening cannot be empty.";
        if ($author == 0 && $organization == 0)
            $this->message['error'][] = "Author or Organization cannot be empty.";
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $this->Source_testModel->update(array('title' => $title, 'reading' => $reading, 'listening' => $listening,
            'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $source_test['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $source_test, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toeic/source_test/edit/id/$source_test[id]/?s=1");
    }

    public function actionAdd() {

        $this->CheckPermission();
        $agrs = null;

        $readings = $this->ReadingModel->get_all();
        $listenings = $this->ListeningModel->get_all();
        $users = $this->UserModel->get_all();   
        $organizations = $this->OrganizationModel->get_all($agrs);
        if ($_POST)
            $this->do_add();

        $this->viewData['readings'] = $readings;
        $this->viewData['listenings'] =  $listenings ;
        $this->viewData['users'] = $users;
        $this->viewData['organizations'] = $organizations;
        $this->viewData['message'] = $this->message;
        $this->render('add', $this->viewData);
    }

    private function do_add() {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $organization = $_POST['organization'];
        $reading = $_POST['reading'];
        $listening = $_POST['listening'];
        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";
        if ($reading == 0)
            $this->message['error'][] = "Reading cannot be empty.";
        if ($listening == 0)
            $this->message['error'][] = "Listening cannot be empty.";
        if ($author == 0 && $organization == 0)
            $this->message['error'][] = "Author or Organization cannot be empty.";
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }
        $level = 1;
        $source_test_id = $this->Source_testModel->add($title, $level, $author, $organization, $listening, $reading,  time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toeic/source_test/edit/id/$source_test_id/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $source_test = $this->Source_testModel->get($id);
        if (!$source_test)
            return;

        $this->Source_testModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

}

?>
