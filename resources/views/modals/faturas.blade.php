<div class="modal fade mt-1" id="modal_fatura"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="text-align:center">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="printable">
            <input type="hidden" name="idcli" id="idcli">
                    <div class="modal-header">
                        <h1 class="modal-title" id="gridSystemModalLabel">Fatura - <input style="border: 0" type="text" id="title">  </h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                       
                    </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-5 text-center">
                        <label for="numero">{{ __('Número')}}</label>                                
                        <input type="text" class="form-control" id="numero" name="numero" readonly>            
                    </div>
                    <div class="col-sm-5">
                        <label for="dtinsercao">{{ __('Data de Inserção')}}</label>
                        <input type="text" class="form-control" id="dtinsercao" name="dtinsercao" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="mes">{{ __('Mês')}}</label>
                        <input type="text" class="form-control" id="mes" name="mes" readonly>
                    </div>
                    <div class="col-sm-5">
                        <label for="valor">{{ __('Valor')}}</label>
                        <input type="text" class="form-control" id="valor" name="valor" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-warning" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>