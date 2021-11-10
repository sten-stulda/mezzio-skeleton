newLine = lastLine; // předání hodnoty předané z PHP pro další manipulaci
funnelHere = 0; // element z/do kterého se přečerpává rozdíl částky
confirmedLines = []; // pole řádků s potvrzenými hodnotami
activeLineNr = 0; // číslo řádku, kde se zrovna nachází uživatel
globalValue = 0; // celková částka k rozdělení
globalLeft = 0; // celková částka k rozdělení bez potvrzených částek
numberOfLines = 0; // celkový po


function GetUniqId() {
    var i = newLine.toString();
    var checkbox = $('#new_source').find('input.funnel').attr('id', 'f_' + i);
    $(checkbox).closest('div').find('label.btn').attr('for', 'f_' + i);
    $(checkbox).closest('.source-block').find('select').attr('id', 's_' + i);
    $(checkbox).closest('.source-block').find('input[type="number"]').attr('id', 'i_' + i);
    $(checkbox).closest('.source-block').find('.conf').attr('id', 'c_' + i);
    $(checkbox).closest('.source-block').attr('data-line', i);
    newLine++;
}

$(window).on('load', function () {
    getSources();
    GetUniqId();
});

function Prefill() {
    var suggest = JSON.parse(input)['suggest'];
    $.each(suggest, function (index, value) {
        var amount = value['price'];
        var source = value['source'];
        var id = value['id'];
        AddSource(source, id, amount);
    });
    OriginalValues();
    $('select').trigger('change');
    $('#sources').find('input[type="number"]').each(function () {
        globalValue += parseFloat($(this).val());
    });
    $('#sources .funnel').last().click();
    numberOfLines = $('#sources .source-block').length;
    $(document).on('change', 'input, select', function () {
        $(window).bind("beforeunload", function (event) {
            return "Opuštěním stránky dojde ke ztrátě neodeslaných dat."; //Tahle hláška se stejně nezobrazuje, není nutno s ní manipulovat nebo překládat.
        });
    });
}

function getSources() {
    JayLoader('.card', 1);
    sources = $.ajax({
        type: "POST",
        url: mis_base_url + "travelOrders/getFinanceSources",
        success: function (data) {
            var response = JSON.parse(sources.responseText);
            var status = response['status'];
            switch (status) {
                case 'success':
                    var select = response['data']['htmlSelect'];
                    $('#new_source .source-select').append(select);
                    $('#sources .source select').addClass('selectpicker');
                    $('#sources .selectpicker').selectpicker();
                    Prefill();
                    break;
                case 'warning':
                    var title = 'Pozor!';
                    var message = GetMsgString(response['warnings']);
                    swal(title, message, status);
                    break;
                case 'error':
                    var title = 'Chyba!';
                    var message = GetMsgString(response['errors']);
                    swal(title, message, status);
                    break;
            }
            JayLoader('.card', 0);
        },
        error: function (data) {
            swal('Chyba!', 'Nastal problém v komunikaci se serverem.\nPokud bude problém přetrvávat, kontaktuje CI.', 'error');
            JayLoader('.card', 0);
        }
    });
}
function GetMsgString(array) {
    var output = "";
    $.each(array, function (key, value) {
        output += key + ': ' + value + '\n\n';
    });
    return output;
}


function AddSource(source = "", id="-1", amount = 0, ratio = 1) {
    var input = parseFloat(amount) * parseFloat(ratio);
    var html = $('#new_source').html();
    $('#new_sources').append(html);
//    $('#sources').find('.source').last().html();
    $('#sources').find('.source-block').last().find('select').addClass('selectpicker');
    $('#sources').find('.source-block').last().find('select').val(source);
    $('#sources').find('.source-block').last().find('input[type="number"]').val(input);
    $('#sources').find('.source-block').last().find('input[type="number"]').attr('data-line-id', id);
    $('#sources').find('.source-block').last().find('.selectpicker').selectpicker('refresh');
    GetUniqId();
    numberOfLines++;
}

function RemoveSource(elm) {
    var frame = $(elm).closest('.source-block');
    var line = $(frame).data('line');
    var value = parseFloat($(frame).find('input[type="number"]').val());
    if (funnelHere == "0") {
        swal('Pozor!', 'Nejprve zvolte řádek, se kterým se má upravovaná hodnota balancovat.', 'error');
    } else {
        var checked = $(frame).find('input.funnel').is(':checked');
        $(frame).remove();
        numberOfLines--;
        if (checked) {
            $('#sources .funnel').last().click();
        }
        var target = parseFloat($('#i_' + funnelHere).val());
        var newVal = value + target;
        $('#i_' + funnelHere).val(newVal);
        $('#i_' + funnelHere).attr('data-original-value', newVal);
    }
}

function FunnelHere(elm) {
    $('.source-block').removeClass('funnel-here');
    $('label.btn').removeClass('btn-primary').addClass('btn-light');
    $('.funnel').prop('checked', false);
    var line = $(elm).closest('.row').data('line');
    if ($.inArray(line, confirmedLines) == -1) {
        $(elm).prop('checked', true);
    } else {
        funnelHere = "0";
    }
    var price = $(elm).closest('.row').find('input[type="number"]');
    if ($(elm).is(':checked')) {
        var label = $(elm).closest('div').find('label.btn');
        $('#i_' + funnelHere).prop('disabled', false);
        funnelHere = $(elm).closest('.row').data('line');
        $(elm).closest('.row').addClass('funnel-here');
        $(price).prop('disabled', true);
        $(label).toggleClass('btn-light btn-primary');
        $('#new_sources').find('.btn-danger').each(function () {
            var line = $(this).closest('.source-block').data('line');
            if ($.inArray(line, confirmedLines) == -1) {
                $(this).removeClass('d-none');
            }
        });
        $('#new_sources').find('.source-block[data-line="' + funnelHere + '"] .btn-danger').addClass('d-none');
    } else {
        funnelHere = "0";
    }
}

function ConfirmValue(elm) {
    var row = $(elm).closest('.source-block');
    var line = $(row).data('line');
    var input = $(elm).closest('.source-block').find('input[type="number"]');
    var funnel = $(elm).closest('.source-block').find('input.funnel');
    var label = $(elm).closest('.source-block').find('label.btn');
    var select = $(elm).closest('.source-block').find('select');
    var button = $(elm).closest('.source-block').find('button.btn-danger');
    if ($(elm).is(':checked')) {
        if (line === funnelHere) {
            $($('#sources .source-block').get().reverse()).each(function (myIndex, myElement) {
                var line = $(this).data('line');
                if ($.inArray(line, confirmedLines) == -1 && line != funnelHere && line != activeLineNr) {
                    $(this).find('.funnel').click();
                    return false;
                }
            });
            //        funnelHere = 0;
            $('#f_' + line).prop('checked', false);
            $('label.btn').removeClass('btn-primary').addClass('btn-light');
            //        $(row).removeClass('funnel-here');
        }
        confirmedLines.push(line);
        $(row).addClass('confirmed-line');
        $(input).prop('disabled', true);
        $(funnel).prop('disabled', true);
        $(select).prop('disabled', true);
        $(label).addClass('disabled');
        $(button).addClass('d-none');
    } else {
        confirmedLines = $.grep(confirmedLines, function (value) {
            return value != line;
        });
        $(row).removeClass('confirmed-line');
        $(input).prop('disabled', false);
        $(funnel).prop('disabled', false);
        $(select).prop('disabled', false);
        $(label).removeClass('disabled');
        $(button).removeClass('d-none');
        if (confirmedLines.length == numberOfLines - 1) {
            $('#new_sources').find('.funnel').click();
        }
    }
    $('.selectpicker').selectpicker('refresh');
}

function activeLine(elm) {
    globalLeft = globalValue;
    $.each(confirmedLines, function (key, value) {
        globalLeft -= $('.source-block[data-line="' + value + '"]').find('input[type="number"]').val();
    });
    if ($(elm).val() > globalLeft) {
        $(elm).val(globalLeft);
    }
    if ($(elm).val() == "") {
        $(elm).val('0');
    }
    activeLineNr = $(elm).closest('.row').data('line');
    var activeRow = $(elm).closest('.row');
    var i = $(activeRow).find('input[type="number"]');
    var i1 = $(activeRow).find('input[type="number"]').val();
    var o1 = parseFloat($(activeRow).find('input[type="number"]').attr('data-original-value'));
    if (funnelHere == "0") {
        swal('Pozor!', 'Nejprve zvolte řádek, se kterým se má upravovaná hodnota balancovat.', 'error');
        $(i).val(o1);
    } else {
        var i2 = $('.source-block[data-line="' + funnelHere + '"]').find('input[type="number"]').val();
        var o2 = parseFloat($('.source-block[data-line="' + funnelHere + '"]').find('input[type="number"]').attr('data-original-value'));
        var delta = o1 - i1;
        var newVal = o2 + delta;
        if (newVal >= 0) {
            $('.source-block[data-line="' + funnelHere + '"]').find('input[type="number"]').val(newVal);
        } else {
            $('.source-block[data-line="' + funnelHere + '"]').find('input[type="number"]').val(0);
            $($('#sources .source-block').get().reverse()).each(function (myIndex, myElement) {
                var line = $(myElement).data('line');
                if ($.inArray(line, confirmedLines) == -1 && line != funnelHere && value != 0 && line != activeLineNr) {
                    var value = parseFloat($(myElement).find('input[type="number"]').val());
                    var newValFor = value + newVal;
                    if (newValFor >= 0) {
                        $(myElement).find('input[type="number"]').val(newValFor);
                        return false;
                    } else {
                        newVal = newValFor;
                        $(myElement).find('input[type="number"]').val(0);
                    }
                }
            });
        }
        storeValue();

    }
}

function OriginalValues() {
    $('#sources .source-block').each(function () {
        var value = $(this).find('input[type="number"]').val();
        var element = $(this).find('input[type="number"]');
        $(element).attr('data-original-value', value);
    });
}

function storeValue() {
    if (funnelHere != 0) {
        $('#sources .source-block').each(function () {
            var newVal = $(this).find('input[type="number"]').val();
            $(this).find('input[type="number"]').attr('data-original-value', newVal);
        });
    }
}

$('#sources').on('change', 'select', function () {
    if ($(this).val() != "" || $(this).val() != null) {
        $(this).closest('.row').find('input[type="number"]').prop('disabled', false);
    }
});

$('#saveButton').click(function () {
    var out = {};
    var lines = [];
    var approved = {};
    var suggest = {};
    $('#approved .source-block').each(function () {
        var line = {};
        line['checked'] = 0;
        line['id'] = $(this).find('input[type="text"]').data('line-id');
        line['source'] = $(this).find('input[type="text"]').data('fisid');
        line['price'] = $(this).find('input[type="number"]').val();
        if ($(this).find('input.conf').is(':checked')) {
            line['checked'] = 1;
        }
        lines.push(line);
    });
    approved = lines;
    var lines = [];
    $('#new_sources .source-block').each(function () {
        var line = {};
        line['checked'] = 0;
        line['source'] = $(this).find('select').find('option:selected').data('source-id');
        line['price'] = $(this).find('input[type="number"]').val();
        line['id'] = $(this).find('input[type="number"]').data('line-id');
        if ($(this).find('input.conf').is(':checked')) {
            line['checked'] = 1;
        }
        lines.push(line);
    });
    suggest = lines;
    var secondLevel = {};
    secondLevel['approved'] = approved;
    secondLevel['suggest'] = suggest;
    out[budgetLabel] = secondLevel;
    out['formType'] = JSON.parse(input)['formType'];
    $(window).unbind('beforeunload');
    var data = "financial_sources=" + JSON.stringify(out);
    sendJson = $.ajax({
        type: 'post',
//        contentType: "application/json",
        url: mis_base_url + "travelOrders/saveFinancialSources",
        data: data,
        success: function (data) {
            var response = sendJson.responseText;
            var response = JSON.parse(response);
            var status = response['status'];
            switch (status) {
                case 'success':
                    var title = "Uloženo";
                    var text = "";
                    break;
                case 'warning':
                    var title = "Pozor";
                    var text = GetMsgString(response['warnings']);
                    break;
                case 'error':
                    var title = "Chyba";
                    var text = GetMsgString(response['errors']);
                    break;
            }
            swal(title, text, status);
        },
        error: function (data) {
            var title = "Chyba";
            var text = "Nastal problém v komunikaci se serverem.\nPokud se bude problém opakovat, kontaktuje CI.";
            var status = "error";
            swal(title, text, status);
        }
    });
});

function GetMsgString(array) {
    var output = "";
    $.each(array, function (key, value) {
        output += key + ': ' + value + '\n\n';
    });
    return output;
}

