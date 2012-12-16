<?php

class Listening_videoController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $Listening_videoModel;
    private $ListeningModel;

    public function init() {
        $this->validator = new FormValidator();
        /* @var $this Listening_videoController */
        $this->Listening_videoModel = new Listening_videoModel();
        /* @var $this Listening_videoController */
        $this->ListeningModel = new ListeningModel();
    }

    public function actionIndex($lid, $p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $videos = $this->Listening_videoModel->gets($args, $lid, $p, $ppp);
        $listening = $this->ListeningModel->get($lid);
        $total = $this->Listening_videoModel->counts($args, $lid);
        $this->viewData['videos'] = $videos;
        $this->viewData['listening'] = $listening;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/listening_video/id/'.$lid.'/p/", $total, $p) : "";
        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $video = $this->Listening_videoModel->get($id);
        if (!$video)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($video);
        $listening = $this->ListeningModel->get($video['lid']);
        $this->viewData['message'] = $this->message;
        $this->viewData['video'] = $video;
        $this->viewData['listening'] = $listening;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($video) {
        $title = trim($_POST['title']);
        $time = trim($_POST['time']);
        $image = $_FILES['file'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";
        if ($this->validator->is_empty_string($time))
            $this->message['error'][] = "Time cannot be empty.";
        if (!$this->validator->is_empty_string($time) && !is_numeric($time))
            $this->message['error'][] = "Time is invalid.";
        if (!$this->validator->is_empty_string($image['name'])) {
            if (!$this->validator->is_valid_image($image))
                $this->message['error'][] = "Image does not correct format and size.";
            
        }

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }


        if (!$this->validator->is_empty_string($image['name'])) {
            $resize = HelperApp::resize_images_toefl($image, HelperApp::get_toefl_sizes(), 'listening');
            $img = $resize['img'];
            $thumbnail = $resize['thumbnail'];
        } else {
            $img = $video['limg'];
            $thumbnail = $video['thumbnail'];
        }

        $this->Listening_videoModel->update(array('title' => $title, 'time' => $time, 'limg' => $img, 'thumbnail' => $thumbnail,
            'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $video['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $video, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/listening_video/edit/id/$video[id]/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $listening = $this->Listening_videoModel->get($id);
        if (!$listening)
            return;

        $this->Listening_videoModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function actionAdd($lid) {

        $this->CheckPermission();
        $listening = $this->ListeningModel->get($lid);
        if (!$listening)
            $this->layout = "404";
        if ($_POST)
            $this->do_add();

        $this->viewData['message'] = $this->message;
        $this->viewData['listening'] = $listening;
        $this->render('add', $this->viewData);
    }

    private function do_add() {
        $title = trim($_POST['title']);
        $time = trim($_POST['time']);
        $image = $_FILES['file'];
        $lid = $_POST['lid'];

        if (!$this->ListeningModel->listening_is_existed($lid))
            $this->message['error'][] = "This listening does not contain this video.";
        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";
        if ($this->validator->is_empty_string($time))
            $this->message['error'][] = "Time cannot be empty.";
        if (!$this->validator->is_empty_string($time) && !is_numeric($time))
            $this->message['error'][] = "Time is invalid.";
        if (!$this->validator->is_empty_string($file['name']) && !$this->validator->is_valid_image($file))
            $this->message['error'][] = "Image does not correct format and size.";
        if (!$this->validator->is_empty_string($file['name']) && !$this->validator->check_min_image_size(300, 300, $file['tmp_name']))
            $this->message['error'][] = "Image does not correct size.";

        if (!$this->validator->is_empty_string($image['name'])) {
            $resize = HelperApp::resize_images_toefl($image, HelperApp::get_toefl_sizes(), 'listening');
            $img = $resize['img'];
            $thumbnail = $resize['thumbnail'];
        } else {
            $this->message['error'][] = "Upload image fail.";
        }

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }



        $video_id = $this->Listening_videoModel->add($lid, $title, $img, $thumbnail, $time, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/listening_video/edit/id/$video_id/?s=1");
    }

}

?>
