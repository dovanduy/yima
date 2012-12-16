<?php

class QuestionModel extends CFormModel {

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND ynq.question like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['test_id'])) {
            $custom.= " AND ynq.test_id = :test_id";
            $params[] = array('name' => ':test_id', 'value' => $args['test_id'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['deleted'])) {
            $custom.= " AND ynq.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT ynq.*,ynt.title as test_title
                FROM yima_nt_question ynq
                LEFT JOIN yima_nt_test ynt
                ON ynt.id = ynq.test_id
                WHERE 1
                $custom
                ORDER BY ynq.date_added DESC
                LIMIT :page,:ppp";
        
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }

    public function counts($args) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND ynq.question like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['test_id'])) {
            $custom.= " AND ynq.test_id = :test_id";
            $params[] = array('name' => ':test_id', 'value' => $args['test_id'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['deleted'])) {
            $custom.= " AND ynq.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT count(*) as total
                FROM yima_nt_question ynq
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
        $sql = "SELECT ynq.*,ynt.title as test_title
                FROM yima_nt_question  ynq
                LEFT JOIN yima_nt_test ynt
                ON ynt.id = ynq.test_id
                WHERE ynq.id = :id
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
        $sql = 'update yima_nt_question set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function add($title, $test, $question, $type, $author,$time) {
        $sql = 'INSERT into yima_nt_question(title,test_id,question, question_type, author_id,date_added) 
            VALUES(:title,:test_id,:question, :question_type, :author_id,:date_added)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':test_id', $test, PDO::PARAM_INT);
        $command->bindParam(':question', $question, PDO::PARAM_STR);
        $command->bindParam(':question_type', $type, PDO::PARAM_INT);
        $command->bindParam(':author_id', $author, PDO::PARAM_INT);
        $command->bindParam(':date_added', $time, PDO::PARAM_INT);
        $command->execute();
        
        return Yii::app()->db->lastInsertID;
    }

    public function get_to_list($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_nt_question 
                WHERE disabled = 0 AND deleted = 0
                $custom
                ORDER BY title ASC
                LIMIT :page,:ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }
}

?>
