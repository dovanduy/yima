<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Course_testModel extends CFormModel {

    public function __construct() {
        
    }

    public function get_toefl_course($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND kso.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        if (isset($args['featured'])) {
            $custom .= " AND kso.featured = 1";
        }
        $sql = "SELECT *
                FROM yima_toefl_source_test ktst
                WHERE  disabled = 0 AND deleted = 0
                $custom
                ORDER BY ktst.title ASC
                LIMIT :page,:ppp";

        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a) {
            $command->bindParam($a['name'], $a['value'], $a['type']);
        }
        return $command->queryAll();
    }

    public function get_toefl_counts($args=array()) {

        $custom = "";
        $params = array();
        
        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND kso.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        if (isset($args['featured'])) {
            $custom .= " AND kso.featured = 1";
        }
        $sql = "SELECT count(ktst.id) as total
                FROM yima_toefl_source_test ktst
                WHERE  disabled = 0 AND deleted = 0
                $custom
                ORDER BY ktst.title ASC
                ";

        $command = Yii::app()->db->createCommand($sql);
   
        foreach ($params as $a) {
            $command->bindParam($a['name'], $a['value'], $a['type']);
        }
        $count = $command->queryRow();

        return $count['total'];
    }

}

?>
