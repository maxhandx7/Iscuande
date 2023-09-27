@extends('layouts.pages')

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
                                <span class="text-grey">Publicado por</span> <a href="#">{{ $post->user->username }}</a>
                            </div>
                            <span class="divider">|</span>
                            <div class="post-date">
                                <a href="#">{{ $post->created_at->isoFormat('D [de] MMMM [de] YYYY')}}</a>
                              </div>
                              <span class="divider">|</span>
                            <div>
                                <a href="#">{{ $post->category->name }}</a>
                            </div>
                        </div>
                        <h2 class="post-title h1">{{ $post->name }}</h2>
                        <p class="text-justify text-uppercase ">{{ $post->Previa }}</p>
                        <div class="post-content">
                            <p>{!! $post->body !!}</p>
                        </div>
                        <div class="post-tags">
                            @foreach ($post->tags as $tag)
                                <a href="#" class="tag-link">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </article> <!-- .blog-details -->
                    @include('alert.message')
          
                        <h3 class="sidebar-title">Comentarios</h3>
                        @forelse ($comentarios as $comentario)
                        <div class="blog-item">
                            <div class="content">
                                <h5 class="post-title">{{ $comentario->body }}</h5>
                                <div class="meta">
                                    <span class="mai-calendar"></span> {{ $comentario->created_at->format('d/m/Y') }}
                                    <span class="mai-person"></span> {{ $comentario->user->username }}
                                  </div>
                            </div>
                        </div>
                        @empty
                            <p>No hay comentarios aún.</p>
                        @endforelse

                    <div class="comment-form-wrap pt-5">

                        <h3 class="mb-5">Deja un comentario</h3>
                        {!! Form::model($post->id, ['route' => ['comments.store', $post->id], 'method' => 'POST']) !!}
                        <div class="form-group">
                            <label for="message">Comentario</label>
                            <textarea name="body" id="body" cols="30" rows="4" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Comentar noticia" class="btn btn-primary">
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-block">
                            <h3 class="sidebar-title">Categorias</h3>
                            <ul class="categories">
                                @foreach ($categoriesWithCount as $category)
                                    <li><a href="#">{{ $category->name }}
                                            <span>{{ $category->posts_count }}</span></a></li>
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
@endsection
