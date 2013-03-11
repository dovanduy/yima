<?php

class TestModel extends CFormModel {

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1 ) * $ppp;
        $custom = "";
        $params = array();
        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND knt.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        if (isset($args['subject_title']) && $args['subject_title'] != "") {
            $custom.= " AND kss.title like :subject_title";
            $params[] = array('name' => ':subject_title', 'value' => "%$args[subject_title]%", 'type' => PDO::PARAM_STR);
        }

        if (isset($args['search_cate']) && $args['search_cate'] != "") {
            $custom.= " AND (knt.title like :search_cate OR kss.title like :search_cate)";
            $params[] = array('name' => ':search_cate', 'value' => "%$args[search_cate]%", 'type' => PDO::PARAM_STR);
        }

        if (isset($args['search_own']) && $args['search_own'] != "") {
            $custom.= " AND (kso.title like :search_own OR ksu.email like :search_own)";
            $params[] = array('name' => ':search_own', 'value' => "%$args[search_own]%", 'type' => PDO::PARAM_STR);
        }

        if (isset($args['search_price']) && $args['search_price'] != "") {

            if ($args['search_price'] == "free")
                $custom.= " AND knt.price = 0";
            elseif ($args['search_price'] == "paid")
                $custom.= " AND knt.price > 0";
        }

        if (isset($args['author_id'])) {
            $custom.= " AND knt.author_id = :author_id";
            $params[] = array('name' => ':author_id', 'value' => $args['author_id'], 'type' => PDO::PARAM_INT);
        }

        if (isset($args['subject_id']) && $args['subject_id'] > 0) {
            $custom.= " AND yofs.subject_id = :subject_id";
            $params[] = array('name' => ':subject_id', 'value' => $args['subject_id'], 'type' => PDO::PARAM_STR);
        }

        if (isset($args['organization_id']) && $args['organization_id'] > 0) {
            $custom.= " AND yofs.organization_id = :organization_id";
            $params[] = array('name' => ':organization_id', 'value' => $args['organization_id'], 'type' => PDO::PARAM_STR);
        }

        $sql = "SELECT knt.*,kso.id as organization_id,kso.title as org_title,kso.slug as organization_slug,ksu.id as user_id,ksu.email as author_title,kss.id as subject_id,kss.title as subject_title,ysf.title as faculty_name,yofs.faculty_id,ysse.title as section_title
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
                WHERE knt.deleted = 0 and knt.disabled = 0
                $custom
                ORDER BY knt.date_added DESC
                LIMIT :page,:ppp";

        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':page', $page, PDO::PARAM_INT);
        $command->bindParam(':ppp', $ppp, PDO::PARAM_INT);
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

        if (isset($args['subject_title']) && $args['subject_title'] != "") {
            $custom.= " AND kss.title like :subject_title";
            $params[] = array('name' => ':subject_title', 'value' => "%$args[subject_title]%", 'type' => PDO::PARAM_STR);
        }

        if (isset($args['search_cate']) && $args['search_cate'] != "") {
            $custom.= " AND (knt.title like :search_cate OR kss.title like :search_cate)";
            $params[] = array('name' => ':search_cate', 'value' => "%$args[search_cate]%", 'type' => PDO::PARAM_STR);
        }

        if (isset($args['search_own']) && $args['search_own'] != "") {
            $custom.= " AND (kso.title like :search_own OR ksu.email like :search_own)";
            $params[] = array('name' => ':search_own', 'value' => "%$args[search_own]%", 'type' => PDO::PARAM_STR);
        }

        if (isset($args['search_price']) && $args['search_price'] != "") {

            if ($args['search_price'] == "free")
                $custom.= " AND knt.price = 0";
            elseif ($args['search_price'] == "paid")
                $custom.= " AND knt.price > 0";
        }

        if (isset($args['author_id'])) {
            $custom.= " AND knt.author_id = :author_id";
            $params[] = array('name' => ':author_id', 'value' => $args['author_id'], 'type' => PDO::PARAM_INT);
        }

        if (isset($args['subject_id']) && $args['subject_id'] > 0) {
            $custom.= " AND yofs.subject_id = :subject_id";
            $params[] = array('name' => ':subject_id', 'value' => $args['subject_id'], 'type' => PDO::PARAM_STR);
        }

        if (isset($args['organization_id']) && $args['organization_id'] > 0) {
            $custom.= " AND yofs.organization_id = :organization_id";
            $params[] = array('name' => ':organization_id', 'value' => $args['organization_id'], 'type' => PDO::PARAM_STR);
        }


        $sql = "SELECT count(*) as total
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
                WHERE knt.deleted = 0 and knt.disabled = 0
                $custom";
        $command = Yii::app()->db->createCommand($sql);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        $count = $command->queryRow();

        return $count['total'];
    }

    public function get_test_category() {
        $sql = 'SELECT id as subject_id, title as subject_title
                                                 FROM yima_sys_subject 
                                                 WHERE search=1';
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

    public function get_test_organization() {
        $sql = 'SELECT id as org_id, title as org_title
                                                 FROM yima_sys_organization
                                                 WHERE search=1';
        $command = Yii::app()->db->createCommand($sql);
        return $command->queryAll();
    }

    public function get($id) {
        $user_id = UserControl::getId();
        $sql = "SELECT ynt.id,ynt.title,ynt.slug,ynt.description,ynt.section_id,ynt.price,ynt.author_id,ynt.date_added,ynt.last_modified,ynt.disabled,ynt.deleted,ynt.attach_file,ynt.total_comment,ynt.total_like,ynt.total_dislike,
                yofs.organization_id,yofs.faculty_id,yofs.subject_id,yofs.sub_number,yso.title as organization_title,ysf.title as faculty_title,yss.title as subject_title,ysu.email,ysu.firstname,ysu.lastname,ysu.thumbnail,(yv.ref_id = ynt.id) as voted
                FROM yima_nt_test ynt
                LEFT JOIN yima_organization_faculty_subject yofs
                ON ynt.group_id = yofs.id
                LEFT JOIN yima_sys_organization yso
                ON yso.id = yofs.organization_id
                LEFT JOIN yima_sys_faculty ysf
                ON ysf.id = yofs.faculty_id
                LEFT JOIN yima_sys_subject yss
                ON yss.id = yofs.subject_id
                LEFT JOIN yima_sys_user ysu
                ON ysu.id = ynt.author_id
                LEFT JOIN (SELECT ref_id
                            FROM yima_votes
                            WHERE ref_type = 'test_nt'
                            AND author_id = :author_id
                            AND point > 0
                            AND vote_type = 'post') yv
                ON yv.ref_id = ynt.id
                WHERE ynt.id = :id
                AND ynt.deleted = 0";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        $command->bindParam(":author_id", $user_id, PDO::PARAM_INT);
        return $command->queryRow();
    }

    public function get_by_slug($slug) {
        $user_id = UserControl::getId();
        $sql = "SELECT ynt.id,ynt.title,ynt.slug,ynt.description,ynt.section_id,ynt.price,ynt.author_id,ynt.date_added,ynt.last_modified,ynt.disabled,ynt.deleted,ynt.attach_file,ynt.total_comment,ynt.total_like,ynt.total_dislike,
                yofs.organization_id,yofs.faculty_id,yofs.subject_id,yofs.sub_number,yso.title as organization_title,ysf.title as faculty_title,yss.title as subject_title,ysu.email,ysu.firstname,ysu.lastname,ysu.thumbnail,(yv.ref_id = ynt.id) as voted,ynq.total_question
                FROM yima_nt_test ynt
                LEFT JOIN yima_organization_faculty_subject yofs
                ON ynt.group_id = yofs.id
                LEFT JOIN yima_sys_organization yso
                ON yso.id = yofs.organization_id
                LEFT JOIN yima_sys_faculty ysf
                ON ysf.id = yofs.faculty_id
                LEFT JOIN yima_sys_subject yss
                ON yss.id = yofs.subject_id
                LEFT JOIN yima_sys_user ysu
                ON ysu.id = ynt.author_id
                LEFT JOIN (SELECT ref_id
                            FROM yima_votes
                            WHERE ref_type = 'test_nt'
                            AND author_id = :author_id
                            AND point > 0
                            AND vote_type = 'post') yv
                ON yv.ref_id = ynt.id
                LEFT JOIN (SELECT count(*) as total_question,test_id
                            FROM yima_nt_question
                            GROUP BY test_id) ynq
                ON ynq.test_id = ynt.id
                WHERE ynt.slug = :slug
                AND ynt.deleted = 0";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":slug", $slug);
        $command->bindParam(":author_id", $user_id, PDO::PARAM_INT);
        return $command->queryRow();
    }

    public function add_user_test($user_id, $test_id) {
        $time = time();
        $sql = "INSERT INTO yima_user_test(user_id,ref_type,ref_id,date_added) VALUES(:user_id,'test_nt',:test_id,:date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":user_id", $user_id);
        $command->bindParam(":test_id", $test_id);
        $command->bindParam(":date_added", $time);
        return $command->execute();
    }

    public function add_user_toefl($user_id, $test_id, $c_id, $type) {
        $time = time();
        $times = 1;
        $sql = "INSERT INTO yima_user_test(user_id,ref_type,ref_id,main_id,date_added,times) VALUES(:user_id,:type,:test_id,:main_id,:date_added,:times)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":user_id", $user_id);
        $command->bindParam(":test_id", $test_id);
        $command->bindParam(":main_id", $c_id);
        $command->bindParam(":date_added", $time);
        $command->bindParam(":type", $type);
        $command->bindParam(":times", $times);
        $command->execute();
        return Yii::app()->db->lastInsertID;
    }

    public function get_user_test($user_id, $test_id) {
        $sql = "SELECT *
                FROM yima_user_test
                WHERE user_id = :user_id
                AND ref_type = 'test_nt'
                AND ref_id = :test_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":user_id", $user_id);
        $command->bindParam(":test_id", $test_id);
        return $command->queryRow();
    }

    public function get_user_toefl($user_id, $test_id, $type) {
        $sql = "SELECT *
                FROM yima_user_test
                WHERE user_id = :user_id
                AND ref_type = :type
                AND ref_id = :test_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":user_id", $user_id);
        $command->bindParam(":test_id", $test_id);
        $command->bindParam(":type", $type);
        return $command->queryRow();
    }

    public function get_user_toeic($user_id, $test_id, $type) {
        $sql = "SELECT *
                FROM yima_user_test
                WHERE user_id = :user_id
                AND ref_type = :type
                AND ref_id = :test_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":user_id", $user_id);
        $command->bindParam(":test_id", $test_id);
        $command->bindParam(":type", $type);
        return $command->queryRow();
    }

    public function add_test_relationship($relationship_id, $information, $total_question, $total_right) {
        $time = time();
        $sql = "INSERT INTO yima_test_relationship(relationship_id,information,total_question,total_right,date_added) VALUES(:relationship_id,:information,:total_question,:total_right,:date_added)";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":relationship_id", $relationship_id, PDO::PARAM_INT);
        $command->bindParam(":information", $information);
        $command->bindParam(":total_question", $total_question, PDO::PARAM_INT);
        $command->bindParam(":total_right", $total_right, PDO::PARAM_INT);
        $command->bindParam(":date_added", $time);
        $command->execute();
        return Yii::app()->db->lastInsertID;
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

    public function update_user_test($args) {
        $keys = array_keys($args);
        $custom = '';
        foreach ($keys as $k)
            $custom .= $k . ' = :' . $k . ', ';
        $custom = substr($custom, 0, strlen($custom) - 2);
        $sql = 'update yima_user_test set ' . $custom . ' where id = :id';
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute($args);
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

    public function get_test_relationship_toefl($relationship_id,$part) {
        
        $type = "";

        if ($part == "reading") {
            $type= "LEFT JOIN yima_toefl_reading ynt
                ON ynt.id = yut.ref_id";            
        }
        if ($part == "speaking") {
            $type= "LEFT JOIN yima_toefl_speaking ynt
                ON ynt.id = yut.ref_id";            
        }        
        if ($part == "listening") {
            $type= "LEFT JOIN yima_toefl_listening ynt
                ON ynt.id = yut.ref_id";            
        }
        if ($part == "writing") {
            $type= "LEFT JOIN yima_toefl_writing ynt
                ON ynt.id = yut.ref_id";            
        }


        $sql = "SELECT ytr.*,yut.user_id,ynt.title,yut.ref_id,yut.times,ysu.email as completor_email
                FROM yima_test_relationship ytr,yima_user_test yut
                
                $type
               
                LEFT JOIN yima_sys_user ysu
                ON yut.user_id = ysu.id              
                WHERE yut.id = ytr.relationship_id               
                AND ytr.id=:id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $relationship_id, PDO::PARAM_INT);

        return $command->queryRow();
    }
    
    public function get_test_relationship_toeic($relationship_id,$part) {
        
        $type = "";

        if ($part == "reading") {
            $type= "LEFT JOIN yima_toefl_reading ynt
                ON ynt.id = yut.ref_id";            
        }
        if ($part == "speaking") {
            $type= "LEFT JOIN yima_toefl_speaking ynt
                ON ynt.id = yut.ref_id";            
        }        
        if ($part == "listening") {
            $type= "LEFT JOIN yima_toefl_listening ynt
                ON ynt.id = yut.ref_id";            
        }
        if ($part == "writing") {
            $type= "LEFT JOIN yima_toefl_writing ynt
                ON ynt.id = yut.ref_id";            
        }


        $sql = "SELECT ytr.*,yut.user_id,ynt.title,yut.ref_id,yut.times,ysu.email as completor_email
                FROM yima_test_relationship ytr,yima_user_test yut
                
                $type
               
                LEFT JOIN yima_sys_user ysu
                ON yut.user_id = ysu.id              
                WHERE yut.id = ytr.relationship_id               
                AND ytr.id=:id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $relationship_id, PDO::PARAM_INT);

        return $command->queryRow();
    }

    public function count_test_relationship($relationship_id) {
        $sql = "SELECT count(ytr.id) as total
                FROM yima_test_relationship ytr,yima_user_test yut,yima_nt_test ynt
                WHERE yut.id = ytr.relationship_id
                AND yut.ref_type = 'test_nt'
                AND ynt.id = yut.ref_id
                AND ytr.relationship_id = :relationship_id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":relationship_id", $relationship_id, PDO::PARAM_INT);
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

    public function get_reading_scq_answer($id) {
        $sql = "SELECT answer FROM yima_toefl_reading_scq where id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }

    public function get_reading_mcq_answer($id) {
        $sql = "SELECT answer FROM yima_toefl_reading_mcq where id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }

    public function get_reading_scq_answer_toeic($id) {
        $sql = "SELECT answer FROM yima_toefl_reading_scq where id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }

    public function get_reading_mcq_answer_toeic($id) {
        $sql = "SELECT answer FROM yima_toefl_reading_mcq where id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }

}