<?php

use LDAP\Result;

class Conexion
{       //INSERT INTO t_estudiantes (Nombre,Carrera) VALUES ('said','isc')
    //mysql -hcontainers-us-west-111.railway.app -uroot -pYgMcaaHNUloLzFIO6Nse --port 7546 --protocol=TCP railway
    //mysql://${{ MYSQLUSER }}:${{ MYSQLPASSWORD }}@${{ MYSQLHOST }}:${{ MYSQLPORT }}/${{ MYSQLDATABASE }}
    //select * from t_estudiantes
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