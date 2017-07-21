<?php session_start(); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" src='general.js'></script>
</head>
<body>
<?php
include('db_connect_user.php');

  if((!isset($_POST['acc'])||!isset($_POST['pwd']))){
    if((!isset($_SESSION['check_word'])) || (!isset($_POST['checkword']))){
      echo "未取得帳號密碼!";
      header("Refresh:1;url=login.html");
    }
  } else {
    $acc = $_POST['acc'];
    $pwd = $_POST['pwd'];

    $sql = "SELECT * FROM `admin_data` WHERE `admin_account` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$acc);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount()==1) {
      if($row['admin_pwd']==$pwd &&($_SESSION['check_word'] == $_POST['checkword'])) {
        $_SESSION['check_word'] = '';
        header('content-Type: text/html; charset=utf-8');
        if($row['admin_level']!='4') {
          $_SESSION['acc'] = $acc;
          $_SESSION['name'] = $row['admin_name'];
          $_SESSION['level'] = $row['admin_level'];
          echo "<script type='text/javascript'>URL_Trans('".$row['admin_name'].",歡迎登入!','index.php');</script>";
          $conn = null;
        } else {
          $conn = null;
          $aname = $row['admin_name'];
          echo "<script type='text/javascript'>URL_Trans('$aname 很抱歉!您已被停權!','login.html');</script>"; 
        }
        $conn = null;
      } else {
        echo "<script type='text/javascript'>URL_Trans('密碼或驗證碼輸入錯誤','login.html');</script>"; 
        $conn = null;
      }
    } else {
      echo "<script type='text/javascript'>URL_Trans('無此帳號!','login.html');</script>"; 
      $conn = null;
    }
  }
?>
</body>
</html>
