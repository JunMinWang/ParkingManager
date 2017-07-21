<?
  include('db_connect_user.php');
  $sql = 'SELECT * FROM `rental_type`';
  $stmt = $conn->query($sql);
  $stmt->execute();

  $vResult = [];
  $iCount = 0;
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $vResult[$iCount] = [];
    $vResult[$iCount]['rname'] = $row['rTypeName'];
    $iCount++;
  }
  $arr = array("count" => $iCount, "result" => $vResult);
  echo json_encode($arr);
?>