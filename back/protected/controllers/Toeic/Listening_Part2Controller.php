<?php

class Listening_Part2Controller extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $Listening_Part2Model;
    private $ListeningModel;

    public function init() {
        /* @var $this ListeningController */
        $this->validator = new FormValidator();
        /* @var $this ListeningController */
        $this->Listening_Part2Model = new Toeic_Listening_Part2_Model();
        $this->ListeningModel = new Toeic_ListeningModel();
    }

    public function actionIndex($lid, $p = 1) {
        $this->CheckPermission();
        $listening_id = $lid;

        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'lid' => $listening_id, 'deleted' => 0);
        $listening_part2 = $this->Listening_Part2Model->gets($args, $p, $ppp);
        $total_listening_part2 = $this->Listening_Part2Model->counts($args);
        $listening = $this->ListeningModel->get($listening_id);

        $this->viewData['listening_part2'] = $listening_part2;
        $this->viewData['li'] = $lid;
        $this->viewData['total'] = $total_listening_part2;
        $this->viewData['listening'] = $listening;
        $this->viewData['paging'] = $total_listening_part2 > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toeic/listening_part2/index/lid/" . $listening_id . "/p/", $total_listening_part2, $p) : "";
        $this->render('index', $this->viewData);
    }

    public function actionEdit($lid, $id = 0) {
        $this->CheckPermission();
        $listening_part2 = $this->Listening_Part2Model->get($id);

        if (!$listening_part2) {
            $this->layout = "404";
            return;
        }
        if ($_POST)
            $this->do_edit($listening_part2, $lid);
        $this->viewData['message'] = $this->message;
        $this->viewData['listening_part2'] = $listening_part2;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($listening_part2, $lid) {
        $title = trim($_POST['title']);
        $answer = trim($_POST['answer']);

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Name of listening part 2 test cannot be empty.";
        if ($answer == 0)
            $this->message['error'][] = "Choose Answer of listening part 2.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
 
        $file = $_FILES['sound'];
        $sound = $listening_part2['lsound'];
        if (isset($file['sound'])) {
            $sound = HelperApp::upload_audio($file);
        }
            
        
        $this->Listening_Part2Model->update(array('title' => $title, 'answer' => $answer, 'lsound' => $sound,
            'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $listening_part2['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $listening_part2, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toeic/listening_part2/edit/id/$listening_part2[id]/lid/$lid?s=1");
    }

    public function actionDelete($id, $lid) {
        $this->CheckPermission();

        $listening = $this->Listening_Part2Model->get($id);
        if (!$listening)
            return;

        $this->Listening_Part2Model->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function actionAdd($lid) {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add($lid);
        $this->viewData['li'] = $lid;
        $this->viewData['message'] = $this->message;
        $this->render('add', $this->viewData);
    }

    private function do_add($lid) {
        $title = trim($_POST['title']);
        $answer = trim($_POST['answer']);
        $sound = $_FILES['sound'];
        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Name of listening part 2 test cannot be empty.";
        if ($answer == 0)
            $this->message['error'][] = "Choose Answer of listening part 2.";
        if ($this->validator->is_empty_string($sound['name']))
            $this->message['error'][] = "Upload Sound listening part 2 fail.";
        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        $sound1 = HelperApp::upload_audio($sound);
        $author = UserControl::getId();
        $listening_part2_id = $this->Listening_Part2Model->add($lid, $title, $answer, $sound1, $author, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toeic/listening_part2/edit/lid/$lid/id/$listening_part2_id/?s=1");
    }

}

?>
