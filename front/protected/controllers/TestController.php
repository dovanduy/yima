<?php

class TestController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $toefl_source_testModel;
    private $TestModel;
    private $KeywordModel;
    private $QuestionModel;
    private $AnswerModel;
    private $TransactionModel;
    private $CommentModel;
    private $ReportModel;
    private $VoteModel;

    public function init() {

        /* @var $this TestController */
        $this->validator = new FormValidator();

        /* @var $this TestController */
        $this->toefl_source_testModel = new Toefl_source_testModel();
        /* @var $this TestController */
        $this->TestModel = new TestModel();
        /* @var $this TestController */
        $this->KeywordModel = new Keyword_searching_test_Model();

        /* @var $QuestionModel QuestionModel */
        $this->QuestionModel = new QuestionModel();

        /* @var $AnswerModel AnswerModel */
        $this->AnswerModel = new AnswerModel();

        /* @var $TransactionModel TransactionModel */
        $this->TransactionModel = new TransactionModel();

        /* @var $CommentModel CommentModel */
        $this->CommentModel = new CommentModel();

        /* @var $ReportModel ReportModel */
        $this->ReportModel = new ReportModel();

        /* @var $VoteModel VoteModel */
        $this->VoteModel = new VoteModel();

        $this->layout = 'search_test';
    }

    public function actionIndex($p = 1) {
        $s = isset($_GET['cate']) ? $_GET['cate'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $own = isset($_GET['own']) ? $_GET['own'] : "";
        $own = strlen($own) > 2 ? $own : "";
        $price = isset($_GET['price']) ? $_GET['price'] : "";
        $cid = isset($_GET['cid']) ? $_GET['cid'] : "";
        $oid = isset($_GET['oid']) ? $_GET['oid'] : "";
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $args = array('search_cate' => $s, 'search_own' => $own, 'search_price' => $price, 'subject_id' => $cid, 'organization_id' => $oid,'disabled'=>0);

        $tests = $this->TestModel->gets($args, $p, $ppp);
        $total_tests = $this->TestModel->counts($args);

        $test_categories = $this->TestModel->get_test_category();
        $test_organizations = $this->TestModel->get_test_organization();

        if ($s || $own)
            $this->KeywordModel->add($s, $own, 0, time());

        $this->viewData['tests'] = $tests;
        $this->viewData['total'] = $total_tests;
        $this->viewData['test_categories'] = $test_categories;
        $this->viewData['test_organizations'] = $test_organizations;
        $this->viewData['paging'] = $total_tests > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/test/index/p/", $total_tests, $p) : "";
        $this->viewData['query_string'] = $this->get_query_string();
        $this->render('index', $this->viewData);
    }

    private function get_query_string() {
        $queryString = Yii::app()->request->queryString;
        $queryString = explode('&', $queryString);
        $params = array();
        foreach ($queryString as $k => $v) {
            $tmp = explode('=', $v);
            if (count($tmp) != 2)
                continue;
            $params[$tmp[0]] = $tmp[1];
        }
        return $params;
    }

    public function actionView($s = "", $p = 1) {
        $test = $this->TestModel->get_by_slug($s);
        if (!$test)
            $this->load_404();
        $this->layout = "view-test";
        $ppp = Yii::app()->params['ppp'];
        $args = array('deleted' => 0, 'ref_id' => $test['id'], 'ref_type' => 'test_nt');
        $comments = $this->CommentModel->gets($args, $p, $ppp);
        $total = $this->CommentModel->counts($args);

        $this->viewData['has_buy'] = $this->TestModel->get_user_test(UserControl::getId(), $test['id']);
        $this->viewData['post'] = $test;
        $this->viewData['comments'] = $comments;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/test/view/s/$s/p/", $total, $p) : "";
        $this->viewData['best_comment'] = $this->CommentModel->get_best_comment($test['id'], 'test_nt');
        Yii::app()->params['test'] = $test;        
        Yii::app()->params['is_page'] = "test-detail";
        $this->render('view', $this->viewData);
    }

    public function actionVote($id = 0) {
        HelperGlobal::require_login(true);
        $test = $this->TestModel->get($id);
        if (!$test)
            return;
        $result = $this->VoteModel->add($test['id'], 'test_nt', UserControl::getId(), 'post');
        if ($result)
            $this->TestModel->update(array('total_like' => $test['total_like'] + 1, 'id' => $test['id']));
        $total_vote = $this->VoteModel->count_votes('test_nt', $test['id'], 'post');
        echo json_encode(array('message' => $this->message, 'data' => array('total_vote' => $total_vote)));
    }

    public function actionUnvote($id = 0) {
        HelperGlobal::require_login();
        $post = $this->TestModel->get($id);
        if (!$post)
            return;
        $result = $this->VoteModel->remove($post['id'], 'test_nt', UserControl::getId(), 'post');
        if ($result)
            $this->TestModel->update(array('total_like' => $post['total_like'] - 1, 'id' => $post['id']));
        $total_vote = $this->VoteModel->count_votes('test_nt', $post['id'], 'post');
        echo json_encode(array('message' => $this->message, 'data' => array('total_vote' => $total_vote)));
    }

    public function actionComment($tid = 0) {
        HelperGlobal::require_login(true);
        $test = $this->TestModel->get($tid);
        if (!$test)
            $this->load_404();

        $content = trim($_POST['content']);
        if ($this->validator->is_empty_string($content))
            $this->redirect(Yii::app()->request->baseUrl . "/test/view/s/$test[slug]/");
        $ppp = Yii::app()->params['ppp'];
        $comment_id = $this->CommentModel->add($test['id'], 'test_nt', UserControl::getId(), $content);
        $this->TestModel->update(array('total_comment' => $test['total_comment'] + 1, 'id' => $test['id']));
        $total_comment = $this->CommentModel->counts(array('deleted' => 0, 'post_id' => $test['id']));
        $page = ceil($total_comment / $ppp);

        $this->redirect(Yii::app()->request->baseUrl . "/test/view/s/$test[slug]/p/$page/#comment-$comment_id");
    }

    public function actionVote_comment($id = 0) {
        HelperGlobal::require_login(true);
        $comment = $this->CommentModel->get($id, 'test_nt');
        if (!$comment)
            return;

        $result = $this->VoteModel->add($comment['id'], 'test_nt', UserControl::getId(), 'comment');
        $total_vote = $this->VoteModel->count_votes('test_nt', $comment['id'], 'comment');
        echo json_encode(array('message' => $this->message, 'data' => array('total_vote' => $total_vote)));
    }

    public function actionUnvote_comment($id = 0) {
        HelperGlobal::require_login();
        $comment = $this->CommentModel->get($id, 'test_nt');
        if (!$comment)
            return;

        $result = $this->VoteModel->remove($comment['id'], 'test_nt', UserControl::getId(), 'comment');
        $total_vote = $this->VoteModel->count_votes('test_nt', $comment['id'], 'comment');
        echo json_encode(array('message' => $this->message, 'data' => array('total_vote' => $total_vote)));
    }

    public function actionReport($type = "", $id = 0) {
        HelperGlobal::require_login();
        $list_types = array('post', 'comment');
        if (!$type || !$id || array_search($type, $list_types) === false)
            return;

        if ($type == "post")
            $item = $this->TestModel->get($id);
        else if ($type == "comment")
            $item = $this->CommentModel->get($id, 'test_nt');
        if (!$item)
            return;
        $report = $this->ReportModel->exist_report('test_nt', $id, $type);
        if ($report) {
            echo json_encode(array('message' => $this->message));
            die;
        }

        $this->ReportModel->add($id, 'test_nt', UserControl::getId(), $type);
        echo json_encode(array('message' => $this->message));
    }

    public function actionBuy($id) {
        $test = $this->TestModel->get($id);
        if (!$test)
            return;
        $amount = $this->TransactionModel->get_user_amount(UserControl::getId());
        if ($amount < $test['price'])
            $this->message['error'][] = "Bạn không đủ tiền để mua bài kiểm tra này.<br/>";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            echo json_encode(array('message' => $this->message));
            die;
        }

        $has_buy = $this->TestModel->get_user_test(UserControl::getId(), $id);
        if (!$has_buy && $test['author_id'] != UserControl::getId()){
            $this->TransactionModel->add('buy_nt_test', $id, UserControl::getId(), -$test['price'], "Mua bài kiểm tra");
            $this->TransactionModel->add('sold_test', $id, $test['author_id'], ($test['price'] * SiteOption::getTestFee()), 'Bán bài kiểm tra');
        }
        $this->TestModel->add_user_test(UserControl::getId(), $id);
        echo json_encode(array('message' => $this->message, 'data' => array('link' => Yii::app()->request->baseUrl . "/test/do/id/$id")));
    }

    public function actionDo($id = 0) {
        HelperGlobal::require_login();
        $testnt = $this->TestModel->get($id);
        $relationship = $this->TestModel->get_user_test(UserControl::getId(), $id);
        if (!$testnt || !$relationship)
            $this->load_404();

        $this->TestModel->update_user_test(array('times' => $relationship['times'] + 1, 'id' => $relationship['id']));
        $questions = $this->QuestionModel->get_by_test($testnt['id']);
        foreach ($questions as $k => $v)
            $questions[$k]['answer'] = $this->AnswerModel->get_scq_by_question($v['id']);

        if ($_POST)
            $this->do_test($testnt, $questions, $relationship['id']);

        $total_question = $this->QuestionModel->count_by_test($id);
        $this->layout = "main";
        Yii::app()->params['is_page'] = "do_test";
        $this->viewData['questions'] = $questions;
        $this->viewData['total'] = $total_question;
        $this->viewData['testnt'] = $testnt;
        $this->render('do', $this->viewData);
    }

    private function do_test($testnt, $questions, $relationship_id) {
        $user_choices = array();
        $right_choices = array();
        $total_right = 0;
        foreach ($questions as $k => $v) {
            $choice = isset($_POST['choice_' . $v['id']]) ? $_POST['choice_' . $v['id']] : 0;
            if ($choice == $v['answer']['right_choice'])
                $total_right++;
            $user_choices[$v['id']] = $choice;
            $right_choices[$v['id']] = array('title' => $v['question'], 'choice' => $v['answer']['right_choice'], 'id' => $v['id']);
        }

        $finished_id = $this->TestModel->add_test_relationship($relationship_id, serialize(array('user_choices' => $user_choices, 'right_choices' => $right_choices)), count($questions), $total_right);
        $this->redirect(Yii::app()->request->baseUrl . "/test/finished/id/$finished_id/?s=1");
    }

    public function actionFinished($id = 0) {
        HelperGlobal::require_login();
        $finish = $this->TestModel->get_test_relationship($id);
        if (!$finish || $finish['user_id'] != UserControl::getId())
            $this->load_404();

        $this->layout = "main";
        $this->viewData['finish'] = $finish;
        $this->render('finish', $this->viewData);
    }

}