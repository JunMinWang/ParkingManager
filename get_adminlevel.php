<?php
  include('db_connect_user.php');
  $level = $_GET['level'];
  $sql = "SELECT * FROM `admin_type` WHERE `admin_level` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $level);
  $stmt->execute();
  
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $al = urlencode($row['admin_levelname']);
  echo json_encode(Array('levelname' => $al));
?>