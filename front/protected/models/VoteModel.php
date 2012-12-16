<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class VoteModel extends CFormModel {

    public function __construct() {
        
    }

    public function add($ref_id,$ref_type,$author_id,$vote_type,$point = 1){       
        
        $time = time();
        
        $sql = "INSERT INTO yima_votes(ref_id,ref_type,author_id,vote_type,point,date_added) VALUES(:ref_id,:ref_type,:author_id,:vote_type,:point,:date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":ref_id", $ref_id,PDO::PARAM_INT);
        $command->bindParam(":ref_type", $ref_type);
        $command->bindParam(":author_id", $author_id,PDO::PARAM_INT);
        $command->bindParam(":vote_type", $vote_type);
        $command->bindParam(":point", $point,PDO::PARAM_INT);
        $command->bindParam(":date_added", $time);
        $command->execute();    
        return Yii::app()->db->lastInsertID;
    }
    
    public function remove($ref_id,$ref_type,$author_id,$vote_type){
        $sql = "DELETE FROM yima_votes
                WHERE ref_id = :ref_id
                AND ref_type = :ref_type
                AND author_id = :author_id
                AND vote_type = :vote_type";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":ref_id", $ref_id,PDO::PARAM_INT);
        $command->bindParam(":ref_type", $ref_type);
        $command->bindParam(":author_id", $author_id,PDO::PARAM_INT);
        $command->bindParam(":vote_type", $vote_type);
        return $command->execute();
    }
    
    public function count_votes($ref_type,$ref_id,$vote_type){
        $sql = "SELECT count(*) as total
                FROM yima_votes
                WHERE ref_type = :ref_type
                AND ref_id = :ref_id
                AND vote_type= :vote_type";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":ref_id", $ref_id,PDO::PARAM_INT);
        $command->bindParam(":ref_type", $ref_type);
        $command->bindParam(":vote_type", $vote_type);
        $command->execute();
        $count = $command->queryRow();
        return $count['total'];
    }
   
}