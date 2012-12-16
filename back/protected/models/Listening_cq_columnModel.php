<?php

class Listening_cq_columnModel extends CFormModel {

    public function get_by_question($question_id) {
        $sql = 'SELECT *
                FROM yima_toefl_listening_cq_column
                WHERE cqid = :question_id';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        return $command->queryAll();
    }

    public function add($question_id, $title) {
        $sql = 'INSERT into yima_toefl_listening_cq_column(cqid, title) values(:question_id, :title)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

}

?>
