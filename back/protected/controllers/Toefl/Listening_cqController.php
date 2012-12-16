<?php

class Listening_cqController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $Listening_cqModel;
    private $ListeningModel;
    private $ConfigureScoreModel;
    private $Cq_columnModel;
    private $Cq_rowModel;
    private $question_type;

    public function init() {
        $this->validator = new FormValidator();
        /* @var $this Listening_cqController */
        $this->Listening_cqModel = new Listening_cqModel();
        /* @var $this Listening_cqController */
        $this->ListeningModel = new ListeningModel();
        /* @var $this Listening_cqController */
        $this->ConfigureScoreModel = new Toefl_configure_scoreModel();
        /* @var $this Listening_cqController */
        $this->Cq_columnModel = new Listening_cq_columnModel();
        /* @var $this Listening_cqController */
        $this->Cq_rowModel = new Listening_cq_rowModel();
        $this->question_type = 'l_cq';
    }

    public function actionIndex($lid, $p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $cqs = $this->Listening_cqModel->gets($args, $lid, $p, $ppp);
        $listening = $this->ListeningModel->get($lid);
        $total = $this->Listening_cqModel->counts($args, $lid);
        $this->viewData['cqs'] = $cqs;
        $this->viewData['listening'] = $listening;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/listening_cq/id/'.$lid.'/p/", $total, $p) : "";
        $this->render('index', $this->viewData);
    }

    public function actionConfigure_score($question_id, $lid) {
        $this->CheckPermission();
        $scores = $this->ConfigureScoreModel->get_by_question($question_id, $this->question_type);
        $question = $this->Listening_cqModel->get($question_id);
        $listening = $this->ListeningModel->get($lid);
        if (!isset($scores[0]) || !isset($question) || !isset($listening))
            $this->layout = "404";

        $choices = array();
        $score_id = array();

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
        if (!$score) {
            $this->layout = "404";
            return;
        }

        $this->ConfigureScoreModel->update(array('score' => 0, 'id' => $score_id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $score_id)));
    }

    public function actionEdit_configure_score($score_id) {
        $this->CheckPermission();
        $score = $this->ConfigureScoreModel->get($score_id);
        if (!$score)
            $this->layout = "404";
        if ($_POST)
            $this->do_configure_score($score);
    

        $this->viewData['score'] = $score;
        $this->viewData['message'] = $this->message;
        $this->render('edit_configure_score', $this->viewData);
    }

    public function do_configure_score($score) {
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
        $this->ConfigureScoreModel->configure_score($score['question_id'], $this->question_type, $choice_id, $score);
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $question, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/listening_cq/configure_score/question_id/$question[id]/lid/" . $lid);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $cq = $this->Listening_cqModel->get($id);
        if (!$cq)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($cq);

        $listening = $this->ListeningModel->get($cq['lid']);
        $this->viewData['message'] = $this->message;
        $this->viewData['cq'] = $cq;
        $this->viewData['listening'] = $listening;
        $this->render('edit', $this->viewData
        );
    }

    private function do_edit($cq) {
        $title = trim($_POST['title']);
        $file = $_FILES['direction_sound'];
        $direction = $_POST['direction'];
        $audio = $cq['lsound'];
        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";
        if ($this->validator->is_empty_string($direction))
            $this->message['error'][] = "Direction cannot be empty.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }
        if (!$this->validator->is_empty_string($file['name']))
            $audio = HelperApp::upload_audio($file);
        else
            $audio = $cq['lsound'];

        $this->Listening_cqModel->update(array('title' => $title, 'lsound' => $audio, 'content' => $direction, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $cq['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $cq, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/listening_cq/edit/lid/$cq[lid]/id/$cq[id] /?s = 1"
        );
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $listening = $this->Listening_cqModel->get($id);
        if (!$listening)
            return;

        $this->Listening_cqModel->update(array('deleted' => 1, 'id' => $id));
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
        $file = $_FILES['direction_sound'];
        $direction = $_POST['direction'];
        $lid = $_POST['lid'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";
        if ($this->validator->is_empty_string($direction))
            $this->message['error'][] = "Direction cannot be empty.";
        if ($this->validator->is_empty_string($file['name']))
            $this->message['error'][] = "Question's Sound is invalid.";
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

         $audio = HelperApp::upload_toefl_audio($file, 'listening/cq');

        $cq_id = $this->Listening_cqModel->add($lid, $title, $direction, $audio, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/listening_cq/edit/lid/$lid/id/$cq_id/?s = 1");
    }

    public function actionManage($question_id) {
        $this->CheckPermission();
        $cq = $this->Listening_cqModel->get($question_id);
        if (!$cq)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($cq);

        $listening = $this->ListeningModel->get($cq['lid']);
        $columns = $this->Cq_columnModel->get_by_question($question_id);
        $rows = $this->Cq_rowModel->get_by_question($question_id);
        $this->viewData['message'] = $this->message;
        $this->viewData['cq'] = $cq;
        $this->viewData['listening'] = $listening;
        $this->viewData['columns'] = $columns;
        $this->viewData['rows'] = $rows;
        $this->render('manage', $this->viewData);
    }

    public function actionUpdaterow() {
        
    }

    public function actionAddrow() {
        $question_id = $_POST['question_id'];
        $title = $_POST['title_row'];
        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Tên row cannot be empty.";
        $row_id = $this->Cq_rowModel->add($question_id, $title);
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));

        $response['title'] = $title;
        $response['id'] = $row_id;
        echo json_encode($response);
    }

    public function actionAddcolumn() {
        $question_id = $_POST['question_id'];
        $title = $_POST['title_column'];
        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Tên column cannot be empty.";
        $col_id = $this->Cq_rowModel->add($question_id, $title);
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));

        $response['title'] = $title;
        $response['id'] = $col_id;
        echo json_encode($response);
    }

}

?>
