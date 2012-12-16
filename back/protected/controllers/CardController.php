<?php

class CardController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $UserModel;
    private $CardModel;

    public function init() {
        $this->validator = new FormValidator();

        /* @var $UserModel UserModel */
        $this->UserModel = new UserModel();

        /* @var $CardModel CardModel */
        $this->CardModel = new CardModel();
    }

    public function actionType($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0);

        $types = $this->CardModel->get_card_types($args, $p, $ppp);
        $total = $this->CardModel->count_card_types($args);

        $this->viewData['types'] = $types;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/card/type/p/", $total, $p) : "";

        $this->render('type', $this->viewData);
    }

    public function actionAdd_type() {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add_type();
        $this->viewData['message'] = $this->message;
        $this->render('add_type', $this->viewData);
    }

    private function do_add_type() {
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $amount = trim($_POST['amount']);


        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be blank.";
        if ($this->validator->is_empty_string($description))
            $this->message['error'][] = "Description cannot be blank.";
        if ($this->validator->is_empty_string($amount))
            $this->message['error'][] = "Amount cannot be blank.";
        if (!$this->validator->is_integer($amount))
            $this->message['error'][] = "Amount must be a number greater than zero";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $type_id = $this->CardModel->add_card_type($title, $description, $amount);
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/card/edit_type/id/$type_id/?s=1");
    }

    public function actionEdit_type($id = 0) {
        $this->CheckPermission();
        $type = $this->CardModel->get_card_type($id);
        if (!$type)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit_type($type);

        $this->viewData['message'] = $this->message;
        $this->viewData['type'] = $type;
        $this->render('edit_type', $this->viewData);
    }

    private function do_edit_type($card) {

        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $amount = trim($_POST['amount']);


        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Title cannot be blank.";
        if ($this->validator->is_empty_string($description))
            $this->message['error'][] = "Description cannot be blank.";
        if ($this->validator->is_empty_string($amount))
            $this->message['error'][] = "Amount cannot be blank.";
        if (!$this->validator->is_integer($amount))
            $this->message['error'][] = "Amount must be a number greater than zero";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $this->CardModel->update_card_type(array('title' => $title, 'description' => $description, 'deleted' => $_POST['deleted'], 'amount' => $amount, 'last_modified' => time(), 'id' => $card['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $card, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/card/edit_type/id/$card[id]/?s=1");
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->getParams()->itemAt('ppp');
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0);
        if (isset($_GET['tid']) && $_GET['tid'])
            $args['tracking_id'] = $_GET['tid'];
        if(isset($_GET['uid']) && $_GET['uid'])
            $args['user_id'] = $_GET['uid'];
        $cards = $this->CardModel->gets($args, $p, $ppp);
        $total = $this->CardModel->counts($args);

        $this->viewData['cards'] = $cards;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/card/index/p/", $total, $p) : "";

        $this->render('index', $this->viewData);
    }

    public function actionAdd() {

        $this->CheckPermission();
        if ($_POST)
            $this->do_add();
        $this->viewData['types'] = $this->CardModel->get_card_types(array('deleted' => 0));
        $this->viewData['message'] = $this->message;
        $this->render('add', $this->viewData);
    }

    private function do_add() {
        $type_id = $_POST['type'];
        $date_expired = $_POST['date_expired'];



        if ($this->validator->is_empty_string($date_expired))
            $this->message['error'][] = "Date expired cannot be blank.";
        $date_expired = explode('-', $date_expired);
        if (count($date_expired) != 3)
            $this->message['error'][] = "Date expired does not correct format.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        if (!$this->validator->is_valid_date($date_expired[0], $date_expired[1], $date_expired[2]))
            $this->message['error'][] = "Date expired does not correct format.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $type = $this->CardModel->get_card_type($type_id);
        $quantity = $this->validator->is_integer($_POST['quantity']) ? $_POST['quantity'] : 1;
        for ($i = 0; $i < $quantity; $i++) {
            $card_id = $this->CardModel->add($type_id, Ultilities::base32UUID(), strtotime("$date_expired[2]-$date_expired[1]-$date_expired[0]"), $type['amount'], $_POST['is_sold']);
            HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Thêm', 'Dữ liệu' => $_POST));
        }
        $this->redirect(Yii::app()->request->baseUrl . "/card/");
    }

    public function actionEdit($id = 0) {
        $this->CheckPermission();
        $card = $this->CardModel->get($id);
        if (!$card)
            $this->layout = "404";
        if ($_POST)
            $this->do_edit($card);
        $this->viewData['types'] = $this->CardModel->get_card_types(array('deleted' => 0));
        $this->viewData['message'] = $this->message;
        $this->viewData['card'] = $card;
        $this->render('edit', $this->viewData);
    }

    private function do_edit($card) {
        $type_id = $_POST['type'];
        $date_expired = $_POST['date_expired'];

        if ($this->validator->is_empty_string($date_expired))
            $this->message['error'][] = "Date expired cannot be blank.";
        $date_expired = explode('-', $date_expired);
        if (count($date_expired) != 3)
            $this->message['error'][] = "Date expired does not correct format.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        if (!$this->validator->is_valid_date($date_expired[0], $date_expired[1], $date_expired[2]))
            $this->message['error'][] = "Date expired does not correct format.";

        if (count($this->message['error'])) {
            $this->message['success'] = false;
            return false;
        }

        $this->CardModel->update(array('date_expired' => strtotime("$date_expired[2]-$date_expired[1]-$date_expired[0]"), 'deleted' => $_POST['deleted'], 'card_type_id' => $type_id, 'is_sold' => $_POST['is_sold'], 'is_used' => $_POST['is_used'], 'last_modified' => time(), 'id' => $card['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Sửa', 'Dữ liệu cũ' => $card, 'Dữ liệu mới' => $_POST));
        $this->redirect(Yii::app()->request->baseUrl . "/card/edit/id/$card[id]/?s=1");
    }

    public function actionDelete($id) {
        $this->CheckPermission();

        $card = $this->CardModel->get($id);
        if (!$card)
            return;

        $this->CardModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

}