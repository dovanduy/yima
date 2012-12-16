<?php

class SpeakingController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $SpeakingModel;

    public function init() {
        $this->validator = new FormValidator();
        $this->SpeakingModel = new SpeakingModel();
    }

    public function actionIndex($part, $p = 1) {

        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $speakings = $this->SpeakingModel->gets($args, $p, $ppp, $part);
        $total = $this->SpeakingModel->counts($args, $part);
        $this->viewData['part'] = $part;
        $this->viewData['speakings'] = $speakings;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/speaking/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($part, $id = 0) {
        $this->CheckPermission();
        $speaking = $this->SpeakingModel->get($id);
        if (!$speaking)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($speaking, $part);



        $this->viewData['message'] = $this->message;
        $this->viewData['speaking'] = $speaking;
        $this->render('edit_' . $part, $this->viewData);
    }

    private function do_edit($speaking, $part) {
        if ($part == 1 || $part == 2) {
            $title = $_POST['title'];
            $level = $_POST['level'];
            $source = $_POST['source'];
            $keyword = $_POST['keyword'];
            $subject = $_POST['subject'];

            $sound_1 = $_FILES['sound_1'];

            if ($this->validator->is_empty_string($title))
                $this->message['error'][] = "Title cannot be empty.";
            if ($this->validator->is_empty_string($source))
                $this->message['error'][] = "Source cannot be empty.";
            if ($this->validator->is_empty_string($keyword))
                $this->message['error'][] = "Keyword cannot be empty.";
            if ($this->validator->is_empty_string($subject))
                $this->message['error'][] = "Subject cannot be empty.";
            if ($_FILES['sound_1'])
                $sound1 = HelperApp::upload_toefl_audio($sound_1, 'speaking');
            else
                $sound1 = $speaking['ssound'];

            $this->SpeakingModel->update(array('title' => $title, 'level' => $level, 'keyword' => $keyword, 'source' => $source, 'speaking_part' => $part, 'last_modified' => time(),
                'ssound' => $sound1, 'subject' => $subject,
                'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $speaking['id']));
            HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $speaking, 'Dữ liệu mới' => $_POST));
            $this->redirect(Yii::app()->request->baseUrl . "/toefl/speaking/edit/id/$speaking[id]/part/$part/?s=1");
        }
        if ($part == 3 || $part == 4) {
            $title = $_POST['title'];
            $level = $_POST['level'];
            $source = $_POST['source'];
            $keyword = $_POST['keyword'];
            $subject = $_POST['subject'];
            $direction = $_POST['direction'];
            $content = $_POST['content'];

            $image = $_FILES['image'];
            $sound_1 = $_FILES['sound_1'];
            $sound_2 = $_FILES['sound_2'];
            $sound_3 = $_FILES['sound_3'];

            if ($this->validator->is_empty_string($title))
                $this->message['error'][] = "Title cannot be empty.";
            if ($this->validator->is_empty_string($source))
                $this->message['error'][] = "Source cannot be empty.";
            if ($this->validator->is_empty_string($keyword))
                $this->message['error'][] = "Keyword cannot be empty.";
            if ($this->validator->is_empty_string($subject))
                $this->message['error'][] = "Subject cannot be empty.";
            if ($this->validator->is_empty_string($direction))
                $this->message['error'][] = "Direction cannot be empty.";
            if ($this->validator->is_empty_string($content))
                $this->message['error'][] = "Reading Text cannot be empty.";
            if ($level == 0)
                $this->message['error'][] = "Please choose a level.";

            if (count($this->message['error'])) {
                $this->message['success'] = false;
                return false;
            }
            if (!$this->validator->is_empty_string($sound_1['name']))
                $sound1 = HelperApp::upload_toefl_audio($sound_1, 'speaking');
            else
                $sound1 = $speaking['ssound'];
            if (!$this->validator->is_empty_string($sound_2['name']))
                $sound2 = HelperApp::upload_toefl_audio($sound_2, 'speaking');
            else
                $sound2 = $speaking['lsound'];
            if (!$this->validator->is_empty_string($sound_3['name']))
                $sound3 = HelperApp::upload_toefl_audio($sound_3, 'speaking');
            else
                $sound3 = $speaking['introsound'];



            if (!$this->validator->is_empty_string($image['name'])) {
                $resize = HelperApp::resize_images_toefl($image, HelperApp::get_toefl_sizes(), 'speaking');
                $img = $resize['img'];
                $thumbnail = $resize['thumbnail'];
            } else {
                $img = $speaking['limg'];
                $thumbnail = $speaking['thumbnail'];
            }


            $this->SpeakingModel->update(array('title' => $title, 'level' => $level, 'keyword' => $keyword, 'source' => $source, 'speaking_part' => $part, 'content' => $content, 'last_modified' => time(),
                'limg' => $img, 'thumbnail' => $thumbnail, 'lsound' => $sound2, 'subject' => $subject, 'ssound' => $sound1, 'direction' => $direction, 'dsound' => $sound3, 'introsound' => $sound3,
                'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $speaking['id']));
            HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $speaking, 'Dữ liệu mới' => $_POST));
            $this->redirect(Yii::app()->request->baseUrl . "/toefl/speaking/edit/id/$speaking[id]/part/$part/?s=1");
        }
        if ($part == 5 || $part == 6) {
            $title = $_POST['title'];
            $level = $_POST['level'];
            $source = $_POST['source'];
            $keyword = $_POST['keyword'];
            $subject = $_POST['subject'];

            $image = $_FILES['image'];
            $sound_1 = $_FILES['sound_1'];
            $sound_2 = $_FILES['sound_2'];

            // print_r($speaking);die;

            if ($this->validator->is_empty_string($title))
                $this->message['error'][] = "Title cannot be empty.";
            if ($this->validator->is_empty_string($source))
                $this->message['error'][] = "Source cannot be empty.";
            if ($this->validator->is_empty_string($keyword))
                $this->message['error'][] = "Keyword cannot be empty.";
            if ($this->validator->is_empty_string($subject))
                $this->message['error'][] = "Subject cannot be empty.";

            if (!$this->validator->is_empty_string($sound_1['name']))
                $sound1 = HelperApp::upload_toefl_audio($sound_1, 'speaking');
            else
                $sound1 = $speaking['ssound'];
            if (!$this->validator->is_empty_string($sound_2['name']))
                $sound2 = HelperApp::upload_toefl_audio($sound_2, 'speaking');
            else
                $sound2 = $speaking['lsound'];

            if (!$this->validator->is_empty_string($image['name'])) {
                $resize = HelperApp::resize_images_toefl($image, HelperApp::get_toefl_sizes(), 'speaking');
                $img = $resize['img'];
                $thumbnail = $resize['thumbnail'];
            } else {
                $img = $speaking['limg'];
                $thumbnail = $speaking['thumbnail'];
            }

            $this->SpeakingModel->update(array('title' => $title, 'level' => $level, 'keyword' => $keyword, 'source' => $source, 'speaking_part' => $part, 'last_modified' => time(),
                'limg' => $img, 'thumbnail' => $thumbnail, 'lsound' => $sound2, 'subject' => $subject, 'ssound' => $sound1,
                'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $speaking['id']));
            HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $speaking, 'Dữ liệu mới' => $_POST));
            $this->redirect(Yii::app()->request->baseUrl . "/toefl/speaking/edit/id/$speaking[id]/part/$part/?s=1");
        }
    }

    public function actionAdd($part) {

        $this->CheckPermission();
        if ($_POST || $_FILES) {
            $this->do_add($part);
        }
        $this->viewData['message'] = $this->message;
        $this->render('add_' . $part, $this->viewData);
    }

    private function do_add($part) {

        if ($part == 1 || $part == 2) {
            $title = $_POST['title'];
            $level = $_POST['level'];
            $source = $_POST['source'];
            $keyword = $_POST['keyword'];
            $subject = $_POST['subject'];

            $sound_1 = $_FILES['sound_1'];
            if (!$_FILES['sound_1'])
                $this->message['error'][] = "Sound upload fail.";
            if ($this->validator->is_empty_string($title))
                $this->message['error'][] = "Title cannot be empty.";
            if ($this->validator->is_empty_string($source))
                $this->message['error'][] = "Source cannot be empty.";
            if ($this->validator->is_empty_string($keyword))
                $this->message['error'][] = "Keyword cannot be empty.";
            if ($this->validator->is_empty_string($subject))
                $this->message['error'][] = "Subject cannot be empty.";
            if (count($this->message['error'])) {
                $this->message['success'] = false;
                return false;
            }


            $sound1 = HelperApp::upload_toefl_audio($sound_1, 'speaking');
            $author = UserControl::getId();
            $speaking_id = $this->SpeakingModel->add_part1($title, $level, $source, $part, $keyword, $subject, $sound1, $author, time());
            HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
            $this->redirect(Yii::app()->request->baseUrl . "/toefl/speaking/edit/id/$speaking_id/part/$part/?s=1");
        }
        if ($part == 3 || $part == 4) {
            $title = $_POST['title'];
            $level = $_POST['level'];
            $source = $_POST['source'];
            $keyword = $_POST['keyword'];
            $subject = $_POST['subject'];
            $direction = $_POST['direction'];
            $content = $_POST['content'];

            $image = $_FILES['image'];
            $sound_1 = $_FILES['sound_1'];
            $sound_2 = $_FILES['sound_2'];
            $sound_3 = $_FILES['sound_3'];

            if ($this->validator->is_empty_string($title))
                $this->message['error'][] = "Title cannot be empty.";
            if ($this->validator->is_empty_string($source))
                $this->message['error'][] = "Source cannot be empty.";
            if ($this->validator->is_empty_string($keyword))
                $this->message['error'][] = "Keyword cannot be empty.";
            if ($this->validator->is_empty_string($subject))
                $this->message['error'][] = "Subject cannot be empty.";
            if ($this->validator->is_empty_string($direction))
                $this->message['error'][] = "Direction cannot be empty.";
            if ($this->validator->is_empty_string($content))
                $this->message['error'][] = "Reading Text cannot be empty.";
            if ($level == 0)
                $this->message['error'][] = "Please choose a level.";
            if (!$this->validator->is_empty_string($image['name']) && !$this->validator->is_valid_image($image))
                $this->message['error'][] = "Image does not correct format.";
            if (!$this->validator->is_empty_string($image['name'])) {
                $resize = HelperApp::resize_images_toefl($image, HelperApp::get_toefl_sizes(), 'speaking');
                $img = $resize['img'];
                $thumbnail = $resize['thumbnail'];
            } else {
                $this->message['error'][] = "Upload image fail.";
            }

            if (count($this->message['error'])) {
                $this->message['success'] = false;
                return false;
            }
            $sound1 = HelperApp::upload_toefl_audio($sound_1, 'speaking');
            $sound2 = HelperApp::upload_toefl_audio($sound_2, 'speaking');
            $sound3 = HelperApp::upload_toefl_audio($sound_3, 'speaking');



            $author = UserControl::getId();
            $speaking_id = $this->SpeakingModel->add($title, $level, $source, $part, $keyword, $subject, $sound1, $img, $thumbnail, $sound2, $direction, $sound3, $content, $author, time());
            HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
            $this->redirect(Yii::app()->request->baseUrl . "/toefl/speaking/edit/id/$speaking_id/part/$part/?s=1");
        }

        if ($part == 5 || $part == 6) {
            $title = $_POST['title'];
            $level = $_POST['level'];
            $source = $_POST['source'];
            $keyword = $_POST['keyword'];
            $subject = $_POST['subject'];

            $image = $_FILES['image'];
            $sound_1 = $_FILES['sound_1'];
            $sound_2 = $_FILES['sound_2'];

            if ($this->validator->is_empty_string($title))
                $this->message['error'][] = "Title cannot be empty.";
            if ($this->validator->is_empty_string($source))
                $this->message['error'][] = "Source cannot be empty.";
            if ($this->validator->is_empty_string($keyword))
                $this->message['error'][] = "Keyword cannot be empty.";
            if ($this->validator->is_empty_string($subject))
                $this->message['error'][] = "Subject cannot be empty.";
            $sound1 = HelperApp::upload_toefl_audio($sound_1, 'speaking');
            $sound2 = HelperApp::upload_toefl_audio($sound_2, 'speaking');

            if (!$this->validator->is_empty_string($image['name'])) {
                $resize = HelperApp::resize_images_toefl($image, HelperApp::get_toefl_sizes(), 'speaking');
                $img = $resize['img'];
                $thumbnail = $resize['thumbnail'];
            }
            if (count($this->message['error'])) {
                $this->message['success'] = false;
                return false;
            }

            $author = UserControl::getId();
            $speaking_id = $this->SpeakingModel->add_part5($title, $level, $source, $part, $keyword, $subject, $sound1, $img, $thumbnail, $sound2, $author, time());
            HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
            $this->redirect(Yii::app()->request->baseUrl . "/toefl/speaking/edit/id/$speaking_id/part/$part/?s=1");
        }
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $speaking = $this->SpeakingModel->get($id);
        if (!$speaking)
            return;

        $this->SpeakingModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

}

?>
