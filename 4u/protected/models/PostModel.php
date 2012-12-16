<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PostModel extends CFormModel {

    public function __construct() {
        
    }

    public function gets($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $order_by = "yp.date_added DESC";
        $params = array();
        
        
        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND yp.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        if (isset($args['deleted'])) {
            $custom .= " AND yp.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['sid']) && $args['sid']) {
            $custom .= " AND yp.subject_id = :subject_id";
            $params[] = array('name' => ':subject_id', 'value' => $args['sid'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['oid']) && $args['oid']) {
            $custom .= " AND yp.organization_id = :organization_id";
            $params[] = array('name' => ':organization_id', 'value' => $args['oid'], 'type' => PDO::PARAM_INT);
        }
        
        if(isset($args['type']) && $args['type'] == "hay"){
            $order_by = "yp.total_like DESC";
        }
        
        if(isset($args['random'])){
            if(isset($args['exclude']) && count($args['exclude']) > 0)
            {
                $custom.= " AND yp.id NOT IN (".  implode(',', $args['exclude']).")";
            }
            $order_by = "RAND()";
        }
        
        $sql = "SELECT yp.*,yu.lastname,yu.firstname,yu.email,yu.thumbnail,yso.title as organization_name,yss.title as subject_name
                FROM yima_posts yp
                LEFT JOIN yima_sys_user yu
                ON yu.id = yp.author_id
                LEFT JOIN yima_sys_organization yso
                ON yso.id = yp.organization_id
                LEFT JOIN yima_sys_subject yss
                ON yss.id = yp.subject_id
                WHERE 1
                $custom
                ORDER BY $order_by
                LIMIT :page,:ppp";
        
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }
    
    public function counts($args = array()) {
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND yp.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        if (isset($args['deleted'])) {
            $custom .= " AND yp.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['sid']) && $args['sid']) {
            $custom .= " AND yp.subject_id = :subject_id";
            $params[] = array('name' => ':subject_id', 'value' => $args['sid'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['oid']) && $args['oid']) {
            $custom .= " AND yp.organization_id = :organization_id";
            $params[] = array('name' => ':organization_id', 'value' => $args['oid'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT count(*) as total
                FROM yima_posts yp                
                WHERE 1
                $custom
                ";
        
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function get_by_slug($slug){
        $user_id = (int)UserControl::getId();
        $sql = "SELECT yp.*,yu.lastname,yu.firstname,yu.email,yu.thumbnail,yso.title as organization_name,yss.title as subject_name,(yv.ref_id = yp.id) as voted
                FROM yima_posts yp
                LEFT JOIN yima_sys_user yu
                ON yu.id = yp.author_id
                LEFT JOIN yima_sys_organization yso
                ON yso.id = yp.organization_id
                LEFT JOIN yima_sys_subject yss
                ON yss.id = yp.subject_id
                LEFT JOIN (SELECT ref_id
                            FROM yima_votes
                            WHERE ref_type = 'post'
                            AND author_id = :author_id
                            AND point > 0
                            AND vote_type = 'post') yv
                ON yv.ref_id = yp.id
                WHERE yp.deleted = 0
                AND yp.slug = :slug";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':slug', $slug);
        $command->bindParam(':author_id', $user_id,PDO::PARAM_INT);
        return $command->queryRow();
    }
    
    public function get($id){
        $user_id = (int)UserControl::getId();
        $sql = "SELECT yp.*,yu.lastname,yu.firstname,yu.email,yu.thumbnail,yso.title as organization_name,yss.title as subject_name,(yv.ref_id = yp.id) as voted
                FROM yima_posts yp
                LEFT JOIN yima_sys_user yu
                ON yu.id = yp.author_id
                LEFT JOIN yima_sys_organization yso
                ON yso.id = yp.organization_id
                LEFT JOIN yima_sys_subject yss
                ON yss.id = yp.subject_id
                LEFT JOIN (SELECT ref_id
                            FROM yima_votes
                            WHERE ref_type = 'post'
                            AND author_id = :author_id
                            AND point > 0
                            AND vote_type = 'post') yv
                ON yv.ref_id = yp.id
                WHERE yp.deleted = 0
                AND yp.id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':id', $id);
        $command->bindParam(':author_id', $user_id,PDO::PARAM_INT);
        return $command->queryRow();
    }
    
    public function add($subject_id,$organization_id,$author_id,$title,$content){
        $slug = Helper::create_slug($title);
        $count_slug = $this->check_exist_slug($slug);
        if ($count_slug > 0)
            $slug = $slug . "-" . $count_slug;
        $time = time();
        
        $sql = "INSERT INTO yima_posts(subject_id,organization_id,author_id,title,slug,content,date_added) VALUES(:subject_id,:organization_id,:author_id,:title,:slug,:content,:date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":subject_id", $subject_id,PDO::PARAM_INT);
        $command->bindParam(":organization_id", $organization_id,PDO::PARAM_INT);
        $command->bindParam(":author_id", $author_id,PDO::PARAM_INT);
        $command->bindParam(":title",$title);
        $command->bindParam(":slug", $slug);
        $command->bindParam(":content", $content);
        $command->bindParam(":date_added", $time);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }
    
    private function check_exist_slug($slug) {
        $sql = 'SELECT count(slug) as count FROM yima_posts WHERE slug REGEXP "^' . $slug . '(-[[:digit:]]+)?$"';
        $command = Yii::app()->db->createCommand($sql);
        $row = $command->queryRow();
        return $row['count'];
    }
    
    
    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_posts set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }
    
    public function get_top_posts(){
        $sql = "SELECT yp.*,COUNT(*) as total
                FROM yima_votes yv,yima_posts yp
                WHERE ref_type = 'post'
                AND yv.ref_id = yp.id
                AND yp.deleted = 0
                AND yv.vote_type = 'post'
                GROUP BY ref_id
                ORDER BY total DESC
                LIMIT 10
                ";
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }
    
}