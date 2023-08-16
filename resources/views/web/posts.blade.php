@extends('layouts.pages')

@section('contenido')
    <div class="page-banner overlay-dark bg-image"
        style="background-image: url({{ asset('one-health/assets/img/bg_image_1.jpg') }});">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Noticias</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Noticias</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class="col-sm-6 py-3">
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
                                        <h5 class="post-title"><a
                                                href="{{ route('post', $post->slug) }}">{{ $post->name }}</a></h5>
                                        <div class="site-info">
                                            <div class="avatar mr-2">
                                                <div class="avatar-img">
                                                    <img src="{{ asset('image/' . $business->logo) }}" alt="">
                                                </div>
                                                <span>{{ $post->user->name }}</span>
                                            </div>
                                            <span class="mai-person"></span> {{ $post->user->tipo }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- .row -->
                    <div class="col-12 my-5">
                        <nav aria-label="Page Navigation">
                            {{ $posts->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">

                        <div class="sidebar-block">
                            <h3 class="sidebar-title">Categorias</h3>
                            <ul class="categories">
                                @foreach ($categoriesWithCount as $category)
                                    <li><a href="{{ route('category', $category->slug) }}">{{ $category->name }}
                                            <span>{{ $category->posts_count }}</span></a></li>
                                @endforeach
                            </ul>
                            @if (isset($relatedPosts))
                                <h3 class="sidebar-title">Últimos posts de la misma categoría</h3>
                                @foreach ($relatedPosts as $relatedPost)
                                    <div class="blog-item">
                                        <a class="post-thumb" href="">
                                            <img src="{{ asset('image/' . $relatedPost->image) }}" alt="">
                                        </a>
                                        <div class="content">
                                            <h5 class="post-title"><a
                                                    href="{{ route('post', $post->slug) }}">{{ $relatedPost->name }}</a>
                                            </h5>
                                            <div class="meta">
                                                <a> {{ $relatedPost->user->name }}</a>
                                                <a><span class="mai-person"></span> {{ $relatedPost->user->tipo }}</a>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="sidebar-block">
                            <h3 class="sidebar-title">Etiquetas</h3>
                            <div class="tagcloud">
                                @foreach ($tags as $tag)
                                    <a href="#" class="tag-cloud-link">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>


                    </div>
                </div>
            </div> <!-- .row -->
        </div> <!-- .container -->
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
