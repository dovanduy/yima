<?php

class ReadingDDQController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $ReadingDDQModel;
    private $ReadingDDQSubModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();
        $this->ReadingDDQModel = new ReadingDDQModel();
        $this->ReadingDDQSubModel = new ReadingDDQSubModel();
    }

    public function actionIndex($p = 1) {
        $rid = $_GET['rid'];
        $part = $_GET['part'];
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $readingddq = $this->ReadingDDQModel->get_by_reading($args, $p, $ppp, $rid);
        $total = $this->ReadingDDQModel->counts_by_reading($args, $rid);

        $this->viewData['readingddq'] = $readingddq;
        $this->viewData['total'] = $total;
        $this->viewData['rid'] = $rid;
        $this->viewData['part'] = $part;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/readingDDQ/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $part = $_GET['part'];
        $readingDDQ = $this->ReadingDDQModel->get($id);
        if (!$readingDDQ)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($readingDDQ, $part);

        $this->viewData['message'] = $this->message;
        $this->viewData['readingDDQ'] = $readingDDQ;
        $this->viewData['part'] = $part;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($readingddq, $part) {
        $title = $_POST['title'];

        $content = $_POST['content'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title không được để trống.";

        if ($this->validator->is_empty_string($content))
            $this->message['error'][] = "Direction không được để trống.";


        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        $this->ReadingDDQModel->update(array('title' => $title, 'content' => $content,
            'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $readingddq['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $readingddq, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/readingDDQ/edit/id/$readingddq[id]/?part=$part&s=1");
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

        $content = $_POST['content'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title không được để trống.";

        if ($this->validator->is_empty_string($content))
            $this->message['error'][] = "Direction không được để trống.";


        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        $author = UserControl::getId();
        $readingDDQ_id = $this->ReadingDDQModel->add($rid, $title, $content, $author, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/readingDDQ/edit/id/$readingDDQ_id/?part=$part&s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $speaking = $this->ReadingDDQModel->get($id);
        if (!$speaking)
            return;

        $this->ReadingDDQModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function actionScore($p = 1) {

        $rddq_id = $_GET['id'];
        $part = $_GET['part'];
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $rddq_score = $this->ReadingDDQModel->get_score($args, $p, $ppp, $rddq_id);
        $total = $this->ReadingDDQModel->count_score($args, $rddq_id);

        $this->viewData['rddq_score'] = $rddq_score;
        $this->viewData['total'] = $total;
        $this->viewData['rddq_id'] = $rddq_id;
        $this->viewData['part'] = $part;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/readingDDQ/score/p/", $total, $p) : "";
        $this->render('score', $this->viewData);
    }

    public function actionAdd_score($rddq_id, $part) {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add_score($rddq_id, $part);
        $this->viewData['message'] = $this->message;
        $this->viewData['part'] = $part;
        $this->viewData['rddq_id'] = $rddq_id;
        $this->render('add_score', $this->viewData);
    }

    private function do_add_score($rddq_id, $part) {
        $title = $_POST['title'];
        $score = $_POST['score'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Number of Right Choice không được để trống.";
        if ($this->validator->is_empty_string($score))
            $this->message['error'][] = "Score không được để trống.";
        if (!$this->validator->is_valid(Yii::app()->getParams()->itemAt('regx_number'), $title))
            $this->message['error'][] = " Number of Right Choice phải là số.";
        if (!$this->validator->is_valid(Yii::app()->getParams()->itemAt('regx_number'), $score))
            $this->message['error'][] = "Score phải là số.";


        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $q_type = "r_ddq";


        $author = UserControl::getId();
        $readingDDQ_id = $this->ReadingDDQModel->add_score($rddq_id, $title, $score, $q_type, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/readingDDQ/edit/id/$readingDDQ_id/?part=$part&s=1");
    }

    public function actionEdit_score($id = 0) {
        $this->CheckPermission();
        $part = $_GET['part'];
        $rddq_score = $this->ReadingDDQModel->get_score_by_id($id);
        if (!$rddq_score)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit_score($rddq_score, $part);

        $this->viewData['message'] = $this->message;
        $this->viewData['rddq_score'] = $rddq_score;
        $this->viewData['part'] = $part;
        $this->render('edit_score', $this->viewData);
    }

    private function do_edit_score($rddq_score, $part) {
        $title = $_POST['title'];
        $score = $_POST['score'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Number of Right Choice không được để trống.";
        if ($this->validator->is_empty_string($score))
            $this->message['error'][] = "Score không được để trống.";
        if (!$this->validator->is_valid(Yii::app()->getParams()->itemAt('regx_number'), $title))
            $this->message['error'][] = " Number of Right Choice phải là số.";
        if (!$this->validator->is_valid(Yii::app()->getParams()->itemAt('regx_number'), $score))
            $this->message['error'][] = "Score phải là số.";


        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        $this->ReadingDDQModel->update_score(array('rightchoices' => $title, 'score' => $score,
            'id' => $rddq_score['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $readingddq, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/readingDDQ/edit_score/id/$rddq_score[id]/?part=$part&s=1");
    }

    public function actionSubs($ddq_id, $p = 1) {
        $rid = $_GET['rid'];
        $part = $_GET['part'];
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);
        $readingDDQ = $this->ReadingDDQModel->get($ddq_id);
        $readingddq_sub = $this->ReadingDDQSubModel->gets($args, $p, $ppp, $ddq_id);
        $total = $this->ReadingDDQSubModel->counts($args, $ddq_id);

        $this->viewData['readingDDQ'] = $readingDDQ;
        $this->viewData['readingddq_sub'] = $readingddq_sub;
        $this->viewData['total'] = $total;
        $this->viewData['rid'] = $rid;
        $this->viewData['part'] = $part;
        $this->viewData['ddq_id'] = $ddq_id;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/readingDDQ/index/p/", $total, $p) : "";
        $this->render('subs', $this->viewData);
    }

    public function actionPost_subs($ddq_id, $p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);
        $readingddq_sub = $this->ReadingDDQSubModel->gets($args, $p, $ppp, $ddq_id);

        $i = -1;
        foreach ($readingddq_sub as $row) {
            $i++;
            $response[$i] = $row['id'];
            $i++;
            $title = $row['title'];
            $response[$i] = $title;
        }
        $response['count'] = $i;
        echo json_encode($response);
    }

    public function actionPost_choice($ddq_id) {
        $this->CheckPermission();

        $readingddq_choice = $this->ReadingDDQModel->get_choice($ddq_id);

        $i = -1;
        foreach ($readingddq_choice as $row) {
            $i++;
            $response[$i] = $row['id'];
            $i++;
            $response[$i] = $row['subid'];
            $i++;
            $response[$i] = $row['title'];
        }
        $response['count'] = $i;
        echo json_encode($response);
    }

    public function actionDelete_choice($id) {
        $this->CheckPermission();
        $choice = $this->ReadingDDQModel->get_choice_by_id($id);
        if (!$choice)
            return;

        $this->ReadingDDQModel->update_choice(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function actionDelete_subject($id) {
        $this->CheckPermission();
        $subject = $this->ReadingDDQSubModel->get($id);
        if (!$subject)
            return;

        $this->ReadingDDQSubModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function ActionAdd_choice() {
        $ddqid = $_POST['ddqid'];
        $title = $_POST['title'];

        $id = $this->ReadingDDQModel->add_choice($ddqid, $title);

        $response['status'] = 'success';
        $response['id'] = $id;

        echo json_encode($response);
    }

    public function ActionUpdate_choice() {
        $id = $_POST['id'];
        $title = $_POST['title'];

        $this->ReadingDDQModel->update_choice(array('title' => $title, 'id' => $id));
    }

    public function update_choice_subject() {
        $id = $_POST['id'];
        $subid = $_POST['subid'];

        $this->ReadingDDQModel->update_choice(array('subid' => $subid, 'id' => $id));
    }

    public function ActionAdd_subject() {
        $ddqid = $_POST['ddqid'];
        $title = $_POST['title'];

        $subid = $this->ReadingDDQSubModel->add($ddqid, $title);
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));

        $response['status'] = 'success';
        $response['id'] = $subid;

        echo json_encode($response);
    }

    public function ActionUpdate_subject() {
        $id = $_POST['id'];
        $title = $_POST['title'];

        $this->ReadingDDQSubModel->update(array('title' => $title, 'id' => $id));
    }

}

?>
