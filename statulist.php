<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<title>停車證狀態設定</title>
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
      $sql = "SELECT * FROM `rstatu`";
      $stmt = $conn->query($sql);

      echo "<table class='table table-striped table-bordered table-rwd'>";
      echo "<colgroup><col span='2' style='width:25%;'/><col span='1' style='width:30%;'/><col /></colgroup>";

      echo "<tr class='tr-only-hide'><th>租賃代碼</th><th>狀態類型</th><th>備註</th><th>管理操作</th>";
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $cno = $row['rStatuID'];
        echo "<tr>";
        echo "<td>".$row['rStatuID']."</a></td>";
        echo "<td>".$row['rStatuName']."</a></td>";
        echo "<td>".$row['rStatuMemo']."</a></td>";
        echo "<td><a href='statu_modify.php?cno=$cno'><span class='glyphicon glyphicon-pencil'></span></a> | <a href='statu_delete_sql.php?cno=$cno'><span class='glyphicon glyphicon-trash'></a></td>";
      }
      echo "</table>";
    }
    $conn=null;
  ?>
  </div>
</body>
</html>