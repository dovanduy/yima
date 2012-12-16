<?php

class SpeakingModel extends CFormModel {

    public function gets($args, $page = 1, $ppp = 20, $part) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_toefl_speaking
                WHERE speaking_part = $part
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
                FROM yima_toefl_speaking
                WHERE 1
                $custom
                ORDER BY title ASC";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        return $command->queryAll();
    }

    public function get_by_part($args, $part) {
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT id, title,level
                FROM yima_toefl_speaking
                WHERE speaking_part=$part
                $custom
                ORDER BY title ASC";
        $command = Yii::app()->db->createCommand($sql);
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

        $sql = "SELECT count(*) as total
                FROM yima_toefl_speaking
                WHERE speaking_part=$part
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
                FROM yima_toefl_speaking
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
        $sql = 'update yima_toefl_speaking set ' . $custom . ' where id = :id';
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

    public function add($title, $level, $source, $part, $keyword, $subject, $sound1, $image,$thumbnail, $sound2, $direction, $sound3, $content, $author, $time) {
        $sql = 'INSERT into yima_toefl_speaking(title,level,keyword,source,speaking_part,limg,thumbnail,lsound,subject,ssound,direction,dsound,introsound,content,author,date_added,last_modified)
            VALUES(:title,:level,:keyword,:source,:speaking_part,:limg,:thumbnail,:lsound,:subject,:ssound,:direction,:dsound,:introsound,:content,:author,:date_added,:last_modified)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':level', $level, PDO::PARAM_INT);
        $command->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $command->bindParam(':source', $source, PDO::PARAM_STR);
        $command->bindParam(':speaking_part', $part, PDO::PARAM_STR);
        $command->bindParam(':limg', $image, PDO::PARAM_STR);
        $command->bindParam(':thumbnail', $thumbnail, PDO::PARAM_STR);
        $command->bindParam(':ssound', $sound1, PDO::PARAM_STR);
        $command->bindParam(':subject', $subject, PDO::PARAM_STR);
        $command->bindParam(':lsound', $sound2, PDO::PARAM_STR);
        $command->bindParam(':direction', $direction, PDO::PARAM_STR);
        $command->bindParam(':dsound', $sound3, PDO::PARAM_STR);
        $command->bindParam(':introsound', $sound3, PDO::PARAM_STR);
        $command->bindParam(':content', $content, PDO::PARAM_STR);
        $command->bindParam(':author', $author, PDO::PARAM_STR);
        $command->bindParam(':date_added', $time, PDO::PARAM_INT);
        $command->bindParam(':last_modified', $time, PDO::PARAM_INT);

        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function add_part1($title, $level, $source, $part, $keyword, $subject, $sound1, $author, $time) {
        $sql = 'INSERT into yima_toefl_speaking(title,level,keyword,source,speaking_part,ssound,subject,author,date_added,last_modified)
            VALUES(:title,:level,:keyword,:source,:speaking_part,:ssound,:subject,:author,:date_added,:last_modified)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':level', $level, PDO::PARAM_INT);
        $command->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $command->bindParam(':source', $source, PDO::PARAM_STR);
        $command->bindParam(':speaking_part', $part, PDO::PARAM_STR);

        $command->bindParam(':ssound', $sound1, PDO::PARAM_STR);
        $command->bindParam(':subject', $subject, PDO::PARAM_STR);

        $command->bindParam(':author', $author, PDO::PARAM_STR);
        $command->bindParam(':date_added', $time, PDO::PARAM_INT);
        $command->bindParam(':last_modified', $time, PDO::PARAM_INT);

        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function add_part5($title, $level, $source, $part, $keyword, $subject, $sound1, $img,$thumbnail, $sound2, $author, $time) {
        $sql = 'INSERT into yima_toefl_speaking(title,level,keyword,source,speaking_part,limg,thumbnail,lsound,subject,ssound,author,date_added,last_modified)
            VALUES(:title,:level,:keyword,:source,:speaking_part,:limg,:thumbnail,:lsound,:subject,:ssound,:author,:date_added,:last_modified)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':level', $level, PDO::PARAM_INT);
        $command->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $command->bindParam(':source', $source, PDO::PARAM_STR);
        $command->bindParam(':speaking_part', $part, PDO::PARAM_STR);
        $command->bindParam(':limg', $img, PDO::PARAM_STR);
        $command->bindParam(':thumbnail', $thumbnail, PDO::PARAM_STR);
        $command->bindParam(':ssound', $sound1, PDO::PARAM_STR);
        $command->bindParam(':subject', $subject, PDO::PARAM_STR);
        $command->bindParam(':lsound', $sound2, PDO::PARAM_STR);
        $command->bindParam(':author', $author, PDO::PARAM_STR);
        $command->bindParam(':date_added', $time, PDO::PARAM_INT);
        $command->bindParam(':last_modified', $time, PDO::PARAM_INT);

        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function get_all_speaking() {

        $sql = "SELECT *
                FROM yima_toefl_speaking";

        $command = Yii::app()->db->createCommand($sql);

        return $command->queryAll();
    }

}

?>
