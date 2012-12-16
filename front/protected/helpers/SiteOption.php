<?php

class SiteOption {

    private static $instance = null;
    private static $fetch = false;

    
    private static function FetchUserInstance() {
        if (self::$fetch)
            return;

        $SiteOptionModel = new SiteOptionModel();
        self::$instance = self::_parse_options($SiteOptionModel->gets());

        self::$fetch = true;
    }
    
    private static function _parse_options($options){
        
        $tmp = array();
        foreach($options as $k=>$v)
            $tmp[$v['meta_key']] = $v['meta_value'];
        return $tmp;
        
    }

    public static function getUsdRate() {
        self::FetchUserInstance();
        return self::$instance['usd_rate'];
    }

}