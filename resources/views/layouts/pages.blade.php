<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $business->name }}</title>

    {!! Html::style('one-health/assets/css/maicons.css') !!}
    {!! Html::style('one-health/assets/css/bootstrap.css') !!}
    {!! Html::style('one-health/assets/vendor/owl-carousel/css/owl.carousel.css') !!}
    {!! Html::style('one-health/assets/vendor/animate/animate.css') !!}
    {!! Html::style('one-health/assets/css/theme.css') !!}
    @yield('styles')
    <link rel="shortcut icon" href="{{ asset('image/' . $business->logo) }}" />
</head>

<body>

    <!-- Back to top button -->
    <div class="back-to-top"></div>

    <header>
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 text-sm">
                        <div class="site-info">
                            <a href="#"><span class="mai-call text-primary"></span> {{ $business->phone }}</a>
                            <span class="divider">|</span>
                            <a href="#"><span class="mai-mail text-primary"></span> {{ $business->mail }}</a>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right text-sm">
                        <div class="social-mini-button">
                            @if ($business->configurations['facebook'])
                                <a href="{{ $business->configurations['facebook'] }}" target="_blank"><span
                                        class="mai-logo-facebook-f"></span></a>
                            @endif

                            @if ($business->configurations['twitter'])
                                <a href="{{$business->configurations['twitter']}}" target="_blank"><span class="mai-logo-twitter"></span></a>
                            @endif

                            @if ($business->configurations['instagram'])
                                <a href="{{$business->configurations['instagram']}}" target="_blank"><span class="mai-logo-instagram"></span></a>
                            @endif
                        </div>
                    </div>
                </div> <!-- .row -->
            </div> <!-- .container -->
        </div> <!-- .topbar -->

        <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
            <div class="container">
                <img src="{{ asset('image/' . $business->logo) }}" class="navbar-brand" width="56px" alt="">
                @if ($business->configurations['show_letter'])
                    <a class="navbar-brand" href="/"><span class="text-primary">Santa Bárbara </span>Centro de
                        Salud</a>
                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport"
                    aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupport">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item {{ request()->is('nosotros') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('nosotros') }}">Sobre nosotros</a>
                        </li>
                        <li class="nav-item {{ request()->is('medicos') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('medicos') }}">Medicos</a>
                        </li>
                        <li class="nav-item {{ request()->is('blog') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('blog') }}">Noticias</a>
                        </li>
                        <li class="nav-item {{ request()->is('contactos') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('contactos') }}">Contactos</a>
                        </li>
                        <span class="divider">|</span>
                        <li class="nav-item">
                            @auth
                                <a class="btn btn-outline-primary ml-lg-3" href="{{ route('home') }}">Hola,
                                    {{ Auth::user()->name }} </a>
                            @endauth

                            @guest
                                <a class="btn btn-primary ml-lg-3" href="{{ route('login') }}">Iniciar sesion</a>
                            @endguest
                        </li>
                    </ul>
                </div> <!-- .navbar-collapse -->
            </div> <!-- .container -->
        </nav>
    </header>

    @yield('contenido')

    <footer class="page-footer">
        <div class="footer-bottom-area bg-gray pt-20 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Compañia</h5>
                        <ul class="footer-menu">
                            <li><a href="#">Nosotros</a></li>
                            <li><a href="#">Carreras</a></li>
                            <li><a href="#">Equipo editorial</a></li>
                            <li><a href="#">Proteccion</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Contactos</h5>
                        <p class="footer-menu">{{ $business->address }}</p>
                        <a href="#" class="footer-link">{{ $business->phone }}</a>
                        -
                        <a href="#" class="footer-link">{{ $business->mail }}</a>

                        @if (
                            $business->configurations['facebook'] ||
                                $business->configurations['twitter'] ||
                                $business->configurations['instagram']
                        )
                            <h5>Redes sociales</h5>
                            <div class="footer-menu">
                                @if (isset($business->configurations['facebook']))
                                    <a href="{{ $business->configurations['facebook'] }}" target="_blank"><span
                                            class="mai-logo-facebook-f"></span></a>
                                @endif

                                @if (isset($business->configurations['twitter']))
                                    <a href="{{$business->configurations['twitter']}}" target="_blank"><span class="mai-logo-twitter"></span></a>
                                @endif

                                @if (isset($business->configurations['instagram']))
                                    <a href="{{$business->configurations['instagram']}}" target="_blank"><span class="mai-logo-instagram"></span></a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="footer-bottom-wrap">
                    <div class="copyright-text d-flex flex-row justify-content-center">
                        <span class="text-muted text-left d-block d-sm-inline-block">Copyright © 2023.
                            Todos los derechos reservados.&nbsp;</span>
                    </div>
                    <div class="copyright-text d-flex flex-row justify-content-center">
                        <span class="text-muted text-right d-block d-sm-inline-block">
                            <b> POWERED BY
                                <a style="text-decoration: none; color:rgb(17, 15, 129);"
                                    href="https://www.afdeveloper.com/" target="_blank">&nbsp;AF</a>
                            </b></span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {!! Html::script('one-health/assets/js/jquery-3.5.1.min.js') !!}
    {!! Html::script('one-health/assets/js/bootstrap.bundle.min.js') !!}
    {!! Html::script('one-health/assets/vendor/owl-carousel/js/owl.carousel.min.js') !!}
    {!! Html::script('one-health/assets/vendor/wow/wow.min.js') !!}
    {!! Html::script('one-health/assets/js/theme.js') !!}
    @yield('scripts')
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            setTimeout(function() {
                var successMessage = document.getElementById('success-message');
                if (successMessage) {
                    successMessage.style.opacity = '0';
                    setTimeout(function() {
                        successMessage.style.display = 'none';
                    }, 1000);
                }
            }, 5000);
        });
    </script>
</body>

</html>
