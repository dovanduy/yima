<?php

class OrganizationController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $OrganizationModel;
    private $GradeModel;
    private $SubjectModel;
    private $FacultyModel;
    
    public function init() {
        $this->validator = new FormValidator();
        /* @var $OrganizationModel OrganizationModel */
        $this->OrganizationModel = new OrganizationModel();
        
        /* @var $GradeModel GradeModel */
        $this->GradeModel = new GradeModel();
        
        /* @var $SubjectModel SubjectModel */
        $this->SubjectModel = new SubjectModel();
        
        /* @var $FacultyModel FacultyModel */
        $this->FacultyModel = new FacultyModel();
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0);
        $organizations = $this->OrganizationModel->gets($args, $p, $ppp);
        $total_organization = $this->OrganizationModel->counts($args);

        $this->viewData['organizations'] = $organizations;
        $this->viewData['total'] = $total_organization;
        $this->viewData['paging'] = $total_organization > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/organization/index/p/", $total_organization, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $organization = $this->OrganizationModel->get($id);
        $agrs = '';
        $grades = $this->GradeModel->get_all($agrs);
        if (!$organization)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($organization);

        $this->viewData['message'] = $this->message;
        $this->viewData['organization'] = $organization;
        $this->viewData['grades'] = $grades;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($organization) {
        $title = trim($_POST['title']);
        $grade = $_POST['grade_id'];
        $priority = $_POST['priority'];
        $featured = $_POST['featured'];

        if ($featured != 1) {
            $featured = 0;
        }

        $search = $_POST['search'];

        if ($search != 1) {
            $search = 0;
        }

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Name of school cannot be empty.";
        if ($grade == 0)
            $this->message['error'][] = "Type of school cannot be empty.";
        if (!is_numeric($priority))
            $this->message['error'][] = "Priority must be numeric.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }
        $slug = Helper::create_slug($title);
        
        if ($slug != $organization['slug']) {
            $count_slug = $this->OrganizationModel->check_exist_slug($slug);
            if ($count_slug > 0)
                $slug = $slug . "-" . $count_slug;
        }

        $this->OrganizationModel->update(array('title' => $title, 'slug' => $slug, 'grade' => $grade, 'priority' => $priority, 'search' => $search, 'featured' => $featured, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $organization['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $organization, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/organization/edit/id/$organization[id]/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $organization = $this->OrganizationModel->get($id);
        if (!$organization)
            return;

        $this->OrganizationModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function actionAdd() {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add();
        $agrs = '';
        $grades = $this->GradeModel->gets($agrs);
        $this->viewData['message'] = $this->message;
        $this->viewData['grades'] = $grades;
        $this->render('add', $this->viewData);
    }

    private function do_add() {
        $title = trim($_POST['title']);
        $grade_id = $_POST['grade_id'];
        $priority = $_POST['priority'];
        $featured = $_POST['featured'];

        if ($featured != 1) {
            $featured = 0;
        }

        $search = $_POST['search'];

        if ($search != 1) {
            $search = 0;
        }

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Name of school cannot be empty.";
        if ($grade_id == 0)
            $this->message['error'][] = "Type of school cannot be empty.";
        if (!is_numeric($priority))
            $this->message['error'][] = "Priority must be numeric.";
        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $organization_id = $this->OrganizationModel->add($title, $grade_id, $priority, $search, $featured, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/organization/edit/id/$organization_id/?s=1");
    }

    public function actionEditFeatured($id, $featured) {

        $this->CheckPermission();
        if ($featured == 1) {
            $featured = 0;
        } else {
            $featured = 1;
        }
        $this->OrganizationModel->update(array('featured' => $featured, 'last_modified' => time(), 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $organization, 'Dữ liệu mới' => $_POST));
        echo json_encode(array('success' => 'success',));
    }

    public function actionEditSearch($id, $search) {

        $this->CheckPermission();
        if ($search == 1) {
            $search = 0;
        } else {
            $search = 1;
        }
        $this->OrganizationModel->update(array('search' => $search, 'last_modified' => time(), 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $organization, 'Dữ liệu mới' => $_POST));
        echo json_encode(array('success' => 'success',));
    }

    public function actionGroup($id = 0,$p = 1){
        $this->CheckPermission();
        $organization = $this->OrganizationModel->get($id);
        if(!$organization)
            $this->load_404 ();
        $ppp = 12;
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s,'organization_id'=>$id);
        
        if($_POST)
            $this->do_group ($organization);
        
        $groups = $this->OrganizationModel->get_groups($args,$p,$ppp);
        $total = $this->OrganizationModel->count_groups($args);
        
        $this->viewData['organization'] = $organization;
        $this->viewData['subjects'] = $this->SubjectModel->gets(array('disabled'=>0),1,100);
        $this->viewData['faculties'] = $this->FacultyModel->get_all_by_organization(array('organization_id'=>$id));
        $this->viewData['groups'] = $groups;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl."/organization/group/id/$id/p/", $total, $p) : "";
        $this->viewData['message'] = $this->message;
        $this->render('group',$this->viewData);
    }
    
    public function do_group($organization){
        $subject = $_POST['subject'];
        $faculty = $_POST['faculty'];
        $sub_number = trim($_POST['sub_number']);
        if(($faculty == 0 && $subject == 0) || $this->OrganizationModel->is_exist_group($organization['id'], $faculty, $subject))
            $this->redirect (Yii::app()->request->baseUrl."/organization/group/id/$organization[id]");
        
        $group_id = $this->OrganizationModel->add_group($organization['id'], $faculty, $subject,$sub_number);
        $this->redirect (Yii::app()->request->baseUrl."/organization/group/id/$organization[id]?s=1");
    }
    
    public function actionDelete_group($id){
        $this->CheckPermission();        
        $this->OrganizationModel->delete_group($id);
    }
}

?>
