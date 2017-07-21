<?php
  if(!isset($_GET['cno'])){
    $arr = array("code" => "0", "result" => urlencode("API未取得值"));
    echo urldecode(json_encode($arr));
  } else {
    $car_no = $_GET['cno'];

    try{
      include_once 'db_connect_user.php';
      $sql = "SELECT * FROM `parkingprofile` WHERE `uCno` = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(1, $car_no);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $arr = array("name" => urlencode($row['uName']), "uid" => $row['uID'], "dept" => urlencode($row['uDept']), "phone" => $row['uPhone'], "startdate" => $row['rStartDate'], "enddate" => $row['rEndDate']);
      echo urldecode(json_encode($arr));
      $conn = null;
    } catch(Exception $e) {
      $arr = array("code" => "0" , "result" => urlencode("資料庫錯誤"));
      echo urldecode(json_encode($arr));
    }
  }
?>
