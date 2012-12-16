<?php

class ReadingController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $ReadingModel;

    public function init() {
        $this->validator = new FormValidator();
        $this->ReadingModel = new ReadingModel();
    }

    public function actionIndex($p = 1) {
        $part = $_GET["part"];
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $readings = $this->ReadingModel->gets($args, $p, $ppp, $part);
        $total = $this->ReadingModel->counts($args, $part);

        $this->viewData['readings'] = $readings;
        $this->viewData['total'] = $total;
        $this->viewData['part'] = $part;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/reading/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $reading = $this->ReadingModel->get($id);
        if (!$reading)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($reading);

        $this->viewData['message'] = $this->message;
        $this->viewData['reading'] = $reading;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($reading) {
        $title = $_POST['title'];
        $level = $_POST['level'];
        $time = $_POST['time'];
        $source = $_POST['source'];
        $keyword = $_POST['keyword'];
        $content = $_POST['content'];


        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }
        $this->ReadingModel->update(array('title' => $title, 'level' => $level, 'test_time' => $time, 'source' => $source, 'keyword' => $keyword, 'content' => $content, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $reading['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $reading, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/reading/edit/id/$reading[id]/?s=1");
    }

    public function actionAdd($part) {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add();
        $this->viewData['message'] = $this->message;
        $this->viewData['part'] = $part;
        $this->render('add', $this->viewData);
    }

    private function do_add() {
        $title = $_POST['title'];
        $level = $_POST['level'];
        $time = $_POST['time'];
        $source = $_POST['source'];
        $keyword = $_POST['keyword'];
        $content = $_POST['content'];
        $part = $_POST['part'];
        
        //echo $part;die;



        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";
        if ($this->validator->is_empty_string($level))
            $this->message['error'][] = "Please choose a level.";
        if ($this->validator->is_empty_string($time))
            $this->message['error'][] = "Test Time cannot be empty.";
        if (!$this->validator->is_integer($time))
            $this->message['error'][] = "Test Time is invalid.";
        if ($this->validator->is_empty_string($source))
            $this->message['error'][] = "Source cannot be empty.";
        if ($this->validator->is_empty_string($keyword))
            $this->message['error'][] = " Source cannot be empty.";
        if ($this->validator->is_empty_string($content))
            $this->message['error'][] = "Reading Text cannot be empty.";
        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        
        $author = UserControl::getId();
        $reading_id = $this->ReadingModel->add($title, $level, $time, $source, $keyword, $content, $part, $author, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/reading/edit/id/$reading_id/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $reading = $this->ReadingModel->get($id);
        if (!$reading)
            return;

        $this->ReadingModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

}

?>
