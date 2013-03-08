<?php

class SubjectController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $SubjectModel;
    private $UserModel;
    
    public function init() {
        $this->validator = new FormValidator();
        
        /* @var $SubjectModel SubjectModel */
        $this->SubjectModel = new SubjectModel();
        
        /* @var $UserModel UserModel */
        $this->UserModel = new UserModel();
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0);
        $subjects = $this->SubjectModel->gets($args, $p, $ppp);
        $total_subject = $this->SubjectModel->counts($args);

        $this->viewData['subjects'] = $subjects;
        $this->viewData['total'] = $total_subject;
        $this->viewData['paging'] = $total_subject > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/subject/index/p/", $total_subject, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $subject = $this->SubjectModel->get($id);
        if (!$subject)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($subject);

        $this->viewData['message'] = $this->message;
        $this->viewData['subject'] = $subject;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($subject) {
        $title = trim($_POST['title']);
        $priority = $_POST['priority'];
        $featured = $_POST['featured'];
        $image = $_FILES['image'];

        if ($featured != 1) {
            $featured = 0;
        }
        $search = $_POST['search'];

        if ($search != 1) {
            $search = 0;
        }

        if (!is_numeric($priority))
            $this->message['error'][] = "Priority must be numeric.";
        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Name of class cannot be empty.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        if (!$this->validator->is_empty_string($image['name'])) {
            $resize = HelperApp::resize_images($image, HelperApp::get_subject_sizes());
            $img = $resize['img'];
            $thumbnail = $resize['thumbnail'];
        } else {
            $img = $subject['img'];
            $thumbnail = $subject['thumbnail'];
        }

        $slug = Helper::create_slug($title);
        $this->SubjectModel->update(array('title' => $title, 'img' => $img, 'thumbnail' => $thumbnail, 'slug' => $slug, 'priority' => $priority, 'search' => $search, 'featured' => $featured, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $subject['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $subject, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/subject/edit/id/$subject[id]/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();

        $subject = $this->SubjectModel->get($id);
        if (!$subject)
            return;
        $this->SubjectModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
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

        $priority = ($_POST['priority']!="")?$_POST['priority']:0;
        $featured = (isset($_POST['featured']))?$_POST['featured']:0;
        if ($featured != 1) {
            $featured = 0;
        }
        $search = (isset($_POST['search']))?$_POST['search']:0;
        if ($search != 1) {
            $search = 0;
        }

        $image = $_FILES['image'];
        

        if (!is_numeric($priority))
            $this->message['error'][] = "Priority must be numeric.";

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Name of class cannot be empty.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $img='';
        $thumbnail='';
        if (!$this->validator->is_empty_string($image['name'])) {
            $resize = HelperApp::resize_images($image, HelperApp::get_subject_sizes());            
            $img = $resize['img'];
            $thumbnail = $resize['thumbnail'];
        }

        $slug = Helper::create_slug($title);
        $subject_id = $this->SubjectModel->add($title, $img,$thumbnail, $slug, $priority, $search, $featured, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/subject/edit/id/$subject_id/?s=1");
    }

    public function actionEditFeatured($id, $featured) {
        $this->CheckPermission();
        if ($featured == 1) {
            $featured = 0;
        } else {
            $featured = 1;
        }

        $this->SubjectModel->update(array('featured' => $featured, 'last_modified' => time(), 'id' => $id));
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

        $this->SubjectModel->update(array('search' => $search, 'last_modified' => time(), 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $organization, 'Dữ liệu mới' => $_POST));
        echo json_encode(array('success' => 'success',));
    }
    
    
    public function actionMod($p = 1){
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);
        $mods = $this->SubjectModel->get_mods($args, $p, $ppp);
        $total = $this->SubjectModel->count_mods($args);
        
        $this->viewData['subjects'] = $this->SubjectModel->get_all();
        $this->viewData['mods'] = $mods;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/subject/mod/p/", $total, $p) : "";

        $this->render('mod', $this->viewData);
    }
    
    public function actionSearch_mod($s = ""){
        if($this->validator->is_empty_string($s) || strlen($s) < 2)
            return false;
        
        $users = $this->UserModel->gets(array('deleted'=>0,'s'=>$s));
        $tmp = array();
        foreach($users as $v)
            $tmp[] = array('email'=>$v['email'],'user_id'=>$v['id'],'value'=>$v['email']." ($v[lastname] $v[firstname])",'title'=>$v['email']." ($v[lastname] $v[firstname])");
        echo json_encode($tmp);
    }
    
    public function actionAdd_mod(){
        $this->CheckPermission();
        $user_id = $_POST['user_id'];
        $subject_id = $_POST['subject_id'];
        
        $user = $this->UserModel->get($user_id);
        $subject = $this->SubjectModel->get($subject_id);
        
        if(!$user || !$subject)
            $this->redirect (Yii::app()->request->baseUrl."/subject/mod/");
        if($this->SubjectModel->exist_mod($subject_id, $user_id))
            $this->redirect (Yii::app()->request->baseUrl."/subject/mod/");
        
        $this->SubjectModel->add_mod($subject_id, $user_id);
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect (Yii::app()->request->baseUrl."/subject/mod/");
    }
    
    public function actionDelete_mod($sid,$uid){
        
        $this->SubjectModel->delete_mod($sid, $uid);
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('subject_id'=>$sid,'user_id'=>$uid)));
    }
}

?>
