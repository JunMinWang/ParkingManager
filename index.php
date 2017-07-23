<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<title>首頁 GitTest2</title>
<script language="javascript" src='general.js'></script>
</head>
<body>
<?php include('banner.php');?>
  <div id="dv_Content">
  <?php
    if(!isset($_SESSION['acc'])||!isset($_SESSION['name'])){
      echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
    } else {
      echo "<div class='container'>";
      include('db_connect_user.php');
      $sql = "SELECT * FROM `events`";
      $stmt = $conn->query($sql);
      $events = $stmt->fetchAll();
      
      foreach($events as $row) {
        echo "<section class='panel panel-default'>";
        echo "<article class='panel-heading'>" . $row['title'] . "</article>";
        echo "<article class='panel-body'>" . $row['content'];
        echo "<small class='r pull-right'>發布者:" . $row['author'] . " 最後修改時間:" . $row['lastmodify'] . "</small>";
        echo "</article>";
        echo "</section>";
      }
      echo "</div>";
    }
  ?>
  </div>
</body>
</html>