<?php  namespace core;

use mysqli;
use PDO;
    class Database {

        private static $instance ;
        private $db;
        protected function __clone() { }
        private function __construct ($db = null, $username = false, $password = false, $localhost = false ) {
            $this->db = new PDO('mysql:host=localhost;dbname=prodTest', $_ENV['username'], $_ENV['password']);

        } 

        public static function getInstance () {
            if(!self::$instance) self::$instance = new self();

            return self::$instance;
        } 

        public function getPDO () {
            return $this->db;
        } 

        
  
        
    }