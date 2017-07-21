<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" src='general.js'></script>
<?php
  if(!isset($_GET['acc'])){
    echo "<script type='text/javascript'>URL_Trans('傳入資料錯誤','manager_data.php');</script>";
  }else{
    include('db_connect_user.php');
    $acc = $_GET['acc'];
    $sql = "DELETE FROM `admin_data` WHERE `admin_account` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$acc);
    $stmt->execute();
    if($stmt->rowCount()==1){
      echo "<script type='text/javascript'>URL_Trans('資料已成功刪除','manager_data.php');</script>";
    }else{
      echo "<script type='text/javascript'>URL_Trans('資料刪除失敗','manager_data.php');</script>";
    }
    $conn = null;
  }
?>