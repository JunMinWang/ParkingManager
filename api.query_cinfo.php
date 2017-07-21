<?php
  if(!isset($_GET['cno'])){
    $arr = array("code" => "0", "result" => urlencode("API未取得值"));
    echo urldecode(json_encode($arr));
  }else{
    $cno = $_GET['cno'];
    include("db_connect_user.php");
    try{
      $sql = "SELECT * FROM (SELECT `record`.*, `park_type`.`park_name` FROM `record`,`park_type` WHERE `record`.`park_id` = `park_type`.`park_id`)AS Q1 WHERE Q1.`car_number` = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(1,$cno);
      $stmt->execute();
      $result ="[";
      $icount=1;
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $single_record = array("pname" => urlencode($row['park_name']), "stime" => $row['sense_time'], "stype" => urlencode($row['sense_type']));
        if($icount==1){
          $result .= json_encode($single_record);
        }else{
          $result .= "," .json_encode($single_record);
        }
        $icount++;
      }
      $result.="]";
      $arr = array("code" => "1", "count" => $stmt->rowCount(), "record" => $result);
      echo urldecode(json_encode($arr));
    }catch(Exception $e){
      $arr = array("code" => "0" , "result" => urlencode("資料庫錯誤"));
      echo urldecode(json_encode($arr));
    }
  }
?>