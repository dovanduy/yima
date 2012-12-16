<?php

class Answer_nt_scqController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $Answer_nt_scqModel;
    private $QuestionModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $Answer_nt_scqModel Answer_nt_scqModel */
        $this->Answer_nt_scqModel = new Answer_nt_scqModel();

        /* @var $QuestionModel QuestionModel */
        $this->QuestionModel = new QuestionModel();
    }

    public function actionIndex($qid, $p = 1) {

        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $answer_nt = $this->Answer_nt_scqModel->get_by_question($qid, $args, $p, $ppp);
        //print_r($answer_nt);die;
        $question = $this->QuestionModel->get($qid);

        if (!$answer_nt) {
  
            $this->redirect(Yii::app()->request->baseUrl . "/answer_nt_scq/add/qid/" . $qid);
        } else {
            $this->redirect(Yii::app()->request->baseUrl . "/answer_nt_scq/edit/id/".$answer_nt[id]."/qid/" . $qid);
     
        }
    }

    public function actionEdit($qid,$id = 0) {
        $this->CheckPermission();
       
        $answer_nt = $this->Answer_nt_scqModel->get($id);
        if (!$answer_nt)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($answer_nt, $qid);

        $question = $this->QuestionModel->get($qid);
        $this->viewData['question'] = $question;
        $this->viewData['message'] = $this->message;
        $this->viewData['answer_nt'] = $answer_nt;
        $this->viewData['qid'] = $qid;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($answer_nt, $qid) {
        $choice1 = $_POST['choice1'];
        $choice2 = $_POST['choice2'];
        $choice3 = $_POST['choice3'];
        $choice4 = $_POST['choice4'];
        $choice = $_POST['choice'];
        if ($this->validator->is_empty_string($choice1))
            $this->message['error'][] = "Choice1 cannot be empty.";
        if ($this->validator->is_empty_string($choice2))
            $this->message['error'][] = "Choice2 cannot be empty.";
        if ($this->validator->is_empty_string($choice3))
            $this->message['error'][] = "Choice3 cannot be empty.";
        if ($this->validator->is_empty_string($choice4))
            $this->message['error'][] = "Choice4 cannot be empty.";
        if ($choice == "")
            $this->message['error'][] = "Please choose a right choice";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }


        $this->Answer_nt_scqModel->update(array( 'choice_1' => $choice1, 'choice_2' => $choice2, 'choice_3' => $choice3, 'choice_4' => $choice4,
            'right_choice' => $choice,
         'id' => $answer_nt['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $answer_nt, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/answer_nt_scq/edit/id/$answer_nt[id]/qid/$qid/?s=1");
    }

    public function actionAdd($qid) {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add($qid);
        
        $this->viewData['qid'] = $qid;
        $question = $this->QuestionModel->get($qid);
        $this->viewData['question'] = $question;
        $this->viewData['message'] = $this->message;
        $this->render('add', $this->viewData);
    }

    private function do_add($qid) {

        $choice1 = $_POST['choice1'];
        $choice2 = $_POST['choice2'];
        $choice3 = $_POST['choice3'];
        $choice4 = $_POST['choice4'];
        $choice = $_POST['choice'];




        if ($this->validator->is_empty_string($choice1))
            $this->message['error'][] = "Choice1 cannot be empty.";
        if ($this->validator->is_empty_string($choice2))
            $this->message['error'][] = "Choice2 cannot be empty.";
        if ($this->validator->is_empty_string($choice3))
            $this->message['error'][] = "Choice3 cannot be empty.";
        if ($this->validator->is_empty_string($choice4))
            $this->message['error'][] = "Choice4 cannot be empty.";
        if ($choice == "")
            $this->message['error'][] = "Please choose a right choice";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }


        $answer_id = $this->Answer_nt_scqModel->add($qid, $choice1, $choice2, $choice3, $choice4, $choice);
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/answer_nt_scq/edit/id/$answer_id/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $speaking = $this->ListeningSCQModel->get($id);
        if (!$speaking)
            return;

        $this->ListeningSCQModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

}

?>
