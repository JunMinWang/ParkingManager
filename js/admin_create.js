function PWD_check() {
  var pwd1 = $('#pwd1').val();
  var pwd2 = $('#pwd2').val();
  var statu = $('#pwd_statu');
  var btn_submit = $('#submit');
  if(pwd1.localeCompare(pwd2)==0 && pwd1.length>0 && pwd2.length>0){
    statu.text('密碼完成檢查!');
    statu.css({'color': '#0F0'});
    btn_submit.disabled = false;
  }else if(pwd1.localeCompare(pwd2)!=0 && (pwd1.length>0 || pwd2.length>0)){
    statu.text('兩次密碼輸入不同!');
    statu.css({'color': '#F00'});
    btn_submit.disabled = true;
  }else{
    statu.text('請輸入密碼及密碼確認!');
    statu.css({'color': '#000'});
    btn_submit.disabled = true;
  }
}

function get_acc() {
  var acc = $("#acc").val();
  console.log(acc);
  $.ajax({
    url: "get_acc.php",
    data: {acc: acc},
    type: "POST",
    datatype: "json",
    success: function(Jresult){
      var r = JSON.parse(Jresult);
      if(r.result=='1'){
        $("#statu").text("此帳號已被註冊!");
        $("#statu").css({'color': '#F00'});
        $("#acc").val('');
      }else if(r.result=='2'){
        $("#statu").text('此帳號尚未被註冊!');
        $("#statu").css({'color': '#0F0'});
      }else{
        $("#statu").text('');
      }
    }
  }); 
}

function s_adminlevel_change() { /*改變值 更改隱藏欄位*/
  var index = $("#s_adminlevel").prop('selectedIndex');
  $("#levelid").val(index + 1);
}