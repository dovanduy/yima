<?php

class CouponModel extends CFormModel {

    public function gets($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND ycc.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['deleted'])) {
            $custom.= " AND ycc.deleted = :deleted";
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
            $custom.= " AND ycc.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['deleted'])) {
            $custom.= " AND ycc.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT count(*) as total
                FROM yima_coupon_codes ycc
                WHERE 1
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function get_by_user($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND ycc.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['deleted'])) {
            $custom.= " AND ycc.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['user_id'])) {
            $custom.= " AND ycu.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT ycc.*,ycu.date_added as date_used,ysu.email,ysu.lastname,ysu.firstname,times.total
                FROM yima_coupon_user ycu
                LEFT JOIN yima_coupon_codes ycc
                ON ycc.id = ycu.coupon_id
                LEFT JOIN yima_sys_user ysu
                ON ysu.id = ycu.user_id
                LEFT JOIN (SELECT count(*) as total,coupon_id
                            FROM yima_coupon_user
                            GROUP BY coupon_id) times
                ON ycu.coupon_id = times.coupon_id
                WHERE 1
                $custom
                ORDER BY ycu.date_added DESC
                LIMIT :page,:ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }

    public function count_by_user($args) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND ycc.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['deleted'])) {
            $custom.= " AND ycc.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['user_id'])) {
            $custom.= " AND ycu.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT count(*) as total
                FROM yima_coupon_user ycu
                LEFT JOIN yima_coupon_codes ycc
                ON ycc.id = ycu.coupon_id
                LEFT JOIN yima_sys_user ysu
                ON ysu.id = ycu.user_id
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
        $sql = 'update yima_coupon_codes set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function add($title,$amount) {
        $time = time();
        $sql = 'INSERT into yima_coupon_codes(title,amount, date_added) VALUES(:title,:amount, :date_added)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':amount', $amount, PDO::PARAM_INT);
        $command->bindParam(':date_added', $time);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }


}