$(function () {
    $('#data_inicial').val(moment());
    $('input[name="date1"]').daterangepicker({
        singleDatePicker: true,
        opens: 'center',
        autoApply: true,
        startDate: moment(),
        "locale": {
            "format": "DD/MM/YYYY ",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "De",
            "toLabel": "Até",
            "customRangeLabel": "Custom",
            "daysOfWeek": [
                "Dom",
                "Seg",
                "Ter",
                "Qua",
                "Qui",
                "Sex",
                "Sáb"
            ],
            "monthNames": [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ],
            "firstDay": 0
        }
    }, function (start, end, label) {
        $('#date1').val(start.format('YYYY/MM/DD'));
        $('#data_inicial').val(start.format('YYYY-MM-DD'));
        start.format('DD/MM/YY')
    });
});