<?php

class GradeController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $GradeModel;

    public function init() {
        $this->validator = new FormValidator();
        $this->GradeModel = new GradeModel();
    }

    public function actionIndex($p = 1) {

        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $grades = $this->GradeModel->gets($args, $p, $ppp);
        $total = $this->GradeModel->counts($args);

        $this->viewData['grades'] = $grades;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/grade/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $grade = $this->GradeModel->get($id);
        if (!$grade)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($grade);

        $this->viewData['message'] = $this->message;
        $this->viewData['grade'] = $grade;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($grade) {
        $title = trim($_POST['title']);
        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }
        $this->GradeModel->update(array('title' => $title, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $grade['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $grade, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/grade/edit/id/$grade[id]/?s=1");
    }

    public function actionAdd() {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add();
        $this->viewData['message'] = $this->message;
        $this->render('add', $this->viewData);
    }

    private function do_add() {
        $title = trim($_POST['title']);

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Name of School cannot be empty.";
        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $grade_id = $this->GradeModel->add($title, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/grade/edit/id/$grade_id/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $grade = $this->GradeModel->get($id);
        if (!$grade)
            return;

        $this->GradeModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

}

?>
