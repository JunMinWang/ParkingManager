<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" src='general.js'></script>
<?php
  if(!isset($_POST['cno'])||!isset($_POST['parkid'])||!isset($_POST['io'])||!isset($_POST['stime'])){
    echo "<script type='text/javascript'>URL_Trans('傳入資料錯誤!','recordlist.php');</script>";
  }else{
    include('db_connect_user.php');
    $cno = $_POST['cno'];
    $parkid = $_POST['parkid'];
    $io = $_POST['io'];
    $stime = $_POST['stime'];
    $sql = "INSERT INTO `record` (`recordID`, `car_number`, `sense_time`, `park_id`, `sense_type`) VALUES (NULL, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$cno);
    $stmt->bindParam(2,$stime);
    $stmt->bindParam(3,$parkid);
    $stmt->bindParam(4,$io);
    $stmt->execute();

    if($io=='0'){
      $sql2 = "INSERT INTO `park_inside` (`car_number`, `park_id`, `sense_time`) VALUES (?, ?, ?)";
      $stmt2 = $conn->prepare($sql2);
      $stmt2->bindParam(1,$cno);
      $stmt2->bindParam(2,$parkid);
      $stmt2->bindParam(3,$stime);
      $stmt2->execute();
    }else{
      $sql2 = "DELETE FROM `park_inside` WHERE `car_number` = ?";
      $stmt2 = $conn->prepare($sql2);
      $stmt2->bindParam(1,$cno);
      $stmt2->execute();
    }

    if($stmt->rowCount()==1){
      echo "<script type='text/javascript'>URL_Trans('資料已成功新增','recordlist.php');</script>";
    }else{
      echo "<script type='text/javascript'>URL_Trans('資料新增失敗','recordlist.php');</script>";
    }
    $conn = null;
  }
?>