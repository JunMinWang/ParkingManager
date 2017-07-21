<?php session_start();?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <script language="javascript" src='general.js'></script>
    <title>停車場管理</title>
  </head>
  <body>
    <?php include('banner.php');?>
    <div id="dv_Content">
    <form name='form1' method='post' action='park_place_modify_sql.php'>
      <?php
        if(!isset($_SESSION['acc'])||!isset($_SESSION['name'])){
          echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
        }else{
          if(!isset($_GET['cno'])){
            echo "<script type='text/javascript'>URL_Trans('傳入資料錯誤!','index.php');</script>";
          }else{
            include('db_connect_user.php');
            $cno = $_GET['cno'];
            $sql = "SELECT * FROM `park_type` where `park_id` = :cno";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':cno',$cno);
            $stmt->execute();

            echo "<table class='table table-striped table-bordered table-rwd'>";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
              echo "<tr><th>停車場代碼</th><td><input type='text' name='parkid' class='form-control' value='" . $row['park_id'] . "' readonly /></td>";
              echo "<tr><th>停車場名稱</th><td><input type='text' name='parkname' class='form-control' value='" . $row['park_name'] . "'/></td>";
              echo "<tr><th>停車場位置</th><td><input type='text' name='parkaddress' class='form-control' value='" . $row['park_address'] . "'/></td>";
              echo "<tr><th>總車位數量</th><td><input type='text' name='parkcount' class='form-control' value='" . $row['park_count'] . "'/><input type='hidden' name='pid' value='" . $row['park_id'] . "'/></td>";
              echo "<tr><th>是否開放外車</th><td><input type='checkbox' name='allowforeign' ";
                if($row['allow_foreign'] == '1') {
                  echo "checked";
                }
              echo "/></td>";
              echo "<tr><th>開放時段</th><td><input type='text' name='parkopentime' class='form-control' value='" . $row['park_opentime'] . "'/></td>";
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