<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" src='general.js'></script>
<?php
  if(!isset($_POST['acc'])||!isset($_POST['name'])||!isset($_POST['level'])){
    echo "<script type='text/javascript'>URL_Trans('傳入資料錯誤!','manager_data.php');</script>";
  }else{
    include('db_connect_user.php');
    $acc = $_POST['acc'];
    $name = $_POST['name'];
    $level = $_POST['level'];
    $sql = "UPDATE `admin_data` SET `admin_name` = ?, `admin_level` = ? WHERE `admin_account` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$name);
    $stmt->bindParam(2,$level);
    $stmt->bindParam(3,$acc);
    $stmt->execute();
    if($stmt->rowCount()==1){
      echo "<script type='text/javascript'>URL_Trans('資料已成功更新','manager_data.php');</script>";
    }else{
      echo "<script type='text/javascript'>URL_Trans('資料更新失敗','manager_data.php');</script>";
    }
    $conn = null;
  }
?>