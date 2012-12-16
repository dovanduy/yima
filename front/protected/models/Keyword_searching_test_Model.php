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
        if (isset($args['featured'])) {
            $custom .= " AND featured = 1";
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

    public function add($subject, $owner, $featured, $date_added) {
        $time = time();
        $sql = "INSERT INTO yima_sys_keyword_searching_test (keyword_subject, keyword_owner , featured, date_added) 
                VALUES(:subject, :owner, :featured, :date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":subject", $subject, PDO::PARAM_STR);
        $command->bindParam(":owner", $owner, PDO::PARAM_INT);
        $command->bindParam(":featured", $featured, PDO::PARAM_INT);
        $command->bindParam(":date_added", $time, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

}

?>
