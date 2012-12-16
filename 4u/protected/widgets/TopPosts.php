<?php

class TopPosts extends CWidget {

    private $viewData;
    private $PostModel;

    public function init() {

        /* @var $PostModel PostModel */
       $this->PostModel = new PostModel();
    }

    public function run() {
        $posts = $this->PostModel->get_top_posts();
        if(count($posts) < 10){
            $exclude = array();
            foreach($posts as $p)
                $exclude[] = $p['id'];
            $others = $this->PostModel->gets(array('deleted'=>0,'random'=>1,'exclude'=>$exclude),1,(10 - count($posts)));
            
            foreach($others as $v)
                $posts[] = $v;
        }
        $this->viewData['posts'] = $posts;
        $this->render('top_posts',$this->viewData);
    }

}