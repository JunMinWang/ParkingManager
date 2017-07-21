<?php
  date_default_timezone_set('Asia/Taipei');
  if(!isset($_GET['cno'])||!isset($_GET['etagid'])||!isset($_GET['mc'])){
    $arr = array("code" => "0", "result" => urlencode("API未取得值"));
    echo urldecode(json_encode($arr));
  } else {
    $success_count=0;
    $car_no = $_GET['cno'];
    $car_etag = $_GET['etagid'];
    $md5code = $_GET['mc'];
    $lastchar = substr($car_no,-2).substr($car_etag,-2);
    $md5char = strtoupper(md5($lastchar));
    $tempDate = date("Y-m-d H:i:s");

    if (strcmp($md5char, $md5code)==0) {
      try{
        include_once 'db_connect_user.php';
        $sql = "INSERT INTO `update_data` (`car_etag_id`, `car_number`, `update_time`) VALUES ( ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $car_etag);
        $stmt->bindParam(2, $car_no);
        $stmt->bindParam(3, $tempDate);
        $stmt->execute();

        if ($stmt->rowCount()==1) {
          $arr = array("code" => "2", "result" => urlencode("資料新增成功"));
          echo urldecode(json_encode($arr));
        } else if ($stmt->rowCount()==0) {
          $arr = array("code" => "1", "result" => urlencode("資料未異動"));
          echo urldecode(json_encode($arr));
        }
        $conn = null;
      }catch(Exception $e){
        $arr = array("code" => "0" , "result" => urlencode("資料庫錯誤"));
        echo urldecode(json_encode($arr));
      }
    } else {
      $arr = array("code" => "0" , "result" => urlencode("MD5 HASH ERROR"));
      echo urldecode(json_encode($arr));
    }
  }
?>
