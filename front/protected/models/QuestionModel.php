<?php

class QuestionModel extends CFormModel {

    public function get_by_test($test_id) {
        $sql = "SELECT *
                FROM yima_nt_question
                WHERE test_id = :test_id
                AND deleted = 0";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":test_id", $test_id);
        return $command->queryAll();
    }
    
    public function count_by_test($test_id) {
        $sql = "SELECT count(*) as total
                FROM yima_nt_question
                WHERE test_id = :test_id
                AND deleted = 0";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":test_id", $test_id);
        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function get($id){
        $sql = "SELECT ynq.*,ynt.title as test_title
                FROM yima_nt_question ynq
                LEFT JOIN yima_nt_test ynt
                ON ynq.test_id = ynt.id
                WHERE ynq.id=:id
                AND ynq.deleted = 0";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryRow();
    }
    
    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_nt_question set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

}