<?php

class ReadingMCQController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $ReadingMCQModel;

    public function init() {
        $this->validator = new FormValidator();
        $this->ReadingMCQModel = new ReadingMCQModel();
    }

    public function actionIndex($p = 1) {
        $rid = $_GET['rid'];
        $part= $_GET['part'];
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $readingmcq = $this->ReadingMCQModel->get_by_reading($args, $p, $ppp, $rid);
        $total = $this->ReadingMCQModel->counts_by_reading($args, $rid);

        $this->viewData['readingmcq'] = $readingmcq;
        $this->viewData['total'] = $total;
        $this->viewData['rid'] = $rid;
        $this->viewData['part'] = $part;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/readingMCQ/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
         $part=$_GET['part'];
        $readingMCQ = $this->ReadingMCQModel->get($id);
        if (!$readingMCQ)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($readingMCQ,$part);

        $this->viewData['message'] = $this->message;
        $this->viewData['readingMCQ'] = $readingMCQ;
        $this->viewData['part'] = $part;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($readingMCQ,$part) {
        $title = $_POST['title'];
        $choice1 = $_POST['choice1'];
        $choice2 = $_POST['choice2'];
        $choice3 = $_POST['choice3'];
        $choice4 = $_POST['choice4'];
        $choice = $_POST['choice'];
        $content = $_POST['content'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Question cannot be empty.";
        if ($this->validator->is_empty_string($choice1))
            $this->message['error'][] = "Choice1 cannot be empty.";
        if ($this->validator->is_empty_string($choice2))
            $this->message['error'][] = "Choice2 cannot be empty.";
        if ($this->validator->is_empty_string($choice3))
            $this->message['error'][] = "Choice3 cannot be empty.";
        if ($this->validator->is_empty_string($choice4))
            $this->message['error'][] = "Choice4 cannot be empty.";
        if ($this->validator->is_empty_string($content))
            $this->message['error'][] = "Reading Text cannot be empty.";
        if ($choice == "")
            $this->message['error'][] = "Chọn câu trả lời đúng";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        $this->ReadingMCQModel->update(array('title' => $title,'content' => $content,'choice1' => $choice1,'choice2' => $choice2,'choice3' => $choice3,'choice4' => $choice4,
            'answer' => $choice,'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $readingMCQ['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $readingMCQ, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/readingMCQ/edit/id/$readingMCQ[id]/?part=$part&s=1");
    }

    public function actionAdd($rid,$part) {
  
        $this->CheckPermission();
        if ($_POST)
            $this->do_add($rid,$part);
        $this->viewData['message'] = $this->message;
        $this->viewData['part'] = $part;
        $this->viewData['rid'] = $rid;
        $this->render('add', $this->viewData);
    }

    private function do_add($rid,$part) {
        $title = $_POST['title'];
        $choice1 = $_POST['choice1'];
        $choice2 = $_POST['choice2'];
        $choice3 = $_POST['choice3'];
        $choice4 = $_POST['choice4'];
        $choice = $_POST['choice'];
        $content = $_POST['content'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Question cannot be empty.";
        if ($this->validator->is_empty_string($choice1))
            $this->message['error'][] = "Choice1 cannot be empty.";
        if ($this->validator->is_empty_string($choice2))
            $this->message['error'][] = "Choice2 cannot be empty.";
        if ($this->validator->is_empty_string($choice3))
            $this->message['error'][] = "Choice3 cannot be empty.";
        if ($this->validator->is_empty_string($choice4))
            $this->message['error'][] = "Choice4 cannot be empty.";
        if ($this->validator->is_empty_string($content))
            $this->message['error'][] = "Reading Text cannot be empty.";
        if ($choice == "")
            $this->message['error'][] = "Please choose a right answer";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        $author = UserControl::getId();
        $readingMCQ_id = $this->ReadingMCQModel->add($rid, $title, $choice1, $choice2, $choice3, $choice4, $content, $choice, $author, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/readingMCQ/edit/id/$readingMCQ_id/?part=$part&s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $speaking = $this->ReadingMCQModel->get($id);
        if (!$speaking)
            return;

        $this->ReadingMCQModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

}

?>
