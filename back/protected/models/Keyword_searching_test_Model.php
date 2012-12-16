<?php

class Keyword_searching_test_Model extends CFormModel {

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND (keyword_subject like :title OR keyword_owner like :title)";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_sys_keyword_searching_test ksks 
                WHERE 1
                $custom
                ORDER BY ksks.keyword_subject ASC
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
            $custom = " AND (keyword_subject like :title OR keyword_owner like :title)";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        $sql = "SELECT count(*) as total
                FROM yima_sys_keyword_searching_test
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
        $sql = "SELECT *
                FROM yima_sys_keyword_searching_test ksks
                WHERE ksks.id = :id
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
        $sql = 'update yima_sys_keyword_searching_test set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function add($subject, $owner, $featured, $date_added) {
        $sql = "INSERT INTO yima_sys_keyword_searching_test (keyword_subject, keyword_owner , featured, date_added) 
                VALUES(:subject, :owner, :featured, :date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":subject", $subject, PDO::PARAM_STR);
        $command->bindParam(":owner", $owner, PDO::PARAM_INT);
        $command->bindParam(":featured", $featured, PDO::PARAM_INT);
        $command->bindParam(":date_added", $date_added, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

}

?>
