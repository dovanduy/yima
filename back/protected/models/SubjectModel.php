<?php

class SubjectModel extends CFormModel {

    public function gets($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        if (isset($args['deleted'])) {
            $custom .= " AND deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }

        if (isset($args['disabled'])) {
            $custom .= " AND disabled = :disabled";
            $params[] = array('name' => ':disabled', 'value' => $args['disabled'], 'type' => PDO::PARAM_INT);
        }

        if (isset($args['featured'])) {
            $custom .= " AND featured = :featured";
            $params[] = array('name' => ':featured', 'value' => $args['featured'], 'type' => PDO::PARAM_INT);
        }

        if (isset($args['organization_id'])) {
            $sub = "";

            if (isset($args['faculty_id'])) {
                $sub.= " AND faculty_id = :faculty_id";
            }

            $custom .= " AND id in (SELECT DISTINCT subject_id
                                    FROM yima_organization_faculty_subject
                                    WHERE organization_id = :organization_id
                                    $sub)";
            $params[] = array('name' => ':organization_id', 'value' => $args['organization_id'], 'type' => PDO::PARAM_INT);
            if (isset($args['faculty_id']))
                $params[] = array('name' => ':faculty_id', 'value' => $args['faculty_id'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT *
                FROM yima_sys_subject 
                WHERE 1
                $custom
                ORDER BY title ASC
                LIMIT :page,:ppp";

        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page, PDO::PARAM_INT);
        $command->bindParam(":ppp", $ppp, PDO::PARAM_INT);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }

    public function counts($args) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        if (isset($args['deleted'])) {
            $custom .= " AND deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }

        if (isset($args['disabled'])) {
            $custom .= " AND disabled = :disabled";
            $params[] = array('name' => ':disabled', 'value' => $args['disabled'], 'type' => PDO::PARAM_INT);
        }

        if (isset($args['featured'])) {
            $custom .= " AND featured = :featured";
            $params[] = array('name' => ':featured', 'value' => $args['featured'], 'type' => PDO::PARAM_INT);
        }

        if (isset($args['organization_id'])) {
            $sub = "";

            if (isset($args['faculty_id'])) {
                $sub.= " AND faculty_id = :faculty_id";
            }

            $custom .= " AND id in (SELECT DISTINCT subject_id
                                    FROM yima_organization_faculty_subject
                                    WHERE organization_id = :organization_id
                                    $sub)";
            $params[] = array('name' => ':organization_id', 'value' => $args['organization_id'], 'type' => PDO::PARAM_INT);
            if (isset($args['faculty_id']))
                $params[] = array('name' => ':faculty_id', 'value' => $args['faculty_id'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT count(*) as total
                FROM yima_sys_subject 
                WHERE 1
                $custom
                ORDER BY title ASC";
        $command = Yii::app()->db->createCommand($sql);
        
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function get_all() {
        $sql = "SELECT *
                FROM yima_sys_subject 
                ORDER BY title ASC";
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

    public function get($id) {
        $sql = "SELECT *
                FROM yima_sys_subject 
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
        $sql = 'update yima_sys_subject set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
    }

    public function actionDelete($id) {
        $class = $this->SubjectModel->get($id);
        if (!$class)
            return;

        $this->SubjectModel->update(array('deleted' => 1, 'id' => $id));
        HelperGlobal::add_log(UserControl::getId(), $this->controllerID(), $this->methodID(), array('Hành động' => 'Xóa', 'Dữ liệu' => array('id' => $id)));
    }

    public function add($title, $img, $thumbnail, $slug, $priority, $search, $featured, $date_added) {
        $sql = 'INSERT into yima_sys_subject(title,img,thumbnail, slug, priority, search,featured, date_added,last_modified) VALUES(:title,:img,:thumbnail, :slug,:priority,:search, :featured, :date_added,:last_modified)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':img', $img, PDO::PARAM_STR);
        $command->bindParam(':thumbnail', $thumbnail, PDO::PARAM_STR);
        $command->bindParam(':slug', $slug, PDO::PARAM_STR);
        $command->bindParam(':priority', $priority, PDO::PARAM_INT);
        $command->bindParam(':featured', $featured, PDO::PARAM_INT);
        $command->bindParam(':search', $search, PDO::PARAM_INT);
        $command->bindParam(':date_added', $date_added, PDO::PARAM_INT);
        $command->bindParam(':last_modified', $date_added, PDO::PARAM_INT);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function get_to_list($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_sys_subject 
                WHERE disabled = 0 AND deleted = 0
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

    public function get_group($organization, $faculty, $subject) {
        $sql = "SELECT *
                FROM yima_organization_faculty_subject 
                WHERE organization_id = :organization_id AND faculty_id = :faculty_id AND subject_id = :subject_id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":organization_id", $organization);
        $command->bindParam(":faculty_id", $faculty);
        $command->bindParam(":subject_id", $subject);
        return $command->queryRow();
    }

    public function get_group_by_id($id) {
        $sql = "SELECT *
                FROM yima_organization_faculty_subject 
                WHERE id = :id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryRow();
    }

    public function get_mods($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND email like :email";
            $params[] = array('name' => ':email', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        if (isset($args['subject_id'])) {
            $custom.= " AND yssu.subject_id = :subject_id";
            $params[] = array('name' => ':subject_id', 'value' => $args['subject_id'], 'type' => PDO::PARAM_INT);
        }

        if (isset($args['user_id'])) {
            $custom.= " AND yssu.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT yssu.*,yss.title as subject_name,ysu.lastname,ysu.firstname,ysu.email
                FROM yima_sys_subject_user yssu,yima_sys_subject yss,yima_sys_user ysu
                WHERE yss.id = yssu.subject_id
                AND ysu.id = yssu.user_id
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

    public function count_mods($args = array()) {
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND email like :email";
            $params[] = array('name' => ':email', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        if (isset($args['subject_id'])) {
            $custom.= " AND yssu.subject_id = :subject_id";
            $params[] = array('name' => ':subject_id', 'value' => $args['subject_id'], 'type' => PDO::PARAM_INT);
        }

        if (isset($args['user_id'])) {
            $custom.= " AND yssu.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT count(*) as total
                FROM yima_sys_subject_user yssu,yima_sys_subject yss,yima_sys_user ysu
                WHERE yss.id = yssu.subject_id
                AND ysu.id = yssu.user_id
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }

    public function exist_mod($subject_id, $user_id) {
        $sql = "SELECT count(*) as total 
                FROM yima_sys_subject_user
                WHERE subject_id = :subject_id
                AND user_id = :user_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":subject_id", $subject_id, PDO::PARAM_INT);
        $command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $count = $command->queryRow();
        return $count['total'];
    }

    public function add_mod($subject_id, $user_id) {
        $time = time();
        $sql = "INSERT INTO yima_sys_subject_user(subject_id,user_id,date_added) VALUES(:subject_id,:user_id,:date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":subject_id", $subject_id, PDO::PARAM_INT);
        $command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $command->bindParam(":date_added", $time);
        return $command->execute();
    }

    public function delete_mod($subject_id, $user_id) {
        $sql = "DELETE FROM yima_sys_subject_user 
                WHERE subject_id = :subject_id
                AND user_id = :user_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":subject_id", $subject_id, PDO::PARAM_INT);
        $command->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        return $command->execute();
    }

}

?>
