<?php

class FaqModel extends CFormModel {

    public function __construct() {
        
    }
    
    public function gets($args, $page = 1, $ppp = 20) {
        $page = ($page - 1) * $ppp;
        $custom = "";
        $params = array();
        
        if (isset($args['s']) && $args['s'] != "") {
            $custom.= " AND ksf.title like :title";            
            $params[] = array('name' => ':title', 'value' => "%$args[s]%",'type'=>PDO::PARAM_STR);
        }        
        
        if(isset($args['deleted'])){
            $custom.= " AND ksf.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'],'type'=>PDO::PARAM_INT);
        }
        
        if (isset($args['description']) && $args['description'] != "") {
            $custom.= " OR ksf.description like :description";            
            $params[] = array('name' => ':description', 'value' => "%$args[description]%",'type'=>PDO::PARAM_STR);
        }        

        $sql = "SELECT ksf.*,kfc.title as category_name
                FROM yima_sys_faqs ksf
                LEFT JOIN yima_faq_categories kfc
                ON kfc.id = ksf.category_id
                WHERE 1
                $custom
                ORDER BY ksf.date_added DESC
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
            $custom.= " AND ksf.title like :title";
            $params[] = array('name' => ':title', 'value' => "%$args[s]%",'type'=>PDO::PARAM_STR);
        }
        
        if(isset($args['deleted'])){
            $custom.= " AND ksf.deleted = :deleted";
            $params[] = array('name' => ':deleted', 'value' => $args['deleted'],'type'=>PDO::PARAM_INT);
        }
        
        if (isset($args['description']) && $args['description'] != "") {
            $custom.= " OR ksf.description like :description";            
            $params[] = array('name' => ':description', 'value' => "%$args[description]%",'type'=>PDO::PARAM_STR);
        }

        $sql = "SELECT count(*) as total
                FROM yima_sys_faqs ksf
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
        $sql = "SELECT ksf.*,kfc.title as category_name
                FROM yima_sys_faqs ksf
                LEFT JOIN yima_faq_categories kfc
                ON kfc.id = ksf.category_id
                WHERE ksf.id = :id
                AND ksf.deleted = 0
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        return $command->queryRow();
    }
    

    public function get_by_slug($slug){
        $sql = "SELECT ksf.*,kfc.title as category_name
                FROM yima_sys_faqs ksf
                LEFT JOIN yima_faq_categories kfc
                ON kfc.id = ksf.category_id
                WHERE ksf.slug = :slug
                AND ksf.deleted = 0
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":slug", $slug);
        return $command->queryRow();
    }
    
    public function get_by_category($category_id,$page = 1,$ppp = 5){
        $page = ($page - 1)*$ppp;
        $sql = "SELECT ksf.*,kfc.title as category_name
                FROM yima_sys_faqs ksf
                LEFT JOIN yima_faq_categories kfc
                ON kfc.id = ksf.category_id
                WHERE ksf.deleted = 0
                AND category_id = :category_id
                ORDER BY title ASC
                LIMIT :from,:to
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":category_id", $category_id,PDO::PARAM_INT);
        $command->bindParam(":from", $page,PDO::PARAM_INT);
        $command->bindParam(":to", $ppp,PDO::PARAM_INT);
        return $command->queryAll();
    }
    
    public function count_by_category($category_id){
        
        $sql = "SELECT count(*) as total
                FROM yima_sys_faqs ksf
                LEFT JOIN yima_faq_categories kfc
                ON kfc.id = ksf.category_id
                WHERE ksf.deleted = 0
                AND category_id = :category_id
                ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(":category_id", $category_id,PDO::PARAM_INT);
        $count = $command->queryRow();
        return $count['total'];
    }
    
}