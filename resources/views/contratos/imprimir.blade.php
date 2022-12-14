@extends('layouts.main2') 
@section('title', 'Imprimir')
@section('content')

@push('head')

<style>
        @media print  {

body * {
  
  background-color: #fff;
  visibility: hidden;

}
#printable, #printable * {
  
  background-color: #fff;
  visibility: visible;

}
#printable {
  
  background-color: #fff;
  position: fixed;
  left: 45px;
  top: 95px;
  
}
        }
.letra {
    font-size: 18px;
}
    </style>
@endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-printer bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{__('')}}</h5>
                            <!-- <span>{{ __('lorem ipsum dolor sit amet, consectetur adipisicing elit')}}</span> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                
                    @if (Session::has('success'))
                        <h3>{{ Session::get('success') }}</h3>
                    @endif
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.dados')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('contratos.listar')}}">{{ __('Contratos')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Imprimir')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <!-- <ul class="nav nav-pills"  role="tablist">
                    <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="pill" href="#menu1">Cadastro de Clientes Pessoa F??sica</a></li>
                    <li class="nav-item"><a class="nav-link"  data-toggle="pill"role="tab" href="#menu2">Cadastro de Clientes Pessoa Jur??dica</a></li>
                </ul> -->
                
                <div class="tab-content">
                    <div id="menu1" class="card-body">
                    <div class="card-head"><h3></h3></div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <button  class="btn btn-success mr-2" onclick="window.print()">{{ __('Imprimir')}}</button>
                            <a type="button" href="{{route('contratos.listar')}}" class="btn btn-warning">{{ __('Voltar')}}</a>
                        </div>
                    </div>
                    <br><br>
                    <div class="container" id="printable">
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <h1>{{ __('CONTRATO DE COMODATO E CONTRATA????O DO SERVI??O M??VEL PESSOAL')}}</h1>
                            </div>
                        </div>
                        <br><br><br>
                        <p>
                        De um lado,<br><br>
                        AGROARA???? INDUSTRIA DE ALIMENTOS LTDA., estabelecida na RS 324 KM 270,5, Bairro Villa Zucchetti, na cidade de <br>
                        Nova Ara???? (RS), inscrita no CNPJ sob o n?? 04.239.719/0001-30, denominada COMODANTE.<br><br>
                            e de outro,<br><br>
                        <b>{{$contratos[0]->user->name}}</b>, CPF N?? <b>{{$contratos[0]->cpf}}</b>, residente e domiciliado na <b>{{$contratos[0]->user->endereco}}</b>, <b>{{$contratos[0]->user->cidade}}</b>, ora denominado apenas COMODAT??RIO.<br><br>
                        Tem entre si como justo e contratado, o dispositivo nas cl??usulas que seguem:<br><br>
                        O COMODAT??RIO declara e aceita que:<br><br>
                        1 - Recebeu 1 (uma) linha de celular de n?? <b>{{$contratos[0]->numero}}</b> de propriedade da COMODANTE para seu uso exclusivo;<br><br>
                        2 - Todo o valor originado da linha acima ?? de sua responsabilidade, cujo valor ser?? descontado mensalmente de sua folha de pagamento. O COMODAT??RIO desde j?? autoriza o referido desconto.
                        3 - Em caso de inadimpl??ncia por qualquer motivo, ser?? feito o bloqueio imediato da linha.<br><br>
                        4 - Utilizar?? a linha em quest??o pelo prazo m??nimo de 24 meses a partir da assinatura do presente. Em caso de devolu????o
                         da linha em per??odo inferior a 24 meses ser?? aplicada de forma pr??-rata multa proporcional ao desconto oferecido no
                          pacote. O desconto, bem como sua fidelidade, ser?? renovado automaticamente pelo mesmo per??odo se n??o houver 
                          manifesta????o contr??ria do COMODAT??RIO.<br><br>
                        5 - Em caso de desligamento da empresa a linha ser?? devolvida a COMODANTE, bem como, liquidar?? toda e qualquer 
                        pend??ncia financeira referente ao objeto do presente.<br><br>
                        6 - A COMODANTE poder?? solicitar a devolu????o e ou o bloqueio da linha a qualquer momento.<br><br>
                            Fica eleito o Foro da Comarca de Casca, RS, para dirimir qualquer d??vida oriunda do presente contrato, n??o obstante a idoneidade e sinceridade do prop??sito de ambas as partes.<br><br>
                            Sendo descumprida qualquer uma das cl??usulas acima mencionadas, o contrato ficara automaticamente rescindido, n??o tendo o COMODAT??RIO nenhum direito sobre a linha.<br><br>
                                E por assim estarem, justas e contratadas, as Partes firmam o presente Contrato em 02 (duas) vias de igual teor e forma.<br><br><br>
                                @php setlocale (LC_ALL, 'pt-BR'); @endphp
                                Nova Ara???? (RS), {{date('d')}}  de {{strftime('%B')}} de {{date('Y')}}

                        </p>
                        <br><br><br><br>
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span>________________________________________________________________________________________________</span>
                                    <br>
                                    <span>AGROARA???? INDUSTRIA DE ALIMENTOS LTDA.</span>
                                </div>
                            </div>
                            <br><br><br><br>
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span>________________________________________________________________________________________________</span>
                                    <br>
                                    <span>{{$contratos[0]->user->name}}</span>
                                </div>
                            </div>
                            <br><br><br>
                    </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <button  class="btn btn-success mr-2" onclick="window.print()">{{ __('Imprimir')}}</button>
                                <a type="button" href="{{route('contratos.listar')}}" class="btn btn-warning">{{ __('Voltar')}}</a>
                            </div>
                        </div>                       
                    
                </div>
            </div>
        </div>
    </div>
    
    <!-- push external js -->
    @push('script')
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
    $('#telefone1').mask('(00) 0 0000-0000');
    $('#telefone2').mask('(00) 0 0000-0000');
    $('#celular').mask('00000000000');
    $('#whats').mask('(00) 0 0000-0000');
    $('#cpf').mask('000.000.000-00');
    $('#cnpj').mask('00.000.000/0000-00');
    $('#cep').mask('00000-000');
});
</script>
<script>
    $(document).ready(function() {

window.setTimeout(function() {
    $(".alert").fadeTo(500, 200).slideUp(1000, function() {
        $(this).remove();
    });
}, 5000);

});
</script>

<script type="text/javascript" >
function handleform(elm)
{
window.location = elm.value+".html";
}
</script>
        <script src="{{ asset('js/form-components.js') }}"></script>

    @endpush
@endsection