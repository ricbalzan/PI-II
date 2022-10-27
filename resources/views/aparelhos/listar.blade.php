@extends('layouts.main') 
@section('title', 'Aparelhos')
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
    @include('modals.confirma-entrega')
    @include('modals.aparelhos')
    <form action="#" class="forms-sample" id="validate-form" method="post" autocomplete="off">
        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
               
        @include('include.message')
        
        @yield('content')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-block">
                        
                        <a type="button" style="float: left" class="btn btn-primary" href="{{ route ('aparelhos.cadastro') }}">Novo Aparelho</a>
                        <div><h4 style="text-align: center; font-weight:900;">Aparelhos</h4></div>
                    </div>
                    
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table id="simpletable"
                                   class="table table-striped table-bordered nowrap text-center">
                                <thead>
                                <tr>
                                    <th>{{ __('Marca')}}</th>
                                    <th>{{__('Modelo')}}</th>
                                    <th>{{ __('Número')}}</th>
                                    <th>{{ __('Estoque')}}</th>
                                    <th>{{ __('Dt Entrega')}}</th>
                                    <th>{{ __('Ativo')}}</th>
                                    <th>{{ __('Dt Inativação')}}</th>
                                    <th>{{ __('Ações')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($aparelhos))
                                @foreach($aparelhos as $aparelho)                              
                                    <tr>
                                        <td>@if($aparelho->deleted_at <> '')<font color="gainsboro">{{$aparelho->marca}}@else<font color="black">{{$aparelho->marca}}@endif</td>
                                        <td>@if($aparelho->deleted_at <> '')<font color="gainsboro">{{$aparelho->modelo}}@else<font color="black">{{$aparelho->modelo}}@endif</td>
                                        <td>@if($aparelho->deleted_at <> '')<font color="gainsboro">{{$aparelho->numero}}@else<font color="black">{{$aparelho->numero}}@endif</td> 
                                        <td>@if($aparelho->deleted_at <> '')<font color="gainsboro">{{$aparelho->estoque}}@else<font color="black">{{$aparelho->estoque}}@endif</td>
                                        <td>@if($aparelho->deleted_at <> '')<font color="gainsboro">{{date('d/m/Y', strtotime($aparelho->dt_entrega))}}@else<font color="black">{{date('d/m/Y', strtotime($aparelho->dt_entrega))}}@endif</td>                                          
                                        <td>@if($aparelho->deleted_at <> '')<font color="gainsboro">{{'Não'}}@else{{'Sim'}}@endif</td>
                                        <td>@if($aparelho->deleted_at <> '')<font color="gainsboro">{{date('d/m/Y', strtotime($aparelho->deleted_at))}}@else{{''}}@endif</td>
                                        <td>
                                            @if($aparelho->deleted_at == '')
                                            <a id="var" href="" class="" onclick="return confirmaEntrega('{{$aparelho->id}}');" data-toggle="modal" data-target="#entrega" ><i data-toggle="tooltip" data-placement="right" title="Confirmar Entrega" class="fa fa-check text-success fs-1 mr-1"></i></a>
                                            <a id="var" href="#" onclick="return openModal('{{$aparelho->id}}');" data-toggle="modal" data-target="#modal_aparelhos" class=""><i data-toggle="tooltip" data-placement="right" title="Visualizar Aparelho" class="fa fa-eye text-primary fs-1 mr-1"></i></a>
                                            <a id="glyphicon-edit" href="{{route('aparelhos.editar', [$aparelho->id])}}"><i data-toggle="tooltip" data-placement="right" title="Editar Aparelho" class="fa fa-edit text-warning fs-1 mr-1"></i></a>     
                                            <a id="glyphicon-remove" onclick="return confirm('Deseja realmente inativar este Aparelho ?');" href="{{route('aparelhos.remove', [$aparelho->id])}}"><i data-toggle="tooltip" data-placement="right" title="Inativar Cadastro" class="ik ik-minus-circle text-danger fs-1"></i></a>
                                            @else {{''}}
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
        <script src="{{ asset('js/aparelhos/aparelhos.js') }}"></script>
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