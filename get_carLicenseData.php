<?
  include('db_connect_user.php');
  $cno = $_GET['cno'];
  $sql = 'SELECT * FROM `update_data` INNER JOIN (SELECT * FROM `rental_type` NATURAL JOIN `parkingprofile`) AS `View1` on `update_data`.`car_number` = View1.`uCno` WHERE `uCno` =  ?';
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $cno);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if($stmt->rowCount()==1){
    $arr = array('code' => '1' , 'result' => 
      array('cname' => $row['uName'], 'rtype' => $row['rTypeName'], 'uid' => $row['uID'], 'rstart' => $row['rStartDate'], 'rend' => $row['rEndDate']));
    echo json_encode($arr);
  } else {
    $arr = array('code' => '0' );
    echo json_encode($arr);
  }
?>