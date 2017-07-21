<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<script language="javascript" src='general.js'></script>
<script language="javascript" src='ajax.js'></script>
<title>使用者資料</title>
</head>
<body>
  <?php include('banner.php');?>
  <div id="dv_Content">
    <form name='form1' method='post' action='admin_modify_sql.php'>
      <?php
      if(!isset($_SESSION['acc'])||!isset($_SESSION['name'])||!isset($_SESSION['level'])){
        echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
      }else{
        if($_SESSION['level']=='1'){
          if(!isset($_GET['acc'])){
            echo "<script type='text/javascript'>URL_Trans('傳入資料錯誤','manager_data.php');</script>";
          }else{
            include('db_connect_user.php');
            $acc = $_GET['acc'];
            $sql = "SELECT * FROM `admin_type` INNER JOIN `admin_data` ON `admin_data`.`admin_level` = `admin_type`.`admin_level` where `admin_data`.`admin_account` = :acc";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':acc',$acc);
            $stmt->execute();

            $sql_query = "SELECT * FROM `admin_type`";
            $stmt2 = $conn->query($sql_query);

            echo "<table class='table table-striped table-bordered table-rwd'>";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
              echo "<tr><th>使用者帳號</th><td><input type='text' readonly name='acc' value='" . $row['admin_account'] . "'/></td>";
              echo "<tr><th>使用者名稱</th><td><input type='text' name='name' value='" . $row['admin_name'] . "'/></td>";
              $level = $row['admin_level'];
              echo "<tr><th>使用者等級</th><td><select id='s_adminlevel' onchange='javascript:s_adminlevel_change()'>";
              foreach($stmt2->fetchAll() as $row2){
                echo "<option value='$row2[0]'>$row2[0] | $row2[1]</option>";
              }
              echo "</select></td>";
              echo "<tr class='hide'><th>權限編號</th><td><input type='text' name='level' id='levelid' value='' readonly/></td>";                         
              echo "<tr><td colspan='2'><input type='submit' class='btn btn-primary' value='確定修改'/>  <input type='button' class='btn btn-primary' value='回上頁' onClick='javascript:history.back()'/></button></td>";
              echo "<script type='text/javascript'>s_adminlevel_init($level);</script>";
            }
            echo "</table>";
          }
        }else{
          echo "<script type='text/javascript'>URL_Trans('權限不足','manager_data.php');</script>";
        }                   
      }               
      $conn = null;
      ?>
    </form>
  </div>      
</body>
</html>