<?php

class SiteOptionModel extends CFormModel {

    public function gets(){
        $sql = "SELECT * 
                FROM yima_site_options";
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

}