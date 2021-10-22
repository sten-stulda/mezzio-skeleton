/** confidentiality */
function clickedConfidentiality(item) {
    console.log(item);
    $("input:radio[id=Confidentiality]").attr("checked", false)
    $("input:radio[name=radio_" + $(item).attr("value") + "]").attr("checked", true)
    $('#confidentialityForm').delay(200).submit();
}

/** integrity */
function clickedIntegrity(item) {

    $("input:radio[id=Integrity]").attr("checked", false)
    $("input:radio[name=radio_" + $(item).attr("value") + "]").attr("checked", true)
    $('#integrityForm').delay(200).submit();
}

/** availability */
function clickedAvailability(item) {
    $("input:radio[id=Availability]").attr("checked", false)
    $("input:radio[name=radio_" + $(item).attr("value") + "]").attr("checked", true)
    $('#availabilityForm').delay(200).submit();
}

/** impact */
function clickedImpact(item) {
    $("input:radio[id=Impact]").attr("checked", false)
    $("input:radio[name=radio_" + $(item).attr("value") + "]").attr("checked", true)
    $('#impactForm').delay(200).submit();
}

function clickedIntegritys(item) {
    $("input:radio[id=Integrity]").attr("checked", false)
    $("input:radio[name=radio_" + $(item).attr("value") + "]").attr("checked", true)
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

    $("input:radio[name=setImpact]").on('change', function () {
        value = $(this).val()
        console.log("Bylo vybráno hodnocení: " + value);
    });
    $("input:radio[name=setVulnerability]").on('change', function () {
        value = $(this).val()
        console.log("Bylo vybráno hodnocení: " + value);
    });
    $("input:radio[name=setThreat]").on('change', function () {
        value = $(this).val()
        console.log("Bylo vybráno hodnocení: " + value);
    });

    // Initialize tooltip component

    $('[data-toggle="tooltip"]').tooltip()


    // Initialize popover component

    $('[data-toggle="popover"]').popover()

    $("a[name=setConfidentiality]").on('click', function () {
        console.log('vybrano');
    })

    $("a[id=hoverTooltip]").on('mouseover', function () {
        console.log('vybrano');
        //$("div[id=testTooltip]").
        document.getElementById('testTooltip').style.display = 'inline';
    })

}

function setConfidentiality(item) {
    console.log("Vybrano hodnocení: " + $(item).attr("value"));
    //$("input:radio[id=Integrity]").attr("checked", false)
    //$("input:radio[name=radio_" + $(item).attr("value") + "]").attr("checked", true)
}
