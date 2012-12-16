<?php

class CardModel extends CFormModel {
    
    public function get($id) {
        
        $sql = "SELECT *
                FROM yima_cards
                WHERE is_used = 0
                AND is_sold = 1
                AND deleted = 0
                AND id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id,PDO::PARAM_INT);
        return $command->queryRow();
    }
    
    public function get_by_title($title) {
        
        $sql = "SELECT *
                FROM yima_cards
                WHERE is_used = 0
                AND is_sold = 1
                AND deleted = 0
                AND title = :title
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":title", $title,PDO::PARAM_STR);
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
    
    public function add($type,$title,$date_expired,$amount,$is_sold = 0) {
        $time = time();
        $sql = 'INSERT into yima_cards(card_type_id,title, date_added,date_expired,amount,is_sold) VALUES(:card_type_id,:title, :date_added,:date_expired,:amount,:is_sold)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':card_type_id', $type);
        $command->bindParam(':title', $title);
        $command->bindParam(':date_expired', $date_expired);
        $command->bindParam(':date_added', $time);
        $command->bindParam(':amount', $amount);
        $command->bindParam(':is_sold', $is_sold,PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }
}