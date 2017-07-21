<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<title>停車場進出紀錄查詢</title>
<script language="javascript" src="general.js"></script>
</head>
<body>
<?php include("banner.php");?>
  <div id="dv_Content">
  <?php
    if(!isset($_SESSION["acc"])||!isset($_SESSION["name"])){
      echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
    }else{
      if(!isset($_GET['cno'])){
        echo "<script type='text/javascript'>URL_Trans('傳入資料錯誤!','recordlist.php');</script>";
      }else{
        include("db_connect_user.php");
        $cno = $_GET['cno'];
        $sql = "SELECT * FROM (SELECT `record`.*, `park_type`.`park_name` FROM `record`,`park_type` WHERE `record`.`park_id` = `park_type`.`park_id`) as Q1 WHERE Q1.`car_number` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$cno);
        $stmt->execute();

        echo "<table class='table table-striped table-bordered table-rwd'>";
        echo "<tr><th colspan='3'>$cno 停車進出紀錄</th></tr>";
        echo "<tr><th>停車場</th><th>進/出</th><th>感應時間</th></tr>";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          echo "<tr>";
          echo "<td>".$row['park_name']."</td>";
          if($row['sense_type']=='0'){
            echo "<td>進場</td>";
          }elseif($row['sense_type']=='1'){
            echo "<td>離場</td>";
          }
          echo "<td>".$row['sense_time']."</td>";
          echo "</tr>";
        }
        echo "<tr><td colspan='3'><input type='button' class='btn btn-primary' value='上一頁' onClick='javascript:history.back()'/></td></tr>";
      }
    }
    $conn=null;
  ?>
  </div>
</body>
</html>