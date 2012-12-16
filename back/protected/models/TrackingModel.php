<?php

class TrackingModel extends CFormModel {
    
    public function gets($args = array(),$page = 1,$ppp = 20){
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();
        
        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND ysu.email like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if(isset($args['user_id'])){
            $custom.= "AND yt.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT yt.*,ysu.email,ysu.lastname,ysu.firstname
                FROM yima_trackings yt,yima_sys_user ysu
                WHERE ysu.id = yt.user_id                
                $custom
                ORDER BY yt.date_added DESC
                LIMIT :page,:ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page,PDO::PARAM_INT);
        $command->bindParam(":ppp", $ppp,PDO::PARAM_INT);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }
    
    public function counts($args = array()){
        $custom = "";
        $params = array();
        
        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND ysu.email like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if(isset($args['user_id'])){
            $custom.= "AND yt.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT count(*) as total
                FROM yima_trackings yt,yima_sys_user ysu
                WHERE ysu.id = yt.user_id     
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }
    
    
    public function get_user_amount($user_id){
        $sql = "SELECT SUM(amount) as total
                FROM yima_transactions
                WHERE user_id  = :user_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':user_id', $user_id,PDO::PARAM_INT);
        $sum = $command->queryRow();
        return $sum['total'];
    }

    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_cards set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }
    
}