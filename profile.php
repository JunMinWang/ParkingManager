<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<title>車籍資料</title>
<script language="javascript" src='general.js'></script>
<script language="javascript" src='./js/Jquery.js'></script>
<script language="javascript" src='./js/profile.js'></script>
</head>
<body onLoad="eLoad()">
<?php include('banner.php');?>
  <div id="dv_Content">
  <?php
    date_default_timezone_get();
    $today = date('m/d/Y', time());
    if(!isset($_SESSION['acc'])||!isset($_SESSION['name'])){
      echo "<script type='text/javascript'>URL_Trans('請先登入!','login.html');</script>";
    }else{
      include('db_connect_user.php');
      
      if(!isset($_POST['field'])) {
        $sql = "SELECT * FROM `parkingprofile` INNER JOIN `update_data` WHERE `parkingprofile`.`uCno` = `update_data`.`car_number` ORDER BY `rEndDate` DESC";
        $stmt = $conn->query($sql);
      } else {
        $fieldkey = $_POST['field'];
        switch($fieldkey) {
          case '2':
            $fieldname = 'uName';
            break;
          case '3':
            $fieldname = 'uDept';
            break;
          case '4':
            if(!isset($_POST['status'])) {
              $valid = 'true';
            } else {
              $valid = $_POST['status'];
            }
            $sql = "SELECT * FROM `parkingprofile` INNER JOIN `update_data` WHERE `parkingprofile`.`uCno` = `update_data`.`car_number` ORDER BY `rEndDate` DESC";
            $stmt = $conn->query($sql);
            break;
          case '1':
          default:
            $fieldname = 'uCno';
            break;
        }
        if($fieldkey!=='4') {
          $value =  $_POST['searchvalue'].'%';
          $sql = "SELECT * FROM `parkingprofile` INNER JOIN `update_data` WHERE `parkingprofile`.`uCno` = `update_data`.`car_number` AND `parkingprofile`.`". $fieldname ."` LIKE :value ORDER BY `rEndDate` DESC";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':value', $value);
          $stmt->execute();
        }
      }?>
      <form method="POST" action="profile.php">
        <section class="form-group">
          <select id="field" name="field" onChange="selecthandler()">
            <option value="1">車牌號碼</option>
            <option value="2">車主姓名</option>
            <option value="3">隸屬部門</option>
            <option value="4">狀態</option>
          </select>
          <input id="searchfield" name="searchvalue" />
          <article id="radiofield">
            <input type="radio" name="status" value="true" />有效
            <input type="radio" name="status" value="false" />過期
          </article>
          <button>查詢</button>
        </section>

<?php
      if($stmt->rowCount() == 0) {
        echo '無搜尋結果!';
        return false;
      }
      echo "<table class='table table-striped table-bordered table-rwd'>";
      echo "<tr class='tr-only-hide'><th>E-TAG</th><th>車牌號碼</th><th>車主姓名</th><th>隸屬部門</th><th>電話</th><th>租期</th><th style='text-align:center;'>狀態</th>";

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if(isset($_POST['field'])) {
          if($fieldkey=='4') {
            if($valid == 'true') {
              if(strtotime($row['rEndDate']) < strtotime($today)) {
                continue;
              }
            } else {
              if(strtotime($row['rEndDate']) > strtotime($today)) {
                continue;
              }
            }
          }
        }
        echo "<tr>";
        echo "<td>".$row['car_etag_id']."</td>";
        echo "<td>".$row['uCno']."</td>";
        echo "<td>".$row['uName']."</td>";
        echo "<td>".$row['uDept']."</td>";
        echo "<td>".$row['uPhone']."</td>";
        echo "<td>".$row['rEndDate']."</td>";
        if(strtotime($row['rEndDate']) < strtotime($today)) {
          echo "<td align='center'><font color='red'>過期</td>";
        } else {
          echo "<td align='center'><font color='green'><span class='glyphicon glyphicon-ok'></span></td>";
        }
        echo "</tr>";
      }
      echo "</table>";
      echo "</form>";
      $conn=null;
    }?>
  </div>
</body>
</html>