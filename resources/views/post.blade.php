@extends('layouts.blog')

@section('contenido')
    <div class="page-section pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <nav aria-label="Breadcrumb">
                        <ol class="breadcrumb bg-transparent py-0 mb-5">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('blog') }}">Noticias</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $post->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div> <!-- .row -->

            <div class="row">
                <div class="col-lg-8">
                    <article class="blog-details">
                        <div class="post-thumb">
                            <img src="{{ asset('image/' . $post->image) }}" alt="">

                        </div>
                        <div class="post-meta">
                            <div class="post-author">
                                <span class="text-grey">Publicado por</span> <a href="#">{{ $post->user->name }}</a>
                            </div>
                            <span class="divider">|</span>
                            <div>
                                <a href="#">{{ $post->category->name }}</a>
                            </div>
                        </div>
                        <h2 class="post-title h1">{{ $post->name }}</h2>
                        <div class="post-content">
                            <p>{!! $post->body !!}</p>


                        </div>
                        <div class="post-tags">
                            @foreach ($post->tags as $tag)
                                <a href="#" class="tag-link">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </article> <!-- .blog-details -->

                    <div class="comment-form-wrap pt-5">
                        <h3 class="mb-5">Deja un comentario</h3>
                        <form action="#" class="">
                            <div class="form-row form-group">
                                <div class="col-md-6">
                                    <label for="name">Nombre *</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Correo *</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="message">Mensaje</label>
                                <textarea name="msg" id="message" cols="30" rows="8" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Post Comment" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
						<div class="sidebar-block">
                            <h3 class="sidebar-title">Categorias</h3>
                            <ul class="categories">
                                @foreach ($categoriesWithCount as $category)
                                    <li><a href="#">{{ $category->name }} <span>{{ $category->posts_count }}</span></a></li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- <div class="sidebar-block">
                            <h3 class="sidebar-title">Recent Blog</h3>
                            <div class="blog-item">
                                <a class="post-thumb" href="">
                                    <img src="../assets/img/blog/blog_1.jpg" alt="">
                                </a>
                                <div class="content">
                                    <h5 class="post-title"><a href="#">Even the all-powerful Pointing has no
                                            control</a></h5>
                                    <div class="meta">
                                        <a href="#"><span class="mai-calendar"></span> July 12, 2018</a>
                                        <a href="#"><span class="mai-person"></span> Admin</a>
                                        <a href="#"><span class="mai-chatbubbles"></span> 19</a>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-item">
                                <a class="post-thumb" href="">
                                    <img src="../assets/img/blog/blog_2.jpg" alt="">
                                </a>
                                <div class="content">
                                    <h5 class="post-title"><a href="#">Even the all-powerful Pointing has no
                                            control</a></h5>
                                    <div class="meta">
                                        <a href="#"><span class="mai-calendar"></span> July 12, 2018</a>
                                        <a href="#"><span class="mai-person"></span> Admin</a>
                                        <a href="#"><span class="mai-chatbubbles"></span> 19</a>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-item">
                                <a class="post-thumb" href="">
                                    <img src="../assets/img/blog/blog_3.jpg" alt="">
                                </a>
                                <div class="content">
                                    <h5 class="post-title"><a href="#">Even the all-powerful Pointing has no
                                            control</a></h5>
                                    <div class="meta">
                                        <a href="#"><span class="mai-calendar"></span> July 12, 2018</a>
                                        <a href="#"><span class="mai-person"></span> Admin</a>
                                        <a href="#"><span class="mai-chatbubbles"></span> 19</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="sidebar-block">
                            <h3 class="sidebar-title">Etiquetas</h3>
                            <div class="tagcloud">
                              @foreach($tags as $tag)
                                <a href="#" class="tag-cloud-link">{{$tag->name}}</a>
                               @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .page-section -->



@endsection
