@extends('layouts.main') 
@section('title', 'Estoque Aparelhos')
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
    
    <form action="{{route('aparelhos.lista_estoque')}}" class="forms-sample" id="validate-form" method="post" autocomplete="off">
        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
        
        
        @include('include.message')
        
        @yield('content')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-block">
                        
                        {{-- <a type="button" style="float: left" class="btn btn-primary" href="{{ route ('aparelhos.cadastro') }}">Novo Aparelho</a> --}}
                        <div><h4 style="text-align: center; font-weight:900;">Aparelhos em Estoque</h4></div>
                    </div>
                    <div class="card-header align-items-end">
                        <div class="col-sm-4">
                            <label for="aparelho">Aparelho</label>
                            {{-- <input type="text" class="form-control" id="aparelho" name="aparelho"> --}}
                            <select class="form-control" id="aparelho" name="aparelho">
                                <option value="">Selecione</option>
                                @foreach($aparelhos as $aparelho)
                                <option value="{{$aparelho->id}}">{{$aparelho->marca.' / '.$aparelho->modelo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4 pl-0">
                            <button type="submit" class="btn btn-success h-auto">Buscar</button>
                        </div>
                    </div>
    </form> 
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table id="simpletable"
                                   class="table table-striped table-bordered nowrap text-center">
                                <thead>
                                <tr>
                                    <th>{{ __('Marca')}}</th>
                                    <th>{{__('Modelo')}}</th>
                                    <th>{{ __('Número Série')}}</th>
                                    <th>{{ __('Estoque')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($aps))
                                @foreach($aps as $ap)                              
                                    <tr>
                                        <td>{{$ap->marca}}</td>
                                        <td>{{$ap->modelo}}</td>
                                        <td>{{$ap->num_serie}}</td> 
                                        <td>{{$ap->estoque}}</td> 
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
    
</div>
               

    <!-- push external js -->

    @push('script')
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/datatables.js') }}"></script>
        <script src="{{ asset('js/aparelhos/estoque.js') }}"></script>
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