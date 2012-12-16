<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Create_testModel extends CFormModel {

    public function __construct() {
        
    }

    public function get_test($author, $args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_nt_test 
                WHERE author_id = :author_id
                $custom
                ORDER BY title ASC
                LIMIT :page,:ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":author_id", $author);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }

    public function counts($author, $args) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        $sql = "SELECT count(*) as total
                FROM yima_nt_test
                WHERE author_id = :author_id
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":author_id", $author);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function get_question($test_id) {
        $sql = "SELECT *
                FROM yima_nt_question
                WHERE test_id = :test_id
                AND deleted = 0";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":test_id", $test_id);
        return $command->queryAll();
    }

    public function get_scq($question_id) {
        $sql = "SELECT *
                FROM yima_nt_answer_scq
                WHERE question_id = :question_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":question_id", $question_id);
        return $command->queryAll();
    }

    public function get_test_group() {


        $sql = "SELECT *
                FROM yima_nt_test                    
               ";
        $command = Yii::app()->db->createCommand($sql);


        return $command->queryAll();
    }

    public function get_group($sub, $or) {
        $sql = "SELECT *
                FROM yima_organization_faculty_subject
                WHERE subject_id = :subject_id
                AND organization_id = :organization_id
               ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":subject_id", $sub);
        $command->bindParam(":organization_id", $or);

        return $command->queryRow();
    }

    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_nt_test set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function get_section() {

        $sql = "SELECT *
                FROM yima_sys_section 
                WHERE disabled = 0 AND deleted = 0
               
                ORDER BY title ASC
                ";
        $command = Yii::app()->db->createCommand($sql);


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

    public function add_test($title, $slug, $descrip, $group_id, $section, $price, $author, $time) {
        $count_slug = $this->check_exist_slug($slug);
        if ($count_slug > 0)
            $slug = $slug . "-" . $count_slug;
        
        $sql = 'INSERT into yima_nt_test(title, slug, description,group_id, section_id,author_id,price, date_added,last_modified) 
            VALUES(:title, :slug, :description,:group_id, :section_id,:author_id,:price, :date_added,:last_modified)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':slug', $slug, PDO::PARAM_STR);
        $command->bindParam(':description', $descrip, PDO::PARAM_STR);

        $command->bindParam(':group_id', $group_id, PDO::PARAM_INT);
        $command->bindParam(':section_id', $section, PDO::PARAM_INT);
        $command->bindParam(':author_id', $author, PDO::PARAM_INT);
        $command->bindParam(':price', $price, PDO::PARAM_INT);
        $command->bindParam(':date_added', $time, PDO::PARAM_INT);
        $command->bindParam(':last_modified', $time, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    private function check_exist_slug($slug) {
        $sql = 'SELECT count(slug) as count FROM yima_nt_test WHERE slug REGEXP "^' . $slug . '(-[[:digit:]]+)?$"';
        $command = Yii::app()->db->createCommand($sql);
        $row = $command->queryRow();
        return $row['count'];
    }
    
    public function get_with_group($organization, $faculty, $subject) {
        $sql = "SELECT *
                FROM yima_organization_faculty_subject 
                WHERE organization_id = :organization_id AND faculty_id = :faculty_id AND subject_id = :subject_id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":organization_id", $organization);
        $command->bindParam(":faculty_id", $faculty);
        $command->bindParam(":subject_id", $subject);
        return $command->queryRow();
    }

    public function get_subject($id) {
        $sql = "SELECT *
                FROM yima_sys_subject 
                WHERE id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }

    public function get_organization($id) {
        $sql = "SELECT *
                FROM yima_sys_organization kso LEFT JOIN (select id  as grade_id, title as grade_title from yima_sys_grade) ktg on kso.grade = ktg.grade_id
                WHERE kso.id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }

    public function add_question($title, $test, $question, $type, $author, $time) {
        $sql = 'INSERT into yima_nt_question(title,test_id,question, question_type, author_id,date_added,last_modified) 
            VALUES(:title,:test_id,:question, :question_type, :author_id,:date_added,:last_modified)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':test_id', $test, PDO::PARAM_INT);
        $command->bindParam(':question', $question, PDO::PARAM_STR);
        $command->bindParam(':question_type', $type, PDO::PARAM_INT);
        $command->bindParam(':author_id', $author, PDO::PARAM_INT);

        $command->bindParam(':date_added', $time, PDO::PARAM_INT);
        $command->bindParam(':last_modified', $time, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function add_answer($qid, $choice1, $choice2, $choice3, $choice4, $choice) {
        $sql = 'INSERT into yima_nt_answer_scq(question_id,choice_1,choice_2,choice_3,choice_4,right_choice)
            VALUES(:question_id,:choice_1,:choice_2,:choice_3,:choice_4,:right_choice)';
        $command = Yii::app()->db->createCommand($sql);

        $command->bindParam(':choice_1', $choice1, PDO::PARAM_STR);
        $command->bindParam(':choice_2', $choice2, PDO::PARAM_STR);
        $command->bindParam(':choice_3', $choice3, PDO::PARAM_STR);
        $command->bindParam(':choice_4', $choice4, PDO::PARAM_STR);

        $command->bindParam(':question_id', $qid, PDO::PARAM_INT);
        $command->bindParam(':right_choice', $choice, PDO::PARAM_INT);


        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

}

?>
