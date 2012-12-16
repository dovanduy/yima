<?php

class CommentController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $PostModel;
    private $OrganizationModel;
    private $SubjectModel;
    private $CommentModel;

    public function init() {
        //Yii::app()->params['group'] = "4u";
        //Yii::app()->params['page'] = "comment";
        
        $this->validator = new FormValidator();

        /* @var $SubjectModel SubjectModel */
        $this->SubjectModel = new SubjectModel();

        /* @var $PostModel PostModel */
        $this->PostModel = new PostModel();

        /* @var $OrganizationModel OrganizationModel */
        $this->OrganizationModel = new OrganizationModel();

        /* @var $CommentModel CommentModel */
        $this->CommentModel = new CommentModel();
    }

    public function actionIndex($type = 'post',$p = 1) {
        $this->CheckPermission();
        $ppp = Yii::app()->params['ppp'];
        $s = isset($_GET['s']) ? $_GET['s'] : "";
        $s = strlen($s) > 2 ? $s : "";
        $args = array('s' => $s, 'deleted' => 0,'ref_type'=>$type);
        if (isset($_GET['rid']) && $_GET['rid'])
            $args['ref_id'] = $_GET['rid'];
        $comments = $this->CommentModel->gets($args, $p, $ppp);
        $total = $this->CommentModel->counts($args);

        $this->viewData['comments'] = $comments;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/comment/index/type/$type/p/", $total, $p) : "";
        $this->viewData['type'] = $type;
        $this->render('index', $this->viewData);
    }

    public function actionEdit($type,$id = 0) {
        
        $comment = $this->CommentModel->get($id,$type);
        if(!$comment)
            $this->load_404 ();
        if($_POST)
            $this->do_edit ($comment,$type);
        $this->viewData['comment'] = $comment;
        $this->viewData['message'] = $this->message;
        $this->render('edit',$this->viewData);
    }
    
    private function do_edit($comment,$type){
        $content = trim($_POST['content']);
        
        if($this->validator->is_empty_string($content))
            $this->message['error'][] = "Content cannot be blank.";
        if(count($this->message['error']) > 0)
        {
            $this->message['success'] = false;
            return false;
        }
        
        $this->CommentModel->update(array('deleted'=>$_POST['deleted'],'last_modified'=>time(),'content'=>$content,'id'=>$comment['id']));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Cập nhật', 'Dữ liệu' => array('Dữ liệu cũ'=>$comment,'Dữ liệu mới'=>$_POST,'id' => $comment['id'])));
        $this->redirect(Yii::app()->request->baseUrl."/comment/edit/type/$type/id/$comment[id]?s=1");
    }

    public function actionDelete($type,$id) {
        $this->CheckPermission();

        $comment = $this->CommentModel->get($id,$type);
        if (!$comment)
            return;
        $this->CommentModel->update(array('deleted' => 1,'last_modified'=>time(), 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

}