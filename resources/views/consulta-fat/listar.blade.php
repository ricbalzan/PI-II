@extends('layouts.main') 
@section('title', 'Consulta Faturas')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">

        <style>

            .fs-1 {
                font-size: 20px;
            }

        </style>
    @endpush
    
<div class="container-fluid">
    
    <form action="{{route('faturas.lista_faturas')}}" class="forms-sample" id="validate-form" method="post" autocomplete="off">
        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
        
        
        @include('include.message')
        
        @yield('content')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-block">
                        
                        {{-- <a type="button" style="float: left" class="btn btn-primary" href="{{ route ('aparelhos.cadastro') }}">Novo Aparelho</a> --}}
                        <div><h4 style="text-align: center; font-weight:900;">Consulta Fatura</h4></div>
                    </div>
                    <div class="card-header align-items-end">
                        <div class="col-sm-4">
                            <label for="numero">Número</label>
                            {{-- <input type="text" class="form-control" id="numero" name="numero"> --}}
                            <select class="form-control" id="numero" name="numero">
                                <option value="">Selecione</option>
                                @foreach($numeros as $numero)
                                <option value="{{$numero->numero}}">{{$numero->numero}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4 pl-0">
                            <button type="submit" class="btn btn-success h-auto">Buscar</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table id="simpletable"
                                   class="table table-striped table-bordered nowrap text-center">
                                <thead>
                                <tr>
                                    <th>{{ __('Nome')}}</th>
                                    <th>{{__('Número')}}</th>
                                    <th>{{ __('Mês Fat')}}</th>
                                    <th>{{ __('Valor')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($faturas))
                                @foreach($faturas as $fatura)                              
                                    <tr>
                                        <td>{{$fatura->user->name}}</td>
                                        <td>{{$fatura->numero}}</td>
                                        <td>{{$fatura->mes}}</td> 
                                        <td>{{$fatura->valor}}</td> 
                                    </tr>            
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Language - Comma Decimal Place table end -->
            </div>
        </div>
    </form> 
</div>
               

    <!-- push external js -->

    @push('script')
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/datatables.js') }}"></script>
        <script src="{{ asset('js/consulta-fat/consulta-fat.js') }}"></script>
        <script>
            $(document).ready(function() {

            window.setTimeout(function() {
                $(".alert").fadeTo(500, 200).slideUp(1000, function() {
                    $(this).remove();
                });
            }, 5000);

            });
        </script>
    @endpush
@endsection