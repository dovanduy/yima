<?php

class TrackingModel extends CFormModel {

    public function __construct() {
        
    }
    
    public function get_paypals($args,$page = 1,$ppp = 20){
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();
        
        if(isset($args['user_id'])){
            $custom.= "AND yt.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT yt.*,yp.paypal_fee
                FROM yima_trackings yt
                LEFT JOIN yima_paypals yp
                ON yp.id = yt.ref_id
                WHERE yt.deleted = 0
                AND yt.completed = 1
                AND yt.payment_type = 'paypal'
                $custom
                ORDER BY date_added DESC
                LIMIT :page,:ppp";
        
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page,PDO::PARAM_INT);
        $command->bindParam(":ppp", $ppp,PDO::PARAM_INT);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }
    
    public function count_paypals($args){
        $custom = "";
        $params = array();
        
        if(isset($args['user_id'])){
            $custom.= "AND yt.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT count(*) as total
                FROM yima_trackings yt
                LEFT JOIN yima_paypals yp
                ON yp.id = yt.ref_id
                WHERE yt.deleted = 0
                AND yt.completed = 1
                AND yt.payment_type = 'paypal'
                $custom";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        $count = $command->queryRow();

        return $count['total'];
    }

    public function add($payment_type, $payment_to, $currency, $user_id,$amount,$amount_vnd,$card_info,$card_ids,$ip,$agent) {
        $time = time();
        $sql = "INSERT INTO yima_trackings(payment_type,payment_to,currency,user_id,amount,amount_vnd,date_added,card_info,card_ids,user_ip,user_agent) VALUES(:payment_type,:payment_to,:currency,:user_id,:amount,:amount_vnd,:date_added,:card_info,:card_ids,:user_ip,:user_agent)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":payment_type", $payment_type);
        $command->bindParam(":payment_to", $payment_to);
        $command->bindParam(":currency", $currency);
        $command->bindParam(":user_id", $user_id);
        $command->bindParam(":amount", $amount);
        $command->bindParam(":amount_vnd", $amount_vnd);
        $command->bindParam(":card_info", $card_info);
        $command->bindParam(":date_added", $time);
        $command->bindParam(":card_ids", $card_ids);
        $command->bindParam(":user_ip", $ip);
        $command->bindParam(":user_agent", $agent);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function get($id) {
        $sql = "SELECT *
                FROM yima_trackings
                WHERE id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryRow();
    }

    public function get_by_txn_id($txn_id) {
        $sql = "SELECT *
                FROM yima_trackings
                WHERE txn_id = :txn_id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":txn_id", $txn_id);
        return $command->queryRow();
    }

    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_trackings set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }
    
    public function add_tracking_card($tracking_id,$card_id,$user_id){
        $time = time();
        $sql = "INSERT INTO yima_tracking_card(tracking_id,card_id,user_id,date_added) VALUES(:tracking_id,:card_id,:user_id,:date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':tracking_id', $tracking_id,PDO::PARAM_INT);
        $command->bindParam(':card_id', $card_id,PDO::PARAM_INT);
        $command->bindParam(':user_id', $user_id,PDO::PARAM_INT);
        $command->bindParam(':date_added', $time,PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }
    
}