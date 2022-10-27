$('#simpletable').DataTable({
    "searching": true, // Searchbox
    "paging": false, // Pagination
    "info": false,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
    }
});

function openModal(id) {
    // check if input is bigger than 3

    var token = $("#token").val();
    var id = id;

    jQuery.ajax({
        url: '/tecnicos/exibir',
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
            // $("#overlay").faLoading("remove");
            // console.log(response.cliente);
            // console.log(response.cliente);
            // $('#exemplomodal3').modal('toggle');
            // $("#overlay").faLoading("remove");
            // response = JSON.parse(response);
            // console.log(response.cliente.nome);
            // $("#composicao").html("");
            // console.log(response)
            $("#title").val(response.tecnico.nome);
            $("#nome").val(response.tecnico.nome);
            $("#telefone").val(response.tecnico.telefone);
            $("#telefone2").val(response.tecnico.telefone2);
            $("#email").val(response.tecnico.email);
            $("#cpf").val(response.tecnico.cpf);
            $("#registro").val(response.tecnico.id);
            $("#dtcadastro").val(response.tecnico.data_cadastro.substr(0, 10).split('-').reverse().join('/'));

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

