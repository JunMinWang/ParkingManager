<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<title>停車場管理</title>
<script language="javascript" src='general.js'></script>
</head>
<body>
  <?php include('banner.php');?>
  <div id="dv_Content">
  <?php
    if(!isset($_SESSION['acc'])||!isset($_SESSION['name'])){
      echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
    }else{
      include('db_connect_user.php');
      $sql = "SELECT * FROM `park_type`";
      $stmt = $conn->query($sql);

      echo "<table class='table table-striped table-bordered table-rwd'>";
      echo "<colgroup><col span='2' style='width:25%;'/><col span='1' style='width:30%;'/><col span='1' style='width:10%;'/><col /></colgroup>";

      echo "<tr class='tr-only-hide'><th>停車場代碼</th><th>停車場名稱</th><th>總車位數量</th><th style='text-align:center;'>管理操作</th>";
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $cno = $row['park_id'];
        echo "<tr>";
        echo "<td>".$row['park_id']."</a></td>";
        echo "<td>".$row['park_name']."</a></td>";
        echo "<td>".$row['park_count']."</a></td>";
        echo "<td style='text-align:center;'><a href='park_place_modify.php?cno=$cno'><span class='glyphicon glyphicon-pencil'></a>  |  <a href='park_place_delete_sql.php?cno=$cno'><span class='glyphicon glyphicon-trash'></a></td>";
      }
      echo "<tr><td colspan='4'>";
      echo "<a href='create_park.php' class='btn btn-primary'>新增停車場</a>";
      echo "</td></tr>";
      echo "</table>";
    }
    $conn=null;
   ?>
  </div>
</body>
</html>