<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<title>停車場目前狀態</title>
<script language="javascript" src="general.js"></script>
<script type="Text/JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script language="javascript" src="./js/parking_query.js"></script>
</head>
<body>
  <?php include("banner.php");?>
  <div id="dv_Content">
  <?php
    if(!isset($_SESSION["acc"])||!isset($_SESSION["name"])){
      echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
    }else{
      include("db_connect_user.php");
      $sql = "SELECT * FROM `park_type`";
      $stmt = $conn->query($sql);
      $stmt->execute();

      echo "<table class='table table-striped table-bordered table-rwd'>";
      echo "<tr class='tr-only-hide'><th>停車場</th><th>可容納車輛數</th><th>剩餘車位</th></tr>";
      $iCount = 0;
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
        $pid = $row['park_id'];
        echo "<td><a href='parking_single_query.php?pid=$pid'>".$row['park_name']."</a></td>";
        echo "<td class='.count'>".$row['park_count']."</td>";
        $park_count = $row['park_count'];
        echo "<script>get_surplus($pid, $iCount, $park_count);</script>";
        echo "<td class='surplus'></td>";
        echo "</tr>";
        $iCount++;
      }
      echo "<tr><td colspan='3'><input type='button' class='btn btn-primary' value='上一頁' onClick='javascript:history.back()'/></td></tr>";
    }
    $conn=null;
  ?>
  </div>
</body>
</html>