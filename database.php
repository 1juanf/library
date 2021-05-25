<?php
  $server = 'localhost';
  $username= 'root';
  $password='';
  $database='library';

  try{
    $conn= new PDO("mysql:host=$server;dbname=$database;",$username,$password);
  }catch(PDOExeption $e){
    die('conection fail:'.$e->getMessage());
  }
 ?>
