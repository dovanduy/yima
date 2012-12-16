<?php

class ListeningController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $ListeningModel;

    public function init() {
        /* @var $this ListeningController */
        $this->validator = new FormValidator();
        /* @var $this ListeningController */
        $this->ListeningModel = new Toeic_ListeningModel();
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0);
        $listenings = $this->ListeningModel->gets($args, $p, $ppp);
        $total_listening = $this->ListeningModel->counts($args);

        $this->viewData['listenings'] = $listenings;
        $this->viewData['total'] = $total_listening;
        $this->viewData['paging'] = $total_listening > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toeic/listening/index/p/", $total_listening, $p) : "";
        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $listening = $this->ListeningModel->get($id);
        if (!$listening) {
            $this->layout = "404";
            return;
        }
        if ($_POST)
            $this->do_edit($listening);
        $this->viewData['message'] = $this->message;
        $this->viewData['listening'] = $listening;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($listening) {
        $title = trim($_POST['title']);
        $keyword = trim($_POST['keyword']);
        $source = trim($_POST['source']);

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty";
        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $slug = Helper::create_slug($title);
        $this->ListeningModel->update(array('title' => $title, 'slug' => $slug, 'keyword' => $keyword, 'source' => $source, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $listening['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $listening, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toeic/listening/edit/id/$listening[id]/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();

        $listening = $this->ListeningModel->get($id);
        if (!$listening)
            return;

        $this->ListeningModel->update(array('deleted' => 1, 'id' => $id));
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
        $keyword = trim($_POST['keyword']);
        $source = trim($_POST['source']);

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Name of listening test cannot be empty.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $slug = Helper::create_slug($title);
        $listening_id = $this->ListeningModel->add($title, $slug, $keyword, $source, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toeic/listening/edit/id/$listening_id/?s=1");
    }

}

?>
