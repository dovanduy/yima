<?php

class Listening_videoModel extends CFormModel {

    public function gets($args, $lid, $page, $ppp) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        $sql = "SELECT *
                FROM yima_toefl_listening_video
                WHERE lid = :lid 
                $custom
                ORDER BY title ASC
                LIMIT :page, :ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':lid', $lid, PDO::PARAM_INT);
        $command->bindParam(":page", $page, PDO::PARAM_INT);
        $command->bindParam(":ppp", $ppp, PDO::PARAM_INT);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        return $command->queryAll();
    }

    public function counts($args, $lid) {
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        $sql = "SELECT count(id) as total
                FROM yima_toefl_listening_video
                WHERE lid = :lid $custom";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":lid", $lid);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        $count = $command->queryRow();
        return $count['total'];
    }

    public function get($id) {
        $sql = "SELECT *
                FROM yima_toefl_listening_video
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
        $sql = 'update yima_toefl_listening_video set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function actionDelete($id) {
        $listening = $this->Listening_videoModel->get($id);
        if (!$listening)
            return;

        $this->Listening_videoModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function add($lid, $title, $limg,$thumbnail, $time, $date_added) {
        $sql = 'INSERT into yima_toefl_listening_video(lid, title, limg,thumbnail, time, date_added) VALUES(:lid, :title, :limg,:thumbnail, :time, :date_added)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':lid', $lid, PDO::PARAM_INT);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':limg', $limg, PDO::PARAM_STR);
        $command->bindParam(':thumbnail', $thumbnail, PDO::PARAM_STR);
        $command->bindParam(':time', $time, PDO::PARAM_INT);
        $command->bindParam(':date_added', $date_added, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function get_all_listening_video() {

        $sql = "SELECT *
                FROM yima_toefl_listening_video";
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

}

?>
