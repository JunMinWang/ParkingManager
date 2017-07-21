<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<title>停車證種類設定</title>
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
      $sql = "SELECT * FROM `rental_type`";
      $stmt = $conn->query($sql);

      echo "<table class='table table-striped table-bordered table-rwd'>";
      echo "<colgroup><col span='2' style='width:25%;'/><col span='1' style='width:30%;'/><col /></colgroup>";

      echo "<tr class='tr-only-hide'><th>租賃代碼</th><th>租賃期間</th><th>月數</th><th style='text-align:center;'>金額</th><th style='text-align:center;'>管理操作</th>";
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $cno = $row['rTypeID'];
        echo "<tr>";
        echo "<td>".$row['rTypeID']."</a></td>";
        echo "<td>".$row['rTypeName']."</a></td>";
        echo "<td>".$row['rMonths']."</a></td>";
        echo "<td style='text-align:center;'>".$row['rCost']."</a></td>";
        echo "<td style='text-align:center;'><a href='type_modify.php?cno=$cno'><span class='glyphicon glyphicon-pencil'></span></a>  |  <a href='type_delete_sql.php?cno=$cno'><span class='glyphicon glyphicon-trash'></a></td>";
      }
      echo "</table>";
    }
    $conn=null;
  ?>
  </div>
</body>
</html>