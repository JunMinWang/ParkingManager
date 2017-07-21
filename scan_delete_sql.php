<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script text="text/javascript" src="general.js"></script>
<?php
  if(!isset($_GET['cno'])){
    echo "<script type='text/javascript'>URL_Trans('系統未傳值','scanlist.php');</script>";
  }else{
    include('db_connect_manager.php');
    $cno = $_GET['cno'];
    $sql = "DELETE FROM `update_data` WHERE `car_number` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$cno);
    $stmt->execute();
    if($stmt->rowCount()==1){
      echo "<script type='text/javascript'>URL_Trans('資料已成功刪除!','scanlist.php');</script>";
    }else{
      echo "<script type='text/javascript'>URL_Trans('資料未刪除!','scanlist.php');</script>";
    }
    $conn = null;
  }
?>