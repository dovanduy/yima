<?php

class PaypalModel extends CFormModel {
    
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
        
        $sql = "SELECT yt.*,yp.paypal_code,yp.paypal_fee,yp.id as paypal_id,ysu.email,ysu.lastname,ysu.firstname
                FROM yima_paypals yp, yima_trackings yt,yima_sys_user ysu
                WHERE yp.id = yt.ref_id
                AND yt.payment_type = 'paypal'
                AND yt.user_id = ysu.id
                $custom
                ORDER BY yp.date_added        
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
        
        $sql = "SELECT count(yp.id) as total
                FROM yima_paypals yp, yima_trackings yt,yima_sys_user ysu
                WHERE yp.id = yt.ref_id
                AND yt.payment_type = 'paypal'
                AND yt.user_id = ysu.id
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }
    
}