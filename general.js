function URL_Trans(str, url){
  console.log(str);
  document.location.href=url;
}

window.onload = function(){
  input_focus();
}

function input_focus(){
  var input = document.getElementsByTagName('input');
  for( var i=0 ; i<input.length ; i++){
    if(input[i].getAttribute('type') == 'text' || input[i].getAttribute('type') == 'password'){
      input[i].onfocus = function(){
        this.style.backgroundColor = '#FFFFCC'
      }
      input[i].onblur = function(){
        this.style.backgroundColor = "#FFF";
      }
    }
  }  
  
}