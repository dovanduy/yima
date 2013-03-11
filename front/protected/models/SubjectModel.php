<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class SubjectModel extends CFormModel {

    public function __construct() {
        
    }

    public function gets($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['deleted'])) {
            $custom .= " AND deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['disabled'])) {
            $custom .= " AND disabled = :disabled";
            $params[] = array('name' => ':disabled', 'value' => $args['disabled'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['featured'])) {
            $custom .= " AND featured = :featured";
            $params[] = array('name' => ':featured', 'value' => $args['featured'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['organization_id'])) {
            $sub = "";
            
            if(isset($args['faculty_id'])){
                $sub.= " AND faculty_id = :faculty_id";
            }
            
            $custom .= " AND id in (SELECT DISTINCT subject_id
                                    FROM yima_organization_faculty_subject
                                    WHERE organization_id = :organization_id
                                    $sub)";
            $params[] = array('name' => ':organization_id', 'value' => $args['organization_id'], 'type' => PDO::PARAM_INT);
            if(isset($args['faculty_id']))
                $params[] = array('name' => ':faculty_id', 'value' => $args['faculty_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT *
                FROM yima_sys_subject 
                WHERE 1
                $custom
                ORDER BY title ASC
                LIMIT :page,:ppp";
        
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page,PDO::PARAM_INT);
        $command->bindParam(":ppp", $ppp,PDO::PARAM_INT);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }
    
    public function get($id) {
        
        
        $sql = "SELECT *
                FROM yima_sys_subject 
                WHERE id = :id
                AND deleted = 0";
        
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id,PDO::PARAM_INT);        

        return $command->queryRow();
    }

}