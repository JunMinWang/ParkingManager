<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" src='general.js'></script>
<?php
  if(!isset($_POST['count'])||!isset($_POST['name'])||!isset($_POST['address'])){
    echo "<script type='text/javascript'>URL_Trans('傳入資料錯誤!','manager_data.php');</script>";
  }else{
    include('db_connect_user.php');
    $name = $_POST['name'];
    $count = $_POST['count'];
    $address = $_POST['address'];

    $sql = "INSERT INTO `park_type` (`park_id`, `park_name`, `park_count`, `park_address`) VALUES (NULL, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$name);
    $stmt->bindParam(2,$count);
    $stmt->bindParam(3,$address);
    $stmt->execute();
    
    if($stmt->rowCount()==1){
      echo "<script type='text/javascript'>URL_Trans('資料已成功新增','park_place.php');</script>";
    }else{
      echo "<script type='text/javascript'>URL_Trans('資料新增失敗','park_place.php');</script>";
    }
    $conn = null;
  }
?>