<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script text="text/javascript" src="general.js"></script>
<?php
  if(!isset($_GET['cno'])){
    echo "<script type='text/javascript'>URL_Trans('系統未傳值','parkplace.php');</script>";
  }else{
    include('db_connect_user.php');
    $cno = $_GET['cno'];
    $sql = "DELETE FROM `park_type` WHERE `park_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$cno);
    $stmt->execute();
    if($stmt->rowCount()==1){
      echo "<script type='text/javascript'>URL_Trans('資料已成功刪除!','park_place.php');</script>";
    }else{
      echo "<script type='text/javascript'>URL_Trans('資料未刪除!','park_place.php');</script>";
    }
    $conn = null;
  }
?>