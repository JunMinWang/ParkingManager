<!DOCTYPE html>
<?php session_start();?>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="./css/general.css">
<script language="javascript" type="text/javascript" src="general.js"></script>
<script language="javascript" type="text/javascript" src="./js/Jquery.js"></script>
<script language="javascript" type="text/javascript" src="./js/park_license.js"></script>
<title>停車證分派</title>
</head>
<body onLoad="eLoad();">
  <?php include("banner.php");?>
  <div id="dv_Content">
    <form name="form1" method="POST" action="park_license_sql.php" onSubmit="e.preventDefault()">
      <table class="table table-striped table-bordered table-rwd">
        <colgroup>
          <col style="width:30%;"/>
          <col style=""/>
          <col style="width:150px;"/>
        </colgroup>
        <tr>
          <th>車牌號碼</th>
          <td>
            <input id="cno" name="cno" type="text" onKeyUp="eCheckLength(this.id);" value=
            <?php
              if(isset($_GET['cno'])){
                echo '"'.trim($_GET['cno']).'"';
              } else {
                echo '""';
              }
            ?> />
          </td>
        <div class="alert alert-danger" role="alert"><span id="msg_cno" class="fw"></span><span id="msg_cid" class="fw"></span></div>
        </tr>
        <tr>
          <th>車主工號</th>
          <td>
            <input id="uid" name="uid" type="text" onKeyUp="eCheckLength(this.id);" readonly />
          </td>
        </tr>
        <tr>
          <th>車主姓名</th>
          <td>
            <input id="cname" name="cname" type="text" readonly />
          </td>
        </tr>        
        <tr>
          <th>停車證種類</th>
          <td>
            <input id="rtype" name="rtype" type="text" readonly />
          </td>
        </tr>
        <tr>
          <th>停車證狀態</th>
          <td>
            <input id="rstate" name="rstate" type="text" readonly />
          </td>
        </tr>
        <tr>
          <th>有效日期起</th>
          <td>
            <input id="rstart" name="rstart" type="text" readonly />
          </td>
        </tr>
        <tr>
          <th>有效日期迄</th>
          <td>
            <input id="rend" name="rend" type="text" readonly />
          </td>
        </tr>
        <tr class='hide'>
          <th>是否初次申請</th>
          <td>
            <input id="first" name="first" type="text" readonly />
          </td>
        </tr>
        <tr class='hide'>
          <th>是否初次申請</th>
          <td>
            <input id="car_number" name="car_number" type="text" readonly />
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input id="btn_search" type="button" class="btn btn-primary" value="查詢" />
            <input id="btn_apply" type="button" class="btn btn-primary" value="申請 / 展延" />
            <input id="btn_research" type="button" class="btn btn-primary" value="重新查詢" />
          </td>
        </tr>
      </table>
      <table id="detail" class="table table-striped table-bordered table-rwd">
        <colgroup>
          <col style="width:30%;"/>
          <col />
        </colgroup>
        <tr>
          <th>申請停車證種類</th>
          <td>
            <select id="applytype" value="請選擇停車證種類" onChange="changeRentalType()">
              <option selected value="">請選擇</option>
            </select>
          </td>
        </tr>
        <tr>
          <th>申請日期起</th>
          <td>
            <input id="applystart" name="applystart" type="date" onChange="changeRentalType()" />
          </td>
        </tr>
        <tr>
          <th>申請日期迄</th>
          <td>
            <input id="applyend" name="applyend" type="date" />
          </td>
        </tr>
        <tr>
          <th>金額</th>
          <td>
            <input id="applycost" name="applycost" type="text" readonly />
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" class="btn btn-primary" value="確定"/>
          </td>
        </tr>
      </table>
    </form>
  </div>
</body>
</html>