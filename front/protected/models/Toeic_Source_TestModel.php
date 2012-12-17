<?php

class Toeic_Source_TestModel extends CFormModel {

    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }
        $sql = "SELECT *
                FROM yima_toeic_source_test
                WHERE deleted = 0 and disabled = 0
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

    public function counts($args) {

        $custom = "";
        $params = array();

        if (isset($args['s']) && $args['s'] != "") {
            $custom = " AND title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%", 'type' => PDO::PARAM_STR);
        }

        $sql = "SELECT count(*) as total
                FROM yima_toeic_source_test
                WHERE deleted = 0 and disabled = 0
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
                FROM yima_toeic_source_test
                WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }
    
    public function get_sc_reading($id) {
        $sql = "SELECT question,answer,id FROM yima_toeic_reading_part5 WHERE id = :id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id);
        return $command->queryRow();
    }
    
    public function get_toeic_tests($args, $page = 1, $ppp = 20) {
        $page = ($page - 1 ) * $ppp;
        $custom = "";
        $params = array();

        if (isset($args['user_id'])) {
            $custom.= " AND user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT ut.*,st.title,st.`level`
                FROM yima_user_test ut
                LEFT JOIN yima_toeic_source_test st
                ON ut.main_id = st.id
                WHERE ref_type LIKE '%toeic%'
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

    public function count_finished_toeic($args) {
        $custom = "";
        $params = array();

        if (isset($args['user_id'])) {
            $custom.= " AND user_id = :user_id";
            $params[] = array('name' => ':user_id', 'value' => $args['user_id'], 'type' => PDO::PARAM_INT);
        }

        $sql = "SELECT count(*) as total
                FROM yima_user_test ut
                LEFT JOIN yima_toefl_source_test st
                ON ut.main_id = st.id
                WHERE ref_type LIKE '%toefl%'
		$custom
                GROUP BY main_id 
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
