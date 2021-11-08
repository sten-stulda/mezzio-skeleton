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

function getValueModal(item) {

  document.getElementById("aktiva_id").value = $(item).attr("aktiva_id");

  /** zde se vrátí hodnoty pro genreování tabulky */
  var payload = {
    aktiva_id: $(item).attr("aktiva_id"),
    getValueModal: true,
  };

  //console.log(payload);

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
      console.log(JSON.stringify(data));
      //location.reload();
      //location.href = "/valuation";


      /** setConfidentiality */
      let inputConfidentiality = document.getElementsByName('setConfidentiality');
      for (let i = 0; i < inputConfidentiality.length; i++) {
        if (inputConfidentiality[i].value == data['result']['getValue']['confidentiality_value']
        ) inputConfidentiality[i].checked = true;
      }

      /** setIntegrity */
      let inputIntegrity = document.getElementsByName('setIntegrity');
      for (let i = 0; i < inputIntegrity.length; i++) {
        if (inputIntegrity[i].value == data['result']['getValue']['integrity_value']
        ) inputIntegrity[i].checked = true;
      }

      /** setAvailability */
      let inputAvailability = document.getElementsByName('setAvailability');
      for (let i = 0; i < inputAvailability.length; i++) {
        if (inputAvailability[i].value == data['result']['getValue']['availability_value']
        ) inputAvailability[i].checked = true;
      }

      /** setImpact */
      let inputImpact = document.getElementsByName('setImpact');
      for (let i = 0; i < inputImpact.length; i++) {
        if (inputImpact[i].value == data['result']['getValue']['impact_value']
        ) inputImpact[i].checked = true;
      }

      /** setVulnerability */
      let inputVulnerability = document.getElementsByName('setVulnerability');
      for (let i = 0; i < inputVulnerability.length; i++) {
        if (inputVulnerability[i].value == data['result']['getValue']['vulnerability_value']
        ) inputVulnerability[i].checked = true;
      }

      /** setThreat */
      let inputThreat = document.getElementsByName('setThreat');
      for (let i = 0; i < inputThreat.length; i++) {
        if (inputThreat[i].value == data['result']['getValue']['threat_value']
        ) inputThreat[i].checked = true;
      }

      document.getElementById('hodnotaAktiva').innerText = data['result']['getValue']['asset_value'];
      document.getElementById('vyslednaMiraRizika').innerText = data['result']['getValue']['result_of_degree_of_risk']; //result_of_degree_of_risk
      document.getElementById('miraRizika').innerText = data['result']['getValue']['result_of_degree_of_risk'];

      this.setMiraRizikaId(data['result']['getValue']['result_of_degree_of_risk']);

    })
    .catch(function (data) {

      // const json = JSON.stringify(data);

      //console.log(JSON.stringify(data));
      //alert(JSON.stringify(data));
      //location.reload(this);
      //location.href = "/valuation";


      //$("input[name=setConfidentiality][value=" + data['confidentiality_value'] + "]").("value")


    });
  // console.log(item);
  $('#modalValuation').modal('show');


}

function modalSetValuation(item) {
  var payload = {
    aktiva_id: $("input:hidden[id=aktiva_id]").attr("value"),
    columns: $(item).attr("name"),
    value: $(item).attr("value"),
  };

  console.log(payload);

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
      console.log(JSON.stringify(data));

      document.getElementById('hodnotaAktiva').innerText = data['result']['getValue']['asset_value'];
      document.getElementById('vyslednaMiraRizika').innerText = data['result']['getValue']['result_of_degree_of_risk']; //result_of_degree_of_risk
      //location.reload();
      //location.href = "/valuation";

      this.setMiraRizikaId(data['result']['getValue']['result_of_degree_of_risk']);

    })
    .catch(function (data) {
      console.log(JSON.stringify(data));
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


function setMiraRizikaId($value) {
  if ($value >= 3 && $value <= 99) {
    document.getElementById('miraRizika').style.background = 'green';
    document.getElementById('miraRizika').innerText = 'Nízké';
    document.getElementById('miraRizikaText').innerText = 'Riziko je považováno za přijatelné.';
  }
  if ($value >= 100 && $value <= 249) {
    document.getElementById('miraRizika').style.background = 'yellow';
    document.getElementById('miraRizika').innerText = 'Střední';
    document.getElementById('miraRizikaText').innerText = 'Riziko může být sníženo méně náročnými opatřeními nebo v případě vyšší náročnosti opatření je riziko přijatelné.';
  }
  if ($value >= 250 && $value <= 399) {
    document.getElementById('miraRizika').style.background = 'orange';
    document.getElementById('miraRizika').innerText = 'Vysoké';
    document.getElementById('miraRizikaText').innerText = 'Riziko je dlouhodobě nepřípustné a musí být zahajeny systematické kroky k jeho odstranění.';
  }
  if ($value >= 400 && $value <= 810) {
    document.getElementById('miraRizika').style.background = 'red';
    document.getElementById('miraRizika').innerText = 'Kritické';
    document.getElementById('miraRizikaText').innerText = 'Riziko je nepřípustné a musí být neprodleně zahájeny kroky k jeho odstranení.';
  }
}