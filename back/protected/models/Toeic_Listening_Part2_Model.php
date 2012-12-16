<?php

class Toeic_Listening_Part2_Model {

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND ktlp.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        if (isset($args['lid']) && $args['lid'] != "") {
            $custom .= " AND ktlp.lid = :listening_id";
            $params[] = array('name' => ':listening_id', 'value' => $args['lid'], 'type' => PDO::PARAM_INT);
        }
        $sql = "SELECT *
                FROM yima_toeic_listening_part2 ktlp 
                WHERE 1
                $custom
                ORDER BY ktlp.title ASC
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
            $custom = " AND ktlp.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        if (isset($args['lid']) && $args['lid'] != "") {
            $custom .= " AND ktlp.lid = :listening_id";
            $params[] = array('name' => ':listening_id', 'value' => $args['lid'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT count(ktlp.id) as total
                FROM yima_toeic_listening_part2 ktlp 
                WHERE 1
                $custom
                ORDER BY ktlp.title ASC";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function add($lid, $title, $answer, $sound1, $author, $time) {
        $sql = "INSERT into yima_toeic_listening_part2(lid, title, lsound, answer, author_id, date_added) 
            values (:lid, :title, :lsound, :answer, :author_id, :date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':lid', $lid, PDO::PARAM_INT);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':lsound', $sound1, PDO::PARAM_STR);
        $command->bindParam(':answer', $answer, PDO::PARAM_INT);
        $command->bindParam(':author_id', $author, PDO::PARAM_INT);
        $command->bindParam(':date_added', $time, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->getLastInsertID();
    }

    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_toeic_listening_part2 set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function get($id) {
        $sql = "SELECT *
                FROM yima_toeic_listening_part2 ktlp
                WHERE ktlp.id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }

}

?>
