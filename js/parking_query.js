function get_surplus(id, td_index, park_count) {
  $.ajax({
    url: "get_surplus.php",
    data: {pid: id, td_index: td_index, pcount: park_count},
    type: "GET",
    datatype: "json",

    success: function(query_result) {
      var result = JSON.parse(query_result);
        $('.surplus')[result.td_index].textContent = parseInt(result.pcount) - parseInt(result.count);
    }
  });
}