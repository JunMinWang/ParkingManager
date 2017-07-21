<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="general.js"></script>
<?php
  date_default_timezone_set('Asia/Taipei');
  if(!isset($_POST['typeid'])||!isset($_POST['rentalid'])||!isset($_POST['cost'])||!isset($_POST['oid'])){
    echo "<script type='text/javascript'>URL_Trans('系統未傳值','typelist.php');</script>";
  }else{
    include('db_connect_user.php');
    $rTypeID = $_POST['typeid'];
    $rTypeName = $_POST['rentalid'];
    $rMonths=$_POST['rmonth'];
    $rCost=$_POST['cost'];
    $old_ID=$_POST['oid'];

    $sql = "UPDATE `rental_type` SET `rTypeID` = ?, `rTypeName` = ?, `rMonths` = ?,`rCost` = ? WHERE `rTypeID` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$rTypeID);
    $stmt->bindParam(2,$rTypeName);
    $stmt->bindParam(3,$rMonths);
    $stmt->bindParam(4,$rCost);
    $stmt->bindParam(5,$rTypeID);
    $stmt->execute();
    if($stmt->rowCount()==1){
      echo "<script type='text/javascript'>URL_Trans('資料更新完畢!','typelist.php');</script>";
    }else{
      echo "<script type='text/javascript'>URL_Trans('資料失敗!','typelist.php');</script>";
    }
    $conn = null;
  }
?>