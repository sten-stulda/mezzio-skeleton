



var url = "http://mezzio.test/valuation/assets";
fetch(url)
  .then(function (response) {
    return response.json();
  })
  .then(function (data) {
    //document.getElementById("myData").innerHTML = "";

    var nameAssets = ['Důvernost','Integrity','Dostupnost','Dopad','Zranitelnost','Hrozby'];

    console.log(data);


    var newTable = '';

    for (var i = 0; i < 6; i++) {

        var value_1 = '';
        var value_2 = '';
        var value_3 = '';
        var value_4 = '';

        var text_1 = '';
        var text_2 = '';
        var text_3 = '';
        var text_4 = '';

        if(i == '0' && data.confidentiality_value == '1'){  value_1 = 'green'; text_1 = 'Vybráno';}
        if(i == '0' && data.confidentiality_value == '2'){  value_2 = 'yellow'; text_2 = 'Vybráno';}
        if(i == '0' && data.confidentiality_value == '3'){  value_3 = 'orande'; text_3 = 'Vybráno';}
        if(i == '0' && data.confidentiality_value == '4'){  value_4 = 'red'; text_4 = 'Vybráno';}

        if(i == '1' && data.integrity_value == '1'){  value_1 = 'true'}
        if(i == '1' && data.integrity_value == '2'){  value_2 = 'true'}
        if(i == '1' && data.integrity_value == '3'){  value_3 = 'true'}
        if(i == '1' && data.integrity_value == '4'){  value_4 = 'true'}

        if(i == '2' && data.availability_value == '1'){  value_1 = 'true'}
        if(i == '2' && data.availability_value == '2'){  value_2 = 'true'}
        if(i == '2' && data.availability_value == '3'){  value_3 = 'true'}
        if(i == '2' && data.availability_value == '4'){  value_4 = 'true'}

        if(i == '3' && data.impact_value == '1'){  value_1 = 'true'}
        if(i == '3' && data.impact_value == '2'){  value_2 = 'true'}
        if(i == '3' && data.impact_value == '3'){  value_3 = 'true'}
        if(i == '3' && data.impact_value == '4'){  value_4 = 'true'}

        if(i == '4' && data.vulnerability_value == '1'){  value_1 = 'true'}
        if(i == '4' && data.vulnerability_value == '2'){  value_2 = 'true'}
        if(i == '4' && data.vulnerability_value == '3'){  value_3 = 'true'}
        if(i == '4' && data.vulnerability_value == '4'){  value_4 = 'true'}

        if(i == '5' && data.threat_value == '1'){  value_1 = 'true'}
        if(i == '5' && data.threat_value == '2'){  value_2 = 'true'}
        if(i == '5' && data.threat_value == '3'){  value_3 = 'true'}
        if(i == '5' && data.threat_value == '4'){  value_4 = 'true'}
        // if(data.confidentiality_value == '2'){ confidentiality_2 = 'true'}else{confidentiality_2 = ''}


      newTable += "<tr>";
      newTable += "<td align='center' style='background-color: lightgray'>" + nameAssets[i] + "</td>";
      newTable += '<td align="center" style="background-color:' + value_1 + ';">' + text_1 + '</td>'; //" + data[i].id + "¨
      newTable += '<td align="center" style="background-color:' + value_2 + ';">' + text_2 + '</td>';
      newTable += "<td align='center'>" + value_3 + "</td>"; //" + data[i].aktiva_id + "
      newTable += "<td align='center'>" + value_4 +"</td>"; //" + data[i].id + "
      newTable += "</tr>";
    }

    document.getElementById("myData").innerHTML = newTable;
  })
  .catch(function (err) {
    console.log(err);
  });

$.ajax({
  url: "http://mezzio.test/valuation/assets",
  type: "POST",
  success: function (response) {
    var data = response.split(",");
    $("#title").val(data[0]);
    $("#name").val(data[1]);
    $("#id").val(data[2]);
  },
});
