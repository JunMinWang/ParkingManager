<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<title>教職員資料</title>
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
      $sql = "SELECT * FROM `parkingprofile`";
      $stmt = $conn->query($sql);
      echo "<table class='table table-striped table-bordered table-rwd'>";
      echo "<tr class='tr-only-hide'><th>車牌號碼</th><th>車主姓名</th><th>車主工號</th><th>隸屬部門</th><th>電話</th>";
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
        echo "<td>".$row['uCno']."</td>";
        echo "<td>".$row['uName']."</td>";
        echo "<td>".$row['uID']."</td>";
        echo "<td>".$row['uDept']."</td>";
        echo "<td>".$row['uPhone']."</td>";
        echo "</tr>";
      }
      echo "</table>";
      $conn=null;
    }
  ?>
  </div>      
</body>
</html>