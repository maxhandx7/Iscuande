<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Santa barbara Centro de salud</title>

    {!! Html::style('one-health/assets/css/maicons.css') !!}
    {!! Html::style('one-health/assets/css/bootstrap.css') !!}
    {!! Html::style('one-health/assets/vendor/owl-carousel/css/owl.carousel.css') !!}
    {!! Html::style('one-health/assets/vendor/animate/animate.css') !!}
    {!! Html::style('one-health/assets/css/theme.css') !!}
    @yield('styles')
    <link rel="shortcut icon" href="{{ asset('melody/images/logo.png') }}" />
</head>

<body>

    <!-- Back to top button -->
    <div class="back-to-top"></div>

    <header>
        {{-- <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> mail@example.com</a>
            </div>
          </div>
          <div class="col-sm-4 text-right text-sm">
            <div class="social-mini-button">
              <a href="#"><span class="mai-logo-facebook-f"></span></a>
              <a href="#"><span class="mai-logo-twitter"></span></a>
              <a href="#"><span class="mai-logo-dribbble"></span></a>
              <a href="#"><span class="mai-logo-instagram"></span></a>
            </div>
          </div>
        </div> 
      </div> 
    </div>  --}}

        <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/"><span class="text-primary">Santa barbara </span>Centro de
                    salud</a>


                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport"
                    aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupport">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{-- {{ route('aboutUs') }} --}}">Sobre Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{-- {{ route('medicos') }} --}}">Medicos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('blog') }}">Noticias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contactos</a>
                        </li>
                        <span class="divider">|</span>
                        <li class="nav-item">
                            @auth
                            <a class="btn btn-outline-primary ml-lg-3" href="{{ route('home') }}">Hola, {{ Auth::user()->name }} {{ Auth::user()->apellido }}</a>
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
                <div class="footer-bottom-wrap">
                    <div class="copyright-text d-flex flex-row justify-content-center">
                        <span class="text-muted text-left d-block d-sm-inline-block">Copyright © 2023.
                            Todos los derechos reservados.&nbsp;</span>

                    </div>
                    <div class="copyright-text d-flex flex-row justify-content-center">
                        <span class="text-muted text-right d-block d-sm-inline-block">
                            <b> POWERED BY
                                <a style="text-decoration: none; color:rgb(17, 15, 129);"
                                    href="https://www.instagram.com/tribie17/" target="_blank">&nbsp;AF</a>
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

</body>

</html>