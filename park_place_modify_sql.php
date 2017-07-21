<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script text="text/javascript" src="general.js"></script>
<?php
  if(!isset($_POST['parkid'])||!isset($_POST['parkname'])||!isset($_POST['parkcount'])||!isset($_POST['pid'])){
    echo "<script type='text/javascript'>URL_Trans('系統未傳值','park_place.php');</script>";
  }else{
    include('db_connect_user.php');
    $park_id = $_POST['parkid'];
    $park_name = $_POST['parkname'];
    $park_count=$_POST['parkcount']; 
    $park_address = $_POST['parkaddress'];
    $park_opentime = $_POST['parkopentime'];
    if(isset($_POST['allowforeign'])) {
      $allow_foreign = true;
    } else {
      $allow_foreign = false;
    }
    $pid=$_POST['pid'];

    $sql = "UPDATE `park_type` SET `park_id` = ?, `park_name` = ?, `park_count` = ?, `park_address` = ?, `park_opentime` = ?, `allow_foreign` = ? WHERE `park_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$park_id);
    $stmt->bindParam(2,$park_name);
    $stmt->bindParam(3,$park_count);
    $stmt->bindParam(4,$park_address);
    $stmt->bindParam(5,$park_opentime);
    $stmt->bindParam(6,$allow_foreign);
    $stmt->bindParam(7,$pid);
    $stmt->execute();

    if($stmt->rowCount()==1){
      echo "<script type='text/javascript'>URL_Trans('資料更新完畢!','park_place.php');</script>";
    }else{
      echo "<script type='text/javascript'>URL_Trans('資料失敗!','park_place.php');</script>";
    }
    $conn = null;
  }
?>