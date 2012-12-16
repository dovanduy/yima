<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class DataModel extends CFormModel {   
     
    
    public function get_all_listening_cq() {
 
        $sql = "SELECT *
                FROM yima_toefl_listening_cq";    
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }
}
?>
