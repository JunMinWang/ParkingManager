<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<title>停車場目前狀態</title>
<script language="javascript" src="general.js"></script>
</head>
<body>
<?php include("banner.php");?>
  <div id="dv_Content">
  <?php
    if(!isset($_SESSION["acc"])||!isset($_SESSION["name"])){
      echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
    }else{
      if(!isset($_GET['pid'])){
        echo "<script type='text/javascript'>URL_Trans('傳入資料錯誤!','parking_query.php');</script>";
      }else{
        include("db_connect_user.php");
        $pid = $_GET['pid'];
        $sql = "SELECT * FROM (SELECT `park_inside`.*,`park_type`.`park_name` FROM `park_inside`,`park_type` WHERE `park_inside`.`park_id` = `park_type`.`park_id`) AS Q1 WHERE Q1.`park_id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$pid);
        $stmt->execute();

        echo "<table class='table table-striped table-bordered table-rwd'>";
        echo "<tr><th colspan='2'>停車進出紀錄</th></tr>";
        echo "<tr><th>車牌號碼</th><th>感應時間</th></tr>";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          echo "<tr>";
          echo "<td>".$row['car_number']."</td>";
          echo "<td>".$row['sense_time']."</td>";
          echo "</tr>";
        }
        echo "<tr><td colspan='2'><input type='button' class='btn btn-primary' value='上一頁' onClick='javascript:history.back()'/></td></tr>";
      }
    }
    $conn=null;
  ?>
  </div>
</body>
</html>