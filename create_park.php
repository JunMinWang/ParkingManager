<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/general.css">
<script language="javascript" src='general.js'></script>
<script language="javascript" src='admin_create.js'></script>
<script language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script language="javascript" src='ajax.js'></script>
<title>新增停車場</title>
</head>
<body>
  <?php include('banner.php');?>
  <div id="dv_Content">
    <form method='POST' action='create_park_sql.php'>
      <table class='table table-striped table-bordered table-rwd'>
        <colgroup>
          <col style='width:40%;'/>
          <col style='width:60%;'/>
        </colgroup>
        <tr>
          <th>
            停車場名稱
          </th>
          <td class='bd0'>
            <input class='form-control' type='text' name='name' />
          </td>
        </tr>
        <tr>
          <th>
            停車格數量
          </th>
          <td class='bd0'>
            <input class='form-control' type='text' name='count'/>
          </td>
        </tr>
        <tr>
          <th>
            停車場地址
          </th>
          <td class='bd0'>
            <input class='form-control' type='text' name='address'/>
          </td>
        </tr>
        <tr>
          <td colspan='2' align='center'>
            <input type='submit' name='submit' id='submit' class='btn btn-primary' value='新增'/>
          </td>
        </tr>
      </table>
    </form>
</body>
</html>