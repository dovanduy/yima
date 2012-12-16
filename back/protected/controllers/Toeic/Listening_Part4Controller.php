<?php

class Listening_Part4Controller extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $Listening_Part4Model;
    private $ListeningModel;

    public function init() {
        /* @var $this ListeningController */
        $this->validator = new FormValidator();
        /* @var $this ListeningController */
        $this->Listening_Part4Model = new Toeic_Listening_Part4_Model();
        /* @var $this Reading_Part5Controller */
        $this->ListeningModel = new Toeic_ListeningModel();
    }

    public function actionIndex($lid, $p = 1) {
        $this->CheckPermission();
        $listening_id = $lid;

        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'li' => $listening_id, 'deleted' => 0);

        $listening_part4 = $this->Listening_Part4Model->gets($args, $p, $ppp);
        $total_listening_part4 = $this->Listening_Part4Model->counts($args);
        $listening = $this->ListeningModel->get($listening_id);

        $this->viewData['listening_part4'] = $listening_part4;
        $this->viewData['total'] = $total_listening_part4;
        $this->viewData['listening'] = $listening;
        $this->viewData['paging'] = $total_listening_part4 > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toeic/listening_part4/index/lid/" . $listening_id . "/p/", $total_listening_part4, $p) : "";
        $this->render('index', $this->viewData);
    }

    public function actionEdit($lid, $id = 0) {
        $this->CheckPermission();
        $listening_part4 = $this->Listening_Part4Model->get($id);
        if (!$listening_part4) {
            $this->layout = "404";
            return;
        }
        $listening_id = $lid;
        $listening = $this->ListeningModel->get($listening_id);
        if ($_POST)
            $this->do_edit($listening_id, $listening_part4);
        $this->viewData['message'] = $this->message;
        $this->viewData['listening_part4'] = $listening_part4;
        $this->viewData['listening'] = $listening;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($listening_id, $listening_part4) {
        $lsound = $listening_part4['lsound'];
        $file = $_FILES['question_sound'];
        $sound_title = trim($_POST['sound_title']);
        // question 1
        $question_1 = trim($_POST['question_q1']);
        $choice1_1 = trim($_POST['choice1_q1']);
        $choice2_1 = trim($_POST['choice2_q1']);
        $choice3_1 = trim($_POST['choice3_q1']);
        $choice4_1 = trim($_POST['choice4_q1']);
        $answer_1 = $_POST['answer_q1'];

        // question 2
        $question_2 = trim($_POST['question_q2']);
        $choice1_2 = trim($_POST['choice1_q2']);
        $choice2_2 = trim($_POST['choice2_q2']);
        $choice3_2 = trim($_POST['choice3_q2']);
        $choice4_2 = trim($_POST['choice4_q2']);
        $answer_2 = $_POST['answer_q2'];

        // question 3
        $question_3 = trim($_POST['question_q3']);
        $choice1_3 = trim($_POST['choice1_q3']);
        $choice2_3 = trim($_POST['choice2_q3']);
        $choice3_3 = trim($_POST['choice3_q3']);
        $choice4_3 = trim($_POST['choice4_q3']);
        $answer_3 = $_POST['answer_q3'];

        if ($this->validator->is_empty_string($sound_title))
            $this->message['error'][] = "Sound's title cannot be empty.";
        // validate question 1
        if ($this->validator->is_empty_string($question_1))
            $this->message['error'][] = "Question 1 cannot be empty";
        if ($this->validator->is_empty_string($choice1_1))
            $this->message['error'][] = "Choice 1 of question 1 cannot be empty";
        if ($this->validator->is_empty_string($choice2_1))
            $this->message['error'][] = "Choice 2 of question 1 cannot be empty";
        if ($this->validator->is_empty_string($choice3_1))
            $this->message['error'][] = "Choice 3 of question 1 cannot be empty";
        if ($this->validator->is_empty_string($choice4_1))
            $this->message['error'][] = "Choice 4 of question 1 cannot be empty";
        // validate question 2
        if ($this->validator->is_empty_string($question_2))
            $this->message['error'][] = "Question 2 cannot be empty";
        if ($this->validator->is_empty_string($choice1_2))
            $this->message['error'][] = "Choice 1 of question 2 cannot be empty";
        if ($this->validator->is_empty_string($choice2_2))
            $this->message['error'][] = "Choice 2 of question 2 cannot be empty";
        if ($this->validator->is_empty_string($choice3_2))
            $this->message['error'][] = "Choice 3 of question 2 cannot be empty";
        if ($this->validator->is_empty_string($choice4_2))
            $this->message['error'][] = "Choice 4 of question 2 cannot be empty";

        // validate question 1
        if ($this->validator->is_empty_string($question_3))
            $this->message['error'][] = "Question 3 cannot be empty";
        if ($this->validator->is_empty_string($choice1_3))
            $this->message['error'][] = "Choice 1 of question 3 cannot be empty";
        if ($this->validator->is_empty_string($choice2_3))
            $this->message['error'][] = "Choice 2 of question 3 cannot be empty";
        if ($this->validator->is_empty_string($choice3_3))
            $this->message['error'][] = "Choice 3 of question 3 cannot be empty";
        if ($this->validator->is_empty_string($choice4_3))
            $this->message['error'][] = "Choice 4 of question 3 cannot be empty";
        if (!$this->validator->is_empty_string($file['name']))
            $lsound = HelperApp::upload_audio($file);

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $this->Listening_Part4Model->update(array('lsound' => $lsound, 'title' => $sound_title, 'question_1' => $question_1, 'choice1_1' => $choice1_1, 'choice2_1' => $choice2_1, 'choice3_1' => $choice3_1, 'choice4_1' => $choice4_1, 'answer_1' => $answer_1,
            'question_2' => $question_2, 'choice1_2' => $choice1_2, 'choice2_2' => $choice2_2, 'choice3_2' => $choice3_2, 'choice4_2' => $choice4_2, 'answer_2' => $answer_2,
            'question_3' => $question_3, 'choice1_3' => $choice1_3, 'choice2_3' => $choice2_3, 'choice3_3' => $choice3_3, 'choice4_3' => $choice4_3, 'answer_3' => $answer_3, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $listening_part4['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $listening_part4, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toeic/listening_part4/edit/lid/" . $listening_id . "/id/$listening_part4[id]/?s=1");
    }

    public function actionDelete($lid, $id) {
        $this->CheckPermission();

        $listening_part4 = $this->Listening_Part4Model->get($id);
        if (!$listening_part4)
            return;
        $listening_id = $lid;
        $this->Listening_Part4Model->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function actionAdd($lid) {
        $this->CheckPermission();
        $listening_id = $lid;
        if ($_POST)
            $this->do_add($listening_id);
        $listening = $this->ListeningModel->get($listening_id);
        $this->viewData['listening'] = $listening;
        $this->viewData['message'] = $this->message;
        $this->render('add', $this->viewData);
    }

    private function do_add($listening_id) {
        $file = $_FILES['question_sound'];
        $sound_title = trim($_POST['sound_title']);
        // question 1
        $question_1 = trim($_POST['question_q1']);
        $choice1_1 = trim($_POST['choice1_q1']);
        $choice2_1 = trim($_POST['choice2_q1']);
        $choice3_1 = trim($_POST['choice3_q1']);
        $choice4_1 = trim($_POST['choice4_q1']);
        $answer_1 = $_POST['answer_q1'];

        // question 2
        $question_2 = trim($_POST['question_q2']);
        $choice1_2 = trim($_POST['choice1_q2']);
        $choice2_2 = trim($_POST['choice2_q2']);
        $choice3_2 = trim($_POST['choice3_q2']);
        $choice4_2 = trim($_POST['choice4_q2']);
        $answer_2 = $_POST['answer_q2'];

        // question 3
        $question_3 = trim($_POST['question_q3']);
        $choice1_3 = trim($_POST['choice1_q3']);
        $choice2_3 = trim($_POST['choice2_q3']);
        $choice3_3 = trim($_POST['choice3_q3']);
        $choice4_3 = trim($_POST['choice4_q3']);
        $answer_3 = $_POST['answer_q3'];

        if ($this->validator->is_empty_string($file['name']))
            $this->message['error'][] = "Question's Sound is invalid.";
        if ($this->validator->is_empty_string($sound_title))
            $this->message['error'][] = "Sound's title cannot be empty.";
        // validate question 1
        if ($this->validator->is_empty_string($question_1))
            $this->message['error'][] = "Question 1 cannot be empty";
        if ($this->validator->is_empty_string($choice1_1))
            $this->message['error'][] = "Choice 1 of question 1 cannot be empty";
        if ($this->validator->is_empty_string($choice2_1))
            $this->message['error'][] = "Choice 2 of question 1 cannot be empty";
        if ($this->validator->is_empty_string($choice3_1))
            $this->message['error'][] = "Choice 3 of question 1 cannot be empty";
        if ($this->validator->is_empty_string($choice4_1))
            $this->message['error'][] = "Choice 4 of question 1 cannot be empty";
        // validate question 2
        if ($this->validator->is_empty_string($question_2))
            $this->message['error'][] = "Question 2 cannot be empty";
        if ($this->validator->is_empty_string($choice1_2))
            $this->message['error'][] = "Choice 1 of question 2 cannot be empty";
        if ($this->validator->is_empty_string($choice2_2))
            $this->message['error'][] = "Choice 2 of question 2 cannot be empty";
        if ($this->validator->is_empty_string($choice3_2))
            $this->message['error'][] = "Choice 3 of question 2 cannot be empty";
        if ($this->validator->is_empty_string($choice4_2))
            $this->message['error'][] = "Choice 4 of question 2 cannot be empty";

        // validate question 1
        if ($this->validator->is_empty_string($question_3))
            $this->message['error'][] = "Question 3 cannot be empty";
        if ($this->validator->is_empty_string($choice1_3))
            $this->message['error'][] = "Choice 1 of question 3 cannot be empty";
        if ($this->validator->is_empty_string($choice2_3))
            $this->message['error'][] = "Choice 2 of question 3 cannot be empty";
        if ($this->validator->is_empty_string($choice3_3))
            $this->message['error'][] = "Choice 3 of question 3 cannot be empty";
        if ($this->validator->is_empty_string($choice4_3))
            $this->message['error'][] = "Choice 4 of question 3 cannot be empty";


        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }
        $lsound = HelperApp::upload_audio($file);
        $listening_part4_id = $this->Listening_Part4Model->add($listening_id, $sound_title, $lsound, $question_1, $choice1_1, $choice2_1, $choice3_1, $choice4_1, $answer_1, $question_2, $choice1_2, $choice2_2, $choice3_2, $choice4_2, $answer_2, $question_3, $choice1_3, $choice2_3, $choice3_3, $choice4_3, $answer_3, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toeic/listening_part4/edit/lid/" . $listening_id . "/id/$listening_part4_id/?s=1");
    }

}

?>
