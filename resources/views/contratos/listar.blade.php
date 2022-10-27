@extends('layouts.main') 
@section('title', 'Contratos')
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
    @include('modals.contratos')
    <form action="#" class="forms-sample" id="validate-form" method="post" autocomplete="off">
        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
        
        
        @include('include.message')
        
        @yield('content')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-block">
                        
                        <a type="button" style="float: left" class="btn btn-primary" href="{{ route ('contratos.cadastro') }}">Novo Contrato</a>
                        <div><h4 style="text-align: center; font-weight:900;">Contratos</h4></div>
                    </div>
                    
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table id="simpletable"
                                   class="table table-striped table-bordered nowrap text-center">
                                <thead>
                                <tr>
                                    <th>{{ __('Contrato Nº')}}</th>
                                    <th>{{ __('Nome')}}</th>
                                    <th>{{__('Cpf')}}</th>
                                    <th>{{ __('Número')}}</th>
                                    <th>{{ __('Ativo')}}</th>
                                    <th>{{ __('Dt Inativação')}}</th>
                                    <th>{{ __('Ações')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($contratos))
                                @foreach($contratos as $contrato)                              
                                    <tr class="font-weight-bold">
                                        <td>@if($contrato->deleted_at <> '')<font color="gainsboro">{{$contrato->id}}@else<font color="black">{{$contrato->id}}@endif</td>
                                        <td>@if($contrato->deleted_at <> '')<font color="gainsboro">{{$contrato->user->name}}@else<font color="black">{{$contrato->user->name}}@endif</td>
                                        <td>@if($contrato->deleted_at <> '')<font color="gainsboro">{{$contrato->cpf}}@else<font color="black">{{$contrato->cpf}}@endif</td>
                                        <td>@if($contrato->deleted_at <> '')<font color="gainsboro">{{$contrato->numero}}@else<font color="black">{{$contrato->numero}}@endif</td>  
                                        <td>@if($contrato->deleted_at <> '')<font color="gainsboro">{{'Não'}}@else{{'Sim'}}@endif</td>  
                                        <td>@if($contrato->deleted_at <> '')<font color="gainsboro">{{date('d/m/Y', strtotime($contrato->deleted_at))}}@else{{''}}@endif</td>                                                                              
                                        <td>
                                            @if($contrato->deleted_at == '')
                                            <a id="var" href="{{route('contratos.imprimir', [$contrato->id])}}" class=""><i data-toggle="tooltip" data-placement="right" title="Imprimir" class="fa fa-print text-success fs-1 mr-1"></i></a>
                                            <a id="var" href="#" onclick="return openModal('{{$contrato->id}}')" data-toggle="modal" data-target="#modal_contrato" class=""><i data-toggle="tooltip" data-placement="right" title="Visualizar Contrato" class="fa fa-eye text-primary fs-1 mr-1"></i></a>
                                            @else {{'-'}}
                                            @endif
                                            {{-- <a id="glyphicon-edit" href="{{route('contratos.editar', [$contrato->id])}}"><i data-toggle="tooltip" data-placement="right" title="Editar Contrato" class="fa fa-edit text-warning fs-1 mr-1"></i></a>      --}}
                                            @if($contrato->deleted_at == '')
                                            <a id="glyphicon-remove" onclick="return confirm('Deseja realmente inativar este Contrato ?');" href="{{route('contratos.remove', [$contrato->id])}}"><i data-toggle="tooltip" data-placement="right" title="Inativar Contrato" class="ik ik-minus-circle text-danger fs-1"></i></a>
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
        <script src="{{ asset('js/contratos/contratos.js') }}"></script>
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