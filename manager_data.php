<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<title>使用者資料</title>
<script language="javascript" src='general.js'></script>
</head>
<body>
  <?php include('banner.php');?>
  <div id="dv_Content">
  <?php
    if(!isset($_SESSION['acc'])||!isset($_SESSION['name'])){
      echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
    }else{
      if($_SESSION['level']=='1') {
        include('db_connect_user.php');
        $sql = "SELECT * FROM `admin_type` INNER JOIN `admin_data` ON `admin_data`.`admin_level` = `admin_type`.`admin_level`";
        $stmt = $conn->query($sql);

        echo "<table class='table table-striped table-bordered table-rwd'>";
        echo "<tr class='tr-only-hide'><th>姓名</th><th>帳號</th><th>權限</th><th>管理操作</th>";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          echo "<tr>";
          echo "<td>".$row['admin_name']."</td>";
          echo "<td>".$row['admin_account']."</td>";
          $acc = $row['admin_account'];
          echo "<td>".$row['admin_levelname']."</td>";
          echo "<td><a href='admin_modify.php?acc=$acc'><span class='glyphicon glyphicon-pencil'></span></a> | <a href='admin_delete_sql.php?acc=$acc'><span class='glyphicon glyphicon-trash'></span></a></td></tr>";
        }
        echo "</table>";  
      } else {
        echo "<script type='text/javascript'>URL_Trans('權限不足!','index.php');</script>";
      }
    }
    $conn=null;
  ?>
  </div>
</body>
</html>