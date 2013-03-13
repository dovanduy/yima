<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class FacultyModel extends CFormModel {

    public function __construct() {
        
    }

    public function get_all($args){
        $custom = "";
        $params = array();

        if (isset($args['organization_id'])) {
            $custom.= " AND id IN (SELECT  faculty_id
                                FROM yima_organization_faculty_subject
                                WHERE organization_id = :organization_id)";
            $params[] = array('name' => ':organization_id', 'value' => $args['organization_id'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT *
                FROM yima_sys_faculty
                WHERE disabled = 0
                AND deleted = 0
                $custom
                ORDER BY title ASC
                ";

        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a) {
            $command->bindParam($a['name'], $a['value'], $a['type']);
        }
        return $command->queryAll();
    }
    
    public function get($id){
       

        $sql = "SELECT *
                FROM yima_sys_faculty
                WHERE disabled = 0
                AND deleted = 0
                AND id = :id
                ORDER BY title ASC
                ";

        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':id', $id);
        return $command->queryRow();
    }

}