<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" src='general.js'></script>
<?php
  if(!isset($_POST['acc'])||!isset($_POST['name'])||!isset($_POST['pwd1'])||!isset($_POST['level'])){
    echo "<script type='text/javascript'>URL_Trans('傳入資料錯誤!','manager_data.php');</script>";
  }else{
    include('db_connect_user.php');
    $acc = $_POST['acc'];
    $name = $_POST['name'];
    $pwd = $_POST['pwd1'];
    $level = $_POST['level'];
    $sql = "INSERT INTO `admin_data` (`admin_name`, `admin_account`, `admin_pwd`, `admin_level`) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$name);
    $stmt->bindParam(2,$acc);
    $stmt->bindParam(3,$pwd);
    $stmt->bindParam(4,$level);
    $stmt->execute();
    
    if($stmt->rowCount()==1){
      echo "<script type='text/javascript'>URL_Trans('資料已成功新增','manager_data.php');</script>";
    }else{
      echo "<script type='text/javascript'>URL_Trans('資料新增失敗','manager_data.php');</script>";
    }
    $conn = null;
  }
?>