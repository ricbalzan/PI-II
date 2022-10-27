<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard.dados')}}">
            <div class="logo-img">
               <img height="30" src="{{ asset('img/logo-sidebar.png')}}" class="header-brand-img" title="PJweb"> 
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->segment(1);
        $segment2 = request()->segment(2);
    @endphp
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment1 == 'dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard.dados')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'consulta-fat' ) ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-clipboard"></i><span>{{ __('Consultar Faturas')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        {{-- @can('gerencia_usuarios') --}}
                        <a href="{{url('consulta-fat/listar')}}" class="menu-item {{ ($segment1 == 'consulta-fat') ? 'active' : '' }}">{{ __('Faturas')}}</a>
                        {{-- <a href="{{url('user/create')}}" class="menu-item {{ ($segment1 == 'user' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Adicionar Usuário')}}</a> --}}
                         {{-- @endcan --}}
                         <!-- only those have manage_role permission will get access -->
                        {{-- @can('gerencia_funcoes')
                        <a href="{{url('roles')}}" class="menu-item {{ ($segment1 == 'roles') ? 'active' : '' }}">{{ __('Funções')}}</a>
                        @endcan --}}
                        <!-- only those have manage_permission permission will get access -->
                        {{-- @can('gerencia_permissoes')
                        <a href="{{url('permission')}}" class="menu-item {{ ($segment1 == 'permission') ? 'active' : '' }}">{{ __('Permissões')}}</a>
                        @endcan --}}
                    </div>
                </div>
                <div class="nav-item {{ ($segment1 == 'aparelhos' || $segment1 == 'aparelho') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-smartphone"></i><span>{{ __('Manutenção de Aparelhos')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('gerencia_usuarios')
                        <a href="{{url('aparelhos/listar')}}" class="menu-item {{ ($segment1 == 'aparelhos') ? 'active' : '' }}">{{ __('Cadastrar Aparelhos')}}</a>
                        <a href="{{url('aparelho/estoque')}}" class="menu-item {{ ($segment1 == 'aparelho' && $segment2 == 'estoque') ? 'active' : '' }}">{{ __('Relatório Estoque')}}</a>
                         @endcan
                         <!-- only those have manage_role permission will get access -->
                        {{-- @can('gerencia_funcoes')
                        <a href="{{url('roles')}}" class="menu-item {{ ($segment1 == 'roles') ? 'active' : '' }}">{{ __('Funções')}}</a>
                        @endcan --}}
                        <!-- only those have manage_permission permission will get access -->
                        {{-- @can('gerencia_permissoes')
                        <a href="{{url('permission')}}" class="menu-item {{ ($segment1 == 'permission') ? 'active' : '' }}">{{ __('Permissões')}}</a>
                        @endcan --}}
                    </div>
                </div>
                 <div class="nav-item {{ ($segment1 == 'contratos') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-file-text"></i><span>{{ __('Manutenção Contratos')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('gerencia_usuarios')
                        <a href="{{url('contratos/listar')}}" class="menu-item {{ ($segment1 == 'contratos') ? 'active' : '' }}">{{ __('Novo Contrato')}}</a>
                        {{-- <a href="{{url('user/create')}}" class="menu-item {{ ($segment1 == 'user' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Adicionar Usuário')}}</a> --}}
                         @endcan
                         <!-- only those have manage_role permission will get access -->
                        {{-- @can('gerencia_funcoes')
                        <a href="{{url('roles')}}" class="menu-item {{ ($segment1 == 'roles') ? 'active' : '' }}">{{ __('Funções')}}</a>
                        @endcan --}}
                        <!-- only those have manage_permission permission will get access -->
                        {{-- @can('gerencia_permissoes')
                        <a href="{{url('permission')}}" class="menu-item {{ ($segment1 == 'permission') ? 'active' : '' }}">{{ __('Permissões')}}</a>
                        @endcan --}}
                    </div>
                </div>
                <div class="nav-item {{ ($segment1 == 'faturas') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-file"></i><span>{{ __('Manutenção Faturas')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('gerencia_usuarios')
                        <a href="{{url('faturas/listar')}}" class="menu-item {{ ($segment1 == 'faturas') ? 'active' : '' }}">{{ __('Lançar Faturas')}}</a>
                        {{-- <a href="{{url('user/create')}}" class="menu-item {{ ($segment1 == 'user' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Adicionar Usuário')}}</a> --}}
                         @endcan
                         <!-- only those have manage_role permission will get access -->
                        {{-- @can('gerencia_funcoes')
                        <a href="{{url('roles')}}" class="menu-item {{ ($segment1 == 'roles') ? 'active' : '' }}">{{ __('Funções')}}</a>
                        @endcan --}}
                        <!-- only those have manage_permission permission will get access -->
                        {{-- @can('gerencia_permissoes')
                        <a href="{{url('permission')}}" class="menu-item {{ ($segment1 == 'permission') ? 'active' : '' }}">{{ __('Permissões')}}</a>
                        @endcan --}}
                    </div>
                </div>
                <div class="nav-item {{ ($segment1 == 'numeros') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-bar-chart"></i><span>{{ __('Manutenção Números')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('gerencia_usuarios')
                        <a href="{{url('numeros/listar')}}" class="menu-item {{ ($segment1 == 'numeros') ? 'active' : '' }}">{{ __('Cadastrar Número')}}</a>
                        {{-- <a href="{{url('user/create')}}" class="menu-item {{ ($segment1 == 'user' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Adicionar Usuário')}}</a> --}}
                         @endcan
                         <!-- only those have manage_role permission will get access -->
                        {{-- @can('gerencia_funcoes')
                        <a href="{{url('roles')}}" class="menu-item {{ ($segment1 == 'roles') ? 'active' : '' }}">{{ __('Funções')}}</a>
                        @endcan --}}
                        <!-- only those have manage_permission permission will get access -->
                        {{-- @can('gerencia_permissoes')
                        <a href="{{url('permission')}}" class="menu-item {{ ($segment1 == 'permission') ? 'active' : '' }}">{{ __('Permissões')}}</a>
                        @endcan --}}
                    </div>
                </div>
                <div class="nav-item {{ ($segment1 == 'users' || $segment1 == 'roles'||$segment1 == 'permission' ||$segment1 == 'user') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-users"></i><span>{{ __('Manutenção Usuários')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('gerencia_usuarios')
                        <a href="{{url('users')}}" class="menu-item {{ ($segment1 == 'users') ? 'active' : '' }}">{{ __('Usuários')}}</a>
                        <a href="{{url('user/create')}}" class="menu-item {{ ($segment1 == 'user' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Adicionar Usuário')}}</a>
                         @endcan
                         <!-- only those have manage_role permission will get access -->
                        @can('gerencia_funcoes')
                        <a href="{{url('roles')}}" class="menu-item {{ ($segment1 == 'roles') ? 'active' : '' }}">{{ __('Funções')}}</a>
                        @endcan
                        <!-- only those have manage_permission permission will get access -->
                        @can('gerencia_permissoes')
                        <a href="{{url('permission')}}" class="menu-item {{ ($segment1 == 'permission') ? 'active' : '' }}">{{ __('Permissões')}}</a>
                        @endcan
                    </div>
                </div>        
                
            </nav>
        </div>
    </div>
</div>