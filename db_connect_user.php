<?php
  $dbhost = '127.0.0.1';
  $dbuser = '';
  $dbpwd = '';
  $dbname = 'parkingmanager';
  try{
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpwd);
    $conn->exec("SET CHARACTER SET utf8");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(PDOException $e){
    echo "Error: " . $e->getMessage();
  }
?>
