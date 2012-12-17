<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Course_testModel extends CFormModel {

    public function __construct() {
        
    }

    public function get_toefl_course($args = array(), $page = 1, $ppp = 12) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND kso.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        if (isset($args['featured'])) {
            $custom .= " AND kso.featured = 1";
        }
        $sql = "SELECT *
                FROM yima_toefl_source_test ktst
                WHERE  disabled = 0 AND deleted = 0
                $custom
                ORDER BY ktst.title ASC
                LIMIT :page,:ppp";

        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":page", $page);
        $command->bindParam(":ppp", $ppp);
        foreach ($params as $a) {
            $command->bindParam($a['name'], $a['value'], $a['type']);
        }
        return $command->queryAll();
    }

    public function get_toefl_counts($args = array()) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND kso.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        if (isset($args['featured'])) {
            $custom .= " AND kso.featured = 1";
        }
        $sql = "SELECT count(ktst.id) as total
                FROM yima_toefl_source_test ktst
                WHERE  disabled = 0 AND deleted = 0
                $custom
                ORDER BY ktst.title ASC
                ";

        $command = Yii::app()->db->createCommand($sql);

        foreach ($params as $a) {
            $command->bindParam($a['name'], $a['value'], $a['type']);
        }
        $count = $command->queryRow();

        return $count['total'];
    }

    public function get_source($id) {
        $sql = "SELECT *
                FROM yima_toefl_source_test
                WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);

        return $command->queryRow();
    }

    public function get_sc_reading_answer($id) {
        $sql = "SELECT answer FROM yima_toefl_reading_scq WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryRow();
    }

    public function get_sc_reading($id) {
        $sql = "SELECT title,answer,id FROM yima_toefl_reading_scq WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryRow();
    }

    public function get_mc_reading($id) {
        $sql = "SELECT title,answer,id FROM yima_toefl_reading_mcq WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryRow();
    }

    public function get_iq_reading($id) {
        $sql = "SELECT title,answer,id FROM yima_toefl_reading_iq WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryRow();
    }

    public function get_oq_reading($id) {
        $sql = "SELECT title,id FROM yima_toefl_reading_oq WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryRow();
    }

    public function get_ddq_reading($id) {
        $sql = "SELECT rd.id,rd.title, rds.id as sub_id, rds.title as sub_title,rda.id as ans_id
                FROM yima_toefl_reading_ddq rd
                LEFT JOIN yima_toefl_reading_ddq_subjects rds
                ON rd.id = rds.ddqid
                LEFT JOIN yima_toefl_reading_ddq_answer rda
                ON rd.id = rda.ddqid AND rds.id =  rda.subid
                WHERE rd.id = :id
                GROUP BY rds.id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryAll();
    }

    public function get_sc_listening($id) {
        $sql = "SELECT title,answer,id FROM yima_toefl_listening_scq WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryRow();
    }

    public function get_mc_listening($id) {
        $sql = "SELECT title,answer,id FROM yima_toefl_listening_mcq WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryRow();
    }

    public function get_cq_listening($id) {
        $sql = "SELECT  lc.id,lcc.id as co_id,lcr.title,lcr.id as ro_id
                FROM yima_toefl_listening_cq lc
                LEFT JOIN yima_toefl_listening_cq_row lcr
                ON lc.id = lcr.cqid
              
LEFT JOIN yima_toefl_listening_cq_column lcc
ON lcc.id = lcr.col
WHERE lc.id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryAll();
    }

    public function get_oq_listening($id) {
        $sql = "SELECT title,id FROM yima_toefl_listening_oq WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryRow();
    }

    public function get_toefl_tests($args, $page = 1, $ppp = 20) {
        $page = ($page - 1 ) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['user_id'])) {
            $custom.= " AND user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT ut.*,st.title,st.`level`
                FROM yima_user_test ut
                LEFT JOIN yima_toefl_source_test st
                ON ut.main_id = st.id
                WHERE ref_type LIKE '%toefl%'
		$custom
                GROUP BY main_id 
                LIMIT :page,:ppp";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':page', $page, PDO::PARAM_INT);
        $command->bindParam(':ppp', $ppp, PDO::PARAM_INT);
        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        return $command->queryAll();
    }

    public function count_finished_toefl($args) {
        $custom = "";
        $params = array();

        if (isset($args['user_id'])) {
            $custom.= " AND user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT count(*) as total
                FROM yima_user_test
                WHERE ref_type LIKE '%toefl%'
                $custom             
                GROUP BY ref_id
                ";
        $command = Yii::app()->db->createCommand($sql);

        foreach ($params as $a)
            $command->bindParam($a['name'], $a['value'], $a['type']);
        $count = $command->queryRow();
        return $count['total'];
    }
    
    

    public function get_list_finished($id) {
        $sql = "SELECT ytr.id,ytr.relationship_id,ytr.date_added,yut.user_id,yut.ref_type,yut.ref_id,case 
        when ref_type LIKE  '%speaking%' then 'speaking'
        when  ref_type LIKE '%reading%' then  'reading'
        when  ref_type LIKE '%writing%' then  'writing'
        when  ref_type LIKE '%listening%' then  'listening'
            end as type
                FROM yima_test_relationship ytr
                LEFT JOIN yima_user_test yut
                ON yut.id = ytr.relationship_id
                WHERE relationship_id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':id', $id, PDO::PARAM_INT);
        return $command->queryAll();
    }

}

?>
