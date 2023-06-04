<?php
     $server = 'localhost:8889'; 
     $username = 'root';
     $password = 'root';
     $database = 'gademy';
      
      //realizar la conexion 
     try{
         //PDO -> para guardar un objeto de datos 
         $conn = new PDO("mysql:host=$server; dbname=$database;", $username, $password);
     }catch(PDOException $error) {
         die('Connection Failed: ' . $error->getMessage());
     }
?>