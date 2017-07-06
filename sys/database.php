<?php

/* 
 * Demo Framework Database, not much more then a way to wrap new PDO
 * @author Zackary Boarman
 * @version 1.0
 */

class Sys_Database{
    private $db;
    public $table;
    
    public function __construct($table) {
        $this->db = new PDO(
            'mysql:host='.DATABASE_HOST.';dbname='.DATABASE_NAME.';charset=utf8',
            DATABASE_USER,
            DATABASE_PASS,
            [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]
        );
        
        switch($table){
            case 'users':
            case 'sites':
            case 'reviews':
                $this->table = $table;
                break;
            
            default:
                $this->table = "";
                $this->db = null;
                return false;
        }
    }
    
    //For doing raw queries
    public function getPDO(){
        return $this->db;
    }
    
    //get a single row from the table
    public function getRow($id){
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE `id` = :id");
        $query->execute(['id' => (int) $id]);
        return $query->fetch();
    }
    
    //get all rows of this table
    public function getAllRows(){
        $query = $this->db->prepare("SELECT * FROM $this->table");
        $query->execute();
        return $query->fetchAll();
    }
}