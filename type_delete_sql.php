<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script text="text/javascript" src="general.js"></script>
<?php
  if(!isset($_GET['cno'])){
    echo "<script type='text/javascript'>URL_Trans('傳入資料錯誤','typelist.php');</script>";
  }else{
    include('db_connect_user.php');
    $cno = $_GET['cno'];
    $sql = "DELETE FROM `rental_type` WHERE `rTypeID` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$cno);
    $stmt->execute();
    if($stmt->rowCount()==1){
      echo "<script type='text/javascript'>URL_Trans('資料已成功刪除!','typelist.php');</script>";
    }else{
      echo "<script type='text/javascript'>URL_Trans('資料未刪除!','typelist.php');</script>";
    }
    $conn = null;
  }
?>