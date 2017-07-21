<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>進出紀錄模擬</title>
<link rel="stylesheet" type="text/css" href="css/general.css" />
<script language="javascript" src="general.js"></script>
<script language="javascript" src="./js/record_insert.js"></script>
</head>
<body>
<?php include("banner.php");?>
  <div id="dv_Content">
    <form name="form1" method="post" action="record_insert_sql.php">
    <?php
      include("db_connect_user.php");
      $sql = "SELECT * FROM `park_type`";
      $stmt = $conn->query($sql);
    ?>
<table class="table table-striped table-bordered table-rwd">
        <colgroup>
          <col style="width:30%;"/>
          <col style="width:40%;"/>
          <col style="width:30%;"/>
        </colgroup>
        <tr>
          <th>車牌號碼</th>
          <td>
            <input id="cno" type="text" name="cno" onKeyUp="eKeyDown()"/>
          </td>
        </tr>
        <tr>
          <th>停車場</th>
          <td>
            <select name="parkid">
              <?php
              foreach($stmt->fetchAll() as $row){
                echo "<option value='$row[0]'>$row[1]</option>";
              }
              $conn->null;
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <th>進/出</th>
          <td>
            <select name="io">
              <option value="0">進場</option>
              <option value="1">離場</option>
            </select>
          </td>
        </tr>
        <tr>
          <th>感應時間</th>
          <td>
            <input type="datetime-local" id="stime" name="stime"/>
            <input type="button" class="btn btn-primary" id="getnow" value="取得現在時間"/>
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="submit" name="submit" class="btn btn-primary" id="submit" value="新增" disabled="true"/>
          </td>
        </tr>
      </table>
    </form>
  </div>      
</body>
</html>