function clickedConfidentiality(item) {
    $("input:radio[id=Confidentiality]").attr("checked", false)
    $("input:radio[name=radio_"+$(item).attr("value")+"]").attr("checked", true)
}

function clickedImpact(item){
    $("input:radio[id=Impact]").attr("checked", false)
    $("input:radio[name=radio_"+$(item).attr("value")+"]").attr("checked", true)
}

function clickedIntegrity(item) {
    $("input:radio[id=Integrity]").attr("checked", false)
    $("input:radio[name=radio_"+$(item).attr("value")+"]").attr("checked", true)
}

// Initialize tooltip component
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})

// Initialize popover component
$(function() {
    $('[data-toggle="popover"]').popover()
})