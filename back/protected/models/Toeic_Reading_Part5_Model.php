<?php

class Toeic_Reading_Part5_Model {

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND ktrp.question like :question";
            $params[] = array('name' => ':question', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        if (isset($args['rid']) && $args['rid'] != "") {
            $custom .= " AND ktrp.rid = :reading_id";
            $params[] = array('name' => ':reading_id', 'value' => $args['rid'], 'type' => PDO::PARAM_INT);
        }
        $sql = "SELECT *
                FROM yima_toeic_reading_part5 ktrp 
                WHERE 1
                $custom
                ORDER BY ktrp.question ASC
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
            $custom = " AND ktrp.question like :question";
            $params[] = array('name' => ':question', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        if (isset($args['rid']) && $args['rid'] != "") {
            $custom .= " AND ktrp.rid = :reading_id";
            $params[] = array('name' => ':reading_id', 'value' => $args['rid'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT count(ktrp.id) as total
                FROM yima_toeic_reading_part5 ktrp 
                WHERE 1
                $custom
                ORDER BY ktrp.question ASC";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function add($reading_id, $question, $choice1, $choice2, $choice3, $choice4, $answer, $date_added) {
        $sql = "INSERT into yima_toeic_reading_part5(rid, question, choice1, choice2, choice3, choice4, answer, date_added) values (:reading_id, :question, :choice1, :choice2, :choice3, :choice4, :answer, :date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':reading_id', $reading_id, PDO::PARAM_INT);
        $command->bindParam(':question', $question, PDO::PARAM_STR);
        $command->bindParam(':choice1', $choice1, PDO::PARAM_STR);
        $command->bindParam(':choice2', $choice2, PDO::PARAM_STR);
        $command->bindParam(':choice3', $choice3, PDO::PARAM_STR);
        $command->bindParam(':choice4', $choice4, PDO::PARAM_STR);
        $command->bindParam(':answer', $answer, PDO::PARAM_INT);
        $command->bindParam(':date_added', $date_added, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->getLastInsertID();
    }

    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_toeic_reading_part5 set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function get($id) {
        $sql = "SELECT *
                FROM yima_toeic_reading_part5 ktrp
                WHERE ktrp.id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }

}
?>
