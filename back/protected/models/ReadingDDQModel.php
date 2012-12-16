<?php

class ReadingDDQModel extends CFormModel {

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_toefl_reading_ddq
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

    public function get_by_reading($args, $page = 1, $ppp = 20, $rid) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_toefl_reading_ddq
                WHERE rid = $rid
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
                FROM yima_toefl_reading_ddq
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
                FROM yima_toefl_reading_ddq
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
                FROM yima_toefl_reading_ddq
                WHERE 1
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function counts_by_reading($args, $rid) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        $sql = "SELECT count(*) as total
                FROM yima_toefl_reading_ddq
                WHERE rid = $rid
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
                FROM yima_toefl_reading_ddq
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
        $sql = 'update yima_toefl_reading_ddq set ' . $custom . ' where id = :id';
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

    public function add($rid, $title, $content, $author, $time) {
        $sql = 'INSERT into yima_toefl_reading_ddq(rid,content,title,author,date_added,last_modified)
            VALUES(:rid,:content,:title,:author,:date_added,:last_modified)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':content', $content, PDO::PARAM_STR);
        $command->bindParam(':title', $title, PDO::PARAM_STR);


        $command->bindParam(':rid', $rid, PDO::PARAM_INT);

        $command->bindParam(':author', $author, PDO::PARAM_INT);
        $command->bindParam(':date_added', $time, PDO::PARAM_INT);
        $command->bindParam(':last_modified', $time, PDO::PARAM_INT);

        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function get_score($args, $page = 1, $ppp = 20, $rddq_id) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND rightchoices like :rightchoices";
            $params[] = array('name' => ':rightchoices', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_toefl_configure_score
                WHERE question_id = $rddq_id
                $custom
                ORDER BY rightchoices ASC
                LIMIT :page,:ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }

    public function count_score($args, $rddq_id) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        $sql = "SELECT count(*) as total
                FROM yima_toefl_configure_score
                WHERE question_id = $rddq_id
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function add_score($rddq_id, $title, $score, $q_type) {
        $sql = 'INSERT into yima_toefl_configure_score(question_type,question_id,rightchoices,score)
            VALUES(:question_type,:question_id,:rightchoices,:score)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':question_type', $q_type, PDO::PARAM_STR);
        $command->bindParam(':question_id', $rddq_id, PDO::PARAM_INT);
        $command->bindParam(':rightchoices', $title, PDO::PARAM_INT);
        $command->bindParam(':score', $score, PDO::PARAM_INT);

        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function update_score($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_toefl_configure_score set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function get_score_by_id($id) {
        $sql = "SELECT *
                FROM yima_toefl_configure_score
                WHERE id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }

    public function get_choice($ddq_id) {

        $custom = "";
        $params = array();


        $sql = "SELECT *
                FROM yima_toefl_reading_ddq_answer
                WHERE ddqid = $ddq_id AND deleted = 0
                $custom
                ORDER BY title ASC";

        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

    public function get_choice_by_id($id) {

        $custom = "";
        $params = array();


        $sql = "SELECT *
                FROM yima_toefl_reading_ddq_answer
                WHERE id = $id
                $custom
                ORDER BY title ASC";

        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }
    
    public function update_choice($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_toefl_reading_ddq_answer set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }
    
      public function add_choice($rddq_id, $title,$subid=0) {
        $sql = 'INSERT yima_toefl_reading_ddq_answer(ddqid,title,subid)
            VALUES(:ddqid,:title,:subid)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':ddqid', $rddq_id, PDO::PARAM_INT);
        $command->bindParam(':subid', $subid, PDO::PARAM_INT);
      

        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

}

?>
