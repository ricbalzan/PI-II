@extends('layouts.main') 
@section('title', 'Editar Contrato')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3>{{ __('Editar Contrato')}}</h3></div>
                <div class="card-body">
                <form action="" class="forms-sample" method="POST">
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="numero">{{ __('Contrato Nº')}}</label>                                
                                <input type="text" class="form-control" id="numero" name="numero" value="" readonly>            
                            </div>
                            <div class="col-sm-7">
                                <label for="nome">{{ __('Nome')}}</label>
                                {{-- <input type="text" class="form-control" id="nome" name="nome" value="{{$contratos->dt_cadastro}}"> --}}
                                <select class="form-control nome" id="nome" name="nome" onchange="buscaNome();">
                                    {{-- <option value="" selected>{{$contratos[0]->user->name}}</option>  --}}
                                    @foreach($nomes as $nome)
                                    <option value="{{$nome->id}}">{{$nome->name}}</option>  
                                    @endforeach     
                                </select> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="sim">{{ __('Número')}}</label>
                                {{-- <input type="text" class="form-control" id="sim" name="sim" value="{{$contratos[0]->numero}}"> --}}
                                <select id="numero" name="numero" type="text" class="form-control num" required>
                                </select>  
                            </div>
                            <div class="col-sm-5">
                                <label for="cpf">{{ __('Cpf Titular Número')}}</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" value="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">{{ __('Atualizar')}}</button>
                        <a href="{{ route ('contratos.listar') }}" class="btn btn-warning">{{ __('Cancelar')}}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
        <script src="{{ asset('js/form-components.js') }}"></script>
        <script src="{{ asset('js/contratos/editar.js') }}"></script>
    @endpush
@endsection