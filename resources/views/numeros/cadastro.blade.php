@extends('layouts.main') 
@section('title', 'Cadastro Número')
@section('content')

@push('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  
@endpush

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3>{{ __('Cadastro de Número')}}</h3></div>
                <div class="card-body">
                <form action="{{ route ('numeros.salvar') }}" class="forms-sample" method="POST">
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="numero">{{ __('Número')}}</label>                           
                                <input type="text" class="form-control" id="numero" name="numero" value="" required>                           
                            </div>
                            <div class="col-sm-6">
                                <label for="nome">{{ __('Nome Cliente')}}</label>
                                 <select class="form-control nome" id="nome" name="nome" onchange="buscaNome();">
                                    <option value="" selected>Selecione</option>
                                    @foreach($nomes as $nome)
                                    <option value="{{$nome->id}}">{{$nome->name}}</option>  
                                    @endforeach     
                                 </select>  
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="sim">{{ __('SIM')}}</label>                           
                                <input type="text" class="form-control" id="sim" name="sim" value="" required>                           
                            </div>
                            <div class="col-sm-6">
                                <label for="cpf">{{ __('Cpf')}}</label>
                                
                                <input type="text" class="form-control" id="cpf" name="cpf" value="" required>
                            </div>
                        </div>
                        <div class="col-sm-1">
                                <label hidden for="dtcadastro">{{ __('Data Cadastro')}}</label>
                                <input hidden type="text" class="form-control" id="dtcadastro" name="dtcadastro" value="{{date('Ymd')}}">
                            </div>
                        <button type="submit" class="btn btn-primary mr-2">{{ __('Cadastrar')}}</button>
                        <a href="{{ route ('numeros.listar') }}" class="btn btn-warning">{{ __('Cancelar')}}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
        <script src="{{ asset('js/form-components.js') }}"></script>
        <script src="{{ asset('js/numeros/cadastro.js') }}"></script>
        <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
        <script>
            $(document).ready(function() {
            $('.num').select2();
            });
        </script>
        <script>
            $(document).ready(function(){
            $('#sim').mask('00000000000000000000');
            $('#numero').mask('(00) 0 0000-0000');
            {{-- $('#cpf').mask('000.000.000-00'); --}}
            
        });
        </script>
    @endpush
@endsection