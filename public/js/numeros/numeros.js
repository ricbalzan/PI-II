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
        url: '/numeros/exibir',
        type: 'POST',
        method: 'POST',
        dataType: 'json',
        ContentType: 'application/json',
        headers: { 'X-CSRF-TOKEN': token },
        data: {

            '_token': token,
            'id': id,
            // 'idcli': idcli

        },
        beforeSend: function () {


        },
        success: function (response) {
            console.log(response.numero);
            $("#numero").val(response.numero.numero);
            $("#dtcadastro").val(response.numero.dt_cadastro.substr(0, 10).split('-').reverse().join('/'));
            $("#sim").val(response.numero.sim);
            $("#cpf").val(response.numero.cpf);
            $("#title").val(response.numero.numero);

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

