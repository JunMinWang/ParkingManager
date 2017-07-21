<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" type="image/png" href="./img/favicon.png"/>
<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body style="padding-bottom:-100px;">
  <div class="page-header">
    <a href="index.php"><img src="img/title.png" style="display:block; margin:auto"/ ></a>
  </div>
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">車籍資料 <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="scanlist.php">掃描資料維護</a>
              </li>
              <li>
                <a href="profile.php">車籍資料</a>
              </li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">停車場專區 <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="recordlist.php">停車場進出紀錄查詢</a>
              </li>
              <li>
                <a href="record_insert.php">進出紀錄模擬</a>
              </li>
              <li>
                <a href="parking_query.php">停車場目前狀態</a>
              </li>
              <li>
                <a href="park_license.php">停車期限管理</a>
              </li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">參數管理 <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="typelist.php">停車證種類設定</a>
              </li>
              <li>
                <a href="park_place.php">停車場管理</a>
              </li>
              <li>
                <a href="eventlist.php">佈告欄管理</a>
              </li>
            </ul>
          </li>
        </ul>
        <a class="navbar-brand" href="#">
          <span class='glyphicon glyphicon-flag'></span><small>目前位置：<script>document.write(document.title);</script></small>
        </a>
        

        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="logout.php">登出 <span class="glyphicon glyphicon-log-out"></span></a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">管理使用者 <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="manager_data.php">使用者資料</a>
              </li>
              <li>
                <a href="admin_create.php">新增使用者</a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="#"><?php echo "你好，".$_SESSION['acc'];?></a>
          </li>
        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->      
       
  </nav>
  

  
   <!-- 置底
                <nav class="navbar navbar-default navbar-fixed-bottom"  role="navigation">
            <div style=" margin:0 auto;line-height: 50px;text-align: center;">Copyright © 2017 Quick Park Team. All rights reserved</div>
        </nav>-->

</body>
</html>