@extends('layouts.main') 
@section('title', 'Cadastra Aparelho')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3>{{ __('Cadastro de Aparelho')}}</h3></div>
                <div class="card-body">
                <form action="{{route('aparelhos.salvar')}}" class="forms-sample" method="POST">
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="marca">{{ __('Marca')}}</label>                           
                                <input type="text" class="form-control" id="marca" name="marca" value="">                           
                            </div>
                            <div class="col-sm-5">
                                <label for="modelo">{{ __('Modelo')}}</label>                           
                                <input type="text" class="form-control" id="modelo" name="modelo" value="">                           
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="numero">{{ __('Número')}}</label>  
                                <select class="form-control" id="numero" name="numero">
                                    <option value="" selected>Selecione</option>
                                    @foreach($numeros as $numero)
                                    <option value="{{$numero->id}}">{{$numero->numero}}</option>
                                    @endforeach
                                </select>                         
                                {{-- <input type="text" class="form-control" id="numero" name="numero" value="">                            --}}
                            </div>
                            <div class="col-sm-5">
                                <label for="num_serie">{{ __('Número de Série')}}</label>
                                <input type="text" class="form-control" id="num_serie" name="num_serie" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="estoque">{{ __('Estoque')}}</label>
                                <input type="number" class="form-control" id="estoque" name="estoque" value="">
                            </div>
                            <div class="col-sm-5">
                                <label for="dtentrega">{{ __('Data de Entrega')}}</label>
                                <input type="date" class="form-control" id="dtentrega" name="dtentrega" value="" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">{{ __('Cadastrar')}}</button>
                        <a href="{{ route ('aparelhos.listar') }}" class="btn btn-warning">{{ __('Cancelar')}}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
        <script src="{{ asset('js/form-components.js') }}"></script>
        <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
        <script>
            $(document).ready(function(){
            $('#sim').mask('00000000000000000000');
            {{-- $('#numero').mask('(00) 0 0000-0000'); --}}
            $('#cpf').mask('000.000.000-00');
            
        });
        </script>
    @endpush
@endsection