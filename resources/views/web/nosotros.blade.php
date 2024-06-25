@extends('layouts.pages')

@section('contenido')

<div class="page-banner overlay-dark bg-image"
        style="background-image: url({{ asset('one-health/assets/img/bg_image_1.jpg') }});">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nosotros</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Sobre nosotros</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->


    <div class="page-section bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-4 py-3 wow zoomIn">
              <div class="card-service">
                <div class="circle-shape bg-secondary text-white">
                  <span class="mai-chatbubbles-outline"></span>
                </div>
                <p><span>Conoce </span>a nuestros doctores</p>
              </div>
            </div>
            <div class="col-md-4 py-3 wow zoomIn">
              <div class="card-service">
                <div class="circle-shape bg-primary text-white">
                  <span class="mai-shield-checkmark"></span>
                </div>
                <p><span>Protección</span> Familiar</p>
              </div>
            </div>
            <div class="col-md-4 py-3 wow zoomIn">
              <div class="card-service">
                <div class="circle-shape bg-accent text-white">
                  <span class="mai-basket"></span>
                </div>
                <p><span>Farmacias </span>a tu disposición</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="page-section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 wow fadeInUp">
              <h1 class="text-left mb-3">Misión</h1>
              <div class="text-lg">
                {{$business->mision}}
              </div>
            </div>
            <br>
            <div class="col-lg-8 wow fadeInUp mt-5">
              <h1 class="text-left mb-3">Visión</h1>
              <div class="text-lg">
                {{$business->vision}}
              </div>
            </div>
            <div class="col-lg-10 mt-5">
                <h1 class="text-center mb-5 wow fadeInUp">Nuestros medicos</h1>

                <div class="owl-carousel wow fadeInUp" id="doctorSlideshow">
                    @foreach ($medicos as $medico)
                        <div class="item">
                            <div class="card-doctor">
                                <div class="header">
                                    <img src="{{ asset('image/system/medico.png') }}" alt="">
                                    <div class="meta">
                                        <a href="mailto:{{ $medico->email }}"><span class="mai-mail"></span></a>
                                        <a href="https://wa.me/{{ $medico->telefono }}/?text=Hola, como estas"><span
                                                class="mai-logo-whatsapp"></span></a>
                                    </div>
                                </div>
                                <div class="body">
                                    <p class="text-xl mb-0">{{ $medico->name }} {{ $medico->apellido }}</p>
                                    <span class="text-sm text-grey">{{ $medico->especialidad->nombre }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
          </div>
        </div>
      </div>


      <div class="page-section banner-home bg-image" style="background-image: url(one-health/assets/img/banner-pattern.svg);">
        <div class="container py-5 py-lg-0">
            <div class="row align-items-center">
                <div class="col-lg-4 wow zoomIn">
                    <div class="img-banner d-none d-lg-block">
                        <img src="{{ asset('one-health/assets/img/mobile_app.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-8 wow fadeInRight">
                    <h1 class="font-weight-normal mb-3">Haciéndote la vida más fácil</h1>

                </div>
            </div>
        </div>
    </div> <!-- .banner-home -->


    
@endsection