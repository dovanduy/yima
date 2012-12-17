<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('theme_url')) {

    function theme_url() {
        $CI = & get_instance();
        return $CI->config->item('theme_url');
    }

}

if (!function_exists('sluggify')) {

    function sluggify($url) {
        # Prep string with some basic normalization
        $url = strtolower($url);
        $url = strip_tags($url);
        $url = stripslashes($url);
        $url = html_entity_decode($url);

        # Remove quotes (can't, etc.)
        $url = str_replace('\'', '', $url);

        # Replace non-alpha numeric with hyphens
        $match = '/[^a-z0-9]+/';
        $replace = '-';
        $url = preg_replace($match, $replace, $url);

        $url = trim($url, '-');

        return $url;
    }

}

if (!function_exists('sound_length')) {

    function sound_length($filename = '') {
        require_once('application/libraries/getid3/getid3.php');

        $getID3 = new getID3;
        $ThisFileInfo = $getID3->analyze($filename);
        getid3_lib::CopyTagsToComments($ThisFileInfo);
        
        return @ceil($ThisFileInfo['playtime_seconds']);
    }

}


