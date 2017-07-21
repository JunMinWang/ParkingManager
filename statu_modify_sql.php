<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script text="text/javascript" src="general.js"></script>
<?php
  date_default_timezone_set('Asia/Taipei');
  if(!isset($_POST['statuid'])||!isset($_POST['cno'])||!isset($_POST['ocno'])){
    echo "<script type='text/javascript'>URL_Trans('系統未傳值','statulist.php');</script>";
  }else{
    include('db_connect_user.php');
    $rStatuID = $_POST['statuid'];
    $rStatuName = $_POST['statunameid'];
    $rStatuMemo=$_POST['statumemo'];

    $sql = "UPDATE `rStatuID` SET `rStatuID` = ?, `rStatuName` = ?, `rStatuMemo` = ? WHERE `rStatuID` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()==1){
      echo "<script type='text/javascript'>URL_Trans('資料更新完畢','statulist.php');</script>";
    }else{
      echo "<script type='text/javascript'>URL_Trans('資料失敗!','statulist.php');</script>";
    }
    $conn = null;
  }
?>