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


  // $('#modalValuation').on('show.bs.modal', function (e) {
  //   //$(this).val();
  //   let btn = $(e.relatedTarget);
  //   console.log(e); // e.related here is the element that opened the modal, specifically the row button
  //   //let id = btn.data('id'); // this is how you get the of any `data` attribute of an element
  //   //$('.saveEdit').data('id', id); // then pass it to the button inside the modal
  // })

  // aktiva_id


};

function getValueModal(id) {
  console.log(id);
  document.getElementById("aktiva_id").value = id;
  //$('#aktiva_id').value(id);
  $('#modalValuation').modal('show');
}

function modalSetValuation(item) {
  var payload = {
    aktiva_id: $("input:hidden[id=aktiva_id]").attr("value"),
    confidentiality_value: $(item).attr("value"),
  };

  fetch("/valuation", {
    method: "POST",
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(payload),
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      //console.log(JSON.stringify(data));
      //alert(JSON.stringify(data));
      //location.reload(this);
      //location.href = "/valuation";
    });
}

function setConfidentiality(item) {
  var payload = {
    aktiva_id: $(item).attr("aktiva_id"),
    confidentiality_value: $(item).attr("value"),
  };

  fetch("/valuation", {
    method: "POST",
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(payload),
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      //alert(JSON.stringify(data));
      location.reload();
      //location.href = "/valuation";
    });
}

function setIntegrity(item) {
  var payload = {
    aktiva_id: $(item).attr("aktiva_id"),
    integrity_value: $(item).attr("value"),
  };

  fetch("/valuation", {
    method: "POST",
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(payload),
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      //console.log(JSON.stringify(data));
      //alert(JSON.stringify(data));
      location.reload();
      //location.href = "/valuation";
    });
}

function setAvailability(item) {
  var payload = {
    aktiva_id: $(item).attr("aktiva_id"),
    availability_value: $(item).attr("value"),
  };

  fetch("/valuation", {
    method: "POST",
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(payload),
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      //console.log(JSON.stringify(data));
      //alert(JSON.stringify(data));
      location.reload();
      //location.href = "/valuation";
    });
}

function setImpact(item) {
  var payload = {
    aktiva_id: $(item).attr("aktiva_id"),
    impact_value: $(item).attr("value"),
  };

  fetch("/valuation", {
    method: "POST",
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(payload),
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      //console.log(JSON.stringify(data));
      //alert(JSON.stringify(data));
      location.reload();
      //location.href = "/valuation";
    });
}

function setVulnerability(item) {
  var payload = {
    aktiva_id: $(item).attr("aktiva_id"),
    vulnerability_value: $(item).attr("value"),
  };

  fetch("/valuation", {
    method: "POST",
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(payload),
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      //console.log(JSON.stringify(data));
      //alert(JSON.stringify(data));
      location.reload();
      //location.href = "/valuation";
    });
}

function setThreat(item) {
  var payload = {
    aktiva_id: $(item).attr("aktiva_id"),
    threat_value: $(item).attr("value"),
  };

  fetch("/valuation", {
    method: "POST",
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(payload),
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      //console.log(JSON.stringify(data));
      //alert(JSON.stringify(data));
      location.reload();
      //location.href = "/valuation";
    });
}