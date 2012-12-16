<?php

class OrganizationModel extends CFormModel {

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND kso.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT kso.*,ktg.title as grade_title
                FROM yima_sys_organization kso 
                LEFT JOIN yima_sys_grade ktg on kso.grade = ktg.id
                WHERE 1
                $custom
                ORDER BY kso.featured DESC, kso.title ASC
                LIMIT :page,:ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a) {
            $command->bindParam($a['name'], $a['value'], $a['type']);
        }
        return $command->queryAll();
    }

    public function get_all($args) {
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT id, title
                FROM yima_sys_organization
                WHERE 1
                $custom
                ORDER BY title ASC";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a) {
            $command->bindParam($a['name'], $a['value'], $a['type']);
        }
        return $command->queryAll();
    }

    public function counts($args) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        $sql = "SELECT count(*) as total
                FROM yima_sys_organization
                WHERE 1
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function get($id) {
        $sql = "SELECT kso.*,ktg.title as grade_title
                FROM yima_sys_organization kso 
                LEFT JOIN yima_sys_grade ktg on kso.grade = ktg.id
                WHERE kso.id = :id
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
        $sql = 'update yima_sys_organization set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function add($title, $grade_id, $priority, $search, $featured, $time) {
        $slug = Helper::create_slug($title);
        $count_slug = $this->check_exist_slug($slug);
        if ($count_slug > 0)
            $slug = $slug . "-" . $count_slug;

        $time = time();
        $sql = "INSERT INTO yima_sys_organization(title, grade,priority,search,featured,date_added,last_modified) 
            VALUES(:title, :grade_id,:priority,:search,:featured,:date_added,:last_modified)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":title", $title, PDO::PARAM_STR);
        $command->bindParam(":priority", $priority, PDO::PARAM_INT);
        $command->bindParam(":grade_id", $grade_id, PDO::PARAM_INT);
        $command->bindParam(":featured", $featured, PDO::PARAM_INT);
        $command->bindParam(":search", $search, PDO::PARAM_INT);
        $command->bindParam(":date_added", $time, PDO::PARAM_INT);
        $command->bindParam(":last_modified", $time, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function check_exist_slug($slug) {
        $sql = 'SELECT count(slug) as count FROM yima_sys_organization WHERE slug REGEXP "^' . $slug . '(-[[:digit:]]+)?$"';
        $command = Yii::app()->db->createCommand($sql);
        $row = $command->queryRow();
        return $row['count'];
    }

    public function get_to_list() {

        $sql = "SELECT kso.*,ktg.title as grade_title
                FROM yima_sys_organization kso 
                LEFT JOIN yima_sys_grade ktg on kso.grade = ktg.id
                WHERE kso.disabled = 0 AND kso.deleted = 0
                ORDER BY kso.title ASC
             ";
        $command = Yii::app()->db->createCommand($sql);
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
    
    public function add_group($organization_id, $faculty_id, $subject_id,$sub_number){
        $sql = "INSERT INTO yima_organization_faculty_subject(organization_id,faculty_id,subject_id,sub_number) VALUES(:organization_id,:faculty_id,:subject_id,:sub_number)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":organization_id", $organization_id, PDO::PARAM_INT);
        $command->bindParam(":faculty_id", $faculty_id, PDO::PARAM_INT);
        $command->bindParam(":subject_id", $subject_id, PDO::PARAM_INT);
        $command->bindParam(":sub_number", $sub_number, PDO::PARAM_STR);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }
    
    public function delete_group($id){
        $sql = "DELETE FROM yima_organization_faculty_subject WHERE id=:id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->execute();
    }
    
    public function get_groups($args,$page = 1,$ppp = 20){
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND yss.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['organization_id'])) {
            $custom.= " AND yofs.organization_id = :organization_id";
            $params[] = array('name' => ':organization_id', 'value' => $args['organization_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT yofs.*,yss.title as subject_title,ysf.title as faculty_title
                FROM yima_organization_faculty_subject yofs
                LEFT JOIN yima_sys_subject yss
                ON yofs.subject_id = yss.id
                LEFT JOIN yima_sys_faculty ysf
                ON ysf.id = yofs.faculty_id
                WHERE 1
                $custom
                ORDER BY yofs.faculty_id ASC
                LIMIT :page,:ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a) {
            $command->bindParam($a['name'], $a['value'], $a['type']);
        }
        return $command->queryAll();
    }
    
    public function count_groups($args){
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND yss.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['organization_id'])) {
            $custom.= " AND yofs.organization_id = :organization_id";
            $params[] = array('name' => ':organization_id', 'value' => $args['organization_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT count(*) as total
                FROM yima_organization_faculty_subject yofs
                LEFT JOIN yima_sys_subject yss
                ON yofs.subject_id = yss.id
                LEFT JOIN yima_sys_faculty ysf
                ON ysf.id = yofs.faculty_id
                WHERE 1
                $custom
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
