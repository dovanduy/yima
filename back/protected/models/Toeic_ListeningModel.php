<?php

class Toeic_ListeningModel {

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND ktl.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_toeic_listening ktl 
                WHERE 1
                $custom
                ORDER BY ktl.title ASC
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
            $custom = " AND ktl.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT count(ktl.id) as total
                FROM yima_toeic_listening ktl 
                WHERE 1
                $custom
                ORDER BY ktl.title ASC";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function add($title, $slug, $keyword, $source, $date_added) {
        $sql = "INSERT into yima_toeic_listening(title, slug, keyword, source, date_added) values (:title, :slug, :source, :keyword, :date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':slug', $slug, PDO::PARAM_STR);
        $command->bindParam(':source', $source, PDO::PARAM_STR);
        $command->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $command->bindParam(':date_added', $date_added, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->getLastInsertID();
    }

    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_toeic_listening set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function get($id) {
        $sql = "SELECT *
                FROM yima_toeic_listening ktl
                WHERE ktl.id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }

    public function get_all() {
        $sql = "SELECT *
                FROM yima_toeic_listening ktl
                ";
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

}

?>
