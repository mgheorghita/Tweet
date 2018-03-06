<?php

class Database
{
    private $db ;
    protected static $_instance = null ;

    private function __construct()
    {
        $dsn = DRIVER.':dbname='.DB.';host='.HOST;

        try {
            $this->db = new PDO($dsn, USER, PASS);            
            Logging::register()->info("Successful connection to database again");        
        } catch (PDOException $e) {            
            Logging::register()->error($e->getMessage());
            return 'Conection failed ' . $e->getMessage();            
        }
    }

    public function getDb()
    {
        return $this->db;
    }

    public static function getInstance() 
    {
        if(!self::$_instance) {
            self::$_instance = new self() ;
        }
        return self::$_instance ;
    }
}