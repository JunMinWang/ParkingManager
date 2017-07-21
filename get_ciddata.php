<?
  include('db_connect_user.php');
  $cid = $_GET['cid'];
  $sql = 'SELECT * FROM `parkingprofile` WHERE `uID` = ?';
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $cid);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if($stmt->rowCount()==1){
    $arr = array('code' => '1' , 'result' => array('cname' => $row['uName']));
    echo json_encode($arr);
  } else {
    $arr = array('code' => '0' );
    echo json_encode($arr);
  }
?>