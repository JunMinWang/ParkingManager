<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" src='general.js'></script>
<?php session_start(); ?>
<html>
<head>
<meta charset="UTF-8" />
</head>
<body>
<?php   
  unset($_SESSION['acc']);
  unset($_SESSION['name']);
  echo "<script type='text/javascript'>URL_Trans('已成功登出!','login.html');</script>"; 
?>
</body>
</html>