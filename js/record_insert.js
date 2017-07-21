window.onload = function(){
  var btn_now = document.getElementById("getnow");
  btn_now.onclick = function(){
    var dt = document.getElementById("stime");
    var time = new Date();
    currentHours = time.getHours();
    currentMinutes = time.getMinutes();
    dt.value = (time.getFullYear()+"-"+fillinTwo(time.getMonth()+1)+"-"+fillinTwo(time.getDate())+"T"+fillinTwo(currentHours)+":"+fillinTwo(currentMinutes));
  };
}
function fillinTwo(iData){ /*時間不足兩位補位*/
  if(iData<10){
    return ('0'+iData);
  }
  return iData;
}
function eKeyDown(){
  var oBtn = document.getElementById('submit');
  var oCno = document.getElementById('cno');
  if(oCno.value.length>6){
    oBtn.disabled = false;
  } else {
    oBtn.disabled = true;
  }
}