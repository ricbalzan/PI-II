function buscaNome() {
    // check if input is bigger than 3

    var token = $("#token").val();
    var nome = $("#nome").val();

    console.log('nome');
    $.ajax({
        url: '/numeros/buscar',
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


            // console.log(response.fornecedor);
            // $("#numero").val(response.numeroCpf.numeros[0].numero);
            $("#cpf").val(response.cpf[0].cpf);

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