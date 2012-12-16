<?php

class ReadingController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $ReadingModel;

    public function init() {
        /* @var $this ListeningController */
        $this->validator = new FormValidator();
        /* @var $this ListeningController */
        $this->ReadingModel = new Toeic_ReadingModel();
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0);
        $readings = $this->ReadingModel->gets($args, $p, $ppp);
        $total_reading = $this->ReadingModel->counts($args);

        $this->viewData['readings'] = $readings;
        $this->viewData['total'] = $total_reading;
        $this->viewData['paging'] = $total_reading > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toeic/reading/index/p/", $total_reading, $p) : "";
        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $reading = $this->ReadingModel->get($id);
        if (!$reading) {
            $this->layout = "404";
            return;
        }
        if ($_POST)
            $this->do_edit($reading);
        $this->viewData['message'] = $this->message;
        $this->viewData['reading'] = $reading;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($reading) {
        $title = trim($_POST['title']);
        $keyword = trim($_POST['keyword']);
        $source = trim($_POST['source']);

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty";
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $slug = Helper::create_slug($title);
        $this->ReadingModel->update(array('title' => $title, 'slug' => $slug, 'keyword' => $keyword, 'source' => $source, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $reading['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $reading, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toeic/reading/edit/id/$reading[id]/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();

        $reading = $this->ReadingModel->get($id);
        if (!$reading)
            return;

        $this->ReadingModel->update(array('deleted' => 1, 'id' => $id));
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
        $keyword = trim($_POST['keyword']);
        $source = trim($_POST['source']);

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Name of reading test cannot be empty.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $slug = Helper::create_slug($title);
        $reading_id = $this->ReadingModel->add($title, $slug, $keyword, $source, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toeic/reading/edit/id/$reading_id/?s=1");
    }

}

?>
