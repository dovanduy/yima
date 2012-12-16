<?php

class ReadingSCQController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $ReadingSCQModel;

    public function init() {
        $this->validator = new FormValidator();
        $this->ReadingSCQModel = new ReadingSCQModel();
    }

    public function actionIndex($p = 1) {
        $rid = $_GET['rid'];
        $part = $_GET['part'];
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $readingscq = $this->ReadingSCQModel->get_by_reading($args, $p, $ppp, $rid);
        $total = $this->ReadingSCQModel->counts_by_reading($args, $rid);

        $this->viewData['readingscq'] = $readingscq;
        $this->viewData['total'] = $total;
        $this->viewData['rid'] = $rid;
        $this->viewData['part'] = $part;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/readingSCQ/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $part = $_GET['part'];
        $readingSCQ = $this->ReadingSCQModel->get($id);
        if (!$readingSCQ)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($readingSCQ, $part);

        $this->viewData['message'] = $this->message;
        $this->viewData['readingSCQ'] = $readingSCQ;
        $this->viewData['part'] = $part;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($readingSCQ, $part) {
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
            $this->message['error'][] = "Please select a right choice.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        $this->ReadingSCQModel->update(array('title' => $title, 'content' => $content, 'choice1' => $choice1, 'choice2' => $choice2, 'choice3' => $choice3, 'choice4' => $choice4,
            'answer' => $choice, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $readingSCQ['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $readingSCQ, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/readingSCQ/edit/id/$readingSCQ[id]/?part=$part&s=1");
    }

    public function actionAdd($rid, $part) {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add($rid, $part);
        $this->viewData['message'] = $this->message;
        $this->viewData['part'] = $part;
        $this->viewData['rid'] = $rid;
        $this->render('add', $this->viewData);
    }

    private function do_add($rid, $part) {
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
            $this->message['error'][] = "Please select a right choice.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        $author = UserControl::getId();
        $readingSCQ_id = $this->ReadingSCQModel->add($rid, $title, $choice1, $choice2, $choice3, $choice4, $content, $choice, $author, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/readingSCQ/edit/id/$readingSCQ_id/?part=$part&s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $speaking = $this->ReadingSCQModel->get($id);
        if (!$speaking)
            return;

        $this->ReadingSCQModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

}

?>
