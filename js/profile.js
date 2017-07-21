function eLoad() {
  $('#radiofield').hide();
}

function selecthandler() {
  var iIndex = $('#field').val();
  if(iIndex === '4') {
    $('#radiofield').show();
    $('#searchfield').hide();
  } else {
    $('#searchfield').show();
    $('#radiofield').hide();
  }
}