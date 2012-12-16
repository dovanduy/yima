<?php

class AnswerModel extends CFormModel {

    public function get_scq_by_question($question_id) {
        $sql = "SELECT *
                FROM yima_nt_answer_scq
                WHERE question_id = :question_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":question_id", $question_id);
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
}