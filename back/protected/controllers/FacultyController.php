<?php

class FacultyController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $FacultyModel;
    private $OrganizationModel;

    public function init() {
        /* @var $this FacultyController */
        $this->validator = new FormValidator();
        /* @var $this FacultyController */
        $this->FacultyModel = new FacultyModel();
        /* @var $this FacultyController */
        $this->OrganizationModel = new OrganizationModel();
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0);

        $faculties = $this->FacultyModel->gets($args, $p, $ppp);
        $total_faculties = $this->FacultyModel->counts($args);
        $this->viewData['faculties'] = $faculties;
        $this->viewData['total'] = $total_faculties;
        $this->viewData['paging'] = $total_faculties > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/faculty/index/p/", $total_faculties, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $faculty = $this->FacultyModel->get($id);

        if (!$faculty) {
            $this->layout = "404";
            return;
        }
        if ($_POST)
            $this->do_edit($faculty);
        $args = '';
        $organizations = $this->OrganizationModel->get_all($args);
        $this->viewData['message'] = $this->message;
        $this->viewData['organizations'] = $organizations;
        $this->viewData['faculty'] = $faculty;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($faculty) {
        $title = trim($_POST['title']);
        $org = trim($_POST['organization_id']);

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";
        if ($org == 0)
            $this->message['error'][] = "Organization cannot be empty.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $this->FacultyModel->update(array('title' => $title, 'organization_id' => $org, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $faculty['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $faculty, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/faculty/edit/id/$faculty[id]/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $faculty = $this->FacultyModel->get($id);
        if (!$faculty)
            return;

        $this->FacultyModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function actionAdd() {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add();
        $args = '';
        $organizations = $this->OrganizationModel->get_all($args);
        $this->viewData['message'] = $this->message;
        $this->viewData['organizations'] = $organizations;
        $this->render('add', $this->viewData);
    }

    private function do_add() {
        $title = trim($_POST['title']);
        $org = trim($_POST['organization_id']);


        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";
        if ($org == 0)
            $this->message['error'][] = "Organization cannot be empty.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $faculty_id = $this->FacultyModel->add($title, $org, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/faculty/edit/id/$faculty_id/?s=1");
    }

}

?>
