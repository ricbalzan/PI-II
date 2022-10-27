function buscaNome() {
    // check if input is bigger than 3

    var token = $("#token").val();
    var nome = $("#nome").val();
    // var numero = $("#numero").val();
    console.log('nome');
    $.ajax({
        url: '/contratos/buscar',
        type: 'POST',
        method: 'POST',
        dataType: 'json',
        ContentType: 'application/json',
        headers: { 'X-CSRF-TOKEN': token },
        data: {
            'nome': nome,
            'token': token,

        },
        beforeSend: function () {

            //$('#descricao').html('Consultando...');


        },
        success: function (response) {

            response = JSON.parse(response);

            var len = response.contrato.numeros.length;
            console.log(len);

            $('#numero').html("");

            for (var i = 0; i < len; i++) {
                var id = response.contrato.numeros[i].id;
                var numero = response.numeroCpf.numeros[i].numero;

                // var matricula = response.colaborador[i].matricula;

                var option = "<option value=" + id + ">"

                    + numero +

                    "</option>";

                $('#numero').append(option);
                // $('#numero').selectpicker('refresh');

            }
            // console.log(response.fornecedor);
            // $("#numero").val(response.numeroCpf.numeros[0].numero);
            $("#cpf").val(response.contrato.cpf);

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
                //alert("Digite o Código");
                // if (codigo != "*") {
                //     $('#cod').html('<p style="color: red; font-size: 12px; margin-top: 5px"><b>Digite um código".</b></p>');
                //     setTimeout(function () {
                //         var cod = document.getElementById("cod");
                //         cod.parentNode.removeChild(cod);
                //     }, 7000);
                // }
            },
            //not found
            404: function () {
                alert("Arquivo não encontado");
            }
        }
    });
}