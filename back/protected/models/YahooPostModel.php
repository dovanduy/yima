<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class YahooPostModel extends CFormModel {

    public function __construct() {
        
    }

    public function gets($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
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
        
        if (isset($args['author_id'])) {
            $custom .= " AND yp.author_id = :author_id";
            $params[] = array('name' => ':author_id', 'value' => $args['author_id'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['category_id'])) {
            $custom .= " AND yp.category_id = :category_id";
            $params[] = array('name' => ':category_id', 'value' => $args['category_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT yp.*,yu.lastname,yu.firstname,yu.email
                FROM yahoo_posts yp
                LEFT JOIN yahoo_users yu
                ON yu.id = yp.author_id                
                WHERE 1
                $custom
                ORDER BY yp.date_added DESC
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
        
        if (isset($args['author_id'])) {
            $custom .= " AND yp.author_id = :author_id";
            $params[] = array('name' => ':author_id', 'value' => $args['author_id'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['category_id'])) {
            $custom .= " AND yp.category_id = :category_id";
            $params[] = array('name' => ':category_id', 'value' => $args['category_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT count(*) as total
                FROM yahoo_posts yp                
                WHERE 1
                $custom
                ";
        
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function get($id){
        $sql = "SELECT *
                FROM yahoo_posts
                WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id,PDO::PARAM_INT);
        return $command->queryRow();
    }
    
    public function is_exist_with_user_and_slug($author_id,$slug){
        $sql = "SELECT *
                FROM yahoo_posts
                WHERE author_id = :author_id
                AND slug = :slug";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":author_id", $author_id);
        $command->bindParam(":slug", $slug);
        return $command->queryRow();
    }
    
    public function add($title, $category_id,$author_id,$slug,$content,$date_added) {
        $sql = "INSERT INTO yahoo_posts(title, category_id,author_id,slug,content,date_added) VALUES(:title, :category_id,:author_id,:slug,:content,:date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":title", $title, PDO::PARAM_STR);
        $command->bindParam(":category_id", $category_id, PDO::PARAM_STR);
        $command->bindParam(":author_id", $author_id, PDO::PARAM_STR);
        $command->bindParam(":slug", $slug, PDO::PARAM_STR);
        $command->bindParam(":content", $content, PDO::PARAM_STR);
        $command->bindParam(":date_added", $date_added, PDO::PARAM_STR);
        
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }
    
    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yahoo_posts set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }
}