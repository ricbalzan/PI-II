@extends('layouts.main') 

@section('title', 'Números')
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
    @include('modals.numeros')
    <form action="#" class="forms-sample" id="validate-form" method="post" autocomplete="off">
        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
        
        
        @include('include.message')
        
        @yield('content')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-block">
                        
                        <a type="button" style="float: left" class="btn btn-primary" href="{{ route ('numeros.cadastro') }}">Novo Número</a>
                        <div><h4 style="text-align: center; font-weight:900;">Números</h4></div>
                    </div>
                    
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table id="simpletable"
                                   class="table table-striped table-bordered nowrap text-center">
                                <thead>
                                <tr>
                                    <th>{{ __('Nome')}}</th>
                                    <th>{{__('Cpf')}}</th>
                                    <th>{{ __('Número')}}</th>
                                    <th>{{ __('SIM')}}</th>
                                    <th>{{ __('Data Cadastro')}}</th>
                                    <th>{{ __('Ativo')}}</th>
                                    <th>{{ __('Data Inativação')}}</th>
                                    <th>{{ __('Ações')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($numeros))
                                @foreach($numeros as $numero)                              
                                    <tr>
                                        <td>@if($numero->deleted_at <> '')<font color="gainsboro">{{$numero->user->name}}@else<font color="black">{{$numero->user->name}}@endif</td>
                                        <td>@if($numero->deleted_at <> '')<font color="gainsboro">{{$numero->cpf}}@else<font color="black">{{$numero->cpf}}@endif</td>
                                        <td>@if($numero->deleted_at <> '')<font color="gainsboro">{{$numero->numero}}@else<font color="black"></font>{{$numero->numero}}@endif</td>
                                        <td>@if($numero->deleted_at <> '')<font color="gainsboro">{{$numero->sim}}@else<font color="black">{{$numero->sim}}@endif</td> 
                                        <td>@if($numero->deleted_at <> '')<font color="gainsboro">{{date('d/m/Y',strtotime($numero->dt_cadastro))}}@else<font color="black">{{date('d/m/Y',strtotime($numero->dt_cadastro))}}@endif</td>                                          
                                        <td>@if($numero->deleted_at <> '')<font color="gainsboro">{{'Não'}}@else{{'Sim'}}@endif</td>  
                                        <td>@if($numero->deleted_at <> '')<font color="gainsboro">{{date('d/m/Y', strtotime($numero->deleted_at))}}@else{{''}}@endif</td>
                                        <td>
                                            @if($numero->deleted_at == '')
                                            <a id="var" href="#" onclick="return openModal('{{$numero->id}}')" data-toggle="modal" data-target="#modal_num" class=""><i data-toggle="tooltip" data-placement="right" title="Visualizar Número" class="fa fa-eye text-primary fs-1 mr-1"></i></a>
                                            <a id="glyphicon-edit" href="{{route('numeros.editar', [$numero->id])}}"><i data-toggle="tooltip" data-placement="right" title="Editar Número" class="fa fa-edit text-warning fs-1 mr-1"></i></a>     
                                            <a id="glyphicon-remove" onclick="return confirm('Deseja realmente inativar este Número ?');" href="{{route('numeros.remove', [$numero->id])}}"><i data-toggle="tooltip" data-placement="right" title="Inativar Número" class="ik ik-minus-circle text-danger fs-1"></i></a>
                                            @else {{'-'}}
                                            @endif
                                        </td>
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
        <script src="{{ asset('js/numeros/numeros.js') }}"></script>
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