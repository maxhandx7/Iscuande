@extends('layouts.app')
@section('title', 'Panel administrador')
@section('styles')
@endsection
@section('options')
@endsection
@section('preference')
@endsection
@include('assistent.assistent')
@section('content')
    <div class="bg-light">
        <div class="page-section py-3 mt-md-n5 custom-index">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card-service wow fadeInUp">
                            <div class="circle-shape bg-secondary text-white">
                                <span class="mai-chatbubbles-outline"></span>
                            </div>
                            <p><span>Conoce </span>a nuestros doctores</p>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card-service wow fadeInUp">
                            <div class="circle-shape bg-primary text-white">
                                <span class="mai-shield-checkmark"></span>
                            </div>
                            <p><span>Protección</span> Familiar</p>
                        </div>
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <div class="card-service wow fadeInUp">
                            <div class="circle-shape bg-accent text-white">
                                <span class="mai-basket"></span>
                            </div>
                            <p><span>Farmacias </span>a tu disposición</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .page-section -->

        <div class="page-section pb-0">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 py-3 wow fadeInUp">
                        <h1>Bienvenidos a <br> {{ $business->name }}</h1>
                        <p class="text-grey mb-4">{{ $business->description }}</p>
                        <a href="{{ url('nosotros') }}" class="btn btn-primary">Leer más</a>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
                        <div class="img-place custom-img-1">
                            <img src="{{ asset('one-health/assets/img/bg-doctor.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .bg-light -->
    </div> <!-- .bg-light -->

    <div class="page-section">
        <div class="container">
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

    <div class="page-section bg-light">
        <div class="container">
            <h1 class="text-center wow fadeInUp">Ultimas noticias</h1>
            <div class="row mt-5">
                @foreach ($posts as $post)
                    <div class="col-sm-4 py-3">
                        <div class="card-blog">
                            <div class="header">
                                <div class="post-category">
                                    <a href="{{ route('post', $post->slug) }}">{{ $post->category->name }}</a>
                                </div>
                                <a href="{{ route('post', $post->slug) }}" class="post-thumb">
                                    <img src="{{ asset('image/' . $post->image) }}" alt="">
                                </a>
                            </div>
                            <div class="body">
                                <h5 class="post-title"><a href="{{ route('post', $post->slug) }}">{{ $post->name }}</a>
                                </h5>
                                <div class="site-info">
                                    <div class="avatar mr-2">
                                        <div class="avatar-img">
                                            <img src="{{ asset('image/' . $business->logo) }}" alt="">
                                        </div>
                                        <span>{{ $post->user->username }}</span>
                                    </div>
                                    <span class="mai-person"></span> {{ $post->user->tipo }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-12 text-center mt-4 wow zoomIn">
                    <a href="{{ url('blog') }}" class="btn btn-primary">Leer más</a>
                </div>

            </div>
        </div>
    </div> <!-- .page-section -->

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
