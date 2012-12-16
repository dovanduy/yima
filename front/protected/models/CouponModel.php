<?php

class CouponModel extends CFormModel {

    public function gets($args = array(), $page = 1, $ppp = 20) {
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
        
        $sql = "SELECT ycc.*,ycu.total
                FROM yima_coupon_codes ycc
                LEFT JOIN (SELECT count(*) as total,coupon_id
                            FROM yima_coupon_user
                            GROUP BY coupon_id) ycu
                ON ycu.coupon_id = ycc.id
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
            $custom.= " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['deleted'])) {
            $custom.= " AND deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT count(*) as total
                FROM yima_coupon_codes
                WHERE 1
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function get($id) {
        
        $sql = "SELECT *
                FROM yima_coupon_codes
                WHERE id = :id
                AND deleted = 0
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id,PDO::PARAM_INT);
        return $command->queryRow();
    }
    
    public function get_by_title($title) {
        
        $sql = "SELECT *
                FROM yima_coupon_codes
                WHERE title = :title
                AND deleted = 0
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":title", $title);
        return $command->queryRow();
    }
    
    public function is_used($coupon_id,$user_id){
        $sql = "SELECT count(*) as total
                FROM yima_coupon_user
                WHERE coupon_id = :coupon_id
                AND user_id = :user_id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":coupon_id", $coupon_id,PDO::PARAM_INT);
        $command->bindParam(":user_id", $user_id,PDO::PARAM_INT);
        $count = $command->queryRow();
        return $count['total'];
    }

    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_coupon_codes set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }
    
    public function add_coupon_user($coupon_id,$user_id){
        $time = time();
        $sql = "INSERT INTO yima_coupon_user(coupon_id,user_id,date_added) VALUES(:coupon_id,:user_id,:date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":coupon_id", $coupon_id,PDO::PARAM_INT);
        $command->bindParam(":user_id", $user_id,PDO::PARAM_INT);
        $command->bindParam(":date_added", $time);
        return $command->execute();
    }
}