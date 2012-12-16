<?php

class Source_testModel extends CFormModel {

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_toefl_source_test
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

    public function get_all($args) {
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT id, title
                FROM yima_toefl_source_test
                WHERE 1
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
                FROM yima_toefl_source_test
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
                FROM yima_toefl_source_test
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
        $sql = 'update yima_toefl_source_test set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function actionDelete($id) {
        $source_test = $this->Source_testModel->get($id);
        if (!$source_test)
            return;

        $this->Source_testModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function add($title, $level, $user, $reading1, $reading2, $reading3, $listening1, $listening2, $listening3, $listening4, $listening4, $listening5, $listening6, $speaking1, $speaking2, $speaking3, $speaking4, $speaking5, $speaking6, $writing1, $writing2, $time) {

        $sql = 'INSERT into yima_toefl_source_test(title, level, reading1, reading2, reading3, listening1, listening2, listening3, listening4, listening5, listening6,
            speaking1, speaking2, speaking3, speaking4, speaking5, speaking6, writing1, writing2,author ,date_added, last_modified)
            VALUES(:title, :level, :reading1, :reading2, :reading3, :listening1, :listening2, :listening3, :listening4, :listening5, :listening6,
            :speaking1, :speaking2, :speaking3, :speaking4, :speaking5, :speaking6, :writing1, :writing2,:author,:date_added, :last_modified)';


        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':level', $level, PDO::PARAM_INT);
        $command->bindParam(':author', $user, PDO::PARAM_INT);

        $command->bindParam(':reading1', $reading1, PDO::PARAM_INT);
        $command->bindParam(':reading2', $reading2, PDO::PARAM_INT);
        $command->bindParam(':reading3', $reading3, PDO::PARAM_INT);

        $command->bindParam(':listening1', $listening1, PDO::PARAM_INT);
        $command->bindParam(':listening2', $listening2, PDO::PARAM_INT);
        $command->bindParam(':listening3', $listening3, PDO::PARAM_INT);
        $command->bindParam(':listening4', $listening4, PDO::PARAM_INT);
        $command->bindParam(':listening5', $listening5, PDO::PARAM_INT);
        $command->bindParam(':listening6', $listening6, PDO::PARAM_INT);

        $command->bindParam(':speaking1', $speaking1, PDO::PARAM_INT);
        $command->bindParam(':speaking2', $speaking2, PDO::PARAM_INT);
        $command->bindParam(':speaking3', $speaking3, PDO::PARAM_INT);
        $command->bindParam(':speaking4', $speaking4, PDO::PARAM_INT);
        $command->bindParam(':speaking5', $speaking5, PDO::PARAM_INT);
        $command->bindParam(':speaking6', $speaking6, PDO::PARAM_INT);

        $command->bindParam(':writing1', $writing1, PDO::PARAM_INT);
        $command->bindParam(':writing2', $writing2, PDO::PARAM_INT);

        $command->bindParam(':date_added', $time, PDO::PARAM_INT);
        $command->bindParam(':last_modified', $time, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

}

?>
