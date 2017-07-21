<?php
  include('db_connect_user.php');
  if(trim($_POST['acc'])==""){
    echo json_encode(Array('result' => 0));
  }else{
    $acc = $_POST['acc'];
    $sql = "SELECT * FROM `admin_data` WHERE `admin_account` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $acc);
    $stmt->execute();
  
    if($stmt->rowCount()==1){
      echo json_encode(Array('result' => 1));
    }else if($stmt->rowCount()==0){
      echo json_encode(Array('result' => 2));
    }
  }
?>