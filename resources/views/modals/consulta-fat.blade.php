<div class="modal fade mt-1" id="modal_num"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="text-align:center">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="printable">
            <input type="hidden" name="idcli" id="idcli">
                    <div class="modal-header">
                        <h1 class="modal-title" id="gridSystemModalLabel">Número - <input style="border: 0" type="text" id="title">  </h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                       
                    </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-2 text-center">
                        <label for="registro">{{ __('Número')}}</label>                                
                        <input type="text" class="form-control" id="registro" name="registro" readonly>            
                    </div>
                    <div class="col-sm-2">
                        <label for="dtcadastro">{{ __('Data de Cadastro')}}</label>
                        <input type="text" class="form-control" id="dtcadastro" name="dtcadastro" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8">
                        <label for="endereco1">{{ __('SIM')}}</label>
                        <input type="text" class="form-control" id="endereco1" name="endereco1" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="apelido">{{ __('Cpf Titular Número')}}</label>
                        <input type="text" class="form-control" id="apelido" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-warning" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>