/** confidentiality */
function clickedConfidentiality(item) {
  var payload = {
    aktiva_id: $("input:hidden[name=aktiva_id]").attr("value"),
    setConfidentiality: $(item).attr("value"),
  };
  var data = new FormData();
  data.append("json", JSON.stringify(payload));

  fetch("/valuation/confidentiality", {
    method: "POST",
    body: data,
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      //alert(JSON.stringify(data));
      location.href = "/valuation/integrity/" + payload["aktiva_id"];
    });
}

/** integrity */
function clickedIntegrity(item) {
  var payload = {
    aktiva_id: $("input:hidden[name=aktiva_id]").attr("value"),
    setIntegrity: $(item).attr("value"),
  };
  console.log(payload);
  var data = new FormData();
  data.append("json", JSON.stringify(payload));

  fetch("/valuation/integrity", {
    method: "POST",
    body: data,
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      //alert(JSON.stringify(data));
      location.href = "/valuation/availability/" + payload["aktiva_id"];
    });
}

/** availability */
function clickedAvailability(item) {
  var payload = {
    aktiva_id: $("input:hidden[name=aktiva_id]").attr("value"),
    setAvailability: $(item).attr("value"),
  };
  console.log(payload);
  var data = new FormData();
  data.append("json", JSON.stringify(payload));

  fetch("/valuation/availability", {
    method: "POST",
    body: data,
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      //alert(JSON.stringify(data));
      location.href = "/valuation/impact/" + payload["aktiva_id"];
    });
}

/** impact */
function clickedImpact(item) {
  var payload = {
    aktiva_id: $("input:hidden[name=aktiva_id]").attr("value"),
    setImpact: $(item).attr("value"),
  };
  console.log(payload);
  var data = new FormData();
  data.append("json", JSON.stringify(payload));

  fetch("/valuation/impact", {
    method: "POST",
    body: data,
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      //alert(JSON.stringify(data));
      location.href = "/valuation/vulnerability/" + payload["aktiva_id"];
    });
}

/** vulnerability */
function clickedVulnerability(item) {
  var payload = {
    aktiva_id: $("input:hidden[name=aktiva_id]").attr("value"),
    setVulnerability: $(item).attr("value"),
  };
  console.log(payload);
  var data = new FormData();
  data.append("json", JSON.stringify(payload));

  fetch("/valuation/vulnerability", {
    method: "POST",
    body: data,
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      //alert(JSON.stringify(data));
      location.href = "/valuation/threat/" + payload["aktiva_id"];
    });
}

/** threat */
function clickedThreat(item) {
  var payload = {
    aktiva_id: $("input:hidden[name=aktiva_id]").attr("value"),
    setThreat: $(item).attr("value"),
  };
  console.log(payload);
  var data = new FormData();
  data.append("json", JSON.stringify(payload));

  fetch("/valuation/threat", {
    method: "POST",
    body: data,
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      //alert(JSON.stringify(data));
      location.href = "/valuation";
    });
}

/** */
function clickedIntegritys(item) {
  $("input:radio[id=Integrity]").attr("checked", false);
  $("input:radio[name=radio_" + $(item).attr("value") + "]").attr(
    "checked",
    true
  );
}

// /**
//  * This function search cars by word
//  *
//  * @param word
//  * @returns {Promise<Response>}
//  */
// async function searchCar(word) {
//     let dataSend = new FormData();
//     dataSend.append('word', word);
//     return await fetch('http://localhost/car', {
//         method: 'POST',
//         body: dataSend
//     });
// }

// document.addEventListener("DOMContentLoaded", function () {
//     // Get input element and add event keyup
//     let searchInput = document.getElementsByName('setImpact');
//     searchInput.addEventListener('keyup', async function () {
//         console.info("Buscando espera por favor...");
//         let result = await searchCar(searchInput.value);
//         let cars = await result.json();
//         cars.forEach(function (car) {
//             console.log(car);
//         });
//     });
// });

window.onload = function () {
  // $("input:radio[name=setImpact]").on('change', function () {
  //     value = $(this).val()
  //     console.log("Bylo vybráno hodnocení: " + value);
  // });
  // $("input:radio[name=setVulnerability]").on('change', function () {
  //     value = $(this).val()
  //     console.log("Bylo vybráno hodnocení: " + value);
  // });
  // $("input:radio[name=setThreat]").on('change', function () {
  //     value = $(this).val()
  //     console.log("Bylo vybráno hodnocení: " + value);
  // });

  // Initialize tooltip component

  $('[data-toggle="tooltip"]').tooltip();

  // Initialize popover component

  $('[data-toggle="popover"]').popover();

  $("a[name=setConfidentiality]").on("click", function () {
    console.log("vybrano");
  });

  $("a[id=hoverTooltip]").on("mouseover", function () {
    console.log("vybrano");
    //$("div[id=testTooltip]").
    document.getElementById("testTooltip").style.display = "inline";
  });


};

function setConfidentiality(item) {
  var payload = {
    aktiva_id: $(item).attr("aktiva_id"),
    aktiva_column: 'confidentiality_value',
    aktiva_value: $(item).attr("value"),
  };

  var data = new FormData();
  data.append("json", JSON.stringify(payload));

  var http = new XMLHttpRequest();
  var url = '/valuation';
  var params = payload;
  http.open('POST', url, true);
  
  //Send the proper header information along with the request
  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  
  http.onreadystatechange = function() {//Call a function when the state changes.
    alert(http.responseText);
  }
  http.send(params);

  // fetch("/valuation", {
  //   method: "POST",
  // 	body: JSON.stringify(data),
  // })
  //   .then(function (res) {
  //     return res.json;
  //   })
  //   .then(function (data) {
  //     alert(JSON.stringify(data));
  //     //location.href = "/valuation";
  //   });
}
