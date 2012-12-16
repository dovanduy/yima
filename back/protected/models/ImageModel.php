<?php

class ImageModel extends CFormModel {

    public function __construct() {
        
    }
    
    public function get_all($args) {
        $custom = "";
        $params = array();
        
        if (isset($args['main_folder'])) {
            $custom.= " AND ym.main_folder = :main_folder";
            $params[] = array('name' => ':main_folder', 'value' => $args['main_folder'], 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['sub_folder'])) {
            $custom.= " AND ym.sub_folder = :sub_folder";
            $params[] = array('name' => ':sub_folder', 'value' => $args['sub_folder'], 'type' => PDO::PARAM_STR);
        }
        
        if(isset($args['other'])){
            $custom.= " AND ym.id NOT IN (SELECT image_id
                                        FROM yima_image_test)";
        }

        $sql = "SELECT *
                FROM yima_images ym
                WHERE 1
                $custom
                ORDER BY ym.id ASC
                ";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();
        
        if (isset($args['main_folder'])) {
            $custom.= " AND ym.main_folder = :main_folder";
            $params[] = array('name' => ':main_folder', 'value' => $args['main_folder'], 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['sub_folder'])) {
            $custom.= " AND ym.sub_folder = :sub_folder";
            $params[] = array('name' => ':sub_folder', 'value' => $args['sub_folder'], 'type' => PDO::PARAM_STR);
        }
        
        if(isset($args['other'])){
            $custom.= " AND ym.id NOT IN (SELECT image_id
                                        FROM yima_image_test)";
        }

        $sql = "SELECT *
                FROM yima_images ym
                WHERE 1
                $custom
                ORDER BY ym.id ASC
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

        if (isset($args['main_folder'])) {
            $custom.= " AND ym.main_folder = :main_folder";
            $params[] = array('name' => ':main_folder', 'value' => $args['main_folder'], 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['sub_folder'])) {
            $custom.= " AND ym.sub_folder = :sub_folder";
            $params[] = array('name' => ':sub_folder', 'value' => $args['sub_folder'], 'type' => PDO::PARAM_STR);
        }
        
        if(isset($args['other'])){
            $custom.= " AND ym.id NOT IN (SELECT image_id
                                        FROM yima_image_test)";
        }
        
        $sql = "SELECT count(*) as total
                FROM yima_images ym
                WHERE 1
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function get_image_test($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['ref_type'])) {
            $custom.= " AND yit.ref_type = :ref_type";
            $params[] = array('name' => ':ref_type', 'value' => $args['ref_type'], 'type' => PDO::PARAM_STR);
        }

        if (isset($args['ref_id'])) {
            $custom.= " AND yit.ref_id = :ref_id";
            $params[] = array('name' => ':ref_id', 'value' => $args['ref_id'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT yit.*,ym.full_link,ym.main_folder,ym.sub_folder,ym.title
                FROM yima_image_test yit
                LEFT JOIN yima_images ym
                ON ym.id = image_id
                WHERE 1
                $custom
                ORDER BY image_id ASC
                LIMIT :page,:ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }

    public function count_image_test($args) {

        $custom = "";
        $params = array();

        if (isset($args['ref_type'])) {
            $custom.= " AND yit.ref_type = :ref_type";
            $params[] = array('name' => ':ref_type', 'value' => $args['ref_type'], 'type' => PDO::PARAM_STR);
        }

        if (isset($args['ref_id'])) {
            $custom.= " AND yit.ref_id = :ref_id";
            $params[] = array('name' => ':ref_id', 'value' => $args['ref_id'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT count(*) as total
                FROM yima_image_test yit
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
                FROM yima_images
                WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryRow();
    }

    public function update($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_images set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function add($main_folder, $sub_folder, $title, $full_link) {
        $time = time();
        $sql = "INSERT INTO yima_images(main_folder, sub_folder, title, full_link, date_added) VALUES(:main_folder, :sub_folder, :title, :full_link, :date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":main_folder", $main_folder, PDO::PARAM_STR);
        $command->bindParam(":sub_folder", $sub_folder, PDO::PARAM_STR);
        $command->bindParam(":title", $title, PDO::PARAM_STR);
        $command->bindParam(":full_link", $full_link, PDO::PARAM_STR);
        $command->bindParam(":date_added", $time, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function add_image_test($image_id, $ref_type, $ref_id) {
        $sql = "INSERT INTO yima_image_test(image_id, ref_type, ref_id) VALUES(:image_id, :ref_type, :ref_id)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":image_id", $image_id, PDO::PARAM_INT);
        $command->bindParam(":ref_type", $ref_type, PDO::PARAM_STR);
        $command->bindParam(":ref_id", $ref_id, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function is_exist_image_test($image_id, $ref_type) {
        $sql = "SELECT *
                FROM yima_image_test
                WHERE image_id = :image_id
                AND ref_type = :ref_type";

        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":image_id", $image_id, PDO::PARAM_INT);
        $command->bindParam(":ref_type", $ref_type, PDO::PARAM_STR);
        return $command->queryRow();
    }

    public function is_exist_image($main_folder, $sub_folder, $title) {

        $sql = "SELECT *
                FROM yima_images
                WHERE main_folder = :main_folder
                AND sub_folder = :sub_folder
                AND title = :title";

        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":main_folder", $main_folder, PDO::PARAM_STR);
        $command->bindParam(":sub_folder", $sub_folder, PDO::PARAM_STR);
        $command->bindParam(":title", $title, PDO::PARAM_STR);
        return $command->queryRow();
    }

    public function sesert($main_folder, $sub_folder, $title, $full_link) {

        $image = $this->is_exist_image($main_folder, $sub_folder, $title);
        if ($image)
            return $image['id'];

        return $this->add($main_folder, $sub_folder, $title, $full_link);
    }
    
    public function delete_all_image_test($ref_type,$ref_id){
        $sql = "DELETE FROM yima_image_test
                WHERE ref_type = :ref_type
                AND ref_id = :ref_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":ref_type", $ref_type, PDO::PARAM_STR);
        $command->bindParam(":ref_id", $ref_id, PDO::PARAM_INT);
        return $command->execute();
    }

}