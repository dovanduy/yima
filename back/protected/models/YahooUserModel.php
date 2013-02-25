<?php

class YahooUserModel extends CFormModel {

    public function __construct() {
        
    }

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND ysu.email like :email";
            $params[] = array('name' => ':email', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        if (isset($args['deleted'])) {
            $custom.= " AND ysu.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT ysu.*,yt.amount,ynt.total_test,yp.total_post,yc.total_card,ycu.total_coupon
                FROM yahoo_users ysu
                LEFT JOIN (SELECT SUM(amount) as amount,user_id
                            FROM yima_transactions
                            GROUP BY user_id) yt
                ON yt.user_id = ysu.id
                LEFT JOIN (SELECT count(*) as total_test,author_id
                            FROM yima_nt_test
                            GROUP BY author_id) ynt
                ON ynt.author_id = ysu.id
                LEFT JOIN (SELECT count(*) as total_post,author_id
                            FROM yima_posts
                            GROUP BY author_id) yp
                ON yp.author_id = ysu.id
                LEFT JOIN (SELECT count(*) as total_card,user_id
                            FROM yima_cards
                            GROUP BY user_id) yc
                ON yc.user_id = ysu.id
                LEFT JOIN (SELECT count(*) as total_coupon,user_id
                            FROM yima_coupon_user
                            GROUP BY user_id) ycu
                ON ycu.user_id = ysu.id
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
            $custom.= " AND email like :email";
            $params[] = array('name' => ':email', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        if (isset($args['deleted'])) {
            $custom.= " AND deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }


        $sql = "SELECT count(*) as total
                FROM yahoo_users
                WHERE 1
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function get_all() {
        $sql = "SELECT id, title, email, firstname, lastname, thumbnail, group_id, role
                FROM yahoo_users
                ";
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

    public function get($id) {
        $sql = "SELECT ysu.*,yt.amount,ynt.total_test,yp.total_post,yc.total_card,ycu.total_coupon
                FROM yahoo_users ysu
                LEFT JOIN (SELECT SUM(amount) as amount,user_id
                            FROM yima_transactions
                            GROUP BY user_id) yt
                ON yt.user_id = ysu.id
                LEFT JOIN (SELECT count(*) as total_test,author_id
                            FROM yima_nt_test
                            GROUP BY author_id) ynt
                ON ynt.author_id = ysu.id
                LEFT JOIN (SELECT count(*) as total_post,author_id
                            FROM yima_posts
                            GROUP BY author_id) yp
                ON yp.author_id = ysu.id
                LEFT JOIN (SELECT count(*) as total_card,user_id
                            FROM yima_cards
                            GROUP BY user_id) yc
                ON yc.user_id = ysu.id
                LEFT JOIN (SELECT count(*) as total_coupon,user_id
                            FROM yima_coupon_user
                            GROUP BY user_id) ycu
                ON ycu.user_id = ysu.id
                WHERE ysu.id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }
    
    public function get_by_title($title) {
        $sql = "SELECT ysu.*,yt.amount,ynt.total_test,yp.total_post,yc.total_card,ycu.total_coupon
                FROM yahoo_users ysu
                LEFT JOIN (SELECT SUM(amount) as amount,user_id
                            FROM yima_transactions
                            GROUP BY user_id) yt
                ON yt.user_id = ysu.id
                LEFT JOIN (SELECT count(*) as total_test,author_id
                            FROM yima_nt_test
                            GROUP BY author_id) ynt
                ON ynt.author_id = ysu.id
                LEFT JOIN (SELECT count(*) as total_post,author_id
                            FROM yima_posts
                            GROUP BY author_id) yp
                ON yp.author_id = ysu.id
                LEFT JOIN (SELECT count(*) as total_card,user_id
                            FROM yima_cards
                            GROUP BY user_id) yc
                ON yc.user_id = ysu.id
                LEFT JOIN (SELECT count(*) as total_coupon,user_id
                            FROM yima_coupon_user
                            GROUP BY user_id) ycu
                ON ycu.user_id = ysu.id
                WHERE ysu.title = :title
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":title", $title);
        return $command->queryRow();
    }

    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yahoo_users set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function add($title, $password, $secret_key, $role, $firstname, $last_name, $email, $img, $thumbnail, $time) {
        $sql = "INSERT INTO yahoo_users(title, password, secret_key, role, firstname, lastname, email, date_added, img, thumbnail) VALUES(:title, :password, :secret_key, :role, :firstname, :lastname, :email, :date_added, :img, :thumbnail)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":title", $title, PDO::PARAM_STR);
        $command->bindParam(":password", $password, PDO::PARAM_STR);
        $command->bindParam(":secret_key", $secret_key, PDO::PARAM_STR);
        $command->bindParam(":role", $role, PDO::PARAM_STR);
        $command->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $command->bindParam(":lastname", $last_name, PDO::PARAM_STR);
        $command->bindParam(":email", $email, PDO::PARAM_STR);
        $command->bindParam(":date_added", $time, PDO::PARAM_INT);
        $command->bindParam(":img", $img, PDO::PARAM_STR);
        $command->bindParam(":thumbnail", $thumbnail, PDO::PARAM_STR);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function user_existed($title) {
        $sql = 'SELECT id 
                FROM yahoo_users 
                WHERE title = :title';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $admin = $command->queryRow();
        if (!$admin)
            return FALSE;
        return TRUE;
    }

    public function email_existed($email) {
        $sql = 'SELECT id 
                FROM yahoo_users 
                WHERE email = :email';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':email', $email, PDO::PARAM_STR);
        $email = $command->queryRow();
        if (!$email)
            return FALSE;
        return TRUE;
    }

}

?>
