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
                AND disabled = 0
                AND deleted = 0
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":slug", $slug, PDO::PARAM_STR);
        return $command->queryRow();
    }
    
    public function get($id) {
        $sql = "SELECT *
                FROM yima_sys_organization
                WHERE id = :id
                AND disabled = 0
                AND deleted = 0
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryRow();
    }

    public function get_organization_subject($id, $args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND kso.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT kso.*,kss.title as subject_title,ksos.id as os_id
                FROM yima_sys_organization_subject ksos 
                
                LEFT JOIN yima_sys_organization kso
                on kso.id = ksos.organization_id

                LEFT JOIN yima_sys_subject kss
                on kss.id = ksos.subject_id

                WHERE ksos.disabled = 0 AND ksos.deleted = 0 AND kso.id = :id
                $custom
                ORDER BY kso.title ASC
                LIMIT :page,:ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        $command->bindParam(":id", $id, PDO::PARAM_STR);
        foreach ($params as $a) {
            $command->bindParam($a['name'], $a['value'], $a['type']);
        }
        return $command->queryAll();
    }

    public function get_test_nt_by_organization($organization_id, $args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT knt.*,kss.title as subject_title,kss.id as subject_id
                FROM yima_nt_test knt 
                LEFT JOIN yima_organization_faculty_subject yofs
                ON yofs.id = knt.group_id
                
                LEFT JOIN yima_sys_organization kso
                on kso.id = yofs.organization_id
                
                LEFT JOIN yima_sys_subject kss
                on kss.id = yofs.subject_id
                WHERE knt.group_id IN (SELECT id
                                        FROM yima_organization_faculty_subject
                                        WHERE organization_id = :organization_id)
                $custom                
                ORDER BY knt.date_added DESC                
                LIMIT :page,:ppp";

        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        $command->bindParam(":organization_id", $organization_id, PDO::PARAM_INT);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }

    public function get_question($subject_id, $organization_id, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        $sql = "SELECT ynq.*,ynt.title as knt_title,yofs.subject_id as knt_subject
                FROM yima_nt_question ynq,yima_nt_test ynt,yima_organization_faculty_subject yofs
                WHERE ynq.test_id = ynt.id
                AND yofs.id = ynt.group_id
                AND yofs.organization_id = :organization_id
                AND yofs.subject_id = :subject_id
                ORDER BY ynq.date_added ASC
               LIMIT :page,:ppp";
        
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        $command->bindParam(":subject_id", $subject_id, PDO::PARAM_INT);
        $command->bindParam(":organization_id", $organization_id, PDO::PARAM_INT);

        return $command->queryAll();
    }

    public function get_question_all($organization_id, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        $sql = "SELECT ynq.*,ynt.title as knt_title,yofs.subject_id as knt_subject
                FROM yima_nt_question ynq,yima_nt_test ynt,yima_organization_faculty_subject yofs
                WHERE ynq.test_id = ynt.id
                AND yofs.id = ynt.group_id
                AND yofs.organization_id = :organization_id
                ORDER BY ynq.date_added ASC
                LIMIT :page,:ppp";
        
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $command->bindParam(":organization_id", $organization_id, PDO::PARAM_INT);

        return $command->queryAll();
    }

    public function get_faculty($organization_id) {
        $sql = "SELECT *
                FROM yima_organization_faculty_subject yofs
                
                LEFT JOIN yima_sys_faculty ysf
                ON yofs.faculty_id = ysf.id
                
                WHERE yofs.organization_id = :organization_id
                GROUP BY yofs.faculty_id               
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":organization_id", $organization_id, PDO::PARAM_INT);
        return $command->queryAll();
    }

    public function get_sub($organization_id, $faculty) {
        $sql = "SELECT *
                FROM yima_organization_faculty_subject yofs
                
                LEFT JOIN yima_sys_subject yss
                ON yofs.subject_id = yss.id
                
                WHERE yofs.organization_id = :organization_id AND yofs.faculty_id = :faculty_id
                
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":organization_id", $organization_id, PDO::PARAM_INT);
        $command->bindParam(":faculty_id", $faculty, PDO::PARAM_INT);
        return $command->queryAll();
    }

    public function get_group($organization, $faculty, $subject) {
        $sql = "SELECT *
                FROM yima_organization_faculty_subject 
                WHERE organization_id = :organization_id
                AND faculty_id = :faculty_id
                AND subject_id = :subject_id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":organization_id", $organization);
        $command->bindParam(":faculty_id", $faculty);
        $command->bindParam(":subject_id", $subject);
        return $command->queryRow();
    }

    public function get_to_list() {

        $sql = "SELECT kso.*,ktg.title as grade_title
                FROM yima_sys_organization kso 
                LEFT JOIN yima_sys_grade ktg
                on kso.grade = ktg.id
                WHERE kso.disabled = 0 
                AND kso.deleted = 0 
                AND kso.featured = 1
                ORDER BY kso.title ASC
             ";
        $command = Yii::app()->db->createCommand($sql);

        return $command->queryAll();
    }
    
    public function get_all(){
        $sql = "SELECT kso.*,ktg.title as grade_title
                FROM yima_sys_organization kso 
                LEFT JOIN yima_sys_grade ktg
                on kso.grade = ktg.id
                WHERE kso.disabled = 0 
                AND kso.deleted = 0 
                ORDER BY kso.title ASC
             ";
        $command = Yii::app()->db->createCommand($sql);

        return $command->queryAll();
    }

    public function is_exist_group($organization_id, $faculty_id, $subject_id) {
        $sql = "SELECT count(*) as total
                FROM yima_organization_faculty_subject
                WHERE organization_id = :organization_id
                AND faculty_id = :faculty_id
                AND subject_id = :subject_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":organization_id", $organization_id, PDO::PARAM_INT);
        $command->bindParam(":faculty_id", $faculty_id, PDO::PARAM_INT);
        $command->bindParam(":subject_id", $subject_id, PDO::PARAM_INT);
        $count = $command->queryRow();
        return $count['total'];
    }

}