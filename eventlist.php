<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<title>停車場事件管理</title>
<script language="javascript" src='general.js'></script>
</head>
<body>
<?php include('banner.php');?>
  <div class="container">
  <?php
    if(!isset($_SESSION['acc'])||!isset($_SESSION['name'])){
      echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
    }else{
      include('db_connect_user.php');
      $sql = "SELECT * FROM `events`";
      $stmt = $conn->query($sql);

      echo "<table class='table table-striped table-bordered table-rwd'>";
      echo "<colgroup><col span='2' /><col style='width:7%;'/><col style='width:20%;'/><col style='width:7%;'/></colgroup>";

      echo "<tr class='tr-only-hide'><th>標題</th><th>內容</th><th>發布者</th><th>最後修改時間</th><th style='text-align:center;'>操作</th>";
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $eid = $row['eventId'];
        echo "<tr>";
        echo "<td>".$row['title']."</a></td>";
        echo "<td>".$row['content']."</a></td>";
        echo "<td>".$row['author']."</a></td>";
        echo "<td>".$row['lastmodify']."</a></td>";
        echo "<td style='text-align:center;'><a href='event_modify.php?eid=$eid'><span class='glyphicon glyphicon-pencil'></span></a>  |  <a href='event_delete_sql.php?eid=$eid'><span class='glyphicon glyphicon-trash'></a></td>";
      }
      echo "<tr><td colspan='5'>";
        echo "<a href='create_event.php' class='btn btn-primary'>新增事件</a>";
      echo "</td></tr>";
      echo "</table>";
    }
    $conn=null;
  ?>
  </div>
</body>
</html>