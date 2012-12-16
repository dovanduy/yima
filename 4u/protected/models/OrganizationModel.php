<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class OrganizationModel extends CFormModel {

    public function __construct() {
        
    }

    public function gets($args = array(), $page = 1, $ppp = 20) {
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
                FROM yima_sys_organization kso LEFT JOIN (select id  as grade_id, title as grade_title from yima_sys_grade) ktg on kso.grade = ktg.grade_id
                WHERE  disabled = 0 AND deleted = 0
                $custom
                ORDER BY kso.priority ASC
                LIMIT :page,:ppp";

        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a) {
            $command->bindParam($a['name'], $a['value'], $a['type']);
        }
        return $command->queryAll();
    }

    public function get_by_slug($slug) {
        $sql = "SELECT *
                FROM yima_sys_organization
                WHERE slug = :slug
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":slug", $slug, PDO::PARAM_STR);
        return $command->queryRow();
    }

    public function get_all() {
        $sql = "SELECT *
                FROM yima_sys_organization
                ORDER BY title ASC
                ";
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

    public function get_top_organizations() {
        $sql = "SELECT yso.*,COUNT(*) as total
                FROM yima_posts yp,yima_sys_organization yso
                WHERE yso.deleted = 0
                AND yso.disabled = 0
                AND yso.id = yp.organization_id
                AND yp.deleted = 0
                GROUP BY yp.organization_id
                ORDER BY total DESC
                LIMIT 10
                ";
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

    public function get_organization_faculty_subject($args){
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
                FROM yima_sys_organization kso LEFT JOIN (select id  as grade_id, title as grade_title from yima_sys_grade) ktg on kso.grade = ktg.grade_id
                WHERE  disabled = 0 AND deleted = 0
                $custom
                ORDER BY kso.priority ASC
                ";

        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a) {
            $command->bindParam($a['name'], $a['value'], $a['type']);
        }
        return $command->queryAll();
    }
    
    public function get_faculties($args){
        $custom = "";
        $params = array();

        if (isset($args['organization_id'])) {
            $custom.= " AND id IN (SELECT DISTINCT faculty_id
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
}