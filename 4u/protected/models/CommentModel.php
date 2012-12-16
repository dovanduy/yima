<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CommentModel extends CFormModel {

    public function __construct() {
        
    }

    public function gets($args = array(), $page = 1, $ppp = 20) {
        $user_id = (int)UserControl::getId();
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();
        
        
        if (isset($args['ref_id'])) {
            $custom.= " AND yc.ref_id = :ref_id";
            $params[] = array('name' => ':ref_id', 'value' => $args['ref_id'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['ref_type'])) {
            $custom.= " AND yc.ref_type = :ref_type";
            $params[] = array('name' => ':ref_type', 'value' => $args['ref_type'], 'type' => PDO::PARAM_STR);
        }

        if (isset($args['deleted'])) {
            $custom .= " AND yc.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
       
        $sql = "SELECT yc.*,ysu.lastname,ysu.firstname,ysu.thumbnail,(yv.ref_id = yc.id) as voted,count_vote.total_like
                FROM yima_comments yc
                LEFT JOIN yima_sys_user ysu
                ON ysu.id = yc.author_id
                LEFT JOIN (SELECT ref_id
                            FROM yima_votes
                            WHERE ref_type = :ref_type
                            AND vote_type = 'comment'
                            AND author_id = :user_id) yv
                ON yv.ref_id = yc.id
                LEFT JOIN (SELECT count(*) as total_like,ref_id
                            FROM yima_votes
                            WHERE ref_type = :ref_type
                            AND vote_type = 'comment'
                            GROUP BY ref_id) count_vote
                ON count_vote.ref_id = yc.id
                WHERE 1
                $custom
                ORDER BY date_added ASC                
                LIMIT :page,:ppp";
        
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":user_id", $user_id,PDO::PARAM_INT);
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
            $params[] = array('name' => ':ref_type', 'value' => $args['ref_type'], 'type' => PDO::PARAM_STR);
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

    
    public function add($ref_id,$ref_type,$author_id,$content){       
        
        $time = time();
        
        $sql = "INSERT INTO yima_comments(ref_id,ref_type,author_id,content,date_added) VALUES(:ref_id,:ref_type,:author_id,:content,:date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":ref_id", $ref_id,PDO::PARAM_INT);
        $command->bindParam(":ref_type", $ref_type);
        $command->bindParam(":author_id", $author_id,PDO::PARAM_INT);
        $command->bindParam(":content", $content);
        $command->bindParam(":date_added", $time);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }
    
    public function get($id,$ref_type) {     
        $user_id = UserControl::getId();
        $sql = "SELECT yc.*,ysu.lastname,ysu.firstname,ysu.email,ysu.thumbnail,(yv.ref_id = yc.id) as voted,count_vote.total_like
                FROM yima_comments yc
                LEFT JOIN yima_sys_user ysu
                ON ysu.id = yc.author_id
                LEFT JOIN (SELECT ref_id
                            FROM yima_votes
                            WHERE ref_type = :ref_type
                            AND vote_type = 'comment'
                            AND author_id = :user_id) yv
                ON yv.ref_id = yc.id
                LEFT JOIN (SELECT count(*) as total_like,ref_id
                            FROM yima_votes
                            WHERE ref_type = :ref_type
                            AND vote_type = 'comment'
                            GROUP BY ref_id) count_vote
                ON count_vote.ref_id = yc.id    
                WHERE yc.deleted = 0
                AND yc.id = :id
                ";
        
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id,PDO::PARAM_INT);
        $command->bindParam(":user_id", $user_id,PDO::PARAM_INT);
        $command->bindParam(":ref_type", $ref_type);
        return $command->queryRow();
    }
    
    public function get_best_comment($ref_id,$ref_type){
        $sql = "SELECT ref_id,count(*) as total_like
                FROM yima_votes yv
                WHERE ref_type = :ref_type
                AND ref_id IN (SELECT id
                                FROM yima_comments
                                WHERE ref_id = :ref_id
                                AND ref_type = :ref_type)
                AND yv.vote_type = 'comment'
                GROUP BY ref_id
                ORDER BY total_like DESC
                LIMIT 1
                ";
        
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":ref_id", $ref_id,PDO::PARAM_INT);
        $command->bindParam(":ref_type", $ref_type);
        $comment = $command->queryRow();
        if($comment)
            return $this->get($comment['ref_id'],$ref_type);
        return null;
    }

}