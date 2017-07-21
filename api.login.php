<?php
  if(isset($_POST['admin'])&&isset($_POST['password'])) {
    $account = trim($_POST['admin']);
    $password = trim($_POST['password']);

    try{
      include_once 'db_connect_user.php';
      $sql = "SELECT * FROM `admin_data` WHERE `admin_account` = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(1, $account);
      $stmt->execute();;

      if ($stmt->rowCount()==1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(strcmp($row['admin_pwd'],$password)==0) {
          echo 'success';
        }
      }
      $conn = null;
    }catch(Exception $e){}
  }
?>