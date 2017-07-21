<?php
  include('db_connect_user.php');
  $sql = "SELECT * FROM `park_type`";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $iCount=0;
  
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $vResult[$iCount]['parkname'] = urlencode($row['park_name']);
    $vResult[$iCount]['parkcount'] = $row['park_count'];
    $vResult[$iCount]['parkaddress'] = urlencode($row['park_address']);
    $vResult[$iCount]['parkopentime'] = urlencode($row['park_opentime']);
    $vResult[$iCount]['parkstatus'] = $row['park_status'];
    $vResult[$iCount]['allowforeign'] = $row['allow_foreign'];
    $iCount++;
  }
  $arr = array("result" => $vResult);
  echo urldecode(json_encode($arr));
?>