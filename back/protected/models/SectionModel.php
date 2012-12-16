<?php

class SectionModel extends CFormModel {

    public function gets() {
        $sql = "SELECT *
                FROM yima_sys_section
                WHERE id = 1 or id = 2
                ORDER BY id ASC";
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

}

?>
