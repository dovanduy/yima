<?php

class SiteOptionModel extends CFormModel {

    public function __construct() {
        
    }
    
    public function gets(){
        
        $sql = "SELECT *
                FROM yima_site_options
                ";
        $command = Yii::app()->db->createCommand($sql);               
        return $command->queryAll();
    }
    
    public function counts(){
        
        
        $sql = "SELECT count(*) as total
                FROM yima_site_options                
                ";
        $command = Yii::app()->db->createCommand($sql);        
        
        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_site_options set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function add($meta_key, $meta_value, $meta_type,$meta_label) {
        $sql = "INSERT INTO yima_site_options(meta_key,meta_value,meta_type,meta_label) VALUES(:meta_key,:meta_value,:meta_type,:meta_label)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":meta_key", $meta_key);
        $command->bindParam(":meta_value", $meta_value);
        $command->bindParam(":meta_type", $meta_type);
        $command->bindParam(":meta_label", $meta_label);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }    
    
    public function update_meta($meta_key, $meta_value) {
        $sql = "UPDATE yima_site_options
                SET meta_value = :meta_value
                WHERE meta_key = :meta_key";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":meta_key", $meta_key);
        $command->bindParam(":meta_value", $meta_value);
        return $command->execute();        
    }
    
    public function delete($id) {
        $sql = "DELETE FROM yima_site_options
                WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id,PDO::PARAM_INT);
        return $command->execute();        
    }
    
    public function delete_all() {
        $sql = "DELETE FROM yima_site_options
                ";
        $command = Yii::app()->db->createCommand($sql);
        
        return $command->execute();        
    }
}