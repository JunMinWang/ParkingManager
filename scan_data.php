<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<title>掃瞄資料維護</title>
<script language="javascript" src='general.js'></script>
</head>
<body>
<?php include('banner.php');?>
  <div id="dv_Content">
  <?php
    if(!isset($_SESSION['acc'])||!isset($_SESSION['name'])){
      echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
    }else{
      if(!isset($_GET['cno'])){
        echo "<script type='text/javascript'>URL_Trans('系統未帶入值','scanlist.php');</script>";
      }else{
        include('db_connect_user.php');
        $cno = $_GET['cno'];
        $sql = "SELECT * FROM `ParkingProfile` WHERE `uCno` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $cno);
        $stmt->execute();

        if($stmt->rowCount()==1){
          echo "<table class='table table-striped table-bordered table-rwd'>";
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><th>車牌號碼</th><td><input type='text' value='".$row['uCno']."' readonly /></td></tr>";
            echo "<tr><th>車主姓名</th><td><input type='text' value='".$row['uName']."' readonly /></td></tr>";
            echo "<tr><th>隸屬部門</th><td><input type='text' value='".$row['uDept']."' readonly /></td></tr>";
            echo "<tr><th>連絡電話</th><td><input type='text' value='".$row['uPhone']."' readonly /></td></tr>";
            echo "<tr><th>有效日期</th><td><input type='text' value='".$row['rStartDate']."~".$row['rEndDate']."' readonly /></td></tr>";
            echo "<tr><td><input type='button' class='btn btn-primary' value='回上頁' onclick='javascript:history.back()'/></button></td>";
          }
          echo "</table>";
        }else{
          echo "<script type='text/javascript'>URL_Trans('非註冊車輛!資料庫中查無車牌號碼:".$cno."的資料!','scanlist.php');</script>";
        }
      }
    }
    $conn=null;
  ?>
  </div>
</body>
</html>