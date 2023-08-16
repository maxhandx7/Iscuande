@extends('layouts.pages')

@section('contenido')

<div class="page-banner overlay-dark bg-image"
        style="background-image: url({{ asset('one-health/assets/img/bg_image_1.jpg') }});">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contactos</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Contactos</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->
    
    <div class="page-section">
        <div class="container">
          <h1 class="text-center wow fadeInUp">Contactanos</h1>
          @include('alert.message')
          {!! Form::open(['route' => 'contacts', 'method' => 'POST']) !!}
            <div class="row mb-3">
              <div class="col-sm-6 py-2 wow fadeInLeft">
                <label for="fullName">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre Completo" required>
              </div>
              <div class="col-sm-6 py-2 wow fadeInRight">
                <label for="emailAddress">Correo</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="ejemplo@mail.com" required>
              </div>
              <div class="col-12 py-2 wow fadeInUp">
                <label for="subject">Asunto</label>
                <input type="text" id="asunto" name="asunto" class="form-control" placeholder="Describa el asunto" required>
              </div>
              <div class="col-12 py-2 wow fadeInUp">
                <label for="message">Mensaje</label>
                <textarea id="body" name="body" class="form-control" rows="8" placeholder="Escriba el mensaje" required></textarea>
              </div>
            </div>
            <button type="submit" class="btn btn-primary wow zoomIn">Enviar</button>
            {!! Form::close() !!}
        </div>
      </div>
      
     {{--  <div class="maps-container wow fadeInUp">
        <div id="gmp-map"></div>
      </div>
 --}}

      <div class="page-section banner-home bg-image" style="background-image: url(one-health/assets/img/banner-pattern.svg);">
        <div class="container py-5 py-lg-0">
            <div class="row align-items-center">
                <div class="col-lg-4 wow zoomIn">
                    <div class="img-banner d-none d-lg-block">
                        <img src="one-health/assets/img/mobile_app.png" alt="">
                    </div>
                </div>
                <div class="col-lg-8 wow fadeInRight">
                    <h1 class="font-weight-normal mb-3">Haciéndote la vida más fácil</h1>
    
                </div>
            </div>
        </div>
    </div> <!-- .banner-home -->

@endsection

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY_HERE&callback=initMap&libraries=places,geometry&solution_channel=GMP_QB_locatorplus_v6_cA" async defer></script>
@endsection
