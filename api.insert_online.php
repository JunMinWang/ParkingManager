<?php
  date_default_timezone_set('Asia/Taipei');
  if(!isset($_GET['cno'])){
    $arr = array("code" => "0", "result" => urlencode("API未取得值"));
    echo urldecode(json_encode($arr));
  } else {
    $car_no = $_GET['cno'];
    $etag = $_GET['etagid'];
    $tempDate = date("Y-m-d H:i:s");

    try{
      include_once 'db_connect_user.php';
      $sql = "INSERT INTO `update_data` (`car_etag_id`, `car_number`, `update_time`) VALUES ( ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(1, $etag);
      $stmt->bindParam(2, $car_no);
      $stmt->bindParam(3, $tempDate);
      $stmt->execute();;

      if ($stmt->rowCount()==1) {
        $arr = array("code" => "1", "result" => urlencode("資料新增成功"));
        echo urldecode(json_encode($arr));
      } else if ($stmt->rowCount()==0) {
        $arr = array("code" => "0", "result" => urlencode("資料未異動"));
        echo urldecode(json_encode($arr));
      }
      $conn = null;
    }catch(Exception $e){
      $arr = array("code" => "0" , "result" => urlencode("資料庫錯誤"));
      echo urldecode(json_encode($arr));
    }
  }
?>