<?php

class FacultyModel extends CFormModel {

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND (keyword_subject like :title OR keyword_owner like :title)";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_sys_faculty ksf  LEFT JOIN (SELECT id as org_id, title as org_title 
                                                     FROM yima_sys_organization)kso on ksf.organization_id = kso.org_id
                WHERE 1
                $custom
                ORDER BY ksf.title ASC
                LIMIT :page,:ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a) {
            $command->bindParam($a['name'], $a['value'], $a['type']);
        }
        return $command->queryAll();
    }

    public function counts($args) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND (title like :title)";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        $sql = "SELECT count(*) as total
                FROM yima_sys_faculty ksf  LEFT JOIN (SELECT id as org_id, title as org_title 
                                                     FROM yima_sys_organization)kso on ksf.organization_id = kso.org_id
                WHERE 1
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function get_all_by_organization($args){
        $custom = "";
        $params = array();

        if (isset($args['organization_id'])) {
            $custom.= " AND organization_id = :organization_id";
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

    public function get($id) {
        $sql = "SELECT *
                FROM yima_sys_faculty ksf  LEFT JOIN (SELECT id as org_id, title as org_title 
                                                     FROM yima_sys_organization)kso on ksf.organization_id = kso.org_id
                WHERE ksf.id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }

    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_sys_faculty set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function add($title, $organization_id, $date_added) {
        $sql = "INSERT INTO yima_sys_faculty (title, organization_id, date_added) 
                VALUES(:title, :organization_id, :date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":title", $title, PDO::PARAM_STR);
        $command->bindParam(":organization_id", $organization_id, PDO::PARAM_INT);
        $command->bindParam(":date_added", $date_added, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

}

?>
