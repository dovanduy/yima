<?php

class PostController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $PostModel;
    private $OrganizationModel;
    private $SubjectModel;

    public function init() {
        
        Yii::app()->params['group'] = "4u";
        Yii::app()->params['page'] = "post";
        
        $this->validator = new FormValidator();

        /* @var $SubjectModel SubjectModel */
        $this->SubjectModel = new SubjectModel();

        /* @var $PostModel PostModel */
        $this->PostModel = new PostModel();

        /* @var $OrganizationModel OrganizationModel */
        $this->OrganizationModel = new OrganizationModel();
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0);
        if(isset($_GET['uid']) && $_GET['uid'])
            $args['author_id'] = $_GET['uid'];
        $posts = $this->PostModel->gets($args, $p, $ppp);
        $total = $this->PostModel->counts($args);

        $this->viewData['posts'] = $posts;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/4u/post/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {

        $this->CheckPermission();
        $post = $this->PostModel->get($id);
        if (!$post)
            $this->load_404();
        $organizations = $this->OrganizationModel->get_all(array());
        $subjects = $this->SubjectModel->get_all();
        if ($_POST)
            $this->do_edit($post, $organizations, $subjects);

        $this->viewData['message'] = $this->message;
        $this->viewData['post'] = $post;
        $this->viewData['organizations'] = $organizations;
        $this->viewData['subjects'] = $subjects;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($post) {

        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $organization_id = $_POST['organization_id'];
        $subject_id = $_POST['subject_id'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be blank";

        if (strlen($title) > 200)
            $this->message['error'][] = "Title's length maximum 200 letters";

        if ($this->validator->is_empty_string($content))
            $this->message['error'][] = "Content cannot be blank.";
        


        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }
        
        $this->PostModel->update(array('title'=>$title,'content'=>$content,'organization_id'=>$organization_id,'subject_id'=>$subject_id,'last_modified'=>time(),'deleted'=>$_POST['deleted'],'id'=>$post['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $post, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/4u/post/edit/id/$post[id]/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();

        $subject = $this->PostModel->get($id);
        if (!$subject)
            return;
        $this->PostModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

}