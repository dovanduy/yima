<?php

class Source_testController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $Source_testModel;
    private $ReadingModel;
    private $SpeakingModel;
    private $WritingModel;
    private $ListeningModel;

    public function init() {
        $this->validator = new FormValidator();
        $this->Source_testModel = new Source_testModel();
        $this->ReadingModel = new ReadingModel();
        $this->SpeakingModel = new SpeakingModel();
        $this->WritingModel = new WritingModel();
        $this->ListeningModel = new ListeningModel();
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s);

        $source_tests = $this->Source_testModel->gets($args, $p, $ppp);
        $total = $this->Source_testModel->counts($args);

        $this->viewData['source_tests'] = $source_tests;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/toefl/source_test/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        
        $agrs = null;
        
        $source_test = $this->Source_testModel->get($id);
        $reading1 = $this->ReadingModel->get_by_part($agrs, 1);
        $reading2 = $this->ReadingModel->get_by_part($agrs, 2);
        $reading3 = $this->ReadingModel->get_by_part($agrs, 3);

        $listening1 = $this->ListeningModel->get_by_part($agrs, 1);
        $listening2 = $this->ListeningModel->get_by_part($agrs, 2);
        $listening3 = $this->ListeningModel->get_by_part($agrs, 3);
        $listening4 = $this->ListeningModel->get_by_part($agrs, 4);
        $listening5 = $this->ListeningModel->get_by_part($agrs, 5);
        $listening6 = $this->ListeningModel->get_by_part($agrs, 6);

        $speaking1 = $this->SpeakingModel->get_by_part($agrs, 1);
        $speaking2 = $this->SpeakingModel->get_by_part($agrs, 2);
        $speaking3 = $this->SpeakingModel->get_by_part($agrs, 3);
        $speaking4 = $this->SpeakingModel->get_by_part($agrs, 4);
        $speaking5 = $this->SpeakingModel->get_by_part($agrs, 5);
        $speaking6 = $this->SpeakingModel->get_by_part($agrs, 6);

        $writing1 = $this->WritingModel->get_by_part($agrs, 1);
        $writing2 = $this->WritingModel->get_by_part($agrs, 2);

        if (!$source_test)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($source_test);


        $this->viewData['reading1'] = $reading1;
        $this->viewData['reading2'] = $reading2;
        $this->viewData['reading3'] = $reading3;

        $this->viewData['listening1'] = $listening1;
        $this->viewData['listening2'] = $listening2;
        $this->viewData['listening3'] = $listening3;
        $this->viewData['listening4'] = $listening4;
        $this->viewData['listening5'] = $listening5;
        $this->viewData['listening6'] = $listening6;

        $this->viewData['speaking1'] = $speaking1;
        $this->viewData['speaking2'] = $speaking2;
        $this->viewData['speaking3'] = $speaking3;
        $this->viewData['speaking4'] = $speaking4;
        $this->viewData['speaking5'] = $speaking5;
        $this->viewData['speaking6'] = $speaking6;

        $this->viewData['writing1'] = $writing1;
        $this->viewData['writing2'] = $writing2;


        $this->viewData['message'] = $this->message;
        $this->viewData['source_test'] = $source_test;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($source_test) {
        $title = $_POST['title'];
        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be empty.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

       

        $reading1 = $_POST['reading1'];
        $reading2 = $_POST['reading2'];
        $reading3 = $_POST['reading3'];

        $listening1 = $_POST['listening1'];
        $listening2 = $_POST['listening2'];
        $listening3 = $_POST['listening3'];
        $listening4 = $_POST['listening4'];
        $listening5 = $_POST['listening5'];
        $listening6 = $_POST['listening6'];

        $speaking1 = $_POST['speaking1'];
        $speaking2 = $_POST['speaking2'];
        $speaking3 = $_POST['speaking3'];
        $speaking4 = $_POST['speaking4'];
        $speaking5 = $_POST['speaking5'];
        $speaking6 = $_POST['speaking6'];

        $writing1 = $_POST['writing1'];
        $writing2 = $_POST['writing2'];
        
       

        $this->Source_testModel->update(array('title' => $title,
            'reading1'=>$reading1,'reading2'=>$reading2,'reading3'=>$reading3,
            'listening1'=>$listening1,'listening2'=>$listening2,'listening3'=>$listening3,'listening4'=>$listening4,'listening5'=>$listening5,'listening6'=>$listening6,
            'speaking1'=>$speaking1,'speaking2'=>$speaking2,'speaking3'=>$speaking3,'speaking4'=>$speaking4,'speaking5'=>$speaking5,'speaking6'=>$speaking6,
            'writing1'=>$writing1,'writing2'=>$writing2,
            'disabled' => $_POST['disabled'], 'deleted' => $_POST['deleted'], 'last_modified' => time(), 'id' => $source_test['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $source_test, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/source_test/edit/id/$source_test[id]/?s=1");
    }

    public function actionAdd() {

        $this->CheckPermission();
        
        
        $agrs=null;

        $reading1 = $this->ReadingModel->get_by_part($agrs, 1);
        $reading2 = $this->ReadingModel->get_by_part($agrs, 2);
        $reading3 = $this->ReadingModel->get_by_part($agrs, 3);

        $listening1 = $this->ListeningModel->get_by_part($agrs, 1);
        $listening2 = $this->ListeningModel->get_by_part($agrs, 2);
        $listening3 = $this->ListeningModel->get_by_part($agrs, 3);
        $listening4 = $this->ListeningModel->get_by_part($agrs, 4);
        $listening5 = $this->ListeningModel->get_by_part($agrs, 5);
        $listening6 = $this->ListeningModel->get_by_part($agrs, 6);

        $speaking1 = $this->SpeakingModel->get_by_part($agrs, 1);
        $speaking2 = $this->SpeakingModel->get_by_part($agrs, 2);
        $speaking3 = $this->SpeakingModel->get_by_part($agrs, 3);
        $speaking4 = $this->SpeakingModel->get_by_part($agrs, 4);
        $speaking5 = $this->SpeakingModel->get_by_part($agrs, 5);
        $speaking6 = $this->SpeakingModel->get_by_part($agrs, 6);

        $writing1 = $this->WritingModel->get_by_part($agrs, 1);
        $writing2 = $this->WritingModel->get_by_part($agrs, 2);



        if ($_POST)
            $this->do_add();

        $this->viewData['reading1'] = $reading1;
        $this->viewData['reading2'] = $reading2;
        $this->viewData['reading3'] = $reading3;

        $this->viewData['listening1'] = $listening1;
        $this->viewData['listening2'] = $listening2;
        $this->viewData['listening3'] = $listening3;
        $this->viewData['listening4'] = $listening4;
        $this->viewData['listening5'] = $listening5;
        $this->viewData['listening6'] = $listening6;

        $this->viewData['speaking1'] = $speaking1;
        $this->viewData['speaking2'] = $speaking2;
        $this->viewData['speaking3'] = $speaking3;
        $this->viewData['speaking4'] = $speaking4;
        $this->viewData['speaking5'] = $speaking5;
        $this->viewData['speaking6'] = $speaking6;

        $this->viewData['writing1'] = $writing1;
        $this->viewData['writing2'] = $writing2;


        $this->viewData['message'] = $this->message;
        $this->render('add', $this->viewData);
    }

    private function do_add() {
        $title = $_POST['title'];

        $reading1 = $_POST['reading1'];
        $reading2 = $_POST['reading2'];
        $reading3 = $_POST['reading3'];

        $listening1 = $_POST['listening1'];
        $listening2 = $_POST['listening2'];
        $listening3 = $_POST['listening3'];
        $listening4 = $_POST['listening4'];
        $listening5 = $_POST['listening5'];
        $listening6 = $_POST['listening6'];

        $speaking1 = $_POST['speaking1'];
        $speaking2 = $_POST['speaking2'];
        $speaking3 = $_POST['speaking3'];
        $speaking4 = $_POST['speaking4'];
        $speaking5 = $_POST['speaking5'];
        $speaking6 = $_POST['speaking6'];

        $writing1 = $_POST['writing1'];
        $writing2 = $_POST['writing2'];

        /*
          if ($this->validator->is_empty_string($title))
          $this->message['error'][] = "Tên Source Test cannot be empty";

          if ($reading1 == 0)
          $this->message['error'][] = "Reading 01 chưa được chọn";
          if ($reading2 == 0)
          $this->message['error'][] = "Reading 02 chưa được chọn";
          if ($reading3 == 0)
          $this->message['error'][] = "Reading 03 chưa được chọn";

          if ($listening1 == 0)
          $this->message['error'][] = "Listening 01 chưa được chọn";
          if ($listening2 == 0)
          $this->message['error'][] = "Listening 02 chưa được chọn";
          if ($listening3 == 0)
          $this->message['error'][] = "Listening 03 chưa được chọn";
          if ($listening4 == 0)
          $this->message['error'][] = "Listening 04 chưa được chọn";
          if ($listening5 == 0)
          $this->message['error'][] = "Listening 05 chưa được chọn";
          if ($listening6 == 0)
          $this->message['error'][] = "Listening 06 chưa được chọn";

          if ($speaking1 == 0)
          $this->message['error'][] = "Independent Task 01 chưa được chọn";
          if ($speaking2 == 0)
          $this->message['error'][] = "Independent Task 02 chưa được chọn";
          if ($speaking3 == 0)
          $this->message['error'][] = "Integrated Task (L+R) 03 chưa được chọn";
          if ($speaking4 == 0)
          $this->message['error'][] = "Integrated Task (L+R) 04 chưa được chọn";
          if ($speaking5 == 0)
          $this->message['error'][] = "Integrated Task (L) 05 chưa được chọn";
          if ($speaking6 == 0)
          $this->message['error'][] = "Integrated Task (L) 06 chưa được chọn";

          if ($writing1 == 0)
          $this->message['error'][] = "Integrated Task chưa được chọn";
          if ($writing2 == 0)
          $this->message['error'][] = "Independent Task chưa được chọn";

          if (count($this->message['error']) > 0) {
          $this->message['success'] = false;
          return false;
          } */
        $level = 1;

        $user = UserControl::getId();

        $source_test_id = $this->Source_testModel->add($title, $level, $user, $reading1, $reading2, $reading3, $listening1, $listening2, $listening3, $listening4, $listening4, $listening5, $listening6, $speaking1, $speaking2, $speaking3, $speaking4, $speaking5, $speaking6, $writing1, $writing2, time());
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/toefl/source_test/edit/id/$source_test_id/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();
        $source_test = $this->Source_testModel->get($id);
        if (!$source_test)
            return;

        $this->Source_testModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

}

?>
