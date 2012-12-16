<?php

class ClassController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $ClassModel;
    private $OrganizationModel;

    public function init() {
        $this->validator = new FormValidator();
        $this->ClassModel = new ClassModel();
        $this->OrganizationModel = new OrganizationModel();
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0);
        $classes = $this->ClassModel->gets($args, $p, $ppp);
        $total_class = $this->ClassModel->counts($args);

        $this->viewData['classes'] = $classes;
        $this->viewData['total'] = $total_class;
        $this->viewData['paging'] = $total_class > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/class/index/p/", $total_class, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $class = $this->ClassModel->get($id);
        $agrs = '';
        $organizations = $this->OrganizationModel->get_all($agrs);
        if (!$class)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($class);

        $this->viewData['message'] = $this->message;
        $this->viewData['organizations'] = $organizations;
        $this->viewData['class'] = $class;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($class) {
        $title = trim($_POST['title']);
        $org = $_POST['organization_id'];
        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";
        if ($org == 0)
            $this->message['error'][] = "School must be belong to a organization.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }
        $slug = Helper::create_slug($title);
        $this->ClassModel->update(array('title' => $title, 'slug' => $slug, 'organization_id' => $org, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $class['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $class, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/class/edit/id/$class[id]/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();

        $class = $this->ClassModel->get($id);
        if (!$class)
            return;
        $this->ClassModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function actionAdd() {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add();
        $agrs = '';
        $organizations = $this->OrganizationModel->get_all($agrs);
        $this->viewData['message'] = $this->message;
        $this->viewData['organizations'] = $organizations;
        $this->render('add', $this->viewData);
    }

    private function do_add() {
        $title = trim($_POST['title']);
        $organization_id = $_POST['organization_id'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Name of school cannot be empty.";
        if ($organization_id == 0)
            $this->message['error'][] = "School must be belong to a organization.";
        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $slug = Helper::create_slug($title);
        $class_id = $this->ClassModel->add($title, $slug, $organization_id, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/class/edit/id/$class_id/?s=1");
    }

}

?>
