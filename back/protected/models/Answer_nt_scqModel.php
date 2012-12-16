<?php

class Answer_nt_scqModel extends CFormModel {

    public function get_by_question($qid) {
        $sql = "SELECT *
                FROM yima_nt_answer_scq
                WHERE question_id = :qid";

        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":qid", $qid);
        
        return $command->queryRow();
    }

    public function counts_by_question($qid, $args) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        $sql = "SELECT count(*) as total
                FROM yima_nt_answer_scq
                WHERE question_id = :qid
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":qid", $qid);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function get($id) {
        $sql = "SELECT *
                FROM yima_nt_answer_scq
                WHERE id = :id
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
        $sql = 'update yima_nt_answer_scq set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function actionDelete($id) {
        $speaking = $this->SpeakingModel->get($id);
        if (!$speaking)
            return;

        $this->SpeakingModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function add($qid, $choice1, $choice2, $choice3, $choice4, $choice) {
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
