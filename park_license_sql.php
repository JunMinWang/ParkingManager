<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script text="text/javascript" src="general.js"></script>
<?php
date_default_timezone_get();
if(!isset($_POST['first'])){
  echo '<script>URL_Trans("傳入值錯誤","profile.php");</script>';
}else{
  include('db_connect_user.php');
  
  $first = $_POST['first'];
  
  $applystart = $_POST['applystart'];
  $applyend = $_POST['applyend'];
  $rend = $_POST['rend'];
  $uid = $_POST['uid'];
  $cno = $_POST['car_number'];
  $today = date('m/d/Y', time());
  
  if($first == 'T'){ //初次申請
    $sql = "UPDATE `parkingprofile` SET `rStartDate` = ?, `rEndDate` = ?, `uCno` = ? WHERE `uID` = ?"; /*cno取不到值?*/
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$applystart);
    $stmt->bindParam(2,$applyend);
    $stmt->bindParam(3,$cno);
    $stmt->bindParam(4,$uid);
    $stmt->execute();
    echo '<script>URL_Trans("申請成功!","profile.php");</script>';
  }else{ //申請展延
    if(strtotime($rend) > strtotime($today)){ //還在期限內
      $sql = "UPDATE `parkingprofile` SET `rEndDate` = ? WHERE `uID` = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(1,$applyend);
      $stmt->bindParam(2,$uid);
      $stmt->execute();
    echo '<script>URL_Trans("申請成功!","profile.php");</script>';
    } else { //過期了 測試過OK
      $sql = "UPDATE `parkingprofile` SET `rStartDate` = ?, `rEndDate` = ? WHERE `uID` = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(1,$applystart);
      $stmt->bindParam(2,$applyend);
      $stmt->bindParam(3,$uid);
      $stmt->execute();
      echo '<script>URL_Trans("申請成功!","profile.php");</script>';
    }
  }
}
?>