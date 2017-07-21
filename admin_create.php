<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<script language="javascript" src='general.js'></script>
<script language="javascript" src='./js/admin_create.js'></script>
<script language="javascript" src="./js/Jquery.js"></script>
<title>新增使用者</title>
</head>
<body>
  <?php include('banner.php');?>
  <div id="dv_Content">
    <?php
    if(!isset($_SESSION['acc'])||!isset($_SESSION['name'])||!isset($_SESSION['level'])){
      echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
    }else{
      if($_SESSION['level']=='1'){
      include('db_connect_user.php');
      $sql_query = "SELECT * FROM `admin_type`";
      $stmt2 = $conn->query($sql_query);
    ?>
    <form method='POST' action='admin_create_sql.php'>
    <table class='table table-striped table-bordered table-rwd'>
      <colgroup>
        <col style='width:30%;'/>
        <col style='width:40%;'/>
        <col style='width:30%;'/>
      </colgroup>
      <tr><th>使用者帳號</th><td class='bd0'><input class='form-control' type='text' name='acc' id='acc' placeholder='帳號一經註冊後就無法做更改' onChange='javascript:get_acc()'/></td><td><span id='statu'></span></td></tr>
      <tr><th>使用者名稱</th><td class='bd0'><input class='form-control' type='text' name='name'/></td><td></td></tr>
      <tr><th>密碼</th><td class='bd0'><input class='form-control' type='password' name='pwd1' id='pwd1' onChange='javascript:PWD_check()'/></td><td id='pwd_statu'></td></tr>
      <tr><th>密碼確認</th><td class='bd0'><input class='form-control' type='password' name='pwd2' id='pwd2' onChange='javascript:PWD_check()'/></td><td></td></tr>
      <tr><th>使用者權限</th><td><select id='s_adminlevel' onchange='javascript:s_adminlevel_change()'>
      <?php foreach($stmt2->fetchAll() as $row2){
        echo "<option value='$row2[0]'>$row2[0] | $row2[1]</option>";}?></select></td><td>
        </td></tr>
      <tr class='hide'><th>權限</th><td class='bd0'><input type='text' name='level' id='levelid' value='' readonly /></td><td></td></tr>
      <tr><td colspan='2' align='center'><input type='submit' name='submit' id='submit' class='btn btn-primary' value='新增'/></td></tr>
    </table></form><?php
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