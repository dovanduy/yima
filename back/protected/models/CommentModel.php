<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CommentModel extends CFormModel {

    public function __construct() {
        
    }

    public function gets($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();
        
        
        if (isset($args['ref_id'])) {
            $custom.= " AND yc.ref_id = :ref_id";
            $params[] = array('name' => ':ref_id', 'value' => $args['ref_id'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['ref_type'])) {
            $custom.= " AND yc.ref_type = :ref_type";
            $params[] = array('name' => ':ref_type', 'value' => $args['ref_type'], 'type' => PDO::PARAM_INT);
        }

        if (isset($args['deleted'])) {
            $custom .= " AND yc.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
       
        $sql = "SELECT yc.*,ysu.email,ysu.lastname,ysu.firstname,ysu.thumbnail,count_vote.total_like,yp.title as post_title,ynt.title as test_nt_title
                FROM yima_comments yc
                LEFT JOIN yima_posts yp
                ON yp.id = yc.ref_id 
                LEFT JOIN yima_nt_test ynt
                ON ynt.id = yc.ref_id
                LEFT JOIN yima_sys_user ysu
                ON ysu.id = yc.author_id                
                LEFT JOIN (SELECT count(*) as total_like,ref_id
                            FROM yima_votes
                            WHERE ref_type = :ref_type
                            AND vote_type = 'comment'
                            GROUP BY ref_id) count_vote
                ON count_vote.ref_id = yc.id
                WHERE 1                
                $custom
                ORDER BY date_added DESC                
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

        if (isset($args['ref_id'])) {
            $custom.= " AND yc.ref_id = :ref_id";
            $params[] = array('name' => ':ref_id', 'value' => $args['ref_id'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['ref_type'])) {
            $custom.= " AND yc.ref_type = :ref_type";
            $params[] = array('name' => ':ref_type', 'value' => $args['ref_type'], 'type' => PDO::PARAM_INT);
        }

        if (isset($args['deleted'])) {
            $custom .= " AND yc.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
       
        $sql = "SELECT count(*) as total
                FROM yima_comments yc                
                WHERE 1
                $custom
                ";
        
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    
    public function get($id,$ref_type) {     
        
        $sql = "SELECT yc.*,ysu.email,ysu.lastname,ysu.firstname,ysu.thumbnail,count_vote.total_like,yp.title as post_title,ynt.title as test_nt_title
                FROM yima_comments yc
                LEFT JOIN yima_posts yp
                ON yp.id = yc.ref_id 
                LEFT JOIN yima_nt_test ynt
                ON ynt.id = yc.ref_id
                LEFT JOIN yima_sys_user ysu
                ON ysu.id = yc.author_id                
                LEFT JOIN (SELECT count(*) as total_like,ref_id
                            FROM yima_votes
                            WHERE ref_type = :ref_type
                            AND vote_type = 'comment'
                            GROUP BY ref_id) count_vote
                ON count_vote.ref_id = yc.id
                WHERE yc.id = :id
                ";
        
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id,PDO::PARAM_INT);
        $command->bindParam(":ref_type", $ref_type);
        return $command->queryRow();
    }
    
    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_comments set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }
    
}