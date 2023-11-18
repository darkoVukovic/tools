<?php namespace mvc\Models;
use core\Database;
use PDO;
class User_Model {

    private $db;
    
    public function storeUser($name, $email) {

        if($this->getUser($name, $email)) {
            return true;
        }
        $db = Database::getInstance()->getPDO();
        $sql = "INSERT INTO users (name, email) VALUES (?,?)";
        $stmt= $db->prepare($sql);

        if($stmt->execute([$name, $email])) return true;
        else return false;
    }


    public function getUser ($name, $email) {
        $db = Database::getInstance()->getPDO();
        $stmt = $db->prepare("SELECT name, email FROM users WHERE name = ? AND email = ?");
        $stmt->bindParam(1, $name, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(is_array($row)) return $row;
        else return false;

        
    } 
    
    
}