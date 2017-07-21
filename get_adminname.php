<?
  include('db_connect_user.php');
  $level = $_POST['level'];
  $sql = "SELECT * FROM `admin_type` WHERE `admin_level` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $level);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  echo $row['levelname'];
?>