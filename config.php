<?php

use LDAP\Result;

class Conexion
{       
    private $servidor="containers-us-west-109.railway.app";
    private $user="root";
    private $password="jTiFUSK45ifbd4d9A5kQ";
    private $db="railway";
    private $port="5761";
    private $con;

    public function __construct()
    {
        try 
        {
            $this->con= new PDO("mysql:host=$this->servidor;dbname=$this->db;port=$this->port",$this->user,$this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
         catch (PDOException $e) 
        {
            return "falla de coneccion".$e;
        }
    }
    
    public function ejecutar($sql){ //delete-update-insert
        $this->con->exec($sql);
        return $this->con->lastInsertId();
    }

}  



?>