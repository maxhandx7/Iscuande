<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $business->name }}</title>
    {!! Html::style('melody/vendors/iconfonts/font-awesome/css/all.min.css') !!}
    {!! Html::style('melody/vendors/css/vendor.bundle.base.css') !!}
    {!! Html::style('melody/vendors/css/vendor.bundle.addons.css') !!}
    {!! Html::style('melody/css/style.css') !!}
    {!! Html::style('melody/css/main.css') !!}
    {!! Html::style('melody/responsive/css/responsive.min.css') !!}
    @yield('styles')
    <link rel="shortcut icon" sizes="96x96" href="{{ asset('image/' . $business->logo) }}" />
</head>

<body>
    <div class="container-scroller">
        <nav id="navbar" class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="/home"><img src="{{ asset('melody/images/logo.svg') }}"
                        alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="/home"><img
                        src="{{ asset('melody/images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="fas fa-bars"></span>
                </button>
                <ul class="navbar-nav">
                    <li class="nav-item nav-search d-none d-md-flex">
                        <div class="nav-link">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                                <form id="search-form" action="{{ route('search') }}" method="GET">
                                    <input type="text" class="form-control @error('query') is-invalid @enderror"
                                        name="query" id="query" placeholder="Buscar en la biblioteca"
                                        aria-label="Search" required>
                                    @error('query')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <button onclick="cambiarTema()" class="btn btn-rounded" id="cambiar"><i id="dl-icon"
                                class="fa fa-moon"></i></button>
                    </li>
                    <li class="nav-item nav-profile dropdown">

                        <a class="nav-link dropdown-toggle" href="/" data-toggle="dropdown" id="profileDropdown">

                            {{ Auth::user()->username}}

                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('configs.edit', Auth::user()->id) }}"
                                data-toggle="tooltip" data-placement="top" title="Configuracion"
                                data-original-title="config">
                                <i class="fas fa-cogs text-primary"></i>
                                Configuración
                            </a>
                            @if (Auth::user()->tipo == 'ADMIN')
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('business.index') }}" data-toggle="tooltip"
                                    data-placement="top" title="" data-original-title="Logout">
                                    <i class="fas fa-briefcase text-primary"></i>
                                    {{ $business->name }}
                                </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/') }}" data-toggle="tooltip"
                                data-placement="top" title="Configuracion" data-original-title="config">
                                <i class="fa fa-reply text-primary"></i>
                                Ir a la web
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="tooltip"
                                data-placement="top" title="" data-original-title="Logout"
                                onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off text-primary"></i>
                                Salir
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="fas fa-bars"></span>
                </button>
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper">
            @yield('preference')
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <div class="nav-link">
                            <div class="profile-image">
                                <i class="fa fa-user menu-icon"></i>
                            </div>
                            <div class="profile-name">
                                <p class="name">
                                    {{ Auth::user()->email }}
                                </p>
                                <p class="designation">
                                    {{ Auth::user()->tipo }}
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item {{ Request::segment(1) === 'home' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fa fa-home menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::segment(1) === 'citas' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('citas.index') }}">
                            <i class="fa fa-calendar  menu-icon"></i>
                            <span class="menu-title">Citas</span>
                        </a>
                    </li>
                    @if (Auth::user()->tipo == 'ADMIN')
                        <li class="nav-item {{ Request::segment(1) === 'turnos' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('turnos.index') }}">
                                <i class="fa fa-hospital menu-icon"></i>
                                <span class="menu-title">Configurar disponibilidad</span>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::segment(1) === 'especialidads' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('especialidads.index') }}">
                                <i class="fa fa-stethoscope menu-icon"></i>
                                <span class="menu-title">Especialidades</span>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::segment(1) === 'users' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="fa fa-users menu-icon"></i>
                                <span class="menu-title">Usuarios</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false"
                                aria-controls="page-layouts">
                                <i class="fas fa-bullhorn menu-icon"></i>
                                <span class="menu-title">Noticias</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="page-layouts">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item {{ Request::segment(1) === 'posts' ? 'active' : '' }}"> <a
                                            class="nav-link" href="{{ route('posts.index') }}">Publicaciones</a></li>
                                    <li class="nav-item {{ Request::segment(1) === 'comments' ? 'active' : '' }}"> <a
                                            class="nav-link" href="{{ route('comments.index') }}">Comentarios</a>
                                    </li>
                                    <li class="nav-item {{ Request::segment(1) === 'categories' ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('categories.index') }}">Categorias</a>
                                    </li>
                                    <li class="nav-item {{ Request::segment(1) === 'tags' ? 'active' : '' }}"> <a
                                            class="nav-link" href="{{ route('tags.index') }}">Etiquetas</a></li>

                                </ul>
                            </div>
                        </li>
                        {{-- <li class="nav-item {{ Request::segment(1) === 'assistants' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('assistants.index') }}">
                                <i class="fa fa-robot menu-icon"></i>
                                <span class="menu-title">Asistente Virtual</span>
                            </a>
                        </li> --}}
                        <li class="nav-item {{ Request::segment(1) === 'configs' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('configs.index') }}">
                                <i class="fa fa-paper-plane menu-icon"></i>
                                <span class="menu-title">PQRS</span>
                            </a>
                        </li>

                        <li class="nav-item {{ Request::segment(1) === 'reports' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('reports') }}">
                                <i class="fa fa-download menu-icon"></i>
                                <span class="menu-title">Reportes</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            @yield('preference')
            <div class="main-panel">
                <div id="loader-container" hidden>
                    <div class="dot-opacity-loader">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                @yield('content')
                <!-- main-panel ends -->
                <footer class="footer">
                    <div class="col-lg-12 login-half-bg d-flex flex-row justify-content-center">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023.
                            Todos los derechos reservados.&nbsp;</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><b><a
                                    style="text-decoration: none; color:rgb(17, 15, 129);"
                                    href="https://afdeveloper.com/" target="_blank">&nbsp;AF</a> </b> <i
                                class="far fa-heart text-danger"></i>&nbsp;</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    {!! Html::script('melody/js/main.js') !!}
    {!! Html::script('melody/vendors/js/vendor.bundle.base.js') !!}
    {!! Html::script('melody/vendors/js/vendor.bundle.addons.js') !!}
    {!! Html::script('melody/js/off-canvas.js') !!}
    {!! Html::script('melody/js/hoverable-collapse.js') !!}
    {!! Html::script('melody/js/misc.js') !!}
    {!! Html::script('melody/js/settings.js') !!}
    {!! Html::script('melody/js/dashboard.js') !!}
    @yield('scripts')
</body>

</html>
