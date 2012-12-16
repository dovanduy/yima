<?php

class ListeningController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $ListeningModel;

    public function init() {
        $this->validator = new FormValidator();
        $this->ListeningModel = new ListeningModel();
    }

    public function actionIndex($part = 1, $p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $listenings = $this->ListeningModel->gets($args, $part, $p, $ppp);
        $total = $this->ListeningModel->counts($args, $part);

        $this->viewData['part'] = $part;
        $this->viewData['listenings'] = $listenings;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/listening/index/part/'.$part.'/p/", $total, $p) : "";
        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $listening = $this->ListeningModel->get($id);
        if (!$listening)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($listening);
        $this->viewData['message'] = $this->message;
        $this->viewData['listening'] = $listening;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($listening) {
        $title = trim($_POST['title']);
        $level = $_POST['level_id'];
        $type = $_POST['type_id'];
        $test_time = $_POST['test_time'];
        $source = $_POST['source'];
        $keyword = $_POST['keyword'];
        $file = $_FILES['audio'];
        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";
        if ($level == 0)
            $this->message['error'][] = "Level cannot be empty.";
        if ($type == 0)
            $this->message['error'][] = "Type cannot be empty.";
        if (!is_numeric($test_time))
            $this->message['error'][] = "Test time is invalid";
        if ($this->validator->is_empty_string($source))
            $this->message['error'][] = "Source cannot be empty.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }
        if (!$this->validator->is_empty_string($file['name']))
            $audio = HelperApp::upload_toefl_audio($file, 'listening/listening_page');
        else
            $audio = $listening['lsound'];
        $this->ListeningModel->update(array('title' => $title, 'level' => $level, 'listening_type' => $type, 'test_time' => $test_time, 'keyword' => $keyword, 'source' => $source, 'lsound' => $audio, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $listening['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $listening, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/listening/edit/id/$listening[id]/?s=1");
    }

    public function actionAdd($part) {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add($part);
        $this->viewData['message'] = $this->message;
        $this->render('add', $this->viewData);
    }

    private function do_add($part) {
        $title = trim($_POST['title']);
        $level = $_POST['level_id'];
        $type = $_POST['type_id'];
        $test_time = $_POST['test_time'];
        $source = $_POST['source'];
        $keyword = $_POST['keyword'];
        $file = $_FILES['audio'];
        
        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";
        if ($level == 0)
            $this->message['error'][] = "Level cannot be empty.";
        if ($type == 0)
            $this->message['error'][] = "Type cannot be empty.";
        if (!is_numeric($test_time))
            $this->message['error'][] = "Test time is invalid";
        if ($this->validator->is_empty_string($source))
            $this->message['error'][] = "Source cannot be empty.";
        if ($this->validator->is_empty_string($file['name']))
             $this->message['error'][] = "Sound cannot be empty.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }
       
        $audio = HelperApp::upload_toefl_audio($file, 'listening/listening_page');
        $author = UserControl::getId();

        $listening_id = $this->ListeningModel->add($title,$level,$type,$test_time,$source,$keyword,$audio,$author,$part, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/listening/edit/id/$listening_id/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $listening = $this->ListeningModel->get($id);
        if (!$listening)
            return;

        $this->ListeningModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    /* private function do_edit_video($listening) {
      $title = trim($_POST['title']);
      $level = $_POST['level_id'];
      $type = $_POST['type_id'];
      $test_time = $_POST['test_time'];
      $source = $_POST['source'];
      $keyword = $_POST['keyword'];
      $file = $_FILES['audio'];
      if ($this->validator->is_empty_string($title))
      $this->message['error'][] = "Title không được để trống.";
      if ($level == 0)
      $this->message['error'][] = "Level không được để trống.";
      if ($type == 0)
      $this->message['error'][] = "Type không được để trống.";
      if (!$this->validator->is_numeric($test_time))
      $this->message['error'][] = "Hãy nhập lại Test Time.";
      if ($this->validator->is_empty_string($source))
      $this->message['error'][] = "Source không được để trống.";
      if ($this->validator->is_empty_string($file['name']))
      $this->message['error'][] = "Audio không phù hợp.";
      if (count($this->message['error']) > 0) {
      $this->message['success'] = false;
      return false;
      }
      $audio = HelperApp::upload_audio($file);
      $this->ListeningModel->update(array('title' => $title, 'level' => $level, 'listening_type' => $type, 'test_time' => $test_time, 'keyword' => $keyword, 'source' => $source, 'lsound' => $audio, 'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $listening['id']));
      HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $listening, 'Dữ liệu mới' => $_POST));
      $this->redirect(Yii::app()->request->baseUrl . "/toefl/listening/edit/id/$listening[id]/?s=1");
      } */
}

?>
