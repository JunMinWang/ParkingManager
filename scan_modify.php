<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<script language="javascript" src='general.js'></script>
<title>資料掃瞄維護</title>
</head>
<body>
  <?php include('banner.php');?>
  <div id="dv_Content">
    <form name='form1' method='post' action='scan_modify_sql.php'>
    <?php
      if(!isset($_SESSION['acc'])||!isset($_SESSION['name'])){
        echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
      }else{
        if(!isset($_GET['cno'])){
          echo "<script type='text/javascript'>URL_Trans('傳入資料錯誤','scanlist.php');</script>";
        }else{
          include('db_connect_user.php');
          $cno = $_GET['cno'];
          $sql = "SELECT * FROM `update_data` where `car_number` = :cno";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':cno',$cno);
          $stmt->execute();
            
          echo "<table class='table table-striped table-bordered table-rwd'>";
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><th>E-Tag</th><td><input type='text' name='etagid' value='" . $row['car_etag_id'] . "'/></td>";
            echo "<tr><th>車牌號碼</th><td><input type='text' name='cno' value='" . $row['car_number'] . "'/><input type='hidden' name='ocno' value='" . $row['car_number'] . "'/></td>"; 
            echo "<tr><td colspan='2'><input type='submit' class='btn btn-primary' value='確定修改'/>  <input type='button' class='btn btn-primary' value='回上頁' onclick='javascript:history.back()'/></button></td>";
          }
          echo "</table>";
        }
        
      }        
      $conn = null;
    ?>
    </form>
  </div>    
</body>
</html>