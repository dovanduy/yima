<?php

class ListeningMCQModel extends CFormModel {

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_toefl_listening_mcq
                WHERE 1
                $custom
                ORDER BY title ASC
                LIMIT :page,:ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }

    public function get_by_listening($args, $page = 1, $ppp = 20, $lid) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_toefl_listening_mcq
                WHERE lid = $lid
                $custom
                ORDER BY title ASC
                LIMIT :page,:ppp";
        // print_r($sql);die;
        $command = Yii::app()->db->createCommand($sql);
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
                FROM yima_toefl_listening_mcq
                WHERE 1
                $custom
                ORDER BY title ASC";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        return $command->queryAll();
    }

    public function get_by_level($args, $level) {
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT id, title,level
                FROM yima_toefl_listening_mcq
                WHERE level=$level
                $custom
                ORDER BY title ASC";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        return $command->queryAll();
    }

    public function counts($args) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        $sql = "SELECT count(*) as total
                FROM yima_toefl_listening_mcq
                WHERE 1
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function counts_by_listening($args, $lid) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        $sql = "SELECT count(*) as total
                FROM yima_toefl_listening_mcq
                WHERE lid = $lid
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
                FROM yima_toefl_listening_mcq
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
        $sql = 'update yima_toefl_listening_mcq set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function actionDelete($id) {
        $speaking = $this->SpeakingModel->get($id);
        if (!$speaking)
            return;

        $this->SpeakingModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function add($lid, $title, $choice1, $choice2, $choice3, $choice4, $choice,$form,$to, $sound1, $sound2, $sound3, $replay, $sentence, $author, $time) {
        $sql = 'INSERT into yima_toefl_listening_mcq(lid,title,lsound, choice1,choice2,choice3,choice4,answer,replay,replay_from,replay_to,replay_sound,sentence,sentence_sound,author,date_added,last_modified)
            VALUES(:lid,:title,:lsound,:choice1,:choice2,:choice3,:choice4,:answer,:replay,:replay_from,:replay_to,:replay_sound,:sentence,:sentence_sound,:author,:date_added,:last_modified)';
        $command = Yii::app()->db->createCommand($sql);
   
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':choice1', $choice1, PDO::PARAM_STR);
        $command->bindParam(':choice2', $choice2, PDO::PARAM_STR);
        $command->bindParam(':choice3', $choice3, PDO::PARAM_STR);
        $command->bindParam(':choice4', $choice4, PDO::PARAM_STR);
        
     
        
        $command->bindParam(':lsound', $sound1, PDO::PARAM_STR);
        $command->bindParam(':replay', $replay, PDO::PARAM_INT);
        $command->bindParam(':replay_from', $form, PDO::PARAM_INT);
        $command->bindParam(':replay_to', $to, PDO::PARAM_INT);
        $command->bindParam(':replay_sound', $sound2, PDO::PARAM_STR);
        $command->bindParam(':sentence', $sentence, PDO::PARAM_INT);
        $command->bindParam(':sentence_sound', $sound3, PDO::PARAM_STR);
      
        $command->bindParam(':lid', $lid, PDO::PARAM_INT);
        $command->bindParam(':answer', $choice, PDO::PARAM_INT);
        $command->bindParam(':author', $author, PDO::PARAM_STR);
        $command->bindParam(':date_added', $time, PDO::PARAM_INT);
        $command->bindParam(':last_modified', $time, PDO::PARAM_INT);
        
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }
    
    public function get_all_listening_mcq() {
 
        $sql = "SELECT *
                FROM yima_toefl_listening_mcq";    
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

}

?>
