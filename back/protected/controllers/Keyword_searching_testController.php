<?php

class Keyword_searching_testController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $KeywordModel;

    public function init() {
        $this->validator = new FormValidator();
        $this->KeywordModel = new Keyword_searching_test_Model();
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0);

        $keywords = $this->KeywordModel->gets($args, $p, $ppp);
        $total_keywords = $this->KeywordModel->counts($args);
        $this->viewData['keywords'] = $keywords;
        $this->viewData['total'] = $total_keywords;
        $this->viewData['paging'] = $total_keywords > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/keyword_searching_test/index/p/", $total_keywords, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $keyword = $this->KeywordModel->get($id);

        if (!$keyword) {
            $this->layout = "404";
            return;
        }
        if ($_POST)
            $this->do_edit($keyword);

        $this->viewData['message'] = $this->message;
        $this->viewData['keyword'] = $keyword;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($keyword) {
        $subject = trim($_POST['category']);
        $owner = trim($_POST['owner']);
        $featured = isset($_POST['featured']) ? 1 : 0;

        if ($this->validator->is_empty_string($subject)&& $this->validator->is_empty_string($owner))
            $this->message['error'][] = "Keyword cannot be empty.";
      
        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $this->KeywordModel->update(array('keyword_subject' => $subject, 'keyword_owner' => $owner, 'featured' => $featured, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $keyword['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $keyword, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/keyword_searching_test/edit/id/$keyword[id]/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $keyword = $this->KeywordModel->get($id);
        if (!$keyword)
            return;

        $this->KeywordModel->update(array('deleted' => 1, 'id' => $id));
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
        $subject = trim($_POST['category']);
        $owner = trim($_POST['owner']);
        $featured = isset($_POST['featured']) ? 1 : 0;


        if ($this->validator->is_empty_string($subject) && $this->validator->is_empty_string($owner))
            $this->message['error'][] = "Keyword cannot be empty.";
        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $keyword_id = $this->KeywordModel->add($subject, $owner, $featured, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/keyword_searching_test/edit/id/$keyword_id/?s=1");
    }

    public function actionSet_featured($id, $featured) {
        $keyword = $this->KeywordModel->get($id);
        if (!$keyword)
            return;
        echo 'aaa';
        $this->KeywordModel->update(array('featured' => $featured, 'last_modified' => time(), 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $keyword, 'Featured' => $featured));
    }

}

?>
