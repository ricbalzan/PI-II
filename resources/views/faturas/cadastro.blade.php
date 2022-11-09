@extends('layouts.main') 
@section('title', 'Lançar Fatura')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3>{{ __('Lançar Fatura')}}</h3></div>
                <div class="card-body">
                <form action="{{route('faturas.salvar')}}" class="forms-sample" method="POST">
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="numero_fat">{{ __('Número')}}</label>                           
                                {{-- <input type="text" class="form-control" id="numero_fat" name="numero_fat" value="">                            --}}
                                <select class="form-control" id="numero" name="numero" required>
                                    <option value="" selected>Selecione</option>
                                    @foreach ($numeros as $numero)
                                    <option value="{{$numero->id}}">{{$numero->numero}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="clo-sm-5">
                                <label hidden for="dtinsercao">{{ __('Data Insercao')}}</label>
                                <input hidden type="text" class="form-control" id="dtinsercao" name="dtinsercao" value="{{date('Ymd')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label for="mes">{{ __('Mês da Fatura')}}</label>                           
                                <select class="form-control" name="mes" id="mes">
                                    @php setLocale(LC_ALL, 'pt-BR') @endphp
                                    <option value="{{date('m')}}" selected>{{strftime('%b')}}</option>
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
                            <div class="col-sm-6">
                                <label for="valor">{{ __('Valor')}}</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                    <input type="text" class="form-control" id="valor" name="valor" value="">
                                </div>
                                
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">{{ __('Cadastrar')}}</button>
                        <a href="{{ route ('faturas.listar') }}" class="btn btn-warning">{{ __('Cancelar')}}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
        <script src="{{ asset('js/form-components.js') }}"></script>
        <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
        <script src={{asset('plugins/maskmoney/maskMoney.min.js')}}></script>
        <script>
            $(document).ready(function(){
            $('#sim').mask('000000');
            {{-- $('#numero').mask('(00) 0 0000-0000'); --}}
          
            
        });
        </script>
        <script>
        $(function(){
            $('#valor').maskMoney({
              //prefix:'R$ ',
              allowNegative: true,
              thousands:'.', decimal:',',
              affixesStay: true});
        })
    </script>
    @endpush
@endsection