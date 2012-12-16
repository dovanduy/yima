<?php

class CardModel extends CFormModel {

    public function gets($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND yc.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['deleted'])) {
            $custom.= " AND yc.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['card_type_id'])) {
            $custom.= " AND yc.card_type_id = :card_type_id";
            $params[] = array('name' => ':card_type_id', 'value' => $args['card_type_id'], 'type' => PDO::PARAM_INT);
        }
        
        if(isset($args['tracking_id'])){
            $custom.= " AND yc.id IN (SELECT card_id
                                        FROM yima_tracking_card
                                        WHERE tracking_id = :tracking_id)";
            $params[] = array('name' => ':tracking_id', 'value' => $args['tracking_id'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['user_id'])) {
            $custom.= " AND yc.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT yc.*,yct.title as card_type_name,ysu.email
                FROM yima_cards yc
                LEFT JOIN yima_card_types yct
                ON yc.card_type_id = yct.id
                LEFT JOIN yima_sys_user ysu
                ON ysu.id = yc.user_id
                WHERE 1
                $custom
                ORDER BY date_added DESC
                LIMIT :page,:ppp";

        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }

    public function counts($args) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND yc.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['deleted'])) {
            $custom.= " AND yc.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['card_type_id'])) {
            $custom.= " AND yc.card_type_id = :card_type_id";
            $params[] = array('name' => ':card_type_id', 'value' => $args['card_type_id'], 'type' => PDO::PARAM_INT);
        }
        
        if(isset($args['tracking_id'])){
            $custom.= " AND yc.id IN (SELECT card_id
                                        FROM yima_tracking_card
                                        WHERE tracking_id = :tracking_id)";
            $params[] = array('name' => ':tracking_id', 'value' => $args['tracking_id'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['user_id'])) {
            $custom.= " AND yc.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT count(*) as total
                FROM yima_cards yc
                LEFT JOIN yima_card_types yct
                ON yc.card_type_id = yct.id
                WHERE 1
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function get_card_types($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['deleted'])) {
            $custom.= " AND deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT *
                FROM yima_card_types
                WHERE 1
                $custom
                ORDER BY amount
                LIMIT :page,:ppp";
        
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }

    public function count_card_types($args) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['deleted'])) {
            $custom.= " AND deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT count(*) as total
                FROM yima_card_types
                WHERE 1
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function get_card_type($id) {
        
        $sql = "SELECT *
                FROM yima_card_types
                WHERE id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id,PDO::PARAM_INT);
        return $command->queryRow();
    }
    
    public function update_card_type($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_card_types set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }
    
    public function add_card_type($title,$description,$amount) {
        $time = time();
        $sql = 'INSERT into yima_card_types(title,description,amount,date_added) VALUES(:title,:description,:amount,:date_added)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title);
        $command->bindParam(':description', $description);
        $command->bindParam(':amount', $amount);
        $command->bindParam(':date_added', $time);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }
    
    public function get($id) {
        
        $sql = "SELECT yc.*,yct.title as card_type_name,ysu.email,yct.amount
                FROM yima_cards yc
                LEFT JOIN yima_card_types yct
                ON yc.card_type_id = yct.id
                LEFT JOIN yima_sys_user ysu
                ON ysu.id = yc.user_id
                WHERE yc.id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id,PDO::PARAM_INT);
        return $command->queryRow();
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

    public function add($type,$title,$date_expired,$amount,$is_sold) {
        $time = time();
        $sql = 'INSERT into yima_cards(card_type_id,title, date_added,date_expired,amount,is_sold) VALUES(:card_type_id,:title, :date_added,:date_expired,:amount,:is_sold)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':card_type_id', $type);
        $command->bindParam(':title', $title);
        $command->bindParam(':date_expired', $date_expired);
        $command->bindParam(':date_added', $time);
        $command->bindParam(':amount', $amount);
        $command->bindParam(':is_sold', $is_sold);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }


}