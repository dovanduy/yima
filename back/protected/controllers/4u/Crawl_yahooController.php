<?php

class Crawl_yahooController extends Controller {

    private $viewData;
    private $message = array('success' => true, 'error' => array());
    private $validator;
    private $PostModel;
    private $OrganizationModel;
    private $SubjectModel;
    private $CategoryModel;
    private $YahooUserModel;
    private $YahooPostModel;

    public function init() {

        Yii::app()->params['group'] = "4u";
        Yii::app()->params['page'] = "post";

        $this->validator = new FormValidator();

        /* @var $SubjectModel SubjectModel */
        $this->SubjectModel = new SubjectModel();

        /* @var $PostModel PostModel */
        $this->PostModel = new PostModel();

        /* @var $OrganizationModel OrganizationModel */
        $this->OrganizationModel = new OrganizationModel();

        /* @var $CategoryModel CategoryModel */
        $this->CategoryModel = new CategoryModel();

        /* @var $YahooUserModel YahooUserModel */
        $this->YahooUserModel = new YahooUserModel();

        /* @var $YahooPostModel YahooPostModel */
        $this->YahooPostModel = new YahooPostModel();
    }

    public function actionIndex($p = 1) {
        $this->CheckPermission();
    }

    public function actionCategory() {
        die;
        $html = file_get_html('http://vn.answers.yahoo.com/');

        $nav = $html->find("#yan-nav-browse", 0);
        $categories = $nav->find(".sub", 0)->find("ul");

        foreach ($categories as $k => $v) {
            $li = $v->find("li");
            foreach ($li as $c) {
                $link = $c->find("a", 0);
                $title = html_entity_decode(trim($link->plaintext));
                $this->CategoryModel->add($title, Helper::create_slug($title), 'post', "", "", $link->href, 0);
            }
        }
    }

    public function actionPost() {

        if ($_POST)
            $this->do_post();

        $this->viewData['categories'] = $this->CategoryModel->gets(array('type' => 'post'), 1, 50);
        $this->viewData['message'] = $this->message;
        $this->render('post', $this->viewData);
    }

    private function do_post() {
        $from = isset($_POST['from']) ? $_POST['from'] : 1;
        $from = !$from ? 1 : $from;
        $to = isset($_POST['to']) ? $_POST['to'] : 1;
        $to = !$to ? 1 : $to;
        $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : 0;
        $category = $this->CategoryModel->get($category_id);
        $total_post = 0;
        if (!$category)
            $this->message['error'][] = "Please choose a category.";

        if ($from < 1 || $to < 1)
            $this->message['error'][] = "From page or To page is incorrect.";

        if (count($this->message['error']) > 0) {
            $this->message['success'] = false;
            return false;
        }

        $link = 'http://vn.answers.yahoo.com' . $category['description'];
        //echo $link;die;
        for ($i = $from; $i <= $to; $i++) {
            //echo $i;die;
            $html = file_get_html($link . "&link=open&cp=$i");
            $questions = $html->find(".questions", 0);
            echo count($questions->find(' > li'));
            die;

            foreach ($questions->find(' > li') as $k => $v) {
                //if ($k == 1)
                //break;
                $link_post = $v->find('h3 > a', 0)->href;
                $html_post = file_get_html('http://vn.answers.yahoo.com' . $link_post);

                $question = $html_post->find('#yan-question', 0);

                //check if the user has already exist in db then get the user_id. Insert new user otherwise
                $html_user = $question->find('.profile', 0);
                echo $html_user;
                $tmp_user_title = trim($html_user->find('.user > a', 0)->plaintext);

                $user_title = str_replace('-', '_', Helper::create_slug($tmp_user_title));

                if (substr($user_title, 0, 1) == "_")
                    $user_title = substr($user_title, 1, strlen($user_title));
                if (substr($user_title, -1) == "_")
                    $user_title = substr($user_title, 0, strlen($user_title) - 1);


                $user_title = !$user_title ? $tmp_user_title : $user_title;

                $user = $this->YahooUserModel->get_by_title($user_title);
                if ($user) {
                    $author_id = $user['id'];
                } else {
                    $author_id = $this->YahooUserModel->add($user_title, "", Ultilities::base32UUID(), "normal", $user_title, "", $user_title . "@yahoo.com", "", "", time());
                }

                $title = $question->find('.subject', 0)->plaintext;

                if ($this->YahooPostModel->is_exist_with_user_and_slug($author_id, Helper::create_slug($title)))
                    continue;

                $content = $question->find('.content', 0)->innertext;
                $meta = $question->find('.meta', 0);
                $li = $meta->find('li', 0);
                $abbr = $li->find('abbr', 0);
                $date_added = strtotime($abbr->title);

                $this->YahooPostModel->add($title, $category_id, $author_id, Helper::create_slug($title), $content, $date_added);
                $total_post++;
            }
        }

        $this->redirect(HelperUrl::baseUrl() . "4u/crawl_yahoo/post/?s=1&msg=Create $total_post posts successfully");
    }

    public function actionMore_detail() {
        $category_id = $_POST['category_id'];
        $category = $this->CategoryModel->get($category_id);
        $total_post = $this->YahooPostModel->counts(array('deleted' => 0, 'category_id' => $category_id));

        $link = 'http://vn.answers.yahoo.com' . $category['description'];
        $html = file_get_html($link . "&link=open&cp=1");

        $pagination = $html->find('.pagination', 0);
        $result = preg_match_all("/[0-9]+/", $pagination->find('p', 0)->plaintext, $matches);
        ;
        $total_records = isset($matches[0][0]) ? $matches[0][0] : 0;
        $total_pages = $total_records == 0 ? 0 : ceil($total_records / 20);
        echo json_encode(array('category_title' => $category['title'], 'total_posts' => $total_post, 'total_records' => $total_records, 'total_pages' => $total_pages));
    }

    public function actionCreate_detail_file() {



        if ($handle = opendir(HelperUrl::upload_dir() . "yahoo")) {
            echo "Directory handle: $handle\n";
            echo "Entries:<br/>";
            $count = 0;
            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if (in_array($entry, array('.', '..', '.DS_Store')) !== false)
                    continue;
                if($count == 1)
                    break;
                echo "<p>Processing: $entry</p>";
                $info = explode('.', $entry);

                //$html = file_get_html("http://htmlfivemedia.com/demo/blogcenter/back/demo/load/file/".$info[0],true);
                $html = file_get_html("http://phonicsfair.com/");
                echo $html;die;
                $question = $html->find('.questions > li');

                foreach ($question as $k => $v) {
                    $id = $v->id;
                    $link_post = $v->find('h3 > a', 0)->href;
                    $html_post = file_get_html('http://vn.answers.yahoo.com' . $link_post);
                    $my_file = HelperUrl::upload_dir() . "yahoo_detail/$info[0]/";
                    HelperApp::make_folder($my_file);
                    $handle = fopen($my_file."$id.php", 'w') or die('Cannot open file:  ' . $my_file);
                    $data = $html;
                    fwrite($handle, $data);
                    fclose($handle);
                }
                
                $count++;
            }

            closedir($handle);
        }
    }

    public function actionGet_dir_file($file) {
        $this->render('yahoo_list/' . $file);
    }

    public function actionCreate_dir_file() {
        $total = 3750;
        $ppp = 20;
        set_time_limit(0);

        $total_pages = ceil($total / $ppp);
        for ($i = 1; $i <= 190; $i++) {
            $link = 'http://vn.answers.yahoo.com/dir/index?link=open&cp=' . $i;
            $html = file_get_html($link);

            $my_file = HelperUrl::upload_dir() . "yahoo/$i.php";
            $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);
            $data = $html;
            fwrite($handle, $data);
            fclose($handle);
        }
    }

}