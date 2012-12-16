<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ReportModel extends CFormModel {

    public function __construct() {
        
    }

    public function add($ref_id,$ref_type,$author_id,$report_type){       
        
        $time = time();
        
        $sql = "INSERT INTO yima_reports(ref_id,ref_type,author_id,report_type,date_added) VALUES(:ref_id,:ref_type,:author_id,:report_type,:date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":ref_id", $ref_id,PDO::PARAM_INT);
        $command->bindParam(":ref_type", $ref_type);
        $command->bindParam(":author_id", $author_id,PDO::PARAM_INT);
        $command->bindParam(":report_type", $report_type);
        $command->bindParam(":date_added", $time);
        return $command->execute();        
    }
    
    public function remove($ref_id,$ref_type,$author_id,$report_type){
        $sql = "DELETE FROM yima_reports
                WHERE ref_id = :ref_id
                AND ref_type = :ref_type
                AND author_id = :author_id
                AND report_type = :report_type";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":ref_id", $ref_id,PDO::PARAM_INT);
        $command->bindParam(":ref_type", $ref_type);
        $command->bindParam(":author_id", $author_id,PDO::PARAM_INT);
        $command->bindParam(":report_type", $report_type);
        return $command->execute();
    }
    
    public function exist_report($ref_type,$ref_id,$report_type){
        $sql = "SELECT count(*) as total
                FROM yima_reports
                WHERE ref_type = :ref_type
                AND ref_id = :ref_id
                AND report_type = :report_type";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":ref_id", $ref_id,PDO::PARAM_INT);
        $command->bindParam(":ref_type", $ref_type);
        $command->bindParam(":report_type", $report_type);
        $command->execute();
        $count = $command->queryRow();
        return $count['total'];
    }
   
}