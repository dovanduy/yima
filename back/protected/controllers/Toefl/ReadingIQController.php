<?php

class ReadingIQController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $ReadingIQModel;
    private $ReadingModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();
        $this->ReadingIQModel = new ReadingIQModel();
        $this->ReadingModel = new ReadingModel();
    }

    public function actionIndex($p = 1) {
        $rid = $_GET['rid'];
        $part = $_GET['part'];
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $readingiq = $this->ReadingIQModel->get_by_reading($args, $p, $ppp, $rid);
        $total = $this->ReadingIQModel->counts_by_reading($args, $rid);

        $this->viewData['readingiq'] = $readingiq;
        $this->viewData['total'] = $total;
        $this->viewData['rid'] = $rid;
        $this->viewData['part'] = $part;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/readingIQ/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $part = $_GET['part'];
        $rid = $_GET['rid'];
        $readingIQ = $this->ReadingIQModel->get($id);
        if (!$readingIQ)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($readingIQ, $part);

        $this->viewData['message'] = $this->message;
        $this->viewData['readingIQ'] = $readingIQ;
        $this->viewData['part'] = $part;
        $this->viewData['rid'] = $rid;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($readingiq, $part) {
        $title = $_POST['title'];
        $answer = $_POST['choice'];
        $content = $_POST['content'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Question cannot be empty.";

        if ($this->validator->is_empty_string($content))
            $this->message['error'][] = "Reading Text cannot be empty.";

        if ($answer == "")
            $this->message['error'][] = "Please choose a right position.";


        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        $this->ReadingIQModel->update(array('title' => $title, 'content' => $content, 'answer' => $answer,
            'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $readingiq['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $readingiq, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/readingIQ/edit/id/$readingiq[id]/?part=$part&s=1");
    }

    public function actionAdd($rid, $part) {

        $this->CheckPermission();
        $reading = $this->ReadingModel->get($rid);
        $this->viewData['reading'] = $reading;
        if ($_POST)
            $this->do_add($rid, $part);
        $this->viewData['message'] = $this->message;
        $this->viewData['part'] = $part;
        $this->viewData['rid'] = $rid;
        $this->render('add', $this->viewData);
    }

    private function do_add($rid, $part) {
        $title = $_POST['title'];
        $answer = $_POST['choice'];
        $content = $_POST['content'];
       

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Question cannot be empty.";

        if ($this->validator->is_empty_string($content))
            $this->message['error'][] = "Reading Text cannot be empty.";

        if ($answer == "")
            $this->message['error'][] = "Please choose a right position.";
        
        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        $author = UserControl::getId();
        $readingIQ_id = $this->ReadingIQModel->add($rid, $title, $content, $answer, $author, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/readingIQ/edit/id/$readingIQ_id/?rid=$rid&part=$part&s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $speaking = $this->ReadingIQModel->get($id);
        if (!$speaking)
            return;

        $this->ReadingIQModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

}

?>
