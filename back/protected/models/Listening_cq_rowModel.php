<?php

class Listening_cq_rowModel extends CFormModel {

    public function get_by_question($question_id) {
        $sql = 'SELECT *
                FROM yima_toefl_listening_cq_row
                WHERE cqid = :question_id
                ORDER BY col ASC';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        return $command->queryAll();
    }

    public function add($question_id, $title) {
        $sql = 'INSERT into yima_toefl_listening_cq_row(cqid, title) values(:question_id, :title)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function update($title, $row_id) {
        $sql = 'UPDATE yima_toefl_listening_cq_row SET title =: title where id = :row_id )';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':row_id', $row_id, PDO::PARAM_INT);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->execute();
    }

}

?>
