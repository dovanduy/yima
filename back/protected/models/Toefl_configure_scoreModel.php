<?php

class Toefl_configure_scoreModel extends CFormModel {

    public function get_by_question($question_id, $question_type) {
        $sql = 'SELECT *
                FROM yima_toefl_configure_score
                WHERE question_id = :question_id and question_type = :question_type
                ORDER BY rightchoices ASC';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $command->bindParam(':question_type', $question_type, PDO::PARAM_STR);
        return $command->queryAll();
    }

    public function configure_score($question_id, $question_type, $choice_id, $score) {
        $item = $this->existed_choice_question($question_id, $choice_id, $question_type);
        if (!$item) {
            $this->add($question_id, $question_type, $choice_id, $score);
            return;
        }
        $this->update(array('score' => $score, 'id' => $item));
    }

    public function existed_choice_question($question_id, $question_type, $choice_id) {
        $sql = 'SELECT id
                FROM yima_toefl_configure_score
                WHERE question_id = :question_id and rightchoices = :choice_id and question_type = :question_type';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $command->bindParam(':choice_id', $choice_id, PDO::PARAM_INT);
        $command->bindParam(':question_type', $question_type, PDO::PARAM_STR);
        $item = $command->queryRow();
        if (!$item)
            return FALSE;
        return $item['id'];
    }

    public function add($question_id, $question_type, $choice_id, $score) {
        $sql = 'INSERT into yima_toefl_configure_score(question_type, question_id, rightchoices, score) values(:question_type, :question_id, :choice_id, :score)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':question_type', $question_type, PDO::PARAM_STR);
        $command->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $command->bindParam(':choice_id', $choice_id, PDO::PARAM_INT);
        $command->bindParam(':score', $score, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_toefl_configure_score set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function get($score_id) {
        $sql = 'SELECT * from yima_toefl_configure_score WHERE id = :score_id';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':score_id', $score_id, PDO::PARAM_INT);
        return $command->queryRow();
    }

}

?>
