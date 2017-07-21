<?php
  include('db_connect_user.php');
  $pid = $_GET['pid'];
  $td_index = $_GET{'td_index'};
  $pcount = $_GET['pcount'];
  $sql = "SELECT * FROM `park_inside` WHERE `park_id` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $pid);
  $stmt->execute();
  
  $count = $stmt->rowCount();
  echo json_encode(Array('count' => $count,'td_index' => $td_index, 'pcount' => $pcount));
?>