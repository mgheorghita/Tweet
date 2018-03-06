<?php

class Model
{
    protected $db;
    private $where = '';
    private $limit = '25';
    private $order = 'asc';
    private $orderColumn;
    private $join = '';

    public function __construct() {
        $this->db = Database::getInstance()->getDb() ;
    }

    public function getDbHandler(){
        return $this->db;
    }


    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    public function setOrder($orderColumn , $order)
    {
        $this->order = $order;
        $this->orderColumn = $orderColumn;
    }
     public function setWhere($where)
    {
        $this->where = $where;
    }

    public function setJoin($join)
    {
        $this->join = $join;
    }
    
    public function getWhere()
    {
        return $this->where;
    }

  
    public function getLimit()
    {
        return $this->limit;
    }

 
    public function getOrder()
    {
        return $this->order;
    }

   
    public function getJoin()
    {
        return $this->join;
    }


    public function select($table, $object, $columns = array('*'))
    {
        $columns = implode(',',array_values($columns));
        $result = array();
        $sql = 'SELECT '.$columns.' FROM '. $table.  " ".$this->getJoin()." ".$this->getWhere()." order by ".$this->orderColumn." ".$this->getOrder(). " limit ".$this->getLimit();
        $sth = $this->db->prepare($sql);
        
        try {
            $sth->execute();
            Logging::register()->info("Successful select from database ");            
        } catch (PDOException $e) {           
            Logging::register()->error($e->getMessage());        
        }
        
        while($row = $sth->fetchObject($object))
        {
            array_push($result,$row);
        }
//        var_dump($sql);
     return $result;
    }

    public function delete($table, array $array)
    {
        $sql = 'DELETE FROM '. $table.' WHERE ';

        $keys = array_keys($array);
        $values = array_values($array);
        $sql .= $keys[0] . "='".$values[0]."'";
        for($i = 1; $i < count($keys); $i++)
        {
            $sql.= "and ".$keys[$i]."='".$values[$i]."'";
        }
        $sth = $this->db->prepare($sql);
        //var_dump($sql);
        try {
            $sth->execute();
            Logging::register()->info("Successful delete from database "); 
            
            return True;
            
        } catch (PDOException $e) {
            Logging::register()->error($e->getMessage());  
            return False;
        }
        
    }

    public function insert($table, array $array)
    {
        $keys = implode(',',array_keys($array));
        $values = implode("','", array_values($array));
        $sql = "INSERT INTO " . $table ." (".$keys.") VALUES ('".$values."')";
       
        $sth = $this->db->prepare($sql);
        try {
            $sth->execute();
            Logging::register()->info("Successful insert in database");
            
            return True;
        } catch (PDOException $e) {            
            Logging::register()->error($e->getMessage()); 
            return False;
        }
    }
    public function update($table, array $array, $id)
    {
        $sql = "UPDATE " . $table ." SET " ;
        $keys = array_keys($array);
        $values = array_values($array);
        $sql .= $keys[0] . "='".$values[0]."'";
        for($i = 1; $i < count($keys); $i++)
        {
            $sql.= ", ".$keys[$i]."='".$values[$i]."'";
        }
        $sql .= " where id =".$id;
        $sth = $this->db->prepare($sql);
        
        try {
            $sth->execute();
            Logging::register()->info("Successful update of table $table");
            
            return True;
        } catch (PDOException $e) {            
            Logging::register()->error($e->getMessage());           
            return False;
        }

    }

    public function query($sqlQuery, $object )
    {
        $result = array();
        $sth = $this->db->prepare($sqlQuery);
//        var_dump($sqlQuery);
        try {
            $sth->execute();
            Logging::register()->info("The custom querry was executed sucessfuly"); 
            while($row = $sth->fetchObject($object))
            {
                array_push($result,$row);
            }
            return $result;
        } catch (PDOException $e) {            
            Logging::register()->error($e->getMessage());         
        }        
        
    }

 }