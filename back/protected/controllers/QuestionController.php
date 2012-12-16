<?php

class QuestionController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $QuestionModel;
    private $TestNTModel;
    private $AnswerSCQModel;

    public function init() {
        $this->validator = new FormValidator();
        $this->QuestionModel = new QuestionModel();
        $this->TestNTModel = new TestNTModel();
        
        /* @var $AnswerSCQModel Answer_nt_scqModel */
        $this->AnswerSCQModel = new Answer_nt_scqModel();
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0);
        $question = $this->QuestionModel->gets($args, $p, $ppp);
        $total_question = $this->QuestionModel->counts($args);

        $this->viewData['question'] = $question;
        $this->viewData['total'] = $total_question;
        $this->viewData['paging'] = $total_question > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/question/index/p/", $total_question, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $question = $this->QuestionModel->get($id);        
        
        if (!$question)
            $this->load_404 ();
        $answer = $this->AnswerSCQModel->get_by_question($question['id']);
        if ($_POST)
            $this->do_edit($question,$answer);
        $this->viewData['answer'] = $answer;
        $this->viewData['message'] = $this->message;
        $this->viewData['question'] = $question;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($question,$answer) {
        $title = trim($_POST['question']);
        
        $choice1 = $_POST['choice1'];
        $choice2 = $_POST['choice2'];
        $choice3 = $_POST['choice3'];
        $choice4 = $_POST['choice4'];
        $right = $_POST['right'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Question cannot be blank.";
        if($right < 1 || $right > 4)
            $this->message['error'][] = "Please choose right choice."; 

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }


        $this->QuestionModel->update(array('question'=>$title,'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $question['id']));
        $this->AnswerSCQModel->update(array('choice_1'=>$choice1,'choice_2'=>$choice2,'choice_3'=>$choice3,'choice_4'=>$choice4,'right_choice'=>$right,'id'=>$answer['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $question, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/question/edit/id/$question[id]/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();

        $question = $this->QuestionModel->get($id);        
        if (!$question)
            return;
        $this->QuestionModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function actionAdd() {

        $this->CheckPermission();
        $test = $this->TestNTModel->get_to_list();
        $this->viewData['test'] = $test;
        if ($_POST)
            $this->do_add();
        $this->viewData['message'] = $this->message;
        $this->render('add', $this->viewData);
    }

    private function do_add() {

        $title = $_POST['title'];
        $test = $_POST['test'];
        $question = $_POST['question'];
        $type = $_POST['type'];

        if ($test == 0)
            $this->message['error'][] = "Choose a Test.";
        if ($type == 0)
            $this->message['error'][] = "Choose a Type.";

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";
        if ($this->validator->is_empty_string($question))
            $this->message['error'][] = "Question cannot be empty.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }


        $author = UserControl::getId();
        $question_id = $this->QuestionModel->add($title, $test, $question, $type, $author, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/question/edit/id/$question_id/?s=1");
    }

}
?>
