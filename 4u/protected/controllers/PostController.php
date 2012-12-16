<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PostController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array(), 'field' => array());
    private $validator;
    private $OrganizationModel;
    private $SubjectModel;
    private $PostModel;
    private $CommentModel;
    private $VoteModel;
    private $ReportModel;

    public function init() {
        /* @var $validator FormValidator */
        $this->validator = new FormValidator();

        /* @var $OrganizationModel OrganizationModel */
        $this->OrganizationModel = new OrganizationModel();

        /* @var $SubjectModel SubjectModel */
        $this->SubjectModel = new SubjectModel();

        /* @var $PostModel PostModel */
        $this->PostModel = new PostModel();

        /* @var $CommentModel CommentModel */
        $this->CommentModel = new CommentModel();
        
        /* @var $VoteModel VoteModel */
        $this->VoteModel = new VoteModel();
        
        /* @var $ReportModel ReportModel */
        $this->ReportModel = new ReportModel();
    }

    public function actionAdd() {
        HelperGlobal::require_login(true);
        $organizations = $this->OrganizationModel->get_all();
        $subjects = $this->SubjectModel->gets(array('deleted' => 0, 'disabled' => 0), 1, 300);
        if ($_POST)
            $this->do_add($organizations, $subjects);
        $this->layout = "no-sidebar";
        $this->viewData['organizations'] = $organizations;
        $this->viewData['subjects'] = $subjects;
        $this->viewData['message'] = $this->message;

        $this->render('add', $this->viewData);
    }

    private function do_add($organizations, $subjects) {
        $organizations = HelperApp::_parse_array_values($organizations, 'id', 'title');
        $subjects = HelperApp::_parse_array_values($subjects, 'id', 'title');

        $subject_id = $_POST['subject'];
        $organization_id = $_POST['organization'];
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);

        if (array_search($subject_id, array_flip($subjects)) === false)
            $this->message['error'][] = "Bạn vui lòng chọn một chủ đề.";
        if ($organization_id != 0 && array_search($organization_id, array_flip($organizations)) === false)
            $this->message['error'][] = "Bạn vui lòng chọn Trường/Trung tâm chính xác.";

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Tiêu đề không được để trống.";

        if (strlen($title) > 200)
            $this->message['error'][] = "Tiêu đề tối đa 200 ký tự.";

        if ($this->validator->is_empty_string($content))
            $this->message['error'][] = "Nội dung không được để trống.";
        /*
          if(strlen($content) > 5000)
          $this->message['error'][] = "Nội dung tối đa 5000 ký tự.";
         */

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $post_id = $this->PostModel->add($subject_id, $organization_id, UserControl::getId(), $title, $content);
        $post = $this->PostModel->get($post_id);
        $this->send_email_subject_mod($subject_id,Yii::app()->request->hostInfo.Yii::app()->request->baseUrl . "/post/view/s/$post[slug]");
        $this->redirect(Yii::app()->request->baseUrl . "/post/view/s/$post[slug]");
    }
    
    private function send_email_subject_mod($subject_id,$link){
        $mods = $this->SubjectModel->get_mods($subject_id);
        foreach($mods as $v)
        {
            $subject = "Câu hỏi từ 4u.yima.vn";
            $message = 'Chào, <strong>'.$v['lastname']. ' ' .$v['firstname'].'<strong><br/>
                        Có câu hỏi từ 4u.yima.vn<br/><br/>
                        Đường dẫn tại đây: '.$link;
            HelperApp::email($v['email'], $subject, $message);
        }
    }
    
    public function actionEdit($id = 0){
        HelperGlobal::require_login();
        
        $post = $this->PostModel->get($id);
        if(!$post || $post['author_id'] != UserControl::getId())
            $this->load_404 ();
        $organizations = $this->OrganizationModel->get_all();
        $subjects = $this->SubjectModel->gets(array('deleted' => 0, 'disabled' => 0), 1, 300);
        if($_POST)
            $this->do_edit ($post,$organizations,$subjects);
        $this->layout = "no-sidebar";
        $this->viewData['post'] = $post;
        $this->viewData['organizations'] = $organizations;
        $this->viewData['subjects'] = $subjects;
        $this->viewData['message'] = $this->message;
        $this->render('edit',$this->viewData);
    }
    
    public function do_edit($post,$organizations,$subjects){
        $organizations = HelperApp::_parse_array_values($organizations, 'id', 'title');
        $subjects = HelperApp::_parse_array_values($subjects, 'id', 'title');

        $subject_id = $_POST['subject'];
        $organization_id = $_POST['organization'];
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);

        if (array_search($subject_id, array_flip($subjects)) === false)
            $this->message['error'][] = "Bạn vui lòng chọn một chủ đề.";
        if ($organization_id != 0 && array_search($organization_id, array_flip($organizations)) === false)
            $this->message['error'][] = "Bạn vui lòng chọn Trường/Trung tâm chính xác.";

        if ($this->validator->is_empty_string($title))
            $this->message['error'][] = "Tiêu đề không được để trống.";

        if (strlen($title) > 200)
            $this->message['error'][] = "Tiêu đề tối đa 200 ký tự.";

        if ($this->validator->is_empty_string($content))
            $this->message['error'][] = "Nội dung không được để trống.";
        /*
          if(strlen($content) > 5000)
          $this->message['error'][] = "Nội dung tối đa 5000 ký tự.";
         */

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }
        
        $this->PostModel->update(array('title'=>$title,'subject_id'=>$subject_id,'organization_id'=>$organization_id,'content'=>$content,'last_modified'=>time(),'id'=>$post['id']));
        $this->redirect(Yii::app()->request->baseUrl."/post/edit/id/$post[id]/?s=1");
    }
    

    public function actionView($s = "", $p = 1) {

        $post = $this->PostModel->get_by_slug($s);
        if (!$post)
            $this->load_404();
        $ppp = Yii::app()->params['ppp'];
        $args = array('deleted' => 0, 'ref_id' => $post['id'],'ref_type'=>'post');
        $comments = $this->CommentModel->gets($args, $p, $ppp);
        $total = $this->CommentModel->counts($args);
        $this->viewData['post'] = $post;
        $this->viewData['comments'] = $comments;
        $this->viewData['total'] = $total;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl . "/post/view/s/$s/p/", $total, $p) : "";
        $this->viewData['best_comment'] = $this->CommentModel->get_best_comment($post['id'],'post');
        $this->render('view', $this->viewData);
    }

    public function actionComment($post = 0) {
        HelperGlobal::require_login(true);
        $post = $this->PostModel->get($post);
        if (!$post)
            $this->load_404();

        $content = trim($_POST['content']);
        if ($this->validator->is_empty_string($content))
            $this->redirect(Yii::app()->request->baseUrl . "/post/view/s/$post[slug]/");
        $ppp = Yii::app()->params['ppp'];
        $comment_id = $this->CommentModel->add($post['id'],'post', UserControl::getId(), $content);
        $this->PostModel->update(array('total_comment' => $post['total_comment'] + 1, 'id' => $post['id']));
        $total_comment = $this->CommentModel->counts(array('deleted' => 0, 'post_id' => $post['id']));
        $page = ceil($total_comment / $ppp);

        $this->redirect(Yii::app()->request->baseUrl . "/post/view/s/$post[slug]/p/$page/#comment-$comment_id");
    }

    public function actionVote($id = 0) {
        HelperGlobal::require_login(true);
        $post = $this->PostModel->get($id,'post');
        if (!$post)
            return;        
        $result = $this->VoteModel->add($post['id'], 'post', UserControl::getId(),'post');
        if($result)
            $this->PostModel->update(array('total_like' => $post['total_like'] + 1, 'id' => $post['id']));
        $total_vote = $this->VoteModel->count_votes('post', $post['id'],'post');
        echo json_encode(array('message'=>$this->message, 'data' => array('total_vote' => $total_vote)));
    }
    
    public function actionUnvote($id = 0) {
        HelperGlobal::require_login();
        $post = $this->PostModel->get($id,'post');
        if (!$post)
            return;        
        $result = $this->VoteModel->remove($post['id'], 'post', UserControl::getId(),'post');
        if($result)
            $this->PostModel->update(array('total_like' => $post['total_like'] - 1, 'id' => $post['id']));
        $total_vote = $this->VoteModel->count_votes('post', $post['id'],'post');
        echo json_encode(array('message'=>$this->message, 'data' => array('total_vote' => $total_vote)));
    }
    
    public function actionVote_comment($id = 0) {
        HelperGlobal::require_login(true);
        $comment = $this->CommentModel->get($id,'post');
        if (!$comment)
            return;
        
        $result = $this->VoteModel->add($comment['id'], 'post', UserControl::getId(),'comment');    
        $total_vote = $this->VoteModel->count_votes('post', $comment['id'],'comment');
        echo json_encode(array('message'=>$this->message, 'data' => array('total_vote' => $total_vote)));
    }
    
    public function actionUnvote_comment($id = 0) {
        HelperGlobal::require_login();
        $comment = $this->CommentModel->get($id,'post');
        if (!$comment)
            return;
        
        $result = $this->VoteModel->remove($comment['id'], 'post', UserControl::getId(),'comment');        
        $total_vote = $this->VoteModel->count_votes('post', $comment['id'],'comment');
        echo json_encode(array('message'=>$this->message,'data'=>array('total_vote'=>$total_vote)));
    }
    
    public function actionSearch($type = "hay",$p= 1){
        $this->layout = "search";
        $ppp = Yii::app()->params['ppp'];
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : "";
        $keyword = strlen($keyword) < 3 ? "" : $keyword;
        $oid = isset($_GET['oid']) ? $_GET['oid'] : 0;
        $sid = isset($_GET['sid']) ? $_GET['sid'] : 0;
        $args = array('deleted'=>0,'type'=>$type,'s'=>$keyword,'sid'=>$sid,'oid'=>$oid);
        HelperApp::add_session('search_post_new', $args);
        if(!HelperApp::get_session('search_post_old'))
            HelperApp::add_session('search_post_old', $args);
        
        if($this->compare_search_process())
            $p = 1;
        $organizations = $this->OrganizationModel->get_all();
        $subjects = $this->SubjectModel->gets(array('deleted' => 0, 'disabled' => 0), 1, 300);
        
        $posts = $this->PostModel->gets($args,$p,$ppp);
        $total = $this->PostModel->counts($args);
        Yii::app()->params['page'] = $type;

        $this->viewData['posts'] = $posts;
        $this->viewData['total'] = $total;
        $this->viewData['organizations'] = $organizations;
        $this->viewData['subjects'] = $subjects;
        $this->viewData['paging'] = $total > $ppp ? HelperApp::get_paging($ppp, Yii::app()->request->baseUrl."/post/search/type/$type/p/", $total, $p) : "";
        
        $this->render('search',$this->viewData);
    }
    
    private function compare_search_process(){
        $old = HelperApp::get_session('search_post_old');
        $new = HelperApp::get_session('search_post_new');        
        $diff = array_diff($new,$old);
        HelperApp::add_session('search_post_old', $new);
        if(count($diff) > 0)
            return true;
        return FALSE;
    }
    
    public function actionReport($type = "",$id = 0){
        HelperGlobal::require_login();
        $list_types = array('post','comment');
        if(!$type || !$id || array_search($type, $list_types) === false)
            return;
        
        if($type == "post")
            $item = $this->PostModel->get ($id);
        else if($type == "comment")
            $item = $this->CommentModel->get ($id);
        if(!$item)
            return;
        $report = $this->ReportModel->exist_report('post', $id,$type);
        if($report)
        {
            echo json_encode(array('message'=>$this->message));
            die;
        }
        
        $this->ReportModel->add($id, 'post', UserControl::getId(),$type);
        echo json_encode(array('message'=>$this->message));
    }
    
    public function actionFilter_search(){
        $oid = $_GET['oid'] ? $_GET['oid'] : 0;
        $fid = $_GET['fid'];
        $sid = $_GET['sid'];
        $faculty_html = '<option value="0">-- Khoa --</option>';
        $subject_html = '<option value="0">-- Chủ đề --</option>';
        $subject_args = array('disabled'=>0,'deleted'=>0,'organization_id'=>$oid);
        if($fid)
            $subject_args['faculty_id'] = $fid;
        
        $faculties = $this->OrganizationModel->get_faculties(array('organization_id'=>$oid));        
        $subjects = $this->SubjectModel->gets($subject_args,1,2000);
        
        foreach($faculties as $k=>$v){
            $selected = "";
            if($v['id'] == $fid)
                $selected = "selected";
            $faculty_html.= '<option value="'.$v['id'].'" '.$selected.'>'.$v['title'].'</option>';
        }
        
        foreach($subjects as $k=>$v){
            $selected = "";
            if($v['id'] == $sid)
                $selected = "selected";
            $subject_html.= '<option value="'.$v['id'].'" '.$selected.'>'.$v['title'].'</option>';
        }
        
        echo json_encode(array('subject_html'=>$subject_html,'faculty_html'=>$faculty_html));
    }
}