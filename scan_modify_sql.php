<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="general.js"></script>
<?php
  date_default_timezone_set('Asia/Taipei');
  if(!isset($_POST['etagid'])||!isset($_POST['cno'])||!isset($_POST['ocno'])){
    echo "<script type='text/javascript'>URL_Trans('系統未傳值','scanlist.php');</script>";
  }else{
    include('db_connect_user.php');
    $etagid = $_POST['etagid'];
    $cno = $_POST['cno'];
    $ocno = $_POST['ocno'];
    $tempDate = date("Y-m-d H:i:s");
    $sql = "UPDATE `update_data` SET `car_number` = ?, `car_etag_id` = ?, `update_time` = ? WHERE `car_number` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$cno);
    $stmt->bindParam(2,$etagid);
    $stmt->bindParam(3,$tempDate);
    $stmt->bindParam(4,$ocno);
    $stmt->execute();
    if($stmt->rowCount()==1){
      echo "<script type='text/javascript'>URL_Trans('資料更新完畢!','scanlist.php');</script>";
    }else{
      echo "<script type='text/javascript'>URL_Trans('資料失敗!','scanlist.php');</script>";
    }
    $conn = null;
  }
?>