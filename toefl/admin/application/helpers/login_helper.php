<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('check_login')) {

    function check_login($back_url = 'welcome') {
        $CI = & get_instance();
        $user_info = $CI->session->userdata('user_info');

        if (($user_info['id'] == '' || $user_info['id'] == '0')) {
            $CI->session->set_userdata('back_url', $back_url);
            header('location: ' . base_url() . 'login');
        }
    }

}

if (!function_exists('current_user_id')) {

    function current_user_id() {
        $CI = & get_instance();
        $user_info = $CI->session->userdata('user_info');
        return $user_info['id'];
    }

}

if (!function_exists('current_campus_id')) {

    function current_campus_id() {
        $CI = & get_instance();
        $user_info = $CI->session->userdata('user_info');
        return $user_info['campus_id'];
    }

}

if (!function_exists('current_group_id')) {

    function current_group_id() {
        $CI = & get_instance();
        $user_info = $CI->session->userdata('user_info');
        return $user_info['group_id'];
    }

}

if (!function_exists('out_char')) {

    function out_char($text = '') {
        $text = str_replace('"', '“', $text);
        $text = str_replace("'", "’", $text);
        return $text;
    }

}

if (!function_exists('list_class_by_student')) {

    function list_class_by_student($student_id = 0) {
        $CI = & get_instance();

        $CI->db->select('*, (select c.title from class c where c.id=class_id) as class_title');
        $CI->db->where('deleted', 0);
        $CI->db->where('student_id', $student_id);
        $query = $CI->db->get('class_student');
        $items = $query->result();
        $class_arr;
        foreach ($items as $item) {
            $class_arr[] = $item->class_title;
        }
        return $class_arr;
    }

}