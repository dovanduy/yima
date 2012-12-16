<?php

class WritingController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $WritingModel;

    public function init() {
        $this->validator = new FormValidator();
        $this->WritingModel = new WritingModel();
    }

    public function actionIndex($part, $p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $writings = $this->WritingModel->gets($args, $p, $ppp, $part);
        $total = $this->WritingModel->counts($args, $part);
        $this->viewData['part'] = $part;
        $this->viewData['writings'] = $writings;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/writing/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($part, $id = 0) {
        $this->CheckPermission();
        $writing = $this->WritingModel->get($id);
        if (!$writing)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($writing, $part);

        $this->viewData['message'] = $this->message;
        $this->viewData['writing'] = $writing;
        $this->render('edit_' . $part, $this->viewData);
    }

    private function do_edit($writing, $part) {
        if ($part == 1) {
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
                $sound1 = $writing['ssound'];
            if (!$this->validator->is_empty_string($sound_2['name']))
                $sound2 = HelperApp::upload_toefl_audio($sound_2, 'speaking');
            else
                $sound2 = $writing['lsound'];
            if (!$this->validator->is_empty_string($sound_3['name']))
                $sound3 = HelperApp::upload_toefl_audio($sound_2, 'speaking');
            else
                $sound3 = $writing['dsound'];



            if (!$this->validator->is_empty_string($image['name'])) {
                $resize = HelperApp::resize_images_toefl($image, HelperApp::get_toefl_sizes(), 'writing');
                $img = $resize['img'];
                $thumbnail = $resize['thumbnail'];
            }
            else
            {
                $img = $writing['limg'];
                $thumbnail = $writing['thumbnail'];
            }


            $this->WritingModel->update(array('title' => $title, 'level' => $level, 'keyword' => $keyword, 'source' => $source, 'writing_part' => $part, 'content' => $content, 'last_modified' => time(),
                'limg' => $img,'thumbnail'=>$thumbnail, 'ssound' => $sound1, 'subject' => $subject, 'lsound' => $sound2, 'direction' => $direction, 'dsound' => $sound3,
                'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $writing['id']));
            HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $writing, 'Dữ liệu mới' => $_POST));
            $this->redirect(Yii::app()->request->baseUrl . "/toefl/writing/edit/id/$writing[id]/part/$part/?s=1");
        }
        if ($part == 2) {
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
            $sound1 = HelperApp::upload_audio($sound_1);

            $this->WritingModel->update(array('title' => $title, 'level' => $level, 'keyword' => $keyword, 'source' => $source, 'writing_part' => $part, 'last_modified' => time(),
                'lsound' => $sound1, 'subject' => $subject,
                'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $writing['id']));
            HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $writing, 'Dữ liệu mới' => $_POST));
            $this->redirect(Yii::app()->request->baseUrl . "/toefl/writing/edit/id/$writing[id]/part/$part/?s=1");
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
        if ($part == 1) {
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
                $this->message['error'][] = "Image does not correct format and size.";
            if (count($this->message['error'])) {
                $this->message['success'] = false;
                return false;
            }
            $sound1 = HelperApp::upload_toefl_audio($sound_1, 'writing');
            $sound2 = HelperApp::upload_toefl_audio($sound_2, 'writing');
            $sound3 = HelperApp::upload_toefl_audio($sound_3, 'writing');


            $img = "";
            $thumbnail = "";
            if (!$this->validator->is_empty_string($image['name'])) {
                $resize = HelperApp::resize_images_toefl($image, HelperApp::get_toefl_sizes(), 'writing');
                $img = $resize['img'];
                $thumbnail = $resize['thumbnail'];
            }

            $author = UserControl::getId();
            $writing_id = $this->WritingModel->add($title, $level, $source, $part, $keyword, $subject, $sound1, $img, $thumbnail, $sound2, $direction, $sound3, $content, $author, time());
            HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
            $this->redirect(Yii::app()->request->baseUrl . "/toefl/writing/edit/id/$writing_id/part/$part/?s=1");
        }
        if ($part == 2) {
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
            
            $sound1 = HelperApp::upload_toefl_audio($sound_1, 'writing');

            $author = UserControl::getId();
            $writing_id = $this->WritingModel->add_part2($title, $level, $source, $part, $keyword, $subject, $sound1, $author, time());
            HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
            $this->redirect(Yii::app()->request->baseUrl . "/toefl/writing/edit/id/$writing_id/part/$part/?s=1");
        }
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $writing = $this->WritingModel->get($id);
        if (!$writing)
            return;

        $this->WritingModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

}

?>
