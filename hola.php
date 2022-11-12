<?php
$servername = "containers-us-west-109.railway.app";
$username = "root";
$password = "jTiFUSK45ifbd4d9A5kQ";
$dbname = "railway";
$port="5761";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO t_estudiantes (Nombre,Carrera) VALUES  ('mmm','mmm')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
  
  $conn = null;




?>