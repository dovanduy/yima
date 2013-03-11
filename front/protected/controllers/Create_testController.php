<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Create_testController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $Create_testModel;
    private $OrganizationModel;
    private $TestModel;
    private $QuestionModel;
    private $AnswerModel;
    private $FacultyModel;
    private $SubjectModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $Create_testModel Create_testModel */
        $this->Create_testModel = new Create_testModel();

        /* @var $OrganizationModel OrganizationModel */
        $this->OrganizationModel = new OrganizationModel();

        /* @var $TestModel TestModel */
        $this->TestModel = new TestModel();

        /* @var $QuestionModel QuestionModel */
        $this->QuestionModel = new QuestionModel();

        /* @var $AnswerModel AnswerModel */
        $this->AnswerModel = new AnswerModel();

        /* @var $FacultyModel FacultyModel */
        $this->FacultyModel = new FacultyModel();

        /* @var $SubjectModel SubjectModel */
        $this->SubjectModel = new SubjectModel();
    }

    public function actionIndex() {
        HelperGlobal::require_login();

        $args = array('featured' => 1);
        
        $organization = $this->OrganizationModel->gets($args);        
        $section = $this->Create_testModel->get_section();

        if ($_POST)
            $this->do_add();
        $this->viewData['section'] = $section;
        $this->viewData['organization'] = $organization;
        $this->viewData['message'] = $this->message;
        $this->render('index', $this->viewData);
    }

    private function do_add() {
        $title = trim($_POST['title']);
        $descrip = trim($_POST['descrip']);
        $organization = $_POST['organization'];
        $faculty = isset($_POST['faculty']) ? $_POST['faculty'] : 0;
        $subject = isset($_POST['subject']) ? $_POST['subject'] : 0;
        $section = $_POST['section'];
        $price = trim($_POST['price']);
        $attach_file = $_FILES['attach_file'];


        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Tên bài kiểm tra không được để trống.";
        if ($organization == 0)
            $this->message['error'][] = "Bạn chưa chọn Trường.";
        if ($subject == 0)
            $this->message['error'][] = "Bạn chưa chọn Chủ đề.";
        if ($section == 0)
            $this->message['error'][] = "Bạn chưa chọn Phân loại.";
        if ($this->validator->is_empty_string($price))
            $this->message['error'][] = "Giá tiền không được để trống.";
        if (!$this->validator->is_positive_number($price) || $price % 500 != 0)
            $this->message['error'][] = "Giá tiền phải là số và chia hết cho 500";

        if (!$this->validator->is_empty_string($attach_file['name']) && $attach_file['type'] != "application/pdf" || (int) $attach_file['size'] > 3145728)
            $this->message['error'][] = "Tài liệu scan định dạng PDF, dung lượng tối đa 3MB";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        if (!$this->OrganizationModel->is_exist_group($organization, $faculty, $subject))
            $this->message['error'][] = "Bạn vui lòng chọn Trường/Trung tâm, Khoa, Chủ đề chính xác.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        if ($price == "") {
            $price = 0;
        }

        $pdf_file = "";

        $group = $this->Create_testModel->get_with_group($organization, $faculty, $subject);

        $org = $this->Create_testModel->get_organization($organization);
        $subj = $this->Create_testModel->get_subject($subject);
        $slug = Helper::create_slug($title . '-' . $subj['title'] . '-' . $org['title']);

        $author = UserControl::getId();
        $testnt = $this->Create_testModel->add_test($title, $slug, $descrip, $group['id'], $section, $price, $author, time());

        if (!$this->validator->is_empty_string($attach_file['name'])) {
            $name = Helper::create_slug($title) . "-" . $testnt;
            $pdf_file = HelperApp::upload_file($attach_file, $name);
        }
        $this->Create_testModel->update(array('attach_file' => $pdf_file, 'id' => $testnt));
        //HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/create_test/add_question/id/$testnt/");
    }

    public function actionFilter_search() {
        HelperGlobal::require_login();
        $oid = $_GET['oid'] ? $_GET['oid'] : 0;
        $fid = $_GET['fid'];
        $sid = $_GET['sid'];
        $faculty_html = '<option value="0">-- Khoa --</option>';
        $subject_html = '<option value="0">-- Chủ đề --</option>';
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

    public function actionAdd_question($id) {
        HelperGlobal::require_login();
        $test = $this->TestModel->get($id);
        if (!$test || $test['author_id'] != UserControl::getId())
            $this->load_404();
        if ($_POST)
            $this->do_add_question($test);
        $this->viewData['message'] = $this->message;
        $this->viewData['question'] = $test;
        $this->viewData['total_question'] = $this->QuestionModel->count_by_test($id);
        $this->render('quest', $this->viewData);
    }

    public function do_add_question($test) {
        $question = $_POST['question'];
        $choice1 = $_POST['choice1'];
        $choice2 = $_POST['choice2'];
        $choice3 = $_POST['choice3'];
        $choice4 = $_POST['choice4'];
        $right = $_POST['right'];
        $note = $_POST['note'];
        $total = count($question);

        $title = "";
        $type = "scq";
        //echo "<pre>";
        //print_r($_POST);
        //echo "</pre>";
        //die;
        foreach ($question as $k => $v) {
            $index = $k + 1;
            //$title = $_POST['title_' . $i];
            //$type = $_POST['type_' . $i];


            if ($this->validator->is_empty_string($question[$k]))
                $this->message['error'][] = "Câu hỏi " . $index . " chưa được nhập";

            if ($this->validator->is_empty_string($choice1[$k]))
                $this->message['error'][] = "Câu trả lời 1 của câu " . $index . " chưa nhập";

            if ($this->validator->is_empty_string($choice2[$k]))
                $this->message['error'][] = "Câu trả lời 2 của câu " . $index . " chưa nhập";

            if ($this->validator->is_empty_string($choice3[$k]))
                $this->message['error'][] = "Câu trả lời 3 của câu " . $index . " chưa nhập";

            if ($this->validator->is_empty_string($choice4[$k]))
                $this->message['error'][] = "Câu trả lời 4 của câu " . $index . " chưa nhập";

            if ($right[$k] < 1 || $right[$k] > 4)
                $this->message['error'][] = "Bạn chưa chọn câu trả lời đúng cho câu hỏi $index ";

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
            $question_id = $this->Create_testModel->add_question($title, $test['id'], $question[$k], $type, UserControl::getId(), time());
            $answer_id = $this->Create_testModel->add_answer($question_id, $choice1[$k], $choice2[$k], $choice3[$k], $choice4[$k], $right[$k],$note[$k]);
        }

        $this->redirect(Yii::app()->request->baseUrl . "/create_test/edit/id/$test[id]/type/question/?s=1");
    }

    public function actionGet_number_question() {
        HelperGlobal::require_login();
        $this->layout = "empty";
        $number = $_POST['number'];
        $total = $_POST['total'];
        $this->viewData['number'] = $number + $total;
        $this->viewData['next'] = $total;
        $this->render('add_quest', $this->viewData);
    }

    public function actionEdit_group() {
        $test_list = $this->Create_testModel->get_test_group();
        foreach ($test_list as $t) {
            $gourp = $this->Create_testModel->get_group($t['subject_id'], $t['organization_id']);
            $this->Create_testModel->update(array('group_id' => $gourp['id'], 'id' => $t['id']));
        }
    }

    /*
      public function actionGet_faculty_by_organizaiton() {
      HelperGlobal::require_login();
      $this->layout = "empty";
      $organization = $_POST['organization_id'];
      $faculty = $this->Create_testModel->get_faculty($organization);
      $this->viewData['faculty'] = $faculty;
      $this->render('list_faculty', $this->viewData);
      }

      public function actionGet_sub() {
      HelperGlobal::require_login();
      $this->layout = "empty";
      $organization = $_POST['organization_id'];
      $faculty = $_POST['faculty_id'];

      $subject = $this->Create_testModel->get_sub($organization, $faculty);
      $this->viewData['subject'] = $subject;
      $this->render('list_subject', $this->viewData);
      } */

    public function actionDelete($id) {
        HelperGlobal::require_login();
        $question = $this->TestModel->get($id);
        if (!$question || $question['author_id'] != UserControl::getId())
            $this->load_404();

        $this->Create_testModel->update(array('deleted' => 1, 'id' => $id));
        $this->redirect(Yii::app()->request->baseUrl);
    }

    public function actionEdit($id = 0, $type = 'general') {
        HelperGlobal::require_login();
        $this->layout = "main";
        $test = $this->TestModel->get($id);
        if (!$test || $test['author_id'] != UserControl::getId())
            $this->load_404();

        $organization = $this->OrganizationModel->get_to_list();
        $section = $this->Create_testModel->get_section();
        $questions = $this->QuestionModel->get_by_test($test['id']);

        foreach ($questions as $k => $v)
            $questions[$k]['answer'] = $this->AnswerModel->get_scq_by_question($v['id']);

        if ($type == "general" && $_POST)
            $this->do_edit($test);

        $this->viewData['organization'] = $organization;
        $this->viewData['section'] = $section;
        $this->viewData['test'] = $test;
        $this->viewData['questions'] = $questions;
        $this->viewData['message'] = $this->message;
        $this->viewData['type'] = $type;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($test) {
        $title = trim($_POST['title']);
        $description = trim($_POST['descrip']);
        $organization = $_POST['organization'];
        $faculty = isset($_POST['faculty']) ? $_POST['faculty'] : 0;
        $subject = isset($_POST['subject']) ? $_POST['subject'] : 0;
        $section = $_POST['section'];
        $price = trim($_POST['price']);
        $attach_file = $_FILES['attach_file'];
        //print_r($attach_file);die;
        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Tên bài kiểm tra không được để trống.";
        if ($organization == 0)
            $this->message['error'][] = "Bạn chưa chọn trường.";
        if ($subject == 0)
            $this->message['error'][] = "Bạn chưa chọn môn học.";
        if ($section == 0)
            $this->message['error'][] = "Bạn chưa chọn phân loại.";
        if ($this->validator->is_empty_string($price))
            $this->message['error'][] = "Giá tiền không được để trống.";
        if (!$this->validator->is_positive_number($price) || $price % 500 != 0)
            $this->message['error'][] = "Giá tiền phải là số và chia hết cho 500";
        if (!$this->validator->is_empty_string($attach_file['name']) && $attach_file['type'] != "application/pdf" || (int) $attach_file['size'] > 3145728)
            $this->message['error'][] = "Tài liệu scan định dạng PDF, dung lượng tối đa 3MB";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }




        if (!$this->OrganizationModel->is_exist_group($organization, $faculty, $subject))
            $this->message['error'][] = "Bạn vui lòng chọn Trường/Trung tâm, Khoa, Chủ đề chính xác.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $pdf_file = $test['attach_file'];
        if (!$this->validator->is_empty_string($attach_file['name'])) {
            @unlink(Yii::app()->params['upload_dir'] . $test['attach_file']);
            $name = Helper::create_slug($test['title']) . "-" . $test['id'];
            $pdf_file = HelperApp::upload_file($attach_file, $name);
        }

        $group = $this->Create_testModel->get_with_group($organization, $faculty, $subject);
        $this->Create_testModel->update(array('title' => $title, 'description' => $description, 'group_id' => $group['id'], 'section_id' => $section, 'price' => $price, 'last_modified' => time(), 'attach_file' => $pdf_file, 'id' => $test['id']));
        $this->redirect(Yii::app()->request->baseUrl . "/create_test/edit/id/$test[id]/?s=1");
    }

    public function actionDelete_question($id = 0) {
        HelperGlobal::require_login();
        $question = $this->QuestionModel->get($id);
        if (!$question || $question['author_id'] != UserControl::getId())
            return;

        $this->QuestionModel->update(array('deleted' => 1, 'id' => $id));
    }

    public function actionQuestion($id) {
        HelperGlobal::require_login();
        $question = $this->QuestionModel->get($id);
        if (!$question || $question['author_id'] != UserControl::getId())
            $this->load_404();

        $answer = $this->AnswerModel->get_scq_by_question($question['id']);
        if ($_POST)
            $this->do_question($question, $answer);
        $this->viewData['question'] = $question;
        $this->viewData['answer'] = $answer;
        $this->viewData['message'] = $this->message;
        $this->render('edit_question', $this->viewData);
    }

    private function do_question($question, $anwser) {
        $title = $_POST['question'];
        $choice1 = $_POST['choice1'];
        $choice2 = $_POST['choice2'];
        $choice3 = $_POST['choice3'];
        $choice4 = $_POST['choice4'];
        $right = $_POST['right'];
        $note = $_POST['note'];

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Câu hỏi không được để trống.";

        if ($this->validator->is_empty_string($choice1))
            $this->message['error'][] = "Câu trả lời 1 không được để trống.";

        if ($this->validator->is_empty_string($choice2))
            $this->message['error'][] = "Câu trả lời 2 không được để trống.";

        if ($this->validator->is_empty_string($choice3))
            $this->message['error'][] = "Câu trả lời 3 không được để trống.";

        if ($this->validator->is_empty_string($choice4))
            $this->message['error'][] = "Câu trả lời 4 không được để trống.";

        if ($right < 1 || $right > 4)
            $this->message['error'][] = "Bạn chưa chọn câu trả lời đúng.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $this->QuestionModel->update(array('question' => $title, 'last_modified' => time(), 'id' => $question['id']));
        $this->AnswerModel->update(array('choice_1' => $choice1, 'choice_2' => $choice2, 'choice_3' => $choice3, 'choice_4' => $choice4, 'right_choice' => $right,'note'=>$note, 'id' => $anwser['id']));
        $this->redirect(Yii::app()->request->baseUrl . "/create_test/question/id/$question[id]?s=1");
    }

}

