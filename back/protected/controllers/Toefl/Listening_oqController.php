<?php

class Listening_oqController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $Listening_oqModel;
    private $ListeningModel;
    private $ConfigureScoreModel;
    private $question_type;

    public function init() {
        $this->validator = new FormValidator();
        /* @var $this Listening_oqController */
        $this->Listening_oqModel = new Listening_oqModel();
        /* @var $this Listening_oqController */
        $this->ListeningModel = new ListeningModel();
        /* @var $this Listening_oqController */
        $this->ConfigureScoreModel = new Toefl_configure_scoreModel();
        /* @var $this Listening_oqController */
        $this->question_type = 'l_oq';
    }

    public function actionIndex($lid, $p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $oqs = $this->Listening_oqModel->gets($args, $lid, $p, $ppp);
        $listening = $this->ListeningModel->get($lid);
        $total = $this->Listening_oqModel->counts($args, $lid);
        $this->viewData['oqs'] = $oqs;
        $this->viewData['listening'] = $listening;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/listening_oq/id/'.$lid.'/p/", $total, $p) : "";
        $this->render('index', $this->viewData);
    }

    public function actionConfigure_score($question_id, $lid) {
        $this->CheckPermission();

        $scores = $this->ConfigureScoreModel->get_by_question($question_id, $this->question_type);
        $question = $this->Listening_oqModel->get($question_id);
        $listening = $this->ListeningModel->get($lid);
        if (!isset($scores[0]) || !isset($question) || !isset($listening))
            $this->layout = "404";
        if ($_POST)
            $this->do_configure_score($question, $lid);

        $choices = array();

        foreach ($scores as $k => $v) {
            $choices[$v['rightchoices']] = $v['score'];
            $score_id[$v['rightchoices']] = $v['id'];
        }
        $this->viewData['message'] = $this->message;
        $this->viewData['scores'] = $scores;
        $this->viewData['listening'] = $listening;
        $this->viewData['question'] = $question;
        $this->viewData['choices'] = $choices;
        $this->viewData['score_id'] = $score_id;
        $this->render('configure_score', $this->viewData);
    }

    public function actionDelete_score($score_id) {
        $this->CheckPermission();
        $score = $this->ConfigureScoreModel->get($score_id);
        if (!$score)
            return;
        $this->ConfigureScoreModel->update(array('score' => 0, 'id' => $score_id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $score_id)));
    }

    public function do_configure_score($question, $lid) {
        $choice_id = $_POST['right_choice'];
        $score = $_POST['score'];
        if ($this->validator->is_empty_string($choice_id))
            $this->message['error'][] = "Right choice cannot be empty.";
        if (!$this->validator->is_integer($choice_id) || $choice_id < 0)
            $this->message['error'][] = "Right choice is invalid.";
        if ($this->validator->is_empty_string($score))
            $this->message['error'][] = "Score cannot be empty.";
        if (!$this->validator->is_integer($score) || $score < 0)
            $this->message['error'][] = "Score is invalid.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }
        $this->ConfigureScoreModel->configure_score($question['id'], $this->question_type, $choice_id, $score);
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $question, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/listening_oq/configure_score/question_id/$question[id]/lid/" . $lid);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $oq = $this->Listening_oqModel->get($id);
        if (!$oq)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($oq);

        $listening = $this->ListeningModel->get($oq['lid']);
        $this->viewData['message'] = $this->message;
        $this->viewData['oq'] = $oq;
        $this->viewData['listening'] = $listening;
        $this->render('edit', $this->viewData
        );
    }

    private function do_edit($oq) {
        $title = trim($_POST['title']);
        $file = $_FILES['question_sound'];
        $choice_1 = trim($_POST['choice_1']);
        $choice_2 = trim($_POST['choice_2']);
        $choice_3 = trim($_POST['choice_3']);
        $choice_4 = trim($_POST['choice_4']);
        $audio = $oq['lsound'];
        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";

        if ($this->validator->is_empty_string($choice_1))
            $this->message['error'][] = "Choice 1 cannot be empty.";
        if ($this->validator->is_empty_string($choice_2))
            $this->message['error'][] = "Choice 2 cannot be empty.";
        if ($this->validator->is_empty_string($choice_3))
            $this->message['error'][] = "Choice 3 cannot be empty.";
        if ($this->validator->is_empty_string($choice_4))
            $this->message['error'][] = "Choice 4 cannot be empty.";
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }
        if (!$this->validator->is_empty_string($file['name']))
            $audio = HelperApp::upload_toefl_audio($file, 'listening/oq');
        else
            $audio = $oq['lsound'];

        $this->Listening_oqModel->update(array('title' => $title, 'lsound' => $audio, 'choice1' => $choice_1, 'choice2' => $choice_2, 'choice3' => $choice_3, 'choice4' => $choice_4, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $oq['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $oq, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/listening_oq/edit/lid/$oq[lid]/id/$oq[id] /?s = 1"
        );
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $listening = $this->Listening_oqModel->get($id);
        if (!$listening)
            return;

        $this->Listening_oqModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function actionAdd($lid) {

        $this->CheckPermission();
        $listening = $this->ListeningModel->get($lid);
        if (!$listening)
            $this->layout
                    = "404";
        if ($_POST)
            $this->do_add($lid);

        $this->viewData['message'] = $this->message;
        $this->viewData['listening'] = $listening;
        $this->render('add', $this->viewData);
    }

    private function do_add($lid) {
        $title = trim($_POST['title']);
        $file = $_FILES['question_sound'];
        $choice_1 = trim($_POST['choice_1']);
        $choice_2 = trim($_POST['choice_2']);
        $choice_3 = trim($_POST['choice_3']);
        $choice_4 = trim($_POST['choice_4']);
        $lid = $_POST['lid'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";
        if ($this->validator->is_empty_string($file['name']))
            $this->message['error'][] = "Question's Sound is invalid.";
        if ($this->validator->is_empty_string($choice_1))
            $this->message['error'][] = "Choice 1 cannot be empty.";
        if ($this->validator->is_empty_string($choice_2))
            $this->message['error'][] = "Choice 2 cannot be empty.";
        if ($this->validator->is_empty_string($choice_3))
            $this->message['error'][] = "Choice 3 cannot be empty.";
        if ($this->validator->is_empty_string($choice_4))
            $this->message['error'][] = "Choice 4 cannot be empty.";
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $audio = HelperApp::upload_toefl_audio($file, 'listening/oq');

        $oq_id = $this->Listening_oqModel->add($lid, $title, $audio, $choice_1, $choice_2, $choice_3, $choice_4, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/listening_oq/edit/lid/$lid/id/$oq_id/?s = 1");
    }

}

?>
