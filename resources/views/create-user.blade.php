@extends('layouts.main') 
@section('title', 'Adicionar Usuário')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
         <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Adicionar Usuário')}}</h5>
                            <span>{{ __('Criar novo usuário, com regras e permissões')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Adicionar Usuário')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Adicionar Usuário')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('create-user') }}" autocomplete="off">
                        @csrf
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="name">{{ __('Nome')}}<span class="text-red">*</span></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="Entre com o nome" required oninvalid="this.setCustomValidity('Campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="endereco">{{ __('Endereço')}}<span class="text-red">*</span></label>
                                        <input id="endereco" type="text" class="form-control @error('endereco') is-invalid @enderror" name="endereco" value="" placeholder="Entre com o endereço" required oninvalid="this.setCustomValidity('Campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                                        <div class="help-block with-errors"></div>

                                        @error('endereco')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cidade">{{ __('Cidade')}}<span class="text-red">*</span></label>
                                        <input id="cidade" type="text" class="form-control @error('cidade') is-invalid @enderror" name="cidade" value="" placeholder="Entre com a cidade" required oninvalid="this.setCustomValidity('Campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                                        <div class="help-block with-errors"></div>

                                        @error('cidade')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Email')}}<span class="text-red">*</span></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Entre com o email" required oninvalid="this.setCustomValidity('Campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                                        <div class="help-block with-errors" ></div>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="datanasc">{{ __('Data Nasc.')}}<span class="text-red">*</span></label>
                                        {{-- <input id="datanasc" type="text" class="form-control @error('datanasc') is-invalid @enderror" name="datanasc" value="{{ old('datanasc') }}" placeholder="Entre com o email" required oninvalid="this.setCustomValidity('Campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}"> --}}
                                        <div class="input-group input-daterange">
                                            {{-- <input type="date" class="form-control" id="dtentrega" name="dtentrega" @if($aparelhos->dt_entrega != '')value="{{date('d/m/Y', strtotime($aparelhos->dt_entrega))}}" @else value="{{''}}"@endif> --}}
                                            <input class="form-control" type="text" id="date1" name="date1" value="{{date('Y-d-m')}}" required />
                                            <input id="data_inicial" name="data_inicial" type="hidden"value="{{date('Y-m-d')}}" class="form-control" />
                                            <div class="input-group-append"><span class="input-group-text"  id="basic-addon2"><i class="fa fa-calendar"></i></span></div>
                                        </div>
                                        <div class="help-block with-errors" ></div>

                                        @error('datanasc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cpf">{{ __('CPF')}}<span class="text-red">*</span></label>
                                        <input id="cpf" type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf" value="{{ old('cpf') }}" placeholder="Entre com o cpf" required oninvalid="this.setCustomValidity('Campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                                        <div class="help-block with-errors" ></div>

                                        @error('cpf')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="rg">{{ __('RG')}}<span class="text-red">*</span></label>
                                        <input id="rg" type="text" class="form-control @error('rg') is-invalid @enderror" name="rg" value="{{ old('rg') }}" placeholder="Entre com o rg" required oninvalid="this.setCustomValidity('Campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                                        <div class="help-block with-errors" ></div>

                                        @error('rg')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="situacao">{{ __('Situação')}}<span class="text-red">*</span></label>
                                        <!-- <input id="situacao" type="text" class="form-control @error('situacao') is-invalid @enderror" name="situacao" value="{{ old('situacao') }}" placeholder="Entre com o situacao" required> -->
                                        <select class="form-control" name="situacao" id="situacao" required oninvalid="this.setCustomValidity('Campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                                            <option value="">Selecione</option>
                                            <option value="Ativo">Ativo</option>
                                            <option value="Inativo">Inativo</option>
                                        </select>
                                        <div class="help-block with-errors" ></div>

                                        @error('situacao')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="numfunc">{{ __('Nº de Funcionário')}}<span class="text-red">*</span></label>
                                        <input id="numfunc" type="text" class="form-control @error('numfunc') is-invalid @enderror" name="numfunc" value="{{ old('numfunc') }}" placeholder="Entre com o numfunc">
                                        <div class="help-block with-errors" ></div>

                                        @error('numfunc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="tipo">{{ __('Tipo')}}<span class="text-red">*</span></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Entre com o email" required> 
                                        <select class="form-control" name="tipo" id="tipo" required oninvalid="this.setCustomValidity('Campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                                            <option value="">Selecione</option>
                                            <option value="Funcionario">Funcionário</option>
                                            <option value="Terceiro">Terceiro</option>
                                        </select>
                                        <div class="help-block with-errors" ></div>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="password">{{ __('Senha')}}<span class="text-red">*</span></label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Entre com a senha" required oninvalid="this.setCustomValidity('Campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                                        <div class="help-block with-errors"></div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirmar Senha')}}<span class="text-red">*</span></label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirme a Senha" required oninvalid="this.setCustomValidity('Campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <!-- Assign role & view role permisions -->
                                    <div class="form-group">
                                        <label for="role">{{ __('Tipo')}}<span class="text-red">*</span></label>
                                        {!! Form::select('role', $roles, null,[ 'class'=>'form-control select2', 'placeholder' => 'Selecionar função','id'=> 'role', 'required'=> 'required']) !!}
                                    </div>
                                    <div class="form-group" >
                                        <label for="role">{{ __('Permissões')}}</label>
                                        <div id="permission" class="form-group" style="border-left: 2px solid #d1d1d1;">
                                            <span class="text-red pl-3">Selecione a função primeiro</span>
                                        </div>
                                        <input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('Salvar')}}</button>
                                        <a type="button" href="{{url('users')}}" class="btn btn-warning">{{ __('Cancelar')}}</a>
                                    </div>
                                </div>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script') 
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
        <script src="{{ asset('js/criar-usuario.js') }}"></script>
         <!--get role wise permissiom ajax script-->
        <script src="{{ asset('js/get-role.js') }}"></script>
        <script>
            $(document).ready(function(){
            $('#sim').mask('000000');
            {{-- $('#numero').mask('(00) 0 0000-0000'); --}}
            $('#cpf').mask('000.000.000-00');
            
            });
        </script>
    @endpush
@endsection
