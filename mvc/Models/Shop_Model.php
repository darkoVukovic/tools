<?php namespace mvc\Models;
use core\Database;
use PDO;
class Shop_Model {

    private $db;
    
    public function getItems($table) {
        $db = Database::getInstance()->getPDO();
        $data =  [];
        $columnNames = [];
        static $cNames= 0;
        $stmt = $db->prepare("SELECT *  FROM ". $table);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
            if($cNames > 0) continue;
            foreach($row as $key => $val) {
              $columnNames[] = $key;
            }
            $cNames++;
        }
        $data['columnNames'] = $columnNames;
        if(is_array($data) && !empty($data)) return $data;

    }
    
}