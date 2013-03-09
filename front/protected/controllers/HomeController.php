<?php

class HomeController extends Controller {

    private $viewData;
    private $EventModel;
    private $OrganizationModel;
    private $SubjectModel;
    private $TestModel;

    public function init() {
        /* @var $EventModel EventModel */
        $this->EventModel = new EventModel();

        /* @var $OrganizationModel OrganizationModel */
        $this->OrganizationModel = new OrganizationModel();

        /* @var $SubjectModel SubjectModel */
        $this->SubjectModel = new SubjectModel();
        
        /* @var $TestModel TestModel */
        $this->TestModel = new TestModel();
    }

    public function actions() {
        
    }

    public function actionTest() {
        $time = microtime(true);

        $con = mysql_connect("127.0.0.1", "root", "");
        mysql_select_db("mysql", $con);

        $con_time = microtime(true);

        $result = mysql_query('SELECT host,user,password FROM user;');

        $sel_time = microtime(true);

        printf("Connect time: %f\nQuery time: %f\n", $con_time - $time, $sel_time - $con_time);
    }

    public function actionIndex() {

        $nt_test = $this->TestModel->gets(array());
        //print_r($nt_test);die;
        $this->viewData['nt_test'] = $nt_test;


        $subject = $this->SubjectModel->gets(array('disabled'=>0,'deleted'=>0,'featured'=>1));
        $this->viewData['subject'] = $subject;        
        $this->render('index', $this->viewData);
    }

    public function actionContact_us() {
        $this->render('contact');
    }

    public function actionError404() {
        $this->layout = "404";
        $this->render("error");
    }
    
    public function actionHelloword(){
        echo "Hello World";
    }

}