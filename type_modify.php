<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<script language="javascript" src='general.js'></script>
<title>停車證種類設定</title>
</head>
<body>
  <?php include('banner.php');?>
  <div id="dv_Content">
  <form name='form1' method='post' action='type_modify_sql.php'>
    <?php
      if(!isset($_SESSION['acc'])||!isset($_SESSION['name'])){
        echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
      }else{
        if(!isset($_GET['cno'])){
          echo "<script type='text/javascript'>URL_Trans('傳入資料錯誤!','index.php');</script>";
        }else{
          include('db_connect_user.php');
          $cno = $_GET['cno'];
          $sql = "SELECT * FROM `rental_type` where `rTypeID` = :cno";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':cno',$cno);
          $stmt->execute();
            
          echo "<table class='table table-striped table-bordered table-rwd'>";
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><th>租賃代碼</th><td><input type='text' name='typeid' value='" . $row['rTypeID'] . "'/></td>";
            echo "<tr><th>租賃名稱</th><td><input type='text' name='rentalid' value='" . $row['rTypeName'] . "'/></td>";
            echo "<tr><th>租賃月份</th><td><input type='text' name='rmonth' value='" . $row['rMonths'] . "'/></td>";
            echo "<tr><th>金額</th><td><input type='text' name='cost' value='" . $row['rCost'] . "'/><input type='hidden' name='oid' value='" . $row['rTypeID'] . "'/></td>"; 
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