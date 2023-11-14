<?php namespace mvc\Models;
use core\Database;
use PDO;
class Shop_Model {

    private $db;
    
    public function getItems() {
        $db = Database::getInstance()->getPDO();
        $data =  [];
        $stmt = $db->prepare("SELECT *  FROM shop_category");
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        
        if(is_array($data) && !empty($data)) return $data;


    }
    
}