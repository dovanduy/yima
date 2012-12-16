<?php

class ListeningModel extends CFormModel {

    public function gets($args, $part, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND ktl.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *, count_cq, count_mcq, count_oq, count_scq, count_video
                FROM yima_toefl_listening ktl LEFT JOIN (select count(id) as count_cq, lid as lid_ktlc 
                                                        from yima_toefl_listening_cq
                                                        group by lid_ktlc) ktlc on ktlc.lid_ktlc = ktl.id
                                             LEFT JOIN (select count(id) as count_mcq, lid as lid_ktlm 
                                                        from yima_toefl_listening_mcq
                                                        group by lid_ktlm) ktlm on ktlm.lid_ktlm = ktl.id
                                             LEFT JOIN (select count(id) as count_oq, lid as lid_ktlo 
                                                        from yima_toefl_listening_oq
                                                        group by lid_ktlo) ktlo on ktlo.lid_ktlo = ktl.id
                                             LEFT JOIN (select count(id) as count_scq, lid as lid_ktls 
                                                        from yima_toefl_listening_scq
                                                        group by lid_ktls) ktls on ktls.lid_ktls = ktl.id
                                             LEFT JOIN (select count(id) as count_video, lid as lid_ktlv 
                                                        from yima_toefl_listening_video
                                                        group by lid_ktlv) ktlv on ktlv.lid_ktlv = ktl.id
                WHERE ktl.listening_part = :part
                $custom
                GROUP BY ktl.id
                ORDER BY ktl.title ASC
                LIMIT :page,:ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":part", $part);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }

    public function get_all($args) {
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT id, title
                FROM yima_toefl_listening
                WHERE 1
                $custom
                ORDER BY title ASC";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        return $command->queryAll();
    }

    public function get_all_by_part($args, $part) {
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT id, title
                FROM yima_toefl_listening
                WHERE listening_part = :part
                $custom
                ORDER BY title ASC";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":part", $part);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        return $command->queryAll();
    }

    public function counts($args, $part) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        $sql = "SELECT count(id) as total
                FROM yima_toefl_listening
                WHERE listening_part = :part
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":part", $part);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function get($id) {
        $sql = "SELECT *
                FROM yima_toefl_listening
                WHERE id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }

    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_toefl_listening set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function actionDelete($id) {
        $listening = $this->ListeningModel->get($id);
        if (!$listening)
            return;

        $this->ListeningModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function add($title,$level,$type,$test_time,$source,$keyword,$audio,$author,$part, $time) {
        $sql = 'INSERT into yima_toefl_listening(title,level,test_time,keyword,source,listening_type,listening_part,lsound,author, date_added) 
            VALUES(:title,:level,:test_time,:keyword,:source,:listening_type,:listening_part,:lsound,:author,:date_added)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':level', $level, PDO::PARAM_INT);
        $command->bindParam(':test_time', $test_time, PDO::PARAM_INT);
        $command->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $command->bindParam(':source', $source, PDO::PARAM_STR);
        $command->bindParam(':listening_type', $type, PDO::PARAM_INT);
        $command->bindParam(':listening_part', $part, PDO::PARAM_INT);
        $command->bindParam(':lsound', $audio, PDO::PARAM_STR);
        $command->bindParam(':author', $author, PDO::PARAM_STR);         
        $command->bindParam(':date_added', $time, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function listening_is_existed($id) {
        $sql = 'SELECT id
                FROM yima_toefl_listening
                WHERE id = :id';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':id', $id, PDO::PARAM_INT);
        $item = $command->queryRow();
        if (!$item)
            return FALSE;
        return TRUE;
    }
    
    public function get_by_part($args, $part) {
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT id, title,listening_part
                FROM yima_toefl_listening
                WHERE listening_part = $part
                ORDER BY title ASC";


        $command = Yii::app()->db->createCommand($sql);

        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        return $command->queryAll();
    }
    
    public function get_all_listening() {
 
        $sql = "SELECT *
                FROM yima_toefl_listening";    
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

}

?>
