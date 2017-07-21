<?php
include("db_connect_user.php");
try{
  $sql= "SELECT * FROM `park_type` INNER JOIN (SELECT `park_id`, COUNT(*) as surplus FROM `park_inside` GROUP BY `park_id`) AS View1 ON `park_type`.`park_id` = View1.`park_id`";
  $stmt = $conn->query($sql);
  $stmt->execute();
  $vResult = [];
  $iCount = 0;
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $vResult[$iCount] = [];
    $vResult[$iCount]['parkname'] = $row['park_name'];
    $vResult[$iCount]['amount'] = $row['park_count'];
    $vResult[$iCount]['surplus'] = $row['park_count']-$row['surplus'];
    $iCount++;
  }
  $arr = array("code" => "1", "count" => $stmt->rowCount(), "result" => $vResult);
  echo json_encode($arr);
}catch(Exception $e){
  $arr = array("code" => "0" , "result" => urlencode("¸ê®Æ®w¿ù»~"));
  echo urldecode(json_encode($arr));
}
?>
