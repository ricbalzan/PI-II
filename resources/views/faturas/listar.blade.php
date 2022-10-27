@extends('layouts.main') 

@section('title', 'Faturas')
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
    @include('modals.faturas')
    <form action="{{ route ('faturas.cadastro') }}" class="forms-sample" id="validate-form" method="post" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
        
        
        @include('include.message')
        
        @yield('content')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-block">
                        <a type="button" style="float: left" class="btn btn-secondary" href="{{ route ('faturas.lancamento') }}">Nova Fatura Manual</a>
                        {{-- <label for="xml">Escolha o Arquivo</label> --}}
                        <input type="file" name="xml" id="xml" required>
                        <button type="submit" class="btn btn-primary mr-2">Importar XML</button>
                        <a type="button" style="float: left" class="btn btn-success ml-2 mr-2" href="{{ route ('faturas.txt') }}">Gerar TXT</a>
                        {{-- <div><h4 class="ml-5" style="text-align: center; font-weight:900;">Faturas</h4></div> --}}
                    </div>
                    <div class="card-header d-block">
                    
                        <div><h4 class="ml-5" style="text-align: center; font-weight:900;">Faturas</h4></div>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table id="simpletable"
                                   class="table table-striped table-bordered nowrap text-center">
                                <thead>
                                <tr>
                                    <th>{{ __('Nome')}}</th>
                                    <th>{{ __('Número')}}</th>
                                    <th>{{__('Vencimeto')}}</th>
                                    <th>{{ __('Mês Fat')}}</th>
                                    <th>{{ __('Valor')}}</th>
                                    <th>{{ __('Ações')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($faturas))
                                @foreach($faturas as $fatura)                              
                                    <tr>
                                        <td>{{$fatura->name}}</td>
                                        <td>{{$fatura->numero}}</td>
                                        <td>{{date('d/m/Y', strtotime($fatura->data_insercao))}}</td>
                                        <td>{{$fatura->mes}}</td> 
                                        <td>{{$fatura->valor}}</td>                                          
                                        <td>
                                            {{-- <a id="var" href="{{route('faturas.txt')}}" class=""><i data-toggle="tooltip" data-placement="right" title="Gerar TXT" class="ik ik-file-text text-success fs-1 mr-1"></i></a> --}}
                                            <a id="var" href="#" onclick="return openModal('{{$fatura->id}}')" data-toggle="modal" data-target="#modal_fatura" class=""><i data-toggle="tooltip" data-placement="right" title="Visualizar Fatura" class="fa fa-eye text-primary fs-1 mr-1"></i></a>
                                            <a id="glyphicon-edit" href="{{route('faturas.editar', [$fatura->id])}}"><i data-toggle="tooltip" data-placement="right" title="Editar Fatura" class="fa fa-edit text-warning fs-1 mr-1"></i></a>     
                                            <a id="glyphicon-remove" onclick="return confirm('Deseja realmente excluir esta Fatura ?');" href="{{route('faturas.remove', [$fatura->id])}}"><i data-toggle="tooltip" data-placement="right" title="Excluir Fatura" class="fa fa-trash text-danger fs-1"></i></a>
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
        <script src="{{ asset('js/faturas/faturas.js') }}"></script>
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