<?
  include('db_connect_user.php');
  $rname = $_GET['rname'];
  $sql = 'SELECT * FROM `rental_type` WHERE `rTypeName` = ?';
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $rname);
  $stmt->execute();
  
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $rtypename = $row['rTypeName'];
  $rmonth= $row['rMonths'];
  $rcost = $row['rCost'];

  $arr = array("rname" => $rtypename, "rmonth" => $rmonth, "rcost" => $rcost);
  echo json_encode($arr);
?>