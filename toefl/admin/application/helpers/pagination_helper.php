<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('set_default_pagination')) {

    function set_default_pagination() {
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li><a class="button" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['anchor_class'] = 'class="button gray"';
        
        return $config;
    }

}