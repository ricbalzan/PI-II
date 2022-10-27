@extends('layouts.main') 
@section('title', 'Editar Número')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3>{{ __('Editar Número')}}</h3></div>
                <div class="card-body">
                <form action="{{ route ('numeros.atualizar', $numeros->id)}}" class="forms-sample" method="POST">
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="numero">{{ __('Número')}}</label>                                
                                <input type="text" class="form-control" id="numero" name="numero" value="{{$numeros->numero}}">            
                                {{-- <select class="form-control" id="numero" name="numero" required>
                                    <option value="{{$numeros->numero}}" selected>{{$numeros->numero}}</option>
                                    @foreach ($nums as $num)
                                    <option value="{{$num->numero}}">{{$num->numero}}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                            {{-- <div class="col-sm-4">
                                <label for="dtcadastro">{{ __('Data de Cadastro')}}</label>
                                <input type="text" class="form-control" id="dtcadastro" name="dtcadastro" value="{{$numeros->dt_cadastro}}">
                            </div> --}}
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="sim">{{ __('SIM')}}</label>
                                <input type="text" class="form-control" id="sim" name="sim" value="{{$numeros->sim}}" readonly>
                            </div>
                            <div class="col-sm-5">
                                <label for="cpf">{{ __('Cpf Titular Número')}}</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" value="{{$numeros->cpf}}" readonly>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">{{ __('Atualizar')}}</button>
                        <a href="{{ route ('numeros.listar') }}" class="btn btn-warning">{{ __('Cancelar')}}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
        <script src="{{ asset('js/form-components.js') }}"></script>
    @endpush
@endsection