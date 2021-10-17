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