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
                    <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="pill" href="#menu1">Cadastro de Clientes Pessoa Física</a></li>
                    <li class="nav-item"><a class="nav-link"  data-toggle="pill"role="tab" href="#menu2">Cadastro de Clientes Pessoa Jurídica</a></li>
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
                                <h1>{{ __('CONTRATO DE COMODATO E CONTRATAÇÃO DO SERVIÇO MÓVEL PESSOAL')}}</h1>
                            </div>
                        </div>
                        <br><br><br>
                        <p>
                        De um lado,<br><br>
                        AGROARAÇÁ INDUSTRIA DE ALIMENTOS LTDA., estabelecida na RS 324 KM 270,5, Bairro Villa Zucchetti, na cidade de <br>
                        Nova Araçá (RS), inscrita no CNPJ sob o nº 04.239.719/0001-30, denominada COMODANTE.<br><br>
                            e de outro,<br><br>
                        <b>{{$contratos[0]->user->name}}</b>, CPF Nº <b>{{$contratos[0]->cpf}}</b>, residente e domiciliado na <b>{{$contratos[0]->user->endereco}}</b>, <b>{{$contratos[0]->user->cidade}}</b>, ora denominado apenas COMODATÁRIO.<br><br>
                        Tem entre si como justo e contratado, o dispositivo nas cláusulas que seguem:<br><br>
                        O COMODATÁRIO declara e aceita que:<br><br>
                        1 - Recebeu 1 (uma) linha de celular de nº <b>{{$contratos[0]->numero}}</b> de propriedade da COMODANTE para seu uso exclusivo;<br><br>
                        2 - Todo o valor originado da linha acima é de sua responsabilidade, cujo valor será descontado mensalmente de sua folha de pagamento. O COMODATÁRIO desde já autoriza o referido desconto.
                        3 - Em caso de inadimplência por qualquer motivo, será feito o bloqueio imediato da linha.<br><br>
                        4 - Utilizará a linha em questão pelo prazo mínimo de 24 meses a partir da assinatura do presente. Em caso de devolução
                         da linha em período inferior a 24 meses será aplicada de forma pró-rata multa proporcional ao desconto oferecido no
                          pacote. O desconto, bem como sua fidelidade, será renovado automaticamente pelo mesmo período se não houver 
                          manifestação contrária do COMODATÁRIO.<br><br>
                        5 - Em caso de desligamento da empresa a linha será devolvida a COMODANTE, bem como, liquidará toda e qualquer 
                        pendência financeira referente ao objeto do presente.<br><br>
                        6 - A COMODANTE poderá solicitar a devolução e ou o bloqueio da linha a qualquer momento.<br><br>
                            Fica eleito o Foro da Comarca de Casca, RS, para dirimir qualquer dúvida oriunda do presente contrato, não obstante a idoneidade e sinceridade do propósito de ambas as partes.<br><br>
                            Sendo descumprida qualquer uma das cláusulas acima mencionadas, o contrato ficara automaticamente rescindido, não tendo o COMODATÁRIO nenhum direito sobre a linha.<br><br>
                                E por assim estarem, justas e contratadas, as Partes firmam o presente Contrato em 02 (duas) vias de igual teor e forma.<br><br><br>
                                @php setlocale (LC_ALL, 'pt-BR'); @endphp
                                Nova Araçá (RS), {{date('d')}}  de {{strftime('%B')}} de {{date('Y')}}

                        </p>
                        <br><br><br><br>
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span>________________________________________________________________________________________________</span>
                                    <br>
                                    <span>AGROARAÇÁ INDUSTRIA DE ALIMENTOS LTDA.</span>
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