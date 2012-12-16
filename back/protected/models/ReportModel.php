<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ReportModel extends CFormModel {

    public function __construct() {
        
    }
    
    public function gets($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();
        
        
        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND ysu.email like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['ref_type'])) {
            $custom.= " AND yr.ref_type = :ref_type";
            $params[] = array('name' => ':ref_type', 'value' => $args['ref_type'], 'type' => PDO::PARAM_INT);
        }
       
        $sql = "SELECT yr.*,ysu.firstname,ysu.lastname,ysu.email
                FROM yima_reports yr,yima_sys_user ysu
                WHERE yr.author_id = ysu.id
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

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND ysu.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['ref_type'])) {
            $custom.= " AND yr.ref_type = :ref_type";
            $params[] = array('name' => ':ref_type', 'value' => $args['ref_type'], 'type' => PDO::PARAM_INT);
        }
       
        $sql = "SELECT count(*) as total
                FROM yima_reports yr,yima_sys_user ysu
                WHERE yr.author_id = ysu.id
                $custom
                ";
        
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function remove($ref_id,$ref_type,$author_id){
        $sql = "DELETE FROM yima_reports
                WHERE ref_id = :ref_id
                AND ref_type = :ref_type
                AND author_id = :author_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":ref_id", $ref_id,PDO::PARAM_INT);
        $command->bindParam(":ref_type", $ref_type);
        $command->bindParam(":author_id", $author_id,PDO::PARAM_INT);
        return $command->execute();
    }
   
}