<?php

class ListeningMCQController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $ListeningMCQModel;

    public function init() {

        $this->validator = new FormValidator();
        $this->ListeningMCQModel = new ListeningMCQModel();
    }

    public function actionIndex($lid, $part, $p = 1) {

        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $listeningmcq = $this->ListeningMCQModel->get_by_listening($args, $p, $ppp, $lid);
        $total = $this->ListeningMCQModel->counts_by_listening($args, $lid);

        $this->viewData['listeningmcq'] = $listeningmcq;
        $this->viewData['total'] = $total;
        $this->viewData['lid'] = $lid;
        $this->viewData['part'] = $part;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/listeningMCQ/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($lid, $id = 0) {
        $this->CheckPermission();
        $part = $_GET['part'];
        $listeningMCQ = $this->ListeningMCQModel->get($id);
        if (!$listeningMCQ)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($lid,$listeningMCQ, $part);

        $this->viewData['message'] = $this->message;
        $this->viewData['listeningMCQ'] = $listeningMCQ;
        $this->viewData['part'] = $part;
        $this->viewData['lid'] = $lid;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($lid,$listeningMCQ, $part) {
        $title = $_POST['title'];
        $choice1 = $_POST['choice1'];
        $choice2 = $_POST['choice2'];
        $choice3 = $_POST['choice3'];
        $choice4 = $_POST['choice4'];
        $choice = $_POST['choice'];

        $from = $_POST['from'];
        $to = $_POST['to'];

        $replay = $_POST['replay'];
        $sentence = $_POST['sentence'];

        if ($replay == "")
            $replay = 0;
        if ($sentence == "")
            $sentence = 0;

        $sound_1 = $_FILES['sound_1'];
        $sound_2 = $_FILES['sound_2'];
        $sound_3 = $_FILES['sound_3'];

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
        if ($choice == "")
            $this->message['error'][] = "Chọn câu trả lời đúng";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        if (!$this->validator->is_empty_string($sound_1['name']))
            $sound1 = HelperApp::upload_toefl_audio($sound_1, 'listening/mcq');
        else
            $sound1 = $listeningMCQ['lsound'];
        if (!$this->validator->is_empty_string($sound_1['name']))
            $sound2 = HelperApp::upload_toefl_audio($sound_2, 'listening/mcq');
        else
            $sound2 = $listeningMCQ['replay_sound'];
        if (!$this->validator->is_empty_string($sound_1['name']))
            $sound3 = HelperApp::upload_toefl_audio($sound_3, 'listening/mcq');
        else
            $sound3 = $listeningMCQ['sentence_sound'];


        $this->ListeningMCQModel->update(array('title' => $title, 'choice1' => $choice1, 'choice2' => $choice2, 'choice3' => $choice3, 'choice4' => $choice4,
            'answer' => $choice, 'lsound' => $sound1, 'replay' => $replay, 'replay_from' => $from, 'replay_to' => $to, 'replay_sound' => $sound2, 'sentence' => $sentence, 'sentence_sound' => $sound3,
            'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $listeningMCQ['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $listeningMCQ, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/listeningMCQ/edit/lid/$lid/id/$listeningMCQ[id]/?part=$part&s=1");
    }

    public function actionAdd($lid, $part) {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add($lid, $part);
        $this->viewData['message'] = $this->message;
        $this->viewData['part'] = $part;
        $this->viewData['lid'] = $lid;
        $this->render('add', $this->viewData);
    }

    private function do_add($lid, $part) {
        $title = $_POST['title'];
        $choice1 = $_POST['choice1'];
        $choice2 = $_POST['choice2'];
        $choice3 = $_POST['choice3'];
        $choice4 = $_POST['choice4'];
        $choice = $_POST['choice'];

        $from = $_POST['from'];
        $to = $_POST['to'];

        $replay = $_POST['replay'];
        $sentence = $_POST['sentence'];

        if ($replay == "")
            $replay = 0;
        if ($sentence == "")
            $sentence = 0;

        $sound_1 = $_FILES['sound_1'];
        $sound_2 = $_FILES['sound_2'];
        $sound_3 = $_FILES['sound_3'];

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
        if ($choice == "")
            $this->message['error'][] = "Chọn câu trả lời đúng";
        if ($this->validator->is_empty_string($sound_1['name']))
            $this->message['error'][] = "Upload sound fail.";
        if ($this->validator->is_empty_string($sound_2['name']))
            $this->message['error'][] = "Upload sound fail";
        if ($this->validator->is_empty_string($sound_3['name']))
            $this->message['error'][] = "Upload sound fail";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $sound1 = HelperApp::upload_toefl_audio($sound_1, 'listening/mcq');
        $sound2 = HelperApp::upload_toefl_audio($sound_2, 'listening/mcq');
        $sound3 = HelperApp::upload_toefl_audio($sound_3, 'listening/mcq');

        $author = UserControl::getId();
        $listeningMCQ_id = $this->ListeningMCQModel->add($lid, $title, $choice1, $choice2, $choice3, $choice4, $choice, $from, $to, $sound1, $sound2, $sound3, $replay, $sentence, $author, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/listeningMCQ/edit/lid/$lid/id/$listeningMCQ_id/?part=$part&s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $speaking = $this->ListeningMCQModel->get($id);
        if (!$speaking)
            return;

        $this->ListeningMCQModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

}

?>
