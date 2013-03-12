<?php

class TransactionModel extends CFormModel {
    
    public function gets($args = array(),$page = 1,$ppp = 20){
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();
        
        if(isset($args['user_id'])){
            $custom.= " AND yt.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }
        
        if(isset($args['ref_id'])){
            $custom.= " AND yt.ref_id = :ref_id";
            $params[] = array('name' => ':ref_id', 'value' => $args['ref_id'], 'type' => PDO::PARAM_INT);
        }
        
        if(isset($args['ref_type'])){
            $custom.= " AND yt.ref_type = :ref_type";
            $params[] = array('name' => ':ref_type', 'value' => $args['ref_type'], 'type' => PDO::PARAM_STR);
        }        
        
        
        $sql = "SELECT yt.*,ysu.firstname,ysu.lastname,ysu.email
                FROM yima_transactions yt
                LEFT JOIN yima_sys_user ysu
                ON ysu.id = yt.user_id
                WHERE 1
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
        
        if(isset($args['user_id'])){
            $custom.= " AND yt.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }
        
        if(isset($args['ref_id'])){
            $custom.= " AND yt.ref_id = :ref_id";
            $params[] = array('name' => ':ref_id', 'value' => $args['ref_id'], 'type' => PDO::PARAM_INT);
        }
        
        if(isset($args['ref_type'])){
            $custom.= " AND yt.ref_type = :ref_type";
            $params[] = array('name' => ':ref_type', 'value' => $args['ref_type'], 'type' => PDO::PARAM_STR);
        }
        
        $sql = "SELECT count(*) as total
                FROM yima_transactions yt
                WHERE 1
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function get_by_cards($args = array(),$page = 1,$ppp = 20){
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();
        
        if(isset($args['user_id'])){
            $custom.= "AND yt.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT yt.*,yc.title as card_code,yct.title as card_type
                FROM yima_transactions yt
                LEFT JOIN yima_cards yc
                ON yc.id = yt.ref_id
                LEFT JOIN yima_card_types yct
                ON yct.id = yc.card_type_id
                WHERE ref_type = 'card'
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
    
    public function count_by_cards($args = array()){
        $custom = "";
        $params = array();
        
        if(isset($args['user_id'])){
            $custom.= "AND user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT count(*) as total
                FROM yima_transactions
                WHERE ref_type = 'card'
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function get_by_coupons($args = array(),$page = 1,$ppp = 20){
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();
        
        if(isset($args['user_id'])){
            $custom.= "AND yt.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT yt.*,ycc.title as card_code
                FROM yima_transactions yt
                LEFT JOIN yima_coupon_codes ycc
                ON ycc.id = yt.ref_id
                WHERE ref_type = 'coupon'
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
    
    public function count_by_coupons($args = array()){
        $custom = "";
        $params = array();
        
        if(isset($args['user_id'])){
            $custom.= "AND user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT count(*) as total
                FROM yima_transactions
                WHERE ref_type = 'coupon'
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function add($ref_type,$ref_id,$user_id,$amount,$description = ''){
        $time = time();
        $sql = "INSERT INTO yima_transactions(ref_type,ref_id,user_id,amount,date_added,description) VALUES(:ref_type,:ref_id,:user_id,:amount,:date_added,:description)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":ref_type", $ref_type);
        $command->bindParam(":ref_id", $ref_id);
        $command->bindParam(":user_id", $user_id);
        $command->bindParam(":amount", $amount);
        $command->bindParam(":date_added", $time);
        $command->bindParam(":description", $description);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }
    
    public function get_user_amount($user_id){
        $sql = "SELECT SUM(amount) as total
                FROM yima_transactions
                WHERE user_id  = :user_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':user_id', $user_id,PDO::PARAM_INT);
        $sum = $command->queryRow();
        return (int)$sum['total'];
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