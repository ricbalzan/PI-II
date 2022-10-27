$('#simpletable').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
    }
});

function confirmaEntrega(id) {

    $("#confirma_entrega").val(id);

}

function openModal(id) {
    // check if input is bigger than 3

    var token = $("#token").val();
    var id = id;

    jQuery.ajax({
        url: '/aparelhos/exibir',
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

            $("#marca").val(response.aparelho.marca);
            $("#modelo").val(response.aparelho.modelo);
            $("#num_serie").val(response.aparelho.num_serie);
            $("#numero").val(response.aparelho.numero);
            $("#estoque").val(response.aparelho.estoque);
            $("#dtentrega").val(response.aparelho.dt_entrega.substr(0, 10).split('-').reverse().join('/'));
            $("#title").val(response.aparelho.marca + " / " + response.aparelho.modelo);

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

