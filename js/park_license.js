var vResult;

function eLoad() {
  eInit();  
  eCheckLength('cno');
}

function eInit() {
  var time = new Date();
  $('#detail').hide();
  $('#msg_cno').textContent='請輸入車號查詢';
  $('#btn_research').prop('disabled',true);
  $('#btn_apply').prop('disabled',true);
  $('#btn_search').prop('disabled',true);
  $('#msg_cno').html('請輸入車號查詢');
  $('#applystart').val(time.getFullYear()+"-"+fillinTwo(time.getMonth()+1)+"-"+fillinTwo(time.getDate()));

  $('#btn_search').click(function(){ /*點擊查詢*/
    getLicenseData();
    $('#btn_search').prop('disabled',true);
    $('#cno').prop('disabled',true);
    $('#btn_research').prop('disabled',false);
    $('#msg_cno').html('');
  });

  $('#btn_apply').click(function() { /*點擊申請/展延*/
    console.log($('#cno').val());
    getciddata();
    $('#btn_apply').prop('disabled',true);
    $('#car_number').val($('#cno').val());
    console.log($('#car_number').val());
  });

  $('#btn_research').click(function() {
    document.location.href='park_license.php';
  });
}

function fillinTwo(iData){ /*時間不足兩位補位*/
  if(iData<10){
    return ('0'+iData);
  }
  return iData;
}

function eCheckLength(type) {
  switch(type) {
    case 'cno':
      var iLen = $('#cno').val().length;
      if((iLen < 7 || iLen >8) && iLen !=0){
        $('#btn_search').prop('disabled',true);
        $('#btn_apply').prop('disabled',true);
        $('#msg_cno').html('車牌號碼錯誤!');
      } else if(iLen == 0){
        $('#msg_cno').html('請輸入車號查詢');
      } else {
        $('#btn_search').prop('disabled',false);
        $('#msg_cno').html('請按查詢鍵');    
      }
      break;
    case 'uid':
      var iLen = $('#uid').val().length;
      if(iLen == 0) {
        $('#msg_cid').html('請輸入申請車主工號');
      } else if(iLen == 10){
        $('#msg_cid').html('請點擊申請');
        $('#btn_apply').prop('disabled',false);
      } else {
        $('#msg_cid').html('工號輸入錯誤');
      }
      break;
  }
  
}

function getLicenseData() {
  var cno = $('#cno').val();
  $.ajax({
    type: "GET",
    url: "get_carLicenseData.php",
    data: {cno: cno},
    datatype: "JSON",
    success: function(Jresult){
      var Jstr = JSON.parse(Jresult);
      if(Jstr.code==='1'){
        $('#cname').val(Jstr.result.cname);
        $('#rtype').val(Jstr.result.rtype);
        $('#rstart').val(Jstr.result.rstart);
        $('#rend').val(Jstr.result.rend);
        $('#rstate').val('待補充');
        $('#uid').val(Jstr.result.uid);
        $('#first').val('F');
        $('#btn_apply').val('展延');
        $('#btn_apply').prop('disabled',false);
      } else {
        $('#first').val('T');
        $('#cname').val('');
        $('#rtype').val('');
        $('#rstate').val('');
        $('#rstart').val('');
        $('#rend').val('');
        $('#uid').val('').attr("readonly", false);
        $('#btn_apply').val('申請');
        alert('搜尋無結果!');
        $('#msg_cid').html('請輸入申請車主工號!');
      }
    }
  });
}

function getciddata() {
  var cid = $('#uid').val();
  $.ajax({
    type: "GET",
    url: "get_ciddata.php",
    data: {cid: cid},
    datatype: "JSON",
    success: function(Jresult){
      var Jstr = JSON.parse(Jresult);
      if(Jstr.code==='1'){
        $('#cname').val(Jstr.result.cname);
        $('#detail').show();
        getrtype();
      } else {
        $('#cname').val('');
        alert('搜尋無結果!請確認資料後再度申請!');
        document.location.href='park_license.php';
      }
    }
  });
}

function getrtype() {
  $.ajax({ /*取得停車類型資料*/
    type: "GET",
    url: "get_rtype.php",
    datatype: "JSON",
    success: function(Jresult) {
      var Jstr = JSON.parse(Jresult);
      var iCount = Jstr.count;
      var oSelect = document.getElementById('applytype');
      for(var iloop=0 ; iloop< iCount ; iloop++) {
        var opt = document.createElement('option');
        opt.appendChild(document.createTextNode(Jstr.result[iloop].rname));
        oSelect.appendChild(opt); 
      }
    }
  });
}

function changeRentalType() {
  var rname = $('#applytype').val();
  $.ajax({
    type: "GET",
    url: "get_singlertype.php",
    data: {rname: rname},
    datatype: "JSON",
    success: function(Jresult){
      var Jstr = JSON.parse(Jresult);
      var rentalMonths = Jstr.rmonth;
      var rStartDate = new Date($('#applystart').val()); //購買日起
      var nMonth = parseInt(rStartDate.getMonth()) + parseInt(rentalMonths); /*計算日期起增加的月份數*/
      var rEndDate = new Date(rStartDate.getFullYear(), nMonth, rStartDate.getDate()); //購買日迄      
      console.log('修正前購買日期:' + rStartDate.toISOString() + ' 購買期間:' + rentalMonths + ' 期限迄:'+ rEndDate.toISOString());
      
      var rEndMonthdays = daysInMonth( nMonth+1, rStartDate.getFullYear());

      if(rStartDate.getDate() > rEndMonthdays) {
        console.log('Change End of Month!');
        rEndDate = new Date(rStartDate.getFullYear(), nMonth, rEndMonthdays);
      }
      
      $('#applyend').val(rEndDate.getFullYear() + '-' + fillinTwo(rEndDate.getMonth()+1) + '-' + fillinTwo(rEndDate.getDate())); 
      $('#applycost').val(Jstr.rcost);
    }
  });
}

function daysInMonth(month,year) {
    var nDate = new Date(year, month, 0);
    var ndays = nDate.getDate();
    console.log(nDate.getFullYear() + '年' + (nDate.getMonth()+1) + '月有' + ndays + '天');
    return new Date(year, month, 0).getDate();
}