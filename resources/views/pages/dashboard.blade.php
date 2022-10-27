@extends('layouts.main3') 
@section('title', 'Dashboard')
@section('content')
    <!-- push external head elements to head -->
    @push('head')

        <link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
    @endpush

    <div class="container-fluid">
    	<div class="row">
        @if($role[0]->role_id != 1)
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div><h1><b style="color: #1c4228; font-weight: 900">{{Auth::user()->name}},</b><span style="color: #646c9a; font-size: 1.7rem; font-weight: 600"> Seja muito bem vindo ao Software de Gestão Interna</span><b style="color: blue; font-size: 1.7rem; font-weight: 900"> PJ</b><b style="color: #1c4228; font-size: 1.7rem; font-weight: 900">web</b></h1></div>
                </div>
                <div class="panel-body no-padding">
                    <div class='section header'>
                        <div class='photo'>
                            <!-- <img src="{!! asset('images/2048x1536-05.png')!!}" srcset="{!! asset('images/2048x1536-05.png')!!} 2000w,
                                {!!asset('images/1280x720-03.png')!!} 1000w" sizes='(min-width: 960px) 960px,
                            100vw' /> -->
                            <picture>
                                <source media='(min-width: 2000px)' srcset="{!!asset('img/2048x1536.jpeg')!!}" />
                                <source media='(min-width:1000px)' srcset="{!!asset('img/1280x720.jpeg')!!}" />
                                <source media='(min-width: 640px)' srcset="{!!asset('img/960x540.jpeg')!!}" />
                                <source media='(max-width: 360px)' srcset="{!!asset('img/960x540.jpeg')!!}" />
                                <img src="{!!asset('img/320x480.jpeg')!!}" /> 
                            </picture>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .header {
                    height: auto;
                    justify-content: inherit;
                    align-items: inherit;
                }

                .photo img {
                    width: 100%;
                    display: block;
                    position: relative;
                }
            </style>
        @endif
        @can('gerencia_funcoes')
    		<!-- page statustic chart start -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-red text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __($contratos)}}</h4>
                                <p class="mb-0">{{ __('Contratos Ativos')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-file-text f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart1" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-blue text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __($numeros)}}</h4>
                                <p class="mb-0">{{ __('Números Ativos')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-smartphone f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart2" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-green text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __($users)}}</h4>
                                <p class="mb-0">{{ __('Usuários Ativos')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-users f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart3" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h5 class="mb-0">{{ __('R$ ' .$faturas)}}</h5>
                                <p class="mb-0">{{ __('Total de Faturas')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-dollar-sign f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart4" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
       
            <!-- Application Sales end -->
        @endcan
    	</div>
    </div>
	<!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/owl.carousel/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('plugins/chartist/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>
        <!-- <script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js') }}"></script> -->
        <script src="{{ asset('plugins/flot-charts/curvedLines.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>

        <script src="{{ asset('plugins/amcharts/amcharts.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/serial.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/themes/light.js') }}"></script>
       
        
        <script src="{{ asset('js/widget-statistic.js') }}"></script>
        <script src="{{ asset('js/widget-data.js') }}"></script>
        <script src="{{ asset('js/dashboard-charts.js') }}"></script>
        
    @endpush
@endsection