<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" src='general.js'></script>
<?php
  if(!isset($_POST['etitle'])||!isset($_POST['econtent'])||!isset($_POST['eauthor'])) {
    echo "<script type='text/javascript'>URL_Trans('傳入資料錯誤!','eventlist.php');</script>";
  } else {
    date_default_timezone_set('Asia/Taipei');
    include('db_connect_user.php');
    $title = $_POST['etitle'];
    $content = $_POST['econtent'];
    $author = $_POST['eauthor'];
    $datenow = date ("Y-m-d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')));

    $sql = "INSERT INTO `events` (`eventId`, `title`, `content`, `author`, `lastmodify`) VALUES (NULL, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$title);
    $stmt->bindParam(2,$content);
    $stmt->bindParam(3,$author);
    $stmt->bindParam(4,$datenow);
    $stmt->execute();
    
    if($stmt->rowCount()==1){
      echo "<script type='text/javascript'>URL_Trans('資料已成功新增','eventlist.php');</script>";
    }else{
      echo "<script type='text/javascript'>URL_Trans('資料新增失敗','eventlist.php');</script>";
    }
    $conn = null;
  }
?>