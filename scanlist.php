<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<title>掃瞄資料維護</title>
<script language="javascript" src='general.js'></script>
</head>
<body style="margin-top:1px">
<?php include('banner.php');?>
  <div id="dv_Content">
  <?php

    if(!isset($_SESSION['acc'])||!isset($_SESSION['name'])){
      echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
    }else{
      include('db_connect_user.php');
      $total = "SELECT * FROM `update_data` ORDER BY `update_time` DESC";
      $stmt = $conn->query($total);
      $per = 10;
      $dataCount = $stmt->rowCount();
      $totalpages = ceil($dataCount / $per);

      if(isset($_GET['page']) && $_GET['page'] <= $totalpages) {
        $this_page = $_GET['page'];
      } else {
        $this_page = 1;
      }
      $sql = "SELECT * FROM `update_data` ORDER BY `update_time` DESC limit ". ($this_page-1)*$per. "," .$per;
      $stmt = $conn->query($sql);

      echo "<table class='table table-striped table-bordered table-rwd'>";
      echo "<colgroup><col span='2' style='width:20%;'/><col span='1' style='width:10%;'/><col span='1' style='width:15%;'/><col /></colgroup>";
      echo "<tr><th>E-TAG</th><th>車牌號碼</th><th style='text-align:center;'>管理操作</th><th style='text-align:center;'>最後更新時間</th>";
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $cno = $row['car_number'];
        echo "<tr class='tr-only-hide'>";
        echo "<td><a href='scan_data.php?cno=$cno'>".$row['car_etag_id']."</a></td>";
        echo "<td><a href='scan_data.php?cno=$cno'>".$row['car_number']."</a></td>";
        echo "<td style='text-align:center;'><a href='scan_modify.php?cno=$cno'> <span class='glyphicon glyphicon-pencil'></span></a>  |  <a href='scan_delete_sql.php?cno=$cno'> <span class='glyphicon glyphicon-trash'></span></a>  |  <a href='park_license.php?cno=" . $row['car_number'] . "'>期限控管</a></td>";
        
        echo "<td style='text-align:center;'>".$row['update_time']."</td></tr>";
      }
      echo "<tr><td colspan='4' align='center'>";
      for($iCount=0 ; $iCount<$totalpages ; $iCount++) {
        if(($iCount+1) == $this_page) {
          echo "<a href='?page=" . ($iCount+1) . "' class='btn btn-primary btn-xs'> ". ($iCount+1) ." </a>";
        } else {
          echo "<a href='?page=" . ($iCount+1) . "' class='btn btn-default btn-xs'> ". ($iCount+1) ." </a>";
        }
      }
      echo "</td></tr></table>";
    }
    $conn=null;
  ?>
  </div>
   
      
</body>

</html>