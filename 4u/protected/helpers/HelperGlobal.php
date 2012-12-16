<?php

class HelperGlobal {

    public static $log_description = '';

    public function __construct() {
        
    }

    public static function require_login($return_url = false) {

        if (!UserControl::LoggedIn()) {
            $url = Helper::domain() . "/user/signin/";
            if($return_url)
                $url = $url."?return=". $_SERVER['HTTP_REFERER'];
            header("location:" . $url);
            die;
        }
    }

    public static function get_featured_subject() {
        $args = array('featured' => 1,'deleted'=>0,'disabled'=>0);
        $SubjectModel = new SubjectModel();
        return $SubjectModel->gets($args);
    }

    public static function get_featured_organization() {
        $args = array('featured' => 1);
        $OrganizeModel = new OrganizationModel();
        return $OrganizeModel->gets($args);
    }

    public static function get_organization() {
        $OrganizeModel = new OrganizationModel();
        return $OrganizeModel->gets();
    }

}

