<?php

class Listening_Part1Controller extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $Listening_Part1Model;
    private $ListeningModel;

    public function init() {
        /* @var $this ListeningController */
        $this->validator = new FormValidator();
        /* @var $this ListeningController */
        $this->Listening_Part1Model = new Toeic_Listening_Part1_Model();
        $this->ListeningModel = new Toeic_ListeningModel();
    }

    public function actionIndex($lid, $p = 1) {
        $this->CheckPermission();
        $lidstening_id = $lid;

        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'li' => $lidstening_id, 'deleted' => 0);
        $lidstening_part1 = $this->Listening_Part1Model->gets($args, $p, $ppp);
        $total_listening_part1 = $this->Listening_Part1Model->counts($args);
        $lidstening = $this->ListeningModel->get($lidstening_id);

        $this->viewData['listening_part1'] = $lidstening_part1;
        $this->viewData['li'] = $lid;
        $this->viewData['total'] = $total_listening_part1;
        $this->viewData['listening'] = $lidstening;
        $this->viewData['paging'] = $total_listening_part1 > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toeic/listening_part1/index/lid/" . $lidstening_id . "/p/", $total_listening_part1, $p) : "";
        $this->render('index', $this->viewData);
    }

    public function actionEdit($lid, $id = 0) {
        $this->CheckPermission();
        $lidstening_part1 = $this->Listening_Part1Model->get($id);
      
        if (!$lidstening_part1) {
            $this->layout = "404";
            return;
        }
        if ($_POST)
            $this->do_edit($lidstening_part1, $lid);
        $this->viewData['message'] = $this->message;
        $this->viewData['listening_part1'] = $lidstening_part1;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($lidstening_part1, $lid) {
        $title = trim($_POST['title']);
        $answer = trim($_POST['answer']);


        $image = $_FILES['image'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Name of listening part 1 test cannot be empty.";
        if ($answer == 0)
            $this->message['error'][] = "Choose Answer of listening part 1.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        if (!$this->validator->is_empty_string($image['name'])) {
            $resize = HelperApp::resize_images($image, HelperApp::get_subject_sizes());
            $img = $resize['img'];
            $thumbnail = $resize['thumbnail'];
        } else {
            $img = $lidstening_part1['img'];
            $thumbnail = $lidstening_part1['thumbnail'];
        }
        $sound = $_FILES['sound'];
        if (!$this->validator->is_empty_string($image['sound'])) {
            $sound1 = HelperApp::upload_audio($sound);
        }
        else{
            $sound1 = $lidstening_part1['lsound'];
        }


        $slug = Helper::create_slug($title);
        $this->Listening_Part1Model->update(array('title' => $title, 'answer' => $answer, 'img' => $img, 'thumbnail' => $thumbnail, 'lsound' => $sound1,
            'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $lidstening_part1['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $lidstening, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toeic/listening/edit/id/$lidstening_part1[id]/lid/$lid/?s=1");
    }

    public function actionDelete($id,$lid) {
        $this->CheckPermission();

        $lidstening = $this->Listening_Part1Model->get($id);
        if (!$lidstening)
            return;

        $this->Listening_Part1Model->update(array('deleted' => 1, 'id' => $id,'li'=>$lid));
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


        $image = $_FILES['image'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Name of listening part 1 test cannot be empty.";
        if ($answer == 0)
            $this->message['error'][] = "Choose Answer of listening part 1.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }
        if (!$this->validator->is_empty_string($image['name'])) {
            $resize = HelperApp::resize_images($image, HelperApp::get_subject_sizes());
            $img = $resize['img'];
            $thumbnail = $resize['thumbnail'];
        }
        $sound = $_FILES['sound'];
        $sound1 = HelperApp::upload_audio($sound);

        $author = UserControl::getId();
        $lidstening_part1_id = $this->Listening_Part1Model->add($lid, $title, $answer, $img, $thumbnail, $sound1, $author, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toeic/listening_part1/edit/lid/$lid/id/$lidstening_part1_id/?s=1");
    }

}

?>
