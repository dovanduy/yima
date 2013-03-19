<?php

class TestNTController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $TestNTModel;
    private $SubjectModel;
    private $OrganizationModel;
    private $FacultyModel;
    private $ImageModel;
    private $QuestionModel;
    private $AnswerSCQModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();
        /* @var $TestNTModel TestNTModel */
        $this->TestNTModel = new TestNTModel();
        /* @var $SubjectModel SubjectModel */
        $this->SubjectModel = new SubjectModel();
        /* @var $OrganizationModel OrganizationModel */
        $this->OrganizationModel = new OrganizationModel();

        /* @var $FacultyModel FacultyModel */
        $this->FacultyModel = new FacultyModel();

        /* @var $ImageModel ImageModel */
        $this->ImageModel = new ImageModel();

        /* @var $QuestionModel QuestionModel */
        $this->QuestionModel = new QuestionModel();
        
        /* @var $AnswerSCQModel Answer_nt_scqModel */
        $this->AnswerSCQModel = new Answer_nt_scqModel();
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0,'disabled'=>0);
        if(isset($_GET['uid']) && $_GET['uid'])
            $args['author_id'] = $_GET['uid'];
        $testnt = $this->TestNTModel->gets($args, $p, $ppp);
        $total_testnt = $this->TestNTModel->counts($args);

        $this->viewData['testnt'] = $testnt;
        $this->viewData['total'] = $total_testnt;
        $this->viewData['paging'] = $total_testnt > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/testNT/index/p/", $total_testnt, $p) : "";

        $this->render('index', $this->viewData);
    }
    
    public function actionPending($p = 1){
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0,'disabled'=>1);
        if(isset($_GET['uid']) && $_GET['uid'])
            $args['author_id'] = $_GET['uid'];
        $testnt = $this->TestNTModel->gets($args, $p, $ppp);
        $total_testnt = $this->TestNTModel->counts($args);

        $this->viewData['testnt'] = $testnt;
        $this->viewData['total'] = $total_testnt;
        $this->viewData['paging'] = $total_testnt > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/testNT/pending/p/", $total_testnt, $p) : "";

        $this->render('pending', $this->viewData);
    }
    
    public function actionFinish($p = 1){
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0);
        if(isset($_GET['uid']) && $_GET['uid'])
            $args['user_id'] = $_GET['uid'];
        $testnt = $this->TestNTModel->get_finished_tests($args, $p, $ppp);
        $total_testnt = $this->TestNTModel->count_finished_tests($args);

        $this->viewData['testnt'] = $testnt;
        $this->viewData['total'] = $total_testnt;
        $this->viewData['paging'] = $total_testnt > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/testNT/finish/p/", $total_testnt, $p) : "";

        $this->render('finish', $this->viewData);
    }
    
    public function actionView_finished($id = 0){
        $this->CheckPermission();
        $finish = $this->TestNTModel->get_test_relationship($id);
        if (!$finish)
            $this->load_404();

        $this->viewData['finish'] = $finish;
        $this->render('view-finish', $this->viewData);
    }

    public function actionQuestion($id = 0, $p = 1) {
        $this->CheckPermission();
        $testnt = $this->TestNTModel->get($id);
        if (!$testnt)
            $this->load_404();
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";        
        $ppp = Yii::app()->params['ppp'];
        $questions = $this->QuestionModel->gets(array('test_id' => $testnt['id'],'s'=>$s, 'deleted' => 0), $p, $ppp);
        $total = $this->QuestionModel->counts(array('test_id' => $testnt['id'],'s'=>$s, 'deleted' => 0));
        
        $this->viewData['message'] = $this->message;
        $this->viewData['testnt'] = $testnt;
        $this->viewData['questions'] = $questions;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/testNT/question/id/$id/p/", $total, $p) : "";
        $this->viewData['type'] = 'question';

        $this->render('question', $this->viewData);
    }

    public function actionAdd_question($id = 0) {
        $this->CheckPermission();
        $testnt = $this->TestNTModel->get($id);
        if (!$testnt)
            $this->load_404();
        if($_POST)
            $this->do_add_question ($testnt);

        $this->viewData['message'] = $this->message;
        $this->viewData['total_question'] = $this->QuestionModel->counts(array('test_id' => $testnt['id']));
        $this->viewData['testnt'] = $testnt;
        $this->viewData['type'] = "question";

        $this->render("add-question", $this->viewData);
    }

    public function actionGet_number_question() {
        $this->layout = "empty";
        $number = $_POST['number'];
        $total = $_POST['total'];
        $this->viewData['number'] = $number + $total;
        $this->viewData['next'] = $total;
        $this->render('list-ajax-question', $this->viewData);
    }

    public function do_add_question($testnt) {
        $question = $_POST['question'];
        $choice1 = $_POST['choice1'];
        $choice2 = $_POST['choice2'];
        $choice3 = $_POST['choice3'];
        $choice4 = $_POST['choice4'];
        $right = $_POST['right'];
        $total = count($question);

        $title = "";
        $type = "scq";
        foreach ($question as $k => $v) {
            $index = $k + 1;
            //$title = $_POST['title_' . $i];
            //$type = $_POST['type_' . $i];


            if ($this->validator->is_empty_string($question[$k]))
                $this->message['error'][] = "Question " . $index . " cannot be blank";

            if ($this->validator->is_empty_string($choice1[$k]))
                $this->message['error'][] = "Choice 1 of question " . $index . " cannot be blank";

            if ($this->validator->is_empty_string($choice2[$k]))
                $this->message['error'][] = "Choice 2 of question " . $index . " cannot be blank";

            if ($this->validator->is_empty_string($choice3[$k]))
                $this->message['error'][] = "Choice 3 of question " . $index . " cannot be blank";

            if ($this->validator->is_empty_string($choice4[$k]))
                $this->message['error'][] = "Choice 4 of question " . $index . " cannot be blank";

            if ($right[$k] < 1 || $right[$k] > 4)
                $this->message['error'][] = "Please choose right choice for Question $index ";

            /*
              if ($type == 0) {
              $error = 1;
              $this->message['error'][] = "Bạn chưa chọn loại câu hỏi của Câu Hỏi: " . $i;
              }

              if ($this->validator->is_empty_string($title)) {
              $error = 1;
              $this->message['error'][] = "Tên câu hỏi " . $i . " chưa được nhập";
              }
             * 
             */
        }

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        foreach ($question as $k => $v) {
            $question_id = $this->QuestionModel->add($title, $testnt['id'], $question[$k], $type, $testnt['author_id'], time());
            $answer_id = $this->AnswerSCQModel->add($question_id, $choice1[$k], $choice2[$k], $choice3[$k], $choice4[$k], $right[$k]);
        }

        $this->redirect(Yii::app()->request->baseUrl . "/testNT/question/id/$testnt[id]/?s=1");
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $testnt = $this->TestNTModel->get($id);
        if (!$testnt)
            $this->load_404();

        $subject = $this->SubjectModel->get_all();
        $organization = $this->OrganizationModel->get_to_list();
        $section = $this->TestNTModel->get_section();


        if ($_POST)
            $this->do_edit($testnt);

        $this->viewData['subject'] = $subject;
        $this->viewData['organization'] = $organization;
        $this->viewData['section'] = $section;
        $this->viewData['message'] = $this->message;
        $this->viewData['testnt'] = $testnt;
        $this->viewData['type'] = "general";

        $this->render('edit', $this->viewData);
    }

    private function do_edit($testnt) {
        $title = trim($_POST['title']);
        $descrip = $_POST['descrip'];
        $organization = $_POST['organization'];
        $faculty = isset($_POST['faculty']) ? $_POST['faculty'] : 0;
        $subject = isset($_POST['subject']) ? $_POST['subject'] : 0;
        $section = $_POST['section'];
        $price = (int) $_POST['price'];
        $attach_file = $_FILES['attach_file'];


        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";

        if (!$this->validator->is_empty_string($attach_file['name']) && $attach_file['type'] != "application/pdf" || (int) $attach_file['size'] > 3145728)
            $this->message['error'][] = "Scan file's format must be PDF, max size 3MB";

        if ($organization == 0)
            $this->message['error'][] = "Choose a Organization.";

        if ($subject == 0)
            $this->message['error'][] = "Choose a Subject.";

        if (!$this->OrganizationModel->is_exist_group($organization, $faculty, $subject))
            $this->message['error'][] = "Please choose correct organization, faculty, subject.";


        if ($section == 0)
            $this->message['error'][] = "Choose a Section.";

        if (!is_numeric($price) || $price < 0 || $price % 500 != 0)
            $this->message['error'][] = "Price must be a numeric, greater than 1000 and divisible by 500";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $pdf_file = $testnt['attach_file'];

        if (!$this->validator->is_empty_string($attach_file['name'])) {
            @unlink(Yii::app()->params['upload_dir'] . $testnt['attach_file']);
            $name = Helper::create_slug($testnt['title']) . "-" . $testnt['id'];
            $pdf_file = HelperApp::upload_file($attach_file, $name);
        }

        $group_id = $this->OrganizationModel->get_group($organization, $faculty, $subject);

        $this->TestNTModel->update(array('title' => $title, 'description' => $descrip, 'attach_file' => $pdf_file, 'group_id' => $group_id['id'], 'section_id' => $section, 'price' => $price,
            'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $testnt['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $testnt, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/testNT/edit/id/$testnt[id]/?s=1");
    }

    public function actionImage($id = 0) {
        $this->CheckPermission();
        $testnt = $this->TestNTModel->get($id);
        if (!$testnt)
            $this->load_404();

        $list_folders = $this->get_exam_folder();
        $other_images = array();
        $images = $this->ImageModel->get_image_test(array('ref_type' => 'test_nt', 'ref_id' => $id), 1, 1000);
        $choose_folder = isset($_GET['folder']) ? trim($_GET['folder']) : "";

        if ($images)
            $other_images = $this->ImageModel->get_all(array('main_folder' => $images[0]['main_folder'], 'sub_folder' => $images[0]['sub_folder'], 'other' => 1));

        if (!$images && $choose_folder)
            $images = $this->get_images($choose_folder);

        if ($_POST)
            $this->do_edit_image($testnt);

        $this->viewData['testnt'] = $testnt;
        $this->viewData['message'] = $this->message;
        $this->viewData['images'] = $images;
        $this->viewData['other_images'] = $other_images;
        $this->viewData['type'] = 'image';
        $this->viewData['exam_folders'] = $list_folders;
        $this->viewData['folder'] = $choose_folder;
        $this->render('image', $this->viewData);
    }

    private function do_edit_image($testnt) {
        $images = isset($_POST['images']) ? $_POST['images'] : array();

        $this->ImageModel->delete_all_image_test('test_nt', $testnt['id']);
        foreach ($images as $k => $v) {
            $this->ImageModel->add_image_test($k, 'test_nt', $testnt['id']);
        }

        $this->redirect(Yii::app()->request->baseUrl . "/testNT/image/id/$testnt[id]/?s=1");
    }

    public function actionFilter_search() {
        $this->CheckPermission();
        $oid = $_GET['oid'] ? $_GET['oid'] : 0;
        $fid = $_GET['fid'];
        $sid = $_GET['sid'];
        $faculty_html = '<option value="0">-- Faculty --</option>';
        $subject_html = '<option value="0">-- Subject --</option>';
        $subject_args = array('disabled' => 0, 'deleted' => 0, 'organization_id' => $oid, 'faculty_id' => $fid);

        $faculties = $this->FacultyModel->get_all(array('organization_id' => $oid));
        $subjects = $this->SubjectModel->gets($subject_args, 1, 2000);

        foreach ($faculties as $k => $v) {
            $selected = "";
            if ($v['id'] == $fid)
                $selected = "selected";
            $faculty_html.= '<option value="' . $v['id'] . '" ' . $selected . '>' . $v['title'] . '</option>';
        }

        foreach ($subjects as $k => $v) {
            $selected = "";
            if ($v['id'] == $sid)
                $selected = "selected";
            $subject_html.= '<option value="' . $v['id'] . '" ' . $selected . '>' . $v['title'] . '</option>';
        }

        echo json_encode(array('subject_html' => $subject_html, 'faculty_html' => $faculty_html));
    }

    public function actionDelete($id) {
        $this->CheckPermission();

        $testnt = $this->TestNTModel->get($id);
        if (!$testnt)
            return;
        $this->TestNTModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }
    
    public function actionApprove($id) {
        $this->CheckPermission();

        $testnt = $this->TestNTModel->get($id);
        if (!$testnt)
            return;
        $this->TestNTModel->update(array('disabled' => 0, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Cập nhật', 'Dữ liệu' => array('id' => $id)));
    }
    
    public function actionDisqualify($id){
        $this->CheckPermission();

        $testnt = $this->TestNTModel->get($id);
        if (!$testnt)
            return;
        
        $message = trim($_POST['message']);
        HelperApp::email($testnt['email'], 'Bài kiểm tra '.$testnt['title'].' bị xóa', $message);
        $this->TestNTModel->update(array('deleted'=>1,'id'=>$id));
        echo $_POST['id'];
    }

    public function actionAdd() {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add();
        $organization = $this->OrganizationModel->get_to_list();
        $section = $this->TestNTModel->get_section();

        $this->viewData['organization'] = $organization;
        $this->viewData['section'] = $section;
        $this->viewData['message'] = $this->message;
        $this->render('add', $this->viewData);
    }

    private function do_add() {
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $organization = $_POST['organization'];
        $faculty = isset($_POST['faculty']) ? $_POST['faculty'] : 0;
        $subject = isset($_POST['subject']) ? $_POST['subject'] : 0;
        $section = $_POST['section'];
        $price = (int) $_POST['price'];
        $attach_file = $_FILES['attach_file'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";

        if (!$this->validator->is_empty_string($attach_file['name']) && $attach_file['type'] != "application/pdf" || (int) $attach_file['size'] > 3145728)
            $this->message['error'][] = "Scan file's format must be PDF, max size 3MB";

        if ($organization == 0)
            $this->message['error'][] = "Choose a Organization.";

        if ($subject == 0)
            $this->message['error'][] = "Choose a Subject.";

        if (!$this->OrganizationModel->is_exist_group($organization, $faculty, $subject))
            $this->message['error'][] = "Please choose correct organization, faculty, subject.";

        if ($section == 0)
            $this->message['error'][] = "Choose a Section.";

        if (!is_numeric($price) || $price < 0 || $price % 500 != 0)
            $this->message['error'][] = "Price must be a numeric, greater than 1000 and divisible by 500";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $pdf_file = "";
        $group = $this->OrganizationModel->get_group($organization, $faculty, $subject);
        $group_id = $group ? $group['id'] : 0;
        $test_id = $this->TestNTModel->add($title, Helper::create_slug($title), $description, $section, $price, 1, $group_id);

        if (!$this->validator->is_empty_string($attach_file['name'])) {
            $name = Helper::create_slug($title) . "-" . $test_id;
            $pdf_file = HelperApp::upload_file($attach_file, $name);
        }

        $this->TestNTModel->update(array('attach_file' => $pdf_file, 'id' => $test_id));

        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/testNT/edit/id/$test_id/?s=1");
    }

    public function actionEditFeatured($id, $featured) {
        $this->CheckPermission();
        if ($featured == 1) {
            $featured = 0;
        } else {
            $featured = 1;
        }

        $this->TestNTModel->update(array('featured' => $featured, 'last_modified' => time(), 'id' => $id));
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

        $this->TestNTModel->update(array('search' => $search, 'last_modified' => time(), 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $organization, 'Dữ liệu mới' => $_POST));
        echo json_encode(array('success' => 'success',));
    }

    public function actionRaw() {
        $this->CheckPermission();
        $list_folders = $this->get_exam_folder();
        $organization = $this->OrganizationModel->get_to_list();
        $section = $this->TestNTModel->get_section();
        $choose_folder = isset($_GET['folder']) ? trim($_GET['folder']) : "";

        $images = $this->get_images($choose_folder);

        if ($_POST)
            $this->do_raw($choose_folder);

        $this->viewData['images'] = $images;
        $this->viewData['folder'] = $choose_folder;
        $this->viewData['exam_folders'] = $list_folders;
        $this->viewData['message'] = $this->message;
        $this->viewData['organization'] = $organization;
        $this->viewData['section'] = $section;
        $this->render('raw', $this->viewData);
    }

    private function do_raw($choose_folder) {
        $title = trim($_POST['title']);
        //$description = $_POST['description'];
        $description = "";
        $organization = $_POST['organization'];
        $faculty = isset($_POST['faculty']) ? $_POST['faculty'] : 0;
        $subject = isset($_POST['subject']) ? $_POST['subject'] : 0;
        $section = $_POST['section'];
        $price = (int) $_POST['price'];
        $images = isset($_POST['images']) ? $_POST['images'] : array();


        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";

        /*
          if ($organization == 0)
          $this->message['error'][] = "Choose a Organization.";

          if ($subject == 0)
          $this->message['error'][] = "Choose a Subject.";

          if (!$this->OrganizationModel->is_exist_group($organization, $faculty, $subject))
          $this->message['error'][] = "Please choose correct organization, faculty, subject.";


          if ($section == 0)
          $this->message['error'][] = "Choose a Section.";
         */

        if (!is_numeric($price) || $price < 0 || $price % 500 != 0)
            $this->message['error'][] = "Price must be a numeric, greater than 1000 and divisible by 500";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $group = $this->OrganizationModel->get_group($organization, $faculty, $subject);
        $group_id = $group ? $group['id'] : 0;
        $test_id = $this->TestNTModel->add($title, Helper::create_slug($title), $description, $section, $price, 1, $group_id);
        foreach ($images as $k => $v) {
            $this->ImageModel->add_image_test($k, 'test_nt', $test_id);
        }
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        //$this->redirect(Yii::app()->request->baseUrl."/testnt/edit/id/$test_id/?s=1");
        $msg = "Bạn đã thêm thành công đề <strong>$title</strong>";
        $this->redirect(Yii::app()->request->baseUrl . "/testNT/raw/?folder=$choose_folder&s=1&msg=$msg");
    }

    private function get_images($folder) {
        $this->CheckPermission();
        $dir = Yii::app()->params['upload_dir'] . Yii::app()->params['raw_folder'] . "/" . $folder . "/";

        if (!is_dir($dir) || !$folder)
            return array();

        $files = scandir($dir);
        $tmp = array_flip($files);
        unset($tmp['.']);
        unset($tmp['..']);
        $files = array_values(array_flip($tmp));

        $images = array();
        foreach ($files as $k => $v) {
            $full_link = Yii::app()->params['raw_folder'] . "/" . $folder . "/" . $v;
            $image = $this->ImageModel->get($this->ImageModel->sesert(Yii::app()->params['raw_folder'], $folder, $v, $full_link));
            if (!$this->ImageModel->is_exist_image_test($image['id'], 'test_nt'))
                $images[$image['id']] = $image['full_link'];
        }

        return $images;
    }

    private function get_exam_folder() {
        $dir = Yii::app()->params['upload_dir'] . Yii::app()->params['raw_folder'];
        if (!is_dir($dir))
            return array();

        $folders = scandir($dir);
        $tmp = array_flip($folders);
        unset($tmp['.']);
        unset($tmp['..']);
        $folders = array_values(array_flip($tmp));

        return $folders;
    }

}

?>
