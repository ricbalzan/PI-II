@extends('layouts.main') 
@section('title', 'Editar Fatura')
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
                <div class="card-header"><h3>{{ __('Editar Fatura')}}</h3></div>
                <div class="card-body">
                <form action="{{ route ('faturas.atualizar', $faturas->id)}}" class="forms-sample" method="POST">
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="numero">{{ __('Número')}}</label>                                
                                <input type="text" class="form-control" id="numero" name="numero" value="{{$faturas->numero}}" readonly>            
                                {{-- <select class="form-control" id="numero" name="numero" required>
                                    <option value="{{$numeros->numero}}" selected>{{$numeros->numero}}</option>
                                    @foreach ($nums as $num)
                                    <option value="{{$num->numero}}">{{$num->numero}}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                            <div class="col-sm-5">
                                <label for="dtinsercao">{{ __('Data de Inserção')}}</label>
                                {{-- <input type="text" class="form-control" id="dtinsercao" name="dtinsercao" value="{{$faturas->data_insercao}}"> --}}
                                <div class="input-group input-daterange">
                                    {{-- <input type="date" class="form-control" id="dtentrega" name="dtentrega" @if($aparelhos->dt_entrega != '')value="{{date('d/m/Y', strtotime($aparelhos->dt_entrega))}}" @else value="{{''}}"@endif> --}}
                                    <input class="form-control" type="text" id="date1" name="date1" @if($faturas->data_insercao != '')value="{{date('d/m/Y', strtotime($faturas->data_insercao))}}" @else value="{{''}}"@endif required />
                                    <input id="data_inicial" name="data_inicial" type="hidden" @if($faturas->data_insercao != '')value="{{date('Ymd', strtotime($faturas->data_insercao))}}" @else value="{{''}}"@endif class="form-control" />
                                    <div class="input-group-append"><span class="input-group-text"  id="basic-addon2"><i class="fa fa-calendar"></i></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="mes">{{ __('Mês')}}</label>
                                {{-- <input type="text" class="form-control" id="mes" name="mes" value="{{$faturas->mes}}" > --}}
                                <select class="form-control" name="mes" id="mes">
                                    @php setLocale(LC_ALL, 'pt-BR') @endphp
                                    <option value="{{$faturas->mes}}" selected>{{$faturas->mes_novo}}</option>
                                    <option value="1">jan</option>
                                    <option value="2">fev</option>
                                    <option value="3">mar</option>
                                    <option value="4">abr</option>
                                    <option value="5">mai</option>
                                    <option value="6">jun</option>
                                    <option value="7">jul</option>
                                    <option value="8">ago</option>
                                    <option value="9">set</option>
                                    <option value="10">out</option>
                                    <option value="11">nov</option>
                                    <option value="12">dez</option>
                                   
                                </select> 
                            </div>
                            <div class="col-sm-5">
                                <label for="valor">{{ __('Valor')}}</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" id="valor" name="valor" value="{{$faturas->valor}}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">{{ __('Atualizar')}}</button>
                        <a href="{{ route ('faturas.listar') }}" class="btn btn-warning">{{ __('Cancelar')}}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
        <script src="{{ asset('js/form-components.js') }}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src={{asset('plugins/maskmoney/maskMoney.min.js')}}></script>
        <script src="{{ asset('js/faturas/editar.js') }}"></script>
        {{-- <script>
            $(function(){
                $('#valor').maskMoney({
                  prefix:'R$ ',
                  allowNegative: true,
                  thousands:'.', decimal:',',
                  affixesStay: true});
            })
        </script> --}}
    @endpush
@endsection