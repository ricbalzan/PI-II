<div class="modal fade" id="entrega" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      {{Form::open(['route' => 'aparelhos.confirma', 'id' => 'ap_confirma', 'method' => 'post', 'autocomplete' => 'off'])}} 
        <input type="hidden" name="confirma_entrega" id='confirma_entrega' value="" />
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar Entrega</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-sm-6">
        <label for="">Quantidade</label>
        <input type="number" min="0" name="quantidade" size="1" id="quantidade" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        {{Form::submit('Confirmar', ['class' => 'btn btn-primary', 'id' => 'evento_submit'])}}
        {{Form::close()}} 
        {{-- <button type="button" class="btn btn-primary">Confirmar</button> --}}
      </div>
    </div>
  </div>
</div>