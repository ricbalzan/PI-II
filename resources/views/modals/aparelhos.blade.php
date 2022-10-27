<div class="modal fade mt-1" id="modal_aparelhos"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="text-align:center">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="printable">
            <input type="hidden" name="idcli" id="idcli">
                    <div class="modal-header">
                        <h1 class="modal-title" id="gridSystemModalLabel">Aparelho - <input style="border: 0" type="text" id="title">  </h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                       
                    </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-5 text-center">
                        <label for="marca">{{ __('Marca')}}</label>                                
                        <input type="text" class="form-control" id="marca" name="marca" readonly>            
                    </div>
                    <div class="col-sm-5">
                        <label for="modelo">{{ __('Modelo')}}</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="numero">{{ __('Número')}}</label>
                        <input type="text" class="form-control" id="numero" name="numero" readonly>
                    </div>
                    <div class="col-sm-5">
                        <label for="num_serie">{{ __('Número Serie')}}</label>
                        <input type="text" class="form-control" id="num_serie" name="num_serie" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="estoque">{{ __('Estoque')}}</label>
                        <input type="text" class="form-control" id="estoque" name="estoque" readonly>
                    </div>
                    <div class="col-sm-5">
                        <label for="dtentrega">{{ __('Data Entrega')}}</label>
                        <input type="text" class="form-control" id="dtentrega" name="dtentrega" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-warning" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>