$('#simpletable').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
    }
});

function openModal(id) {
    // check if input is bigger than 3

    var token = $("#token").val();
    var id = id;

    jQuery.ajax({
        url: '/faturas/exibir',
        type: 'POST',
        method: 'POST',
        dataType: 'json',
        ContentType: 'application/json',
        headers: { 'X-CSRF-TOKEN': token },
        data: {

            'token': token,
            'id': id,
            // 'idcli': idcli

        },
        beforeSend: function () {


        },
        success: function (response) {

            if(response.fatura[0].mes == '1') {
                response.fatura[0].mes = 'Janeiro';
            }
            else if(response.fatura[0].mes == '2') {
                response.fatura[0].mes = 'Fevereiro';
            }
            else if(response.fatura[0].mes == '3') {
                response.fatura[0].mes = 'Março';
            }
            else if(response.fatura[0].mes == '4') {
                response.fatura[0].mes = 'Abril';
            }
            else if(response.fatura[0].mes == '5') {
                response.fatura[0].mes = 'Maio';
            }
            else if(response.fatura[0].mes == '6') {
                response.fatura[0].mes = 'Junho';
            }
            else if(response.fatura[0].mes == '7') {
                response.fatura[0].mes = 'Julho';
            }
            else if(response.fatura[0].mes == '8') {
                response.fatura[0].mes = 'Agosto';
            }
            else if(response.fatura[0].mes == '9') {
                response.fatura[0].mes = 'Setembro';
            }
            else if(response.fatura[0].mes == '10') {
                response.fatura[0].mes = 'Outubro';
            }
            else if(response.fatura[0].mes == '11') {
                response.fatura[0].mes = 'Novembro';
            } 
            else {
                response.fatura[0].mes = 'Dezembro';
            }

            $("#title").val(response.fatura[0].name);
            $("#numero").val(response.fatura[0].numero);
            $("#valor").val(response.fatura[0].valor);
            $("#mes").val(response.fatura[0].mes);
            $("#dtinsercao").val(response.fatura[0].data_insercao.substr(0, 10).split('-').reverse().join('/'));

            $(document).ready(function () {
                $('.modal').on('hidden.bs.modal', function () {
                    console.log('fechar modal')
                    $(this).find('input:text').val('');
                });
            });
        },
        statusCode: {
            //erro de autenticação em caso de logout
            401: function () {
                alert("Necessário fazer login novamente!");
                window.location = "/home";
                //                window.location.reload();
            },
            //erro de servidor
            500: function () {
                alert("Erro servidor");
            },
            //not found
            404: function () {
                alert("Arquivo não encontado");
            }
        }
    });
}

