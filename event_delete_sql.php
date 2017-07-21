<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" src='general.js'></script>
<?php
  if(!isset($_GET['eid'])) {
    echo "<script type='text/javascript'>URL_Trans('傳入資料錯誤!','eventlist.php');</script>";
  } else {
    include('db_connect_user.php');
    $id = $_GET['eid'];

    $sql = "DELETE FROM `events` WHERE `eventId` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$id);
    $stmt->execute();
    
    if($stmt->rowCount()==1){
      echo "<script type='text/javascript'>URL_Trans('事件已刪除','eventlist.php');</script>";
    }else{
      echo "<script type='text/javascript'>URL_Trans('事件刪除失敗','eventlist.php');</script>";
    }
    $conn = null;
  }
?>