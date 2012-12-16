<?php

class Reading_Part6Controller extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $Reading_Part6Model;
    private $ReadingModel;

    public function init() {
        /* @var $this ListeningController */
        $this->validator = new FormValidator();
        /* @var $this ListeningController */
        $this->Reading_Part6Model = new Toeic_Reading_Part6_Model();
        /* @var $this Reading_Part6Controller */
        $this->ReadingModel = new Toeic_ReadingModel();
    }

    public function actionIndex($rid, $p = 1) {
        $this->CheckPermission();
        $reading_id = $rid;

        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'rid' => $reading_id, 'deleted' => 0);

        $reading_part6 = $this->Reading_Part6Model->gets($args, $p, $ppp);
        $total_reading_part6 = $this->Reading_Part6Model->counts($args);
        $reading = $this->ReadingModel->get($reading_id);

        $this->viewData['reading_part6'] = $reading_part6;
        $this->viewData['total'] = $total_reading_part6;
        $this->viewData['reading'] = $reading;
        $this->viewData['paging'] = $total_reading_part6 > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toeic/reading_part6/index/rid/" . $reading_id . "/p/", $total_reading_part6, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($rid, $id = 0) {
        $this->CheckPermission();
        $reading_part6 = $this->Reading_Part6Model->get($id);
        if (!$reading_part6) {
            $this->layout = "404";
            return;
        }
        $reading_id = $rid;
        $reading = $this->ReadingModel->get($reading_id);
        if ($_POST)
            $this->do_edit($reading_id, $reading_part6);
        $this->viewData['message'] = $this->message;
        $this->viewData['reading_part6'] = $reading_part6;
        $this->viewData['reading'] = $reading;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($reading_id, $reading_part6) {
        $question = trim($_POST['question']);
        $choice1 = trim($_POST['choice1']);
        $choice2 = trim($_POST['choice2']);
        $choice3 = trim($_POST['choice3']);
        $choice4 = trim($_POST['choice4']);
        $answer = $_POST['answer'];

        if ($this->validator->is_empty_string($question))
            $this->message['error'][] = "Question cannot be empty";
        if ($this->validator->is_empty_string($choice1))
            $this->message['error'][] = "Choice 1 cannot be empty";
        if ($this->validator->is_empty_string($choice2))
            $this->message['error'][] = "Choice 2 cannot be empty";
        if ($this->validator->is_empty_string($choice3))
            $this->message['error'][] = "Choice 3 cannot be empty";
        if ($this->validator->is_empty_string($choice4))
            $this->message['error'][] = "Choice 4 cannot be empty";
        if ($this->validator->is_empty_string($answer))
            $this->message['error'][] = "Answer cannot be empty";
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $this->Reading_Part6Model->update(array('question' => $question, 'choice1' => $choice1, 'choice2' => $choice2, 'choice3' => $choice3, 'choice4' => $choice4, 'answer' => $answer, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $reading_part6['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $reading_part6, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toeic/reading_part6/edit/rid/" . $reading_id . "/id/$reading_part6[id]/?s=1");
    }

    public function actionDelete($rid, $id) {
        $this->CheckPermission();

        $reading_part6 = $this->Reading_Part6Model->get($id);
        if (!$reading_part6)
            return;
        $reading_id = $rid;
        $this->Reading_Part6Model->update(array('deleted' => 1, 'id' => $id, 'rid' => $reading_id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function actionAdd($rid) {
        $this->CheckPermission();
        $reading_id = $rid;
        if ($_POST)
            $this->do_add($reading_id);
        $reading = $this->ReadingModel->get($reading_id);
        $this->viewData['reading'] = $reading;
        $this->viewData['message'] = $this->message;
        $this->render('add', $this->viewData);
    }

    private function do_add($reading_id) {
        $question = trim($_POST['question']);
        $choice1 = trim($_POST['choice1']);
        $choice2 = trim($_POST['choice2']);
        $choice3 = trim($_POST['choice3']);
        $choice4 = trim($_POST['choice4']);
        $answer = $_POST['answer'];

        if ($this->validator->is_empty_string($question))
            $this->message['error'][] = "Question cannot be empty";
        if ($this->validator->is_empty_string($choice1))
            $this->message['error'][] = "Choice 1 cannot be empty";
        if ($this->validator->is_empty_string($choice2))
            $this->message['error'][] = "Choice 2 cannot be empty";
        if ($this->validator->is_empty_string($choice3))
            $this->message['error'][] = "Choice 3 cannot be empty";
        if ($this->validator->is_empty_string($choice4))
            $this->message['error'][] = "Choice 4 cannot be empty";
        if ($this->validator->is_empty_string($answer))
            $this->message['error'][] = "Answer cannot be empty";
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $reading_part6_id = $this->Reading_Part6Model->add($reading_id, $question, $choice1, $choice2, $choice3, $choice4, $answer, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toeic/reading_part6/edit/rid/" . $reading_id . "/id/$reading_part6_id/?s=1");
    }

}

?>
