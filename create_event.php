<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<title>新增事件</title>
<script language="javascript" src='general.js'></script>
</head>
<body>
<?php include('banner.php');?>
  <div class="container">
    <form method="POST" action="create_event_sql.php">
      <table class='table table-striped table-bordered table-rwd'>
        <colgroup>
          <col style="width: 30%" />
          <col />
        </colgroup>
        <tr>
          <th>
            標題
          </th>
          <td>
            <input class="form-control" type="text" name="etitle" placeholder="請輸入標題" />
          </td>
        </tr>
        <tr>
          <th>
            內容
          </th>
          <td>
            <textarea class="form-control" type="text" name="econtent" placeholder="請輸入內容"></textarea>
          </td>
        </tr>
        <tr>
          <th>
            發佈者
          </th>
          <td>
            <input class="form-control" type="text" name="eauthor" value=<?php echo '"'.$_SESSION['name'].'"'; ?> readonly />
          </td>
        </tr>
        <tr>
          <td colspan="2"><input class="btn btn-primary" type="submit" value="新增事件" /></td>
        </tr>
      </table>
    </form>
  </div>
</body>
</html>