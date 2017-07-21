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
      include("db_connect_user.php");
      $sql = "SELECT `record`.*, `park_type`.`park_name` FROM `record`,`park_type` WHERE `record`.`park_id` = `park_type`.`park_id` ORDER BY `record`.`sense_time` DESC";
      $stmt = $conn->query($sql);

      echo "<table class='table table-striped table-bordered table-rwd'>";
      echo "<colgroup><col span='2' style='width:25%;'/><col span='1' style='width:5%;'/><col span='1' style='width:30%;'/><col /></colgroup>";
      echo "<tr class='tr-only-hide'><th>車牌號碼</th><th>停車場</th><th style='text-align:center;'>進/出</th><th style='text-align:center;'>感應時間</th>";
      
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $cno = $row["car_number"];
        echo "<tr>";
        echo "<td><a href='recordquery.php?cno=$cno'>".$row["car_number"]."</a></td>";
        echo "<td><a href='recordquery.php?cno=$cno'>".$row["park_name"]."</a></td>";
        echo "<td style='text-align:center;'><a href='recordquery.php?cno=$cno'>";
        if($row["sense_type"]=="0"){
          echo "進";
        }else if($row["sense_type"]=="1"){
          echo "出";
        }
        echo "</a></td>";
        echo "<td style='text-align:center;'><a href='recordquery.php?cno=$cno'>".$row["sense_time"]."</a></td>";
      }
      echo "</table>";
    }
    $conn=null;
  ?>
  </div>
</body>
</html>