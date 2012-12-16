<?php

class Toeic_Listening_Part4_Model {

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND ktlp.title like :question";
            $params[] = array('name' => ':question', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        if (isset($args['li']) && $args['li'] != "") {
            $custom .= " AND ktlp.lid = :listening_id";
            $params[] = array('name' => ':listening_id', 'value' => $args['li'], 'type' => PDO::PARAM_INT);
        }
        $sql = "SELECT *
                FROM yima_toeic_listening_part4 ktlp 
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
            $custom = " AND ktlp.title like :question";
            $params[] = array('name' => ':question', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        if (isset($args['ri']) && $args['ri'] != "") {
            $custom .= " AND ktlp.lid = :listening_id";
            $params[] = array('name' => ':listening_id', 'value' => $args['li'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT count(ktlp.id) as total
                FROM yima_toeic_listening_part4 ktlp 
                WHERE 1
                $custom
                ORDER BY ktlp.title ASC";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function add($listening_id, $title, $lsound, $question_1, $choice1_1, $choice2_1, $choice3_1, $choice4_1, $answer_1, $question_2, $choice1_2, $choice2_2, $choice3_2, $choice4_2, $answer_2, $question_3, $choice1_3, $choice2_3, $choice3_3, $choice4_3, $answer_3, $date_added) {
        $sql = "INSERT into yima_toeic_listening_part4(lid, title, lsound, question_1,  choice1_1, choice2_1, choice3_1, choice4_1, answer_1, 
                                                                          question_2,  choice1_2, choice2_2, choice3_2, choice4_2, answer_2,
                                                                          question_3,  choice1_3, choice2_3, choice3_3, choice4_3, answer_3,date_added)
                                               values (:listening_id, :title, :lsound, :question_1, :choice1_1, :choice2_1, :choice3_1, :choice4_1, :answer_1, 
                                                                                        :question_2, :choice1_2, :choice2_2, :choice3_2, :choice4_2, :answer_2,
                                                                                        :question_3, :choice1_3, :choice2_3, :choice3_3, :choice4_3, :answer_3,:date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':listening_id', $listening_id, PDO::PARAM_INT);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':lsound', $lsound, PDO::PARAM_STR);
        $command->bindParam(':question_1', $question_1, PDO::PARAM_STR);
        $command->bindParam(':choice1_1', $choice1_1, PDO::PARAM_STR);
        $command->bindParam(':choice2_1', $choice2_1, PDO::PARAM_STR);
        $command->bindParam(':choice3_1', $choice3_1, PDO::PARAM_STR);
        $command->bindParam(':choice4_1', $choice4_1, PDO::PARAM_STR);
        $command->bindParam(':answer_1', $answer_1, PDO::PARAM_INT);
        $command->bindParam(':question_2', $question_2, PDO::PARAM_STR);
        $command->bindParam(':choice1_2', $choice1_2, PDO::PARAM_STR);
        $command->bindParam(':choice2_2', $choice2_2, PDO::PARAM_STR);
        $command->bindParam(':choice3_2', $choice3_2, PDO::PARAM_STR);
        $command->bindParam(':choice4_2', $choice4_2, PDO::PARAM_STR);
        $command->bindParam(':answer_2', $answer_2, PDO::PARAM_INT);
        $command->bindParam(':question_3', $question_3, PDO::PARAM_STR);
        $command->bindParam(':choice1_3', $choice1_3, PDO::PARAM_STR);
        $command->bindParam(':choice2_3', $choice2_3, PDO::PARAM_STR);
        $command->bindParam(':choice3_3', $choice3_3, PDO::PARAM_STR);
        $command->bindParam(':choice4_3', $choice4_3, PDO::PARAM_STR);
        $command->bindParam(':answer_3', $answer_3, PDO::PARAM_INT);
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
        $sql = 'update yima_toeic_listening_part4 set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function get($id) {
        $sql = "SELECT *
                FROM yima_toeic_listening_part4 ktlp
                WHERE ktlp.id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }

}

?>
