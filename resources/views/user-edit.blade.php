@extends('layouts.main') 
@section('title', $user->name)
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
                            <h5>{{ __('Editar Usuário')}}</h5>
                            <span>{{ __('Edição de dados e permissões de usuário')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Usuário')}}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <!-- clean unescaped data is to avoid potential XSS risk -->
                                {{ clean($user->name, 'titles')}}
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
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ url('user/update') }}" autocomplete="off">
                        @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="name">{{ __('Nome')}}<span class="text-red">*</span></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ clean($user->name, 'titles')}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Email')}}<span class="text-red">*</span></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ clean($user->email, 'titles')}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="endereco">{{ __('Endereço')}}<span class="text-red">*</span></label>
                                        <input id="endereco" type="text" class="form-control @error('endereco') is-invalid @enderror" name="endereco" value="{{ clean($user->endereco, 'titles')}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('endereco')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cidade">{{ __('Cidade')}}<span class="text-red">*</span></label>
                                        <input id="cidade" type="text" class="form-control @error('cidade') is-invalid @enderror" name="cidade" value="{{ clean($user->cidade, 'titles')}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('cidade')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="data_nasc">{{ __('Data Nasc')}}<span class="text-red">*</span></label>
                                        {{-- <input id="data_nasc" type="text" class="form-control @error('data_nasc') is-invalid @enderror" name="data_nasc" value="{{ clean($user->data_nasc, 'titles')}}" required> --}}
                                         <div class="input-group input-daterange">
                                            {{-- <input type="date" class="form-control" id="dtentrega" name="dtentrega" @if($aparelhos->dt_entrega != '')value="{{date('d/m/Y', strtotime($aparelhos->dt_entrega))}}" @else value="{{''}}"@endif> --}}
                                            <input class="form-control" type="text" id="date1" name="date1" @if($user->data_nasc != '')value="{{date('d/m/Y', strtotime($user->data_nasc))}}" @else value="{{''}}"@endif required />
                                            <input id="data_inicial" name="data_inicial" type="hidden" @if($user->data_nasc != '')value="{{date('Ymd', strtotime($user->data_nasc))}}" @else value="{{''}}"@endif class="form-control" />
                                            <div class="input-group-append"><span class="input-group-text"  id="basic-addon2"><i class="fa fa-calendar"></i></span></div>
                                        </div>
                                        <div class="help-block with-errors"></div>

                                        @error('data_nasc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cpf">{{ __('Cpf')}}<span class="text-red">*</span></label>
                                        <input id="cpf" type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf" value="{{ clean($user->cpf, 'titles')}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('cpf')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="rg">{{ __('Rg')}}<span class="text-red">*</span></label>
                                        <input id="rg" type="text" class="form-control @error('rg') is-invalid @enderror" name="rg" value="{{ clean($user->rg, 'titles')}}" required>
                                        <div class="help-block with-errors"></div>

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
                                        <!-- <input id="situacao" type="text" class="form-control @error('situacao') is-invalid @enderror" name="situacao" value="{{ clean($user->situacao, 'titles')}}" required> -->
                                        <select class="form-control" name="situacao" id="situacao">
                                            <option value="{{$user->situacao}}" selected>{{$user->situacao}}</option>
                                            <option value="Ativo">Ativo</option>
                                            <option value="Inativo">Inativo</option>
                                        </select>
                                        <div class="help-block with-errors"></div>

                                        @error('situacao')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="tipo">{{ __('Tipo')}}<span class="text-red">*</span></label>
                                         <input id="tipo" type="text" class="form-control @error('tipo') is-invalid @enderror" name="tipo" value="{{ clean($user->tipo, 'titles')}}" required> 
                                        <select class="form-control" name="tipo" id="tipo">
                                            <option value="{{$user->tipo}}" selected>{{$user->tipo}}</option>
                                            <option value="funcionario">Funcionário</option>
                                            <option value="terceiro">Terceiro</option>
                                        </select>
                                        <div class="help-block with-errors"></div>

                                        @error('tipo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="num_func">{{ __('Num Func')}}<span class="text-red">*</span></label>
                                        <input id="num_func" type="text" class="form-control @error('num_func') is-invalid @enderror" name="num_func" value="{{ clean($user->num_func, 'titles')}}">
                                        <div class="help-block with-errors"></div>

                                        @error('num_func')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- Assign role & view role permisions -->
                                    <div class="form-group">
                                        <label for="role">{{ __('Tipo')}}<span class="text-red">*</span></label>
                                        {!! Form::select('role', $roles, $user_role->id??'' ,[ 'class'=>'form-control select2', 'placeholder' => 'Select Role','id'=> 'role', 'required'=>'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="role">{{ __('Permissões')}}</label>
                                        <div id="permission" class="form-group">
                                            @foreach($user->getAllPermissions() as $key => $permission) 
                                            <span class="badge badge-dark m-1">
                                                <!-- clean unescaped data is to avoid potential XSS risk -->
                                                {{ clean($permission->name, 'titles')}}
                                            </span>
                                            @endforeach
                                        </div>
                                        <input type="hidden" id="token" name="token" value="{{ csrf_token() }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{ __('Senha')}}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off">
                                        <div class="help-block with-errors"></div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirmar Senha')}}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="off">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control-right">{{ __('Atualizar')}}</button>
                                         <a type="button" href="{{url('users')}}" class="btn btn-warning form-control-right">{{ __('Cancelar')}}</a>
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
        {{-- <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script> --}}
        <!--get role wise permissiom ajax script-->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="{{ asset('js/get-role.js') }}"></script>
        <script src="{{ asset('js/editar-usuario.js') }}"></script>
        <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
        <script>
            $(document).ready(function(){
            {{-- $('#sim').mask('000000'); --}}
            {{-- $('#numero').mask('(00) 0 0000-0000'); --}}
            $('#cpf').mask('000.000.000-00');
            
            });
        </script>
    @endpush
@endsection
