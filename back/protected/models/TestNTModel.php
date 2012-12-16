<?php

class TestNTModel extends CFormModel {

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND knt.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['author_id'])) {
            $custom.= " AND knt.author_id like :author_id";
            $params[] = array('name' => ':author_id', 'value' => $args['author_id'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['deleted'])) {
            $custom.= " AND knt.deleted like :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }
        
        $sql = "SELECT knt.*,kso.id as org_id,kso.title as org_title,ksu.id as user_id,ksu.email as author_title,kss.title as subject_title,ysf.title as faculty_name,yofs.faculty_id,ysse.title as section_title,yit.total_image,ynq.total_question
                FROM yima_nt_test knt
                LEFT JOIN yima_organization_faculty_subject yofs
                ON yofs.id = knt.group_id
                LEFT JOIN yima_sys_organization kso
                ON kso.id = yofs.organization_id
                LEFT JOIN yima_sys_user ksu
                ON ksu.id = knt.author_id
                LEFT JOIN yima_sys_subject kss
                ON kss.id = yofs.subject_id
                LEFT JOIN yima_sys_faculty ysf
                ON ysf.id = yofs.faculty_id
                LEFT JOIN yima_sys_section ysse
                ON ysse.id = knt.section_id
                LEFT JOIN (SELECT count(*) as total_image,ref_id
                            FROM yima_image_test
                            WHERE ref_type = 'test_nt'
                            GROUP BY ref_id) yit
                ON yit.ref_id = knt.id
                LEFT JOIN (SELECT count(*) as total_question,test_id
                            FROM yima_nt_question
                            WHERE deleted = 0
                            GROUP BY test_id) ynq
                ON knt.id = ynq.test_id
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
            $custom.= " AND knt.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        
        if (isset($args['author_id'])) {
            $custom.= " AND knt.author_id like :author_id";
            $params[] = array('name' => ':author_id', 'value' => $args['author_id'], 'type' => PDO::PARAM_INT);
        }
        
        if (isset($args['deleted'])) {
            $custom.= " AND knt.deleted like :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT count(*) as total
                FROM yima_nt_test knt
                WHERE 1
                $custom
                ";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function get_finished_tests($args, $page = 1, $ppp = 20) {
        $page = ($page - 1 ) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['user_id'])) {
            $custom.= " AND yut.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT knt.*,kso.id as organization_id,kso.title as org_title,kso.slug as organization_slug,ksu.id as user_id,ksu.email as author_title,
                kss.id as subject_id,kss.title as subject_title,ysf.title as faculty_name,yofs.faculty_id,ysse.title as section_title,yut.times,ytr.total_question,
                ytr.total_right,ytr.id as relationship_id,ytr.date_added as date_completed,completor.email as email_completor,completor.firstname as firstname_completor,completor.lastname as lastname_completor
                FROM yima_test_relationship ytr,yima_user_test yut
                LEFT JOIN yima_nt_test knt
                ON yut.ref_id = knt.id
                LEFT JOIN yima_organization_faculty_subject yofs
                ON yofs.id = knt.group_id
                LEFT JOIN yima_sys_organization kso
                ON kso.id = yofs.organization_id
                LEFT JOIN yima_sys_user ksu
                ON ksu.id = knt.author_id
                LEFT JOIN yima_sys_user completor
                ON completor.id = yut.user_id
                LEFT JOIN yima_sys_subject kss
                ON kss.id = yofs.subject_id
                LEFT JOIN yima_sys_faculty ysf
                ON ysf.id = yofs.faculty_id
                LEFT JOIN yima_sys_section ysse
                ON ysse.id = knt.section_id
                WHERE knt.deleted = 0 and knt.disabled = 0
                AND yut.ref_type = 'test_nt'
                AND yut.id = ytr.relationship_id
                $custom
                ORDER BY ytr.date_added DESC
                LIMIT :page,:ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':page', $page, PDO::PARAM_INT);
        $command->bindParam(':ppp', $ppp, PDO::PARAM_INT);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        return $command->queryAll();
    }

    public function count_finished_tests($args) {
        $custom = "";
        $params = array();

        if (isset($args['user_id'])) {
            $custom.= " AND yut.user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT count(*) as total
                FROM yima_test_relationship ytr,yima_user_test yut
                LEFT JOIN yima_nt_test knt
                ON yut.ref_id = knt.id
                LEFT JOIN yima_organization_faculty_subject yofs
                ON yofs.id = knt.group_id
                LEFT JOIN yima_sys_organization kso
                ON kso.id = yofs.organization_id
                LEFT JOIN yima_sys_user ksu
                ON ksu.id = knt.author_id
                LEFT JOIN yima_sys_subject kss
                ON kss.id = yofs.subject_id
                LEFT JOIN yima_sys_faculty ysf
                ON ysf.id = yofs.faculty_id
                LEFT JOIN yima_sys_section ysse
                ON ysse.id = knt.section_id
                WHERE knt.deleted = 0 and knt.disabled = 0
                AND yut.ref_type = 'test_nt'
                AND yut.id = ytr.relationship_id
                $custom";
        $command = Yii::app()->db->createCommand($sql);

        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        $count = $command->queryRow();
        return $count['total'];
    }
    
    public function get_test_relationship($relationship_id) {
        $sql = "SELECT ytr.*,yut.user_id,ynt.title,yut.ref_id,yut.times,ysu.email as completor_email,author.email as author_email,ynt.author_id
                FROM yima_test_relationship ytr,yima_user_test yut
                LEFT JOIN yima_nt_test ynt
                ON ynt.id = yut.ref_id
                LEFT JOIN yima_sys_user ysu
                ON yut.user_id = ysu.id
                LEFT JOIN yima_sys_user author
                ON ynt.author_id = author.id
                WHERE yut.id = ytr.relationship_id
                AND yut.ref_type = 'test_nt'
                AND ytr.id=:id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $relationship_id, PDO::PARAM_INT);
        return $command->queryRow();
    }

    public function get($id) {
        $sql = "SELECT ynt.*,yofs.faculty_id,yofs.organization_id,yofs.subject_id
                FROM yima_nt_test ynt
                LEFT JOIN yima_organization_faculty_subject yofs
                ON yofs.id = ynt.group_id
                WHERE ynt.id = :id
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
        $sql = 'update yima_nt_test set ' . $custom . ' where id = :id';
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

    public function add($title, $slug, $description, $section, $price, $author,$group_id) {
        $count_slug = $this->check_exist_slug($slug);
        if ($count_slug > 0)
            $slug = $slug . "-" . $count_slug;
        
        $time = time();
        $sql = 'INSERT into yima_nt_test(title, slug, description, section_id,author_id,price, date_added,group_id) 
            VALUES(:title, :slug, :description, :section_id,:author_id,:price, :date_added,:group_id)';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':title', $title, PDO::PARAM_STR);
        $command->bindParam(':slug', $slug, PDO::PARAM_STR);
        $command->bindParam(':description', $description, PDO::PARAM_STR);        
        $command->bindParam(':section_id', $section, PDO::PARAM_INT);
        $command->bindParam(':author_id', $author, PDO::PARAM_INT);
        $command->bindParam(':price', $price, PDO::PARAM_INT);
        $command->bindParam(':date_added', $time, PDO::PARAM_INT);
        $command->bindParam(':group_id', $group_id, PDO::PARAM_INT);         
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }
    
    private function check_exist_slug($slug) {
        $sql = 'SELECT count(slug) as count FROM yima_nt_test WHERE slug REGEXP "^' . $slug . '(-[[:digit:]]+)?$"';
        $command = Yii::app()->db->createCommand($sql);
        $row = $command->queryRow();
        return $row['count'];
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
                FROM yima_nt_test 
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

    public function get_section($args = array(), $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_sys_section 
                WHERE disabled = 0 AND deleted = 0
                $custom
                ORDER BY title ASC
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);

        return $command->queryAll();
    }

}

?>
