@extends('layouts.main') 
@section('title', 'Editar Aparelho')
@section('content')

 @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
       
        <style>

            .fs-1 {
                font-size: 20px;
            }

        </style>
    @endpush

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3>{{ __('Editar Aparelho')}}</h3></div>
                <div class="card-body">
                <form action="{{route('aparelhos.atualizar', [$aparelhos->id])}}" class="forms-sample" method="POST">
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="marca">{{ __('Marca')}}</label>                                
                                <input type="text" class="form-control" id="marca" name="marca" value="{{$aparelhos->marca}}" readonly>            
                            </div>
                            <div class="col-sm-5">
                                <label for="modelo">{{ __('Modelo')}}</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" value="{{$aparelhos->modelo}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="numero">{{ __('Número')}}</label>
                                <input type="text" class="form-control" id="numero" name="numero" value="{{$aparelhos->numero}}" readonly>
                                {{-- <select class="form-control" id="numero" name="numero" readonly>
                                    <option value="{{$aparelhos->numero}}" selected>{{$aparelhos->numero}}</option>
                                    @foreach ($numeros as $numero)
                                    <option value="{{$numero->numero}}">{{$numero->numero}}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                            <div class="col-sm-5">
                                <label for="num_serie">{{ __('Número Serie')}}</label>
                                <input type="text" class="form-control" id="num_serie" name="num_serie" value="{{$aparelhos->num_serie}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="estoque">{{ __('Estoque')}}</label>
                                <input type="number" class="form-control" id="estoque" name="estoque" value="{{$aparelhos->estoque}}">
                            </div>
                            <div class="col-sm-5">
                                <label for="dtentrrega">{{ __('Data Entrega')}}</label>
                                <div class="input-group input-daterange">
                                    {{-- <input type="date" class="form-control" id="dtentrega" name="dtentrega" @if($aparelhos->dt_entrega != '')value="{{date('d/m/Y', strtotime($aparelhos->dt_entrega))}}" @else value="{{''}}"@endif> --}}
                                    <input class="form-control" type="text" id="date1" name="date1" @if($aparelhos->dt_entrega != '')value="{{date('d/m/Y', strtotime($aparelhos->dt_entrega))}}" @else value="{{''}}"@endif required />
                                    <input id="data_inicial" name="data_inicial" type="hidden" @if($aparelhos->dt_entrega != '')value="{{date('Ymd', strtotime($aparelhos->dt_entrega))}}" @else value="{{''}}"@endif class="form-control" />
                                    <div class="input-group-append"><span class="input-group-text"  id="basic-addon2"><i class="fa fa-calendar"></i></span></div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">{{ __('Atualizar')}}</button>
                        <a href="{{ route ('aparelhos.listar') }}" class="btn btn-warning">{{ __('Cancelar')}}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/datatables.js') }}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="{{ asset('js/form-components.js') }}"></script>
        <script src="{{ asset('js/aparelhos/editar.js') }}"></script>
    @endpush
@endsection